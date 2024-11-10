@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Purchase Order</h3>
            <h6 class="op-7 mb-2">New Purchase Order</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('purchaseOrder.index') }}" class="btn btn-primary btn-round">Refresh</a>
        </div>
    </div>
    @include('additional.alert')
    @endif
    <form action="{{ url('purchase_order/update') }}" method="POST">
    @csrf
    <input type="text" name="id_head" id="id_head" value="{{ $main->id }}">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="po_date">PO Date</label>
                                <input type="date" class="form-control form-control-sm  @error('po_date') is-invalid @enderror" name="plat_number" id="plat_number">
                                @if ($errors->has('po_date'))
                                <div class="invalid-feedback">{{ $errors->first('po_date') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="po_delivery_date">Delivery Date</label>
                                <input type="date" class="form-control form-control-sm  @error('po_delivery_date') is-invalid @enderror" name="plat_number" id="plat_number">
                                @if ($errors->has('po_delivery_date'))
                                <div class="invalid-feedback">{{ $errors->first('po_delivery_date') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="supplier_select">Supplier</label>
                                <select class="form-select @error('supplier_select') is-invalid @enderror" name="supplier_select" id="supplier_select" style="width: 100%">
                                    <option value=""></option>
                                    @foreach ($list_supplier as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->oid_suppier }} {{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('supplier_select'))
                                <div class="invalid-feedback">{{ $errors->first('supplier_select') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="inp_remark">Remarks</label>
                                <input type="text" class="form-control form-control-sm @error('inp_remark') is-invalid @enderror" name="inp_keterangan" id="inp_keterangan" maxlength="100">
                                @if ($errors->has('inp_remark'))
                                <div class="invalid-feedback">{{ $errors->first('inp_remark') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Item Purchase Order</div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        window.setTimeout(function () { $(".alert-success").alert('close'); }, 2000);
       $('#supplier_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Supplier",
            height: '36px!important'
        });
        $(".angka").number( true, 0);
    });
    // var addRow = function()
    // {
    //     // alert("hmmmm");
    //     var barisKe = totalRow();
    //     $.ajax({
    //         headers : {
    //             'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
    //         },
    //         url: "{{ url('purchase_order/newItems') }}",
    //         contentType: "application/json",
    //         type: "POST",
    //         dataType: "json",
    //         // data: JSON.stringify(obj),
    //         success: function( response )
    //         {
    //             var content_item = '';
    //             content_item = '<div class="form-group row"><div class="col-sm-8"><select class="form-control select2bs4" name="selBarang[]" id="selBarang'+barisKe()+'" data-placeholder="-- Pilihan" style="width: 100%;" required><option></option>';
    //             $.each(response.data.items, function(key, dataItems) {
    //                 content_item += '<option value="'+dataItems.id+'">'+dataItems.oid_part+' | '+ dataItems.part_name +' </option>';
    //             });
    //             content_item += '</select></div>';
    //             $(".item_rows").append(content_item);
    //             $('.angka').number( true, 0 );
    //             $('select').last().select2({
    //                 theme: 'classic',
    //                 placeholder: "Select Items",
    //                 allowClear: true,
    //             });

    //             // $(".item_rows");
    //         }
    //     });
    // }
    // function totalRow()
    // {
    //     var total = 1;
    //     $.each($('select[name="items_select[]"]'),function(key, value){
    //         total++;
    //     });
    //     return total;
    // }
</script>
@endsection

