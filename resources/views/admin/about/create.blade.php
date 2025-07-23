@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="card-title pt-2 text-dark font-weight-bold">Create About Us</h5>

                <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Language + Image Tabs -->
                    <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-en" data-bs-toggle="tab" href="#lang-en" role="tab" aria-controls="lang-en" aria-selected="true">English</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-ar" data-bs-toggle="tab" href="#lang-ar" role="tab" aria-controls="lang-ar" aria-selected="false">Arabic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-image" data-bs-toggle="tab" href="#lang-image" role="tab" aria-controls="lang-image" aria-selected="false">Image</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="langTabsContent">
                        <!-- English Tab -->
                        <div class="tab-pane fade show active" id="lang-en" role="tabpanel" aria-labelledby="tab-en">
                            <div class="form-group">
                                <label for="about_us_title_en">Title (English)</label>
                                <input type="text" class="form-control shadow-sm" name="about_us_title_en" id="about_us_title_en" value="{{ old('about_us_title_en') }}">
                                @error('about_us_title_en')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="about_us_description_en">Description (English)</label>
                                <textarea class="form-control shadow-sm" name="about_us_description_en" id="about_us_description_en" rows="5">{{ old('about_us_description_en') }}</textarea>
                                @error('about_us_description_en')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Arabic Tab -->
                        <div class="tab-pane fade" id="lang-ar" role="tabpanel" aria-labelledby="tab-ar">
                            <div class="form-group">
                                <label for="about_us_title_ar" class="float-end">العنوان (Arabic)</label>
                                <input type="text" class="form-control shadow-sm text-end" name="about_us_title_ar" id="about_us_title_ar" value="{{ old('about_us_title_ar') }}">
                                @error('about_us_title_ar')
                                    <div class="alert alert-danger mt-2 text-end">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="about_us_description_ar" class="float-end">الوصف (Arabic)</label>
                                <textarea class="form-control shadow-sm text-end" name="about_us_description_ar" id="about_us_description_ar" rows="5">{{ old('about_us_description_ar') }}</textarea>
                                @error('about_us_description_ar')
                                    <div class="alert alert-danger mt-2 text-end">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Tab -->
                        <div class="tab-pane fade" id="lang-image" role="tabpanel" aria-labelledby="tab-image">
                            <div class="form-group">
                                <label for="about_us_image">Upload Image</label>
                                <input type="file" class="form-control shadow-sm" name="about_us_image" id="about_us_image" accept="image/*">
                                @error('about_us_image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-dark rounded-pill shadow-sm">Create</button>
                        <a href="{{ route('admin.about.index') }}" class="btn btn-light rounded-pill shadow-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
