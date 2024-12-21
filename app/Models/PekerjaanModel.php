<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekerjaanModel extends Model
{
    use HasFactory;
    protected $table = "tb_set_pekerjaan";
    protected $fillable = [
        'kategori_id',
        'nama_pekerjaan',
        'biaya',
        'aktif',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at'
    ];

    public function getKategoriPekerjaan()
    {
        return $this->belongsTo(KategoriPekerjaanModel::class, 'kategori_id', 'id');
    }
}
