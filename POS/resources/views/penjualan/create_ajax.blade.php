<form action="{{ url('/penjualan/ajax') }}" method="POST" id="form-tambah-penjualan">
    @csrf
    <div id="modal-penjualan" class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Penjualan</label>
                    <input type="text" name="penjualan_kode" id="penjualan_kode" class="form-control" required>
                    <small id="error-penjualan_kode" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Tanggal Penjualan</label>
                    <input type="datetime-local" name="penjualan_tanggal" id="penjualan_tanggal" class="form-control" required>
                    <small id="error-penjualan_tanggal" class="error-text form-text text-danger"></small>
                </div>                

                <div class="form-group">
                    <label>Pembeli</label>
                    <input type="text" name="pembeli" id="pembeli" class="form-control" required>
                    <small id="error-pembeli" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>User</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($user as $u)
                            <option value="{{ $u->user_id }}">{{ $u->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-user_id" class="error-text form-text text-danger"></small>
                </div>

                <div id="barang-wrapper">
                    <div class="form-group barang-item mb-2">
                        <label>Barang</label>
                        <select name="barang_id[]" class="form-control barang-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barang as $b)
                                <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">{{ $b->barang_nama }}</option>
                            @endforeach
                        </select>
                        <small class="error-text text-danger"></small>
                    </div>
        
                    <div class="form-group"> 
                        <label>Harga</label> 
                        <input type="text" name="harga[]" class="form-control harga-input" readonly> 
                        <small class="error-text form-text text-danger"></small> 
                    </div> 
        
                    <div class="form-group"> 
                        <label>Jumlah</label>
                        <input type="text" name="jumlah[]" class="form-control jumlah-input" required> 
                        <small class="error-text text-danger"></small>
                    </div>
                </div>

                <button type="button" class="btn btn-success btn-sm mb-3" id="tambah-barang">+ Tambah Barang</button>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function () {
    const now = new Date();
    const datetimeLocal = now.toISOString().slice(0,16); 
    $('#penjualan_tanggal').val(datetimeLocal);

    // Fungsi untuk menambah barang
    $('#tambah-barang').on('click', function () {
        let barangItem = `
            <div class="form-group barang-item mb-2">
                <label>Barang</label>
                <select name="barang_id[]" class="form-control barang-select" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">{{ $b->barang_nama }}</option>
                    @endforeach
                </select>
                <small class="error-text text-danger"></small>
            </div>

            <div class="form-group"> 
                <label>Harga</label> 
                <input type="text" name="harga[]" class="form-control harga-input" readonly> 
                <small class="error-text form-text text-danger"></small> 
            </div> 

            <div class="form-group"> 
                <label>Jumlah</label>
                <input type="text" name="jumlah[]" class="form-control jumlah-input" required> 
                <small class="error-text text-danger"></small>
            </div>

            <button type="button" class="btn btn-danger btn-sm remove-barang mt-1">Hapus</button>
            <hr>
        `;
        $('#barang-wrapper').append(barangItem);
    });

    $(document).on('click', '.remove-barang', function () {
        $(this).closest('.barang-item').remove();
    });

    $(document).on('change', '.barang-select', function () {
        var harga = $(this).find('option:selected').data('harga'); 
        $(this).closest('.form-group').next().find('.harga-input').val(harga); 
    });

    $("#form-tambah-penjualan").validate({
        rules: {
            penjualan_kode: { required: true },
            penjualan_tanggal: { required: true },
            pembeli: { required: true },
            user_id: { required: true },
            'barang_id[]': { required: true },
            'harga[]': { required: true },
            'jumlah[]': { required: true }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message });
                        dataPenjualan.ajax.reload();
                    } else {
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]);
                        });
                        Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                    }
                }
            });
            return false;
        }
    });
});
</script>
