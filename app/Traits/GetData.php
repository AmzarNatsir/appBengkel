<?php

namespace App\Traits;

use App\Models\PpnMarginModel;

trait GetData
{
    public static function getPpn()
    {
        $query = PpnMarginModel::first();
        if(empty($query->id)) {
            $result = 0;
        } else {
            $result = $query->ppn;
        }
        return $result;
    }

    public static function getMarginHargaJual()
    {
        $query = PpnMarginModel::first();
        if(empty($query->id)) {
            $result = 0;
        } else {
            $result = $query->margin;
        }
        return $result;
    }
}
