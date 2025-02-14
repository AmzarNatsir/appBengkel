<?php

namespace App\Http\Controllers;

use App\Models\PartsModel;
use App\Models\PpnMarginModel;
use App\Models\PurchaseOrderDetailModel;
use App\Models\PurchaseOrderModel;
use App\Models\ReceiveDetailModel;
use App\Models\ReceiveModel;
use App\Models\ServiceModel;
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
    public function index()
    {
        return view('penerimaan.index');
    }

    public function getData(Request $request)
    {
        $columns = ['created_at'];
        $totalData = ReceiveModel::count();
        $search = $request->input('search.value');
        $query = ReceiveModel::with([
            'getPO',
            'getPO.getSupplier'
        ])->select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('nomor_receive', 'like', "%{$search}%");
            });
        }
        $totalFiltered = $query->count();
        $query = $query->offset($request->input('start'))
                      ->limit($request->input('length'))
                        ->orderBy('id', 'asc')
                      ->get();

        $data = array();
        if($query){
            $counter = $request->input('start') + 1;
            foreach($query as $r){
                $btn = '<button type="button" value="'.$r->id.'" name="btn-detail[]" id="btn-detail" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#formModal" onclick="goDetail(this)"><i class="fa fa-eye"></i></button>';

                $Data['id'] =  $r->id;
                $Data['nomor_receive'] =  $r->nomor_receive;
                $Data['tanggal_receive'] = $r->tanggal_receive;
                $Data['supplier'] = $r->getPO->getSupplier->supplier_name;
                $Data['ket_receive'] = $r->ket_receive;
                $Data['cara_bayar'] = ($r->cara_bayar=="Cash") ? "<span class='badge badge-success'>".$r->cara_bayar."</span>" : "<span class='badge badge-warning'>".$r->cara_bayar."</span>";
                $Data['total_net'] = "Rp. ".Converts::conver_double_to_money($r->total_net);
                $Data['no'] = $counter;
                $Data['act'] = $btn;
                $data[] = $Data;
                $counter++;
            }
        }
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data
        ]);
    }

    //buat baru
    public function baru()
    {
        $data = [
            'list_po' => PurchaseOrderModel::with(['getSupplier'])->where('status', 'Purchase Order')->latest()->get()
        ];
        return view('penerimaan.new', $data);
    }
    public function getPO(Request $request)
    {
        $id_data = $request->id;
        $querymargin = PpnMarginModel::first();
        if(empty($querymargin->id)) {
            $n_margin = 0;
            $n_ppn = 0;
        } else {
            $n_margin = $querymargin->margin;
            $n_ppn = $querymargin->ppn;
        }
        $data = [
            'head_po' => PurchaseOrderModel::find($id_data),
            'detail_po' => PurchaseOrderDetailModel::with(['getParts', 'getParts.getSatuan'])->where('id_head', $id_data)->get(),
            'margin_harga_jual' => $n_margin,
            'persen_ppn' => $n_ppn
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
                'cara_bayar' => $request->cara_bayar,
                'biaya_lain' => Converts::convert_money_to_double($request->inp_biaya_lain_lain),
                'ppn' => Converts::convert_money_to_double($request->inp_ppn),
                'total' => Converts::convert_money_to_double($request->inp_total),
                'total_net' => Converts::convert_money_to_double($request->inp_total_net),
                'uang_muka' => Converts::convert_money_to_double($request->inp_uang_muka),
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert,
                'status' => 'Receive'
            ];
            $lastID = ReceiveModel::insertGetId($data);
            foreach(array($request) as $key => $value)
            {
                for($i=0; $i < count($request->id_row); $i++)
                {
                    ReceiveDetailModel::create([
                        'id_head' => $lastID,
                        'id_part' => $value['id_row'][$i],
                        'terima' => str_replace(",","", $value['qty_diterima'][$i]),
                        'order' => str_replace(",","", $value['qty_dipesan'][$i]),
                        'harga_satuan' => str_replace(",","", $value['harga_satuan'][$i]),
                        'diskon' => str_replace(",","", $value['diskon'][$i]),
                        'sub_total' => str_replace(",","", $value['item_sub_total'][$i])
                    ]);
                    $update_part = PartsModel::find($value['id_row'][$i]);
                    $update_part->harga_beli = str_replace(",","", $value['harga_satuan'][$i]);
                    $update_part->harga_jual = str_replace(",","", $value['harga_jual'][$i]);
                    $update_part->stok_akhir += str_replace(",","", $value['qty_diterima'][$i]);
                    $update_part->update();
                }
            }
            //update status PO
            PurchaseOrderModel::find($request->po_select)->update(['status' => 'Receive']);
            return redirect()->route('penerimaan.baru')->with([
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

    public function show($id)
    {
        $data = [
            'header' => ReceiveModel::with([
                'getPO',
                'getPO.getSupplier'
            ])->find($id),
            'detail' => ReceiveDetailModel::with(['getParts', 'getParts.getSatuan'])->where('id_head', $id)->get()
        ];
        return view('penerimaan.detail', $data);
    }

    //
    public function getPenerimaanStok(Request $request)
    {
        $stok_id = $request->stok_id;
        $data = ReceiveModel::select([
                    'tb_receive.nomor_receive',
                    'tb_receive.tanggal_receive',
                    'tb_receive_detail.terima',
                    'tb_receive_detail.harga_satuan',
                    'tb_receive_detail.diskon',
                    'tb_receive_detail.sub_total',
                    'tb_com_satuan.satuan'])
                        ->leftJoin('tb_receive_detail', 'tb_receive_detail.id_head', '=', 'tb_receive.id')
                        ->leftJoin('tb_ms_parts', 'tb_receive_detail.id_part', '=', 'tb_ms_parts.id')
                        ->leftJoin('tb_com_satuan', 'tb_ms_parts.id_satuan', '=', 'tb_com_satuan.id')
                        ->where('tb_receive_detail.id_part', $stok_id)
                        ->orderBy('tb_receive.tanggal_receive')->get();
        return response()->json([
            'respon' => $data
        ]);
    }

    public function getPenjualanStok(Request $request)
    {
        $stok_id = $request->stok_id;
        $data = ServiceModel::select([
                    'tb_service.tgl_service',
                    'tb_service.no_service',
                    'tb_service_parts.jumlah',
                    'tb_service_parts.harga',
                    'tb_service_parts.sub_total',
                    'tb_com_satuan.satuan'])
            ->leftJoin('tb_service_parts', 'tb_service_parts.service_id', '=', 'tb_service.id')
            ->leftJoin('tb_ms_parts', 'tb_service_parts.part_id', '=', 'tb_ms_parts.id')
            ->leftJoin('tb_com_satuan', 'tb_ms_parts.id_satuan', '=', 'tb_com_satuan.id')
            ->where('tb_service_parts.part_id', $stok_id)
            ->orderBy('tb_service.tgl_service')->get();
        return response()->json([
            'respon' => $data
        ]);
    }

}
