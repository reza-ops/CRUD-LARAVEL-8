@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="m-0 font-weight-bold text-dark">{{ $header ?? '..' }}</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route($route. 'create') }}" class="btn btn-success">Create</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table align-items-center border w-100"  id="data-table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Desckription</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
    $(document).ready(function () {
        var id = "#data-table";
        var url = '{!! route($route.'get_data') !!}';
        var column =  [
            { searchable: false, orderable: false,sortable:false,data: 'no'},
            { searchable: true, orderable: true,data: 'name', name: 'name' },
            { searchable: true, orderable: true,data: 'description', name: 'description' },
            { searchable: false, orderable: false,data: 'action', name: 'action' },
        ];
        global.init_datatable(id, url, column);
    });
</script>
@endpush
