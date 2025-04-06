@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Ubah Foto Profil</h3>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ url('/profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Foto Saat Ini:</label><br>
                @if($user->foto)
                <img src="{{ asset('storage/' . $user->foto) }}" width="150" class="img-thumbnail">
                @else
                    <p class="text-muted">Belum ada foto</p>
                @endif
            </div>

            <div class="form-group">
                <label for="foto">Upload Foto Baru</label>
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="form-text text-muted">Format: jpeg, png, jpg, gif. Maks: 2MB</small>
            </div>

            <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-save"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
