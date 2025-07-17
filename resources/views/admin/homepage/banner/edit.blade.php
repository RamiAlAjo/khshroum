@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Edit Banner</h5>

                <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mt-3" id="languageTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="en-tab" data-bs-toggle="tab" href="#en" role="tab">English</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ar-tab" data-bs-toggle="tab" href="#ar" role="tab">Arabic</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3">
                        <!-- EN -->
                        <div class="tab-pane fade show active" id="en" role="tabpanel">
                            <div class="mb-3">
                                <label for="description_en">Description (EN)</label>
                                <textarea name="description_en" class="form-control text-editor-desc" rows="4">{{ old('description_en', $banner->description_en) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="button_label_en">Button Label (EN)</label>
                                <input type="text" name="button_label_en" class="form-control" value="{{ old('button_label_en', $banner->button_label_en) }}">
                            </div>
                        </div>

                        <!-- AR -->
                        <div class="tab-pane fade" id="ar" role="tabpanel">
                            <div class="mb-3">
                                <label for="description_ar">الوصف</label>
                                <textarea name="description_ar" class="form-control text-editor-desc" rows="4">{{ old('description_ar', $banner->description_ar) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="button_label_ar">تسمية الزر</label>
                                <input type="text" name="button_label_ar" class="form-control" value="{{ old('button_label_ar', $banner->button_label_ar) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="url">URL</label>
                        <input type="url" name="url" class="form-control" value="{{ old('url', $banner->url) }}">
                    </div>

                    <div class="mb-3">
                        <label for="image">Banner Image</label>
                        <input type="file" name="image" class="form-control">
                        @if($banner->image)
                            <img src="{{ asset($banner->image) }}" alt="Current Image" class="img-thumbnail mt-2" width="120">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="position">Banner Position</label>
                        <select name="position" class="form-control" required>
                            <option value="top" {{ old('position', $banner->position ?? '') == 'top' ? 'selected' : '' }}>Top</option>
                            <option value="middle" {{ old('position', $banner->position ?? '') == 'middle' ? 'selected' : '' }}>Middle</option>
                            <option value="bottom" {{ old('position', $banner->position ?? '') == 'bottom' ? 'selected' : '' }}>Bottom</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ old('status', $banner->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $banner->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
