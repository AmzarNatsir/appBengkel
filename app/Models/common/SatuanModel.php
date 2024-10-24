<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanModel extends Model
{
    use HasFactory;
    protected $table = "tb_com_satuan";
    protected $fillable = [
        'oid_satuan',
        'satuan',
        'crud',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at'
    ];
}
