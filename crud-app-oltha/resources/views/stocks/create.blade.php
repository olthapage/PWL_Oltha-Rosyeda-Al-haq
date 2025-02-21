<!DOCTYPE html>
<html>
<head>
    <title>Add Stock</title> {{-- untuk menentukan judul halaman --}}
</head>
<body>
    <h1>Add Stock</h1> {{-- menampilkan heading halaman --}}
    <form action="{{ route('stocks.store') }}" method="POST"> {{-- Formulir untuk menambahkan stock, mengarah ke route 'stocks.store' dengan metode POST --}}
        @csrf {{-- Token CSRF untuk keamanan laravell--}}
        <label for="name">Name:</label> {{-- Label untuk input nama --}}
        <input type="text" name="name" required> {{-- Input teks untuk nama stock --}}
        <br> 
        <label for="description">Description:</label> {{-- Label untuk input deskripsi --}}
        <textarea name="description" required></textarea> {{-- Input textarea untuk deskripsi stock --}}
        <br> 
        <button type="submit">Add Stock</button> {{-- Untuk mengirimkan formulir --}}
    </form>
    <a href="{{ route('stocks.index') }}">Back to List</a> {{-- Link untuk kembali ke daftar item --}}
</body>
</html>
