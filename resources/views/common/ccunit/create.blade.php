@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Common</h3>
            <h6 class="op-7 mb-2">Common CC Unit</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ url('common/ccunit') }}" class="btn btn-primary btn-round">Back</a>
        </div>
    </div>
    @if (Session::has('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" aria-hidden="true" class="close">
            <i class="fa fa-times"></i>
        </button>
        <span><b> Success - </b> {!! session('message') !!}</span>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Add CC Unit</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('common/ccunitStore') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="cc_unit">CC Unit</label>
                                    <input type="text" name="cc_unit" id="cc_unit" class="form-control form-control-sm @error('cc_unit') is-invalid @enderror">
                                    @if ($errors->has('cc_unit'))
                                    <div class="invalid-feedback">{{ $errors->first('cc_unit') }}</div>
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
