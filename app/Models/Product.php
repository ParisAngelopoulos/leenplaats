<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'is_available'];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
