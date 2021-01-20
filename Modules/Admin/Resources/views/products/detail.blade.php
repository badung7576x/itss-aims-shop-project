@extends('admin::layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thông tin sản phẩm</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-10 offset-1">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="javascript:;" onclick="window.history.back();"><i class="fas fa-arrow-left"></i></a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="deleteForm" action="{{route('admin.product.post-delete')}}" method="POST">
                                @csrf
                                <input type="hidden" name="ids[]" value="{{$product->id}}">
                            </form>
                            <div class="row">
                                <div class="col-4">
                                    <div class="" style="width: 417px; height: auto;">
                                        <img src="{{$product->image}}" class="mx-auto img-fluid" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <dl class="row" style="margin-top: 20px; font-size: 20px">
                                        <dt class="col-sm-4">Tên sản phẩm</dt>
                                        <dd class="col-sm-8">{{$product->title}}</dd>
                                        <dt class="col-sm-4">Loại sản phẩm</dt>
                                        <dd class="col-sm-8">{{$product->category->name}}</dd>
                                        <dt class="col-sm-4">Giá gốc</dt>
                                        <dd class="col-sm-8">{{\App\Helpers\format_currency($product->value)}}</dd>
                                        <dt class="col-sm-4">Giá khuyến mãi</dt>
                                        <dd class="col-sm-8">{{\App\Helpers\format_currency($product->price)}}</dd>
                                        <dt class="col-sm-4">Trạng thái</dt>
                                        <dd class="col-sm-8">
                                            @if($product->status == 1)
                                                <span class='badge badge-success'>Hiển thị</span>
                                            @else
                                                <span class='badge badge-warning'>Không hiển thị</span>
                                            @endif
                                        </dd>
                                        <dt class="col-sm-4">Số lượng hàng còn lại</dt>
                                        <dd class="col-sm-8">{{$product->quantity->quantity ?? 0}}  sản phẩm</dd>
                                        <dd class="col-sm-12"></dd>
                                        <dt class="col-sm-12">Các thông tin khác của sản phẩm</dt>
                                        <dl class="col-sm-12"></dl>
                                        <table class="table">
                                            <tbody>
                                            @foreach($product->properties as $property)
                                                <tr>
                                                    <td width="30%">{{$property->property_type->property_name}}</td>
                                                    <td>{{$property->value}} @if($property->property_type->property_name == "Khối lượng")
                                                        {{DEFAULT_WEIGHT_UNIT}} @endif</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </dl>
                                </div>
                            </div>
                        <!-- /.card-body -->
                        </div>
                        <div class="card-footer" style="text-align: center">
                            <a href="{{route('admin.product.edit', 1)}}" class="btn btn-primary">Sửa thông tin</a>
                            <a href="javascript:;" class="btn btn-danger" data-toggle="modal" data-target="#alert-modal">Xóa sản phẩm</a>
                        </div>
                    </div>
                    <!-- /.card -->
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
                    <p>Bạn chắc chắn muốn xóa sản phẩm này khỏi hệ thống!</p>
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
    <script>
        function deleteProducts() {
            $('form#deleteForm').submit();
        }
    </script>
@endsection
