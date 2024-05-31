<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        @yield('title')
    </title>
    @include('components.head')

    @yield('custom styles')

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('components.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('components.topbar')

                @include('components.flash-message')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('components.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('components.scroll-to-top')

    @include('components.logout-modal')

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.js"></script>
    <script>
        function showAlert(color, title, message, icon) {
            akert = `<div id="${color}-alert" class="card border-bottom-${color} shadow h-5 py-2" style="position: absolute; right: 2%; bottom: 5%;z-index: 9999;">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-${color} text-uppercase mb-1">
                    ${title}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">${message}</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-solid ${icon} fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
        </div>`;

            function hideAlert() {
                const alert = document.getElementById(`${color}-alert`);
                alert.remove();
            }

            // Hide the alert after 3 seconds
            setTimeout(hideAlert, 3000);
            document.querySelector('#page-top').insertAdjacentHTML('beforeend', akert);
        }
    </script>
    @yield('custom scripts')
    @livewire('livewire-ui-modal')
    @livewireScripts
</body>

</html>

</body>
