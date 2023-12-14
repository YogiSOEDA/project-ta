<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar_po';

    protected $fillable = [
        'po_id',
        'user_id',
        'komentar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
