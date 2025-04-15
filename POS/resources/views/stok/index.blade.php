@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('stok/import') }}')" class="btn btn-sm btn-secondary">Import Stok</button>
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
            <button onclick="modalAction('{{ url('stok/create_ajax') }}')" class="btn btn-sm btn-success">Tambah Ajax</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
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
                    <th>Supplier</th>
                    <th>Barang</th>
                    <th>User</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
    var dataStok;
$(document).ready(function() {
        dataStok = $('#table_stok').DataTable({
        serverSide: true,
        ajax: {
            url: "{{ url('stok/list') }}",
            dataType: "json",
            type: "POST"
        },
        columns: [
            { data: "stok_id", className: "text-center" },
            { data: "supplier_nama" },
            { data: "barang_nama" },
            { data: "nama" },
            { data: "stok_tanggal" },
            { data: "stok_jumlah", className: "text-right" },
            { data: "aksi", orderable: false, searchable: false, className: "text-center" }
        ]
    });
});
</script>
@endpush
