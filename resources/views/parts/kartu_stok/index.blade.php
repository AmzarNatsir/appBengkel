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

                </div>
                <div class="card-footer">
                    <div class="row user-stats text-center">
                        <div class="col">
                        <div class="stok_awal">0</div>
                        <div class="title">Stok Awal</div>
                        </div>
                        <div class="col">
                        <div class="stok_akhir">0</div>
                        <div class="title">Stok Akhir</div>
                        </div>
                    </div>
                </div>
                <div class="separator-solid"></div>
                <a href="#" class="btn btn-primary btn-rounded btn-sm">Read More</a>
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
                                    <div class="icon-big text-center icon-primary bubble-shadow-small"><i class="fas fa-upload"></i></div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Masuk</p>
                                        <h4 class="card-title total_masuk">0</h4>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary w-100"><b>Detail</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small"><i class="fas fa-download"></i></div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Keluar</p>
                                        <h4 class="card-title total_keluar">0</h4>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-success w-100"><b>Detail</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
        <div class="col-md-7">
            <h3 class="fw-bold mb-3">Detail Transaksi</h3>
            <table class="table">
                <thead>
                    <th>No.</th>
                    <th>Tgl.Transaksi</th>
                    <th>No.Transaksi</th>
                    <th>Jumlah</th>
                </thead>
            </table>
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
                $(".nama_stok").html(ui.item.part_name);
                $(".nama_satuan").html(ui.item.satuan);
                $(".stok_awal").html(ui.item.stok_awal + " " +ui.item.satuan);
                $(".stok_akhir").html(ui.item.stok_akhir + " " +ui.item.satuan);
                $(".total_masuk").html(ui.item.total_masuk + " " +ui.item.satuan);
                $(".total_keluar").html(ui.item.total_keluar + " " +ui.item.satuan);
                $("#inputSearch").val("");
                return false;
            }

        });
    });
</script>
@endsection

