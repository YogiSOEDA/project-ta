<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyek';

    protected $fillable = [
        'nama_proyek',
        'cp_proyek',
    ];

    public function purchaseOrder()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    // protected $hidden;
}
