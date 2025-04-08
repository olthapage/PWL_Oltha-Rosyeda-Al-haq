<!DOCTYPE html>
<html>
<head>
    <title>Ubah Data Penjualan</title>
</head>
<body>
    <h1>Form Ubah Data Penjualan</h1>
    <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualan">Kembali</a>
    <br><br>

    <form method="post" action="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualan/ubah_simpan/{{ $data->penjualan_id }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

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
        <input type="submit" value="Ubah">
    </form>
</body>
</html>
