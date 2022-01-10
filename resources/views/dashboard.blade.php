@extends('admin.layouts.app')
@section('content')
<div class="">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="m-0 font-weight-bold text-dark">{{ $header ?? '..' }}</h3>
                </div>
                    {{-- <div class="col text-right">
                        <a href="{{ route($route. 'create') }}" class="btn btn-success">Tambah</a>
                    </div> --}}
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table align-items-center border w-100"  id="data-table">
                <thead class="thead-light">
                    <tr>
                        <th width="5%" scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga Per Hari</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

@endsection
