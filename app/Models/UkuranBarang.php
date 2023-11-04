<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkuranBarang extends Model
{
    use HasFactory;

    protected $table = 'ukuran_barang';

    protected $fillable = [
        'barang_id',
        'ukuran'
    ];
}
