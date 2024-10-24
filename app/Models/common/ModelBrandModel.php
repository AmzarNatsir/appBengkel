<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBrandModel extends Model
{
    use HasFactory;
    protected $table = "tb_com_model";
    protected $fillable = [
        'oid_model',
        'oid_brand',
        'model_name',
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
}
