<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\PartsModel;
use App\Models\PurchaseOrderModel;
use App\Models\ServiceModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'total_pelanggan' => CustomerModel::whereIn('crud', ['I', 'U'])->get()->count(),
            "total_item_stok" => PartsModel::whereNull('deleted_at')->get()->count(),
            "total_item_po" => PurchaseOrderModel::whereMonth('po_date', date('m'))->whereYear('po_date', date('Y'))->where('status', 'Receive')->get()->count(),
            'total_penjualan' => ServiceModel::whereMonth('tgl_service', date('m'))->whereYear('no_service', date('Y'))->get()->sum()
        ];
        return view('home.index', $data);
    }
}
