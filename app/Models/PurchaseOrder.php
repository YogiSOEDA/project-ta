<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_order';

    protected $fillable = [
        'proyek_id',
        'tanggal',
        'acc_direktur',
        'acc_akunting',
        'status',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class);
    }
}
