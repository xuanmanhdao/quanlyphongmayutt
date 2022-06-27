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
@endpush
@section('contentPage')
    <div class="row">

        <div class="col-md-6 col-lg-3 flex-card-tu-tao">
            <!-- Simple card -->
            <div class="card d-block">
                <img class="card-img-top" src="{{ asset('images/avatar-nam-trang.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Vai trò: Lập trình viên website (Web Developer)</h5>
                    <p class="card-text">Họ tên: Đào Xuân Mạnh</p>
                    <p class="card-text">Email: xuanmanhdao2001@gmail.com</p>
                    <a href="https://www.facebook.com/daoxuanmanh2001" class="btn btn-primary">Liên hệ</a>
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
                    <p class="card-text">Email: phamngochue1207@gmail.com</p>
                    <a href="https://www.facebook.com/hueanh1225" class="btn btn-primary">Liên hệ</a>
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
                    <p class="card-text">Email: nmd.leo2001@gmail.com</p>
                    <a href="https://www.facebook.com/pi.bapon" class="btn btn-primary">Liên hệ</a>
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
                    <p class="card-text">Email: quynhanh257@gmail.com</p>
                    <a href="https://www.facebook.com/profile.php?id=100009583601753" class="btn btn-primary">Liên hệ</a>
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
    $("#two").height($("#one").height());
@endpush
