@extends("web::layouts.master")

@section("content")
    <div class="site-content mt-14" id="content">
        <div class="container">
            <div class="row space-top-2 mb-10">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <div class="product">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-5 woocommerce-product-gallery woocommerce-product-gallery--with-images images">
                                        <figure class="woocommerce-product-gallery__wrapper mb-0">
                                            <div class="js-slick-carousel u-slick slick-initialized slick-slider slick-dotted">
                                                <div class="slick-list draggable">
                                                    <div class="slick-track" style="opacity: 1; width: 800px; transform: translate3d(0px, 0px, 0px);">
                                                        <div class="js-slide slick-slide slick-current slick-active" style="width: 417px; height: auto;">
                                                            <img src="{{$product->image}}" alt="Image Description" class="mx-auto img-fluid" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-lg-7 pl-lg-0 summary entry-summary">
                                        <div class="px-lg-4 px-xl-6">
                                            <h1 class="product_title entry-title font-size-7 mb-3 ml-1">{{$product->title}}</h1>
                                            <div class="font-size-2 mb-4 ml-1">
                                                <span class="text-yellow-darker">
                                                    <span class="fas fa-star"></span>
                                                    <span class="fas fa-star"></span>
                                                    <span class="fas fa-star"></span>
                                                    <span class="fas fa-star"></span>
                                                    <span class="fas fa-star"></span>
                                                </span>
{{--                                                <span class="ml-3 font-weight-medium">By </span>--}}
{{--                                                <span class="ml-2 text-gray-600">Anna Banks</span>--}}
                                            </div>

                                            <div>
                                                <!-- Mockup Block -->
                                                <div class="table-responsive mb-4">
                                                    <table class="table table-hover table-borderless">
                                                        <tbody>
                                                        @foreach($product->properties as $property)
                                                        <tr>
                                                            <th width="25%">{{$property->property_type->property_name}}</th>
                                                            <td>{{$property->value}}</td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- End Mockup Block -->
                                            </div>

                                            <p class="price font-size-22 font-weight-medium mb-4 ml-2">
                                                <span class="woocommerce-Price-amount amount">
                                                    @if ($promotionDetail->first())
                                                        Giá áp dụng chương trình khuyến mại : <br> {{\App\Helpers\format_currency(\App\Helpers\cal_price_promotion($product->price, $promotionDetail->first()->promotion->discount))}}
                                                        <input hidden type="text" id="promotion_price" name="promotion_price" value="{{\App\Helpers\cal_price_promotion($product->price, $promotionDetail->first()->promotion->discount)}}" />
                                                    @else
                                                        {{\App\Helpers\format_currency($product->price)}}
                                                        <input hidden type="text" id="promotion_price" name="promotion_price" value="0" />
                                                    @endif
                                                </span>
                                                
                                                <span class="woocommerce-Price-amount amount ml-1" style="text-decoration: line-through; color: red">
                                                    {{\App\Helpers\format_currency($product->value)}}
                                                </span>
                                            </p>

                                            <div class="cart d-md-flex align-items-center" method="post" enctype="multipart/form-data">
                                                <div class="quantity mb-4 mb-md-0 d-flex align-items-center">
                                                    <!-- Quantity -->
                                                    <div class="border px-3 width-120">
                                                        <div class="js-quantity">
                                                            <div class="d-flex align-items-center">
                                                                <label class="screen-reader-text sr-only">Số lượng</label>
                                                                <span class="js-minus text-dark" id="decrement"><i class="fas fa-minus"></i></span>
                                                                <input type="text" class="input-text qty text js-result form-control text-center border-0" pattern="[\d]" id="quantity" name="quantity" value="1" />
                                                                <span class="js-plus text-dark" id="increment"><i class="fas fa-plus"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Quantity -->
                                                </div>

                                                <button type="button" name="add-to-cart" onclick="addCart({{$product->id}})" class="btn btn-dark border-0 rounded-0 p-3 btn-block ml-md-4 single_add_to_cart_button button alt">Thêm vào giỏ hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addCart(id) {
            let currentQuantity = $("#quantity").val();
            let promotionPrice = $("#promotion_price").val();
            $.ajax({
                url: "{{route('product.add-cart')}}",
                type:'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: id,
                    quantity: currentQuantity,
                    promotion_price: promotionPrice
                },
                success: function(result){
                    if(result.status) {
                        $('#cart-item').html(result.cartItem);
                        alert("Thêm vào giỏ hàng thành công");
                    } else {
                        alert(result.message);
                    }
                },
            });
        }

        $(document).ready(function() {
            $("#increment").click(function() {
                let currentQuantity = $("#quantity").val();
                currentQuantity = parseInt(currentQuantity) + 1;
                $("#quantity").val(currentQuantity);
            });
            $("#decrement").click(function() {
                let currentQuantity = $("#quantity").val();
                currentQuantity = parseInt(currentQuantity) - 1;
                if(currentQuantity > 0) {
                    $("#quantity").val(currentQuantity);
                }
            });
        });
    </script>
@endsection
