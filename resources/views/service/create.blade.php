@extends('partial.app')
@section('content')
<style type="text/css">

    input[type=number]
    {
      -moz-appearance: textfield;
    }
    html .ui-autocomplete { width:1px; } /* without this, the menu expands to 100% in IE6 */
    .ui-menu {
        list-style:none;
        padding: 2px;
        margin: 0;
        display:block;
        float: left;
    }
    .ui-menu .ui-menu {
        margin-top: -3px;
    }
    .ui-menu .ui-menu-item {
        margin:0;
        padding: 0;
        zoom: 1;
        float: left;
        clear: left;
        width: 100%;
    }
    .ui-menu .ui-menu-item a {
        text-decoration:none;
        display:block;
        padding:.2em .4em;
        line-height:1.5;
        zoom:1;
    }
    .ui-menu .ui-menu-item a.ui-state-hover,
    .ui-menu .ui-menu-item a.ui-state-active {
        font-weight: normal;
        margin: -1px;
    }
    </style>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Service</h3>
            <h6 class="op-7 mb-2">Baru</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('service.baru') }}" class="btn btn-primary btn-round"><i class="fa fa-spinner"></i> Refresh</a>
        </div>
    </div>
    @include('additional.alert')
    <form action="{{ route('service.store') }}" method="POST" id="myForm">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-2 p-0">
                            <div class="form-group">
                                <label for="receive_date">Tanggal Service</label>
                                <input type="date" class="form-control form-control-sm @error('tgl_service') is-invalid @enderror" name="tgl_service" id="tgl_service" value="{{ date('Y-m-d') }}">
                                @if ($errors->has('tgl_service'))
                                <div class="invalid-feedback">{{ $errors->first('tgl_service') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-5 p-0">
                            <div class="form-group">
                                <label for="unit_select">Unit</label>
                                <select class="form-select @error('unit_select') is-invalid @enderror" name="unit_select" id="unit_select" style="width: 100%">
                                    <option value=""></option>
                                    @foreach ($unit as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->plat_number }} - {{ $unit->getType->getBrand->brand_name." ".$unit->getType->getModel->model_name." ".$unit->getType->type_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('unit_select'))
                                <div class="invalid-feedback">{{ $errors->first('unit_select') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-5 p-0">
                            <div class="form-group">
                                <label for="inp_customer">Pelanggan</label>
                               <input type="text" class="form-control form-control-sm" name="inp_customer" id="inp_customer" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 p-0">
                            <div class="form-group">
                                <label for="inp_deskripsi">Deskripsi Service</label>
                                <textarea name="inp_deskripsi" id="inp_deskripsi" class="form-control form-control-sm @error('inp_deskripsi') is-invalid @enderror"></textarea>
                                @if ($errors->has('inp_deskripsi'))
                                <div class="invalid-feedback">{{ $errors->first('inp_deskripsi') }}</div>
                                @endif
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
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-job-tab" data-bs-toggle="pill" data-bs-target="#pills-job" type="button" role="tab" aria-controls="pills-job" aria-selected="true"><i class="fa fa-wrench"></i> Pekerjaan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-parts-tab" data-bs-toggle="pill" data-bs-target="#pills-parts" type="button" role="tab" aria-controls="pills-parts" aria-selected="false"><i class="fa fa-cog"></i> Parts</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-job" role="tabpanel" aria-labelledby="pills-job-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                                            <i class="fas fa-search"></i> Masukkan Item Pekerjaan
                                        </a>
                                        <div class="navbar-search-block">
                                            <div class="input-group ">
                                                <input class="form-control" type="search" name="inputSearchPekerjaan" id="inputSearchPekerjaan" placeholder="Search" aria-label="Search" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card-body">
                                        <div class="col-md-12 col-lg-12">
                                            <table class="table table_list" style="width: 100%" cellpadding="3">
                                                <thead style="background-color: rgb(54, 100, 197); color:white">
                                                    <th style="width: 5%">No</th>
                                                    <th>Pekerjaan</th>
                                                    <th style="width: 30%">Kategori</th>
                                                    <th style="width: 20%">Harga</th>
                                                </thead>
                                                <tbody class="row_detail_pekerjaan"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-parts" role="tabpanel" aria-labelledby="pills-parts-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6">
                                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                                            <i class="fas fa-search"></i> Masukkan Item Part
                                        </a>
                                        <div class="navbar-search-block">
                                            <div class="input-group ">
                                                <input class="form-control" type="search" name="inputSearch" id="inputSearch" placeholder="Search" aria-label="Search" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="card-body">
                                        <div class="col-md-12 col-lg-12">
                                            <table id="table_list" class="table" style="width: 100%" cellpadding="3">
                                                <thead style="background-color: rgb(54, 100, 197); color:white">
                                                    <th class="text-center" style="width: 5%">No</th>
                                                    <th class="text-center">Items</th>
                                                    <th class="text-center" style="width: 10%">Satuan</th>
                                                    <th class="text-center" style="width: 15%">Jumlah</th>
                                                    <th class="text-center" style="width: 15%">Harga</th>
                                                    <th class="text-center" style="width: 15%">Sub&nbsp;Total</th>
                                                </thead>
                                                <tbody class="row_detail"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

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
                        <tfoot>
                            <tr>
                                <th style="width: 50%">
                                    Cara Bayar : &nbsp;&nbsp;
                                    <div class="form-check form-check-inline p-0">
                                        <input class="form-check-input" type="radio" name="cara_bayar" id="cara_bayar_1" value="Cash" checked onclick="add_uang_muka(this)">
                                        <label class="form-check-label" for="cara_bayar_1">Cash</label>
                                      </div>
                                      <div class="form-check form-check-inline p-0">
                                        <input class="form-check-input" type="radio" name="cara_bayar" id="cara_bayar_2" value="Credit" onclick="add_uang_muka(this)">
                                        <label class="form-check-label" for="cara_bayar_2">Credit</label>
                                      </div>
                                </th>
                                <th style="width: 30%">Total Pekerjaan (Rp.)</th>
                                <th colspan="2"><input type="text" class="form-control form-control-sm angka" name="inp_total_pekerjaan" id="inp_total_pekerjaan" value="0" style="text-align: right" readonly></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Total Parts (Rp.)</th>
                                <th colspan="2"><input type="text" class="form-control form-control-sm angka" name="inp_total_parts" id="inp_total_parts" value="0" style="text-align: right" readonly></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Total (Pekerjaan + Parts) (Rp.)</th>
                                <th colspan="2"><input type="text" class="form-control form-control-sm angka" name="inp_total_a_b" id="inp_total_a_b" value="0" style="text-align: right" readonly></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    <input class="form-check-input" type="checkbox" value="1" id="check_diskon" name="check_diskon" onchange="checkDiskon(this)">
                                    <label class="form-check-label" for="check_diskon">
                                        Diskon (Rp.)
                                    </label>
                                </th>
                                <th colspan="2"><input type="text" class="form-control form-control-sm angka" name="inp_diskon" id="inp_diskon" value="0" style="text-align: right" oninput="hitung_diskon()" readonly></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    <input class="form-check-input" type="checkbox" value="1" id="check_ppn" name="check_ppn" onchange="checkPpn(this)">
                                    <label class="form-check-label" for="check_ppn">
                                        Ppn
                                    </label>
                                </th>
                                <th style="width: 5%"><input type="text" class="form-control form-control-sm angka" name="inp_ppn_persen" id="inp_ppn_persen" value="0" style="text-align: right" readonly></th>
                                <th>
                                    <input type="text" class="form-control form-control-sm angka" name="inp_ppn_rupiah" id="inp_ppn_rupiah" value="0" style="text-align: right" readonly>
                                </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Total Net</th>
                                <th colspan="2"><input type="text" class="form-control form-control-sm angka" name="inp_total_net" id="inp_total_net" value="0" style="text-align: right" readonly></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-action" style="text-align: center">
                    <button type="submit" class="btn btn-success btn-round" id="tbl_submit" name="tbl_submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        window.setTimeout(function () { $(".alert-success").alert('close'); }, 2000);
        // aktif_teks_foot(true);
        hapus_teks_total();
       $('#unit_select').select2({
            // theme: "classic",
            allowClear: true,
            placeholder: "Pilihan Unit",
            height: '36px!important'
        }).on('change', function(el){
            $("#inp_customer").val("");
            var data = $(".form-select option:selected").val();
            $.ajax({
                url: "{{ route('service.get_unit_customer')}}",
                type : 'post',
                headers : {
                    'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
                },
                data : {id:data},
                dataType: 'json',
                success : function(res)
                {
                    $("#inp_customer").val(res.result);
                }
            })
        });
        $(".angka").number( true, 0);
        //select parts
        $("#inputSearch").autocomplete({
            source: function(request, response) {
                //Fetch data
                $.ajax({
                    headers : {
                        'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
                    },
                    type: "POST",
				    url: '{{ route("autocomplete_parts") }}',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response(data);
                    }

                });
            },
            select: function(event, ui) {
                if(ui.item.stok_akhir <= 0)
                {
                    alert("Persediaan Stok Habis");
                } else {
                    var sisa_stok = ui.item.stok_akhir;
                    var sub_total_def = ui.item.harga_jual * 1;
                    $("#inputSearch").val(ui.item.label);
                    var content_item = '<tr class="rows_item" name="rows_item_part[]"><td><input type="hidden" name="id_row_part[]" value=""><input type="hidden" name="current_stok[]" value='+sisa_stok+'><button type="button" title="Hapus Baris" class="btn btn-danger btn-sm waves-effect waves-light" onclick="hapus_item(this)"><i class="fa fa-minus"></i></button></td>'+'<td><input type="hidden" name="part_id[]" value="'+ui.item.value+'"><label style="color: blue; font-size: 11pt">'+ui.item.part_name+'</label></td>'+'<td style="text-align: center"><label style="color: blue; font-size: 11pt">'+ui.item.satuan+'</label></td>'+'<td align="center"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-sm btn-primary" name="tbl_minus[]" onClick="min_qty(this)"><i class="fa fa-minus"></i></button></span><input type="number" min="1" max="'+sisa_stok+'" id="part_qty[]" name="part_qty[]" class="form-control form-control-sm" value="1" style="text-align:center" readonly><span class="input-group-btn"><button type="button" class="btn btn-sm btn-primary" name="tbl_plus[]" onClick="add_qty(this)"><i class="fa fa-plus"></i></button></span></div></td>'+'<td class="text-right"><input type="text" class="form-control form-control-sm angka" id="harga_satuan[]" name="harga_satuan[]" value="'+ui.item.harga_jual+'" style="text-align: right" onInput=hitungSubTotal(this)></td>'+'<td class="text-right"><input type="text" name="part_sub_total[]" value="'+sub_total_def+'" class="form-control form-control-sm text-right angka" style="text-align: right" readonly></td>'+'</tr>';
                    $(".row_detail").after(content_item);
                    $('.angka').number( true, 0 );
                    $("#inputSearch").val("");
                    total_parts();
                }
                return false;
            }

        });

        //select pekerjaan
        $("#inputSearchPekerjaan").autocomplete({
            source: function(request, response) {
                //Fetch data
                $.ajax({
                    headers : {
                        'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
                    },
                    type: "POST",
				    url: '{{ route("autocomplete_pekerjaan") }}',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response(data);
                    }

                });
            },
            select: function(event, ui) {
                var biaya = ui.item.biaya;
                // var sub_total_def = ui.item.harga_jual * 1;
                $("#inputSearchPekerjaan").val(ui.item.label);
                var content_item = '<tr class="rows_item_jasa" name="rows_item_jasa[]"><td><input type="hidden" name="id_row_jasa[]" value=""><button type="button" title="Hapus Baris" class="btn btn-danger btn-sm waves-effect waves-light" onclick="hapus_item_jasa(this)"><i class="fa fa-minus"></i></button></td>'+'<td><input type="hidden" name="item_id_jasa[]" value="'+ui.item.value+'"><label style="color: blue; font-size: 11pt">'+ui.item.pekerjaan+'</label></td>'+'<td style="text-align: center"><label style="color: blue; font-size: 11pt">'+ui.item.kategori+'</label></td>'+'<td class="text-right"><input type="text" name="biaya_jasa[]" value="'+ui.item.biaya+'" class="form-control form-control-sm text-right angka" style="text-align: right" readonly></td>'+'</tr>';
                $(".row_detail_pekerjaan").after(content_item);
                $('.angka').number( true, 0 );
                $("#inputSearchPekerjaan").val("");
                total_jasa();
                return false;
            }

        });
    });

    var checkDiskon = function(el)
    {
        // var check= $(el).val();
        if ($(el).is(":checked")) {
            $("#inp_diskon").val("0");
            $("#inp_diskon").attr("readonly", false);
        } else {
            $("#inp_diskon").val("0");
            $("#inp_diskon").attr("readonly", true);
        }
        hitung_total_net();
    }

    var hitung_diskon = function()
    {
        hitung_total_net();
    }

    var checkPpn = function(el)
    {
        const total = $("#inp_total_a_b").val();
        if ($(el).is(":checked")) {
            getPpn_value(total);
        } else {
            $("#inp_ppn_persen").val("0");
            $("#inp_ppn_rupiah").val("0");
            hitung_total_net();
        }

    }

    var hitung_ppn = function()
    {
        hitung_total_net();
    }

    var changeToNull = function(el)
    {
        if($(el).val()=="")
        {
            $(el).val("0");
        }
    }

    var add_qty = function(el)
    {
        var sisa_stok = $(el).parent().parent().find('input[name="current_stok[]"]');
        var input = $(el).parent().parent().find('input[name="part_qty[]"]'),
            min = input.attr("min"),
            max = input.attr("max");
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        // input.val(newVal);
        $(el).parent().parent().find('input[name="part_qty[]"]').val(newVal);
        hitungSubTotal(el);
        // hitung_total_net();
    }

    var min_qty = function(el)
    {
        var input = $(el).parent().parent().find('input[name="part_qty[]"]'),
            min = input.attr("min"),
            max = input.attr("max");
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        //input.val(newVal);
        $(el).parent().parent().find('input[name="part_qty[]"]').val(newVal);
        hitungSubTotal(el);
        // hitung_total_net();
    }
    var hitungSubTotal = function(el){
        var currentRow=$(el).closest("tr");
        var jumlah = $(el).parent().parent().find('input[name="part_qty[]"]').val();
        var harga = currentRow.find('td:eq(4) input[name="harga_satuan[]"]').val();
        var sub_total = parseFloat(jumlah) * parseFloat(harga);
        currentRow.find('td:eq(5) input[name="part_sub_total[]"]').val(sub_total);
        total_parts();
        // hitung_total();
    }

    var hapus_item = function(el){
        $(el).parent().parent().slideUp(100,function(){
            $(this).remove();
            total_parts();
        });
    }

    var total_parts = function(){
        var total = 0;
        var sub_total = 0;
        $.each($('input[name="part_sub_total[]"]'),function(key, value){
            sub_total = $(value).val() ?  $(value).val() : 0;
            total += parseFloat($(value).val());
        })
        $("#inp_total_parts").val(total);
        hitung_total();
        hitung_total_net();
    }

    //pekerjaan/jasa
    var hapus_item_jasa = function(el){
        $(el).parent().parent().slideUp(100,function(){
            $(this).remove();
            total_jasa();
        });
    }

    var total_jasa = function(){
        var total = 0;
        var sub_total = 0;
        $.each($('input[name="biaya_jasa[]"]'),function(key, value){
            sub_total = $(value).val() ?  $(value).val() : 0;
            total += parseFloat($(value).val());
        })
        $("#inp_total_pekerjaan").val(total);
        hitung_total();
        hitung_total_net();
    }

    function hitung_total()
    {
        var total_parts = $("#inp_total_parts").val();
        var total_pekerjaan = $("#inp_total_pekerjaan").val();
        var total_a_b = parseFloat(total_parts) + parseFloat(total_pekerjaan);
        $("#inp_total_a_b").val(total_a_b);
    }

    function hitung_total_net()
    {
        var total_a_b = $("#inp_total_a_b").val();
        var diskon_rupiah = $("#inp_diskon").val();
        var ppn_rupiah = $("#inp_ppn_rupiah").val();
        var total_net = (total_a_b - diskon_rupiah) + parseInt(ppn_rupiah);
        $("#inp_total_net").val(total_net);
    }

    function hapus_teks_total()
    {
        $("#inp_total_pekerjaan").val('0');
        $("#inp_total_parts").val('0');
        $("#inp_total_a_b").val("0");
        $("#inp_diskon").val('0');
        $("#inp_ppn_persen").val('0');
        $("#inp_ppn_rupiah").val('0');
        $("#inp_total_net").val('0');
        $("#check_diskon").prop("checked", false);
        $("#check_ppn").prop("checked", false);
    }

    function getPpn_value(total)
    {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
            },
            type: "get",
            url: '{{ route("data.ppn") }}',
            dataType: "json",
            success: function( data ) {
                const n_ppn = data.result;
                const ppn = total * (n_ppn / 100);
                $("#inp_ppn_persen").val(data.result);
                $("#inp_ppn_rupiah").val(ppn);
                hitung_total_net();
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

