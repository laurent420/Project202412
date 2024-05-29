<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $dates = ['due_date'];  // Ensure due_date is treated as a Carbon date instance

    /**
     * Get the user that owns the loan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product associated with the loan.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

