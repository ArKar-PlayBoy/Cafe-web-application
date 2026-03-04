<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockBatch extends Model
{
    protected $fillable = [
        'stock_item_id',
        'quantity',
        'cost',
        'received_date',
        'expiry_date',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'cost' => 'decimal:2',
        'received_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function stockItem(): BelongsTo
    {
        return $this->belongsTo(StockItem::class);
    }

    public function movements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function wasteLogs(): HasMany
    {
        return $this->hasMany(WasteLog::class);
    }

    public function isExpired(): bool
    {
        return $this->expiry_date && $this->expiry_date->isPast();
    }

    public function isExpiringSoon(int $days = 7): bool
    {
        return $this->expiry_date && ! $this->isExpired() && $this->expiry_date->diffInDays(now()) <= $days;
    }
}
