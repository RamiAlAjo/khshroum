@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="card-title pt-2 text-dark font-weight-bold">Add Client</h5>

                <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="url">Client URL</label>
                        <input type="url" class="form-control shadow-sm" name="url" id="url" value="{{ old('url') }}" required>
                        @error('url')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="image">Upload Image</label>
                        <input type="file" class="form-control shadow-sm" name="image" id="image" accept="image/*" required>
                        @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-dark rounded-pill shadow-sm">Save</button>
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-light rounded-pill shadow-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
