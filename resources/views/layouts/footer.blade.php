   {{-- <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="libs/jquery/jquery.js"></script>
    <script src="libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="libs/perfect-scrollbar/perfect-scrollbar.js"></script>


    <!-- endbuild -->
    
    <!-- Vendors JS -->
    <script src="assets/vendor/js/menu.js"></script>
    <script src="libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="js/main.js"></script>

    @yield('additionaljs')

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script> --}}

        <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="libs/jquery/jquery.js"></script>
    <script src="libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="js/config.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!-- Vendors JS -->
    <script src="libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="js/main.js"></script>

    <!-- Page JS -->
    @yield('additionaljs')

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>


