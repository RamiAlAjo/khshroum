@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xl-6 offset-xl-3">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Edit Video</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.videos.update', $video->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="title_en">Title (EN)</label>
                        <input type="text" class="form-control" name="title_en" value="{{ old('title_en', $video->title_en) }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="title_ar">Title (AR)</label>
                        <input type="text" class="form-control" name="title_ar" value="{{ old('title_ar', $video->title_ar) }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="video_url">Video URL</label>
                        <input type="url" class="form-control" name="video_url" value="{{ old('video_url', $video->video_url) }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Video</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
