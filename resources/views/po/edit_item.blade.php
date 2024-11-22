<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Item Pemesanan Barang</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ url('pemesanan/updateItem', $detail->id) }}" method="POST" id="myForm">
@csrf
{{ method_field('PUT') }}
<input type="hidden" name="id_head" id="id_head" value="{{ $detail->id_head }}">
<div class="modal-body">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="form-group">
                    <label for="selectItemEdit">Pilihan Item</label>
                    <select class="form-control" name="selectItemEdit" id="selectItemEdit" data-placeholder="-- Pilihan" style="width: 100%;" disabled>
                        <option></option>
                        @foreach ($list_item as $item)
                        <option value="{{ $item->id }}" {{ ($item->id==$detail->id_part) ? "selected" : "" }}>{{ $item->part_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inpHargaEdit" class="col-sm-7 col-form-label">Harga Satuan</label>
            <div class="col-sm-5">
                <input type="text" class="form-control angka" name="inpHargaEdit" id="inpHargaEdit" value="{{ $detail->harga_satuan }}" style="text-align: right" oninput="refreshCalculateEdit()" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inpQtyEdit" class="col-sm-7 col-form-label">Qty</label>
            <div class="col-sm-5">
                <input type="text" class="form-control angka" name="inpQtyEdit" id="inpQtyEdit" value="{{ $detail->qty }}" style="text-align: right" required oninput="refreshCalculateEdit()">
            </div>
        </div>
        <div class="form-group row">
            <label for="inpSubTotalEdit" class="col-sm-7 col-form-label">Sub Total</label>
            <div class="col-sm-5">
                <input type="text" class="form-control angka" name="inpSubTotalEdit" id="inpSubTotalEdit" value="{{ $detail->sub_total }}" style="text-align: right;" readonly>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>
<script>
    $(document).ready(function () {
       $('#selectItemEdit').select2({
            // theme: "classic",
            allowClear: true,
            placeholder: "Pilihan Items",
            height: '36px!important',
            dropdownParent: $("#formModal")
        });
        $(".angka").number( true, 0);
    });
    var refreshCalculateEdit = function()
    {
        $("#inpSubTotalEdit").val(calculateEdit());
    }
    function calculateEdit()
    {
        var harga_satuan = $("#inpHargaEdit").val();
        var qty = $("#inpQtyEdit").val();
        return harga_satuan * qty;
    }
    function clear_text()
    {
        $("#inpHargaEdit").val(0)
        $("#inpQtyEdit").val(0)
        $("#inpSubTotalEdit").val(0)
    }
</script>
