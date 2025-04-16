<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <form id="formUploadFoto" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Ubah Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
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
                    <input type="file" name="foto" class="form-control" required>
                    <small class="form-text text-muted">Format: jpeg, png, jpg, gif. Maks: 2MB</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
