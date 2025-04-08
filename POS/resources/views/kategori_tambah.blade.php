<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
</head>
<body>
    <h1>Form Tambah Data Kategori</h1>
    <form method="post" action="/PWL_Oltha-Rosyeda-Al-haq/POS/public/kategori/tambah_simpan">
        {{ csrf_field() }}

        <label>Kategori ID</label>
        <input type="number" name="kategori_id" placeholder="Masukkan id">
        <br>
        <label>Kategori Kode</label>
        <input type="text" name="kategori_kode" placeholder="Masukkan kode">
        <br>
        <label>Kategori Nama</label>
        <input type="text" name="kategori_nama" placeholder="Masukkan kode">
        <br><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>
