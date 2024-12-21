@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Penerimaan Barang</h3>
            <h6 class="op-7 mb-2">Baru</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('penerimaan.baru') }}" class="btn btn-primary btn-round"><i class="fa fa-spinner"></i> Refresh</a>
        </div>
    </div>
    @include('additional.alert')
    <form action="{{ route('penerimaan.store') }}" method="POST" id="myForm">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-2 p-0">
                            <div class="form-group">
                                <label for="receive_date">Tanggal Penerimaan</label>
                                <input type="date" class="form-control form-control-sm" name="receive_date" id="receive_date" value="" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-5 p-0">
                            <div class="form-group">
                                <label for="po_select">Pilihan Pemesanan</label>
                                <select class="form-select @error('po_select') is-invalid @enderror" name="po_select" id="po_select" style="width: 100%" required>
                                    <option value=""></option>
                                    @foreach ($list_po as $list)
                                    <option value="{{ $list->id }}" {{ (Old('po_select')==$list->id) ? "selected" : "" }}>{{ $list->po_number }} | {{ $list->getSupplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('po_select'))
                                <div class="invalid-feedback">{{ $errors->first('po_select') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-5 p-0">
                            <div class="form-group">
                                <label for="inp_remark">Keterangan</label>
                                <input type="text" class="form-control form-control-sm" name="inp_remark" id="inp_remark" maxlength="100" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="table_list" style="width: 100%" cellpadding="3">
                        <thead style="background-color: rgb(54, 100, 197); color:white">
                            <th style="width: 2%">Act.</th>
                            <th class="text-center">Items</th>
                            <th class="text-center" style="width: 8%">Terima</th>
                            <th class="text-center" style="width: 8%">Order</th>
                            <th class="text-center" style="width: 10%">Satuan</th>
                            <th class="text-center" style="width: 15%">Harga</th>
                            <th class="text-center" style="width: 15%">Disc&nbsp;(Rp)</th>
                            <th class="text-center" style="width: 15%">Sub&nbsp;Total</th>
                        </thead>
                        <tbody class="row_detail"></tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th colspan="4" class="nomor_po">Nomor PO :</th>
                                <th colspan="2">Total</th>
                                <th><input type="text" class="form-control form-control-sm angka" name="inp_total" id="inp_total" value="0" style="text-align: right" readonly></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th colspan="4" class="tanggal_po">Tanggal PO :</th>
                                <th colspan="2">Biaya lain-lain</th>
                                <th><input type="text" class="form-control form-control-sm angka" name="inp_biaya_lain_lain" id="inp_biaya_lain_lain" value="0" style="text-align: right" readonly oninput="add_biaya()" onblur="to_null(this)"></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th colspan="4" class="ket_po">Keterangan PO :</th>
                                <th colspan="2">Ppn</th>
                                <th><input type="text" class="form-control form-control-sm angka" name="inp_ppn" id="inp_ppn" value="0" style="text-align: right" readonly oninput="add_biaya()" onblur="to_null(this)"></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th colspan="4">Cara Bayar : &nbsp;&nbsp;
                                    <div class="form-check form-check-inline p-0">
                                        <input class="form-check-input" type="radio" name="cara_bayar" id="cara_bayar_1" value="Cash" checked onclick="add_uang_muka(this)">
                                        <label class="form-check-label" for="cara_bayar_1">Cash</label>
                                      </div>
                                      <div class="form-check form-check-inline p-0">
                                        <input class="form-check-input" type="radio" name="cara_bayar" id="cara_bayar_2" value="Credit" onclick="add_uang_muka(this)">
                                        <label class="form-check-label" for="cara_bayar_2">Credit</label>
                                      </div>
                                </th>
                                <th colspan="2">Total Net</th>
                                <th><input type="text" class="form-control form-control-sm angka" name="inp_total_net" id="inp_total_net" value="0" style="text-align: right" readonly></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th colspan="4"></th>
                                <th colspan="2">Uang Muka</th>
                                <th><input type="text" class="form-control form-control-sm angka" name="inp_uang_muka" id="inp_uang_muka" value="0" style="text-align: right" readonly></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-action" style="text-align: center">
                    <button type="submit" class="btn btn-success btn-round" id="tbl_submit" name="tbl_submit" disabled>Submit</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        window.setTimeout(function () { $(".alert-success").alert('close'); }, 2000);
        aktif_teks_foot(true);
       $('#po_select').select2({
            // theme: "classic",
            allowClear: true,
            placeholder: "Select Purchase Order",
            height: '36px!important'
        }).on('change', function(el){
            $("#table_list tbody").empty();
            aktif_teks_foot(false);
            $("#inp_uang_muka").attr("readonly", true);
            var data = $("#po_select option:selected").val();
            $.ajax({
                url: "{{ route('penerimaan.get_po')}}",
                type : 'post',
                headers : {
                    'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
                },
                data : {id:data},
                dataType: 'json',
                success : function(res)
                {
                    var result_head = res.respon.head_po;
                    var result_detail = res.respon.detail_po;
                    console.log(result_head);
                    var content_head = '';
                    $(".nomor_po").html("Nomor PO : "+result_head.po_number);
                    $(".tanggal_po").html("Tanggal PO : "+result_head.po_date);
                    $(".ket_po").html("Keterangan PO : "+result_head.po_remark);
                    result_detail.forEach(element => {
                        console.log(element);
                        var content_item = '<tr class="rows_item" name="rows_item[]"><td><div class="form-check"><input class="form-check-input" type="checkbox" value="'+element.id+'" id="flexCheckDefault" name="check_item[]" onclick="pilihItem(this)"></div></td>'+
                        '<td><input type="hidden" name="id_row[]" value="'+element.id_part+'"><input type="text" class="form-control form-control-sm" name="nama_item[]" value="'+element.get_parts.oid_part+" - "+element.get_parts.part_name+'" readonly></td>'+
                        '<td><input type="text" class="form-control form-control-sm angka" name="qty_diterima[]" value="'+element.qty+'" style="text-align: right" oninput="hitungSubTotal(this)" readonly></td>'+
                        '<td><input type="text" class="form-control form-control-sm angka" name="qty_dipesan[]" value="'+element.qty+'" style="text-align: right" readonly></td>'+
                        '<td><input type="text" class="form-control form-control-sm" name="part_satuan[]" value="'+element.get_parts.get_satuan.satuan+'" readonly></td>'+
                        '<td class="text-right"><input type="hidden" name="temp_harga_satuan[]" value="'+element.harga_satuan+'"><input type="text" class="form-control form-control-sm angka" name="harga_satuan[]" value="'+element.harga_satuan+'" style="text-align: right" oninput="hitungSubTotal(this)" readonly></td>'+
                        '<td class="text-right"><input type="text" class="form-control form-control-sm angka" name="diskon[]" value="0" style="text-align: right" oninput="hitungSubTotal(this)" readonly></td>'+
                        '<td class="text-right"><input type="text" class="form-control form-control-sm angka" name="item_sub_total[]" value="'+parseFloat(element.harga_satuan) * parseFloat(element.qty)+'" class="form-control" style="text-align: right" readonly></td>'+
                        '</tr>';
                        $(".row_detail").append(content_item);
                        $(".angka").number( true, 0);
                        total();
                    });
                }
            });
        });
        $(".angka").number( true, 0);
    });
    function pilihItem(el) {
        var id_pilihan = $(el).val();
        if($(el).prop('checked')) {
            aktif_teks(el, false);
        } else {
            aktif_teks(el, true);
            uncheck(el);
        }


    }

    var hitungSubTotal = function(el){
        var currentRow=$(el).closest("tr");
        var jumlah = currentRow.find('td:eq(2) input[name="qty_diterima[]"]').val();
        var harga = currentRow.find('td:eq(5) input[name="harga_satuan[]"]').val();
        var diskon = currentRow.find('td:eq(6) input[name="diskon[]"]').val();
        var sub_total = (parseFloat(jumlah) * parseFloat(harga)) - parseFloat(diskon);
        currentRow.find('td:eq(7) input[name="item_sub_total[]"]').val(sub_total);
        total();
    }

    var total = function(){

        var total = 0;
        var sub_total = 0;
        $.each($('input[name="item_sub_total[]"]'),function(key, value){
            sub_total = $(value).val() ?  $(value).val() : 0;
            total += parseFloat($(value).val());
        });
        var b_lain = $("#inp_biaya_lain_lain").val();
        var b_ppn = $("#inp_ppn").val();
        var n_total = parseFloat(b_lain) + parseFloat(b_ppn) + parseFloat(total);
        $("#inp_total").val(total);
        $("#inp_total_net").val(n_total);
        // $("#lbl_total").html(nf.format(total));
    }

    function to_null(el)
    {
        if($(el).val()=="")
        {
            $(el).val("0");
        }
        total();
    }

    function add_biaya()
    {
        total();
    }

    function add_uang_muka(el)
    {
        $("#inp_uang_muka").val("0");
        if($(el).val() === "Cash") {
            $("#inp_uang_muka").attr("readonly", true);
        } else {
            $("#inp_uang_muka").attr("readonly", false);
        }
    }

    function uncheck(el)
    {
        var currentRow=$(el).closest("tr");
        currentRow.find('td:eq(2) input[name="qty_diterima[]"]').val(currentRow.find('td:eq(3) input[name="qty_dipesan[]"]').val());
        currentRow.find('td:eq(5) input[name="harga_satuan[]"]').val(currentRow.find('td:eq(5) input[name="temp_harga_satuan[]"]').val());
        currentRow.find('td:eq(6) input[name="diskon[]"]').val("0");
        hitungSubTotal(el);
    }

    function aktif_teks(el, tf)
    {
        var currentRow=$(el).closest("tr");
        currentRow.find('td:eq(2) input[name="qty_diterima[]"]').attr('readonly', tf);
        currentRow.find('td:eq(5) input[name="harga_satuan[]"]').attr('readonly', tf);
        currentRow.find('td:eq(6) input[name="diskon[]"]').attr('readonly', tf);
    }

    function aktif_teks_foot(tf)
    {
        $("#inp_biaya_lain_lain").val("0");
        $("#inp_ppn").val("0");
        $("#inp_total").val("0");
        $("#inp_total_net").val("0");
        $("#inp_biaya_lain_lain").attr("readonly", tf);
        $("#inp_ppn").attr("readonly", tf);
        $("#inp_uang_muka").attr("readonly", tf);
        $("#cara_bayar_1").attr("cara_bayar_1", 'checked');
        $("#tbl_submit").attr("disabled", tf);
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

