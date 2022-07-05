<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title ?? 'Aplikasi Jual Beli' }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }} " rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }} " rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.layouts.component.sidebare')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    @include('admin.layouts.component.header')
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
            <ul style="display: none">
                @foreach ($errors->all() as $error)
                    <li class="text-error">{{ $error .'<br>' }}</li>
                @endforeach
            </ul>

            @if(session()->has('success'))
                <div class="" style="display: none">
                    <p class="text_succes">{{ session()->get('success') }}</p>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="" style="display: none">
                    <p class="text_error_fc">{{ session()->get('error') }}</p>
                </div>
            @endif
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('admin.layouts.component.modal_logout')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }} "></script>
    <script src="{{ asset('js/blockUI.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }} "></script>

    <!-- Custom scripts for all pages-->
    @stack('js')
    <script src="{{ asset('js/sb-admin-2.min.js') }}  "></script>
    <script src="{{ asset('js/custom_datatable.js') }}  "></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let text_error = $('.text-error').text();
        if(text_error != ''){
            Swal.fire({
            icon: 'error',
            title: 'Error',
            html: text_error,
            })
        }
        let text_success = $('.text_succes').text();
        if(text_success != ''){
            Swal.fire({
            icon: 'success',
            title: 'Success',
            html: text_success,
            })
        }

        let text_error_from_controller = $('.text_error_fc').text();
        if(text_error_from_controller != ''){
            Swal.fire({
            icon: 'error',
            title: 'Error',
            html: text_error_from_controller,
            })
        }
    </script>
</body>

</html>
