@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="filter_stok" name="filter_stok">
                            <option value="">- Semua -</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pilih barang untuk melihat stok</small>
                    </div>
                </div>
            </div>
        </div>        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barang ID</th>
                    <th>User ID</th>
                    <th>Tanggal Stok</th>
                    <th>Jumlah Stok</th>
                    <th>Supplier ID</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>    
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataStok = $('#table_stok').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('stok/list') }}",
                type: "POST",
                data: function(d) {
                    d.stok_id = $('#filter_stok').val(); 
                }
            },
            columns: [
                {
                    data: "stok_id", 
                    className: "text-center",
                    orderable: true, 
                    searchable: true 
                },
                {
                    data: "barang_id", 
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "user_id", 
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "stok_tanggal", 
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "stok_jumlah", 
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "supplier_id", 
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi", 
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush
