<?php

namespace App\Http\Controllers;

use App\Models\common\BrandModel;
use App\Models\common\JenisModel;
use App\Models\common\SatuanModel;
use App\Models\PartsModel;
use App\Models\RakModel;
use App\Models\ReceiveDetailModel;
use App\Models\ServicePartsModel;
use App\Traits\Converts;
use App\Traits\GenerateOid;
use App\Traits\HasUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PartsController extends Controller
{
    use GenerateOid;
    use Converts;
    use HasUpload;
    protected $dateTimeInsert;

    function __construct()
    {
        $this->dateTimeInsert = date("Y-m-d H:s:i");
    }

    public function index()
    {
        return view('parts.index');
    }

    public function data(Request $request)
    {
        $columns = ['created_at'];
        $totalData = PartsModel::count();
        $search = $request->input('search.value');
        $query = PartsModel::with([
            'getSatuan',
            'getJenis',
            'getBrand',
            'getRak'
        ])->select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('part_name', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-success btn-sm" href="'.url('manajemen_stok/show',$r->id).'"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-primary btn-sm" href="'.url('manajemen_stok/edit',$r->id).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"> <i class="fa fa-times"></i></button>';
                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['oid_part'] =  $r->oid_part;
                $Data['part_name'] = $r->part_name;
                $Data['satuan'] = $r->getSatuan->satuan;
                $Data['jenis'] = $r->getJenis->jenis;
                $Data['brand'] = $r->getBrand->brand_name;
                $Data['rak'] = (empty($r->id_rak)) ? "" : $r->getRak->nama_rak;
                $Data['stok'] = $r->stok_akhir;
                $Data['harga_beli'] = "Rp. ".Converts::conver_double_to_money($r->harga_beli);
                $Data['harga_jual'] = "Rp. ".Converts::conver_double_to_money($r->harga_jual);
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
        $data = [
            'list_satuan' => SatuanModel::whereIn('crud', ['I', 'U'])->orderBy('oid_satuan')->get(),
            'list_jenis' => JenisModel::whereIn('crud', ['I', 'U'])->orderBy('oid_jenis')->get(),
            'list_brand' => BrandModel::whereIn('crud', ['I', 'U'])->orderBy('oid_brand')->get(),
            'list_rak' => RakModel::latest()->get()
        ];
        return view('parts.create', $data);
    }
    public function store(Request $request)
    {
        try {
            $validated = $this->roles($request);
            if($validated->fails())
            {
                return redirect()->back()->withInput()->withErrors($validated);
            } else {
                $filePart = NULL;
                if($request->hasFile('inpFileImage'))
                {
                    $path = storage_path("app/public/parts");
                    $storepath = "public/parts";
                    $filePart = HasUpload::uploadImage($request, $path, $storepath, 'parts');
                }
                $data = [
                    'oid_part' => GenerateOid::genOid('part'),
                    'part_name' => $request->part_name,
                    'id_satuan' => $request->satuan_select,
                    'id_jenis' => $request->jenis_select,
                    'id_brand' => $request->brand_select,
                    'id_rak' => $request->rak_select,
                    'stok_awal' => Converts::convert_money_to_double($request->inp_stok_awal),
                    'stok_akhir' => Converts::convert_money_to_double($request->inp_stok_akhir),
                    'harga_beli' => Converts::convert_money_to_double($request->inp_harga_beli),
                    'harga_jual' => Converts::convert_money_to_double($request->inp_harga_jual),
                    'stok_awal' => $request->inp_stok_awal,
                    'deskripsi' => $request->inpDeskripsi,
                    'gambar' => $filePart,
                    'crud' => "I",
                    'user_at' => auth()->user()->id,
                    'created_at' => $this->dateTimeInsert
                ];
                PartsModel::insert($data);
                return redirect()->route('manajemen_stok.stok.create')->with([
                    'status' => 'success',
                    'message' => 'Successfully'
                ]);
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return redirect()->route('manajemen_stok.stok.create')->with([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function show($id)
    {
        $data = [
            'main' => PartsModel::find($id),
            'list_satuan' => SatuanModel::whereIn('crud', ['I', 'U'])->orderBy('oid_satuan')->get(),
            'list_jenis' => JenisModel::whereIn('crud', ['I', 'U'])->orderBy('oid_jenis')->get(),
            'list_brand' => BrandModel::whereIn('crud', ['I', 'U'])->orderBy('oid_brand')->get(),
            'list_rak' => RakModel::latest()->get()
        ];
        return view('parts.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'main' => PartsModel::find($id),
            'list_satuan' => SatuanModel::whereIn('crud', ['I', 'U'])->orderBy('oid_satuan')->get(),
            'list_jenis' => JenisModel::whereIn('crud', ['I', 'U'])->orderBy('oid_jenis')->get(),
            'list_brand' => BrandModel::whereIn('crud', ['I', 'U'])->orderBy('oid_brand')->get(),
            'list_rak' => RakModel::latest()->get()
        ];
        return view('parts.edit', $data);
    }
    public function update(Request $request, $id)
    {
        try {
            $validated = $this->roles($request);
            if($validated->fails())
            {
                return redirect()->back()->withInput()->withErrors($validated);
            } else {
                $filePart = $request->tempFileImage;
                if($request->hasFile('inpFileImage'))
                {
                    if(!empty($request->tempFileImage)) {
                        $this->del_image_folder($id);
                    }
                    $path = storage_path("app/public/parts");
                    $storepath = "public/parts";
                    $filePart = HasUpload::uploadImage($request, $path, $storepath, 'parts');
                }

                $data = [
                    'part_name' => $request->part_name,
                    'id_satuan' => $request->satuan_select,
                    'id_jenis' => $request->jenis_select,
                    'id_brand' => $request->brand_select,
                    'id_rak' => $request->rak_select,
                    'stok_awal' => Converts::convert_money_to_double($request->inp_stok_awal),
                    'stok_akhir' => Converts::convert_money_to_double($request->inp_stok_akhir),
                    'harga_beli' => Converts::convert_money_to_double($request->inp_harga_beli),
                    'harga_jual' => Converts::convert_money_to_double($request->inp_harga_jual),
                    'stok_awal' => $request->inp_stok_awal,
                    'deskripsi' => $request->inpDeskripsi,
                    'gambar' => $filePart,
                    'crud' => "U",
                    'user_up' => auth()->user()->id,
                    'updated_at' => $this->dateTimeInsert
                ];
                PartsModel::find($id)->update($data);
                return redirect()->route('manajemen_stok.stok.index')->with([
                    'status' => 'success',
                    'message' => 'Successfully'
                ]);
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return redirect()->route('manajemen_stok.stok.index')->with([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        $brand = PartsModel::find($id);
        $brand->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function del_image_folder($id)
    {
        $resfile = PartsModel::where('id', $id)->first();
        $filename = $resfile->gambar;
        $image_path = storage_path('app/public/parts/'.$filename);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }

    function roles($request)
    {
        $validate = Validator::make($request->all(), [
            'part_name' => 'required',
            'satuan_select' => 'required',
            'jenis_select' => 'required',
            'brand_select' => 'required',
            'rak_select' => 'required'
        ],[
            'part_name.required' => "Nama part tidak boleh kosong!",
            'satuan_select.required' => "Satuan tidak boleh kosong!",
            'jenis_select.required' => "Jenis tidak boleh kosong!",
            'brand_select.required' => "Brand tidak boleh kosong!",
            'rak_select.required' => "Rak tidak boleh kosong!",
        ]);
        return $validate;
    }

    //tools
    public function autocomplete_parts(Request $request)
    {
        $query = $request->get('search');
        $results = PartsModel::with([
            'getSatuan'
        ])
            ->where('part_name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(); // Adjust as needed
        $response = array();
        foreach($results as $list){
            $response[] = array(
                "value"=>$list->id,
                "label"=> "[".$list->oid_part." | ".$list->part_name." | Stok : ".$list->stok_akhir."]",
                "part_name" => $list->part_name,
                'stok_akhir' => $list->stok_akhir,
                'harga_jual' => $list->harga_jual,
                'satuan' => $list->getSatuan->satuan,
                'gambar' => $list->gambar
            );
        }
        return response()
            ->json($response)
            ->withCallback($request->input('callback'));
    }
    public function parts_autocomplete_stock_card(Request $request)
    {
        $query = $request->get('search');
        $results = PartsModel::with([
            'getSatuan'
        ])
            ->where('part_name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(); // Adjust as needed
        $response = array();
        foreach($results as $list){
            $response[] = array(
                "value"=>$list->id,
                "label"=> "[".$list->oid_part." | ".$list->part_name."]",
                "part_name" => $list->part_name,
                'stok_awal' => $list->stok_awal,
                'stok_akhir' => $list->stok_akhir,
                'satuan' => $list->getSatuan->satuan,
                'gambar' => $list->gambar,
                'total_masuk' => ReceiveDetailModel::where('id_part', $list->id)->get()->sum('terima'),
                'total_keluar' => ServicePartsModel::where('part_id', $list->id)->get()->sum('jumlah')
            );
        }

        // dd($response);
        return response()
            ->json($response)
            ->withCallback($request->input('callback'));
    }

    //kartu stok
    public function kartu_stok()
    {
        return view('parts.kartu_stok.index');
    }
}
