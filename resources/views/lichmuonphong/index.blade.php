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
    {{-- // h??m kiemTraAdmin n???m ??? helper --}}
    @if (kiemTraAdmin())
        <caption>
            <a class="btn btn-primary action-icon" href="{{ route('lichmuonphong.create') }}"><i
                    class="mdi mdi-calendar-plus text-white mr-2 mb-2"></i>Th??m l???ch m?????n ph??ng</a>
        </caption>
        <form style="display: inline-block;">
            <div class="form-group">
                <label class="btn btn-primary action-icon mb-0" for="btnImportExcel"><i
                        class="mdi mdi-file-compare text-white mr-2 mb-2"></i>Nh???p file excel</label>
                <input type="file" id="btnImportExcel" class="form-control-file d-none"
                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            </div>
        </form>
    @endif

    <div id="btnTimKiemNhieuO" onclick="showStuff('TimKiemNhieuO');" class="float-right mb-2" tabindex="1">
        <input type="button" value="T??m ki???m nhi???u ??" class="btn btn-primary search-icon">
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
            <p class="text-center lead"><b>T??m ki???m nhi???u ??</b></p>
            <p class="text-warning"><i><b>L??u ??: K???t qu??? t??m ki???m s??? ??u ti??n ?? nh???p cu???i c??ng</b></i></p>
        </div>
        <div class="card-body" style="display: flex; flex-wrap: wrap;">
            <div class="form-group mt-2" style="flex: 1 1 50%;">
                <label class="min-width-230px" for="select-tiet-hoc-LichMuonPhong">T??m ki???m theo s??? ti???t: </label>
                <select class="min-width-140px" name="" id="select-tiet-hoc-LichMuonPhong">
                    <option value="0">T???t c??? ti???t h???c</option>
                    @foreach ($arrLichMuonPhongSoTiet as $key => $value)
                        <option value="{{ $value }}">
                            {{ $key }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2" style="flex: 1 1 50%;">
                <label class="min-width-230px" for="select-giang-vien-LichMuonPhong">T??m ki???m m?? gi???ng vi??n: </label>
                <select class="min-width-140px" name="" id="select-giang-vien-LichMuonPhong">
                    <option value="0">T???t c??? gi???ng vi??n</option>
                    @foreach ($arrGiangVien as $giangVien)
                        <option value="{{ $giangVien->MaGiangVien }}">
                            {{ $giangVien->MaGiangVien }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2" style="flex: 1 1 50%;">
                <label class="min-width-230px" for="select-phong-LichMuonPhong">T??m ki???m ph??ng: </label>
                <select class="min-width-140px" name="" id="select-phong-LichMuonPhong">
                    <option value="0">T???t c??? ph??ng</option>
                    @foreach ($arrPhong as $phong)
                        <option value="{{ $phong->MaPhong }}">
                            {{ $phong->MaPhong }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2" style="flex: 1 1 50%;">
                <label class="min-width-230px" for="select-ngay-muon-LichMuonPhong-1">T??m ki???m theo ng??y: </label>
                <input class="min-width-140px" id="select-ngay-muon-LichMuonPhong-1" type="date" name="date">
            </div>

            <!-- Predefined Date Ranges -->
            <div class="form-group mt-2" style="flex: 1 1 100%;">
                <label>T??m ki???m theo kho???ng th???i gian:</label>
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
                    <th>M?? gi???ng vi??n</th>
                    <th>T??n gi???ng vi??n</th>
                    <th>Ph??ng</th>
                    <th>Ng??y m?????n</th>
                    <th>Ti???t h???c</th>
                    <th>Ghi ch??</th>
                    @if (kiemTraAdmin())
                        <th>S???a</th>
                        <th>X??a</th>
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
                    <h4 class="modal-title w-100">X??c nh???n x??a?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>B???n c?? th???c s??? mu???n x??a c??c b???n ghi n??y kh??ng? Kh??ng th??? ho??n t??c qu?? tr??nh n??y.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">H???y b???</button>
                    <button type="button" class="btn btn-danger" id="btn-delete-lich-muon-phong"
                        data-dismiss="modal">X??c
                        nh???n x??a</button>
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

            // X??? l?? n??t x??a
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
                console.log("???? ???n vaafo btn-delete-lich-muon-phong");
                checkXacNhanXoaLich = true;
                if (checkXacNhanXoaLich === true) {
                    $.ajax({
                        // C??ch l???y url trong form b???ng c??ch l???c thu???c t??nh action
                        url: form.attr('action'),
                        type: 'POST',
                        dataType: 'json',
                        // t???t c??? nh???ng g?? ??i???n trong form s??? truy???n v??o data b???ng h??m serialize()
                        data: form.serialize(),
                        success: function() {
                            console.log("success haha");
                            // row.remove();
                            tableClassroom.draw();
                            $.toast({
                                heading: 'X??a th??nh c??ng',
                                text: 'D??? li???u c???a b???n ???? ???????c x??a',
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'bottom-right',
                                hideAfter: 5000
                            })
                        },
                        error: function() {
                            console.log("error r???i");
                            $.toast({
                                heading: 'X??a th???t b???i!',
                                text: 'Vui l??ng thao t??c l???i! C?? s??? c??? h??y li??n h??? ?????i k??? thu???t',
                                showHideTransition: 'slide',
                                icon: 'error',
                                position: 'bottom-right',
                                hideAfter: 5000
                            })
                        }
                    });
                }
            });




            /* Select2: T??m ki???m nhi???u ??  */
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
                    console.log('Ki???u d??? li???u b: ', Array.isArray(b));
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

                    // T??nh kho???ng c??ch ng??y
                    let time = get_day_of_time(dateMang1, dateMang2)
                    console.log(time + ' day');

                    // T??nh s??? ng??y trong th??ng
                    let soNgayTrongThang = get_day_of_month(namMang1, thangMang1);
                    console.log('S??? ng??y trong th??ng: ' + soNgayTrongThang);

                    //  Push m???ng d??y ng??y
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

                    // K???t qu??? m???ng d??y ng??y th??ng n??m 1
                    mangDayNgayThangNay.forEach(xuLyNgayThangNam1);
                    console.log(mangDayNgayThangNam1);

                    // K???t qu??? m???ng d??y ng??y th??ng n??m 2
                    mangDayNgayThangSau.forEach(xuLyNgayThangNam2);
                    console.log(mangDayNgayThangNam2);

                    // N???i m???ng d??y ng??y th??ng n??m 1 - 2
                    if ((mangDayNgayThangNam2.length) > 0) {
                        mangDayNgayThangNam = mangDayNgayThangNam1.concat(mangDayNgayThangNam2);
                    } else {
                        mangDayNgayThangNam = mangDayNgayThangNam1;
                    }
                    dayNgayThangNam = mangDayNgayThangNam.join('|');
                    console.log(dayNgayThangNam);

                    // X??? l?? dd-mm-yyyy -> date
                    function toDate(dateStr) {
                        var parts = dateStr.split("-");
                        return new Date(parts[2], parts[1] - 1, parts[0]);
                    }

                    // X??? l?? t??nh kho???ng c??ch ng??y
                    function get_day_of_time(d1, d2) {
                        let ms1 = d1.getTime();
                        let ms2 = d2.getTime();
                        console.log('ms1:', ms1);
                        console.log('ms2:', ms2);
                        return Math.ceil((ms2 - ms1) / (24 * 60 * 60 * 1000));
                    };

                    // X??? l?? t??nh s??? ng??y trong th??ng
                    function get_day_of_month(year, month) {
                        return new Date(year, parseInt(month), 0).getDate();
                    };

                    // X??? l?? m???ng d??y ng??y th??ng n??m 1
                    function xuLyNgayThangNam1(item, index) {
                        if (item < 10) item = '0' + item;
                        mangDayNgayThangNam1.push(item + kyTuNoi + thangMang1 + kyTuNoi + namMang1);
                    }

                    // X??? l?? m???ng d??y ng??y th??ng n??m 2
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
                    console.log('Ki???u d??? li???u b: ', Array.isArray(b));
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
                    // console.log('Ki???u d??? li???u tachMangNgay: ', Array.isArray(tachMangNgay));
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
                // T??m ki???m theo ti???t h???c c??ch 1: x??? l?? ??? front end
                // let value=$(this).val();
                // if(value === '0'){
                //     tableClassroom.column(4).search('').draw();
                // }else{
                //     tableClassroom.column(4).search(value).draw();
                // }

                // T??m ki???m theo ti???t h???c c??ch 2: x??? l?? ??? back end
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
                placeholder: 'T??m theo ti???t h???c',
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
                placeholder: 'T??m theo m?? gi???ng vi??n',
            });
            // #select-tiet-hoc is a <input type="text"> element, tableClassroom is varible let tableClassroom ???? khai b??o
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
                placeholder: 'T??m theo ng??y m?????n',
            });
            // #select-ngay-muon is a <input type="text"> element, tableClassroom is varible let tableClassroom ???? khai b??o
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
                            heading: 'Nh???p file th??nh c??ng',
                            text: 'D??? li???u c???a b???n ???? ???????c nh???p. Vui l??ng t???i l???i trang!',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'bottom-right',
                            hideAfter: 5000
                        })
                    },
                    error: function() {
                        console.log("error r???i");
                        $.toast({
                            heading: 'Nh???p file th???t b???i',
                            text: 'Ki???m tra l???i d??? li???u trong file!',
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
