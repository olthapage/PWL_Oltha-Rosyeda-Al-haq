@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($penjualan)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
        <a href="{{ url('/penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
        <form method="POST" action="{{ url('/penjualan', $penjualan->penjualan_id) }}" class="form-horizontal">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Nama Pembeli</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="pembeli" value="{{ old('pembeli', $penjualan->pembeli) }}" required>
                    @error('pembeli')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Kode Penjualan</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="penjualan_kode" value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" required>
                    @error('penjualan_kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Tanggal Penjualan</label>
                <div class="col-10">
                    <input type="datetime-local" class="form-control" name="penjualan_tanggal" 
                        value="{{ old('penjualan_tanggal', \Carbon\Carbon::parse($penjualan->penjualan_tanggal)->format('Y-m-d\TH:i')) }}" required>
                    @error('penjualan_tanggal')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">User</label>
                <div class="col-10">
                    <select name="user_id" class="form-control" required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($user as $item)
                            <option value="{{ $item->id }}" {{ old('user_id', $penjualan->user_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label"></label>
                <div class="col-10">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default mt-1" href="{{ url('penjualan') }}">Kembali</a>
                </div>
            </div>
        </form>
        @endempty
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
