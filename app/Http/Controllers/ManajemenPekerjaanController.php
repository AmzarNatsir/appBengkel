<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaanModel;
use App\Models\PekerjaanModel;
use App\Traits\Converts;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ManajemenPekerjaanController extends Controller
{
    use Converts;
    protected $dateTimeInsert;

    function __construct()
    {
        $this->dateTimeInsert = date("Y-m-d H:s:i");
    }
    //kategori pekerjaan
    public function kategori_pekerjaan()
    {
        return view('manajemen.pekerjaan.kategori.index');
    }

    public function kategori_pekerjaan_data(Request $request) {
        $columns = ['created_at'];
        $totalData = KategoriPekerjaanModel::count();
        $search = $request->input('search.value');
        $query = KategoriPekerjaanModel::select('*');
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('kategori_pekerjaan', 'like', "%{$search}%");
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
                $btn = '<a class="btn btn-primary btn-sm" href="'.url('manajemen_pekerjaan/kategori_pekerjaan_edit',$r->id).'"><i class="fa fa-edit"></i></a>
                   <button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"><i class="fa fa-times"></i></button>';
                $Data['act'] = $btn;
                $Data['kategori_pekerjaan'] = $r->kategori_pekerjaan;
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
    public function kategori_pekerjaan_baru()
    {
        return view('manajemen.pekerjaan.kategori.baru');
    }
    public function kategori_pekerjaan_simpan(Request $request) {
        $validated = $this->roles_kategori_pekerjaan($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            KategoriPekerjaanModel  ::insert([
                "kategori_pekerjaan" => $request->kategori_pekerjaan,
                'user_at' => auth()->user()->id,
                'created_at' => $this->dateTimeInsert
            ]);
            return redirect()->route('manajemen_pekerjaan.kategori.baru')->with(['status' => 'Successfully']);
        }
    }
    public function kategori_pekerjaan_edit($id)
    {
        $data = [
            "res" => KategoriPekerjaanModel::find($id)
        ];
        return view('manajemen.pekerjaan.kategori.edit', $data);
    }
    public function kategori_pekerjaan_update(Request $request, $id)
    {
        $validated = $this->roles_kategori_pekerjaan($request);
        if($validated->fails())
        {
            return redirect()->back()->withInput()->withErrors($validated);
        } else {
            KategoriPekerjaanModel::find($id)->update([
                "kategori_pekerjaan" => $request->kategori_pekerjaan,
                'updated_at' => $this->dateTimeInsert
            ]);
            return redirect('manajemen_pekerjaan/kategori_pekerjaan_edit/'.$id)->with(['status' => 'Update Successfully']);
        }
    }

    public function kategori_pekerjaan_destroy($id)
    {
        $checkUsed = PekerjaanModel::where('kategori_id', $id)->get()->count();
        if($checkUsed==0) {
            $brand = KategoriPekerjaanModel::find($id);
            $brand->delete();
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    function roles_kategori_pekerjaan($request)
    {
        $validate = Validator::make($request->all(), [
            'kategori_pekerjaan' => 'required'
        ],[
            'kategori_pekerjaan.required' => "Kategori Pekerjaan tidak boleh kosong !"
        ]);
        return $validate;
    }

    //pekerjaan dan jasa
    public function pekerjaan()
    {
        return view('manajemen.pekerjaan.index');
    }

    public function pekerjaan_data(Request $request) {
        $columns = ['created_at'];
        $totalData = PekerjaanModel::count();
        $search = $request->input('search.value');
        $query = PekerjaanModel::with(['getKategoriPekerjaan']);
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('nama_pekerjaan', 'like', "%{$search}%");
            });
        }
        $totalFiltered = $query->count();
        $query = $query->offset($request->input('start'))
                      ->limit($request->input('length'))
                        ->orderBy('id', 'desc')
                      ->get();

        $data = array();
        if($query){
            $counter = $request->input('start') + 1;
            foreach($query as $r){
                $btn = '<a class="btn btn-primary btn-sm" href="'.url('manajemen_pekerjaan/pekerjaan_edit',$r->id).'"><i class="fa fa-edit"></i></a>';
                if($r->aktif==1) {
                    $btn .= '<button type="button" value='.$r->id.' class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"><i class="fa fa-times"></i></button>';
                }
                $Data['act'] = $btn;
                $Data['kategori_pekerjaan'] = $r->getKategoriPekerjaan->kategori_pekerjaan;
                $Data['nama_pekerjaan'] = $r->nama_pekerjaan;
                $Data['biaya'] = "Rp. ".number_format($r->biaya, 0);
                $Data['aktif'] = ($r->aktif==1) ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Tidak Aktif</span>";
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

    public function pekerjaan_baru()
    {
        $data = [
            "list_kategori_pekerjaan" => KategoriPekerjaanModel::latest()->get()
        ];
        return view('manajemen.pekerjaan.baru', $data);
    }

    public function pekerjaan_simpan(Request $request)
    {
        try {
            $validated = $this->roles_pekerjaan($request);
            if($validated->fails())
            {
                return redirect()->back()->withInput()->withErrors($validated);
            } else {
                PekerjaanModel  ::insert([
                    "kategori_id" => $request->kategori_pekerjaan,
                    "nama_pekerjaan" => $request->nama_pekerjaan,
                    "biaya" => Converts::convert_money_to_double($request->inp_jasa),
                    'user_at' => auth()->user()->id,
                    'created_at' => $this->dateTimeInsert
                ]);
                return redirect()->route('manajemen_pekerjaan.pekerjaan.baru')->with([
                    'status' => 'success',
                    'message' => 'Insert Data Successfully'
                    ]
                );
            }
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('manajemen_pekerjaan.pekerjaan.baru')->with([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function pekerjaan_edit($id)
    {
        $data = [
            "res" => PekerjaanModel::find($id),
            "list_kategori_pekerjaan" => KategoriPekerjaanModel::latest()->get()
        ];
        return view('manajemen.pekerjaan.edit', $data);
    }

    public function pekerjaan_update(Request $request, $id)
    {
        try {
            $validated = $this->roles_pekerjaan($request);
            if($validated->fails())
            {
                return redirect()->back()->withInput()->withErrors($validated);
            } else {
                $aktif = $request->tmp_aktif;
                if(isset($request->inp_aktif)) {
                    $aktif = 1;
                }
                PekerjaanModel::find($id)->update([
                    "kategori_id" => $request->kategori_pekerjaan,
                    "nama_pekerjaan" => $request->nama_pekerjaan,
                    "biaya" => Converts::convert_money_to_double($request->inp_jasa),
                    'aktif' => $aktif,
                    'updated_at' => $this->dateTimeInsert
                ]);
                return redirect('manajemen_pekerjaan/pekerjaan_edit/'.$id)->with([
                    'status' => 'Success',
                    'message' => 'Update Successfully'
                ]);
            }
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('manajemen_pekerjaan.pekerjaan.index')->with([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function pekerjaan_destroy($id)
    {
        PekerjaanModel::find($id)->update([
            'aktif' => 2, //tidak aktif
            'updated_at' => $this->dateTimeInsert
        ]);
        return response()->json([
            'success' => true
        ]);
    }

    function roles_pekerjaan($request)
    {
        $validate = Validator::make($request->all(), [
            'kategori_pekerjaan' => 'required',
            'nama_pekerjaan' => 'required'
        ],[
            'kategori_pekerjaan.required' => "Kategori Pekerjaan tidak boleh kosong !",
            'nama_pekerjaan.required' => "Nama Pekerjaan tidak boleh kosong !"
        ]);
        return $validate;
    }

    //tools
    public function autocomplete_pekerjaan(Request $request)
    {
        $query = $request->get('search');
        $results = PekerjaanModel::with([
            'getKategoriPekerjaan'
        ])
            ->where('aktif', 1)
            ->where('nama_pekerjaan', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(); // Adjust as needed
        $response = array();
        foreach($results as $list){
            $response[] = array(
                "value"=>$list->id,
                "label"=> "[".$list->nama_pekerjaan." | ".$list->getKategoriPekerjaan->kategori_pekerjaan."]",
                "pekerjaan" => $list->nama_pekerjaan,
                'kategori' => $list->getKategoriPekerjaan->kategori_pekerjaan,
                'biaya' => $list->biaya
            );
        }
        return response()
            ->json($response)
            ->withCallback($request->input('callback'));
    }

}
