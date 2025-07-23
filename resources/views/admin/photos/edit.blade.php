@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-6 offset-xl-3">
        <div class="card mb-3">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-6">
                        <h5 class="card-title pt-2">Edit Photo</h5>
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

                <form action="{{ route('admin.photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="album_id">Select Album</label>
                        <select class="form-control" id="album_id" name="album_id" required>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}" {{ $album->id == old('album_id', $photo->album_id) ? 'selected' : '' }}>
                                    {{ $album->album_title_en ?? 'Untitled Album' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Current Photo</label>
                        <div>
                            @if($photo->album_images)
                                <img src="{{ asset('storage/' . $photo->album_images) }}" alt="Current Photo" style="max-width: 100%; max-height: 250px; object-fit: contain;">
                            @else
                                <p class="text-muted">No image available.</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="album_images">Change Photo (optional)</label>
                        <input type="file" class="form-control" id="album_images" name="album_images" accept="image/*">
                        <small class="form-text text-muted">Leave empty to keep current photo.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Photo</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
