<?php

namespace App\Http\Controllers;

use App\Models\PartsModel;
use App\Models\PurchaseOrderModel;
use App\Models\SupplierModel;
use App\Traits\Converts;
use App\Traits\GenerateOid;
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
        $data = [
            'countUnit' => PartsModel::where('crud', '<>', 'D')->where('status', '<>', 'cancel')->get()->sum('saldo')
        ];
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
            $validated = $this->roles($request);
            if($validated->fails())
            {
                return redirect()->back()->withInput()->withErrors($validated);
            } else {
                $data = [
                    'po_number' => GenerateOid::genOid('po'),
                    'po_date' => $request->po_date,
                    'po_delivery_order' => $request->po_delivery_date,
                    'id_supplier' => $request->supplier_select,
                    'po_remark' => $request->inp_remark,
                    'user_at' => auth()->user()->id,
                    'created_at' => $this->dateTimeInsert
                ];
                $lastID = PurchaseOrderModel::insertGetId($data);

                return redirect('purchase_order/newItems', $lastID)->with([
                    'status' => 'success',
                    'message' => 'Successfully'
                ]);
            }
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('purchaseOrder.create')->with([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function new_items($id)
    {
        $data = [
            'main' => PurchaseOrderModel::find($id),
            'list_supplier' => SupplierModel::whereIn('crud', ['I', 'U'])->orderBy('oid_supplier')->get()
        ];
        return view('po.add_item', $data);
    }

    function roles($request)
    {
        $validate = Validator::make($request->all(), [
            'po_date' => 'required',
            'po_delivery_date' => 'required',
            'supplier_select' => 'required',
            'inp_remark' => 'required'
        ],[
            'po_date.required' => "PO Date cannot be empty!",
            'po_delivery_date.required' => "PO Delivery Date cannot be empty!",
            'supplier_select.required' => "PO Supplier cannot be empty!",
            'inp_remark.required' => "PO Remark cannot be empty!",
        ]);
        return $validate;
    }
}
