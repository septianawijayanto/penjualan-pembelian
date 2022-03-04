<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <h2 class="center"><u> Invoice</u></h2>
    <table class="table">
        <tbody>

            <tr>
                <td class="text-right border-bottom">Kode Invoice</td>
                <td colspan="2" class="text-right border-bottom"> : {{ $data->no_faktur }}</td>
                <td class="text-right border-bottom"> {{ $data->created_at }}</td>

            </tr>
            <tr>
                <td class="text-right border-bottom">Kasir</td>
                <td colspan="2" class="text-right border-bottom"> : {{ Auth::user()->name }}</td>
            </tr>
            <tr>
                <td class="text-right border-bottom">Pelanggan</td>
                <td colspan="2" class="text-right border-bottom"> : {{ $data->pelanggan->nama_pelanggan }}</td>

            </tr>
            <tr>
                <td class="text-right border-bottom">Hp/Telp</td>
                <td colspan="2" class="text-right border-bottom"> : {{ $data->no_telp }}</td>
            </tr>

            <tr>
                <th colspan="2" class="left">Barang Belanjaan</th>
                <th class="right">Harga Satuan</th>
                <th class="right" style="width:90px">Sub Total</th>
            </tr>
            <tr>
                <td colspan="2" class="strong">
                    {{ $data->barang->nama_barang }} {{ $data->jumlah }}
                    ({{ $data->barang->satuan }})</td>
                <td class="right" style="vertical-align: top;">
                    {{ 'Rp. ' . number_format($data->barang->harga) }}
                </td>
                <td class="right">{{ 'Rp. ' . number_format($data->subtotal) }}</td>
            </tr>


            <tr>
                <th colspan="3" class="right">Total :</th>
                <th class="right ">{{ 'Rp. ' . number_format($data->subtotal) }}</th>
            </tr>
            {{-- <tr>
                <th colspan="3" class="right ">Jumlah Dibayar :</th>
                <th class="right ">{{ 'Rp. ' . number_format($data->bayar) }}</th>
            </tr> --}}
            {{-- <tr>
                <th colspan="3" class="right ">Kembalian :</th>
                <th class="right "> {{ 'Rp. ' . number_format($data->kembalian) }}</th>
            </tr> --}}
        </tbody>
    </table>
</body>

</html>
