@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Customer</h3>
            <h6 class="op-7 mb-2">Edit Data Customer</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('customer.index') }}" class="btn btn-primary btn-round">Back</a>
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
                    <div class="card-title">Form Edit Data Customer</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('customer/update', $data->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="customer_name">Customer Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ $data->customer_name }}">
                                @if ($errors->has('customer_name'))
                                <div class="invalid-feedback">{{ $errors->first('customer_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="customer_address">Customer Address</label>
                                <input type="text" name="customer_address" id="customer_address" class="form-control @error('customer_address') is-invalid @enderror" value="{{ $data->customer_address }}">
                                @if ($errors->has('customer_address'))
                                <div class="invalid-feedback">{{ $errors->first('customer_address') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="customer_email">Customer Email</label>
                                <input type="text" name="customer_email" id="customer_email" class="form-control @error('customer_email') is-invalid @enderror" value="{{ $data->customer_email }}">
                                @if ($errors->has('customer_email'))
                                <div class="invalid-feedback">{{ $errors->first('customer_email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="customer_phone">Customer Phone</label>
                                <input type="text" name="customer_phone" id="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ $data->customer_phone }}">
                                @if ($errors->has('customer_phone'))
                                <div class="invalid-feedback">{{ $errors->first('customer_phone') }}</div>
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

