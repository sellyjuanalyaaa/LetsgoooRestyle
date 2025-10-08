<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'poin',
        'tipe_transaksi',
        'jumlah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}