@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Common</h3>
            <h6 class="op-7 mb-2">Common Model Brand</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ url('common/model') }}" class="btn btn-primary btn-round">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Show Common Model Brand</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="model_name">Model</label>
                                <input type="text" name="model_name" id="model_name" class="form-control form-control-sm" value="{{ $data->model_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="brand_name">Brand</label>
                                <input type="text" name="brand_name" id="brand_name" class="form-control form-control-sm" value="{{ $data->getBrand->brand_name }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

