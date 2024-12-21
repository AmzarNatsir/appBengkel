<?php

namespace App\Http\Controllers;

use App\Models\common\TypeModel;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //add
    public function baru()
    {
        $data = [
            'unit' =>  VehicleModel::with([
                'getType',
                'getType.getBrand',
                'getType.getModel'
            ])->whereIn('crud', ["I", "U"])->get()
        ];
        return view('service.create', $data);
    }

    public function getUnitCustomer(Request $request)
    {
        $customer = VehicleModel::with([
            'getCustomer'
        ])->find($request->id);
        return response()->json([
            'result' => $customer->getCustomer->customer_name
        ]);
    }
}
