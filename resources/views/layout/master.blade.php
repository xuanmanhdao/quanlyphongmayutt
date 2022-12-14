<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $tieuDe }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Quản lý lịch phòng máy thực hành UTT" name="description" />
    {{-- <meta content="Coderthemes" name="author" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    {{-- <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}
    <link rel="shortcut icon" href="{{ asset('images/logo-utt-border.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-utt-border.png') }}">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    @stack('css')
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        @include('layout.sidebarleft')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                @include('layout.topbar')
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    @include('layout.startpagetitle')
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">

                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif

                            @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif


                            <div class="card">
                                <div class="card-body">
                                    {{-- start page content --}}
                                    {{-- @include('layout.tableForm') --}}
                                    @yield('contentPage')
                                    {{-- end page content --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            @include('layout.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    {{-- <div class="right-bar"></div>

    <div class="rightbar-overlay"></div> --}}
    <!-- /Right-bar -->

    {{-- JQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>

    @stack('js')

</body>

</html>
