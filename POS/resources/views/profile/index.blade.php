@extends('layouts.template')
 
@section('content')
<div class="card card-outline card-primary shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0"><i class="fa fa-user-circle"></i> Profil Pengguna</h3>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-3 text-center mb-3">
                @if($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}" class="img-fluid rounded-circle shadow" style="max-width: 200px;">
                @else
                    <img src="{{ asset('images/default-user.png') }}" class="img-fluid rounded-circle shadow" style="max-width: 200px;">
                @endif
            </div>

            <div class="col-md-9">
                <div class="profile-info">
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold h5">Username</div>
                        <div class="col-md-8 h5">: {{ $user->username }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold h5">Nama Lengkap</div>
                        <div class="col-md-8 h5">: {{ $user->nama }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold h5">Level</div>
                        <div class="col-md-8 h5">: {{ $user->level->level_nama ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold h5">User ID</div>
                        <div class="col-md-8 h5">: {{ $user->user_id }}</div>
                    </div>
                </div>
            </div>
            
        </div>
        <a href="javascript:void(0)" onclick="modalUploadFoto('{{ url('profile/edit') }}')" class="btn btn-sm btn-primary">
            <i class="fa fa-camera"></i> Ubah Foto
        </a>
        <div id="modalFoto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
    </div>
</div>
@endsection

@push('js')
<script>
    function modalUploadFoto(url) {
        $('#modalFoto').load(url, function () {
            $('#modalFoto').modal('show');
        });
    }

    $(document).on('submit', '#formUploadFoto', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ url('/profile') }}",
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            beforeSend: function () {
                $('#formUploadFoto button[type=submit]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
            },
            success: function (res) {
                if (res.status === true) {
                    $('#modalFoto').modal('hide');
                    Swal.fire('Berhasil', res.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Gagal', 'Terjadi kesalahan saat mengunggah foto.', 'error');
            },
            complete: function () {
                $('#formUploadFoto button[type=submit]').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            }
        });
    });
</script>
@endpush
