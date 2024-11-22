@extends('partial.app')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Pemesanan Barang</h3>
            <h6 class="op-7 mb-2">Baut Baru</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('pemesanan.baru') }}" class="btn btn-primary btn-round"><i class="fa fa-spinner"></i> Refresh</a>
        </div>
    </div>
    @include('additional.alert')
    <form action="{{ route('pemesanan.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 p-0">
                            <div class="form-group">
                                <label for="po_date">Tanggal Pesan</label>
                                <input type="date" class="form-control form-control-sm  @error('po_date') is-invalid @enderror" name="po_date" id="po_date" value="{{ Old('po_date') }}">
                                @if ($errors->has('po_date'))
                                <div class="invalid-feedback">{{ $errors->first('po_date') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 p-0">
                            <div class="form-group">
                                <label for="po_delivery_date">Tanggal Kirim</label>
                                <input type="date" class="form-control form-control-sm  @error('po_delivery_date') is-invalid @enderror" name="po_delivery_date" id="po_delivery_date" value="{{ Old('po_delivery_date') }}">
                                @if ($errors->has('po_delivery_date'))
                                <div class="invalid-feedback">{{ $errors->first('po_delivery_date') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 p-0">
                            <div class="form-group">
                                <label for="supplier_select">Supplier</label>
                                <select class="form-select @error('supplier_select') is-invalid @enderror" name="supplier_select" id="supplier_select" style="width: 100%">
                                    <option value=""></option>
                                    @foreach ($list_supplier as $supplier)
                                    <option value="{{ $supplier->id }}" {{ (Old('supplier_select')==$supplier->id) ? "selected" : "" }}>{{ $supplier->oid_suppier }} {{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('supplier_select'))
                                <div class="invalid-feedback">{{ $errors->first('supplier_select') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-12 col-lg-12 p-0">
                            <div class="form-group">
                                <label for="inp_remark">Keterangan</label>
                                <input type="text" class="form-control form-control-sm @error('inp_remark') is-invalid @enderror" name="inp_remark" id="inp_remark" maxlength="100" value="{{ Old('inp_remark') }}">
                                @if ($errors->has('inp_remark'))
                                <div class="invalid-feedback">{{ $errors->first('inp_remark') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-action p-0 mt-3">
                        <button type="submit" class="btn btn-success btn-round">Submit</button>
                        <span class="badge badge-danger">* Submit untuk melanjutkan penentuan item pemesanan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        window.setTimeout(function () { $(".alert-success").alert('close'); }, 2000);
       $('#supplier_select').select2({
            theme: "classic",
            allowClear: true,
            placeholder: "Select Supplier",
            height: '36px!important'
        });
        $(".angka").number( true, 0);
    });
</script>
@endsection

