@extends('layout.master')
@push('css')
    <!-- Summernote css -->
    <link href="{{ asset('css/vendor/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('contentPage')
    <form action="{{ route('lichmuonphong.update', $each->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="MaGiangVien">Mã giảng viên</label>
            <input class="form-control" id="MaGiangVien" type="text" name="MaGiangVien" value="{{ $each->MaGiangVien }}"
                readonly>
        </div>

        <div class="form-group">
            <label for="select-ngay-muon-LichMuonPhong">Chọn ngày</label>
            <span class="ml-4">&ensp;Ngày cũ: {{ $each->getNgayMuonFormatView() }}</span>
            <input class="form-control" id="select-ngay-muon-LichMuonPhong" type="date" name="NgayMuon"
                value="{{ $each->getNgayMuonFormated() }}">
            {{-- <input class="form-control" id="select-ngay-muon-LichMuonPhong" type="date" name="NgayMuon"> --}}
            @if ($errors->has('NgayMuon'))
                <div class="alert alert-danger">
                    {{ $errors->first('NgayMuon') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Chọn số tiết</label>
            <span class="ml-4">Tiết học cũ: {{ $each->TietHoc }}</span>
            <br>
            @foreach ($arrLichMuonPhongSoTiet as $keyLichMuonPhongSoTiet => $valueLichMuonPhongSoTiet)
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" name='TietHoc[]' class="custom-control-input btn btn-warning tiet-hoc"
                        id="customCheck{{ $valueLichMuonPhongSoTiet }}" value="{{ $valueLichMuonPhongSoTiet }}"
                        @foreach ($each->getTietHocFormated() as $keyTietHoc => $valueTietHoc)
                            {{ $valueTietHoc == $valueLichMuonPhongSoTiet ? 'checked' : '' }} @endforeach>
                    <label class="custom-control-label"
                        for="customCheck{{ $valueLichMuonPhongSoTiet }}">{{ $keyLichMuonPhongSoTiet }}</label>
                </div>
            @endforeach

            {{-- @foreach ($arrLichMuonPhongSoTiet as $keyLichMuonPhongSoTiet => $valueLichMuonPhongSoTiet)
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" name='TietHoc[]' class="custom-control-input btn btn-warning tiet-hoc"
                        id="customCheck{{ $valueLichMuonPhongSoTiet }}" value="{{ $valueLichMuonPhongSoTiet }}">
                    <label class="custom-control-label"
                        for="customCheck{{ $valueLichMuonPhongSoTiet }}">{{ $keyLichMuonPhongSoTiet }}</label>
                </div>
            @endforeach --}}
            @if ($errors->has('TietHoc'))
                <div class="alert alert-danger">
                    {{ $errors->first('TietHoc') }}
                </div>
            @endif
        </div>

        <div class="form-group" id="btnChonPhong">
            <label for="MaPhong">Chọn phòng</label>
            <span class="ml-4">Mã phòng cũ: {{ $each->MaPhong }}</span>
            <select name="MaPhong" class="custom-select mb-3" id="MaPhong">
                {{-- <option selected disabled>Danh sách phòng</option> --}}
                <option selected value="{{ $each->MaPhong }}">{{ $each->MaPhong }}</option>
            </select>
            @if ($errors->has('MaPhong'))
                <div class="alert alert-danger">
                    {{ $errors->first('MaPhong') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="SoMay">Ghi chú</label>
            <textarea id="summernote" name="GhiChu">{{ $each->GhiChu }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
@endsection

@push('js')
    <!-- plugin js -->
    <script src="{{ asset('js/vendor/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    <script>
        const maPhongElement = $("#MaPhong");
        const tietHocElement = $('.tiet-hoc');
        const btnChonPhongElement = $('#btnChonPhong');
        const selectNgayMuonLichMuonPhongElement = $('#select-ngay-muon-LichMuonPhong');

        let valueNgayMuonDaNhap;
        var changed_status = true; // thiết lập trạng thái changed ban đầu là true (là được load data) ok 
        $(selectNgayMuonLichMuonPhongElement).change(function() {
            changed_status = true; // khi chạy vào hàm này sẽ set changed là true = được load data
            let value = $(this).val();
            let valueNgayMuon = reformatDateString(value);
            console.log('Bạn đã chọn ngày: ' + valueNgayMuon);

            function reformatDateString(s) {
                var b = s.split("-");
                var reverseArray = b.reverse();
                var joinArray = reverseArray.join("-");
                return joinArray;
            }
            // Cách mình chống cháy
            // $('#valueNgayDaChon').val(valueNgayMuon);
            valueNgayMuonDaNhap = valueNgayMuon;
        });

        let valueTietHocDaNhap;
        $(tietHocElement).change(function() {
            changed_status = true; // khi chạy vào hàm này sẽ set changed là true = được load data, cũng như vậy
            var tietHoc = [];
            $(tietHocElement).each(function() {
                if ($(this).is(":checked")) {
                    tietHoc.push($(this).val());
                }
            });
            tietHoc = tietHoc.toString();
            console.log('Bạn đã chọn tiết: ' + tietHoc);
            // $('#valueTietDaChon').val(tietHoc);
            valueTietHocDaNhap = tietHoc;

        });

        function removeduplicate() {
            var mycode = {};
            // var mangLap = {};
            var mangLap = [];
            $("select[id='MaPhong'] > option").each(function() {
                if (mycode[this.text]) {
                    console.log('Mảng của bạn: ', mycode);
                    // $.each(mycode, function(key, value) {
                    //     mangLap.push(value);
                    //     console.log('Mảng lặp: ', mangLap);
                    // });
                    $(this).remove();
                } else {
                    mycode[this.text] = this.value;
                }
            });
        }

        //__
        $(btnChonPhongElement).click(function() {
            if (valueTietHocDaNhap !== undefined && valueNgayMuonDaNhap !== undefined) {
                if (changed_status === false) {
                    return;
                }
                changed_status = false;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });

                $.ajax({
                    url: "{{ route('lichmuonphong.api_index.api_phong_kha_dung') }}",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        NgayMuon: valueNgayMuonDaNhap,
                        TietHoc: valueTietHocDaNhap
                    },
                    success: function(data) {
                        // Test 2
                        // $("#MaPhong").html('');                       
                        // $("#MaPhong").empty();
                        // removeduplicate();
                        let option_els = '';
                        $.each(data, function(key, value) {
                            // $("#MaPhong").append(
                            //     "<option value=" + value.MaPhong + ">" + value.MaPhong +
                            //     "</option>"
                            // );
                            option_els +=
                                `<option value="${value.MaPhong}">${value.MaPhong}</option>`
                        });
                        $(maPhongElement).html(option_els);

                    },
                    error: function() {
                        console.log("error rồi");
                    }
                })
            } else {
                alert("Vui lòng chọn ngày và tiết trước khi chọn phòng!");
            }
        });

        $('#btnChonPhong').change(function() {
            // var conceptName = $('#btnChonPhong :selected').text();
            console.log($("#MaPhong"));
            console.log($("#MaPhong")[0]);
            console.log($("#MaPhong")[0].value);
        })
    </script>
@endpush
