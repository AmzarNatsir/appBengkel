@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Common</h3>
            <h6 class="op-7 mb-2">Common Satuan</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ url('common/satuan') }}" class="btn btn-primary btn-round">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Show Common Satuan</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" id="satuan" class="form-control" value="{{ $data->satuan }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

