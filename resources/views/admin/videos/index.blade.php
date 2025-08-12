@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-title pt-2">Videos List</h5>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">Add Video</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title (EN)</th>
                    <th>Title (AR)</th>
                    <th>Video</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $video->title_en }}</td>
                        <td>{{ $video->title_ar }}</td>
                        <td><a href="{{ $video->video_url }}" target="_blank">Watch</a></td>
                        <td>
                            <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $videos->links() }}
    </div>
</div>
@endsection
