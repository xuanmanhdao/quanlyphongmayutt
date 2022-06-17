<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Xác minh mật khẩu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style">

</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center text-lg-left">
                        <a class="logo-dark">
                            <span><img src="{{ asset('images/logo-utt-border.png') }}" alt="" height="60"></span>
                        </a>
                        <a href="index.html" class="logo-light">
                            <span><img src="{{ asset('images/logo-utt-border.png') }}" alt="" height="60"></span>
                        </a>
                    </div>

                    <!-- title-->
                    <br>
                    <div class="text-center w-75 m-auto">
                        <img src="{{ asset('images/Lock_PD.png') }}" height="64" alt="user-image" class="rounded-circle shadow">
                        <h4 class="text-dark-50 text-center mt-3 font-weight-bold">Xin chào! </h4>
                        <p class="text-muted mb-4">Xác minh mật khẩu hiện tại của bạn.</p>
                    </div>

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <!-- form -->
                    <form action="{{ route('duyet_doi_mat_khau') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="matKhau">Mật khẩu hiện tại</label>
                            <input name="MatKhau" class="form-control" type="password" id="matKhau" required=""
                                placeholder="Nhập mật khẩu hiện tại của bạn">
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-lock-reset"></i>
                                Xác minh</button>
                        </div>

                    </form>
                    <!-- end form-->

                    <footer class="footer footer-alt">
                        <p class="text-muted">Trở về <a href="{{ route('dangnhap') }}"
                                class="text-muted ml-1"><b>Đăng Nhập</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">Đại học Công Nghệ Giao Thông Vận Tải!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> Đoàn kết - Trí tuệ - Đổi mới - Hội
                    nhập - Phát triển bền vững. <i class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    - Admin
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>

</body>

</html>
