<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;
    protected $table = "tb_ms_supplier";
    protected $fillable = [
        'oid_supplier',
        'supplier_name',
        'supplier_address',
        'supplier_email',
        'supplier_phone',
        'crud',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at'
    ];
}
