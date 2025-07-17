@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-3">
            <div class="card-body">

                <!-- Flash messages -->
                @if(session('status-success'))
                    <div class="alert alert-success">{{ session('status-success') }}</div>
                @endif
                @if(session('status-error'))
                    <div class="alert alert-danger">{{ session('status-error') }}</div>
                @endif

                <h5 class="card-title">Edit Service</h5>

                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Language Tabs -->
                    <ul class="nav nav-tabs mt-3" id="languageTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="en-tab" data-bs-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="true">English</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ar-tab" data-bs-toggle="tab" href="#ar" role="tab" aria-controls="ar" aria-selected="false">Arabic</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="languageTabsContent">
                        <!-- English Tab -->
                        <div class="tab-pane fade show active pt-3" id="en" role="tabpanel" aria-labelledby="en-tab">
                            <div class="mb-3">
                                <label for="name_en" class="form-label">Service Name (EN)</label>
                                <input type="text" class="form-control" name="name_en" id="name_en" value="{{ old('name_en', $service->name_en) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description_en" class="form-label">Description (EN)</label>
                                <textarea class="form-control" name="description_en" id="description_en" rows="4">{{ old('description_en', $service->description_en) }}</textarea>
                            </div>
                        </div>

                        <!-- Arabic Tab -->
                        <div class="tab-pane fade pt-3" id="ar" role="tabpanel" aria-labelledby="ar-tab">
                            <div class="mb-3">
                                <label for="name_ar" class="form-label">اسم الخدمة</label>
                                <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{ old('name_ar', $service->name_ar) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description_ar" class="form-label">الوصف</label>
                                <textarea class="form-control" name="description_ar" id="description_ar" rows="4">{{ old('description_ar', $service->description_ar) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Common Fields -->
                    <div class="mb-3 mt-4">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $service->slug) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        @if($service->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $service->image) }}" alt="Service Image" width="150">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="image" id="image">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        @if($service->icon)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $service->icon) }}" alt="Service Icon" width="100">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="icon" id="icon">
                        <small class="text-muted">Leave empty to keep current icon</small>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" {{ old('status', $service->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $service->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending" {{ old('status', $service->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
