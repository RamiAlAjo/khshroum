@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-body">

                        <!-- Message Handling -->
                        @if(session('status-success'))
                            <div class="alert alert-success">
                                {{ session('status-success') }}
                            </div>
                        @endif

                        @if(session('status-error'))
                            <div class="alert alert-danger">
                                {{ session('status-error') }}
                            </div>
                        @endif


                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title pt-2">Photo Albums</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('admin.photo-album.create') }}" class="btn btn-primary">Add New</a>
                            </div>
                        </div>

                        <!-- Tabs for language switching -->
                        <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="en-tab" data-bs-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="true">English</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="ar-tab" data-bs-toggle="tab" href="#ar" role="tab" aria-controls="ar" aria-selected="false">Arabic</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="languageTabsContent">
                            <!-- English Tab -->
                            <div class="tab-pane fade show active" id="en" role="tabpanel" aria-labelledby="en-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Album Title (EN)</th>
                                                <th>Cover</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($albums as $album)
                                                <tr>
                                                    <td>{{ $album->id }}</td>
                                                    <td>{{ $album->album_title_en }}</td>
                                                    <td>
                                                        @if($album->album_cover)
                                                            <img src="{{ asset('storage/' . $album->album_cover) }}" width="80" height="80" alt="{{ $album->album_title_en }}">
                                                        @else
                                                            No cover
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info" href="{{ route('admin.photo-album.edit', $album->id) }}">Edit</a>
                                                        <form action="{{ route('admin.photo-album.destroy', $album->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $album->id }}">Delete</button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="deleteModal{{ $album->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Delete Confirmation</h5>
                                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are you sure you want to delete "{{ $album->album_title_en }}"?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No albums found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Arabic Tab -->
                            <div class="tab-pane fade" id="ar" role="tabpanel" aria-labelledby="ar-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Album Title (AR)</th>
                                                <th>Cover</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($albums as $album)
                                                <tr>
                                                    <td>{{ $album->id }}</td>
                                                    <td>{{ $album->album_title_ar }}</td>
                                                    <td>
                                                        @if($album->album_cover)
                                                            <img src="{{ asset('storage/' . $album->album_cover) }}" width="80" height="80" alt="{{ $album->album_title_ar }}">
                                                        @else
                                                            No cover
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info" href="{{ route('admin.photo-album.edit', $album->id) }}">Edit</a>
                                                        <form action="{{ route('admin.photo-album.destroy', $album->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $album->id }}">Delete</button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="deleteModal{{ $album->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Delete Confirmation</h5>
                                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are you sure you want to delete "{{ $album->album_title_ar }}"?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No albums found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- tab content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
