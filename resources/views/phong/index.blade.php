@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.6/sb-1.3.3/sl-1.4.0/datatables.min.css" />
    <style>
        /* .px200 {
                                                width: 200px;
                                                max-width: 200px !important;
                                                overflow-wrap: break-word;
                                            } */

        /* table.dataTable thead th:nth-child(5),
                                            table.dataTable tbody td:nth-child(5) {
                                                width: 200px !important;
                                                max-width: 200px !important;
                                                min-width: 200px !important;
                                            } */
    </style>
@endpush
@section('contentPage')
    @if (kiemTraAdmin())
        <caption>
            <a class="btn btn-primary action-icon" href="{{ route('phong.create') }}"><i
                    class="mdi mdi-home-plus text-white mr-2 mb-2"></i>Thêm phòng</a>
        </caption>
    @endif
    <div class="table-responsive mt-2">
        <table class="table table-bordered table-centered mb-0 mt-2" id="users-table">
            <thead>
                <tr>
                <tr>
                    <th>Mã phòng</th>
                    <th>Tên phòng</th>
                    <th>Số máy</th>
                    <th>Tình trạng</th>
                    <th>Ghi chú</th>
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
                    "targets": [5],

                    @if (kiemTraAdmin()==false)
                        "defaultContent": "-",
                        "targets": "5"
                    @endif
                    // "defaultContent": "-",
                    // "targets": "5"
                    // width: '20%', targets: 4
                }],
                // responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('phong.api_index') !!}',
                // autoWidth: false,
                columns: [{
                        data: 'MaPhong',
                        name: 'MaPhong'
                    },
                    {
                        data: 'TenPhong',
                        name: 'TenPhong'
                    },
                    {
                        data: 'SoMay',
                        name: 'SoMay'
                    },
                    {
                        data: 'TinhTrang',
                        name: 'TinhTrang'
                    },
                    {
                        // cách chưa set width
                        data: 'GhiChu',
                        // width: '15%',
                        target: 4,
                        render: function(data) {
                            return `${data}`;
                        }
                    },
                    @if (kiemTraAdmin())
                        {
                            data: 'btnEdit',
                            target: 5,
                            orderable: false,
                            searchable: false,
                            render: function(data) {
                                return `<a href="${data}" class="action-icon"><i
                            class="mdi mdi-home-edit text-primary"></i></a>`;
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
                        $.toast({
                            heading: 'Xóa thất bại!',
                            text: 'Vui lòng kiểm tra lại hoặc báo cáo sự cố liên hệ đội kỹ thuật!',
                            showHideTransition: 'slide',
                            icon: 'error',
                            position: 'bottom-right',
                            hideAfter: 5000
                        })
                    }
                })
            });

        });
    </script>
@endpush
