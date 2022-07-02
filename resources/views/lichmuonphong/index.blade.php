@extends('layout.master')
@push('css')
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
        }

        .modal-confirm .modal-footer a {
            color: #999;
        }

        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }

        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }

        .modal-confirm .btn,
        .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
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
    </style>
    {{-- End Modal CSS --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.6/sb-1.3.3/sl-1.4.0/datatables.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .min-width-230px {
            min-width: 230px;
        }

        #TimKiemNhieuO {
            display: none;
        }

        .min-width-140px {
            min-width: 140px;
        }

        /* #btnTimKiemNhieuO:hover+#TimKiemNhieuO {
                                                                                                        display: block;
                                                                                                    } */
    </style>
@endpush
@section('contentPage')
    @if (kiemTraAdmin())
        <caption>
            <a class="btn btn-primary action-icon" href="{{ route('lichmuonphong.create') }}"><i
                    class="mdi mdi-calendar-plus text-white mr-2 mb-2"></i>Thêm lịch mượn phòng</a>
        </caption>
        <form style="display: inline-block;">
            <div class="form-group">
                <label class="btn btn-primary action-icon mb-0" for="btnImportExcel"><i
                        class="mdi mdi-file-compare text-white mr-2 mb-2"></i>Nhập file excel</label>
                <input type="file" id="btnImportExcel" class="form-control-file d-none"
                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            </div>
        </form>
    @endif

    <div id="btnTimKiemNhieuO" onclick="showStuff('TimKiemNhieuO');" class="float-right mb-2" tabindex="1">
        <input type="button" value="Tìm kiếm nhiều ô" class="btn btn-primary search-icon">
    </div>


    {{-- <div class="form-group mt-2">
        <select name="" id="select-tiet-hoc"></select>
    </div>
    <div class="form-group mt-2">
        <select name="" id="select-giang-vien"></select>
    </div>
    <div class="form-group mt-2">
        <select name="" id="select-ngay-muon"></select>
    </div> --}}


    <div id='TimKiemNhieuO' class="card form-group border border-dark rounded mt-4">
        <div class="card-header">
            <p class="text-center lead"><b>Tìm kiếm nhiều ô</b></p>
            <p class="text-warning"><i><b>Lưu ý: Kết quả tìm kiếm sẽ ưu tiên ô nhập cuối cùng</b></i></p>
        </div>
        <div class="card-body" style="display: flex; flex-wrap: wrap;">
            <div class="form-group mt-2" style="flex: 1 1 50%;">
                <label class="min-width-230px" for="select-tiet-hoc-LichMuonPhong">Tìm kiếm theo số tiết: </label>
                <select class="min-width-140px" name="" id="select-tiet-hoc-LichMuonPhong">
                    <option value="0">Tất cả tiết học</option>
                    @foreach ($arrLichMuonPhongSoTiet as $key => $value)
                        <option value="{{ $value }}">
                            {{ $key }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2" style="flex: 1 1 50%;">
                <label class="min-width-230px" for="select-giang-vien-LichMuonPhong">Tìm kiếm mã giảng viên: </label>
                <select class="min-width-140px" name="" id="select-giang-vien-LichMuonPhong">
                    <option value="0">Tất cả giảng viên</option>
                    @foreach ($arrGiangVien as $giangVien)
                        <option value="{{ $giangVien->MaGiangVien }}">
                            {{ $giangVien->MaGiangVien }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2" style="flex: 1 1 50%;">
                <label class="min-width-230px" for="select-phong-LichMuonPhong">Tìm kiếm phòng: </label>
                <select class="min-width-140px" name="" id="select-phong-LichMuonPhong">
                    <option value="0">Tất cả phòng</option>
                    @foreach ($arrPhong as $phong)
                        <option value="{{ $phong->MaPhong }}">
                            {{ $phong->MaPhong }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2" style="flex: 1 1 50%;">
                <label class="min-width-230px" for="select-ngay-muon-LichMuonPhong-1">Tìm kiếm theo ngày: </label>
                <input class="min-width-140px" id="select-ngay-muon-LichMuonPhong-1" type="date" name="date">
            </div>

            <!-- Predefined Date Ranges -->
            <div class="form-group mt-2" style="flex: 1 1 100%;">
                <label>Tìm kiếm theo khoảng thời gian:</label>
                <div id="reportrange" class="form-control" data-toggle="date-picker-range"
                    data-target-display="#selectedValue" data-cancel-class="btn-light">
                    <i class="mdi mdi-calendar"></i>&nbsp;
                    <span id="selectedValue" class="select-ngay-muon-LichMuonPhong-2"></span> <i
                        class="mdi mdi-menu-down"></i>
                </div>
            </div>

        </div>

    </div>


    <div class="table-responsive">
        <table class="table table-bordered table-centered mb-0 mt-2" id="users-table">
            <thead>
                {{-- <tr> --}}
                <tr>
                    <th>STT</th>
                    <th>Mã giảng viên</th>
                    <th>Tên giảng viên</th>
                    <th>Phòng</th>
                    <th>Ngày mượn</th>
                    <th>Tiết học</th>
                    <th>Ghi chú</th>
                    @if (kiemTraAdmin())
                        <th>Sửa</th>
                        <th>Xóa</th>
                    @endif
                </tr>
                {{-- </tr> --}}
            </thead>
        </table>
    </div>

    <!-- Start Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title w-100">Xác nhận xóa?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có thực sự muốn xóa các bản ghi này không? Không thể hoàn tác quá trình này.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="button" class="btn btn-danger" id="btn-delete-lich-muon-phong"
                        data-dismiss="modal">Xác
                        nhận xóa</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal HTML --}}
@endsection
@push('js')
    {{-- Start Modal JS --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> --}}
    {{-- End Modal JS --}}

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.6/sb-1.3.3/sl-1.4.0/datatables.min.js">
    </script>

    {{-- plugin select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script>$('#select-ngay-muon-LichMuonPhong').datepicker({ dateFormat: 'dd-mm-yy' }).val();</script> --}}
    {{-- <script>
        $("#select-ngay-muon-LichMuonPhong").datepicker({
            dateFormat: 'dd-mm-yyyy',
            changeMonth: true,
            changeYear: true
        });
    </script> --}}

    <script>
        $(function() {

            var buttonCommon = {
                exportOptions: {
                    columns: ':visible :not(.not-export)'
                }
            };


            let tableClassroom = $('#users-table').DataTable({
                order: [4, 'desc'],
                dom: 'Blfrtip',
                select: true,
                buttons: [
                    $.extend(true, {}, buttonCommon, {
                        extend: 'copyHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'csvHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'pdfHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'print'
                    }),
                    'colvis'
                ],

                columnDefs: [{
                    className: "not-export",
                    // "targets": [5, 6],
                    "targets": [7, 8],
                    // width: '20%', targets: 4

                    // Set default content
                    @if (kiemTraAdmin()==false)
                        "defaultContent": "-",
                        "targets": "7, 8"
                    @endif
                }],
                // responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('lichmuonphong.api_index') !!}',
                // autoWidth: false,
                columns: [
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'MaGiangVien',
                        name: 'MaGiangVien'
                    },
                    {
                        data: 'HoTen',
                        name: 'HoTen'
                    },
                    {
                        data: 'MaPhong',
                        name: 'MaPhong'
                    },
                    {
                        data: 'NgayMuon',
                        name: 'NgayMuon'
                    },
                    {
                        data: 'TietHoc',
                        name: 'TietHoc'
                    },
                    {
                        data: 'GhiChu',
                        name: 'GhiChu'

                    },
                    @if (kiemTraAdmin())
                        {
                            data: 'btnEdit',
                            target: 7,
                            orderable: false,
                            searchable: false,
                            render: function(data) {
                                return `<a href="${data}" class="action-icon"><i
                            class="mdi mdi-calendar-edit text-primary"></i></a>`;
                            }
                        }, {
                            data: 'btnDestroy',
                            target: 8,
                            orderable: false,
                            searchable: false,
                            render: function(data) {
                                return `<form action="${data}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-delete-classroom action-icon" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-calendar-remove text-danger"></i></button>
                    </form>`;
                            }
                        },
                    @endif
                ]
            });

            // Xử lý nút xóa
            var checkXacNhanXoaLich = true;
            var row;
            var form;
            $(document).on("click", ".btn-delete-classroom", function() {
                if (checkXacNhanXoaLich === false) {
                    return;
                }
                checkXacNhanXoaLich = false;
                row = $(this).parents('tr');
                form = $(this).parents('form');
            });

            $(document).on("click", "#btn-delete-lich-muon-phong", function() {
                console.log("Đã ấn vaafo btn-delete-lich-muon-phong");
                checkXacNhanXoaLich = true;
                if (checkXacNhanXoaLich === true) {
                    $.ajax({
                        // Cách lấy url trong form bằng cách lọc thuộc tính action
                        url: form.attr('action'),
                        type: 'POST',
                        dataType: 'json',
                        // tất cả những gì điền trong form sẽ truyền vào data bằng hàm serialize()
                        data: form.serialize(),
                        success: function() {
                            console.log("success haha");
                            // row.remove();
                            tableClassroom.draw();
                            $.toast({
                                heading: 'Xóa thành công',
                                text: 'Dữ liệu của bạn đã được xóa',
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'bottom-right',
                                hideAfter: 5000
                            })
                        },
                        error: function() {
                            console.log("error rồi");
                            $.toast({
                                heading: 'Xóa thất bại!',
                                text: 'Vui lòng thao tác lại! Có sự cố hãy liên hệ đội kỹ thuật',
                                showHideTransition: 'slide',
                                icon: 'error',
                                position: 'bottom-right',
                                hideAfter: 5000
                            })
                        }
                    });
                }
            });




            /* Select2: Tìm kiếm nhiều ô  */
            $('#select-giang-vien-LichMuonPhong').change(function() {
                let value = $(this).val();
                tableClassroom.column(1).search(value).draw();
            });

            $('#select-phong-LichMuonPhong').change(function() {
                let value = $(this).val();
                tableClassroom.column(3).search(value).draw();
            });

            $('#select-ngay-muon-LichMuonPhong-1').change(function() {
                // let value = $(this).val();
                // tableClassroom.column(3).search(value).draw();

                let value = $(this).val();
                // console.log(value);
                let valueChange = reformatDateString(value);

                console.log(valueChange);
                tableClassroom.column(4).search(valueChange).draw();

                function reformatDateString(s) {
                    var b = s.split("-");
                    var reverseArray = b.reverse();
                    var joinArray = reverseArray.join("-");
                    return joinArray;
                }
            });

            $("#selectedValue").on('DOMSubtreeModified', function() {
                var span_Text = document.getElementById("selectedValue").innerText;
                console.log('NgaymuonPhong2: ' + span_Text);
                var valueDaXuLy = xuLyNgayDaChon(span_Text);

                tableClassroom.column(4).search(valueDaXuLy).draw();

                function xuLyNgayDaChon(s) {
                    var b = s.split(" - ");
                    console.log('Kiểu dữ liệu b: ', Array.isArray(b));
                    console.log('b: ', b);

                    var tachMangNgayDon1 = [];
                    var ngayMang1 = '';
                    var thangMang1 = '';
                    var namMang1 = '';
                    var dateMang1 = [];

                    var tachMangNgayDon2 = [];
                    var ngayMang2 = '';
                    var thangMang2 = '';
                    var namMang2 = '';
                    var dateMang2 = [];

                    var mangDayNgayThangNay = [];
                    var mangDayNgayThangSau = [];

                    var ngayThangNay;
                    var ngayThangSau;

                    var kyTuNoi = "-";
                    var mangDayNgayThangNam1 = [];
                    var mangDayNgayThangNam2 = [];

                    var mangDayNgayThangNam = [];
                    var dayNgayThangNam = "";


                    tachMangNgayDon1 = b[0];
                    var tachChuoiMangNgayDon1 = tachMangNgayDon1.split("/");
                    ngayMang1 = tachChuoiMangNgayDon1[0];
                    thangMang1 = tachChuoiMangNgayDon1[1];
                    namMang1 = parseInt(tachChuoiMangNgayDon1[2]);
                    var noiChuoiMangNgayDon1 = tachChuoiMangNgayDon1.join("-");
                    dateMang1 = toDate(noiChuoiMangNgayDon1);
                    console.log('Date 1: ', dateMang1);

                    tachMangNgayDon2 = b[1];
                    var tachChuoiMangNgayDon2 = tachMangNgayDon2.split("/");
                    ngayMang2 = tachChuoiMangNgayDon2[0];
                    thangMang2 = tachChuoiMangNgayDon2[1];
                    namMang2 = parseInt(tachChuoiMangNgayDon2[2]);
                    var noiChuoiMangNgayDon2 = tachChuoiMangNgayDon2.join("-");
                    dateMang2 = toDate(noiChuoiMangNgayDon2);
                    console.log('Date 2: ', dateMang2);

                    // Tính khoảng cách ngày
                    let time = get_day_of_time(dateMang1, dateMang2)
                    console.log(time + ' day');

                    // Tính số ngày trong tháng
                    let soNgayTrongThang = get_day_of_month(namMang1, thangMang1);
                    console.log('Số ngày trong tháng: ' + soNgayTrongThang);

                    //  Push mảng dãy ngày
                    for (i = 0; i <= time; i++) {
                        ngayThangNay = parseInt(ngayMang1) + i;
                        if (ngayThangNay <= soNgayTrongThang) {
                            mangDayNgayThangNay.push(ngayThangNay);
                        }
                    }
                    if (ngayThangNay > soNgayTrongThang) {
                        var soNgayKeTiep = ngayThangNay - soNgayTrongThang;
                        console.log(soNgayKeTiep);
                        for (j = 1; j <= soNgayKeTiep; j++) {
                            ngayThangSau = j;
                            mangDayNgayThangSau.push(ngayThangSau);
                        }
                    }

                    // Kết quả mảng dãy ngày tháng năm 1
                    mangDayNgayThangNay.forEach(xuLyNgayThangNam1);
                    console.log(mangDayNgayThangNam1);

                    // Kết quả mảng dãy ngày tháng năm 2
                    mangDayNgayThangSau.forEach(xuLyNgayThangNam2);
                    console.log(mangDayNgayThangNam2);

                    // Nối mảng dãy ngày tháng năm 1 - 2
                    if ((mangDayNgayThangNam2.length) > 0) {
                        mangDayNgayThangNam = mangDayNgayThangNam1.concat(mangDayNgayThangNam2);
                    } else {
                        mangDayNgayThangNam = mangDayNgayThangNam1;
                    }
                    dayNgayThangNam = mangDayNgayThangNam.join('|');
                    console.log(dayNgayThangNam);

                    // Xử lý dd-mm-yyyy -> date
                    function toDate(dateStr) {
                        var parts = dateStr.split("-");
                        return new Date(parts[2], parts[1] - 1, parts[0]);
                    }

                    // Xử lý tính khoảng cách ngày
                    function get_day_of_time(d1, d2) {
                        let ms1 = d1.getTime();
                        let ms2 = d2.getTime();
                        console.log('ms1:', ms1);
                        console.log('ms2:', ms2);
                        return Math.ceil((ms2 - ms1) / (24 * 60 * 60 * 1000));
                    };

                    // Xử lý tính số ngày trong tháng
                    function get_day_of_month(year, month) {
                        return new Date(year, parseInt(month), 0).getDate();
                    };

                    // Xử lý mảng dãy ngày tháng năm 1
                    function xuLyNgayThangNam1(item, index) {
                        if (item < 10) item = '0' + item;
                        mangDayNgayThangNam1.push(item + kyTuNoi + thangMang1 + kyTuNoi + namMang1);
                    }

                    // Xử lý mảng dãy ngày tháng năm 2
                    function xuLyNgayThangNam2(item, index) {
                        if (item < 10) item = '0' + item;
                        mangDayNgayThangNam2.push(item + kyTuNoi + thangMang2 + kyTuNoi + namMang2);
                    }

                    return dayNgayThangNam;
                }
            });

            /*
            $('#selectedValue').change(function() {
                var span_Text = document.getElementById("selectedValue").innerText;
                console.log('Span: '+span_Text);
                let value = $(this).val();
                console.log('NgaymuonPhong2: ' + value);
                let valueChange = reformatDateString(value);

                console.log('NgayMuonPhong2Change: ' + valueChange);
                tableClassroom.column(3).search(valueChange).draw();

                function reformatDateString(s) {
                    var b = s.split(" - ");
                    console.log('Kiểu dữ liệu b: ', Array.isArray(b));
                    console.log('b: ', b);

                    var tachMangNgay = [];

                    for (var i = 0; i < b.length; i++) {

                        tachMangNgay = b[i];
                        console.log(tachMangNgay);
                        console.log(Array.isArray(tachMangNgay));
                        // var reverseArray = tachMangNgay.reverse();
                        // var joinArray = reverseArray.join("-");
                        // console.log(joinArray);
                    }

                    // var tachMangNgay = b.slice(1,2);
                    // console.log('Kiểu dữ liệu tachMangNgay: ', Array.isArray(tachMangNgay));
                    // console.log('tachMangNgay: ',tachMangNgay);

                    // var reverseArray = tachMangNgay.reverse();
                    // console.log( Array.isArray(reverseArray));

                    // var joinArray = reverseArray.join("-");
                    // console.log(typeof joinArray);
                    // return joinArray;
                }
            });
            */

            $('#select-tiet-hoc-LichMuonPhong').change(function() {
                // Tìm kiếm theo tiết học cách 1: xử lý ở front end
                // let value=$(this).val();
                // if(value === '0'){
                //     tableClassroom.column(4).search('').draw();
                // }else{
                //     tableClassroom.column(4).search(value).draw();
                // }

                // Tìm kiếm theo tiết học cách 2: xử lý ở back end
                let value = $(this).val();
                tableClassroom.column(5).search(value).draw();
            });






            $("#select-tiet-hoc").select2({
                ajax: {
                    url: "{{ route('lichmuonphong.api_index.api_tiet_hoc') }}",
                    dataType: 'json',
                    // delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function(data, params) {
                        // console.log(data);
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.TietHoc,
                                    id: item.id
                                }
                            })
                        };
                    },
                },
                placeholder: 'Tìm theo tiết học',
            });
            // #select-tiet-hoc is a <input type="text"> element, tableClassroom is varible let tableClassroom
            $('#select-tiet-hoc').change(function() {
                tableClassroom.column(0).search(this.value).draw();
            });

            $("#select-giang-vien").select2({
                ajax: {
                    url: "{{ route('lichmuonphong.api_index.api_giang_vien') }}",
                    dataType: 'json',
                    // delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function(data, params) {
                        // console.log(data);
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.MaGiangVien,
                                    id: item.id
                                }
                            })
                        };
                    },
                },
                placeholder: 'Tìm theo mã giảng viên',
            });
            // #select-tiet-hoc is a <input type="text"> element, tableClassroom is varible let tableClassroom đã khai báo
            $('#select-giang-vien').change(function() {
                tableClassroom.column(0).search(this.value).draw();
            });

            $("#select-ngay-muon").select2({
                ajax: {
                    url: "{{ route('lichmuonphong.api_index.api_ngay_muon') }}",
                    dataType: 'json',
                    // delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function(data, params) {
                        // console.log(data);
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.NgayMuon,
                                    id: item.id
                                }
                            })
                        };
                    },
                },
                placeholder: 'Tìm theo ngày mượn',
            });
            // #select-ngay-muon is a <input type="text"> element, tableClassroom is varible let tableClassroom đã khai báo
            $('#select-ngay-muon').change(function() {
                tableClassroom.column(0).search(this.value).draw();
            });
        });
    </script>

    <script>
        function showStuff(id) {
            document.getElementById(id).style.display = 'block';
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#btnImportExcel").change(function() {
                var formData = new FormData();
                formData.append('file', $(this)[0].files[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                $.ajax({
                    url: '{{ route('lichmuonphong.importExcel') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $.toast({
                            heading: 'Nhập file thành công',
                            text: 'Dữ liệu của bạn đã được nhập. Vui lòng tải lại trang!',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'bottom-right',
                            hideAfter: 5000
                        })
                    },
                    error: function() {
                        console.log("error rồi");
                        $.toast({
                            heading: 'Nhập file thất bại',
                            text: 'Kiểm tra lại dữ liệu trong file!',
                            showHideTransition: 'slide',
                            icon: 'error',
                            position: 'bottom-right',
                            hideAfter: 5000
                        })
                    }
                });
            })
        });
    </script>
@endpush
