@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Pemesanan Barang</h3>
            <h6 class="op-7 mb-2">Tambah Item</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ url('pemesanan/tambahItem/'. $converts::encrypt_decrypt('encrypt', $main->id)) }}" class="btn btn-primary btn-round"><i class="fa fa-spinner"></i> Refresh</a>
            <a href="{{ url('pemesanan/baru') }}" class="btn btn-success btn-round"><i class="fa fa-plus"></i> Buat Baru</a>
            <a href="{{ route('pemesanan.index') }}" class="btn btn-info btn-round"><i class="fa fa-table"></i> Daftar</a>
        </div>
    </div>
    @include('additional.alert')
    <form action="{{ route('pemesananDetail.store') }}" method="POST" id="myForm">
    @csrf
    <input type="hidden" name="id_head" id="id_head" value="{{ $main->id }}">
    <div class="row">
        <div class="col-lg-3 p-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div>
                            <h3 class="fw-bold mb-3"># {{ $main->po_number }}</h3>
                        </div>
                        <div class="col-md-12 col-lg-6 p-0">
                            <div class="form-group">
                                <label for="po_date">Tanggal Pesan</label>
                                <input type="date" class="form-control form-control-sm " name="po_date" id="po_date" value="{{ $main->po_date }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 p-0">
                            <div class="form-group">
                                <label for="po_delivery_date">Tanggal Kirim</label>
                                <input type="date" class="form-control form-control-sm" name="po_delivery_date" id="po_delivery_date" value="{{ $main->po_delivery_order }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 p-0">
                            <div class="form-group">
                                <label for="supplier_select">Supplier</label>
                                <select class="form-select" name="supplier_select" id="supplier_select" style="width: 100%" disabled>
                                    <option value=""></option>
                                    @foreach ($list_supplier as $supplier)
                                    <option value="{{ $supplier->id }}" {{ ($supplier->id == $main->id_supplier) ? "selected" : "" }}>{{ $supplier->oid_suppier }} {{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-12 col-lg-12 p-0">
                            <div class="form-group">
                                <label for="inp_remark">Keterangan</label>
                                <input type="text" class="form-control form-control-sm" name="inp_remark" id="inp_remark" maxlength="100" value="{{ $main->po_remark }}" readonly>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-action">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card card-round">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Tambah Item Pemesanan Barang</div>
                    {{-- <div class="card-list"> --}}
                        <div class="row">
                            <div class="col-md-12 col-lg-5 p-0">
                                <div class="form-group">
                                    <label for="po_date">Pilihan Item</label>
                                    <select class="form-control @error('selectItem') is-invalid @enderror" name="selectItem" id="selectItem" data-placeholder="-- Pilihan" style="width: 100%;" onchange="getDetailItem(this)">
                                        <option></option>
                                        @foreach ($list_item as $item)
                                        <option value="{{ $item->id }}">{{ $item->part_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('selectItem'))
                                <div class="invalid-feedback">{{ $errors->first('selectItem') }}</div>
                                @endif
                                </div>
                            </div>
                        {{-- </div>
                        <div class="row"> --}}
                            <div class="col-md-12 col-lg-2 p-0">
                                <div class="form-group">
                                    <label for="inpHarga">Harga Satuan</label>
                                    <input type="text" class="form-control form-control-sm angka" name="inpHarga" id="inpHarga" value="0" style="text-align: right" oninput="refreshCalculate()" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 p-0">
                                <div class="form-group">
                                    <label for="inpQty">Qty</label>
                                    <input type="text" class="form-control form-control-sm angka" name="inpQty" id="inpQty" value="0" style="text-align: right" required oninput="refreshCalculate()">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 p-0">
                                <div class="form-group">
                                    <label for="inpSubTotal">Sub Total</label>
                                    <input type="text" class="form-control form-control-sm angka" name="inpSubTotal" id="inpSubTotal" value="0" style="text-align: right;" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-1 p-0">
                                <div class="form-group">
                                    <label for="tbl_save">Act</label>
                                    <button type="submit" id="tbl_save" class="btn btn-primary btn-sm btn-lg btn-block"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Items Pemesanan Barang</div>
                </div>
                <div class="card-body">
                    <table class="table" style="width: 100%">
                        <thead>
                            <th style="width: 5%" class="text-center">No</th>
                            <th>Items</th>
                            <th style="width: 10%" class="text-center">Qty</th>
                            <th style="width: 20%; text-align: right">Harga&nbsp;Satuan</th>
                            <th style="width: 20%; text-align: right">Sub&nbsp;Total</th>
                            <td style="width: 20%" class="text-center">Act.</td>
                        </thead>
                        <tbody>
                            @php($total=0)
                            @php($nom=1)
                            @foreach ($list_detail as $detail)
                            <tr>
                                <td class="text-center">{{ $nom }}</td>
                                <td>{{ $detail->getParts->part_name }}</td>
                                <td class="text-center">{{ $detail->qty }}</td>
                                <td style="text-align: right">{{ number_format($detail->harga_satuan, 0) }}</td>
                                <td style="text-align: right">{{ number_format($detail->sub_total, 0) }}</td>
                                <td style="text-align: center">
                                    <button type="button" value="{{ $detail->id }}" name="btn-edit[]" id="btn-edit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#formModal" onclick="goEdit(this)"><i class="fa fa-edit"></i></button>
                                    <button type="button" value="{{ $detail->id }}" class="btn btn-danger btn-sm" onclick="konfirmHapus(this)"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            @php($nom++)
                            @php($total+=$detail->sub_total)
                            @endforeach
                            <tr>
                                <td colspan="4"><b>TOTAL</b></td>
                                <td style="text-align: right"><b>{{ number_format($total, 0) }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="v_form"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        window.setTimeout(function () { $(".alert-success").alert('close'); }, 2000);
       $('#selectItem').select2({
            // theme: "classic",
            allowClear: true,
            placeholder: "Select Items",
            height: '36px!important'
        });
        $(".angka").number( true, 0);
    });
    var getDetailItem = function(el)
    {
        clear_text();
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
            },
            dataType: "json",
            url: "{{ url('pemesanan/detailItem') }}",
            // contentType: "application/json",
            type: "POST",
            data: {
                'id_item': $(el).val()
            },
            success: function( response )
            {
                $("#inpHarga").val(response.result);
                $("#inpSubTotal").val(calculate());
            }
        });

    }
    var refreshCalculate = function()
    {
        $("#inpSubTotal").val(calculate());
    }
    function calculate()
    {
        var harga_satuan = $("#inpHarga").val();
        var qty = $("#inpQty").val();
        return harga_satuan * qty;
    }
    function clear_text()
    {
        $("#inpHarga").val(0)
        $("#inpQty").val(0)
        $("#inpSubTotal").val(0)
    }
    var goEdit = function(el)
    {
        $("#v_form").load("{{ url('pemesanan/editItem') }}/"+$(el).val());
    }
    var konfirmHapus = function(el)
    {
        swal({
        title: 'Are you sure?',
        text: 'The item has been delete!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete)
        {
            $.ajax({
                url: "{{ url('pemesanan/deleteDetail') }}/"+$(el).val(),
                type: "GET",
                success:function(response){
                    swal('Success! The selected item has been successfully deleted!', {
                        icon: 'success',
                        buttons: false,
                        timer: 2000
                    }).then(() => {
                        window.location.reload(true);
                    });
                }
            });
        } else {
            swal('Warning! Selected item failed to delete!', {
                icon: 'warning',
            });
        }
        });
    }
    document.querySelector('#myForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting
        swal({
            title: "Are you sure ?",
            text: "Submit this item !",
            type: "warning",
            buttons: {
            confirm: {
                text: "Yes, save it!",
                className: "btn btn-success",
            },
            cancel: {
                visible: true,
                className: "btn btn-danger",
            },
            },
        }).then((result) => {
            // alert(result);
            if (result==true) {
                // If the user confirms, submit the form
                this.submit();
            } else {
                swal.close();
            }
        });
    });
</script>
@endsection

