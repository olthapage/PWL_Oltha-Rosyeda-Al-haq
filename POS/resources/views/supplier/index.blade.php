@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('supplier/import') }}')" class="btn btn-sm btn-secondary">Import Supplier</button>
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('supplier/create') }}">Tambah</a>
            <button onclick="modalAction('{{ url('supplier/create_ajax') }}')" class="btn btn-sm btn-success">Tambah Ajax</button>
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
                        <select class="form-control" id="filter_supplier" name="filter_supplier">
                            <option value="">- Semua -</option>
                            @foreach($suppliers as $item)
                                <option value="{{ $item->supplier_id }}">{{ $item->supplier_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pilih supplier untuk melihat data</small>
                    </div>
                </div>
            </div>
        </div>     
        <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Alamat</th>
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
    var dataSupplier;
$(document).ready(function() {
        dataSupplier = $('#table_supplier').DataTable({
        serverSide: true,
        ajax: {
            url: "{{ url('supplier/list') }}",
            dataType: "json",
            type: "POST",
        },
        columns: [
            {
                data: "supplier_id",
                className: "text-center",
                orderable: true,
                searchable: true
            },
            {
                data: "supplier_kode",
                className: "",
                orderable: true,
                searchable: true
            },
            {
                data: "supplier_nama",
                className: "",
                orderable: true,
                searchable: true
            },
            {
                data: "supplier_alamat",
                className: "",
                orderable: true,
                searchable: true
            },
            {
                data: "aksi",
                className: "",
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
@endpush
