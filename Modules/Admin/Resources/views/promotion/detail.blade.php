@extends('admin::layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách sản phẩm của chương trình khuyến mại</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-header">
                                Danh sách sản phẩm 
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                       
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Number Product Discount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($promotion->promotionDetail as $key => $promotionDetail)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ \App\Entities\Product::find($promotionDetail->product_id)->title }}</td>
                                            <td class="text-center">{{ \App\Entities\Product::find($promotionDetail->product_id)->price }} đồng</td>
                                            <td class="text-center">{{ $promotionDetail->num_product_discount }}</td>
                                            <td class="text-center">@if (!$promotionDetail->num_product_discount == 0)
                                                <span class="badge badge-success">Còn sản phẩm</span>
                                            @else
                                                <span class="badge badge-danger">Hết sản phẩm</span>
                                            @endif</td>
                                            <td scope="col" class="position-center ">
                                                <a href="{{route("promotion.edit", $promotionDetail->id)}}" class="btn btn-info" role="button"><i class="fas fa-edit"></i></a>
                                                <form action="{{route("promotion.destroy", $promotion->id)}}" method="POST" style="display:inline;">
                                                    @method("DELETE")
                                                    @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="info-box mb-3 bg-warning">
                            <span class="info-box-icon"><i class="fas fa-percent"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Phần trăm giảm giá</span>
                                <span class="info-box-number">{{ $promotion->discount }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
