<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'isi', 'kategori', 'author_id'
    ];

    // Relasi
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}