@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mt-2">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="mb-0">{{ $header }}</h2>
                </div>
            </div>
        </div>

        <div class="card-body row">
            <div class="col-md-6">
                <form action="{{ route($route.'store') }}" class="form-global-handle" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name"> Name <span class="text-danger">*</span> </label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" >
                    </div>
                    <div class="form-group">
                        <label for="deskripsi"> Description <span class="text-danger">*</span> </label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="images"> Images <span class="text-danger">*</span> </label>
                        <input type="file" name="images" value="{{ old('images') }}" class="form-control input-only-img" id="images" >
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a class="btn btn-secondary" href="{{ route($route.'index') }}">Back</a>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('js/custom.js') }}"></script>

@endpush
