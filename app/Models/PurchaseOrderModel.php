<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tb_purchase_order';
    protected $fillable = [
        'po_number',
        'po_date',
        'po_delivery_order',
        'id_supplier',
        'po_remark',
        'po_total',
        'status',
        'user_at',
        'user_up',
        'user_del'
    ];
}
