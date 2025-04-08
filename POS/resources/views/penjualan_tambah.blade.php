<!DOCTYPE html>
<html>
<head>
    <title>Tambah Penjualan</title>
</head>
<body>
    <h1>Form Tambah Data Penjualan</h1>
    <form method="post" action="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualan/tambah_simpan">
        {{ csrf_field() }}

        <label>User ID</label>
        <input type="number" name="user_id" placeholder="Masukkan User ID">
        <br>

        <label>Nama Pembeli</label>
        <input type="text" name="pembeli" placeholder="Masukkan Nama Pembeli">
        <br>

        <label>Kode Penjualan</label>
        <input type="text" name="penjualan_kode" placeholder="Masukkan Kode Penjualan">
        <br>

        <label>Tanggal Penjualan</label>
        <input type="datetime-local" name="penjualan_tanggal">
        <br><br>

        <input type="submit" value="Simpan">
    </form>
</body>
</html>
