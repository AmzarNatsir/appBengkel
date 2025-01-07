<?php

namespace App\Http\Controllers;

use App\Traits\GetData;
use Illuminate\Http\Request;

class GetDataController extends Controller
{
    use GetData;

    public function getPpnValue()
    {
        return response()->json([
            'result' => GetData::getPpn()
        ]);
    }
}
