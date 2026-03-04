<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\HasOne;
>>>>>>> 5b466fb (more reliable and front-end changes)

class Order extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['user_id', 'status', 'total', 'payment_method', 'payment_status'];

    protected $casts = [
        'total' => 'decimal:2',
=======
    protected $fillable = [
        'user_id',
        'status',
        'total',
        'payment_method',
        'payment_status',
        'payment_reference',
        'payment_screenshot',
        'payment_note',
        'payment_verified_at',
        'payment_verified_by',
        'cancelled_by',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'payment_verified_at' => 'datetime',
>>>>>>> 5b466fb (more reliable and front-end changes)
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
<<<<<<< HEAD
=======

    public function rejection(): HasOne
    {
        return $this->hasOne(OrderRejection::class);
    }

    public function paymentVerifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payment_verified_by');
    }

    public function canceller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }
>>>>>>> 5b466fb (more reliable and front-end changes)
}
