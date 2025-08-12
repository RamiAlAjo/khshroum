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

                <h5 class="card-title">Add New Team Member</h5>

                <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="name_en" class="form-label">Team Member Name (EN)</label>
                                <input type="text" class="form-control" name="name_en" id="name_en" value="{{ old('name_en') }}" required>
                            </div>
                        </div>

                        <!-- Arabic Tab -->
                        <div class="tab-pane fade pt-3" id="ar" role="tabpanel" aria-labelledby="ar-tab">
                            <div class="mb-3">
                                <label for="name_ar" class="form-label">اسم الفريق (AR)</label>
                                <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{ old('name_ar') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Common Fields -->
                    <div class="mb-3 mt-4">
                        <label for="image" class="form-label">Image (required)</label>
                        <input type="file" class="form-control" name="image" id="image" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
