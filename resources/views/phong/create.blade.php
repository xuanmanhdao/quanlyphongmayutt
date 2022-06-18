@extends('layout.master')
@push('css')
    <!-- Summernote css -->
    <link href="{{ asset('css/vendor/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('contentPage')
    <form action="{{ route('phong.store') }}" method="post">
        @csrf
        @if ($errors->has('msg'))
            {{-- <h4>{{ $errors->first() }}</h4> --}}
            <div class="alert alert-danger">
                {{ $errors->first('msg') }}
            </div>
        @endif
        <div class="form-group">
            <label for="TenToaNha">Tòa nhà</label>
            <select name="TenToaNha" class="custom-select mb-3" id="TenToaNha">
                <option selected disabled>Danh sách tòa nhà</option>
                <option value="A5">A5</option>
                <option value="A6">A6</option>
            </select>
            @if ($errors->has('TenToaNha'))
                <div class="alert alert-danger">
                    {{ $errors->first('TenToaNha') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="TenPhong">Tên phòng</label>
            <input name="TenPhong" type="number" min="100" max="900" id="TenPhong" class="form-control"
                value="{{ old('TenPhong') }}">
        </div>
        @if ($errors->has('TenPhong'))
            <div class="alert alert-danger">
                {{ $errors->first('TenPhong') }}
            </div>
        @endif
        <div class="form-group">
            <label for="SoMay">Số máy</label>
            <input name="SoMay" type="number" min="0" max="200" type="text" id="SoMay"
                class="form-control"
                value="{{ old('SoMay') }}>
                      @if ($errors->has('SoMay'))
<div class="alert
                alert-danger">
            {{ $errors->first('SoMay') }}
        </div>
        @endif
        </div>
        <div class="form-group">
            <label for="SoMay">Ghi chú</label>
            <textarea id="summernote" name="GhiChu"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
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
