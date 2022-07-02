@extends('layout.master')
@push('css')
@endpush
@section('contentPage')
<div class="table-responsive">
    <table class="table table-bordered table-centered mb-0 mt-2" id="users-table">
        <thead>
            {{-- <tr> --}}
            <tr>
                {{-- <th>STT</th> --}}
                <th>Ngày mượn</th>
                <th>Mã giảng viên</th>
                <th>Phòng</th>
                <th>Tiết học</th>
                <th>Ghi Chú</th>
            </tr>
            {{-- </tr> --}}
        </thead>
        <tbody>
            @foreach ($dataFileExcel as $data)

            @endforeach
        </tbody>
    </table>
</div>
@endsection