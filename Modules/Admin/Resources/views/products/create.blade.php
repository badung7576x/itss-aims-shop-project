@extends('admin::layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm sản phẩm mới</h1>
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
                        <form action="{{route('admin.product.post-create')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-8">
                                        <label for="">Tên sản phẩm</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old("title", "")}}" placeholder="Nhập tên sản phẩm" required>
                                        @error('title')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Loại sản phẩm</label>
                                        <select class="form-control" id="category" name="category_id" required>
                                            <option value="" selected>---</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" @if($category->id == old('category_id')) selected @endif>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Hình ảnh thumbnail</label>
                                    <input type="text" class="form-control @error('image') is-invalid @enderror" name="image" value="{{old("image", "")}}" placeholder="Link ảnh sản phẩm" required>
                                    @error('image')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="">Giá gốc</label>
                                        <input type="number" class="form-control @error('value') is-invalid @enderror" name="value" value="{{old("value", "")}}" placeholder="0" required>
                                        @error('value')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="">Giá bán</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old("price", "")}}" placeholder="0" required>
                                        @error('price')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="">Số lượng</label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{old("quantity", "")}}" placeholder="0" required>
                                        @error('quantity')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="">Trạng thái</label>
                                        <select class="form-control" name="status">
                                            <option value="0" @if(old('status') == 0) selected @endif>Không hiển thị</option>
                                            <option value="1" @if(old('status') == 1) selected @endif>Hiển thị</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="other-property"></div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>

    <script>
        function renderForm(category_id) {
            $.ajax({
                url: "{{route('admin.product.renderform')}}",
                type:'get',
                data: {
                    category_id: category_id
                },
                success:function (result){
                    $('#other-property').html(result.propertyForm);
                }
            });
        }

        $('#category').on('change', function() {
            let selectID = this.value;
            if(selectID == "") return;
            renderForm(selectID);
        });
        $(document).ready(function() {
           if({{old('category_id', 0)}}) {
                renderForm({{old('category_id')}});
           }
        });
    </script>
@endsection
