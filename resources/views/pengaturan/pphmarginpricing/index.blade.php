@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Pengaturan</h3>
            <h6 class="op-7 mb-2">Ppn dan Margin Harga Jual</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ url('common/brand') }}" class="btn btn-primary btn-round">Back</a>
        </div>
    </div>
    @if (Session::has('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" aria-hidden="true" class="close">
            <i class="fa fa-times"></i>
        </button>
        <span><b> Success - </b> {!! session('message') !!}</span>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Pengaturan Ppn dan Margin Harga Jual</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengaturan.ppn_marginhargajual.store') }}" method="POST" id="myForm">
                    @csrf
                        <input type="hidden" name="id_ppn_margin" value="{{ (empty($ppn_margin->id)) ? "" : $ppn_margin->id }}">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="inp_ppn">Ppn (%)</label>
                                    <input type="text" name="inp_ppn" id="inp_ppn" class="form-control form-control-sm angka" value="{{ (empty($ppn_margin->ppn)) ? 0 : $ppn_margin->ppn }}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="inp_margin">Margin Harga Jual (%)</label>
                                    <input type="text" name="inp_margin" id="inp_margin" class="form-control form-control-sm angka" value="{{ (empty($ppn_margin->margin)) ? 0 : $ppn_margin->margin }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        window.setTimeout(function () { $(".alert-success").alert('close'); }, 2000);
        $(".angka").number( true, 2);
    });
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

