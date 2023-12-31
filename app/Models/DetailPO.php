<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPO extends Model
{
    use HasFactory;

    protected $table = 'detail_purchase_order';

    protected $fillable = [
        'po_id',
        'barang_id',
        'jumlah',
        'harga',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
