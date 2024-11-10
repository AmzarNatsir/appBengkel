@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Customer</h3>
            <h6 class="op-7 mb-2">Detail Data Customer</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('customer.index') }}" class="btn btn-primary btn-round">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Data Customer</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="customer_name">Customer Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control form-control-sm" value="{{ $data->customer_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="customer_address">Customer Address</label>
                                <input type="text" name="customer_address" id="customer_address" class="form-control form-control-sm" value="{{ $data->customer_address }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="customer_email">Customer Email</label>
                                <input type="text" name="customer_email" id="customer_email" class="form-control form-control-sm" value="{{ $data->customer_email }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="customer_phone">Customer Phone</label>
                                <input type="text" name="customer_phone" id="customer_phone" class="form-control form-control-sm" value="{{ $data->customer_phone }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

