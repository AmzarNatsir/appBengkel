<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Pemesanan Barang</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="card-body">
        <div class="row d-flex align-items-baseline">
            <div class="col-xl-10">
              <p style="color: #7e8d9f;font-size: 20px;">Invoice <strong>#{{ $header->po_number }}</strong></p>
            </div>
            <div class="col-xl-2 float-end">
              <a href="{{ url('pemesanan/print/'.$header->id) }}" class="btn btn-light text-capitalize border-0" target="_new"><i
                  class="fas fa-print text-primary"></i> Print</a>
            </div>
            <hr>
          </div>
        <div class="row">
            <div class="col-xl-7">
                <ul class="list-unstyled">
                    <li class="text-muted">Supplier: <span style="color:#5d9fc5 ;">{{ $header->getSupplier->supplier_name }}</span></li>
                    <li class="text-muted">{{ $header->getSupplier->supplier_address }}</li>
                    <li class="text-muted">{{ $header->getSupplier->supplier_email }}</li>
                    <li class="text-muted"><i class="fas fa-phone"></i> {{ $header->getSupplier->supplier_phone }}</li>
                </ul>
            </div>
            <div class="col-xl-5">
                <p class="text-muted">Pemesanan/Purchase Order</p>
                <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Nomor :</span>#{{ $header->po_number }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Tanggal: </span>{{ $header->po_date }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                            class="fw-bold">Tanggal Pengiriman: </span>{{ $header->po_delivery_order }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="me-1 fw-bold">Keterangan:</span>{{ $header->po_remark }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="row  justify-content-center">
            <table class="table table-striped table-borderless">
                <thead style="background-color:#84B0CA ;" class="text-white">
                    <th>Items</th>
                    <th class="text-center" style="width: 8%">Order</th>
                    <th class="text-center" style="width: 10%">Satuan</th>
                    <th class="text-center" style="width: 15%">Harga</th>
                    <th class="text-center" style="width: 15%">Sub&nbsp;Total</th>
                </thead>
                <tbody>
                    @foreach ($detail as $list)
                    <tr>
                        <td>{{ $list->getParts->oid_part }} - {{ $list->getParts->part_name }}</td>
                        <td class="text-center">{{ $list->qty }}</td>
                        <td class="text-center">{{ $list->getParts->getSatuan->satuan }}</td>
                        <td style="text-align: right">{{ number_format($list->harga_satuan, 0) }}</td>
                        <td style="text-align: right">{{ number_format($list->sub_total, 0) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td style="text-align: right" colspan="4">Total :</td>
                        <td style="text-align: right">{{ number_format($header->po_total, 0) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

