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

                <h5 class="card-title">Add New Service</h5>

                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                                <input type="text" class="form-control" name="name_en" id="name_en" value="{{ old('name_en') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description_en" class="form-label">Description (EN)</label>
                                <textarea class="form-control" name="description_en" id="description_en" rows="4">{{ old('description_en') }}</textarea>
                            </div>
                        </div>

                        <!-- Arabic Tab -->
                        <div class="tab-pane fade pt-3" id="ar" role="tabpanel" aria-labelledby="ar-tab">
                            <div class="mb-3">
                                <label for="name_ar" class="form-label">اسم الخدمة</label>
                                <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{ old('name_ar') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description_ar" class="form-label">الوصف</label>
                                <textarea class="form-control" name="description_ar" id="description_ar" rows="4">{{ old('description_ar') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Common Fields -->
                    <div class="mb-3 mt-4">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image (optional)</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon (optional)</label>
                        <input type="file" class="form-control" name="icon" id="icon">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
