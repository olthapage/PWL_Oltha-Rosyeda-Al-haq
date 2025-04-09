@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan/create') }}">Tambah</a>
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
                    <th>Kode</th>
                    <th>Pembeli</th>
                    <th>Tanggal</th>
                    <th>User</th>
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
    var dataPenjualan = $('#table_penjualan').DataTable({
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
            { data: "penjualan_kode" },
            { data: "pembeli" },
            { data: "penjualan_tanggal" },
            { data: "nama" }, 
            { data: "aksi", orderable: false, searchable: false, className: "text-center" }
        ]
    });
});
</script>
@endpush
