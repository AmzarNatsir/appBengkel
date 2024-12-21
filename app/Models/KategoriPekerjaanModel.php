<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPekerjaanModel extends Model
{
    use HasFactory;
    protected $table = "tb_set_kategori_pekerjaan";
    protected $fillable = [
        'kategori_pekerjaan',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at'
    ];
}
