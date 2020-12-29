@extends('admin::layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản lý sản phẩm </h1>
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
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route("admin.product.promotionUpdate")}}" method="GET">
                            <div class="card-body">
                                
                                <h3>Thông tin sản phẩm :</h3>
                                <div class="form-group col-sm-6">
                                    <input hidden name="product_id" type="text" class="form-control" value="{{$productId}}">
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="">Tên sản phẩm</label>
                                        <input disabled type="text" class="form-control" value="{{@$product->title}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="promotion_id">Chương trình khuyến mại</label>
                                        <select class="form-control" id="promotion_id" name="promotion_id" required>
                                            <option value="" selected>---</option>
                                            @foreach($promotions as $key => $promotion)
                                                @if (!$promotion->product_id)
                                                    <option value="{{$promotion->id}}">{{$promotion->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="num_product_discount">Số lượng sản phẩm áp dụng :</label>
                                        <input type="number" class="form-control" name="num_product_discount" id="num_product_discount" min='1' max='{{@$product->quantity->quantity}}'>
                                    </div>
                                </div>
                                <div id="other-property"></div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Áp dụng chương trình khuyến mại</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>
@endsection
