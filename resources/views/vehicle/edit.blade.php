@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Vehicle</h3>
            <h6 class="op-7 mb-2">Edit Data Vehicle</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('vehicle.index') }}" class="btn btn-primary btn-round">Back</a>
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
                    <div class="card-title">Form Edit Vehicle</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('vehicle/update', $vehicle->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="plat_number">Plat Number</label>
                                <input type="text" class="form-control form-control-sm  @error('plat_number') is-invalid @enderror" name="plat_number" id="plat_number" value="{{ $vehicle->plat_number }}">
                                @if ($errors->has('plat_number'))
                                <div class="invalid-feedback">{{ $errors->first('plat_number') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="type_select">Unit</label>
                                <select class="form-select @error('type_select') is-invalid @enderror" name="type_select" id="type_select">
                                    <option value=""></option>
                                    @foreach ($listType as $type)
                                    <option value="{{ $type->oid_type }}" {{ ($type->oid_type==$vehicle->oid_type) ? "selected" : "" }}>{{ $type->getBrand->brand_name }} {{ $type->getModel->model_name }} {{ $type->type_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('type_select'))
                                <div class="invalid-feedback">{{ $errors->first('type_select') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="year_unit">Year</label>
                                <select class="form-select @error('year_unit') is-invalid @enderror" name="year_unit" id="year_unit">
                                    <option value=""></option>
                                    @for($thn=$startYear; $thn <= $endYear; $thn++)
                                    @if($thn==$vehicle->year)
                                    <option value="{{ $thn }}" selected>{{ $thn }}</option>
                                    @else
                                    <option value="{{ $thn }}">{{ $thn }}</option>
                                    @endif
                                    @endfor
                                </select>
                                @if ($errors->has('year_unit'))
                                <div class="invalid-feedback">{{ $errors->first('year_unit') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="color_select">Color </label>
                                <select class="form-select @error('color_select') is-invalid @enderror" name="color_select" id="color_select">
                                    <option value=""></option>
                                    @foreach ($listColor as $color)
                                    <option value="{{ $color->oid_color }}" {{ ($color->oid_color==$vehicle->oid_color) ? "selected" : "" }}>{{ $color->color_idn }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('color_select'))
                                <div class="invalid-feedback">{{ $errors->first('color_select') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="jenis_select">Jenis</label>
                                <select class="form-select @error('jenis_select') is-invalid @enderror" name="jenis_select" id="jenis_select">
                                    <option value=""></option>
                                    @foreach ($listJenis as $jenis)
                                    <option value="{{ $jenis->oid_jenis }}" {{ ($jenis->oid_jenis==$vehicle->oid_jenis) ? "selected" : "" }}>{{ $jenis->jenis }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('jenis_select'))
                                <div class="invalid-feedback">{{ $errors->first('jenis_select') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="customer_select">Customer</label>
                                <select class="form-select @error('customer_select') is-invalid @enderror" name="customer_select" id="customer_select">
                                    <option value=""></option>
                                    @foreach ($listCustomer as $customer)
                                    <option value="{{ $customer->oid_customer }}" {{ ($customer->oid_customer==$vehicle->oid_customer) ? "selected" : "" }}>{{ $customer->customer_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('customer_select'))
                                <div class="invalid-feedback">{{ $errors->first('customer_select') }}</div>
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
        $('#type_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Type",
            height: '36px!important'
        });
        $('#color_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Color",
            height: '36px!important'
        });
        $('#jenis_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Jenis",
            height: '36px!important'
        });
        $('#year_unit').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Year",
            height: '36px!important'
        });
        $('#customer_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Customer",
            height: '36px!important'
        });
    });
</script>
@endsection

