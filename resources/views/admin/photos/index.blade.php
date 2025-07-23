@extends('admin.layouts.app')

@section('content')
<style>
    .gallery-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>

<div class="row">
    <div class="col-xl-12">
        <div class="card mb-3">
            <div class="card-body">

                <!-- Page Title & Add Button -->
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title pt-2">Photo Gallery</h5>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="{{ route('admin.photos.create') }}" class="btn btn-primary">Add New Photo</a>
                    </div>
                </div>

                <!-- Flash Messages -->
                @if(session('status-success'))
                    <div class="alert alert-success mt-2">
                        {{ session('status-success') }}
                    </div>
                @endif
                @if(session('status-error'))
                    <div class="alert alert-danger mt-2">
                        {{ session('status-error') }}
                    </div>
                @endif

                <!-- Albums Tabs -->
                <ul class="nav nav-tabs mt-4" role="tablist">
                    <!-- All Albums Tab -->
                    <li class="nav-item">
                        <a class="nav-link active" id="album-tab-all" data-bs-toggle="tab" href="#album-all" role="tab">
                            All Albums
                        </a>
                    </li>

                    @foreach($albums as $index => $album)
                        <li class="nav-item">
                            <a class="nav-link" id="album-tab-{{ $album->id }}" data-bs-toggle="tab" href="#album-{{ $album->id }}" role="tab">
                                {{ $album->album_title_en ?? 'Untitled Album' }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3">
                    <!-- All Albums Tab Pane -->
                    <div class="tab-pane fade show active" id="album-all" role="tabpanel">
                        <div class="row">
                            @forelse($albums->flatMap->photos as $photo)
                                <div class="col-md-3 mb-4">
                                    <div class="card">
                                        @if($photo->album_images)
                                            <img src="{{ asset('storage/' . $photo->album_images) }}" class="gallery-image card-img-top" alt="Photo">
                                        @else
                                            <div class="card-body text-center text-muted">No image</div>
                                        @endif
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="{{ route('admin.photos.edit', $photo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Delete this photo?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center text-muted">
                                    No photos available.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Individual Album Tabs -->
                    @foreach($albums as $index => $album)
                        <div class="tab-pane fade" id="album-{{ $album->id }}" role="tabpanel">
                            <div class="row">
                                @forelse($album->photos as $photo)
                                    <div class="col-md-3 mb-4">
                                        <div class="card">
                                            @if($photo->album_images)
                                                <img src="{{ asset('storage/' . $photo->album_images) }}" class="gallery-image card-img-top" alt="Photo">
                                            @else
                                                <div class="card-body text-center text-muted">No image</div>
                                            @endif
                                            <div class="card-footer d-flex justify-content-between">
                                                <a href="{{ route('admin.photos.edit', $photo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('admin.photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Delete this photo?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted">
                                        No photos in this album.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
