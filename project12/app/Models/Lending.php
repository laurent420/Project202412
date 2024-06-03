<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_group_id', 'lend_date', 'return_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itemGroup()
    {
        return $this->belongsTo(ItemGroup::class);
    }
}
