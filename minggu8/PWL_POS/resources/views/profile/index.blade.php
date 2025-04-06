@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Profil Pengguna</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('profile/edit') }}">
                <i class="fa fa-edit"></i> Ubah Foto
            </a>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-3 text-center">
                @if($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}" width="150" class="img-thumbnail mb-2">
                @else
                    <p class="text-muted">Belum ada foto</p>
                @endif
            </div>
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <th>Username</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>{{ $user->level_id ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $user->created_at ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $user->updated_at ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
