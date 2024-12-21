@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Manajemen Pekerjaan</h3>
            <h6 class="op-7 mb-2">Kategori Pekerjaan</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('manajemen_pekerjaan.kategori.index') }}" class="btn btn-primary btn-round">Back</a>
        </div>
    </div>
    @if (Session::has('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" aria-hidden="true" class="close">
            <i class="fa fa-times"></i>
        </button>
        <span><b> {!! session('status') !!} </b></span>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Edit Kategori Pekerjaan</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('manajemen_pekerjaan/kategori_pekerjaan_update', $res->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="kategori_pekerjaan">Kategori Pekerjaan</label>
                                    <input type="text" name="kategori_pekerjaan" id="kategori_pekerjaan" class="form-control form-control-sm @error('kategori_pekerjaan') is-invalid @enderror" value="{{ $res->kategori_pekerjaan }}">
                                    @if ($errors->has('kategori_pekerjaan'))
                                    <div class="invalid-feedback">{{ $errors->first('kategori_pekerjaan') }}</div>
                                    @endif
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
    });
</script>
@endsection

