<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\HasMany;
=======
>>>>>>> 5b466fb (more reliable and front-end changes)

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'table_id', 'reservation_date', 'reservation_time', 'party_size', 'status', 'notes'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(CafeTable::class, 'table_id');
    }
}
