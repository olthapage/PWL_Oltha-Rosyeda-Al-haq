<!DOCTYPE html>
<html>
<head>
    <title>Tambah Level</title>
</head>
<body>
    <h1>Form Tambah Data Level</h1>
    <form method="post" action="/PWL_Oltha-Rosyeda-Al-haq/POS/public/level/tambah_simpan">
        {{ csrf_field() }}

        <label>Level ID</label>
        <input type="number" name="level_id" placeholder="Masukkan id">
        <br>
        <label>Kode Level</label>
        <input type="text" name="level_kode" placeholder="Masukkan kode">
        <br>
        <label>Nama Level</label>
        <input type="text" name="level_nama" placeholder="Masukkan nama">
        <br><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>
