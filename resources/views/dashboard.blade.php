@extends('layout.master')
@push('css')
    <style>
        .min-width-230px {
            min-width: 230px;
        }

        .min-width-140px {
            min-width: 140px;
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endpush
@section('contentPage')
    <form action="" autocomplete="off">
        @csrf
        <div style="display: flex; flex-wrap: wrap; justify-content: between; align-items: center;">
            <div class="form-group mt-2" style="flex: 1 1 33%;">
                <label for="datepicker" class="mr-2" style="display:block; z-index:9999;">Từ ngày: </label>
                <input class="mr-2" id="datepicker" type="text">
            </div>
            <div class="form-group mt-2" style="flex: 1 1 33%;">
                <label for="datepicker2" class="mr-2" style="display:block; z-index:9999;">Đến ngày: </label>
                <input class="mr-2" id="datepicker2" type="text">
            </div>

            <div class="form-group mt-2" style="flex: 1 1 33%;">
                <label for="select-loc-theo" class="mr-2" style="display:block;">Lọc theo: </label>
                <select name="" id="select-loc-theo" class="dashboard-filter form-control mr-2"
                    style="display:block;">
                    <option selected disabled>Chọn</option>
                    <option value="7ngayqua">7 ngày trước</option>
                    <option value="1thangtruoc">Tháng trước</option>
                    <option value="thangnay">Tháng này</option>
                    <option value="365ngayqua">365 ngày qua</option>
                </select>
            </div>
        </div>
        <input type="button" value="Lọc kết quả" class="btn btn-primary btn-sm mt-2 mb-2" id="btn-dashboard-filter">
    </form>



    <div class="col-md-12 mt-2 mb-4" style="text-align: center;">
        <caption style="caption-side: top;">
            <p>BẢNG DỮ LIỆU THỐNG KÊ SỐ LƯỢNG LỊCH VÀ SỐ LƯỢNG GIẢNG VIÊN MƯỢN</p>
        </caption>
        <div style="float:right" class="col-md-3">
            <div>
                <div style="background: #0B62A4; width: 20px; height: 20px; display:inline-block;"></div>
                <span>Số lượng lịch mượn phòng</span>
            </div>
            <div>
                <div style="background: #7A92A3; width: 20px; height: 20px; display:inline-block;"></div>
                <span>Số lượng giảng viên mượn</span>
            </div>
        </div>
        <div class="" id="myfirstchart" style="height: 250px;"></div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-centered mb-0 mt-2" id="thongkesolangiangvienmuon-table"
            style="border-collapse: collapse;">
            <caption style="caption-side: top; text-align: center;">BẢNG DỮ LIỆU THỐNG KÊ SỐ LẦN GIẢNG VIÊN MƯỢN</caption>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ngày mượn</th>
                    <th>Mã giảng viên</th>
                    <th>Số lần giảng viên mượn</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('js')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        $(document).ready(function() {
            AutoLoad30NgayGanDay();

            var chart = new Morris.Bar({
                element: 'myfirstchart',
                // lineColors: ['#819C79', '#fc8710', '#FF6541', '#766B56'],
                lineColors: ['#819C79', '#fc8710'],

                pointFillColors: ['#ffffff'],
                pointStrokeColors: ['black'],

                // Test 4
                xkey: 'khoangThoiGian',
                ykeys: ['soLuongLichMuonPhong', 'soGiangVienMuon'],
                labels: ['Số lượng lịch mượn phòng', 'Số giảng viên mượn'],

                // hoverCallback: function(index, options, content, row) {
                //     console.log(row);
                //     var hover = "<div class='morris-hover-row-label'>" + row.khoangThoiGian +
                //         "</div><div class='morris-hover-point' style='color: #A4ADD3'><p color:black>" +
                //         row.soGiangVienMuon + "</p></div>";
                //     return content;
                // },

                fillOpacity: 0.6,
                hideHover: 'auto',
                parseTime: false,
                behaveLikeLine: true,
                resize: true,
            });
            $("#datepicker").datepicker({
                beforeShow: function() {
                    setTimeout(function() {
                        $('.ui-datepicker').css('z-index', 99999999999999);
                    }, 0);
                },
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "dd-mm-yy",
                dayNamesMin: ["Chủ nhật ", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
                duration: "slow"
            });
            $("#datepicker2").datepicker({
                beforeShow: function() {
                    setTimeout(function() {
                        $('.ui-datepicker').css('z-index', 99999999999999);
                    }, 0);
                },
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "dd-mm-yy",
                dayNamesMin: ["Chủ nhật ", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
                duration: "slow"
            });
            $('#btn-dashboard-filter').click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                var fromDate = $('#datepicker').val();
                var toDate = $('#datepicker2').val();
                // console.log(fromDate, ' đến ', toDate);
                $.ajax({
                    url: "{{ route('xulytimkiemtheongay') }}",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        TuNgay: fromDate,
                        DenNgay: toDate
                    },
                    success: function(data) {
                        console.log(data);
                        chart.setData(data);
                    },
                    error: function() {
                        data = [{
                                khoangThoiGian: fromDate,
                                soLuongLichMuonPhong: 0,
                                soGiangVienMuon: 0
                            },
                            {
                                khoangThoiGian: toDate,
                                soLuongLichMuonPhong: 0,
                                soGiangVienMuon: 0
                            }
                        ];

                        console.log(data);
                        chart.setData(data);
                    }
                });

                $.ajax({
                    url: "{{ route('thongkesolangiangvienmuon') }}",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        TuNgay: fromDate,
                        DenNgay: toDate
                    },
                    success: function(data) {
                        console.log(data);


                        // Cách 4: vẽ table
                        // var no = 1;
                        // var $tbody = $('#thongkesolangiangvienmuon-table tbody');
                        // $tbody.empty();
                        // var last = "";
                        // $.each(data, function(i, item) {
                        //     if (last != item.khoangThoiGian) {
                        //         var $len = data.filter(function(cur) {
                        //             return cur == item.khoangThoiGian
                        //         }).length;

                        //         $('.td-khoangThoiGian').attr('rowspan', $len);
                        //         last = item.khoangThoiGian;
                        //         console.log(last, $len);
                        //     };
                        //     var $tr = $('<tr>').append(
                        //         $('<td>').text(no++).addClass("td-stt"),
                        //         $('<td>').text(item.khoangThoiGian).addClass("td-khoangThoiGian"),
                        //         $('<td>').text(item.maGiangVien).addClass("td-maGiangVien"),
                        //         $('<td>').text(item.soLanGiangVienMuon).addClass("td-soLanGiangVienMuon")
                        //     ).appendTo('#thongkesolangiangvienmuon-table');
                        // });
                        // Cách 2: vẽ table

                        // //Cách 1. clear table: remove all existing rows
                        // $("tr:has(td)").remove();

                        // //Cách 2.clear table
                        var no = 1;
                        var $tbody = $('#thongkesolangiangvienmuon-table tbody');
                        $tbody.empty();

                        $.each(data, function(i, item) {
                            var $tr = $('<tr>').append(
                                $('<td>').text(no++).addClass("td-stt"),
                                $('<td>').text(item.khoangThoiGian).addClass(
                                    "td-khoangThoiGian"),
                                $('<td>').text(item.maGiangVien).addClass(
                                    "td-maGiangVien"),
                                $('<td>').text(item.soLanGiangVienMuon).addClass(
                                    "td-soLanGiangVienMuon")
                            ).appendTo('#thongkesolangiangvienmuon-table');

                            // console.log($tr.wrap('<p>').html());
                        });

                        // // Cách 1: vẽ table
                        // var trHTML = '';
                        // $.each(data, function(i, item) {
                        //     trHTML += '<tr><td>' + item.khoangThoiGian + '</td><td>' +
                        //         item
                        //         .maGiangVien + '</td><td>' + item.soLanGiangVienMuon +
                        //         '</td></tr>';
                        // });
                        // $('#thongkesolangiangvienmuon-table').append(trHTML);
                    },
                    error: function() {
                        var no = 1;
                        var $tbody = $('#thongkesolangiangvienmuon-table tbody');
                        $tbody.empty();

                        var $tr = $('<tr>').append(
                            $('<td>').text("Dữ liệu trống").addClass("td-stt").attr(
                                'colspan', 4).css('color', 'red').css('text-align',
                                'center')
                        ).appendTo('#thongkesolangiangvienmuon-table');
                    }
                });
            });

            $('.dashboard-filter').change(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });

                var dashboardFilterValue = $(this).val();
                // const date = new Date();
                var fromDate;
                var toDate
                switch (dashboardFilterValue) {
                    case "7ngayqua":
                        fromDate = moment().subtract(6, "days").format("DD-MM-YYYY");
                        console.log(fromDate);

                        toDate = moment().format("DD-MM-YYYY");
                        console.log(toDate);
                        break;
                    case "1thangtruoc":
                        fromDate = moment().subtract(1, "month").startOf("month").format("DD-MM-YYYY");
                        console.log(fromDate);

                        toDate = moment().subtract(1, "month").endOf("month").format("DD-MM-YYYY");
                        console.log(toDate);
                        break;
                    case "thangnay":
                        fromDate = moment().startOf("month").format("DD-MM-YYYY");
                        console.log(fromDate);

                        toDate = moment().endOf("month").format("DD-MM-YYYY");
                        console.log(toDate);
                        break;
                    case "365ngayqua":
                        fromDate = moment().subtract(1, 'year').format("DD-MM-YYYY");
                        console.log(fromDate);

                        toDate = moment().format("DD-MM-YYYY");
                        console.log(toDate);
                        break;
                    default:
                        // code block
                }

                $.ajax({
                    url: "{{ route('xulytimkiemtheongay') }}",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        TuNgay: fromDate,
                        DenNgay: toDate
                    },
                    success: function(data) {
                        console.log(data);
                        chart.setData(data);
                    },
                    error: function() {
                        data = [{
                                khoangThoiGian: fromDate,
                                soLuongLichMuonPhong: 0,
                                soGiangVienMuon: 0
                            },
                            {
                                khoangThoiGian: toDate,
                                soLuongLichMuonPhong: 0,
                                soGiangVienMuon: 0
                            }
                        ];

                        console.log(data);
                        chart.setData(data);
                    }
                });

                $.ajax({
                    url: "{{ route('thongkesolangiangvienmuon') }}",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        TuNgay: fromDate,
                        DenNgay: toDate
                    },
                    success: function(data) {
                        console.log(data);

                        // Cách 2: vẽ table

                        // //Cách 1. clear table: remove all existing rows
                        // $("tr:has(td)").remove();

                        // //Cách 2.clear table
                        var no = 1;
                        var $tbody = $('#thongkesolangiangvienmuon-table tbody');
                        $tbody.empty();

                        $.each(data, function(i, item) {
                            var $tr = $('<tr>').append(
                                $('<td>').text(no++).addClass("td-stt"),
                                $('<td>').text(item.khoangThoiGian).addClass(
                                    "td-khoangThoiGian"),
                                $('<td>').text(item.maGiangVien).addClass(
                                    "td-maGiangVien"),
                                $('<td>').text(item.soLanGiangVienMuon).addClass(
                                    "td-soLanGiangVienMuon")
                            ).appendTo('#thongkesolangiangvienmuon-table');

                            // console.log($tr.wrap('<p>').html());
                        });
                    },
                    error: function() {
                        var no = 1;
                        var $tbody = $('#thongkesolangiangvienmuon-table tbody');
                        $tbody.empty();

                        var $tr = $('<tr>').append(
                            $('<td>').text("Dữ liệu trống").addClass("td-stt").attr(
                                'colspan', 4).css('color', 'red').css('text-align',
                                'center')
                        ).appendTo('#thongkesolangiangvienmuon-table');
                    }
                });
            });

            function AutoLoad30NgayGanDay() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });

                var date = new Date();
                var fromDate = new Date(date.getFullYear(), date.getMonth() - 1, date.getDate() + 1).toISOString()
                    .replace(/T.*/, '').split('-').reverse().join('-');
                console.log(fromDate);

                const timeElapsed = Date.now();
                const toDate = new Date(timeElapsed).toISOString().replace(/T.*/, '').split('-').reverse().join(
                    '-');
                console.log(toDate);

                $.ajax({
                    url: "{{ route('xulytimkiemtheongay') }}",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        TuNgay: fromDate,
                        DenNgay: toDate
                    },
                    success: function(data) {
                        console.log(data);
                        chart.setData(data);
                    },
                    error: function() {
                        data = [{
                                khoangThoiGian: fromDate,
                                soLuongLichMuonPhong: 0,
                                soGiangVienMuon: 0
                            },
                            {
                                khoangThoiGian: toDate,
                                soLuongLichMuonPhong: 0,
                                soGiangVienMuon: 0
                            }
                        ];

                        console.log(data);
                        chart.setData(data);
                    }
                });

                $.ajax({
                    url: "{{ route('thongkesolangiangvienmuon') }}",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        TuNgay: fromDate,
                        DenNgay: toDate
                    },
                    success: function(data) {
                        console.log(data);

                        // Cách 2: vẽ table

                        // //Cách 1. clear table: remove all existing rows
                        // $("tr:has(td)").remove();

                        // //Cách 2.clear table
                        var no = 1;
                        var $tbody = $('#thongkesolangiangvienmuon-table tbody');
                        $tbody.empty();

                        $.each(data, function(i, item) {
                            var $tr = $('<tr>').append(
                                $('<td>').text(no++).addClass("td-stt"),
                                $('<td>').text(item.khoangThoiGian).addClass(
                                    "td-khoangThoiGian"),
                                $('<td>').text(item.maGiangVien).addClass("td-maGiangVien"),
                                $('<td>').text(item.soLanGiangVienMuon).addClass(
                                    "td-soLanGiangVienMuon")
                            ).appendTo('#thongkesolangiangvienmuon-table');

                            // console.log($tr.wrap('<p>').html());
                        });
                    },
                    error: function() {
                        var no = 1;
                        var $tbody = $('#thongkesolangiangvienmuon-table tbody');
                        $tbody.empty();

                        var $tr = $('<tr>').append(
                            $('<td>').text("Dữ liệu trống").addClass("td-stt").attr('colspan', 4)
                            .css('color', 'red').css('text-align', 'center')
                        ).appendTo('#thongkesolangiangvienmuon-table');
                    }
                });
            };
        });
    </script>
@endpush
