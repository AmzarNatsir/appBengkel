@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Manajemen Pekerjaan</h3>
            <h6 class="op-7 mb-2">Pekerjaan dan Jasa</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('manajemen_pekerjaan.pekerjaan.index') }}" class="btn btn-primary btn-round">Back</a>
        </div>
    </div>
    @if (Session::has('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" aria-hidden="true" class="close">
            <i class="fa fa-times"></i>
        </button>
        <span><b> {!! session('message') !!} </b></span>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Tambah Pekerjaan dan Jasa</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('manajemen_pekerjaan.pekerjaan.simpan') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group">
                                    <label for="kategori_pekerjaan">Kategori Pekerjaan</label>
                                    <select class="form-select @error('kategori_pekerjaan') is-invalid @enderror" name="kategori_pekerjaan" id="kategori_pekerjaan" style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($list_kategori_pekerjaan as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->kategori_pekerjaan }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('kategori_pekerjaan'))
                                    <div class="invalid-feedback">{{ $errors->first('kategori_pekerjaan') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="nama_pekerjaan">Nama Pekerjaan</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_pekerjaan') is-invalid @enderror" name="nama_pekerjaan" id="nama_pekerjaan">
                                    @if ($errors->has('nama_pekerjaan'))
                                    <div class="invalid-feedback">{{ $errors->first('nama_pekerjaan') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group">
                                    <label for="inp_jasa">Harga / Jasa (Rp.)</label>
                                    <input type="text" class="form-control form-control-sm angka" name="inp_jasa" id="inp_jasa" value="0" style="text-align: right" onblur="checkNull(this)">
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
        $('#kategori_pekerjaan').select2({
            // theme: "classic",
            allowClear: true,
            placeholder: "Pilihan Kategri",
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

