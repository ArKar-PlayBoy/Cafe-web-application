<?php

namespace App\Services;

use App\Models\Order;
use App\Models\StockAlert;
use App\Models\StockBatch;
use App\Models\StockItem;
use App\Models\StockMovement;
use App\Models\WasteLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockService
{
    public static function addStock(int $stockItemId, int $quantity, ?float $cost = null, ?\Carbon\Carbon $expiryDate = null, ?string $note = null): StockBatch
    {
        return DB::transaction(function () use ($stockItemId, $quantity, $cost, $expiryDate, $note) {
            $stockItem = StockItem::lockForUpdate()->findOrFail($stockItemId);

            $batch = StockBatch::create([
                'stock_item_id' => $stockItemId,
                'quantity' => $quantity,
                'cost' => $cost,
                'received_date' => now(),
                'expiry_date' => $expiryDate,
            ]);

            $stockItem->current_quantity += $quantity;
            $stockItem->save();

            self::logMovement($stockItemId, $batch->id, $quantity, 'in', $note ?? 'Stock added');
            self::checkLowStock($stockItem);

            return $batch;
        });
    }

    public static function deductStock(Order $order): bool
    {
        return DB::transaction(function () use ($order) {
            foreach ($order->items as $orderItem) {
                $menuItem = $orderItem->menuItem;
                if (! $menuItem) {
                    continue;
                }

                foreach ($menuItem->stockItems as $stockItem) {
                    $quantityNeeded = $stockItem->pivot->quantity_needed * $orderItem->quantity;
                    self::deductFromStock($stockItem->id, $quantityNeeded, 'deduction', 'Order #'.$order->id);
                }
            }

            return true;
        });
    }

    public static function deductFromStock(int $stockItemId, int $quantity, string $type = 'out', ?string $note = null): array
    {
        return DB::transaction(function () use ($stockItemId, $quantity, $type, $note) {
            $stockItem = StockItem::lockForUpdate()->findOrFail($stockItemId);
            $batches = $stockItem->batches()->where('quantity', '>', 0)->orderBy('received_date', 'asc')->get();

            $remaining = $quantity;
            $deducted = [];

            foreach ($batches as $batch) {
                if ($remaining <= 0) {
                    break;
                }
                $deduct = min($batch->quantity, $remaining);
                $batch->quantity -= $deduct;
                $batch->save();
                self::logMovement($stockItemId, $batch->id, -$deduct, $type, $note);
                $deducted[] = ['batch_id' => $batch->id, 'quantity' => $deduct];
                $remaining -= $deduct;
            }

            $stockItem->current_quantity -= ($quantity - $remaining);
            $stockItem->save();

            if ($remaining > 0) {
                logger()->warning("Insufficient stock for item {$stockItem->name}. Short by {$remaining}");
            }

            self::checkLowStock($stockItem);

            return $deducted;
        });
    }

    public static function logWaste(int $stockItemId, int $quantity, string $reason, ?string $note = null): WasteLog
    {
        return DB::transaction(function () use ($stockItemId, $quantity, $reason, $note) {
            $stockItem = StockItem::lockForUpdate()->findOrFail($stockItemId);
            $batches = $stockItem->batches()->where('quantity', '>', 0)->orderBy('received_date', 'asc')->get();

            $remaining = $quantity;
            $usedBatch = null;

            foreach ($batches as $batch) {
                if ($remaining <= 0) {
                    break;
                }
                $waste = min($batch->quantity, $remaining);
                $batch->quantity -= $waste;
                $batch->save();
                $usedBatch = $batch;
                $remaining -= $waste;
            }

            $wastedQty = $quantity - $remaining;
            $stockItem->current_quantity -= $wastedQty;
            $stockItem->save();

            $wasteLog = WasteLog::create([
                'stock_item_id' => $stockItemId,
                'stock_batch_id' => $usedBatch?->id,
                'user_id' => Auth::id(),
                'quantity' => $wastedQty,
                'reason' => $reason,
            ]);

            self::logMovement($stockItemId, $usedBatch?->id, -$wastedQty, 'waste', $note ?? "Waste: {$reason}");
            self::checkLowStock($stockItem);

            return $wasteLog;
        });
    }

    public static function checkLowStock(StockItem $stockItem): ?StockAlert
    {
        if ($stockItem->current_quantity < $stockItem->min_quantity) {
            $exists = StockAlert::where('stock_item_id', $stockItem->id)
                ->where('type', 'low_stock')
                ->where('is_read', false)
                ->exists();

            if (! $exists) {
                return StockAlert::create([
                    'stock_item_id' => $stockItem->id,
                    'type' => 'low_stock',
                    'is_read' => false,
                ]);
            }
        } else {
            StockAlert::where('stock_item_id', $stockItem->id)
                ->where('type', 'low_stock')
                ->update(['is_read' => true]);
        }

        return null;
    }

    public static function checkExpiring(int $days = 7): array
    {
        $batches = StockBatch::where('quantity', '>', 0)
            ->whereNotNull('expiry_date')
            ->whereBetween('expiry_date', [now(), now()->addDays($days)])
            ->with('stockItem:id,name')
            ->get();

        foreach ($batches as $batch) {
            StockAlert::firstOrCreate(
                ['stock_item_id' => $batch->stock_item_id, 'type' => 'expiring', 'is_read' => false],
                ['stock_item_id' => $batch->stock_item_id, 'type' => 'expiring', 'is_read' => false]
            );
        }

        return $batches;
    }

    public static function adjustStock(int $stockItemId, int $newQuantity, ?string $note = null): StockItem
    {
        return DB::transaction(function () use ($stockItemId, $newQuantity, $note) {
            $stockItem = StockItem::lockForUpdate()->findOrFail($stockItemId);
            $difference = $newQuantity - $stockItem->current_quantity;
            $stockItem->current_quantity = $newQuantity;
            $stockItem->save();
            self::logMovement($stockItemId, null, $difference, 'adjustment', $note ?? 'Manual adjustment');
            self::checkLowStock($stockItem);

            return $stockItem;
        });
    }

    public static function getUnreadAlerts()
    {
        return StockAlert::where('is_read', false)
            ->with('stockItem:id,name,current_quantity,min_quantity')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public static function markAlertAsRead(int $alertId): bool
    {
        return (bool) StockAlert::where('id', $alertId)->update(['is_read' => true]);
    }

    public static function getStockHistory(int $stockItemId)
    {
        return StockMovement::where('stock_item_id', $stockItemId)
            ->with('user:id,name', 'stockBatch')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public static function getAllBatches()
    {
        return StockBatch::with('stockItem:id,name')
            ->orderBy('expiry_date', 'asc')
            ->get();
    }

    private static function logMovement(int $stockItemId, ?int $batchId, int $quantity, string $type, ?string $note): void
    {
        StockMovement::create([
            'stock_item_id' => $stockItemId,
            'stock_batch_id' => $batchId,
            'user_id' => Auth::id(),
            'quantity_change' => $quantity,
            'type' => $type,
            'note' => $note,
        ]);
    }

    public static function checkStockAvailability($cartItems): array
    {
        $unavailable = [];

        foreach ($cartItems as $cartItem) {
            $menuItem = is_array($cartItem)
                ? ($cartItem['menu_item'] ?? $cartItem['menuItem'] ?? null)
                : $cartItem->menuItem ?? null;
            if (! $menuItem) {
                continue;
            }

            $quantityNeeded = is_array($cartItem)
                ? (int) ($cartItem['quantity'] ?? 0)
                : (int) $cartItem->quantity;

            foreach ($menuItem->stockItems as $stockItem) {
                $requiredQty = $stockItem->pivot->quantity_needed * $quantityNeeded;

                if ($stockItem->current_quantity < $requiredQty) {
                    $unavailable[] = [
                        'menu_item' => $menuItem->name,
                        'stock_item' => $stockItem->name,
                        'required' => $requiredQty,
                        'available' => $stockItem->current_quantity,
                    ];
                }
            }
        }

        return $unavailable;
    }
}
