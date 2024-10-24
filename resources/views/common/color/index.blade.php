@extends('partial.app')

@section('content')
<div class="page-inner">
    @if ($message = Session::get('success'))
    <div class="alert alert-success my-2">
    <p>{{ $message }}</p>
    </div>
    @endif
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Common</h3>
            <h6 class="op-7 mb-2">Common Color</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('color.create') }}" class="btn btn-primary btn-round">Add New</a>
        </div>
    </div>
    <div class="row table-responsive">
        <table class="display list_data nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Oid</th>
                <th>Color (IDN)</th>
                <th>Color (ENG)</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.list_data').DataTable().destroy();
        $(".list_data").DataTable({
            ajax: "{{ route('color.data') }}",
            processing: true,
            serverSide: true,
            autoWidth: true,
            columns: [
                { data: 'no' },
                { data: 'oid_color' },
                { data: 'color_idn' },
                { data: 'color_eng' },
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
                    url: "{{ url('common/colorDestroy') }}/"+$(el).val(),
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

