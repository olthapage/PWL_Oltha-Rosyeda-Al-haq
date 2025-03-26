@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('level/create') }}">Tambah</a>
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
                        <select class="form-control" id="filter_level" name="filter_level">
                            <option value="">- Semua -</option>
                            @foreach($levels as $item)
                                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Filter berdasarkan Level</small>
                    </div>
                </div>
            </div>
        </div>        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_level">
            <thead>
                <tr>
                    <th>Level ID</th>
                    <th>Kode Level</th>
                    <th>Nama Level</th>
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
        var dataLevel = $('#table_level').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('level/list') }}",
                type: "POST",
                data: function(d) {
                    d.level_id = $('#filter_level').val(); 
                }
            },
            columns: [
                {
                    data: "level_id", 
                    className: "text-center",
                    orderable: true, 
                    searchable: true 
                },
                {
                    data: "level_kode", 
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "level_nama", 
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
