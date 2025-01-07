<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePartsModel extends Model
{
    use HasFactory;
    protected $table = "tb_service_parts";
    protected $fillable = [
        'service_id',
        'part_id',
        'jumlah',
        'harga',
        'sub_total'
    ];

    public function getPart()
    {
        return $this->belongsTo(PartsModel::class, 'part_id', 'id');
    }
}
