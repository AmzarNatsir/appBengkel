@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Parts</h3>
            <h6 class="op-7 mb-2">Add New Part</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('parts.index') }}" class="btn btn-primary btn-round">Back</a>
        </div>
    </div>
    @if (Session::has('status'))
        @if(session('status')=='success')
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" aria-hidden="true" class="close">
                <i class="fa fa-times"></i>
            </button>
            <span><b> Success - </b> {!! session('message') !!}</span>
        </div>
        @else
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" aria-hidden="true" class="close">
                <i class="fa fa-times"></i>
            </button>
            <span><b> Failed - </b> {!! session('message') !!}</span>
        </div>
        @endif
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Add Part</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('parts.store') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-12 col-lg-5">
                                <div class="form-group">
                                    <label for="part_name">Part Name</label>
                                    <input type="text" class="form-control form-control-sm  @error('part_name') is-invalid @enderror" name="part_name" id="part_name">
                                    @if ($errors->has('part_name'))
                                    <div class="invalid-feedback">{{ $errors->first('part_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2">
                                <div class="form-group">
                                    <label for="satuan_select">Satuan</label>
                                    <select class="form-select @error('satuan_select') is-invalid @enderror" name="satuan_select" id="satuan_select">
                                        <option value=""></option>
                                        @foreach ($list_satuan as $satuan)
                                        <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('satuan_select'))
                                    <div class="invalid-feedback">{{ $errors->first('satuan_select') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2">
                                <div class="form-group">
                                    <label for="jenis_select">Jenis</label>
                                    <select class="form-select @error('jenis_select') is-invalid @enderror" name="jenis_select" id="jenis_select">
                                        <option value=""></option>
                                        @foreach ($list_jenis as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->jenis }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('jenis_select'))
                                    <div class="invalid-feedback">{{ $errors->first('jenis_select') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group">
                                    <label for="brand_select">Brand</label>
                                    <select class="form-select @error('brand_select') is-invalid @enderror" name="brand_select" id="brand_select">
                                        <option value=""></option>
                                        @foreach ($list_brand as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('brand_select'))
                                    <div class="invalid-feedback">{{ $errors->first('brand_select') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group">
                                    <label for="inp_stok_awal">Stok Awal</label>
                                    <input type="text" class="form-control form-control-sm angka" name="inp_stok_awal" id="inp_stok_awal" value="0" style="text-align: right" oninput="toStockAkhir(this)" onblur="checkNull(this)" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group">
                                    <label for="inp_stok_akhir">Stok Akhir</label>
                                    <input type="text" class="form-control form-control-sm angka" name="inp_stok_akhir" id="inp_stok_akhir" value="0" style="text-align: right" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group">
                                    <label for="inp_harga_beli">Harga Beli</label>
                                    <input type="text" class="form-control form-control-sm angka" name="inp_harga_beli" id="inp_harga_beli" value="0" style="text-align: right" onblur="checkNull(this)">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group">
                                    <label for="inp_harga_jual">Harga Jual</label>
                                    <input type="text" class="form-control form-control-sm angka" name="inp_harga_jual" id="inp_harga_jual" value="0" style="text-align: right" onblur="checkNull(this)">
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        window.setTimeout(function () { $(".alert-success").alert('close'); }, 2000);
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
    var toStockAkhir = function(el)
    {
        $("#inp_stok_akhir").val($(el).val());
    }
    var checkNull = function(el)
    {
        if($(el).val()=="")
        {
            $(el).val(0);
        }
    }
</script>
@endsection

