@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Parts</h3>
            <h6 class="op-7 mb-2">Detail Part</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('parts.index') }}" class="btn btn-primary btn-round">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Part</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="part_name">Part Name</label>
                                <input type="text" class="form-control form-control-sm" name="part_name" id="part_name" value="{{ $main->part_name }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="satuan_select">Satuan</label>
                                <select class="form-select" name="satuan_select" id="satuan_select" disabled>
                                    <option value=""></option>
                                    @foreach ($list_satuan as $satuan)
                                    <option value="{{ $satuan->id }}" {{ ($satuan->id == $main->id_satuan) ? "selected" : "" }}>{{ $satuan->satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="jenis_select">Jenis</label>
                                <select class="form-select" name="jenis_select" id="jenis_select" disabled>
                                    <option value=""></option>
                                    @foreach ($list_jenis as $jenis)
                                    <option value="{{ $jenis->id }}" {{ ($jenis->id == $main->id_jenis) ? "selected" : "" }}>{{ $jenis->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="brand_select">Brand</label>
                                <select class="form-select" name="brand_select" id="brand_select" disabled>
                                    <option value=""></option>
                                    @foreach ($list_brand as $brand)
                                    <option value="{{ $brand->id }}" {{ ($brand->id == $main->id_brand) ? "selected" : "" }}>{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="inp_stok_awal">Stok Awal</label>
                                <input type="text" class="form-control form-control-sm angka" name="inp_stok_awal" id="inp_stok_awal" value="{{ $main->stok_awal }}" style="text-align: right" min="0" disabled>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="inp_stok_akhir">Stok Akhir</label>
                                <input type="text" class="form-control form-control-sm angka" name="inp_stok_akhir" id="inp_stok_akhir" value="{{ $main->stok_akhir }}" style="text-align: right" disabled>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="inp_harga_beli">Harga Beli</label>
                                <input type="text" class="form-control form-control-sm angka" name="inp_harga_beli" id="inp_harga_beli" value="{{ $main->harga_beli }}" style="text-align: right" disabled>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="inp_harga_jual">Harga Jual</label>
                                <input type="text" class="form-control form-control-sm angka" name="inp_harga_jual" id="inp_harga_jual" value="{{ $main->harga_jual }}" style="text-align: right" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Description</div>
                </div>
                <div class="card-body">
                    <p>{{ $main->deskripsi }}</p>
                </div>
                <div class="card-header">
                    <div class="card-title">Image</div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-12" style="text-align: center">
                            @if(empty($main->gambar))
                                <img id="preview_upload" class="justify-content-center" style="width: 50%; height: auto;">
                            @else
                                <img id="preview_upload" src="{{ url(Storage::url('parts/'.$main->gambar)) }}" class="justify-content-center" style="width: 50%; height: auto;">
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
       $('#satuan_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Satuan",
            height: '36px!important'
        });
        $('#jenis_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Jenis",
            height: '36px!important'
        });
        $('#brand_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Brand",
            height: '36px!important'
        });
        $(".angka").number( true, 0);
    });
    var checkNull = function(el)
    {
        if($(el).val()=="")
        {
            $(el).val(0);
        }
    }
</script>
@endsection

