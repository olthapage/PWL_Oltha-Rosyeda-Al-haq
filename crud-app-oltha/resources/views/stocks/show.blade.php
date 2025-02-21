<!DOCTYPE html>
<html>
<head>
    <title>Stock List</title> {{-- Untuk menentukan judul halaman --}}
</head>
<body>
    <h1>Stocks</h1> {{-- Menampilkan heading halaman --}}
    @if(session('success')) {{-- Untuk mengecek apakah ada session 'success' yang dikirim --}}
        <p>{{ session('success') }}</p> {{-- Jika ada pesan suskses ditampilkan --}}
    @endif
    <a href="{{ route('stocks.create') }}">Add Stock</a> {{-- Link untuk menambahkan stock baru --}}
    <ul>
        @foreach ($stocks as $stock) {{-- Looping melalui daftar stock --}}
            <li>
                {{ $stock->name }} - {{-- Menampilkan nama stock --}}
                <a href="{{ route('stocks.edit', $stock) }}">Edit</a> {{-- Link untuk mengedit stock --}}
                <form action="{{ route('stocks.destroy', $stock) }}" method="POST" style="display:inline;">
                    {{-- mengahpus stock dengan method POST --}}
                    @csrf {{-- Token CSRF untuk keamanan laravell  --}}
                    @method('DELETE') {{-- Mengubah metode HTTP menjadi DELETE untuk memproses penghapusan --}}
                    <button type="submit">Delete</button> {{-- Tombol untuk menghapus stock --}}
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
