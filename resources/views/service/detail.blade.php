<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Service</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="card-body">
        <div class="row d-flex align-items-baseline">
            <div class="col-xl-10">
              <p style="color: #7e8d9f;font-size: 20px;">Invoice <strong>#{{ $header->no_service }}</strong> | <strong>{{ date("d-m-Y", strtotime($header->tgl_service)) }}</strong></p>
            </div>
            <div class="col-xl-2 float-end">
              <a href="{{ url('service/print/'.$header->id) }}" class="btn btn-light text-capitalize border-0" target="_new"><i
                  class="fas fa-print text-primary"></i> Print</a>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-user"></i> Pelanggan : </li>
                    <li class="text-muted"><span style="color:#5d9fc5 ;">{{ $header->getUnit->getCustomer->customer_name }}</span></li>
                    <li class="text-muted">{{ $header->getUnit->getCustomer->customer_address }}</li>
                    <li class="text-muted">{{ $header->getUnit->getCustomer->customer_email }}</li>
                    <li class="text-muted">{{ $header->getUnit->getCustomer->customer_phone }}</li>
                </ul>
            </div>
            <div class="col-xl-6">
                <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-car"></i> Unit:</li>
                    <li class="text-muted"><span style="color:#5d9fc5 ;">{{ $header->getUnit->plat_number }}</span></li>
                    <li class="text-muted">{{ $header->getUnit->getType->getBrand->brand_name." ".$header->getUnit->getType->getModel->model_name." ".$header->getUnit->getType->type_name }}</li>
                    <li class="text-muted"></li>
                    <li class="text-muted"> </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-job-tab" data-bs-toggle="pill" data-bs-target="#pills-job" type="button" role="tab" aria-controls="pills-job" aria-selected="true"><i class="fa fa-wrench"></i> Pekerjaan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-parts-tab" data-bs-toggle="pill" data-bs-target="#pills-parts" type="button" role="tab" aria-controls="pills-parts" aria-selected="false"><i class="fa fa-cog"></i> Parts</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-job" role="tabpanel" aria-labelledby="pills-job-tab">
                    <div class="row">
                        <table class="table table_list" style="width: 100%" cellpadding="3">
                            <thead style="background-color: rgb(54, 100, 197); color:white">
                                <th style="width: 5%">No</th>
                                <th>Pekerjaan</th>
                                <th style="width: 30%">Kategori</th>
                                <th style="width: 20%; text-align: right">Harga</th>
                            </thead>
                            <tbody>
                                @php($nom=1)
                                @foreach ($pekerjaan as $pekerjaan)
                                <tr>
                                    <td>{{ $nom }}</td>
                                    <td>{{ $pekerjaan->getPekerjaan->nama_pekerjaan }}</td>
                                    <td>{{ $pekerjaan->getPekerjaan->getKategoriPekerjaan->kategori_pekerjaan }}</td>
                                    <td style="text-align: right">{{ number_format($pekerjaan->biaya, 0) }}</td>
                                </tr>
                                @php($nom++)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-parts" role="tabpanel" aria-labelledby="pills-parts-tab">
                    <div class="row">
                        <table id="table_list" class="table" style="width: 100%" cellpadding="3">
                            <thead style="background-color: rgb(54, 100, 197); color:white">
                                <th class="text-center" style="width: 5%">No</th>
                                <th class="text-center">Items</th>
                                <th class="text-center" style="width: 10%">Satuan</th>
                                <th class="text-center" style="width: 15%">Jumlah</th>
                                <th class="text-center" style="width: 15%">Harga</th>
                                <th class="text-center" style="width: 15%">Sub&nbsp;Total</th>
                            </thead>
                            <tbody>
                                @php($nom=1)
                                @foreach ($parts as $parts)
                                <tr>
                                    <td>{{ $nom }}</td>
                                    <td>{{ $parts->getPart->part_name }}</td>
                                    <td>{{ $parts->getPart->getSatuan->satuan }}</td>
                                    <td style="text-align: center">{{ $parts->jumlah }}</td>
                                    <td style="text-align: right">{{ number_format($parts->harga, 0) }}</td>
                                    <td style="text-align: right">{{ number_format($parts->sub_total, 0) }}</td>
                                </tr>
                                @php($nom++)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <ul class="list-unstyled">
                    <li class="text-muted">Cara Bayar : {{ $header->cara_bayar }}</li>
                </ul>
            </div>
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <label>Total Pekerjaan</label>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <label>: Rp. {{ number_format($header->total_pekerjaan, 0) }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <label>Total Parts</label>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <label>: Rp. {{ number_format($header->total_parts, 0) }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <label>Total (Pekerjaan + Parts)</label>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <label>: Rp. {{ number_format($header->total_pekerjaa_parts, 0) }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <label>Diskon</label>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <label>: Rp. {{ number_format($header->diskon, 0) }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <label>Ppn ( {{ $header->ppn_persen }}% )</label>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <label>: Rp. {{ number_format($header->ppn_rupiah, 0) }}</label>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <label><b>Total Net</b></label>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <label><b>: Rp. {{ number_format($header->total_net, 0) }}</b></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

