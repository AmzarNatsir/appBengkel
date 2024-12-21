<?php

namespace App\Http\Controllers;

use App\Models\PartsModel;
use App\Models\PurchaseOrderDetailModel;
use App\Models\PurchaseOrderModel;
use App\Models\SupplierModel;
use App\Traits\Converts;
use App\Traits\GenerateOid;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class POController extends Controller
{
    use GenerateOid;
    use Converts;
    protected $dateTimeInsert;

    function __construct()
    {
        $this->dateTimeInsert = date("Y-m-d H:s:i");
    }
    //list
    public function index()
    {
        return view('po.index');
    }
    public function getData(Request $request)
    {
        $columns = ['created_at'];
        $totalData = PurchaseOrderModel::count();
        $search = $request->input('search.value');
        $query = PurchaseOrderModel::with([
            'getSupplier'
        ])->select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('po_number', 'like', "%{$search}%");
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
                if($r->status=="Purchase Order")
                {
                    $btn = '<a class="btn btn-primary btn-sm" href="'.url('pemesanan/tambahItem', Converts::encrypt_decrypt('encrypt', $r->id)).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> <i class="fa fa-times"></i></button>';
                } else {
                    $btn = '<button type="button" value="'.$r->id.'" name="btn-detail[]" id="btn-detail" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#formModalDetail" onclick="goDetail(this)"><i class="fa fa-eye"></i></button>';
                }

                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['po_number'] =  $r->po_number;
                $Data['po_date'] = $r->po_date;
                $Data['po_delivery_order'] = $r->po_delivery_order;
                $Data['supplier'] = $r->getSupplier->supplier_name;
                $Data['po_remark'] = $r->po_remark;
                $Data['po_total'] = "Rp. ".Converts::conver_double_to_money($r->po_total);
                $Data['status'] = ($r->status=="Purchase Order") ? "<span class='badge badge-primary'>".$r->status."</span>" : "<span class='badge badge-success'>".$r->status."</span>";
                $Data['no'] = $counter;
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

    //create
    public function create()
    {
        $data = [
            'list_supplier' => SupplierModel::whereIn('crud', ['I', 'U'])->orderBy('oid_supplier')->get()
        ];
        return view('po.create', $data);
    }

    public function store_po(Request $request)
    {
        try {
            $validated = $this->roles_head($request);
            if($validated->fails())
            {
                return redirect()->back()->withInput()->withErrors($validated);
            } else {
                // dd($request);
                $data = [
                    'po_number' => GenerateOid::genOid('po'),
                    'po_date' => $request->po_date,
                    'po_delivery_order' => $request->po_delivery_date,
                    'id_supplier' => $request->supplier_select,
                    'po_remark' => $request->inp_remark,
                    'user_at' => auth()->user()->id,
                    'created_at' => $this->dateTimeInsert,
                    'status' => 'Purchase Order'
                ];
                $lastID = PurchaseOrderModel::insertGetId($data);

                return redirect('pemesanan/tambahItem/'. Converts::encrypt_decrypt('encrypt', $lastID))->with([
                    'status' => 'success',
                    'message' => 'Successfully'
                ]);
            }
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('pemesanan.create')->with([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function new_items($id)
    {
        $data = [
            'main' => PurchaseOrderModel::find(Converts::encrypt_decrypt('decrypt', $id)),
            'list_supplier' => SupplierModel::whereIn('crud', ['I', 'U'])->orderBy('oid_supplier')->get(),
            'list_item' => PartsModel::wherein('crud', ['I', 'U'])->orderby('oid_part')->get(),
            'list_detail' => PurchaseOrderDetailModel::with(['getParts'])->where('id_head', Converts::encrypt_decrypt('decrypt', $id))->get(),
            'converts' => Converts::class
        ];
        // dd($data);
        return view('po.add_item', $data);
    }

    public function getDetailItem(Request $request)
    {
        $result = PartsModel::find($request->id_item)->harga_beli;
        return response()->json([
            'result' => $result
        ]);
    }

    public function store_detail_po(Request $request)
    {
        $id_head =$request->id_head;
        try {
            $validated = $this->roles($request);
            if($validated->fails())
            {
                return redirect()->back()->withInput()->withErrors($validated);
            } else {
                $data = [
                    'id_head' => $id_head,
                    'id_part' => $request->selectItem,
                    'qty' => Converts::convert_money_to_double($request->inpQty),
                    'harga_satuan' => Converts::convert_money_to_double($request->inpHarga),
                    'sub_total' => Converts::convert_money_to_double($request->inpSubTotal),
                ];
                PurchaseOrderDetailModel::insert($data);
                $totalPO = PurchaseOrderDetailModel::where('id_head', $id_head)->sum('sub_total');
                PurchaseOrderModel::find($id_head)->update([
                    'po_total' => $totalPO
                ]);
                return redirect('pemesanan/tambahItem/'.Converts::encrypt_decrypt('encrypt', $id_head))->with([
                    'status' => 'success',
                    'message' => 'Successfully'
                ]);
            }
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect('pemesanan/tambahItem/'.Converts::encrypt_decrypt('encrypt', $id_head))->with([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit_item_po($id)
    {
        $data = [
            'detail' => PurchaseOrderDetailModel::find($id),
            'list_item' => PartsModel::wherein('crud', ['I', 'U'])->orderby('oid_part')->get(),
        ];
        // dd($data);
        return view('po.edit_item', $data);
    }

    public function update_item_po(Request $request, $id)
    {
        $id_head =$request->id_head;
        try {
            $data = [
                'qty' => Converts::convert_money_to_double($request->inpQtyEdit),
                'harga_satuan' => Converts::convert_money_to_double($request->inpHargaEdit),
                'sub_total' => Converts::convert_money_to_double($request->inpSubTotalEdit),
            ];
            PurchaseOrderDetailModel::find($id)->update($data);
            $totalPO = PurchaseOrderDetailModel::where('id_head', $id_head)->sum('sub_total');
            PurchaseOrderModel::find($id_head)->update([
                'po_total' => $totalPO
            ]);
            return redirect('pemesanan/tambahItem/'.Converts::encrypt_decrypt('encrypt', $id_head))->with([
                'status' => 'success',
                'message' => 'Successfully'
            ]);
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect('pemesanan/tambahItem/'.Converts::encrypt_decrypt('encrypt', $id_head))->with([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_detail_po($id)
    {
        $brand = PurchaseOrderDetailModel::find($id);
        $brand->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function show($id)
    {
        $data = [
            'header' => PurchaseOrderModel::with([
                'getSupplier'
            ])->find($id),
            'detail' => PurchaseOrderDetailModel::with(['getParts', 'getParts.getSatuan'])->where('id_head', $id)->get()
        ];
        return view('po.detail', $data);
    }

    public function print($id)
    {
        $data = [
            'header' => PurchaseOrderModel::with([
                'getSupplier'
            ])->find($id),
            'detail' => PurchaseOrderDetailModel::with(['getParts', 'getParts.getSatuan'])->where('id_head', $id)->get()
        ];
        $pdf = Pdf::loadView('po.print', $data)->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    function roles_head($request)
    {
        $validate = Validator::make($request->all(), [
            'po_date' => 'required',
            'po_delivery_date' => 'required',
            'supplier_select' => 'required',
            'inp_remark' => 'required',
        ],[
            'po_date.required' => "PO Date cannot be empty!",
            'po_delivery_date.required' => "PO Delivery Date cannot be empty!",
            'supplier_select.required' => "Item Supplier cannot be empty!",
            'inp_remark.required' => "PO Remaks cannot be empty!",
        ]);
        return $validate;
    }

    function roles($request)
    {
        $validate = Validator::make($request->all(), [
            'selectItem' => 'required',
        ],[
            'selectItem.required' => "Item select cannot be empty!",
        ]);
        return $validate;
    }
}
