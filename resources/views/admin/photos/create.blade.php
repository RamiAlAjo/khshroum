@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-6 offset-xl-3">
        <div class="card mb-3">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-6">
                        <h5 class="card-title pt-2">Add New Photos</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('admin.photos.index') }}" class="btn btn-secondary">Back to Gallery</a>
                    </div>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="album_id">Select Album</label>
                        <select class="form-control" id="album_id" name="album_id" required>
                            <option value="" disabled selected>Choose an album</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}" {{ old('album_id') == $album->id ? 'selected' : '' }}>
                                    {{ $album->album_title_en ?? 'Untitled Album' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="album_images">Upload Photos</label>
                        <input type="file" class="form-control" id="album_images" name="album_images[]" multiple accept="image/*" required>
                        <small class="form-text text-muted">You can select multiple images.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Upload Photos</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
