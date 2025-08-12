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

                <!-- Success Message -->
                @if (session('status-success'))
                    <div class="alert alert-success">
                        {{ session('status-success') }}
                    </div>
                @endif

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

                <!-- Form -->
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
                        <input type="file" class="form-control" id="album_images" name="album_images[]" multiple accept="image/*" required onchange="previewImages()">
                        <small class="form-text text-muted">You can select multiple images (Max size: 10MB per file).</small>

                        <!-- Preview Images -->
                        <div id="image_preview" style="margin-top: 10px;"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Upload Photos</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    // Function to Preview Images Before Upload
    function previewImages() {
        const preview = document.getElementById('image_preview');
        preview.innerHTML = ''; // Clear any previous previews

        const files = document.getElementById('album_images').files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px'; // Set a max width for the preview
                img.style.margin = '5px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }

    // Optional: Client-side validation for file size (10MB max per file)
    document.getElementById('album_images').addEventListener('change', function() {
        const files = this.files;
        for (let i = 0; i < files.length; i++) {
            if (files[i].size > 10 * 1024 * 1024) { // 10MB
                alert('File size exceeds the limit of 10MB');
                this.value = ''; // Clear the file input
                return;
            }
        }
    });
</script>

@endsection
