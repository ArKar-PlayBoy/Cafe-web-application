<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockItem extends Model
{
    protected $fillable = [
        'name',
        'current_quantity',
        'min_quantity',
        'barcode',
        'bin_location',
        'category',
    ];

    protected $casts = [
        'current_quantity' => 'integer',
        'min_quantity' => 'integer',
    ];

    public function batches(): HasMany
    {
        return $this->hasMany(StockBatch::class)->orderBy('received_date', 'asc');
    }

    public function movements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(StockAlert::class);
    }

    public function menuItems(): BelongsToMany
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_stock')
            ->withPivot('quantity_needed');
    }

    public function wasteLogs(): HasMany
    {
        return $this->hasMany(WasteLog::class);
    }

    public function getActiveBatches()
    {
        return $this->batches()->where('quantity', '>', 0)->get();
    }

    public function isLowStock(): bool
    {
        return $this->current_quantity < $this->min_quantity;
    }
}
