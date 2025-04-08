<!DOCTYPE html>
<html>
<head>
    <title>Ubah Kategori</title>
</head>
<body>
    <h1>Form Ubah Data Kategori</h1>
    <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/kategori">Kembali</a>
    <br><br>
    <form method="post" action="/PWL_Oltha-Rosyeda-Al-haq/POS/public/kategori/ubah_simpan/{{ $data->kategori_id }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label>Kategori ID</label>
        <input type="number" name="kategori_id" placeholder="Masukkan id">
        <br>
        <label>Kategori Kode</label>
        <input type="text" name="kategori_kode" placeholder="Masukkan kode">
        <br>
        <label>Kategori Nama</label>
        <input type="text" name="kategori_nama" placeholder="Masukkan kode">
        <br><br>
        <input type="submit" value="Ubah">
    </form>
</body>
</html>
