<!DOCTYPE html>
<html>
<head>
	<title>Purchase Order - Invoice</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @page {
            margin: 10px;
        }
        body {
            margin : 100px 100px;
            font-size: 12px;
            font-family: 'Poppins', sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: 11px;
            font-family: 'Poppins', sans-serif;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .page-break {
            page-break-after: always;
        }
        .information {
            background-color: #ffffff;
            color: #020202;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 0px;
        }
        header { position: fixed; top: -10px; left: 20px; right: 20px; height: 30px; }
        /*
        footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: #03a9f4; height: 25px; }
        */
        .page-break:last-child { page-break-after: never; }
    </style>
</head>
<header>
    <div class="information">
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                <img src="{{ public_path('assets/img/logo_new.png') }}" alt="Logo" width="100px" height="auto" class="logo"/>
                </td>
                <td align="right" style="width: 50%;">
                    <h2>PATTALLASSANG VARIASI</h2>
                    {{-- <pre> --}}
                        JL. H.M YASIN LIMPO NO.46 SAMATA - GOWA
                    {{-- </pre> --}}
                </td>
            </tr>
            <tr><td colspan="2"><hr style="border: 1px solid black; border-collapse: collapse;"></td></tr>
        </table>
    </div>
</header>
<body>
    <p style="color: #7e8d9f;font-size: 20px;">Invoice <strong>#{{ $header->po_number }}</strong> | <strong>{{ date("d-m-Y", strtotime($header->po_date)) }}</strong></p>
    <table style="width: 100%">
        <tr>
            <td style="width: 50%; vertical-align: top"><b>Supplier :</b></td>
            <td style="width: 50%; vertical-align: top"><b>Keterangan :</b></td>
        </tr>
        <tr>
            <td>{{ $header->getSupplier->supplier_name }}</td>
            <td rowspan="3" style="vertical-align: top">{{ $header->po_remark }}</td>
        </tr>
        <tr>
            <td>{{ $header->getSupplier->supplier_address }}</td>
        </tr>
        <tr>
            <td>{{ $header->getSupplier->supplier_email }}</td>
        </tr>
        <tr>
            <td>{{ $header->getSupplier->supplier_phone }}</td>
        </tr>
    </table>
    <hr style="border: 1px solid black; border-collapse: collapse;">
    <table style="width: 100%" cellpadding='5' class="isi">
        <tr>
            <td style="text-align: center; font-size:large"><b>Daftar Pemesanan Barang</td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-collapse: collapse; width: 100%;" cellpadding="3" border="1">
        <thead>
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
