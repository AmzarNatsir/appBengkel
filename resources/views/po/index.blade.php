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
            <h3 class="fw-bold mb-3">Purchase Order</h3>
            <h6 class="op-7 mb-2">List</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('pemesanan.index') }}" class="btn btn-primary btn-round"><i class="fa fa-spinner"></i> Refresh</a>
            <a href="{{ route('pemesanan.baru') }}" class="btn btn-success btn-round"><i class="fa fa-plus"></i> Create New</a>
        </div>
    </div>
    <div class="row table-responsive">
        <table class="display list_data nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">PO Number</th>
                <th width="10%">PO Date</th>
                <th width="10%">PO Delivary Date</th>
                <th>Supplier</th>
                <th width="10%">Remark</th>
                <th width="10%">Total</th>
                <th width="15%">Status</th>
                <th width="15%">Action</th>
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
            ajax: "{{ route('pemesanan.data') }}",
            processing: true,
            serverSide: true,
            autoWidth: true,
            columns: [
                { data: 'no' },
                { data: 'po_number' },
                { data: 'po_date' },
                { data: 'po_delivery_order' },
                { data: 'supplier' },
                { data: 'po_remark' },
                { data: 'po_total' },
                { data: 'status' },
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

