<!DOCTYPE html>
<html>
<head>
	<title>Service - Invoice</title>
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
                <img src="{{ public_path('assets/img/logo_app.jpg') }}" alt="Logo" width="100px" height="auto" class="logo"/>
                </td>
                <td align="right" style="width: 50%;">
                    <h2>PATTALLASSANG VARIASI</h2>
                    {{-- <pre> --}}
                        JL. POROS PATTALLASSANG - GOWA
                    {{-- </pre> --}}
                </td>
            </tr>
            <tr><td colspan="2"><hr style="border: 1px solid black; border-collapse: collapse;"></td></tr>
        </table>
    </div>
</header>
<body>
<main>
    <p style="color: #7e8d9f;font-size: 20px;">Invoice <strong>#{{ $header->no_service }}</strong> | <strong>{{ date("d-m-Y", strtotime($header->tgl_service)) }}</strong></p>
    <table style="width: 100%">
        <tr>
            <td style="width: 50%; vertical-align: top"><b>Pelanggan :</b></td>
            <td style="width: 50%; vertical-align: top"><b>Unit :</b></td>
        </tr>
        <tr>
            <td>{{ $header->getUnit->getCustomer->customer_name }}</td>
            <td>{{ $header->getUnit->plat_number }}</td>
        </tr>
        <tr>
            <td>{{ $header->getUnit->getCustomer->customer_address }}</td>
            <td rowspan="2" style="vertical-align: top">{{ $header->getUnit->getType->getBrand->brand_name." ".$header->getUnit->getType->getModel->model_name." ".$header->getUnit->getType->type_name }}</td>
        </tr>
        <tr>
            <td>{{ $header->getUnit->getCustomer->customer_email }}</td>
        </tr>
        <tr>
            <td>{{ $header->getUnit->getCustomer->customer_phone }}</td>
        </tr>
    </table>
    <hr style="border: 1px solid black; border-collapse: collapse;">
    @if(count($pekerjaan) > 0)
    <table style="width: 100%" cellpadding='5' class="isi">
        <tr>
            <td style="text-align: center; font-size:large"><b>Pekerjaan & Jasa</td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-collapse: collapse; width: 100%;" cellpadding="3" border="1">
        <thead>
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
    @endif
    @if(count($parts) > 0)
    <table style="width: 100%" cellpadding='5' class="isi">
        <tr>
            <td style="text-align: center; font-size:large"><b>Parts</td>
        </tr>
    </table>
    <table style="border: 1px solid black; border-collapse: collapse; width: 100%;" cellpadding="3" border="1">
        <thead>
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
    @endif
    <br>
    <table style="border: 1px solid black; border-collapse: collapse; width: 100%;" cellpadding="3">
        <tr>
            <td style="width: 50%">Cara Bayar : <b>{{ $header->cara_bayar }}</b></td>
            <td style="width: 25%">Total Pekerjaan</td>
            <td><b>: Rp. {{ number_format($header->total_pekerjaan, 0) }}</b></td>
        </tr>
        <tr>
            <td></td>
            <td>Total Parts</td>
            <td><b>: Rp. {{ number_format($header->total_parts, 0) }}</b></td>
        </tr>
        <tr>
            <td></td>
            <td>Total (Pekerjaan + Parts)</td>
            <td><b>: Rp. {{ number_format($header->total_pekerjaa_parts, 0) }}</b></td>
        </tr>
        <tr>
            <td></td>
            <td>Diskon</td>
            <td><b>: Rp. {{ number_format($header->diskon, 0) }}</b></td>
        </tr>
        <tr>
            <td></td>
            <td>Ppn ( {{ $header->ppn_persen }}% )</td>
            <td><b>: Rp. {{ number_format($header->ppn_rupiah, 0) }}</b></td>
        </tr>
        <tr>
            <td></td>
            <td>Total Net</td>
            <td><b>: Rp. {{ number_format($header->total_net, 0) }}</b></td>
        </tr>
    </table>
</main>
</body>
</html>
