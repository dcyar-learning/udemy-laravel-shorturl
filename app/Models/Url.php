<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'user_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
