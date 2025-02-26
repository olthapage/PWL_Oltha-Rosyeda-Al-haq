<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Pengguna</title>
</head>
<body>
    <h1>Profil Pengguna</h1>
    <h2 style="font-weight: normal;">Menampilkan Profil Pengguna POS</h2>
    
    <p><strong>ID:</strong> {{ $id }}</p>
    <p><strong>Nama:</strong> {{ $name }}</p>

    <a href="{{ route('home') }}">Kembali ke Halaman Home</a>
</body>
</html>
