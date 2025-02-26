<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Home</title>
</head>
<body>
    <h1>Halaman Home</h1>
    <h2 style="font-weight: normal;">Menampilkan halaman awal POS</h2>
    <ul>
        <li><a href="{{ route('products.index') }}">Halaman Products</a></li>
        <li><a href="{{ url('/user/2341720145/name/Oltha Roosyeda Alhaq') }}">Halaman User</a></li>
        <li><a href="{{ url('/sales') }}">Halaman Sales</a></li>
    </ul>
</body>
</html>
