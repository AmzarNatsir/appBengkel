<?php

namespace App\Http\Controllers;

use App\Models\common\BrandModel;
use App\Models\common\CCUnitModel;
use App\Models\common\ColorModel;
use App\Models\common\JenisModel;
use App\Models\common\ModelBrandModel;
use App\Models\common\SatuanModel;
use App\Models\common\TypeModel;
use App\Traits\GenerateOid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommonController extends Controller
{
    use GenerateOid;
    //
    protected $dateTimeInsert;

    function __construct()
    {
        $this->dateTimeInsert = date("Y-m-d H:s:i");
    }
    public function brand()
    {
        return view('common.brand.index');
    }

    public function brandData(Request $request)
    {
        $columns = ['created_at'];
        $totalData = BrandModel::count();
        $search = $request->input('search.value');
        $query = BrandModel::select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('brand_name', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('common/brandShow',$r->id).'">Show</a>
                  <a class="btn btn-primary btn-sm" href="'.url('common/brandEdit',$r->id).'">Edit</a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> Delete</button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_brand'] =  $r->oid_brand;
                $Data['brand_name'] = $r->brand_name;
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
    public function brandCreate()
    {
        return view('common.brand.create');
    }
    public function brandStore(Request $request)
    {
        $validated = $this->roles_brand($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            BrandModel  ::insert([
                'oid_brand' => GenerateOid::genOid('brand'),
                "brand_name" => $request->brand_name,
                'crud' => 'I',
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('brand.create')->with(['status' => 'Successfully']);
        }

    }
    public function brandShow($id)
    {
        $data = BrandModel::find($id);
        return view('common.brand.show', compact([
            'data'
        ]));
    }
    public function brandEdit($id)
    {
        $data = BrandModel::find($id);
        return view('common.brand.edit', compact([
            'data'
        ]));
    }
    public function brandUpdate(Request $request, $id)
    {
        $validated = $this->roles_brand($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            BrandModel::find($id)->update([
                "brand_name" => $request->brand_name
            ]);
            return redirect('common/brandEdit/'.$id)->with(['status' => 'Update Successfully']);
        }
    }
    public function brandDestroy($id)
    {
        $brand = BrandModel::find($id);
        $brand->delete();
        return response()->json([
            'success' => true
        ]);
    }

    function roles_brand($request)
    {
        $validate = Validator::make($request->all(), [
            'brand_name' => 'required'
        ],[
            'brand_name.required' => "Brand name cannot be empty!"
        ]);
        return $validate;
    }

    public function jsonBrand(Request $request)
    {
        $term = trim($request->q);

        $brand = BrandModel::where('brand_name', 'LIKE', '%'.$term.'%')
        ->get(['oid_brand', 'brand_name as text']);
        return ['results' => $brand];
    }

    //common model brand
    public function model()
    {
        return view('common.model.index');
    }
    public function modelData(Request $request)
    {
        $columns = ['created_at'];
        $totalData = ModelBrandModel::count();
        $search = $request->input('search.value');
        $query = ModelBrandModel::with([
            'getBrand'
        ])->select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('model_name', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('common/modelShow',$r->id).'">Show</a>
                  <a class="btn btn-primary btn-sm" href="'.url('common/modelEdit',$r->id).'">Edit</a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> Delete</button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_model'] =  $r->oid_model;
                $Data['model_name'] = $r->model_name;
                $Data['brand_name'] = $r->getBrand->brand_name;
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
    public function modelCreate()
    {
        $data = [
            'listBrand' => BrandModel::whereNotIn('crud', ['D'])->orderby('oid_brand')->get()
        ];
        return view('common.model.create', $data);
    }

    public function modelStore(Request $request)
    {
        $validated = $this->roles_model($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            ModelBrandModel  ::insert([
                'oid_model' => GenerateOid::genOid('model'),
                'oid_brand' => $request->brand_select,
                "model_name" => $request->model_name,
                'crud' => 'I',
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('model.create')->with(['status' => 'Successfully']);
        }
    }
    public function modelShow($id)
    {
        $data = ModelBrandModel::with([
            'getBrand'
        ])->find($id);
        return view('common.model.show', compact([
            'data'
        ]));
    }

    public function modelEdit($id)
    {
        $data = [
            'data' => ModelBrandModel::find($id),
            'listBrand' => BrandModel::whereNotIn('crud', ['D'])->orderby('oid_brand')->get()
        ];
        return view('common.model.edit', $data);
    }
    public function modelUpdate(Request $request, $id)
    {
        $validated = $this->roles_model($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            ModelBrandModel::find($id)->update([
                'oid_brand' => $request->brand_select,
                "model_name" => $request->model_name,
                'crud' => 'U',
                'updated_at' => $this->dateTimeInsert
            ]);
            return redirect('common/modelEdit/'.$id)->with(['status' => 'Update Successfully']);
        }
    }
    public function modelDestroy($id)
    {
        $model = ModelBrandModel::find($id);
        $model->delete();
        return response()->json([
            'success' => true
        ]);
    }

    function roles_model($request)
    {
        $validate = Validator::make($request->all(), [
            'model_name' => 'required',
            'brand_select' => 'required',
        ],[
            'model_name.required' => "Model name cannot be empty!",
            'brand_select.required' => "Brand cannot be empty!"
        ]);
        return $validate;
    }
    public function jsonModel(Request $request)
    {
        $term = trim($request->id);
        // dd($term);

        // $jabatan =  ModelBrandModel::where('oid_brand', $term)->get(['oid_model', 'model_name']);
        // return response()->json([
        //     'results' => $jabatan
        // ]);

        $brand = ModelBrandModel::where('oid_brand', $term)
        ->get(['oid_model', 'model_name as text']);
        return ['results' => $brand];

    }

    //common type
    public function type()
    {
        return view('common.type.index');
    }
    public function typeData(Request $request)
    {
        $columns = ['created_at'];
        $totalData = TypeModel::count();
        $search = $request->input('search.value');
        $query = TypeModel::with([
            'getBrand',
            'getModel'
        ])->select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('type_name', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('common/typeShow',$r->id).'"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-primary btn-sm" href="'.url('common/typeEdit',$r->id).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"><i class="fa fa-times"></i></button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_type'] =  $r->oid_type;
                $Data['type_name'] = $r->type_name;
                $Data['model_name'] = $r->getModel->model_name;
                $Data['brand_name'] = $r->getBrand->brand_name;
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
    public function typeCreate()
    {
        $data = [
            'listBrand' => BrandModel::whereNotIn('crud', ['D'])->orderby('oid_brand')->get()
        ];
        return view('common.type.create', $data);
    }

    public function typeStore(Request $request)
    {
        $validated = $this->roles_type($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            TypeModel::insert([
                'oid_type' => GenerateOid::genOid('type'),
                "type_name" => $request->type_name,
                'oid_brand' => $request->brand_select,
                'oid_model' => $request->model_select,
                'crud' => 'I',
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('type.create')->with(['status' => 'Successfully']);
        }
    }
    public function typeShow($id)
    {
        $data = TypeModel::with([
            'getBrand',
            'getModel'
        ])->find($id);
        return view('common.type.show', compact([
            'data'
        ]));
    }

    public function typeEdit($id)
    {
        $main = TypeModel::find($id);
        $data = [
            'data' => $main,
            'listBrand' => BrandModel::whereNotIn('crud', ['D'])->orderby('oid_brand')->get(),
            'listModel' => ModelBrandModel::whereNotIn('crud', ['D'])->where('oid_model', $main->oid_model)->orderby('oid_model')->get()
        ];
        return view('common.type.edit', $data);
    }
    public function typeUpdate(Request $request, $id)
    {
        $validated = $this->roles_type($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            TypeModel::find($id)->update([
                "type_name" => $request->type_name,
                'oid_brand' => $request->brand_select,
                'oid_model' => $request->model_select,
                "model_name" => $request->model_name,
                'crud' => 'U',
                'updated_at' => $this->dateTimeInsert
            ]);
            return redirect('common/typeEdit/'.$id)->with(['status' => 'Update Successfully']);
        }
    }
    public function typeDestroy($id)
    {
        $model = TypeModel::find($id);
        $model->delete();
        return response()->json([
            'success' => true
        ]);
    }

    function roles_type($request)
    {
        $validate = Validator::make($request->all(), [
            'type_name' => 'required',
            'brand_select' => 'required',
            'model_select' => 'required',
        ],[
            'type_name.required' => "Tye name cannot be empty!",
            'brand_select.required' => "Brand cannot be empty!",
            'model_select.required' => "Model cannot be empty!"
        ]);
        return $validate;
    }

    //common CC Unit
    public function ccunit()
    {
        return view('common.ccunit.index');
    }

    public function ccunitData(Request $request)
    {
        $columns = ['created_at'];
        $totalData = CCUnitModel::count();
        $search = $request->input('search.value');
        $query = CCUnitModel::select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('cc_unit', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('common/ccunitShow',$r->id).'"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-primary btn-sm" href="'.url('common/bccunitEdit',$r->id).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> <i class="fa fa-times"></i></button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_ccunit'] =  $r->oid_ccunit;
                $Data['cc_unit'] = $r->cc_unit;
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
    public function ccunitCreate()
    {
        return view('common.ccunit.create');
    }
    public function ccunitStore(Request $request)
    {
        $validated = $this->roles_ccunit($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            CCUnitModel  ::insert([
                'oid_ccunit' => GenerateOid::genOid('cc_unit'),
                "cc_unit" => $request->cc_unit,
                'crud' => 'I',
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('ccunit.create')->with(['status' => 'Successfully']);
        }

    }
    public function ccunitShow($id)
    {
        $data = CCUnitModel::find($id);
        return view('common.ccunit.show', compact([
            'data'
        ]));
    }
    public function ccunitEdit($id)
    {
        $data = CCUnitModel::find($id);
        return view('common.ccunit.edit', compact([
            'data'
        ]));
    }
    public function ccunitUpdate(Request $request, $id)
    {
        $validated = $this->roles_ccunit($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            CCUnitModel::find($id)->update([
                "cc_unit" => $request->cc_unit
            ]);
            return redirect('common/ccunitEdit/'.$id)->with(['status' => 'Update Successfully']);
        }
    }
    public function ccunitDestroy($id)
    {
        $brand = CCUnitModel::find($id);
        $brand->delete();
        return response()->json([
            'success' => true
        ]);
    }

    function roles_ccunit($request)
    {
        $validate = Validator::make($request->all(), [
            'cc_unit' => 'required'
        ],[
            'cc_unit.required' => "CC Unit cannot be empty!"
        ]);
        return $validate;
    }

    //common Color
    public function color()
    {
        return view('common.color.index');
    }

    public function colorData(Request $request)
    {
        $columns = ['created_at'];
        $totalData = ColorModel::count();
        $search = $request->input('search.value');
        $query = ColorModel::select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('color_idn', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('common/colorShow',$r->id).'"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-primary btn-sm" href="'.url('common/colorEdit',$r->id).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> <i class="fa fa-times"></i></button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_color'] =  $r->oid_color;
                $Data['color_idn'] = $r->color_idn;
                $Data['color_eng'] = $r->color_eng;
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
    public function colorCreate()
    {
        return view('common.color.create');
    }
    public function colorStore(Request $request)
    {
        $validated = $this->roles_color($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            ColorModel  ::insert([
                'oid_color' => GenerateOid::genOid('color'),
                "color_idn" => $request->color_idn,
                "color_eng" => $request->color_eng,
                'crud' => 'I',
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('color.create')->with(['status' => 'Successfully']);
        }

    }
    public function colorShow($id)
    {
        $data = ColorModel::find($id);
        return view('common.color.show', compact([
            'data'
        ]));
    }
    public function colorEdit($id)
    {
        $data = ColorModel::find($id);
        return view('common.color.edit', compact([
            'data'
        ]));
    }
    public function colorUpdate(Request $request, $id)
    {
        $validated = $this->roles_color($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            ColorModel::find($id)->update([
                "color_idn" => $request->color_idn,
                "color_eng" => $request->color_eng
            ]);
            return redirect('common/colorEdit/'.$id)->with(['status' => 'Update Successfully']);
        }
    }
    public function colorDestroy($id)
    {
        $brand = ColorModel::find($id);
        $brand->delete();
        return response()->json([
            'success' => true
        ]);
    }

    function roles_color($request)
    {
        $validate = Validator::make($request->all(), [
            'color_idn' => 'required',
            'color_eng' => 'required'
        ],[
            'color_idn.required' => "Color Indonesia cannot be empty!",
            'color_eng.required' => "Color English cannot be empty!",
        ]);
        return $validate;
    }

    //common jenis
    public function jenis()
    {
        return view('common.jenis.index');
    }

    public function jenisData(Request $request)
    {
        $columns = ['created_at'];
        $totalData = JenisModel::count();
        $search = $request->input('search.value');
        $query = JenisModel::select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('jenis', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('common/jenisShow',$r->id).'"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-primary btn-sm" href="'.url('common/jenisEdit',$r->id).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> <i class="fa fa-times"></i></button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_jenis'] =  $r->oid_jenis;
                $Data['jenis'] = $r->jenis;
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
    public function jenisCreate()
    {
        return view('common.jenis.create');
    }
    public function jenisStore(Request $request)
    {
        $validated = $this->roles_jenis($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            JenisModel  ::insert([
                'oid_jenis' => GenerateOid::genOid('jenis'),
                "jenis" => $request->jenis,
                'crud' => 'I',
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('jenis.create')->with(['status' => 'Successfully']);
        }

    }
    public function jenisShow($id)
    {
        $data = JenisModel::find($id);
        return view('common.jenis.show', compact([
            'data'
        ]));
    }
    public function jenisEdit($id)
    {
        $data = JenisModel::find($id);
        return view('common.jenis.edit', compact([
            'data'
        ]));
    }
    public function jenisUpdate(Request $request, $id)
    {
        $validated = $this->roles_jenis($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            JenisModel::find($id)->update([
                "jenis" => $request->jenis,
            ]);
            return redirect('common/jenisEdit/'.$id)->with(['status' => 'Update Successfully']);
        }
    }
    public function jenisDestroy($id)
    {
        $brand = JenisModel::find($id);
        $brand->delete();
        return response()->json([
            'success' => true
        ]);
    }

    function roles_jenis($request)
    {
        $validate = Validator::make($request->all(), [
            'jenis' => 'required'
        ],[
            'jenis.required' => "Jenis cannot be empty!"
        ]);
        return $validate;
    }

    //common satuan
    public function satuan()
    {
        return view('common.satuan.index');
    }

    public function satuanData(Request $request)
    {
        $columns = ['created_at'];
        $totalData = SatuanModel::count();
        $search = $request->input('search.value');
        $query = SatuanModel::select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('satuan', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('common/satuanShow',$r->id).'"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-primary btn-sm" href="'.url('common/satuanEdit',$r->id).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> <i class="fa fa-times"></i></button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_satuan'] =  $r->oid_satuan;
                $Data['satuan'] = $r->satuan;
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
    public function satuanCreate()
    {
        return view('common.satuan.create');
    }
    public function satuanStore(Request $request)
    {
        $validated = $this->roles_satuan($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            SatuanModel  ::insert([
                'oid_satuan' => GenerateOid::genOid('satuan'),
                "satuan" => $request->satuan,
                'crud' => 'I',
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('satuan.create')->with(['status' => 'Successfully']);
        }

    }
    public function satuanShow($id)
    {
        $data = SatuanModel::find($id);
        return view('common.satuan.show', compact([
            'data'
        ]));
    }
    public function satuanEdit($id)
    {
        $data = SatuanModel::find($id);
        return view('common.satuan.edit', compact([
            'data'
        ]));
    }
    public function satuanUpdate(Request $request, $id)
    {
        $validated = $this->roles_satuan($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            SatuanModel::find($id)->update([
                "satuan" => $request->satuan,
            ]);
            return redirect('common/satuanEdit/'.$id)->with(['status' => 'Update Successfully']);
        }
    }
    public function satuanDestroy($id)
    {
        $brand = SatuanModel::find($id);
        $brand->delete();
        return response()->json([
            'success' => true
        ]);
    }

    function roles_satuan($request)
    {
        $validate = Validator::make($request->all(), [
            'satuan' => 'required'
        ],[
            'satuan.required' => "Satuan cannot be empty!"
        ]);
        return $validate;
    }
}
