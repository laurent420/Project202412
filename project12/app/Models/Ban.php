<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_banned',
        'begin_ban',
        'end_ban',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}