@extends('layout.master')
@push('css')
    <style>
        .card-text-tu-tao {}

        .flex-card-tu-tao {
            /* flex: 1;
                                        border: solid; */
            /* flex: 1 1 25%; */

        }

        .flex-container-tu-tao {
            /* display: flex;
                                        margin-right: -12px;
                                        margin-left: -12px; */
        }
    </style>
    {{-- Start Modal CSS --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .modal-confirm {
            color: #636363;
            width: 400px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }

        .modal-confirm .modal-body {
            color: #999;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
            display: flex !important;
            flex-wrap: wrap;
        }

        .modal-confirm .modal-footer a {
            /* color: #999; */
            color: aliceblue;
        }

        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            /* border: 3px solid #f15e5e; */
            border: 3px solid #e2951a;
        }

        .modal-confirm .icon-box i {
            /* color: #f15e5e; */
            color: #e2951a;
            font-size: 46px;
            display: inline-block;
            /* margin-top: 13px; */
            margin: 0 auto;
            text-align: center;
        }

        .modal-confirm .btn,
        .modal-confirm .btn:active {
            /* color: #fff;
                            border-radius: 4px;
                            background: #60c7c1;
                            text-decoration: none;
                            transition: all 0.4s;
                            line-height: normal;
                            min-width: 120px;
                            border: none;
                            min-height: 40px;
                            border-radius: 3px;
                            margin: 0 5px; */
            min-width: 120px;
        }

        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }

        .modal-confirm .btn-secondary:hover,
        .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }

        .modal-confirm .btn-danger {
            background: #f15e5e;
        }

        .modal-confirm .btn-danger:hover,
        .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }

        .ti-le-item-flex {
            flex: 1 1 25%;
        }
    </style>
    {{-- End Modal CSS --}}
@endpush
@section('contentPage')
    <!-- Start Modal HTML -->

    {{-- Start Modal Item 1 --}}
    <div id="myModal" class="modal">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        {{-- <i class="uil-envelope-question"></i> --}}
                        <i class="uil-envelope-question"></i>
                    </div>
                    <h4 class="modal-title w-100">Chọn phương thức liên hệ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có thể liên hệ theo những cách thức sau</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary ti-le-item-flex" data-dismiss="modal">Hủy
                        bỏ</button>
                    <a href="mailto:xuanmanhdao2001@gmail.com?subject=Li%C3%AAn%20h%E1%BB%87%20t%E1%BB%AB%20website%20%C4%91%C4%83ng%20k%C3%BD%20ph%C3%B2ng%20m%C3%A1y%20UTT"
                        target="_blank" rel="noopener noreferrer" class="btn btn-success ti-le-item-flex">Gửi
                        email</a>
                    <a href="tel:0123456789" class="btn btn-info ti-le-item-flex">Gọi điện</a>
                    <a href="https://www.facebook.com/daoxuanmanh2001" target="_blank" rel="noopener noreferrer"
                        class="btn btn-primary ti-le-item-flex">Facebook</a>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Item 1 --}}

    {{-- Start Modal Item 2 --}}
    <div id="myModal2" class="modal">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="uil-envelope-question"></i>
                    </div>
                    <h4 class="modal-title w-100">Chọn phương thức liên hệ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có thể liên hệ theo những cách thức sau</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary ti-le-item-flex" data-dismiss="modal">Hủy
                        bỏ</button>
                    <a href="mailto:phamngochue1207@gmail.com?subject=Li%C3%AAn%20h%E1%BB%87%20t%E1%BB%AB%20website%20%C4%91%C4%83ng%20k%C3%BD%20ph%C3%B2ng%20m%C3%A1y%20UTT"
                        target="_blank" rel="noopener noreferrer" class="btn btn-success ti-le-item-flex">Gửi
                        email</a>
                    <a href="tel:0123456789" class="btn btn-info ti-le-item-flex">Gọi điện</a>
                    <a href="https://www.facebook.com/hueanh1225" target="_blank" rel="noopener noreferrer"
                        class="btn btn-primary ti-le-item-flex">Facebook</a>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Item 2 --}}

    {{-- Start Modal Item 3 --}}
    <div id="myModal3" class="modal">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="uil-envelope-question"></i>
                    </div>
                    <h4 class="modal-title w-100">Chọn phương thức liên hệ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có thể liên hệ theo những cách thức sau</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary ti-le-item-flex" data-dismiss="modal">Hủy
                        bỏ</button>
                    <a href="mailto:nmd.leo2001@gmail.com?subject=Li%C3%AAn%20h%E1%BB%87%20t%E1%BB%AB%20website%20%C4%91%C4%83ng%20k%C3%BD%20ph%C3%B2ng%20m%C3%A1y%20UTT"
                        target="_blank" rel="noopener noreferrer" class="btn btn-success ti-le-item-flex">Gửi
                        email</a>
                    <a href="tel:0123456789" class="btn btn-info ti-le-item-flex">Gọi điện</a>
                    <a href="https://www.facebook.com/pi.bapon" target="_blank" rel="noopener noreferrer"
                        class="btn btn-primary ti-le-item-flex">Facebook</a>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Item 3 --}}

    {{-- Start Modal Item 4 --}}
    <div id="myModal4" class="modal">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="uil-envelope-question"></i>
                    </div>
                    <h4 class="modal-title w-100">Chọn phương thức liên hệ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có thể liên hệ theo những cách thức sau</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary ti-le-item-flex" data-dismiss="modal">Hủy
                        bỏ</button>
                    <a href="mailto:quynhanh257@gmail.com?subject=Li%C3%AAn%20h%E1%BB%87%20t%E1%BB%AB%20website%20%C4%91%C4%83ng%20k%C3%BD%20ph%C3%B2ng%20m%C3%A1y%20UTT"
                        target="_blank" rel="noopener noreferrer" class="btn btn-success ti-le-item-flex">Gửi
                        email</a>
                    <a href="tel:0123456789" class="btn btn-info ti-le-item-flex">Gọi điện</a>
                    <a href="https://www.facebook.com/profile.php?id=100009583601753" target="_blank"
                        rel="noopener noreferrer" class="btn btn-primary ti-le-item-flex">Facebook</a>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Item 4 --}}

    {{-- End Modal HTML --}}
    <div class="row">
        <div class="col-md-6 col-lg-3 flex-card-tu-tao">
            <!-- Simple card -->
            <div class="card d-block">
                <img class="card-img-top" src="{{ asset('images/avatar-nam-trang.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Vai trò: Lập trình viên website (Web Developer)</h5>
                    <p class="card-text">Họ tên: Đào Xuân Mạnh</p>
                    <button type="button" class="btn btn-primary action-icon" data-toggle="modal"
                        data-target="#myModal">Liên hệ</button>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <div class="col-md-6 col-lg-3 flex-card-tu-tao">
            <!-- Simple card -->
            <div class="card d-block">
                <img class="card-img-top" src="{{ asset('images/avatar-nam-trang.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Vai trò: Lập trình viên mobile (Mobile Developer)</h5>
                    <p class="card-text">Họ tên: Phạm Ngọc Huế</p>
                    <button type="button" class="btn btn-primary action-icon" data-toggle="modal"
                        data-target="#myModal2">Liên hệ</button>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <div class="col-md-6 col-lg-3 flex-card-tu-tao">
            <!-- Simple card -->
            <div class="card d-block">
                <img class="card-img-top" src="{{ asset('images/avatar-nam-trang.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Vai trò: Lập trình viên mobile (Mobile Developer)</h5>
                    <p class="card-text">Họ tên: Nguyễn Minh Đức</p>
                    <button type="button" class="btn btn-primary action-icon" data-toggle="modal"
                        data-target="#myModal3">Liên hệ</button>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>

        <div class="col-md-6 col-lg-3 flex-card-tu-tao">
            <!-- Simple card -->
            <div class="card d-block">
                <img class="card-img-top" src="{{ asset('images/avatar-nu-trang.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Vai trò: Chuyên viên phân tích nghiệp vụ (BA)</h5>
                    <p class="card-text">Họ tên: Đặng Thị Quỳnh Anh</p>
                    <button type="button" class="btn btn-primary action-icon" data-toggle="modal"
                        data-target="#myModal4">Liên hệ</button>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div>
@endsection
@push('js')
    <script language="javascript" type="text/javascript">
        // document.getElementById("divMainContent").setAttribute("height",document.getElementById("divSideBar").clientHeight);
        // document.getElementById("divMainContent").style.height=document.getElementById("divSideBar").clientHeight;
    </script>
@endpush
