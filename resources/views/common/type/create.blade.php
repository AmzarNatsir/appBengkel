@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Common</h3>
            <h6 class="op-7 mb-2">Common Type Unit</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ url('common/type') }}" class="btn btn-primary btn-round">Back</a>
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
                    <div class="card-title">Form Add Type</div>
                </div>
                <div class="card-body">
                    <form action="{{ url('common/typeStore') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label for="type_name">Type</label>
                                    <input type="text" name="type_name" id="type_name" class="form-control form-control-sm @error('type_name') is-invalid @enderror">
                                    @if ($errors->has('type_name'))
                                    <div class="invalid-feedback">{{ $errors->first('type_name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label for="brand_select">Brand</label>
                                    <select class="form-select @error('brand_select') is-invalid @enderror" name="brand_select" id="brand_select">
                                        <option value=""></option>
                                        @foreach ($listBrand as $brand)
                                        <option value="{{ $brand->oid_brand }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('brand_select'))
                                    <div class="invalid-feedback">{{ $errors->first('brand_select') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label for="model_select">Model</label>
                                    <select class="form-select @error('model_select') is-invalid @enderror" name="model_select" id="model_select">
                                        <option value=""></option>
                                    </select>
                                    @if ($errors->has('model_select'))
                                    <div class="invalid-feedback">{{ $errors->first('model_select') }}</div>
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
        let $selectModel =  $('#model_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Model",
            height: '36px!important'
        });
        $('#brand_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Brand",
        }).on('change', function(el) {
            $selectModel.empty().trigger('change');
            var data = $("#brand_select option:selected").val();
            $.ajax({
                url: "{{ route('json.model')}}",
                type : 'post',
                headers : {
                    'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
                },
                data : {id:data},
                dataType: 'json',
                success : function(res)
                {
                    let selectedOption = res.results;
                    $.each(selectedOption, function(key, value){
                        $selectModel.append("<option value="+value.oid_model+">"+value.text+"</option>");
                    });
                }
            });
        });


    });
</script>
@endsection

