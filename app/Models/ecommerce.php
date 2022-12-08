<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ecommerce extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'harga',
        'stock',
        'description'
    ];

    public function transaction()
    {
        return $this->hasMany(transaction::class);
    }
}
