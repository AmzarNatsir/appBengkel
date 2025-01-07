@extends('partial.app')

@section('content')
<div class="page-inner">
    @include('additional.alert')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Service</h3>
            <h6 class="op-7 mb-2">Daftar</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('service.daftar') }}" class="btn btn-primary btn-round"><i class="fa fa-spinner"></i> Refresh</a>
            <a href="{{ route('service.baru') }}" class="btn btn-success btn-round"><i class="fa fa-plus"></i> Create New</a>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row table-responsive">
                    <table class="table list_data nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">No.Service</th>
                            <th width="10%">Tgl.Service</th>
                            <th>Customer</th>
                            <th width="10%">No. Polisi</th>
                            <th width="10%">Unit</th>
                            <th width="10%">Total Pekerjaan</th>
                            <th width="10%">Total Parts</th>
                            <th width="15%">Diskon</th>
                            <th width="15%">Ppn</th>
                            <th width="15%">Total Net</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Modal -->
<div class="modal fade" id="formModalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content" id="v_form_detail" style="overflow-y: auto;"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        window.setTimeout(function () { $(".alert-success").alert('close'); }, 2000);
        $('.list_data').DataTable().destroy();
        $(".list_data").DataTable({
            ajax: "{{ route('service.data') }}",
            processing: true,
            serverSide: true,
            autoWidth: true,
            columns: [
                { data: 'no' },
                { data: 'no_service' },
                { data: 'tgl_service' },
                { data: 'customer' },
                { data: 'no_polisi' },
                { data: 'unit' },
                { data: 't_pekerjaan' },
                { data: 't_parts' },
                { data: 'diskon' },
                { data: 'ppn' },
                { data: 't_net' },
                { data: 'act' }
            ],
            responsive: true,
            // select: true
            // deferRender: true
        });
    });
    var goDetail = function(el)
    {
        $("#v_form_detail").load("{{ url('service/detail') }}/"+$(el).val());
    }
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
                    url: "{{ url('pemesanan/destroy') }}/"+$(el).val(),
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

