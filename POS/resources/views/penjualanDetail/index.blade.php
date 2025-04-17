@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('penjualanDetail/export_excel') }}" class="btn btn-primary btn-sm"><i class="fa fa-fileexcel"></i> Export Detail Penjualan (excel)</a>
            <a href="{{ url('penjualanDetail/export_pdf') }}" class="btn btn-warning btn-sm"><i class="fa fa-filepdf"></i> Export Detail Penjualan (pdf)</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan_detail">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Penjualan</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
        </table>
        <div class="mt-3 text-end">
            <a href="{{ url('penjualan') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Halaman Penjualan
            </a>
        </div>        
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    $('#table_penjualan_detail').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('penjualanDetail/list') }}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'penjualan_id' },
            { data: 'barang_nama' },
            { data: 'harga' },
            { data: 'jumlah' },
            { data: 'total' }
        ]
    });
});
</script>
@endpush
