<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Penerimaan Barang</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-8">
                <ul class="list-unstyled">
                    <li class="text-muted">Supplier: <span style="color:#5d9fc5 ;">{{ $header->getPO->getSupplier->supplier_name }}</span></li>
                    <li class="text-muted">{{ $header->getPO->getSupplier->supplier_address }}</li>
                    <li class="text-muted">{{ $header->getPO->getSupplier->supplier_email }}</li>
                    <li class="text-muted"><i class="fas fa-phone"></i> {{ $header->getPO->getSupplier->supplier_phone }}</li>
                </ul>
            </div>
            <div class="col-xl-4">
                <p class="text-muted">Penerimaan</p>
                <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Nomor :</span>#{{ $header->nomor_receive }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Tanggal: </span>{{ $header->tanggal_receive }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="me-1 fw-bold">Cara Bayar:</span>
                        @if($header->cara_bayar=="Cash")
                        <span class="badge bg-success text-black fw-bold">
                            {{ $header->cara_bayar }}</span>
                        @else
                        <span class="badge bg-warning text-black fw-bold">
                            {{ $header->cara_bayar }}</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="row  justify-content-center">
            <table class="table table-striped table-borderless">
                <thead style="background-color:#84B0CA ;" class="text-white">
                    <th class="text-center">Items</th>
                    <th class="text-center" style="width: 8%">Terima</th>
                    <th class="text-center" style="width: 8%">Order</th>
                    <th class="text-center" style="width: 10%">Satuan</th>
                    <th class="text-center" style="width: 15%">Harga</th>
                    <th class="text-center" style="width: 15%">Disc&nbsp;(Rp)</th>
                    <th class="text-center" style="width: 15%">Sub&nbsp;Total</th>
                </thead>
                <tbody>
                    @foreach ($detail as $list)
                    <tr>
                        <td>{{ $list->getParts->oid_part }} - {{ $list->getParts->part_name }}</td>
                        <td class="text-center">{{ $list->terima }}</td>
                        <td class="text-center">{{ $list->order }}</td>
                        <td class="text-center">{{ $list->getParts->getSatuan->satuan }}</td>
                        <td style="text-align: right">{{ number_format($list->harga_satuan, 0) }}</td>
                        <td style="text-align: right">{{ number_format($list->diskon, 0) }}</td>
                        <td style="text-align: right">{{ number_format($list->sub_total, 0) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" rowspan="4">
                            <p class="text-muted">Purchase Order</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="fw-bold">Nomor :</span>#{{ $header->getPO->po_number }}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="fw-bold">Tanggal: </span>{{ $header->getPO->po_date }}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="me-1 fw-bold">Keterangan:</span>{{ $header->getPO->po_remark }}
                                </li>
                            </ul>

                        </td>
                        <td style="text-align: right" colspan="2">Total :</td>
                        <td style="text-align: right">{{ number_format($header->total, 0) }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right" colspan="2">Biaya lain-lain :</td>
                        <td style="text-align: right">{{ number_format($header->biaya_lain, 0) }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right" colspan="2">Ppn :</td>
                        <td style="text-align: right">{{ number_format($header->ppn, 0) }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right" colspan="2">Total Net :</td>
                        <td style="text-align: right">{{ number_format($header->total_net, 0) }}</td>
                    </tr>
                    @if($header->cara_bayar=="Credit")
                    <tr>
                        <td colspan="4"></td>
                        <td style="text-align: right" colspan="2">Uang Muka :</td>
                        <td style="text-align: right">{{ number_format($header->uang_muka, 0) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td style="text-align: right" colspan="2">Saldo Terhutang :</td>
                        <td style="text-align: right">{{ number_format($header->total_net - $header->uang_muka, 0) }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

