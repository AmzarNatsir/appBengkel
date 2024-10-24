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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Show Common Color</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="color_idn">Color (IDN / Indonesia)</label>
                                <input type="text" name="color_idn" id="color_idn" class="form-control" value="{{ $data->color_idn }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="color_eng">Color (ENG / English)</label>
                                <input type="text" name="color_eng" id="color_eng" class="form-control" value="{{ $data->color_eng }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

