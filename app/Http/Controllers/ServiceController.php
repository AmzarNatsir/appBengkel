<?php

namespace App\Http\Controllers;

use App\Models\common\TypeModel;
use App\Models\PartsModel;
use App\Models\ServiceModel;
use App\Models\ServicePartsModel;
use App\Models\ServicePekerjaanModel;
use App\Models\VehicleModel;
use App\Traits\Converts;
use App\Traits\GenerateOid;
use App\Traits\GetData;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class ServiceController extends Controller
{
    use GenerateOid;
    use Converts;
    use GetData;

    protected $dateTimeInsert;

    function __construct()
    {
        $this->dateTimeInsert = date("Y-m-d H:s:i");
    }

    //add
    public function baru()
    {
        $data = [
            'unit' =>  VehicleModel::with([
                'getType',
                'getType.getBrand',
                'getType.getModel'
            ])->whereIn('crud', ["I", "U"])->get()
        ];
        return view('service.create', $data);
    }

    public function getUnitCustomer(Request $request)
    {
        $customer = VehicleModel::with([
            'getCustomer'
        ])->find($request->id);
        return response()->json([
            'result' => $customer->getCustomer->customer_name
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->roles_head($request);
            if($validated->fails())
            {
                return redirect()->back()->withInput()->withErrors($validated);
            } else {
                // dd($request);
                //store head service
                $headService = [
                    'tgl_service' => $request->tgl_service,
                    'no_service' => GenerateOid::genOid('sales'),
                    'unit_id' => $request->unit_select,
                    'cara_bayar' => $request->cara_bayar,
                    'deskripsi' => $request->inp_deskripsi,
                    'total_pekerjaan' => Converts::convert_money_to_double($request->inp_total_pekerjaan),
                    'total_parts' => Converts::convert_money_to_double($request->inp_total_parts),
                    'total_pekerjaa_parts' => Converts::convert_money_to_double($request->inp_total_a_b),
                    'diskon' => Converts::convert_money_to_double($request->inp_diskon),
                    'ppn_persen' => Converts::convert_money_to_double($request->inp_ppn_persen),
                    'ppn_rupiah' => Converts::convert_money_to_double($request->inp_ppn_rupiah),
                    'total_net' => Converts::convert_money_to_double($request->inp_total_net),
                    'user_at' => auth()->user()->id,
                    'created_at' => $this->dateTimeInsert,
                ];
                $serviceID = ServiceModel::insertGetId($headService);
                foreach(array($request) as $key => $value)
                {
                    //store pekerjaan
                    if(isset($request->id_row_jasa)) {
                        for($i=0; $i < count($request->id_row_jasa); $i++)
                        {
                            ServicePekerjaanModel::create([
                                'service_id' => $serviceID,
                                'pekerjaan_id' => $value['item_id_jasa'][$i],
                                'biaya' => Converts::convert_money_to_double($value['biaya_jasa'][$i])
                            ]);
                        }
                    }
                }
                foreach(array($request) as $key => $value)
                {
                    //store parts
                    if(isset($request->id_row_part)) {
                        for($p=0; $p < count($request->id_row_part); $p++)
                        {
                            ServicePartsModel::create([
                                'service_id' => $serviceID,
                                'part_id' => $value['part_id'][$p],
                                'jumlah' => Converts::convert_money_to_double($value['part_qty'][$p]),
                                'harga' => Converts::convert_money_to_double($value['harga_satuan'][$p]),
                                'sub_total' => Converts::convert_money_to_double($value['part_sub_total'][$p])
                            ]);
                            $update_part = PartsModel::find($value['part_id'][$p]);
                            $update_part->stok_akhir -= Converts::convert_money_to_double($value['part_qty'][$p]);
                            $update_part->update();
                        }
                    }
                }
                return redirect()->route('service.baru')->with([
                    'status' => 'success',
                    'message' => 'Successfully'
                ]);
            }
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('service.baru')->with([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    function roles_head($request)
    {
        $validate = Validator::make($request->all(), [
            'tgl_service' => 'required',
            'unit_select' => 'required',
            'inp_deskripsi' => 'required'
        ],[
            'tgl_service.required' => "Tanggal service tidak boleh kosong!",
            'unit_select.required' => "Pilihan unit tidak boleh kosong!",
            'inp_deskripsi.required' => "Keterangan service tidak boleh kosong!"
        ]);
        return $validate;
    }

    //daftar
    public function daftar()
    {
        return view('service.list');
    }

    public function getData(Request $request)
    {
        $columns = ['created_at'];
        $totalData = ServiceModel::count();
        $search = $request->input('search.value');
        $query = ServiceModel::with([
            'getUnit',
            'getUnit.getType',
            'getUnit.getType.getModel',
            'getUnit.getType.getBrand',
            'getUnit.getJenis',
            'getUnit.getColor',
            'getUnit.getCustomer'
        ]);
        if(!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->Where('no_service', 'like', "%{$search}%");
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
            foreach($query as $r)
            {
                $btn = '<button type="button" value="'.$r->id.'" name="btn-detail[]" id="btn-detail" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#formModalDetail" onclick="goDetail(this)"><i class="fa fa-eye"></i></button>';

                $Data['act'] = $btn;
                $Data['id'] =  $r->id;
                $Data['no_service'] =  $r->no_service;
                $Data['tgl_service'] = $r->tgl_service;
                $Data['customer'] = $r->getUnit->getCustomer->customer_name;
                $Data['no_polisi'] = $r->getUnit->plat_number;
                $Data['unit'] = $r->getUnit->getType->getBrand->brand_name." ".$r->getUnit->getType->getModel->model_name." ".$r->getUnit->getType->type_name;
                $Data['t_pekerjaan'] = "Rp. ".Converts::conver_double_to_money($r->total_pekerjaan);
                $Data['t_parts'] = "Rp. ".Converts::conver_double_to_money($r->total_parts);
                $Data['diskon'] = "Rp. ".Converts::conver_double_to_money($r->diskon);
                $Data['ppn'] = "Rp. ".Converts::conver_double_to_money($r->ppn_rupiah);
                $Data['t_net'] = "Rp. ".Converts::conver_double_to_money($r->total_net);
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

    public function show($id)
    {
        $data = [
            'header' => ServiceModel::with([
                'getUnit',
                'getUnit.getType',
                'getUnit.getType.getModel',
                'getUnit.getType.getBrand',
                'getUnit.getJenis',
                'getUnit.getColor',
                'getUnit.getCustomer'
            ])->find($id),
            'pekerjaan' => ServicePekerjaanModel::with([
                'getPekerjaan',
                'getPekerjaan.getKategoriPekerjaan'
                ])->where('service_id', $id)->get(),
            'parts' => ServicePartsModel::with([
                'getPart',
                'getPart.getSatuan'
            ])->where('service_id', $id)->get(),
        ];
        return view('service.detail', $data);
    }

    public function print($id)
    {
        $data = [
            'header' => ServiceModel::with([
                'getUnit',
                'getUnit.getType',
                'getUnit.getType.getModel',
                'getUnit.getType.getBrand',
                'getUnit.getJenis',
                'getUnit.getColor',
                'getUnit.getCustomer'
            ])->find($id),
            'pekerjaan' => ServicePekerjaanModel::with([
                'getPekerjaan',
                'getPekerjaan.getKategoriPekerjaan'
                ])->where('service_id', $id)->get(),
            'parts' => ServicePartsModel::with([
                'getPart',
                'getPart.getSatuan'
            ])->where('service_id', $id)->get(),
        ];
        $pdf = Pdf::loadView('service.print', $data)->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}
