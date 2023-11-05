<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMaterial extends Model
{
    use HasFactory;

    protected $table = 'request_material';

    protected $fillable = [
        'tanggal_request',
        'tanggal_kebutuhan',
        'proyek_id',
        'status',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
