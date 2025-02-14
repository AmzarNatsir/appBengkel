<?php

namespace App\Traits;

use App\Models\common\BrandModel;
use App\Models\common\CCUnitModel;
use App\Models\common\ColorModel;
use App\Models\common\JenisModel;
use App\Models\common\ModelBrandModel;
use App\Models\common\SatuanModel;
use App\Models\common\TypeModel;
use App\Models\CustomerModel;
use App\Models\PartsModel;
use App\Models\PurchaseOrderModel;
use App\Models\ReceiveModel;
use App\Models\ServiceModel;
use App\Models\SupplierModel;
use App\Models\VehicleModel;
use PHPUnit\Event\TypeMap;

trait GenerateOid
{
    public static function genOid($common) {
        $oidNew = "";
        if($common=='brand')
        {
            $kode = "BR-";
            $nom = 1;
            $result = BrandModel::orderBy('id', 'desc')->first();
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
            $result = ModelBrandModel::orderBy('id', 'desc')->first();
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
            $result = TypeModel::orderBy('id', 'desc')->first();
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
            $result = CCUnitModel::orderBy('id', 'desc')->first();
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
            $result = ColorModel::orderBy('id', 'desc')->first();
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
            $result = JenisModel::orderBy('id', 'desc')->first();
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
            $result = SatuanModel::orderBy('id', 'desc')->first();
            if(empty($result->oid_satuan)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_satuan, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='customer')
        {
            $kode = "CS-";
            $nom = 1;
            $result = CustomerModel::orderBy('id', 'desc')->first();
            if(empty($result->oid_customer)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_customer, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='supplier')
        {
            $kode = "SP-";
            $nom = 1;
            $result = SupplierModel::orderBy('id', 'desc')->first();
            if(empty($result->oid_supplier)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_supplier, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='vehicle')
        {
            $kode = "VH-";
            $nom = 1;
            $result = VehicleModel::orderBy('id', 'desc')->first();
            if(empty($result->oid_vehicle)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_vehicle, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='part')
        {
            $kode = "PR-";
            $nom = 1;
            $result = PartsModel::orderBy('id', 'desc')->first();
            if(empty($result->oid_part)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->oid_part, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='po')
        {
            $kode = "PO-";
            $nom = 1;
            $result = PurchaseOrderModel::orderBy('id', 'desc')->first();
            if(empty($result->po_number)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->po_number, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        if($common=='receive')
        {
            $kode = "RV-";
            $nom = 1;
            $result = ReceiveModel::orderBy('id', 'desc')->first();
            if(empty($result->nomor_receive)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->nomor_receive, 3, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }

        if($common=='sales')
        {
            $kode = "INV-";
            $nom = 1;
            $result = ServiceModel::orderBy('id', 'desc')->first();
            if(empty($result->no_service)) {
                $oidNew = $kode.sprintf('%03s', $nom);
            } else {
                $no_urut_baru = substr($result->no_service, 4, 3)+1;
                $oidNew = $kode.sprintf('%03s', $no_urut_baru);
            }
        }
        return $oidNew;
    }
}
