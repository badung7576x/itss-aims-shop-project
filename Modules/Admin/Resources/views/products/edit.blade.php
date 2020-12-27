@extends('admin::layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chỉnh sửa thông tin sản phẩm</h1>
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
                                <h3 class="card-title">
                                    <a href="javascript:;" onclick="window.history.back();"><i class="fas fa-arrow-left"></i></a>
                                </h3>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('admin.product.post-edit')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-8">
                                        <label for="">Tên sản phẩm</label>
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old("title", $product->title)}}" placeholder="Nhập tên sản phẩm" required>
                                        @error('title')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Loại sản phẩm</label>
                                        <select class="form-control" id="category" name="category_id" disabled required>
                                            <option value="{{$product->category_id}}" selected>{{$product->category->name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Hình ảnh thumbnail</label>
                                    <input type="text" class="form-control @error('image') is-invalid @enderror" name="image" value="{{old("image", $product->image)}}" placeholder="Link ảnh sản phẩm" required>
                                    @error('image')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="">Giá gốc</label>
                                        <input type="number" class="form-control @error('value') is-invalid @enderror" name="value" value="{{old("value", $product->value)}}" placeholder="0" required>
                                        @error('value')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="">Giá bán</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old("price", $product->price)}}" placeholder="0" required>
                                        @error('price')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="">Số lượng</label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{old("quantity", $product->quantity->quantity ?? 0)}}" placeholder="0" required>
                                        @error('quantity')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="">Trạng thái</label>
                                        <select class="form-control" name="status">
                                            <option value="1" @if(old('status', $product->status) == 1) selected @endif>Hiển thị</option>
                                            <option value="0" @if(old('status', $product->status) == 0) selected @endif>Không hiển thị</option>
                                        </select>
                                    </div>
                                </div>
                                @foreach($product->properties as $property)
                                    <div class="form-group">
                                        <label for="">{{$property->property_type->property_name}}</label>
                                        <input type="hidden" name="properties[{{$property->id}}][property_type_id]" value="{{$property->property_type_id}}">
                                        <input type="text" class="form-control" name="properties[{{$property->id}}][value]" value="{{old("properties['.$property->id.'][value]", $property->value )}}" placeholder="">
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>
@endsection
