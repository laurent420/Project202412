<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['item_group_id', 'user_id'];

    public function itemGroup()
    {
        return $this->belongsTo(ItemGroup::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}