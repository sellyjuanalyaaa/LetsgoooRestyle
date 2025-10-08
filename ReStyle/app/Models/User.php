<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'preferensi_style', 'warna_favorit'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relasi
    public function products()
    {
        return $this->hasMany(Product::class, 'penjual_id');
    }

    public function getNameForFilament(): string
    {
        return $this->nama;
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'author_id');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}