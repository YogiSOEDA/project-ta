<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'harga',
        'gambar',
    ];

    public function detail()
    {
        return $this->hasOne(DetailPO::class);
    }
    // protected $hidden;
}
