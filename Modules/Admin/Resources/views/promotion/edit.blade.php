@extends('admin::layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chương trình khuyến mại</h1>
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
                            <h3 class="card-title">Cập nhật chương trình khuyến mại</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('promotion.update', $promotion->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="">Product Category ID:</label>
                                        <input type="text" value="{{$promotion->category_id}}" class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                        @error('title')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-8">
                                        <label for="">Tên chương trình khuyến mại</label>
                                        <input type="text" value="{{$promotion->name}}" class="form-control @error('title') is-invalid @enderror" name="name" id="name">
                                        @error('title')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Loại chương trình khuyến mại</label>
                                        <select class="form-control" id="type" name="type" required>
                                            <option value="" selected>---</option>
                                            @foreach(\App\Entities\Promotion::$typePromotions as $key => $typePromotion)
                                                <option value="{{$key}}" @if($key == $promotion->type) selected @endif>{{$typePromotion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả của chương trình : </label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="5">{{$promotion->description}}</textarea>
                                    @error('description')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="">Discount(%) :</label>
                                        <input type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{$promotion->discount}}" min="0" max="50" required>
                                        @error('discount')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Số lượng sản phẩm đươc giảm giá :</label>
                                        <input disabled type="number" class="form-control @error('num_product_discount') is-invalid @enderror" name="num_product_discount" value="{{$promotion->num_product_discount}}"  min="1" required>
                                        @error('num_product_discount')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="">Thời gian bắt đầu :</label>
                                        <input type="datetime-local" class="form-control @error('start_at') is-invalid @enderror" name="start_at" value="{{date('Y-m-d\TH:i', strtotime($promotion->start_at))}}" placeholder="0" required>
                                        @error('start_at')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Thời gian kết thúc : </label>
                                        <input type="datetime-local" class="form-control @error('end_at') is-invalid @enderror" name="end_at" value="{{date('Y-m-d\TH:i', strtotime($promotion->end_at))}}" placeholder="0" required>
                                        @error('end_at')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="other-property"></div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Cập nhật chương trình khuyến mại</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>
@endsection
