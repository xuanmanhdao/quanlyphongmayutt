@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.6/sb-1.3.3/sl-1.4.0/datatables.min.css" />
@endpush
@section('contentPage')
    @if (kiemTraAdmin())
        <caption>
            <a class="btn btn-primary action-icon" href="{{ route('giangvien.create') }}"><i
                    class="mdi mdi-account-plus text-white mr-2 mb-2"></i>Thêm giảng viên</a>
        </caption>
    @endif
    <div class="table-responsive mt-2">
        <table class="table table-bordered table-centered mb-0 mt-2" id="users-table">
            <thead>
                <tr>
                <tr>
                    <th>Mã giảng viên</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Tình trạng</th>
                    @if (kiemTraAdmin())
                        <th>Sửa</th>
                    @endif
                    {{-- <th>Xóa</th> --}}
                </tr>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.6/sb-1.3.3/sl-1.4.0/datatables.min.js">
    </script>

    <script>
        $(function() {


            var buttonCommon = {
                exportOptions: {
                    columns: ':visible :not(.not-export)'
                }
            };


            let tableClassroom = $('#users-table').DataTable({
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
                    "targets": [6],
                    // width: '20%', targets: 4

                    @if (kiemTraAdmin()==false)
                        "defaultContent": "-",
                        "targets": "6"
                    @endif
                    // "defaultContent": "-",
                    // "targets": "6"
                }],
                // responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('giangvien.api_index') !!}',
                // autoWidth: false,
                columns: [{
                        data: 'MaGiangVien',
                        name: 'MaGiangVien'
                    },
                    {
                        data: 'HoTen',
                        name: 'HoTen'
                    },
                    {
                        data: 'GioiTinh',
                        name: 'GioiTinh'
                    },
                    {
                        data: 'Email',
                        name: 'Email'
                    },
                    {
                        data: 'SDT',
                        name: 'SDT'

                    },
                    {
                        data: 'TinhTrang',
                        name: 'TinhTrang'

                    },
                    @if (kiemTraAdmin())
                        {
                            data: 'btnEdit',
                            target: 6,
                            orderable: false,
                            searchable: false,
                            render: function(data) {
                                return `<a href="${data}" class="action-icon"><i
                            class="mdi mdi-account-edit text-primary"></i></a>`;
                            }
                        },
                    @endif
                    // {
                    //     data: 'btnDestroy',
                    //     target: 6,
                    //     orderable: false,
                    //     searchable: false,
                    //     render: function(data) {
                    //         return `<form action="${data}" method="post">
                //         @csrf
                //         @method('DELETE')
                //         <button type="button" class="btn btn-delete-classroom action-icon"><i class="mdi mdi-delete"></i></button>
                //     </form>`;
                    //     }
                    // },
                    // {
                    //     data: 'btnBlock',
                    //     target: 7,
                    //     orderable: false,
                    //     searchable: false,
                    //     render: function(data) {
                    //         return `<div>
                //     <input type="checkbox" id="switch6" checked data-switch="success" />
                //     <label for="switch6" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                // </div>`;
                    //     }
                    // },
                ]
            });

            $(document).on("click", ".btn-delete-classroom", function() {
                let row = $(this).parents('tr');
                let form = $(this).parents('form');
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
                    },
                    error: function() {
                        console.log("error rồi");
                    }
                })
            });

        });
    </script>
@endpush
