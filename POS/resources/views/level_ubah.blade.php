<!DOCTYPE html>
<html>
<head>
    <title>Ubah Level</title>
</head>
<body>
    <h1>Form Ubah Data Level</h1>
    <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/level">Kembali</a>
    <br><br>
    <form method="post" action="/PWL_Oltha-Rosyeda-Al-haq/POS/public/level/ubah_simpan/{{ $data->level_id }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label>Level ID</label>
        <input type="number" name="level_id" placeholder="Masukkan id">
        <br>
        <label>Kode Level</label>
        <input type="text" name="level_kode" placeholder="Masukkan kode">
        <br>
        <label>Nama Level</label>
        <input type="text" name="level_nama" placeholder="Masukkan nama">
        <br><br>
        <input type="submit" value="Ubah">
    </form>
</body>
</html>
