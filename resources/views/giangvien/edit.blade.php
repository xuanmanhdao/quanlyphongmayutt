@extends('layout.master')
@section('contentPage')
    {{-- @dd($taiKhoan) --}}
    {{-- @dd($quyenTaiKhoan) --}}
    {{-- {{gettype($quyenTaiKhoan) }} --}}
    {{-- {{ $each }} --}}
    <hr>
    <form action="{{ route('giangvien.update', $each->MaGiangVien) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="MaGiangVien" value="{{ $each->MaGiangVien }}">
        <div class="form-group">
            <label for="HoTen">Họ tên giảng viên</label>
            <input name="HoTen" type="text" id="HoTen" class="form-control" value="{{ $each->HoTen }}">
            @if ($errors->has('HoTen'))
                <div class="alert alert-danger">
                    {{ $errors->first('HoTen') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="Email">Email</label>
            <input name="Email" type="text" id="Email" class="form-control" value="{{ $each->Email }}">
            @if ($errors->has('Email'))
                <div class="alert alert-danger">
                    {{ $errors->first('Email') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="SDT">Số điện thoại</label>
            <input name="SDT" type="text" id="SDT" class="form-control" value="{{ $each->SDT }}">
            @if ($errors->has('SDT'))
                <div class="alert alert-danger">
                    {{ $errors->first('SDT') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="GioiTinh">Giới tính</label>
            <select name="GioiTinh" class="custom-select mb-3" id="GioiTinh">
                <option disabled>Chọn trạng thái</option>
                <option value="1" <?php if ($each->GioiTinh === 1) {
                    echo 'selected';
                } ?>>Nam</option>
                <option value="0" <?php if ($each->GioiTinh === 0) {
                    echo 'selected';
                } ?>>Nữ</option>
            </select>
            @if ($errors->has('GioiTinh'))
                <div class="alert alert-danger">
                    {{ $errors->first('GioiTinh') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="Quyen">Tình trạng</label>
            <select name="Quyen" class="custom-select mb-3" id="Quyen">
                <option disabled>Chọn tình trạng</option>
                <option value="1" <?php if ($quyenTaiKhoan->quyen === 1) {
                    echo 'selected';
                } ?>>Đang hoạt động</option>
                <option value="2" <?php if ($quyenTaiKhoan->quyen === 2) {
                    echo 'selected';
                } ?>>Khóa hoạt động</option>
                <option value="0" <?php if ($quyenTaiKhoan->quyen === 0) {
                    echo 'selected';
                } ?>>Giao quyền admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
@endsection
