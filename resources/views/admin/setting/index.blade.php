@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="card-title pt-2 text-dark font-weight-bold">Settings</h5>

                <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session('status-success'))
                    <div class="alert alert-success">
                        {{ session('status-success') }}
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="title" class="form-label">Website Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $settings->title ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Website Logo</label>
                        <input type="file" name="logo" class="form-control">
                        @if (!empty($settings->logo))
                            <div class="mt-2">
                                <p>Current Logo:</p>
                                <img src="{{ asset($settings->logo) }}" class="img-thumbnail" alt="Logo" width="150" height="150">
                            </div>
                            <div class="mt-2">
                                <input type="checkbox" name="remove_logo" value="1"> Remove Logo
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="contact_email" class="form-label">Contact Email</label>
                        <input type="email" class="form-control" name="contact_email" id="contact_email" value="{{ $settings->contact_email ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="carrers_email" class="form-label">Careers Email</label>
                        <input type="email" class="form-control" name="carrers_email" id="carrers_email" value="{{ $settings->carrers_email ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="key_words" class="form-label">Meta Keywords</label>
                        <textarea class="form-control" name="key_words" id="key_words" rows="3">{{ $settings->key_words ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="facebook" class="form-label">Facebook Link</label>
                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{ $settings->facebook ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="watsapp" class="form-label">Whatsapp Link</label>
                        <input type="text" class="form-control" name="watsapp" id="watsapp" value="{{ $settings->watsapp ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="youtube" class="form-label">YouTube Link</label>
                        <input type="text" class="form-control" name="youtube" id="youtube" value="{{ $settings->youtube ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone1" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone[]" id="phone1" value="{{ $phones[0] ?? '' }}">
                    </div>

                    <div id="additional-phones">
                        @foreach($phones as $index => $phone)
                            @if ($index > 0)
                            <div class="mb-3" id="phone{{ $index + 1 }}-container">
                                <label for="phone{{ $index + 1 }}" class="form-label">Phone {{ $index + 1 }}</label>
                                <input type="text" class="form-control" name="phone[]" id="phone{{ $index + 1 }}" value="{{ $phone }}">
                                <button type="button" class="btn btn-danger btn-sm mt-1" onclick="removePhoneField({{ $index + 1 }})">Remove</button>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-secondary btn-sm" id="add-phone-btn">Add Another Phone Number</button>

                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Admin Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ $settings->email ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address" value="{{ $settings->address ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location URL</label>
                        <input type="text" class="form-control" name="location" id="location" value="{{ $settings->location ?? '' }}">
                    </div>

                    <!-- Map Rendering Section -->
                    <div id="admin-map" style="width: 100%; height: 200px; margin-top: 10px;"></div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                        <a href="#" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let phoneCount = {{ count($phones) }};
        const maxPhones = 3;

        document.getElementById("add-phone-btn").addEventListener("click", function () {
            if (phoneCount < maxPhones) {
                phoneCount++;

                let phoneFieldHTML = `
                    <div class="mb-3" id="phone${phoneCount}-container">
                        <label for="phone${phoneCount}" class="form-label">Phone ${phoneCount}</label>
                        <input type="text" class="form-control" name="phone[]" id="phone${phoneCount}" placeholder="Phone Number">
                        <button type="button" class="btn btn-danger btn-sm mt-1" onclick="removePhoneField(${phoneCount})">Remove</button>
                    </div>
                `;

                document.getElementById("additional-phones").insertAdjacentHTML('beforeend', phoneFieldHTML);
            } else {
                alert('You can add a maximum of 3 phone numbers.');
            }
        });
    });

    function removePhoneField(phoneIndex) {
        const phoneField = document.getElementById(`phone${phoneIndex}-container`);
        if (phoneField) phoneField.remove();
    }
</script>



                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var locationInput = document.getElementById('location');
                            var map = L.map('admin-map').setView([51.505, -0.09], 13);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; OpenStreetMap contributors'
                            }).addTo(map);

                            var marker;

                            function updateMap() {
                                var url = locationInput.value;
                                var regex = /@(-?\d+\.\d+),(-?\d+\.\d+)/;
                                var matches = url.match(regex);
                                if (matches && matches.length >= 3) {
                                    var coords = [parseFloat(matches[1]), parseFloat(matches[2])];
                                    map.setView(coords, 15);
                                    if (marker) {
                                        marker.setLatLng(coords);
                                    } else {
                                        marker = L.marker(coords).addTo(map);
                                    }
                                }
                            }

                            locationInput.addEventListener('input', updateMap);
                            updateMap(); // Initialize on page load
                        });

                    </script>

