@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-3">
            <div class="card-body">

                @if(session('status-success'))
                    <div class="alert alert-success">{{ session('status-success') }}</div>
                @endif

                <h5 class="card-title">Add New Banner</h5>

                <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Language Tabs -->
                    <ul class="nav nav-tabs mt-3" id="languageTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="en-tab" data-bs-toggle="tab" href="#en" role="tab">English</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ar-tab" data-bs-toggle="tab" href="#ar" role="tab">Arabic</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3">
                        <!-- English -->
                        <div class="tab-pane fade show active" id="en" role="tabpanel">
                            <div class="mb-3">
                                <label for="description_en" class="form-label">Description (EN)</label>
                                <textarea class="form-control text-editor-desc" name="description_en" id="description_en" rows="4">{{ old('description_en') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="button_label_en" class="form-label">Button Label (EN)</label>
                                <input type="text" class="form-control" name="button_label_en" value="{{ old('button_label_en') }}">
                            </div>
                        </div>

                        <!-- Arabic -->
                        <div class="tab-pane fade" id="ar" role="tabpanel">
                            <div class="mb-3">
                                <label for="description_ar" class="form-label">الوصف</label>
                                <textarea class="form-control text-editor-desc" name="description_ar" id="description_ar" rows="4">{{ old('description_ar') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="button_label_ar" class="form-label">تسمية الزر</label>
                                <input type="text" class="form-control" name="button_label_ar" value="{{ old('button_label_ar') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Common -->
                    <div class="mb-3">
                        <label for="url" class="form-label">Button URL</label>
                        <input type="url" class="form-control" name="url" value="{{ old('url') }}">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="position">Banner Position</label>
                        <select name="position" class="form-control" required>
                            <option value="top">Top</option>
                            <option value="middle">Middle</option>
                            <option value="bottom">Bottom</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
