<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'input_text', 'response_text'
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}