@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="card-title pt-2 text-dark font-weight-bold">Edit Team Member</h5>

                <form action="{{ route('admin.team.update', $teamMember->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Language Tabs -->
                    <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-en" data-bs-toggle="tab" href="#lang-en" role="tab">English</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-ar" data-bs-toggle="tab" href="#lang-ar" role="tab">Arabic</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="langTabsContent">
                        <!-- English Tab -->
                        <div class="tab-pane fade show active" id="lang-en" role="tabpanel">
                            <div class="form-group">
                                <label for="name_en">Name (English)</label>
                                <input type="text" class="form-control shadow-sm" name="name_en" id="name_en" value="{{ old('name_en', $teamMember->name_en) }}">
                                @error('name_en')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Arabic Tab -->
                        <div class="tab-pane fade" id="lang-ar" role="tabpanel">
                            <div class="form-group">
                                <label for="name_ar" class="float-end">الاسم (Arabic)</label>
                                <input type="text" class="form-control shadow-sm text-end" name="name_ar" id="name_ar" value="{{ old('name_ar', $teamMember->name_ar) }}">
                                @error('name_ar')
                                    <div class="alert alert-danger mt-2 text-end">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Current Image -->
                    <div class="form-group mt-4">
                        <label>Current Photo</label><br>
                        <img src="{{ asset('storage/' . $teamMember->image) }}" alt="Team Member" width="100" class="rounded mb-2">
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="image">Replace Photo</label>
                        <input type="file" class="form-control shadow-sm" name="image" id="image" accept="image/*">
                        @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-dark rounded-pill shadow-sm">Update</button>
                        <a href="{{ route('admin.team.index') }}" class="btn btn-light rounded-pill shadow-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
