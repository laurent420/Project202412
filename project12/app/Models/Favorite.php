<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_group_id'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_group_id', 'id'); // Ensure the column names are correct
    }
}

