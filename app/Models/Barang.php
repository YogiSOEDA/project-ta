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
        'stok',
    ];

    public function detail()
    {
        return $this->hasOne(DetailPO::class);
    }

    public function detailRM()
    {
        return $this->hasOne(DetailRM::class);
    }

    public function detailBK()
    {
        return $this->hasOne(DetailBK::class);
    }
    // protected $hidden;
}
