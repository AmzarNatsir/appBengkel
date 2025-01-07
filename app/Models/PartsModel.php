<?php

namespace App\Models;

use App\Models\common\BrandModel;
use App\Models\common\JenisModel;
use App\Models\common\SatuanModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartsModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tb_ms_parts";
    protected $fillable = [
        'oid_part',
        'part_name',
        'id_satuan',
        'id_jenis',
        'id_brand',
        'id_rak',
        'stok_awal',
        'stok_akhir',
        'harga_beli',
        'harga_jual',
        'deskripsi',
        'gambar',
        'crud',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getSatuan()
    {
        return $this->belongsTo(SatuanModel::class, 'id_satuan', 'id');
    }
    public function getJenis()
    {
        return $this->belongsTo(JenisModel::class, 'id_jenis', 'id');
    }
    public function getBrand()
    {
        return $this->belongsTo(BrandModel::class, 'id_brand', 'id');
    }
    public function getRak()
    {
        return $this->belongsTo(RakModel::class, 'id_rak', 'id');
    }

}
