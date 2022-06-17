@extends('layout.master')
@push('css')
    <!-- Summernote css -->
    <link href="{{ asset('css/vendor/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('contentPage')
    <form action="{{ route('phong.update', $each->MaPhong) }}" method="post">
        @csrf
        @method('PUT')
        @if ($errors->any())
            <h4>{{ $errors->first() }}</h4>
        @endif
        <input type="hidden" name="TenPhong" value="{{ $each->TenPhong }}">
        <div class="form-group">
            <label for="SoMay">Số máy</label>
            <input name="SoMay" type="number" min="0" max="200" id="SoMay" class="form-control"
                value="{{ $each->SoMay }}">
        </div>
        <div class="form-group">
            <label for="SoMay">Ghi chú</label>
            <textarea id="summernote" name="GhiChu">{{ $each->GhiChu }}</textarea>
        </div>
        <div class="form-group">
            <label for="TinhTrang">Trạng thái</label>
            <select name="TinhTrang" class="custom-select mb-3" id="TinhTrang">
                <option disabled>Chọn trạng thái</option>
                <option value="0" <?php if ($each->TinhTrang === 0) {
                    echo 'selected';
                } ?>>Đang hoạt động</option>
                <option value="1" <?php if ($each->TinhTrang === 1) {
                    echo 'selected';
                } ?>>Đang bảo trì</option>
            </select>
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
@endpush
