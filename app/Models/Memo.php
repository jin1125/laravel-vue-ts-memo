<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'status',
        'detail',
        'limit',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
