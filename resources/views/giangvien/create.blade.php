@extends('layout.master')
@section('contentPage')
    <form action="{{ route('giangvien.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="MaGiangVien">Mã giảng viên</label>
            <input name="MaGiangVien" type="text" id="MaGiangVien" class="form-control" value="{{ old('MaGiangVien') }}"
                required>

            @if ($errors->has('MaGiangVien'))
                <div class="alert alert-danger">
                    {{ $errors->first('MaGiangVien') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="HoTen">Họ tên giảng viên</label>
            <input name="HoTen" type="text" id="HoTen" class="form-control" value="{{ old('HoTen') }}" required>

            @if ($errors->has('HoTen'))
                <div class="alert alert-danger">
                    {{ $errors->first('HoTen') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input name="Email" type="text" id="Email" class="form-control" value="{{ old('Email') }}">

            @if ($errors->has('Email'))
                <div class="alert alert-danger">
                    {{ $errors->first('Email') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="SDT">Số điện thoại</label>
            <input name="SDT" type="text" id="SDT" class="form-control" value="{{ old('SDT') }}">

            @if ($errors->has('SDT'))
                <div class="alert alert-danger">
                    {{ $errors->first('SDT') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="GioiTinh">Giới tính</label>
            <select name="GioiTinh" class="custom-select mb-3" id="GioiTinh">
                <option selected disabled>Chọn giới tính</option>
                <option value="1">Nam</option>
                <option value="0">Nữ</option>
            </select>

            @if ($errors->has('GioiTinh'))
                <div class="alert alert-danger">
                    {{ $errors->first('GioiTinh') }}
                </div>
            @endif
        </div>


        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection
