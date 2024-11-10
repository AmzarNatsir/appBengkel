<?php

namespace App\Http\Controllers;

use App\Models\common\ColorModel;
use App\Models\common\JenisModel;
use App\Models\common\TypeModel;
use App\Models\CustomerModel;
use App\Models\VehicleModel;
use App\Traits\GenerateOid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    use GenerateOid;
    protected $dateTimeInsert;

    function __construct()
    {
        $this->dateTimeInsert = date("Y-m-d H:s:i");
    }

    public function index()
    {
        return view('vehicle.index');
    }
    public function data(Request $request)
    {
        $columns = ['created_at'];
        $totalData = VehicleModel::count();
        $search = $request->input('search.value');
        $query = VehicleModel::with([
            'getType',
            'getType.getBrand',
            'getType.getModel',
            'getJenis',
            'getColor',
            'getCustomer'
        ])->select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('plat_number', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('vehicle/show',$r->id).'"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-primary btn-sm" href="'.url('vehicle/edit',$r->id).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> <i class="fa fa-times"></i></button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_vehicle'] =  $r->oid_vehicle;
                $Data['plat_number'] = $r->plat_number;
                $Data['unit'] = $r->getType->getBrand->brand_name." ".$r->getType->getModel->model_name." ".$r->getType->type_name;
                $Data['jenis'] = $r->getJenis->jenis;
                $Data['color'] = $r->getColor->color_idn;
                $Data['year'] = $r->year;
                $Data['customer'] = $r->getCustomer->customer_name;
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
        $year_start = "1990";
        $year_end = date("Y");
        $data = [
            'listType' => TypeModel::with([
                'getBrand',
                'getModel'
            ])->whereNotIn('crud', ['D'])->orderby('oid_type')->get(),
            'listColor' => ColorModel::whereNotIn('crud', ['D'])->orderby('oid_color')->get(),
            'listJenis' => JenisModel::whereNotIn('crud', ['D'])->orderby('oid_jenis')->get(),
            'listCustomer' => CustomerModel::whereNotIn('crud', ['D'])->orderby('oid_customer')->get(),
            'startYear' => $year_start,
            'endYear' => $year_end
        ];
        return view('vehicle.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $this->roles($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            $type_unit = TypeModel::where('oid_type', $request->type_select)->first();
            VehicleModel  ::insert([
                'oid_vehicle' => GenerateOid::genOid('vehicle'),
                "plat_number" => $request->plat_number,
                "oid_type" => $request->type_select,
                "oid_brand" => $type_unit->oid_brand,
                "oid_model" => $type_unit->oid_model,
                "oid_jenis" => $request->jenis_select,
                "oid_color" => $request->color_select,
                "oid_customer" => $request->customer_select,
                "year" => $request->year_unit,
                'crud' => 'I',
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('vehicle.create')->with(['status' => 'Successfully']);
        }

    }

    public function edit($id)
    {
        $year_start = "1990";
        $year_end = date("Y");
        $data = [
            'vehicle' => VehicleModel::find($id),
            'listType' => TypeModel::with([
                'getBrand',
                'getModel'
            ])->whereNotIn('crud', ['D'])->orderby('oid_type')->get(),
            'listColor' => ColorModel::whereNotIn('crud', ['D'])->orderby('oid_color')->get(),
            'listJenis' => JenisModel::whereNotIn('crud', ['D'])->orderby('oid_jenis')->get(),
            'listCustomer' => CustomerModel::whereNotIn('crud', ['D'])->orderby('oid_customer')->get(),
            'startYear' => $year_start,
            'endYear' => $year_end
        ];
        return view('vehicle.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->roles($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            $type_unit = TypeModel::where('oid_type', $request->type_select)->first();
            VehicleModel::find($id)->update([
                "plat_number" => $request->plat_number,
                "oid_type" => $request->type_select,
                "oid_brand" => $type_unit->oid_brand,
                "oid_model" => $type_unit->oid_model,
                "oid_jenis" => $request->jenis_select,
                "oid_color" => $request->color_select,
                "oid_customer" => $request->customer_select,
                "year" => $request->year_unit,
                'crud' => 'U',
                'user_up' => auth()->user()->id,
                'updated_at' => $this->dateTimeInsert
            ]);
            return redirect('vehicle/edit/'.$id)->with(['status' => 'Successfully']);
        }
    }

    public function destroy($id)
    {
        $model = VehicleModel::find($id);
        $model->delete();
        return response()->json([
            'success' => true
        ]);
    }

    function roles($request)
    {
        $validate = Validator::make($request->all(), [
            'plat_number' => 'required',
            'type_select' => 'required',
            'year_unit' => 'required',
            'color_select' => 'required',
            'jenis_select' => 'required',
            'customer_select' => 'required',
        ],[
            'plat_number.required' => "The Plat Number Unit cannot be empty!",
            'type_select.required' => "Then unit selection cannot be empty!",
            'year_unit.required' => "The unit year cannot be empty!",
            'color_select.required' => "The unit color cannot be empty!",
            'jenis_select.required' => "The jenis unit cannot be empty!",
            'customer_select.required' => "The Customer cannot be empty!",
        ]);
        return $validate;
    }
}
