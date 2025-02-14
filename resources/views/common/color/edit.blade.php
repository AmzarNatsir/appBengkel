@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Common</h3>
            <h6 class="op-7 mb-2">Common Color</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ url('common/color') }}" class="btn btn-primary btn-round">Back</a>
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
                    <div class="card-title">Form Edit Common Color</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('common/colorUpdate', $data->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="color_idn">Color (IDN / Indonesia)</label>
                                    <input type="text" name="color_idn" id="color_idn" class="form-control @error('color_idn') is-invalid @enderror" value="{{ $data->color_idn }}">
                                    @if ($errors->has('color_idn'))
                                    <div class="invalid-feedback">{{ $errors->first('color_idn') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="color_eng">Color (ENG / English)</label>
                                    <input type="text" name="color_eng" id="color_eng" class="form-control @error('color_eng') is-invalid @enderror" value="{{ $data->color_eng }}">
                                    @if ($errors->has('color_eng'))
                                    <div class="invalid-feedback">{{ $errors->first('color_eng') }}</div>
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

