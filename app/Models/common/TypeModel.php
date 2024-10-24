<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeModel extends Model
{
    use HasFactory;
    protected $table = "tb_com_type";
    protected $fillable = [
        'oid_type',
        'type_name',
        'oid_model',
        'oid_brand',
        'crud',
        'user_at',
        'user_up',
        'user_del',
        'created_at',
        'updated_at'
    ];

    public function getBrand()
    {
        return $this->belongsTo(BrandModel::class, 'oid_brand', 'oid_brand');
    }
    public function getModel()
    {
        return $this->belongsTo(ModelBrandModel::class, 'oid_model', 'oid_model');
    }
}
