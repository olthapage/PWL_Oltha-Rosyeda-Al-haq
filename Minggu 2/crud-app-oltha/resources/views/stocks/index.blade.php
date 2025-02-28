<!DOCTYPE html>
<html>
<head>
    <title>Stock List</title>
</head>
<body>
    <h1>Stocks</h1>
    {{--  menampilkan pesan sukses --}}
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    {{-- Link digunakan untuk menambahkan stock baru --}}
    <a href="{{ route('stocks.create') }}">Add Stock</a>
    <ul>
        {{-- Looping digunakan untuk menampilkan daftar stock --}}
        @foreach($stocks as $stock)
            <li>
                {{ $stock->name }} -
                <a href="{{ route('stocks.edit', $stock) }}">Edit</a>
                {{-- Form digunakan untuk menghapus stock --}}
                <form action="{{ route('stocks.destroy', $stock) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
