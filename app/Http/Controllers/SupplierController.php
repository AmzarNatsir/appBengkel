<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use App\Traits\GenerateOid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    use GenerateOid;
    protected $dateTimeInsert;

    function __construct()
    {
        $this->dateTimeInsert = date("Y-m-d H:s:i");
    }

    public function index()
    {
        return view('supplier.index');
    }
    public function data(Request $request)
    {
        $columns = ['created_at'];
        $totalData = SupplierModel::count();
        $search = $request->input('search.value');
        $query = SupplierModel::select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('supplier_name', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('supplier/show',$r->id).'"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-primary btn-sm" href="'.url('supplier/edit',$r->id).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> <i class="fa fa-times"></i></button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_supplier'] =  $r->oid_supplier;
                $Data['supplier_name'] = $r->supplier_name;
                $Data['supplier_address'] = $r->supplier_address;
                $Data['supplier_email'] = $r->supplier_email;
                $Data['supplier_phone'] = $r->supplier_phone;
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
    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $validated = $this->roles($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            SupplierModel  ::insert([
                'oid_supplier' => GenerateOid::genOid('supplier'),
                "supplier_name" => $request->supplier_name,
                "supplier_address" => $request->supplier_address,
                "supplier_email" => $request->supplier_email,
                "supplier_phone" => $request->supplier_phone,
                'crud' => 'I',
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('supplier.create')->with(['status' => 'Successfully']);
        }

    }
    public function show($id)
    {
        $data = SupplierModel::find($id);
        return view('supplier.show', compact([
            'data'
        ]));
    }

    public function edit($id)
    {
        $data = [
            'data' => SupplierModel::find($id)
        ];
        return view('supplier.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->roles($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            SupplierModel::find($id)->update([
                "supplier_name" => $request->supplier_name,
                "supplier_address" => $request->supplier_address,
                "supplier_email" => $request->supplier_email,
                "supplier_phone" => $request->supplier_phone,
                'crud' => 'U',
                'user_up' => auth()->user()->id,
                'updated_at' => $this->dateTimeInsert
            ]);
            return redirect('supplier/edit/'.$id)->with(['status' => 'Update Successfully']);
        }
    }

    public function destroy($id)
    {
        $brand = SupplierModel::find($id);
        $brand->delete();
        return response()->json([
            'success' => true
        ]);
    }

    function roles($request)
    {
        $validate = Validator::make($request->all(), [
            'supplier_name' => 'required',
            'supplier_address' => 'required',
            'supplier_email' => 'required',
            'supplier_phone' => 'required',
        ],[
            'supplier_name.required' => "Supplier name cannot be empty!",
            'supplier_address.required' => "Supplier address cannot be empty!",
            'supplier_email.required' => "Supplier email cannot be empty!",
            'supplier_phone.required' => "Supplier phone number cannot be empty!",
        ]);
        return $validate;
    }
}
