@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Manajemen Stok</h3>
            <h6 class="op-7 mb-2">Kartu Stok</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('manajemen_stok.kartu_stok.index') }}" class="btn btn-primary btn-round">Refresh</a>
        </div>
    </div>
    <div class="row">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i> Masukkan Nama Stok
                    </a>
                    <div class="navbar-search-block">
                        <div class="input-group ">
                            <input class="form-control" type="search" name="inputSearch" id="inputSearch" placeholder="Search" aria-label="Search" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h3 class="fw-bold mb-3">Data Stok</h3>
            <div class="card card-post card-round">
                <img class="card-img-top" src="{{ asset('assets/img/logo_app.jpg') }}" alt="Card image cap" />
                <div class="card-body">
                    <p class="card-category text-info mb-1 nama_satuan"></p>
                    <h3 class="card-title nama_stok"></h3>
                    <input type="hidden" name="stok_id" id="stok_id" value="">
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <h3 class="fw-bold mb-2">Summary</h3>
            <div class="row">
                {{-- <div class="col-sm-6 col-md-3"> --}}
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-warning bubble-shadow-small"><i class="fas fa-home"></i></div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Awal</p>
                                        <h4 class="card-title stok_awal">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small"><i class="fas fa-upload"></i></div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Masuk</p>
                                        <h4 class="card-title total_masuk">0</h4>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary w-100" onclick="getDataMasuk(this)"><b>Detail</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-danger bubble-shadow-small"><i class="fas fa-download"></i></div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Keluar</p>
                                        <h4 class="card-title total_keluar">0</h4>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-danger w-100" onclick="getDataKeluar(this)"><b>Detail</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small"><i class="fas fa-home"></i></div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Akhir</p>
                                        <h4 class="card-title stok_akhir">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
        <div class="col-md-7">
            <h3 class="fw-bold mb-3">Detail Transaksi</h3>
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm" id="table-transaksi" style="width: 100%" border="1">
                            <thead>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Jumlah</th>
                                <th style="text-align: right">Harga&nbsp;Satuan</th>
                                <th style="text-align: right">Diskon</th>
                                <th style="text-align: right">Sub&nbsp;Total</th>
                            </thead>
                            <tbody class="row_detail"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
        $("#inputSearch").autocomplete({
            source: function(request, response) {
                //Fetch data
                $.ajax({
                    headers : {
                        'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
                    },
                    type: "POST",
				    url: '{{ route("parts_autocomplete_stock_card") }}',
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
                var sisa_stok = ui.item.stok_akhir;
                var sub_total_def = ui.item.harga_jual * 1;
                var file_gambar = ui.item.gambar;
                    if(file_gambar!=null)
                    {
                        path_gambar = "{{ url(Storage::url('parts')) }}/"+file_gambar;
                    } else {
                        path_gambar = "{{ asset('assets/img/logo_app.jpg') }}"
                    }
                $("#inputSearch").val(ui.item.label);
                $(".card-img-top").attr('src', path_gambar);
                $(".nama_satuan").html(ui.item.satuan);
                $(".nama_stok").html(ui.item.part_name);
                $("#stok_id").val(ui.item.value);
                $(".stok_awal").html(ui.item.stok_awal + " " +ui.item.satuan);
                $(".stok_akhir").html(ui.item.stok_akhir + " " +ui.item.satuan);
                $(".total_masuk").html(ui.item.total_masuk + " " +ui.item.satuan);
                $(".total_keluar").html(ui.item.total_keluar + " " +ui.item.satuan);
                $("#inputSearch").val("");
                return false;
            }
        });
    });
    var getDataMasuk = function(el)
    {
        const stok_id = $("#stok_id").val();
        $("#table-transaksi").find("tr:gt(0)").remove();
        var total_qty = 0; total_harga=0, total_diskon=0; total_sub=0;
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
            },
            type: "POST",
            url: '{{ route("getdata.penerimaan") }}',
            dataType: "json",
            data: {
                stok_id: stok_id
            },
            success: function( data ) {
                data.respon.forEach(element => {
                    const dateTrans = new Date(element.tanggal_receive);
                    var content_item = '<tr><td class="text-center">'+dateTrans.toLocaleDateString('en-GB')+'</td>'+
                        '<td class="text-center">'+element.nomor_receive+'</td>'+
                        '<td style="text-align: center">'+element.terima+' '+element.satuan+'</td>'+
                        '<td style="text-align: right">Rp.&nbsp;'+element.harga_satuan.toLocaleString()+'</td>'+
                        '<td style="text-align: right">Rp.&nbsp;'+element.diskon.toLocaleString()+'</td>'+
                        '<td style="text-align: right">Rp.&nbsp;'+element.sub_total.toLocaleString()+'</td>'+'</tr>';
                    $(".row_detail").append(content_item);
                    total_qty+=element.terima;
                    total_harga+=element.harga_satuan;
                    total_diskon+=element.diskon;
                    total_sub+=element.sub_total;
                })
                $(".row_detail").append("<tr><td colspan='2' style='text-align: right'><b>TOTAL</b></td>"+
                    "<td style='text-align: center'><b>"+total_qty+" "+$(".nama_satuan").html()+"</b></td>"+
                    "<td style='text-align: right'><b>Rp.&nbsp"+total_harga.toLocaleString()+"</b></td>"+
                    "<td style='text-align: right'><b>Rp.&nbsp"+total_diskon.toLocaleString()+"</b></td>"+
                    "<td style='text-align: right'><b>Rp.&nbsp"+total_sub.toLocaleString()+"</b></td>"+
                    "</tr>");
            }

        });
    }
    var getDataKeluar = function(el)
    {
        const stok_id = $("#stok_id").val();
        $("#table-transaksi").find("tr:gt(0)").remove();
        var total_qty = 0; total_harga=0, total_diskon=0; total_sub=0;
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '<?php echo csrf_token() ?>'
            },
            type: "POST",
            url: '{{ route("getdata.penjualan") }}',
            dataType: "json",
            data: {
                stok_id: stok_id
            },
            success: function( data ) {
                data.respon.forEach(element => {
                    const dateTrans = new Date(element.tgl_service);
                    var content_item = '<tr><td class="text-center">'+dateTrans.toLocaleDateString('en-GB')+'</td>'+
                        '<td class="text-center">'+element.no_service+'</td>'+
                        '<td style="text-align: center">'+element.jumlah+' '+element.satuan+'</td>'+
                        '<td style="text-align: right">Rp.&nbsp;'+element.harga.toLocaleString()+'</td>'+
                        '<td style="text-align: right">Rp.&nbsp;0</td>'+
                        '<td style="text-align: right">Rp.&nbsp;'+element.sub_total.toLocaleString()+'</td>'+'</tr>';
                    $(".row_detail").append(content_item);
                    total_qty+=element.jumlah;
                    total_harga+=element.harga;
                    total_sub+=element.sub_total;
                })
                $(".row_detail").append("<tr><td colspan='2' style='text-align: right'><b>TOTAL</b></td>"+
                    "<td style='text-align: center'><b><span class='badge badge-primary'>"+total_qty+" "+$(".nama_satuan").html()+"</span></b></td>"+
                    "<td style='text-align: right'><b><span class='badge badge-primary'>Rp.&nbsp"+total_harga.toLocaleString()+"</span></b></td>"+
                    "<td style='text-align: right'><b><span class='badge badge-primary'>Rp.&nbsp"+total_diskon.toLocaleString()+"</span></b></td>"+
                    "<td style='text-align: right'><b><span class='badge badge-primary'>Rp.&nbsp"+total_sub.toLocaleString()+"</span></b></td>"+
                    "</tr>");
            }

        });
    }
</script>
@endsection

