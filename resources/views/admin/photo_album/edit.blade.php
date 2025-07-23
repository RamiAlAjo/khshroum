@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 col-6">
                                <h5 class="card-title pt-2">Edit Photo Album</h5>
                            </div>
                            <div class="col-md-6 col-6 text-right">
                                <a href="{{ route('admin.photo-album.index') }}" class="btn btn-secondary">Back to Albums</a>
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

                        <form action="{{ route('admin.photo-album.update', $album->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Language Tabs -->
                            <ul class="nav nav-tabs mb-3" id="languageTabs" role="tablist">
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
                                    <div class="form-group">
                                        <label for="album_title_en">Album Title (EN)</label>
                                        <input type="text" class="form-control" id="album_title_en" name="album_title_en" value="{{ old('album_title_en', $album->album_title_en) }}" required>
                                    </div>
                                </div>

                                <!-- Arabic Tab -->
                                <div class="tab-pane fade" id="ar" role="tabpanel" aria-labelledby="ar-tab">
                                    <div class="form-group">
                                        <label for="album_title_ar">Album Title (AR)</label>
                                        <input type="text" class="form-control" id="album_title_ar" name="album_title_ar" value="{{ old('album_title_ar', $album->album_title_ar) }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Existing Cover Image -->
                            <div class="form-group mt-3">
                                <label>Current Album Cover:</label><br>
                                @if($album->album_cover)
                                    <img src="{{ asset('storage/' . $album->album_cover) }}" width="120" height="120" alt="Current cover" class="mb-2">
                                @else
                                    <p>No cover uploaded</p>
                                @endif
                            </div>

                            <!-- Upload New Cover -->
                            <div class="form-group">
                                <label for="album_cover">Change Album Cover</label>
                                <input type="file" class="form-control-file" id="album_cover" name="album_cover">
                                <small class="form-text text-muted">Leave empty if you don't want to change the cover.</small>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Update Album</button>
                            </div>
                        </form>

                    </div> <!-- card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

