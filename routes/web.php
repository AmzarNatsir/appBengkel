<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\POController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function ()
{
     //data master
     Route::group(["prefix" => "common"], function(){
        //common brand
        Route::get('brand', [CommonController::class, 'brand'])->name('brand.index');
        Route::get('brandData', [CommonController::class, 'brandData'])->name('brand.data');
        Route::get('brandCreate', [CommonController::class, 'brandCreate'])->name('brand.create');
        Route::post('brandStore', [CommonController::class, 'brandStore']);
        Route::get('brandShow/{id}', [CommonController::class, 'brandShow']);
        Route::get('brandEdit/{id}', [CommonController::class, 'brandEdit']);
        Route::put('brandUpdate/{id}', [CommonController::class, 'brandUpdate']);
        Route::get('brandDestroy/{id}', [CommonController::class, 'brandDestroy']);
        //common model brand
        Route::get('model', [CommonController::class, 'model'])->name('model.index');
        Route::get('modelData', [CommonController::class, 'modelData'])->name('model.data');
        Route::get('modelCreate', [CommonController::class, 'modelCreate'])->name('model.create');
        Route::post('modelStore', [CommonController::class, 'modelStore']);
        Route::get('modelShow/{id}', [CommonController::class, 'modelShow']);
        Route::get('modelEdit/{id}', [CommonController::class, 'modelEdit']);
        Route::put('modelUpdate/{id}', [CommonController::class, 'modelUpdate']);
        Route::get('modelDestroy/{id}', [CommonController::class, 'modelDestroy']);
         //common model type
         Route::get('type', [CommonController::class, 'type'])->name('type.index');
         Route::get('typeData', [CommonController::class, 'typeData'])->name('type.data');
         Route::get('typeCreate', [CommonController::class, 'typeCreate'])->name('type.create');
         Route::post('typeStore', [CommonController::class, 'typeStore']);
         Route::get('typeShow/{id}', [CommonController::class, 'typeShow']);
         Route::get('typeEdit/{id}', [CommonController::class, 'typeEdit']);
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
        Route::get('colorShow/{id}', [CommonController::class, 'colorShow']);
        Route::get('colorEdit/{id}', [CommonController::class, 'colorEdit']);
        Route::put('colorUpdate/{id}', [CommonController::class, 'colorUpdate']);
        Route::get('colorDestroy/{id}', [CommonController::class, 'colorDestroy']);
        //jenis
        Route::get('jenis', [CommonController::class, 'jenis'])->name('jenis.index');
        Route::get('jenisData', [CommonController::class, 'jenisData'])->name('jenis.data');
        Route::get('jenisCreate', [CommonController::class, 'jenisCreate'])->name('jenis.create');
        Route::post('jenisStore', [CommonController::class, 'jenisStore']);
        Route::get('jenisShow/{id}', [CommonController::class, 'jenisShow']);
        Route::get('jenisEdit/{id}', [CommonController::class, 'jenisEdit']);
        Route::put('jenisUpdate/{id}', [CommonController::class, 'jenisUpdate']);
        Route::get('jenisDestroy/{id}', [CommonController::class, 'jenisDestroy']);
        //satuan
        Route::get('satuan', [CommonController::class, 'satuan'])->name('satuan.index');
        Route::get('satuanData', [CommonController::class, 'satuanData'])->name('satuan.data');
        Route::get('satuanCreate', [CommonController::class, 'satuanCreate'])->name('satuan.create');
        Route::post('satuanStore', [CommonController::class, 'satuanStore']);
        Route::get('satuanShow/{id}', [CommonController::class, 'satuanShow']);
        Route::get('satuanEdit/{id}', [CommonController::class, 'satuanEdit']);
        Route::put('satuanUpdate/{id}', [CommonController::class, 'satuanUpdate']);
        Route::get('satuanDestroy/{id}', [CommonController::class, 'satuanDestroy']);
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
        Route::get('show/{id}', [CustomerController::class, 'show']);
        Route::get('edit/{id}', [CustomerController::class, 'edit']);
        Route::put('update/{id}', [CustomerController::class, 'update']);
        Route::get('destroy/{id}', [CustomerController::class, 'destroy']);
     });

     //supplier
     Route::group(["prefix" => "supplier"], function(){
        Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
        Route::get('data', [SupplierController::class, 'data'])->name('supplier.data');
        Route::get('create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('show/{id}', [SupplierController::class, 'show']);
        Route::get('edit/{id}', [SupplierController::class, 'edit']);
        Route::put('update/{id}', [SupplierController::class, 'update']);
        Route::get('destroy/{id}', [SupplierController::class, 'destroy']);
     });

     //kendaraan
     Route::group(["prefix" => "vehicle"], function(){
        Route::get('/', [VehicleController::class, 'index'])->name('vehicle.index');
        Route::get('data', [VehicleController::class, 'data'])->name('vehicle.data');
        Route::get('create', [VehicleController::class, 'create'])->name('vehicle.create');
        Route::post('store', [VehicleController::class, 'store'])->name('vehicle.store');
        Route::get('show/{id}', [VehicleController::class, 'show']);
        Route::get('edit/{id}', [VehicleController::class, 'edit']);
        Route::put('update/{id}', [VehicleController::class, 'update']);
        Route::get('destroy/{id}', [VehicleController::class, 'destroy']);
     });
     //parts
     Route::group(["prefix" => "parts"], function(){
        Route::get('/', [PartsController::class, 'index'])->name('parts.index');
        Route::get('data', [PartsController::class, 'data'])->name('parts.data');
        Route::get('create', [PartsController::class, 'create'])->name('parts.create');
        Route::post('store', [PartsController::class, 'store'])->name('parts.store');
        Route::get('show/{id}', [PartsController::class, 'show']);
        Route::get('edit/{id}', [PartsController::class, 'edit']);
        Route::put('update/{id}', [PartsController::class, 'update']);
        Route::get('destroy/{id}', [PartsController::class, 'destroy']);
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
        Route::get('editItem/{id}', [POController::class, 'edit_item_po']);
        Route::put('updateItem/{id}', [POController::class, 'update_item_po']);
        Route::get('deleteDetail/{id}', [POController::class, 'delete_detail_po']);

     });
     //penerimaan
     Route::group(['prefix' => 'penerimaan'], function(){
        Route::get('baru', [PenerimaanController::class, 'baru'])->name('penerimaan.baru');
        Route::post('getPO', [PenerimaanController::class, 'getPO'])->name('penerimaan.get_po');
        Route::post('store', [PenerimaanController::class, 'store'])->name('penerimaan.store');
     });
});
