@extends('partial.app')
@section('content')
<div class="page-inner">
    @if (Session::has('status'))
        @if(session('status')=='success')
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" aria-hidden="true" class="close">
                <i class="fa fa-times"></i>
            </button>
            <span><b> Success - </b> {!! session('message') !!}</span>
        </div>
        @else
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" aria-hidden="true" class="close">
                <i class="fa fa-times"></i>
            </button>
            <span><b> Failed - </b> {!! session('message') !!}</span>
        </div>
        @endif
    @endif
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Manajemen Stok</h3>
            <h6 class="op-7 mb-2">Daftar Stok</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('manajemen_stok.stok.index') }}" class="btn btn-primary btn-round">Refresh</a>
            <a href="{{ route('manajemen_stok.stok.create') }}" class="btn btn-success btn-round">Tambah Data</a>
        </div>
    </div>
    <div class="row table-responsive">
        <table class="display list_data nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Stok</th>
                <th width="10%">Jenis</th>
                <th width="15%">Brand</th>
                <th width="10%">Stok</th>
                <th width="10%">Satuan</th>
                <th width="10%">Harga Beli</th>
                <th width="10%">Harga Jual</th>
                <th width="10%">Rak</th>
                <th width="15%">Opsi</th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        window.setTimeout(function () { $(".alert-success").alert('close'); }, 2000);

        $('.list_data').DataTable().destroy();
        $(".list_data").DataTable({
            ajax: "{{ route('manajemen_stok.stok.data') }}",
            processing: true,
            serverSide: true,
            autoWidth: true,
            columns: [
                { data: 'no' },
                { data: 'part_name' },
                { data: 'jenis' },
                { data: 'brand' },
                { data: 'stok' },
                { data: 'satuan' },
                { data: 'harga_beli' },
                { data: 'harga_jual' },
                { data: 'rak' },
                { data: 'act' }
            ],
            responsive: true,
            // select: true
            // deferRender: true
        });
    });
    var konfirmHapus = function(el)
        {
            swal({
            title: 'Are you sure?',
            text: 'Data has been delete!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete)
            {
                $.ajax({
                    url: "{{ url('manajemen_stok/destroy') }}/"+$(el).val(),
                    type: "GET",
                    success:function(response){
                        swal('Success! The selected data has been successfully deleted!', {
                            icon: 'success',
                            buttons: false,
                            timer: 2000
                        }).then(() => {
                            window.location.reload(true);
                        });
                    }
                });
            } else {
                swal('Warning! Selected data failed to delete!', {
                    icon: 'warning',
                });
            }
            });
        }
</script>
@endsection

