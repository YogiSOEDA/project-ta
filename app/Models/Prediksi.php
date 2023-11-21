<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediksi extends Model
{
    use HasFactory;

    protected $table = 'prediksi';

    protected $fillable = [
        'barang_id',
        'bulan',
        'tahun',
        'total_pengeluaran',
        'wma',
    ];
}
