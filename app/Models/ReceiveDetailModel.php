<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveDetailModel extends Model
{
    use HasFactory;
    protected $table = 'tb_receive_detail';
    protected $fillable = [
        'id_head',
        'id_part',
        'terima',
        'order',
        'harga_satuan',
        'diskon',
        'sub_total',
    ];

    public function getParts()
    {
        return $this->belongsTo(PartsModel::class, 'id_part', 'id');
    }
}
