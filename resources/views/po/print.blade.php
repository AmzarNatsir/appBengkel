<!DOCTYPE html>
<html>
<head>
	<title>Purchase Order - Invoice</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	{{-- <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style> --}}
	<table style="width: 100%">
        <tr>
            <td style="width: 30%"><h2>Invoice</h2></td>
            <td style="text-align: right">
                <img src="{{ public_path('assets/img/logo_app.jpg') }}" alt="Logo App" width="100" />
            </td>
        </tr>
    </table>
    <table style="width: 100%">
        <tr>
            <td style="width: 40%; vertical-align: top"><p style="font-size: 15px"><b>Kepada :</b><br>
                {{ $header->getSupplier->supplier_name }}<br>
                {{ $header->getSupplier->supplier_address }}<br>
                {{ $header->getSupplier->supplier_email }}<br>
                {{ $header->getSupplier->supplier_phone }}
            </p>
            </td>
            <td style="width: 15%; vertical-align: top;">
                <p style="font-size: 15px"><b>Tanggal :</b><br>
                    {{ date('d-m-Y', strtotime($header->po_date)) }}</p>
            </td>
            <td style="width: 15%; vertical-align: top;">
                <p style="font-size: 15px"><b>No. Invoice :</b><br>
                    {{ $header->po_number }}</p>
            </td>
            <td style="vertical-align: top;">
                <p style="font-size: 15px"><b>Keterangan :</b><br>
                    {{ $header->po_remark }}</p>
            </td>
        </tr>
    </table>
    <table class="table table-striped table-borderless" style="width: 100%">
        <thead style="background-color:#84B0CA ;" class="text-white">
            <th>Items</th>
            <th style="width: 8%; text-align: center">Order</th>
            <th style="width: 10%; text-align: center">Satuan</th>
            <th style="width: 15%; text-align: right">Harga</th>
            <th style="width: 15%; text-align: right">Sub&nbsp;Total</th>
        </thead>
        <tbody>
            @foreach ($detail as $list)
            <tr>
                <td>{{ $list->getParts->oid_part }} - {{ $list->getParts->part_name }}</td>
                <td style="text-align: center">{{ $list->qty }}</td>
                <td style="text-align: center">{{ $list->getParts->getSatuan->satuan }}</td>
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
</body>
</html>
