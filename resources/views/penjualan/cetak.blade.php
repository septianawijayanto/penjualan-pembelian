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
    <h2 class="center"><u> Laporan Penjualan</u></h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">No Faktur</th>
                <th scope="col">Kode Pelanggan</th>
                <th scope="col">Status</th>
                <th scope="col">Diskon</th>
                <th scope="col">PPN</th>

                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Satuan</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $e => $item)
                <tr>
                    <td>{{ $e + 1 }}</td>
                    <td>{{ $item->no_faktur }}</td>
                    <td>{{ $item->pelanggan->kode_pelanggan }}</td>
                    <td>{{ $item->status_pembayaran }}</td>
                    <td>{{ $item->diskon }}</td>
                    <td>{{ $item->ppn }}</td>
                    <td>{{ $item->barang->kode_barang }}</td>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->barang->harga }}</td>
                    <td>{{ $item->subtotal }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
