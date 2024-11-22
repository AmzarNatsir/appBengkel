<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetailModel extends Model
{
    use HasFactory;
    protected $table = 'tb_purchase_order_detail';
    protected $fillable = [
        'id_head',
        'id_part',
        'qty',
        'harga_satuan',
        'sub_total',
        'status'
    ];

    public function getParts()
    {
        return $this->belongsTo(PartsModel::class, 'id_part', 'id');
    }
}
