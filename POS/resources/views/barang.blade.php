<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>
    <h1>Data Barang</h1>
    <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/barang/tambah">+ Tambah Barang</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>ID</td>
            <td>Kategori ID</td>
            <td>Kode Barang</td>
            <td>Nama Barang</td>
            <td>Harga Beli</td>
            <td>Harga Jual</td>
            <td>Aksi</td>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->barang_id }}</td>
            <td>{{ $d->kategori_id }}</td>
            <td>{{ $d->barang_kode }}</td>
            <td>{{ $d->barang_nama }}</td>
            <td>{{ $d->harga_beli }}</td>
            <td>{{ $d->harga_jual }}</td>
            <td>
                <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/barang/ubah/{{ $d->barang_id }}">Ubah</a>
                <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/barang/hapus/{{ $d->barang_id }}">Hapus</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
