<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    use HasFactory;
    protected $table = "tb_service";
    protected $fillable = [
        'tgl_service',
        'no_service',
        'unit_id',
        'deskripsi',
        'cara_bayar',
        'total_pekerjaan',
        'total_parts',
        'total_pekerjaa_parts',
        'diskon',
        'ppn_persen',
        'ppn_rupiah',
        'total_net',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at'
    ];

    public function getUnit()
    {
        return $this->belongsTo(VehicleModel::class, 'unit_id', 'id');
    }
}
