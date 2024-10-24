@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Common</h3>
            <h6 class="op-7 mb-2">Common Brand</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ url('common/brand') }}" class="btn btn-primary btn-round">Back</a>
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
                    <div class="card-title">Form Edit Common Brand</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('common/brandUpdate', $data->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="brand_name">Brand</label>
                                    <input type="text" name="brand_name" id="brand_name" class="form-control form-control-sm @error('brand_name') is-invalid @enderror" value="{{ $data->brand_name }}">
                                    @if ($errors->has('brand_name'))
                                    <div class="invalid-feedback">{{ $errors->first('brand_name') }}</div>
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

