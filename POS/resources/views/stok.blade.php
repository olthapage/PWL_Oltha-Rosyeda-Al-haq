<!DOCTYPE html>
<html>
<head>
    <title>Data Stok</title>
</head>
<body>
    <h1>Data Stok</h1>
    <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/stok/tambah">+ Tambah Stok</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>ID</td>
            <td>Supplier ID</td>
            <td>Barang ID</td>
            <td>User ID</td>
            <td>Tanggal Stok</td>
            <td>Jumlah Stok</td>
            <td>Aksi</td>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->stok_id }}</td>
            <td>{{ $d->supplier_id }}</td>
            <td>{{ $d->barang_id }}</td>
            <td>{{ $d->user_id }}</td>
            <td>{{ $d->stok_tanggal }}</td>
            <td>{{ $d->stok_jumlah }}</td>
            <td>
                <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/stok/ubah/{{ $d->stok_id }}">Ubah</a>
                <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/stok/hapus/{{ $d->stok_id }}">Hapus</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
