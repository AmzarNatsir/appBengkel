@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Supplier</h3>
            <h6 class="op-7 mb-2">Detail Data Supplier</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('supplier.index') }}" class="btn btn-primary btn-round">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Data Supplier</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="supplier_name">Supplier Name</label>
                                <input type="text" name="supplier_name" id="supplier_name" class="form-control form-control-sm" value="{{ $data->supplier_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="supplier_address">Supplier Address</label>
                                <input type="text" name="supplier_address" id="supplier_address" class="form-control form-control-sm" value="{{ $data->supplier_address }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="supplier_email">Supplier Email</label>
                                <input type="text" name="supplier_email" id="supplier_email" class="form-control form-control-sm" value="{{ $data->supplier_email }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="supplier_phone">Supplier Phone</label>
                                <input type="text" name="supplier_phone" id="supplier_phone" class="form-control form-control-sm" value="{{ $data->supplier_phone }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

