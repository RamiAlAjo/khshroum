
@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xl-6 offset-xl-3">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Add New Video</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.videos.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title_en">Title (EN)</label>
                        <input type="text" class="form-control" name="title_en" value="{{ old('title_en') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="title_ar">Title (AR)</label>
                        <input type="text" class="form-control" name="title_ar" value="{{ old('title_ar') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="video_url">Video URL</label>
                        <input type="url" class="form-control" name="video_url" value="{{ old('video_url') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Video</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
