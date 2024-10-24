<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisModel extends Model
{
    use HasFactory;
    protected $table = "tb_com_jenis";
    protected $fillable = [
        'oid_jenis',
        'jenis',
        'crud',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at'
    ];
}
