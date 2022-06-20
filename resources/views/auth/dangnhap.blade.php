<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Đăng nhập</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo-utt-border.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-utt-border.png') }}">

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
                            <span><img src="{{ asset('images/logo-utt-border.png') }}" alt=""
                                    height="60"></span>
                        </a>
                        <a href="index.html" class="logo-light">
                            <span><img src="{{ asset('images/logo-utt-border.png') }}" alt=""
                                    height="60"></span>
                        </a>
                    </div>

                    <!-- title-->
                    <br>
                    <h4 class="mt-4">ĐĂNG NHẬP</h4>
                    <p class="text-muted mb-4">Nhập mã giảng viên và mật khẩu của bạn để truy cập tài khoản.</p>

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                        {{-- {{ session()->flush() }} --}}
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        {{-- {{ session()->flush() }} --}}
                    @endif
                    <!-- form -->
                    <form action="{{ route('duyet_dang_nhap') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="magiangvien">Mã giảng viên</label>
                            <input name="MaGiangVien" class="form-control" type="text" id="magiangvien"
                                required="" placeholder="Nhập mã giảng viên của bạn">
                        </div>
                        <div class="form-group">
                            {{-- <a href="{{ route('quenmatkhau') }}" class="text-muted float-right">
                                <small>Bạn quên mật khẩu?</small></a> --}}
                            <label for="password">Mật khẩu</label>
                            <input name="MatKhau" class="form-control" type="password" required="" id="password"
                                placeholder="Nhập mật khẩu của bạn">
                        </div>
                        {{-- <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                <label class="custom-control-label" for="checkbox-signin">Lưu tài khoản</label>
                            </div>
                        </div> --}}
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-login"></i> Đăng
                                Nhập </button>
                        </div>

                    </form>
                    <!-- end form-->

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
