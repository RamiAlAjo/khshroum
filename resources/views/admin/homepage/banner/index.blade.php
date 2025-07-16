@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-3">
            <div class="card-body">

                @if(session('status-success'))
                    <div class="alert alert-success">{{ session('status-success') }}</div>
                @endif
                @if(session('status-error'))
                    <div class="alert alert-danger">{{ session('status-error') }}</div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title pt-2">Banners</h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>

                <!-- Language Tabs -->
                <ul class="nav nav-tabs mt-3" id="languageTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="en-tab" data-bs-toggle="tab" href="#en" role="tab" aria-selected="true">English</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ar-tab" data-bs-toggle="tab" href="#ar" role="tab" aria-selected="false">Arabic</a>
                    </li>
                </ul>

                <div class="tab-content" id="languageTabsContent">
                    <!-- English Tab -->
                    <div class="tab-pane fade show active" id="en" role="tabpanel">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Position</th>
                                        <th>Description (EN)</th>
                                        <th>Button Label (EN)</th>
                                        <th>Image</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->id }}</td>
                                            <td>{{ $banner->position }}</td>
                                            <td>{!! Str::limit(strip_tags($banner->description_en), 80) !!}</td>
                                            <td>{{ $banner->button_label_en }}</td>
                                            <td>
                                                @if($banner->image)
                                                    <img src="{{ asset($banner->image) }}" alt="Banner" width="100">
                                                @endif
                                            </td>
                                            <td><a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a></td>
                                            <td>
                                                @if($banner->status == 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @elseif($banner->status == 'inactive')
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this banner?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center">No banners found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Arabic Tab -->
                    <div class="tab-pane fade" id="ar" role="tabpanel">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>مكان الصورة</th>
                                        <th>الوصف</th>
                                        <th>تسمية الزر</th>
                                        <th>الصورة</th>
                                        <th>الرابط</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->id }}</td>
                                            <td>{{ $banner->position }}</td>
                                            <td>{!! Str::limit(strip_tags($banner->description_ar), 80) !!}</td>
                                            <td>{{ $banner->button_label_ar }}</td>
                                            <td>
                                                @if($banner->image)
                                                    <img src="{{ asset($banner->image) }}" alt="Banner" width="100">
                                                @endif
                                            </td>
                                            <td><a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a></td>
                                            <td>
                                                @if($banner->status == 'active')
                                                    <span class="badge bg-success">مفعل</span>
                                                @elseif($banner->status == 'inactive')
                                                    <span class="badge bg-secondary">غير مفعل</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">قيد الانتظار</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-sm btn-info">تعديل</a>
                                                <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا البانر؟')">حذف</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center">لا توجد بانرات.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- End tab content -->

            </div>
        </div>
    </div>
</div>
@endsection
