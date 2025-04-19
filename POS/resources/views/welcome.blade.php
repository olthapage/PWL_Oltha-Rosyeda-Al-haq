@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Halo, apakabar!!!</h3>
    </div>
    <div class="card-body">
        <p>Selamat datang di halaman utama aplikasi.</p>
        <p>Hari ini: <strong>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</strong></p>
    </div>
</div>

<div class="row mt-3">
<div class="col-lg-4 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{ $totalUser }}</h3>
            <p>Total User</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
    </div>
</div>

<div class="col-lg-4 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $totalPenjualan }}</h3>
            <p>Total Penjualan</p>
        </div>
        <div class="icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
    </div>
</div>

<div class="col-lg-4 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>Rp {{ number_format($totalHargaPenjualan, 0, ',', '.') }}</h3>
            <p>Total Harga Penjualan</p>
        </div>
        <div class="icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
    </div>
</div>
</div>

<!-- Peringatan Stok Hampir Habis -->
@if ($lowStockItems->count() > 0)
    <div class="alert alert-danger mt-3">
        <strong>Perhatian!</strong> Beberapa barang stoknya hampir habis:
        <ul>
            @foreach ($lowStockItems as $item)
                @php
                    $barang = App\Models\BarangModel::find($item->barang_id);  
                @endphp
                <li>{{ $barang->barang_nama }} (Stok: {{ $item->total_stok }})</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
