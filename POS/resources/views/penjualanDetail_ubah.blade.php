<!DOCTYPE html>
<html>
<head>
    <title>Ubah Data Penjualan Detail</title>
</head>
<body>
    <h1>Form Ubah Data Penjualan Detail</h1>
    <a href="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualandetail">Kembali</a>
    <br><br>

    <form method="post" action="/PWL_Oltha-Rosyeda-Al-haq/POS/public/penjualandetail/ubah_simpan/{{ $data->detail_id }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label>ID Penjualan</label>
        <input type="number" name="penjualan_id" value="{{ $data->penjualan_id }}" placeholder="Masukkan ID Penjualan">
        <br>

        <label>ID Barang</label>
        <input type="number" name="barang_id" value="{{ $data->barang_id }}" placeholder="Masukkan ID Barang">
        <br>

        <label>Harga</label>
        <input type="number" name="harga" value="{{ $data->harga }}" placeholder="Masukkan Harga">
        <br>

        <label>Jumlah</label>
        <input type="number" name="jumlah" value="{{ $data->jumlah }}" placeholder="Masukkan Jumlah">
        <br><br>

        <input type="submit" value="Ubah">
    </form>
</body>
</html>
