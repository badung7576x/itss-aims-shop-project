@extends('admin::layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý sản phẩm</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10">
                        <form id="list-products" action="{{route('admin.product.post-delete')}}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button type="button" class="btn btn-tool btn-outline-danger"  data-toggle="modal" data-target="#alert-modal">
                                        Xóa nhiều sản phẩm <i class="fas fa-trash"></i>
                                    </button>
                                </h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <select class="form-control" name="category" id="category">
                                            <option value="0" selected>Tất cả</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="product-table">
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        </form>
                        <!-- /.card -->
                    </div>
                    <div class="col-2">
                        <div class="info-box mb-3 bg-warning">
                            <span class="info-box-icon"><i class="fas fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Số sản phẩm</span>
                                <span class="info-box-number">{{count($products)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="alert-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center" style="font-size: 18px">
                    <p>Bạn chắc chắn muốn xóa các sản phẩm này khỏi hệ thống!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="deleteProducts()">Yepp</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <script>
        let products = {!! json_encode($products); !!};

        $('#category').on('change', function() {
            let selectID = this.value;
            let productFilter = [];
            if(selectID === "0") {
                productFilter = products;
            } else {
                productFilter = products.filter(product => product.category.id == selectID);
            }

            $('#product-table').DataTable().destroy();
            renderData(productFilter);
        });

        $(document).ready(function() {
            renderData(products);
        });

        document.querySelector('form#list-products').addEventListener('submit', (event) => {
            event.preventDefault();
        });

        function renderData(data) {
            let table = $('#product-table').DataTable( {
                "searching": false,
                "info": false,
                "paging": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 15,
                "responsive": true,
                "order": [[0, 'asc']],
                "select": {
                    "style":    'os',
                    "selector": 'td:first-child'
                },
                "data": data,
                "columns": [
                    { "title": "", "defaultContent": "", "width": "5%"},
                    { "title": "Hình ảnh", "width": "8%"},
                    { "title": "Tên", "width": "15%"},
                    { "title": "Loại sản phẩm", "width": "10%"},
                    { "title": "Giá gốc", "width": "10%"},
                    { "title": "Giá khuyến mãi", "width": "10%"},
                    { "title": "Số lượng", "width": "10%"},
                    { "title": "Trạng thái", "width": "4%"},
                    { "title": "Thao tác", "width": "8%"}
                ],
                "columnDefs": [
                    {
                        "targets":   0,
                        "orderable": false,
                        "className": 'text-center align-middle',
                        'render': ( data, type, row ) => {
                            return `<input type="checkbox" name="ids[]" value="${row.id}">`;
                        }
                    },
                    {
                        "targets": 1,
                        "className": "text-center align-middle",
                        "render": ( data, type, row ) => {
                            return `<img width="45" src="${row.image}">`;
                        },
                    },
                    {
                        "targets": 2,
                        "className": "align-middle",
                        "render": ( data, type, row ) => {
                            return `${row.title}`;
                        },
                    },
                    {
                        "targets": 3,
                        "className": "text-center align-middle",
                        "render": ( data, type, row ) => {
                            return `${row.category.name}`;
                        },
                    },
                    {
                        "targets": 4,
                        "className": "text-center align-middle",
                        "render": ( data, type, row ) => {
                            return `${row.value}đ`;
                        },
                    },
                    {
                        "targets": 5,
                        "className": "text-center align-middle",
                        "render": ( data, type, row ) => {
                            return `${row.price}đ`;
                        },
                    },
                    {
                        "targets": 6,
                        "className": "text-center align-middle",
                        "render": ( data, type, row ) => {
                            return `${ row.quantity != null ? row.quantity.quantity : "0"}`;
                        },
                    },
                    {
                        "targets": 7,
                        "className": "text-center align-middle",
                        "render": ( data, type, row ) => {
                            if (row. status == 1) {
                                return ` ${ "<span class='badge badge-success'>Hiển thị</span>"}`;
                            } else if (row. status == 3) {
                                return ` ${ "<span class='badge badge-primary'>Khuyến mại</span>"}`;
                            } else {
                                return ` ${ "<span class='badge badge-warning'>Không hiển thị</span>"}`;
                            }
                        },
                    },
                    {
                        "targets": 8,
                        "className": "text-center align-middle",
                        "width": "8%",
                        "render": ( data, type, row ) => {
                            let editLink = "{{route('admin.product.edit', ':id')}}";
                            editLink = editLink.replace(':id', row.id);
                            let promotionLink = "{{route('admin.product.promotion', ':id')}}";
                            promotionLink = promotionLink.replace(':id', row.id);
                            let detailLink = "{{route('admin.product.detail', ':id')}}";
                            detailLink = detailLink.replace(':id', row.id);
                            return `
                                <a type='button' href="${editLink}" class='btn btn-outline-warning btn-sm'><i class="fas fa-edit"></i></a>
                                <a type='button' href="${detailLink}" class='btn btn-outline-success btn-sm'><i class="fas fa-eye"></i></a>
                                <a type='button' href="${promotionLink}" class='btn btn-outline-danger btn-sm'><i class="fas fa-percentage"></i></a>
                            `;
                        },
                    },
                ]
            });
        }

        function deleteProducts() {
            $('form#list-products').submit();
        }
    </script>
@endsection
