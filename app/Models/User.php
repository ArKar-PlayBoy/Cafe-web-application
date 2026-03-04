<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
        'role_id',
=======
>>>>>>> 5b466fb (more reliable and front-end changes)
        'phone',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function isAdmin(): bool
    {
        return $this->role && $this->role->name === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role && $this->role->name === 'staff';
    }
<<<<<<< HEAD
=======

    public function isBanned(): bool
    {
        return (bool) $this->is_banned;
    }

    public function ban(?string $reason = null): void
    {
        $this->is_banned = true;
        $this->banned_at = now();
        $this->ban_reason = $reason;
        $this->save();
    }

    public function unban(): void
    {
        $this->is_banned = false;
        $this->banned_at = null;
        $this->ban_reason = null;
        $this->save();
    }
>>>>>>> 5b466fb (more reliable and front-end changes)
}
