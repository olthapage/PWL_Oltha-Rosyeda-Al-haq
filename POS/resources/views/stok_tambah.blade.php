<!DOCTYPE html>
<html>
<head>
    <title>Tambah Stok</title>
</head>
<body>
    <h1>Form Tambah Data Stok</h1>
    <form method="post" action="/PWL_Oltha-Rosyeda-Al-haq/POS/public/stok/tambah_simpan">
        {{ csrf_field() }}

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

        <input type="submit" value="Simpan">
    </form>
</body>
</html>
