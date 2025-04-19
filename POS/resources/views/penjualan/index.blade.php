@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('penjualan/import') }}')" class="btn btn-sm btn-secondary">Import Penjualan</button>
            {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan/create') }}">Tambah</a> --}}
            <a href="{{ url('penjualan/export_excel') }}" class="btn btn-primary btn-sm"><i class="fa fa-fileexcel"></i> Export Penjualan (excel)</a>
            <a href="{{ url('penjualan/export_pdf') }}" class="btn btn-warning btn-sm"><i class="fa fa-filepdf"></i> Export Penjualan (pdf)</a>
            <button onclick="modalAction('{{ url('penjualan/create_ajax') }}')" class="btn btn-sm btn-success">Tambah Ajax</button>
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
                        <select class="form-control" id="filter_penjualan" name="filter_penjualan">
                            <option value="">- Semua Penjualan -</option>
                            @foreach($penjualan as $item)
                                <option value="{{ $item->tanggal }}">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Filter berdasarkan tanggal penjualan</small>
                    </div>
                </div>
            </div>
        </div> 
        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User kasir</th>
                    <th>Pembeli</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        <div class="mt-3 text-end">
            <a href="{{ url('/penjualanDetail') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-eye"></i> Lihat Detail Penjualan
            </a>
        </div>        
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" data-width="75%" aria-hidden="false"></div>
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
    var dataPenjualan;
$(document).ready(function() {
        dataPenjualan = $('#table_penjualan').DataTable({
        serverSide: true,
        ajax: {
            url: "{{ url('penjualan/list') }}",
            dataType: "json",
            type: "POST",
            // Tambah CSRF token
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
            { data: "penjualan_id", className: "text-center" },
            { data: "nama" }, 
            { data: "pembeli" },
            { data: "penjualan_kode" },
            { data: "penjualan_tanggal" },
            { data: "aksi", orderable: false, searchable: false, className: "text-center" }
        ]
    });
});
</script>
@endpush
