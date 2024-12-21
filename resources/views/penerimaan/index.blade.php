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
            <h3 class="fw-bold mb-3">Penerimaan Barang</h3>
            <h6 class="op-7 mb-2">List</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('penerimaan.index') }}" class="btn btn-primary btn-round"><i class="fa fa-spinner"></i> Refresh</a>
            <a href="{{ route('penerimaan.baru') }}" class="btn btn-success btn-round"><i class="fa fa-plus"></i> Create New</a>
        </div>
    </div>
    <div class="row table-responsive">
        <table class="display list_data nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Nomor </th>
                <th width="10%">Tanggal</th>
                <th>Supplier</th>
                <th width="10%">Remark</th>
                <th width="10%">Cara Bayar</th>
                <th width="10%">Total</th>
                <th width="10%">Act</th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content" id="v_form" style="overflow-y: auto;"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        window.setTimeout(function () { $(".alert-success").alert('close'); }, 2000);

        $('.list_data').DataTable().destroy();
        $(".list_data").DataTable({
            ajax: "{{ route('penerimaan.data') }}",
            processing: true,
            serverSide: true,
            autoWidth: true,
            columns: [
                { data: 'no' },
                { data: 'nomor_receive' },
                { data: 'tanggal_receive' },
                { data: 'supplier' },
                { data: 'ket_receive' },
                { data: 'cara_bayar' },
                { data: 'total_net' },
                { data: 'act' }
            ],
            responsive: true,
            // select: true
            // deferRender: true
        });
    });
    var goDetail = function(el)
    {
        $("#v_form").load("{{ url('penerimaan/detail') }}/"+$(el).val());
    }
</script>
@endsection

