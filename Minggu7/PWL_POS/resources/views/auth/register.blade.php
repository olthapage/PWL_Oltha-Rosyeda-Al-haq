<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register Pengguna</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ url('/') }}" class="h1"><b>Form</b> Register</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Tambah user baru</p>
      <form action="{{ url('register.store') }}" method="POST" id="form-register">
        @csrf
        <div class="form-group">
          <label for="level">Level</label>
            <div class="col-11">
                <select class="form-control" id="level_id" name="level_id" required>
                    <option value="">Pilih Level</option>
                    @foreach($level as $item)
                        <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                    @endforeach
                </select>
                @error('level_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username">
          <small id="error-username" class="text-danger error-text"></small>
        </div>

        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap">
          <small id="error-nama" class="text-danger error-text"></small>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password">
          <small id="error-password" class="text-danger error-text"></small>
        </div>

        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
          </div>
          <div class="col-6">
            <a href="{{ url('login') }}" class="btn btn-secondary btn-block">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

<script>
$(document).ready(function() {
  $("#form-register").validate({
    rules: {
      level: { required: true },
      username: { required: true, minlength: 4 },
      nama: { required: true },
      password: { required: true, minlength: 5 }
    },
    submitHandler: function(form) {
      $.ajax({
        url: registerStoreUrl,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
          if(response.status){
            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: response.message,
            }).then(() => {
              window.location = response.redirect;
            });
          } else {
            $('.error-text').text('');
            $.each(response.msgField, function(prefix, val) {
              $('#error-'+prefix).text(val[0]);
            });
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: response.message
            });
          }
        }
      });
      return false;
    },
    errorElement: 'span',
    errorPlacement: function(error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function(element) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function(element) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
<script>
  const registerStoreUrl = "{{ route('register.store') }}";
</script>
</body>
</html>
