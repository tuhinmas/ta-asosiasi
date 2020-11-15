<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>Invoice #{{ $data->invoice }}</title> --}}
    <style>
        body{
            padding: 0;
            margin: 0;
        }
        .page{
            max-width: 75em;
            margin: 0 auto;
        }
        table th,
        table td{
            text-align: left;
        }
        /* .table td.fit, 
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        } */
        table.layout{
            width: 100%;
            border-collapse: collapse;
        }
        table.display{
            margin: 1em 0;
        }
        table.display th,
        table.display td{
            border: 1px solid #B3BFAA;
            /* padding: .2em 1em; */
            white-space: nowrap;
            /* width: 1%; */
            padding-right: 5px;
            padding-left: 5px;
        }

        table.display th{ background: #D5E0CC; }
        table.display td{ background: #fff; }

        table.responsive-table{
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
        }

        .listcust {
            margin: 0;
            padding: 0;
            list-style: none;
            display:table;
            border-spacing: 10px;
            border-collapse: separate;
            list-style-type: none;
        }

        .customer {
            padding-left: 600px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Laporan Bulan ini</h3>
        <h4 style="line-height: 0px;">{{ $month->format('M-Y') }}</h4>
    </div>
    <div class="page">
        <table class="layout display responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kasir</th>
                    <th>Customer</th>
                    <th>Invoice</th>
                    <th>qty</th>
                    <th>Subtotal</th>
                    <th>Disc</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($data as $key => $riwayat)
                  <tr>
                      <td class="">{{ $key + 1 }}</td>
                      <td>{{ $riwayat->user->name }}</td>
                      <td>{{ $riwayat->customers->name }}</td>
                      <td>{{ $riwayat->invoice }}</td>
                      <td>{{ $riwayat->jumlah_item }}</td>
                      <td>Rp {{ number_format($riwayat->sub_total) }}</td>
                      <td>{{ $riwayat->diskon }}</td>
                      <td>Rp {{ number_format($riwayat->total) }}</td>
                  </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr style="padding: 1em">
                    <th colspan="2">qty</th>
                    <td colspan="6">{{ number_format($totalQTY) }} Item</td>
                </tr>
                <tr>
                    <th colspan="2">Sub Total</th>
                    <td colspan="6">Rp {{ number_format($sub) }}</td>
                </tr>
                <tr>
                    <th colspan="2">Total</th>
                    <td colspan="6">Rp {{ number_format($total) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>