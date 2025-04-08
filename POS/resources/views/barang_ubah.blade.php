<!DOCTYPE html>
<html>
<head>
    <title>Ubah Barang</title>
</head>
<body>
    <h1>Form Ubah Data Barang</h1>
    <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/barang">Kembali</a>
    <br><br>
    <form method="post" action="/PWL_Oltha-Rosyeda-Al-haq/POS/public/barang/ubah_simpan/{{ $data->barang_id }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label>Kategori ID</label>
        <input type="number" name="kategori_id" placeholder="Masukkan kategori id">
        <br>
        <label>Barang Kode</label>
        <input type="text" name="barang_kode" placeholder="Masukkan barang kode">
        <br>
        <label>Barang Nama</label>
        <input type="text" name="barang_nama" placeholder="Masukkan nama barang">
        <br>
        <label>Harga Beli</label>
        <input type="number" name="harga_beli" placeholder="Masukkan harga beli">
        <br>
        <label>Harga Jual</label>
        <input type="number" name="harga_jual" placeholder="Masukkan harga jual">
        <br><br>
        <input type="submit" value="Ubah">
    </form>
</body>
</html>
