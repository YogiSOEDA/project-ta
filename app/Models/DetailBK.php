<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBK extends Model
{
    use HasFactory;

    protected $table = 'detail_barang_keluar';

    protected $fillable = [
        'bk_id',
        'barang_id',
        'jumlah',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
