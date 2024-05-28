<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'picture', 'quantity']; // Include quantity

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
   
    use HasFactory;

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}

