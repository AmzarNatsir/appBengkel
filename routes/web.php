<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManajemenPekerjaanController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\POController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });

// Auth::routes();

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('doLogin', [AuthController::class, 'login'])->name('doLogin');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function ()
{

     //data master
     Route::group(["prefix" => "common"], function(){
        //common brand
        Route::get('brand', [CommonController::class, 'brand'])->name('brand.index');
        Route::get('brandData', [CommonController::class, 'brandData'])->name('brand.data');
        Route::get('brandCreate', [CommonController::class, 'brandCreate'])->name('brand.create');
        Route::post('brandStore', [CommonController::class, 'brandStore']);
        Route::get('brandShow/{id}', [CommonController::class, 'brandShow'])->name('brand.show');
        Route::get('brandEdit/{id}', [CommonController::class, 'brandEdit'])->name('brand.edit');
        Route::put('brandUpdate/{id}', [CommonController::class, 'brandUpdate']);
        Route::get('brandDestroy/{id}', [CommonController::class, 'brandDestroy']);
        //common model brand
        Route::get('model', [CommonController::class, 'model'])->name('model.index');
        Route::get('modelData', [CommonController::class, 'modelData'])->name('model.data');
        Route::get('modelCreate', [CommonController::class, 'modelCreate'])->name('model.create');
        Route::post('modelStore', [CommonController::class, 'modelStore']);
        Route::get('modelShow/{id}', [CommonController::class, 'modelShow'])->name('model.show');
        Route::get('modelEdit/{id}', [CommonController::class, 'modelEdit'])->name('model.edit');
        Route::put('modelUpdate/{id}', [CommonController::class, 'modelUpdate']);
        Route::get('modelDestroy/{id}', [CommonController::class, 'modelDestroy']);
         //common model type
         Route::get('type', [CommonController::class, 'type'])->name('type.index');
         Route::get('typeData', [CommonController::class, 'typeData'])->name('type.data');
         Route::get('typeCreate', [CommonController::class, 'typeCreate'])->name('type.create');
         Route::post('typeStore', [CommonController::class, 'typeStore']);
         Route::get('typeShow/{id}', [CommonController::class, 'typeShow'])->name('type.show');
         Route::get('typeEdit/{id}', [CommonController::class, 'typeEdit'])->name('type.edit');
         Route::put('typeUpdate/{id}', [CommonController::class, 'typeUpdate']);
         Route::get('typeDestroy/{id}', [CommonController::class, 'typeDestroy']);
        //CC Unit
        Route::get('ccunit', [CommonController::class, 'ccunit'])->name('ccunit.index');
        Route::get('ccunitData', [CommonController::class, 'ccunitData'])->name('ccunit.data');
        Route::get('ccunitCreate', [CommonController::class, 'ccunitCreate'])->name('ccunit.create');
        Route::post('ccunitStore', [CommonController::class, 'ccunitStore']);
        Route::get('ccunitShow/{id}', [CommonController::class, 'ccunitShow']);
        Route::get('ccunitEdit/{id}', [CommonController::class, 'ccunitEdit']);
        Route::put('ccunitUpdate/{id}', [CommonController::class, 'ccunitUpdate']);
        Route::get('ccunitDestroy/{id}', [CommonController::class, 'ccunitDestroy']);
        //Color
        Route::get('color', [CommonController::class, 'color'])->name('color.index');
        Route::get('colorData', [CommonController::class, 'colorData'])->name('color.data');
        Route::get('colorCreate', [CommonController::class, 'colorCreate'])->name('color.create');
        Route::post('colorStore', [CommonController::class, 'colorStore']);
        Route::get('colorShow/{id}', [CommonController::class, 'colorShow'])->name('color.show');
        Route::get('colorEdit/{id}', [CommonController::class, 'colorEdit'])->name('color.edit');
        Route::put('colorUpdate/{id}', [CommonController::class, 'colorUpdate']);
        Route::get('colorDestroy/{id}', [CommonController::class, 'colorDestroy']);
        //jenis
        Route::get('jenis', [CommonController::class, 'jenis'])->name('jenis.index');
        Route::get('jenisData', [CommonController::class, 'jenisData'])->name('jenis.data');
        Route::get('jenisCreate', [CommonController::class, 'jenisCreate'])->name('jenis.create');
        Route::post('jenisStore', [CommonController::class, 'jenisStore']);
        Route::get('jenisShow/{id}', [CommonController::class, 'jenisShow'])->name('jenis.show');
        Route::get('jenisEdit/{id}', [CommonController::class, 'jenisEdit'])->name('jenis.edit');
        Route::put('jenisUpdate/{id}', [CommonController::class, 'jenisUpdate']);
        Route::get('jenisDestroy/{id}', [CommonController::class, 'jenisDestroy']);
        //satuan
        Route::get('satuan', [CommonController::class, 'satuan'])->name('satuan.index');
        Route::get('satuanData', [CommonController::class, 'satuanData'])->name('satuan.data');
        Route::get('satuanCreate', [CommonController::class, 'satuanCreate'])->name('satuan.create');
        Route::post('satuanStore', [CommonController::class, 'satuanStore']);
        Route::get('satuanShow/{id}', [CommonController::class, 'satuanShow'])->name('satuan.show');
        Route::get('satuanEdit/{id}', [CommonController::class, 'satuanEdit'])->name('satuan.edit');
        Route::put('satuanUpdate/{id}', [CommonController::class, 'satuanUpdate']);
        Route::get('satuanDestroy/{id}', [CommonController::class, 'satuanDestroy']);
        //master rak
        Route::get('rak', [CommonController::class, 'rak'])->name('rak.index');
        Route::get('rakData', [CommonController::class, 'rakData'])->name('rak.data');
        Route::get('rakCreate', [CommonController::class, 'rakCreate'])->name('rak.create');
        Route::post('rakStore', [CommonController::class, 'rakStore']);
        Route::get('rakShow/{id}', [CommonController::class, 'rakShow'])->name('rak.show');
        Route::get('rakEdit/{id}', [CommonController::class, 'rakEdit'])->name('rak.edit');
        Route::put('rakUpdate/{id}', [CommonController::class, 'rakUpdate']);
        Route::get('rakDestroy/{id}', [CommonController::class, 'rakDestroy']);
         //json
         Route::get('getJsonBrand', [CommonController::class, 'jsonBrand'])->name('json.brand');
         Route::post('getJsonModel', [CommonController::class, 'jsonModel'])->name('json.model');

     });
    //customer
     Route::group(["prefix" => "customer"], function(){
        Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('data', [CustomerController::class, 'data'])->name('customer.data');
        Route::get('create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('show/{id}', [CustomerController::class, 'show'])->name('customer.show');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('update/{id}', [CustomerController::class, 'update']);
        Route::get('destroy/{id}', [CustomerController::class, 'destroy']);
     });

     //supplier
     Route::group(["prefix" => "supplier"], function(){
        Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
        Route::get('data', [SupplierController::class, 'data'])->name('supplier.data');
        Route::get('create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('show/{id}', [SupplierController::class, 'show'])->name('supplier.show');
        Route::get('edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::put('update/{id}', [SupplierController::class, 'update']);
        Route::get('destroy/{id}', [SupplierController::class, 'destroy']);
     });

     //kendaraan
     Route::group(["prefix" => "vehicle"], function(){
        Route::get('/', [VehicleController::class, 'index'])->name('vehicle.index');
        Route::get('data', [VehicleController::class, 'data'])->name('vehicle.data');
        Route::get('create', [VehicleController::class, 'create'])->name('vehicle.create');
        Route::post('store', [VehicleController::class, 'store'])->name('vehicle.store');
        Route::get('show/{id}', [VehicleController::class, 'show'])->name('vehicle.show');
        Route::get('edit/{id}', [VehicleController::class, 'edit'])->name('vehicle.edit');
        Route::put('update/{id}', [VehicleController::class, 'update']);
        Route::get('destroy/{id}', [VehicleController::class, 'destroy']);
     });
     //manajemen pekerjaan
     Route::group(['prefix' => 'manajemen_pekerjaan'], function(){
        //kategori pekerjaan
        Route::get('kategori_pekerjaan', [ManajemenPekerjaanController::class, 'kategori_pekerjaan'])->name('manajemen_pekerjaan.kategori.index');
        Route::get('data_kategori_pekerjaan', [ManajemenPekerjaanController::class, 'kategori_pekerjaan_data'])->name('manajemen_pekerjaan.kategori.data');
        Route::get('baru_kategori_pekerjaan', [ManajemenPekerjaanController::class, 'kategori_pekerjaan_baru'])->name('manajemen_pekerjaan.kategori.baru');
        Route::post('simpan_kategori_pekerjaan', [ManajemenPekerjaanController::class, 'kategori_pekerjaan_simpan'])->name('manajemen_pekerjaan.kategori.simpan');
        Route::get('kategori_pekerjaan_edit/{id}', [ManajemenPekerjaanController::class, 'kategori_pekerjaan_edit'])->name('manajemen_pekerjaan.kategori.edit');
        Route::put('kategori_pekerjaan_update/{id}', [ManajemenPekerjaanController::class, 'kategori_pekerjaan_update']);
        Route::get('kategori_pekerjaan_destroy/{id}', [ManajemenPekerjaanController::class, 'kategori_pekerjaan_destroy']);

        //pekerjaan dan jasa
        Route::get('pekerjaan', [ManajemenPekerjaanController::class, 'pekerjaan'])->name('manajemen_pekerjaan.pekerjaan.index');
        Route::get('pekerjaan_data', [ManajemenPekerjaanController::class, 'pekerjaan_data'])->name('manajemen_pekerjaan.pekerjaan.data');
        Route::get('pekerjaan_baru', [ManajemenPekerjaanController::class, 'pekerjaan_baru'])->name('manajemen_pekerjaan.pekerjaan.baru');
        Route::post('pekerjaan_simpan', [ManajemenPekerjaanController::class, 'pekerjaan_simpan'])->name('manajemen_pekerjaan.pekerjaan.simpan');
        Route::get('pekerjaan_edit/{id}', [ManajemenPekerjaanController::class, 'pekerjaan_edit'])->name('manajemen_pekerjaan.pekerjaan.edit');
        Route::put('pekerjaan_update/{id}', [ManajemenPekerjaanController::class, 'pekerjaan_update']);
        Route::get('pekerjaan_destroy/{id}', [ManajemenPekerjaanController::class, 'pekerjaan_destroy']);
     });
     //manajemen stok
     Route::group(['prefix' => 'manajemen_stok'], function(){
        Route::get('/', [PartsController::class, 'index'])->name('manajemen_stok.stok.index');
        Route::get('data', [PartsController::class, 'data'])->name('manajemen_stok.stok.data');
        Route::get('create', [PartsController::class, 'create'])->name('manajemen_stok.stok.create');
        Route::post('store', [PartsController::class, 'store'])->name('manajemen_stok.stok.store');
        Route::get('show/{id}', [PartsController::class, 'show'])->name('manajemen_stok.stok.show');
        Route::get('edit/{id}', [PartsController::class, 'edit'])->name('manajemen_stok.stok.edit');
        Route::put('update/{id}', [PartsController::class, 'update']);
        Route::get('destroy/{id}', [PartsController::class, 'destroy']);
        Route::get('kartu_stok', [PartsController::class, 'kartu_stok'])->name('manajemen_stok.kartu_stok.index');
     });


     //Purchase Order
     Route::group(['prefix' => 'pemesanan'], function(){
        //list
        Route::get('daftar', [POController::class, 'index'])->name('pemesanan.index');
        Route::get('getData', [POController::class, 'getData'])->name('pemesanan.data');
        //new
        Route::get('baru', [POController::class, 'create'])->name('pemesanan.baru');
        Route::get('tambahItem/{id}', [POController::class, 'new_items']);
        Route::post('detailItem', [POController::class, 'getDetailItem']);
        Route::post('headPOStore', [POController::class, 'store_po'])->name('pemesanan.store');
        Route::post('detailPOStore', [POController::class, 'store_detail_po'])->name('pemesananDetail.store');
        Route::get('editItem/{id}', [POController::class, 'edit_item_po'])->name('pemesanan.edit');
        Route::put('updateItem/{id}', [POController::class, 'update_item_po']);
        Route::get('deleteDetail/{id}', [POController::class, 'delete_detail_po']);
        Route::get('detail/{id}', [POController::class, 'show'])->name('pemesanan.show');
        Route::get('print/{id}', [POController::class, 'print']);

     });
     //penerimaan
     Route::group(['prefix' => 'penerimaan'], function(){
        //list
        Route::get('daftar', [PenerimaanController::class, 'index'])->name('penerimaan.index');
        Route::get('getData', [PenerimaanController::class, 'getData'])->name('penerimaan.data');
        //add new
        Route::get('baru', [PenerimaanController::class, 'baru'])->name('penerimaan.baru');
        Route::post('getPO', [PenerimaanController::class, 'getPO'])->name('penerimaan.get_po');
        Route::post('store', [PenerimaanController::class, 'store'])->name('penerimaan.store');
        Route::get('detail/{id}', [PenerimaanController::class, 'show'])->name('penerimaan.show');
     });

     //Penjualan
     Route::group(['prefix' => 'service'], function(){
         //add new
         Route::get('baru', [ServiceController::class, 'baru'])->name('service.baru');
         Route::post('get_unit_customer', [ServiceController::class, 'getUnitCustomer'])->name('service.get_unit_customer');
         Route::post('store', [ServiceController::class, 'store'])->name('service.store');

         //list transaksi
        Route::get('daftar', [ServiceController::class, 'daftar'])->name('service.daftar');
        Route::post('getData', [ServiceController::class, 'getData'])->name('service.data');
        Route::get('detail/{id}', [ServiceController::class, 'show']);
        Route::get('print/{id}', [ServiceController::class, 'print']);

     });

     Route::group(['prefix' => 'pengaturan'], function(){
        Route::get('ppn_margin_harga_jual', [PengaturanController::class, 'ppn_margin_harga_jual'])->name('pengaturan.ppn_marginhargajual');
        Route::post('ppn_margin_harga_jual_store', [PengaturanController::class, 'ppn_margin_harga_jual_store'])->name('pengaturan.ppn_marginhargajual.store');
     });

     Route::group(['prefix' => 'search'], function(){
        Route::post('parts_autocomplete', [PartsController::class, 'autocomplete_parts'])->name('autocomplete_parts');
        Route::post('pekerjaan_autocomplete', [ManajemenPekerjaanController::class, 'autocomplete_pekerjaan'])->name('autocomplete_pekerjaan');
        Route::post('parts_autocomplete_stock_card', [PartsController::class, 'parts_autocomplete_stock_card'])->name('parts_autocomplete_stock_card');
     });

     Route::group(["prefix" => 'getData'], function(){
        Route::get('data_ppn', [GetDataController::class, 'getPpnValue'])->name('data.ppn');
        Route::post('getPenerimaanStok', [PenerimaanController::class, 'getPenerimaanStok'])->name('getdata.penerimaan');
        Route::post('getPenjualanStok', [PenerimaanController::class, 'getPenjualanStok'])->name('getdata.penjualan');
     });
});
