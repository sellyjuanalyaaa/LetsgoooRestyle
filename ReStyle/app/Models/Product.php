<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'deskripsi',
        'kategori_id',
        'harga',
        'kondisi',
        'ukuran',
        'warna',
        'stok',
        'foto',
        'penjual_id',
    ];

    // Relasi
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function penjual()
    {
        return $this->belongsTo(User::class, 'penjual_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // app/Models/Product.php


}