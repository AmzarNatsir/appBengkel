<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Traits\GenerateOid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    use GenerateOid;
    protected $dateTimeInsert;

    function __construct()
    {
        $this->dateTimeInsert = date("Y-m-d H:s:i");
    }

    public function index()
    {
        return view('customer.index');
    }
    public function data(Request $request)
    {
        $columns = ['created_at'];
        $totalData = CustomerModel::count();
        $search = $request->input('search.value');
        $query = CustomerModel::select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('customer_name', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('customer/show',$r->id).'"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-primary btn-sm" href="'.url('customer/edit',$r->id).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> <i class="fa fa-times"></i></button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_customer'] =  $r->oid_customer;
                $Data['customer_name'] = $r->customer_name;
                $Data['customer_address'] = $r->customer_address;
                $Data['customer_email'] = $r->customer_email;
                $Data['customer_phone'] = $r->customer_phone;
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
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $validated = $this->roles($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            CustomerModel  ::insert([
                'oid_customer' => GenerateOid::genOid('customer'),
                "customer_name" => $request->customer_name,
                "customer_address" => $request->customer_address,
                "customer_email" => $request->customer_email,
                "customer_phone" => $request->customer_phone,
                'crud' => 'I',
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('customer.create')->with(['status' => 'Successfully']);
        }

    }
    public function show($id)
    {
        $data = CustomerModel::find($id);
        return view('customer.show', compact([
            'data'
        ]));
    }

    public function edit($id)
    {
        $data = [
            'data' => CustomerModel::find($id)
        ];
        return view('customer.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->roles($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            CustomerModel::find($id)->update([
                "customer_name" => $request->customer_name,
                "customer_address" => $request->customer_address,
                "customer_email" => $request->customer_email,
                "customer_phone" => $request->customer_phone,
                'crud' => 'U',
                'user_up' => auth()->user()->id,
                'updated_at' => $this->dateTimeInsert
            ]);
            return redirect('customer/edit/'.$id)->with(['status' => 'Update Successfully']);
        }
    }

    public function destroy($id)
    {
        $brand = CustomerModel::find($id);
        $brand->delete();
        return response()->json([
            'success' => true
        ]);
    }

    function roles($request)
    {
        $validate = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_address' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
        ],[
            'customer_name.required' => "Customer name cannot be empty!",
            'customer_address.required' => "Customer address cannot be empty!",
            'customer_email.required' => "Customer email cannot be empty!",
            'customer_phone.required' => "Customer phone number cannot be empty!",
        ]);
        return $validate;
    }
}
