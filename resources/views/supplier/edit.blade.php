@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Supplier</h3>
            <h6 class="op-7 mb-2">Edit Data Supplier</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('supplier.index') }}" class="btn btn-primary btn-round">Back</a>
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
                    <div class="card-title">Form Edit Data Supplier</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('supplier/update', $data->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="supplier_name">Supplier Name</label>
                                <input type="text" name="supplier_name" id="supplier_name" class="form-control @error('supplier_name') is-invalid @enderror" value="{{ $data->supplier_name }}">
                                @if ($errors->has('supplier_name'))
                                <div class="invalid-feedback">{{ $errors->first('supplier_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="supplier_address">Supplier Address</label>
                                <input type="text" name="supplier_address" id="supplier_address" class="form-control @error('supplier_address') is-invalid @enderror" value="{{ $data->supplier_address }}">
                                @if ($errors->has('supplier_address'))
                                <div class="invalid-feedback">{{ $errors->first('supplier_address') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="supplier_email">Supplier Email</label>
                                <input type="text" name="supplier_email" id="supplier_email" class="form-control @error('supplier_email') is-invalid @enderror" value="{{ $data->supplier_email }}">
                                @if ($errors->has('supplier_email'))
                                <div class="invalid-feedback">{{ $errors->first('supplier_email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="supplier_phone">Supplier Phone</label>
                                <input type="text" name="supplier_phone" id="supplier_phone" class="form-control @error('supplier_phone') is-invalid @enderror" value="{{ $data->supplier_phone }}">
                                @if ($errors->has('supplier_phone'))
                                <div class="invalid-feedback">{{ $errors->first('supplier_phone') }}</div>
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

