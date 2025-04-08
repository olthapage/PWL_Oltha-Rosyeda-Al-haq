<!DOCTYPE html>
<html>
<head>
    <title>Data Penjualan Detail</title>
</head>
<body>
    <h1>Data Penjualan Detail</h1>
    <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualandetail/tambah">+ Tambah Data</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID Penjualan</th>
            <th>ID Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->penjualan_id }}</td>
            <td>{{ $d->barang_id }}</td>
            <td>{{ $d->harga }}</td>
            <td>{{ $d->jumlah }}</td>
            <td>
                <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualandetail/ubah/{{ $d->detail_id }}">Ubah</a>
                <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualandetail/hapus/{{ $d->detail_id }}">Hapus</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
