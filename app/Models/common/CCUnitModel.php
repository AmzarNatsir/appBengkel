<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCUnitModel extends Model
{
    use HasFactory;
    protected $table = "tb_com_ccunit";
    protected $fillable = [
        'oid_ccunit',
        'cc_unit',
        'crud',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at'
    ];
}
