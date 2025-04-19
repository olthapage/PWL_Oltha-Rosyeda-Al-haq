@empty($penjualan)
     <div id="modal-master" class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                         aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
                 <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                 </div>
                 <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
             </div>
         </div>
     </div>
 @else
<form action="{{ url('/penjualan/' . $penjualan->penjualan_id . '/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Pembeli</label>
                    <input type="text" name="pembeli" value="{{ $penjualan->pembeli }}" class="form-control" required>
                    <small id="error-pembeli" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kode Penjualan</label>
                    <input type="text" name="penjualan_kode" value="{{ $penjualan->penjualan_kode }}" class="form-control" required>
                    <small id="error-penjualan_kode" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Tanggal Penjualan</label>
                    <input type="datetime-local" name="penjualan_tanggal" value="{{ \Carbon\Carbon::parse($penjualan->penjualan_tanggal)->format('Y-m-d\TH:i') }}" class="form-control" required>
                    <small id="error-penjualan_tanggal" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>User</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($user as $u)
                            <option value="{{ $u->user_id }}" {{ $penjualan->user_id == $u->user_id ? 'selected' : '' }}>
                                {{ $u->nama }}
                            </option>
                        @endforeach
                    </select>
                    <small id="error-user_id" class="error-text form-text text-danger"></small>
                </div>
                <h5>Detail Penjualan</h5>
<table class="table table-bordered" id="detail-penjualan-table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penjualan->detail as $i => $d)
            <tr>
                <td>
                    <input type="hidden" name="detail_id[]" value="{{ $d->detail_id }}">
                    <input type="text" name="barang_nama[]" class="form-control" value="{{ $d->barang->barang_nama ?? '' }}" readonly>
                    <input type="hidden" name="barang_id[]" value="{{ $d->barang_id }}">
                </td>
                <td><input type="number" name="harga[]" class="form-control" value="{{ $d->harga }}"></td>
                <td><input type="number" name="jumlah[]" class="form-control" value="{{ $d->jumlah }}"></td>
                <td><input type="number" name="total[]" class="form-control" value="{{ $d->total }}" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm btn-remove-detail">Hapus</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<button type="button" class="btn btn-sm btn-success" id="btn-tambah-detail">Tambah Detail</button>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).on('click', '#btn-tambah-detail', function() {
        $('#detail-penjualan-table tbody').append(`
            <tr>
                <td>
                    <input type="hidden" name="detail_id[]" value="">
                    <input type="text" name="barang_nama[]" class="form-control" value="" placeholder="Nama Barang">
                    <input type="hidden" name="barang_id[]" value="">
                </td>
                <td><input type="number" name="harga[]" class="form-control" value=""></td>
                <td><input type="number" name="jumlah[]" class="form-control" value=""></td>
                <td><input type="number" name="total[]" class="form-control" value="0" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm btn-remove-detail">Hapus</button></td>
            </tr>
        `);
    });

    $(document).on('click', '.btn-remove-detail', function() {
        $(this).closest('tr').remove();
    });

    $(document).on('input', '[name="harga[]"], [name="jumlah[]"]', function() {
        const row = $(this).closest('tr');
        const harga = parseFloat(row.find('[name="harga[]"]').val()) || 0;
        const jumlah = parseFloat(row.find('[name="jumlah[]"]').val()) || 0;
        const total = harga * jumlah;
        row.find('[name="total[]"]').val(total);
    });
    $(document).ready(function() {
        $("#form-edit").validate({
            rules: {
                pembeli: { required: true, minlength: 3, maxlength: 20 },
                penjualan_kode: { required: true, minlength: 3, maxlength: 100 },
                penjualan_tanggal: { required: true },
                user_id: { required: true },
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataPenjualan.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
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
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endempty