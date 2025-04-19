@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('barang/import') }}')" class="btn btn-sm btn-secondary">Import Barang</button>
            {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah</a> --}}
            <a href="{{ url('barang/export_excel') }}" class="btn btn-primary btn-sm"><i class="fa fa-fileexcel"></i> Export Barang (excel)</a>
            <a href="{{ url('/barang/export_pdf') }}" class="btn btn-warning btn-sm"><i class="fa fa-filepdf"></i> Export Barang (pdf)</a>
            <button onclick="modalAction('{{ url('barang/create_ajax') }}')" class="btn btn-sm btn-success">Tambah Barang</button>
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
                        <select class="form-control" id="kategori_id" name="kategori_id" required>
                            <option value="">- Semua -</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                            @endforeach
                        </select>                        
                        <small class="form-text text-muted">Kategori Barang</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
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
    var dataBarang;
$(document).ready(function() {
        dataBarang = $('#table_barang').DataTable({
        serverSide: true,
        ajax: {
            url: "{{ url('barang/list') }}",
            dataType: "json",
            type: "POST"
        },
        columns: [
            { data: "barang_id", className: "text-center" },
            { data: "kategori_nama" },
            { data: "barang_kode" },
            { data: "barang_nama" },
            { data: "harga_beli", className: "text-right" },
            { data: "harga_jual", className: "text-right" },
            { data: "aksi", orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
