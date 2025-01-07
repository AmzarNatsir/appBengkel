<?php

namespace App\Http\Controllers;

use App\Models\PpnMarginModel;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function ppn_margin_harga_jual()
    {
        $data = [
            'ppn_margin' => PpnMarginModel::first()
        ];
        return view('pengaturan.pphmarginpricing.index', $data);
    }

    public function ppn_margin_harga_jual_store(Request $request)
    {
        $data= [
            "ppn" => $request->inp_ppn,
            "margin" => $request->inp_margin
        ];
        if(empty($request->id_ppn_margin)) {
            PpnMarginModel::insert($data);
        } else {
            PpnMarginModel::find($request->id_ppn_margin)->update($data);
        }
        return redirect()->route('pengaturan.ppn_marginhargajual')->with([
            'status' => 'success',
            'message' => 'Insert Data Successfully'
            ]
        );
    }
}
