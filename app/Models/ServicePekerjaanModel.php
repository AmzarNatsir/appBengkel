<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePekerjaanModel extends Model
{
    use HasFactory;
    protected $table = "tb_service_pekerjaan";
    protected $fillable = [
        'service_id',
        'pekerjaan_id',
        'biaya'
    ];

    public function getPekerjaan()
    {
        return $this->belongsTo(PekerjaanModel::class, 'pekerjaan_id', 'id');
    }
}
