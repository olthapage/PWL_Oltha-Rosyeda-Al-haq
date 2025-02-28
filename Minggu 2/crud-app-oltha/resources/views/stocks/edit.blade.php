<!DOCTYPE html>
<html>
<head>
    <title>Edit Stock</title> {{-- Untuk Menentukan judlu halaman --}}
</head>
<body>
    <h1>Edit Stock</h1> {{-- Menampilkan heading halaman --}}
    <form action="{{ route('stocks.update', $stock) }}" method="POST"> 
        {{-- Formulir untuk mengedit item, mengarah ke route 'items.update' dengan parameter item dan metode POST --}}
        @csrf {{-- Token CSRF untuk keamanan laravell --}}
        @method('PUT') {{-- Mengubah metode HTTP menjadi PUT digunakan untuk proses update data --}}
        <label for="name">Name:</label> {{-- Label untuk input nama --}}
        <input type="text" name="name" value="{{ $stock->name }}" required> 
        {{-- Input teks untuk nama stock dan menampilkan nama stock --}}
        <br> 
        <label for="description">Description:</label> {{-- Label untuk input deskripsi --}}
        <textarea name="description" required>{{ $stock->description }}</textarea> 
        {{-- Input textarea untuk deskripsi stock dan menampilkan deskripsi --}}
        <br> 
        <button type="submit">Update Stock</button> {{-- Tomblo untuk mengirimkan formulir --}}
    </form>
    <a href="{{ route('stocks.index') }}">Back to List</a> 
    {{-- Link untuk kembali ke daftar stock --}}
</body>
</html>
