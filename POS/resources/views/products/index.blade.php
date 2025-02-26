<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Products</title>
</head>
<body>
    <h1>Halaman Products</h1>
    <h2 style="font-weight: normal;">Menampilkan daftar product</h2>
    <ul>
    <li><a href="{{ route('category.food') }}">Food & Beverage</a></li>
    <li><a href="{{ route('category.beauty') }}">Beauty & Health</a></li>
    <li><a href="{{ route('category.home') }}">Home Care</a></li>
    <li><a href="{{ route('category.baby') }}">Baby & Kid</a></li>
    <br>
    <a href="{{ route('home') }}">Kembali ke Halaman Home</a>

    </ul>
</body>
</html>
