<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorModel extends Model
{
    use HasFactory;
    protected $table = "tb_com_color";
    protected $fillable = [
        'oid_color',
        'color_idn',
        'color_eng',
        'crud',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at'
    ];
}
