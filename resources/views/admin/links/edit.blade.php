@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="card-title pt-2 text-dark font-weight-bold">Edit Link</h5>

                <form action="{{ route('admin.links.update', $link->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="url">Link URL</label>
                        <input type="url" class="form-control shadow-sm" name="url" id="url" value="{{ old('url', $link->url) }}" required>
                        @error('url')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="image">Upload New Image</label>
                        <input type="file" class="form-control shadow-sm" name="image" id="image" accept="image/*">
                        @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        @if($link->image)
                            <div class="mt-3">
                                <p>Current Image:</p>
                                <img src="{{ asset('storage/' . $link->image) }}" alt="Link Image" style="max-width: 200px; border-radius: 5px;">
                            </div>
                        @endif
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-dark rounded-pill shadow-sm">Update</button>
                        <a href="{{ route('admin.links.index') }}" class="btn btn-light rounded-pill shadow-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
