<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrderDetailModel;
use App\Models\PurchaseOrderModel;
use App\Traits\Converts;
use App\Traits\GenerateOid;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PenerimaanController extends Controller
{
    use GenerateOid;
    use Converts;
    protected $dateTimeInsert;

    function __construct()
    {
        $this->dateTimeInsert = date("Y-m-d H:s:i");
    }

    //buat baru
    public function baru()
    {
        $data = [
            'list_po' => PurchaseOrderModel::with(['getSupplier'])->where('status', 'Draft')->latest()->get()
        ];
        return view('penerimaan.new', $data);
    }
    public function getPO(Request $request)
    {
        $id_data = $request->id;
        $data = [
            'head_po' => PurchaseOrderModel::find($id_data),
            'detail_po' => PurchaseOrderDetailModel::with(['getParts', 'getParts.getSatuan'])->where('id_head', $id_data)->get()
        ];
        return response()->json([
            'respon' => $data
        ]);
    }
    public function store(Request $request)
    {
        try {
            // dd($request);
            $data = [
                'nomor_receive' => GenerateOid::genOid('receive'),
                'tanggal_receive' => $request->receive_date,
                'ket_receive' => $request->inp_remark,
                'po_reff' => $request->po_select,
                'cara_bayar' => $request->inp_remark,
                'uang_muka' => $request->inp_remark,
                'biaya_lain' => Converts::convert_money_to_double($request->inp_biaya_lain_lain),
                'ppn' => Converts::convert_money_to_double($request->inp_ppn),
                'total' => Converts::convert_money_to_double($request->inp_total),
                'total_net' => Converts::convert_money_to_double($request->inp_total_net),
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert,
                'status' => 'Draft'
            ];
            $lastID = PurchaseOrderModel::insertGetId($data);

            return redirect('pemesanan/tambahItem/'. Converts::encrypt_decrypt('encrypt', $lastID))->with([
                'status' => 'success',
                'message' => 'Successfully'
            ]);
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('penerimaan.baru')->with([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
