<!DOCTYPE html>
<html>
<head>
    <title>Ubah Stok</title>
</head>
<body>
    <h1>Form Ubah Data Stok</h1>
    <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/stok">Kembali</a>
    <br><br>
    <form method="post" action="/PWL_Oltha-Rosyeda-Al-haq/POS/public/stok/ubah_simpan/{{ $data->stok_id }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label>Supplier ID</label>
        <input type="number" name="supplier_id" placeholder="Masukkan ID Supplier">
        <br>

        <label>ID Barang</label>
        <input type="number" name="barang_id" placeholder="Masukkan ID Barang">
        <br>

        <label>User ID</label>
        <input type="number" name="user_id" placeholder="Masukkan ID User">
        <br>

        <label>Tanggal Stok</label>
        <input type="datetime-local" name="stok_tanggal">
        <br>

        <label>Jumlah Stok</label>
        <input type="number" name="stok_jumlah" placeholder="Masukkan Jumlah Stok">
        <br><br>
        <input type="submit" value="Ubah">
    </form>
</body>
</html>
