<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    protected $fillable = ['name', 'brand', 'quantity'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}

