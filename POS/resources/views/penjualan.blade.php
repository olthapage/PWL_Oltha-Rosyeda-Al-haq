<!DOCTYPE html>
<html>
<head>
    <title>Data Penjualan</title>
</head>
<body>
    <h1>Data Penjualan</h1>
    <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualan/tambah">+ Tambah Penjualan</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>User ID</td>
            <td>Nama Pembeli</td>
            <td>Kode Penjualan</td>
            <td>Tanggal Penjualan</td>
            <td>Aksi</td>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->user_id }}</td>
            <td>{{ $d->pembeli }}</td>
            <td>{{ $d->penjualan_kode }}</td>
            <td>{{ $d->penjualan_tanggal }}</td>
            <td>
                <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualan/ubah/{{ $d->penjualan_id }}">Ubah</a>
                <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualan/hapus/{{ $d->penjualan_id }}">Hapus</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
