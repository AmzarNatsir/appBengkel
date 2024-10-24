<?php

namespace App\Traits;

use App\Models\common\BrandModel;
use App\Models\common\CCUnitModel;
use App\Models\common\ColorModel;
use App\Models\common\JenisModel;
use App\Models\common\ModelBrandModel;
use App\Models\common\SatuanModel;
use App\Models\common\TypeModel;
use PHPUnit\Event\TypeMap;

trait GenerateOid
{
    public static function genOid($common) {
        $oidNew = "";
        if($common=='brand')
        {
            $kode = "BR-";
            $nom = 1;
            $result = BrandModel::orderBy('created_at', 'desc')->first();
            if(empty($result->oid_brand)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_brand, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='model')
        {
            $kode = "ML-";
            $nom = 1;
            $result = ModelBrandModel::orderBy('created_at', 'desc')->first();
            if(empty($result->oid_model)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_model, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='type')
        {
            $kode = "TU-";
            $nom = 1;
            $result = TypeModel::orderBy('created_at', 'desc')->first();
            if(empty($result->oid_type)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_type, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='cc_unit')
        {
            $kode = "CC-";
            $nom = 1;
            $result = CCUnitModel::orderBy('created_at', 'desc')->first();
            if(empty($result->oid_ccunit)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_ccunit, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='color')
        {
            $kode = "CL-";
            $nom = 1;
            $result = ColorModel::orderBy('created_at', 'desc')->first();
            if(empty($result->oid_color)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_color, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='jenis')
        {
            $kode = "JS-";
            $nom = 1;
            $result = JenisModel::orderBy('created_at', 'desc')->first();
            if(empty($result->oid_jenis)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_jenis, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='satuan')
        {
            $kode = "ST-";
            $nom = 1;
            $result = SatuanModel::orderBy('created_at', 'desc')->first();
            if(empty($result->oid_satuan)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_satuan, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        return $oidNew;
    }
}
