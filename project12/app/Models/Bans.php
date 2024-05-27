<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bans extends Model
{
    protected $fillable = ['is_banned', 'begin_ban', 'end_ban', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


