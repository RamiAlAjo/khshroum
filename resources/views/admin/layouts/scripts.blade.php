<script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/plugins/simplebar/simplebar.min.js') }}"></script>
<script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
<script src="{{ asset('dist/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('dist/js/chart.js') }}"></script>
<script src="{{ asset('dist/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
<script src="{{ asset('dist/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
<script src="{{ asset('dist/plugins/jvectormap/jquery-jvectormap-us-aea.js') }}"></script>
<script src="{{ asset('dist/js/map.js') }}"></script>

<!-- Toastr for notifications -->
<script src="{{ asset('dist/plugins/toaster/toastr.min.js') }}"></script>

<!-- Custom Mono JS -->
<script src="{{ asset('dist/js/mono.js') }}"></script>

<!-- jQuery -->
<script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 5 Bundle (contains both Bootstrap JS and Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    function initSummernotes() {
        $('.text-editor-desc').summernote({
            height: 200
        });
    }

    $(document).ready(function () {
        initSummernotes();

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
            initSummernotes(); // Re-init if tab becomes visible
        });
    });
</script>
