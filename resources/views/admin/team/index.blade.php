@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-body">
                        <!-- Flash messages -->
                        @if(session('status-success'))
                            <div class="alert alert-success">{{ session('status-success') }}</div>
                        @endif

                        @if(session('status-error'))
                            <div class="alert alert-danger">{{ session('status-error') }}</div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title pt-2">Team members</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('admin.team.create') }}" class="btn btn-primary">Add New</a>
                            </div>
                        </div>

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
                            <div class="tab-pane fade show active" id="en" role="tabpanel" aria-labelledby="en-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name (EN)</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($teamMembers as $member)
                                                <tr>
                                                    <td>{{ $member->id }}</td>
                                                    <td><img src="{{ asset('storage/' . $member->image) }}" alt="Team Image" width="80" class="rounded"></td>
                                                    <td>{{ $member->name_en }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info" href="{{ route('admin.team.edit', $member->id) }}">Edit</a>
                                                        <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" style="display:inline;">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No team members found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Arabic Tab -->
                            <div class="tab-pane fade" id="ar" role="tabpanel" aria-labelledby="ar-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name (AR)</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($teamMembers as $member)
                                                <tr>
                                                    <td>{{ $member->id }}</td>
                                                    <td><img src="{{ asset('storage/' . $member->image) }}" alt="Team Image" width="80" class="rounded"></td>
                                                    <td>{{ $member->name_ar }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info" href="{{ route('admin.team.edit', $member->id) }}">Edit</a>
                                                        <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" style="display:inline;">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No team members found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
