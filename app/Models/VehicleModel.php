<?php

namespace App\Models;

use App\Models\common\BrandModel;
use App\Models\common\ColorModel;
use App\Models\common\JenisModel;
use App\Models\common\ModelBrandModel;
use App\Models\common\TypeModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;
    protected $table = "tb_ms_vehicle";
    protected $fillable = [
        'oid_vehicle',
        'plat_number',
        'oid_brand',
        'oid_model',
        'oid_type',
        'oid_jenis',
        'oid_color',
        'oid_customer',
        'year',
        'crud',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at'
    ];

    public function getBrand()
    {
        return $this->belongsTo(BrandModel::class, "oid_brand", "oid_brand");
    }

    public function getModel()
    {
        return $this->belongsTo(ModelBrandModel::class, "oid_brand", "oid_brand");
    }

    public function getType()
    {
        return $this->belongsTo(TypeModel::class, 'oid_type', 'oid_type');
    }

    public function getJenis()
    {
        return $this->belongsTo(JenisModel::class, 'oid_jenis', 'oid_jenis');
    }

    public function getColor()
    {
        return $this->belongsTo(ColorModel::class, 'oid_color', 'oid_color');
    }

    public function getCustomer()
    {
        return $this->belongsTo(CustomerModel::class, 'oid_customer', 'oid_customer');
    }
}
