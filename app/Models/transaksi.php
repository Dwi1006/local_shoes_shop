<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ecommerce',
        'id_user',
        'jumlah_sepatu',
        'total_harga',
        'status',
        'booking_date',
    ];

    public function ticket()
    {
        return $this->belongsTo(ecommerce::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}