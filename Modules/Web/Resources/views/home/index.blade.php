@extends("web::layouts.master")

@section("content")

    <section class="mb-8 mt-14">
        <div class="container">
            <div class="pt-5 pb-5">
                <div class="bg-img-hero img-fluid rounded-md" style="background-image: url({{asset('web/images/img1-bg.jpg')}});">
                    <div>
                        <div class="slick-list draggable">
                            <div class="slick-track" style="opacity: 1; width: 5600px; transform: translate3d(0px, 0px, 0px);">
                                <div
                                    class="px-4 px-md-6 px-lg-7 px-xl-10 d-flex min-height-530 slick-slide slick-current slick-active"
                                    data-slick-index="0"
                                    aria-hidden="false"
                                    style="width: 1400px; height: auto;"
                                    tabindex="0"
                                    role="tabpanel"
                                    id="slick-slide00"
                                    aria-describedby="slick-slide-control00"
                                >
                                    <div class="max-width-565 my-auto">
                                        <div class="media">
                                            <div class="media-body align-self-center mb-4 mb-lg-0">
                                                <p
                                                    class="banner__pretitle text-uppercase text-gray-400 font-weight-bold mb-2 animated fadeInUp"
                                                    data-scs-animation-in="fadeInUp"
                                                    data-scs-animation-delay="200"
                                                    style="animation-delay: 200ms; opacity: 1;"
                                                >
                                                    THE AIMS SHOP EDITORS’
                                                </p>
                                                <h2 class="font-size-15 mb-3 pb-1 animated fadeInUp" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300" style="animation-delay: 300ms; opacity: 1;">
                                                    <span class="hero__title-line-1 font-weight-normal d-block">Buy everything <br/>with</span>
                                                    <span class="hero__title-line-2 font-weight-bold d-block">AIMS Shop</span>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-bottom-3">
        <div class="container">
            <header class="d-md-flex justify-content-between align-items-center mb-5">
                @if(empty($keyword))
                    <h2 class="font-size-7 mb-4 mb-md-0">Danh sách sản phẩm</h2>
                @else
                    <h2 class="font-size-7 mb-4 mb-md-0">Danh sách sản phẩm theo từ khóa: {{$keyword}}</h2>
                @endif
            </header>
            <ul class="products list-unstyled mb-0 row row-cols-2 row-cols-md-3 row-cols-xl-4 row-cols-wd-5">
                @if(count($products) > 0)
                @foreach($products as $product)
                    <li class="col">
                        <div class="product product__space product__space-primary border rounded-md bg-white mb-5">
                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                    <div class="woocommerce-loop-product__thumbnail">
                                        <a href="#" class="d-block">
                                            <img src="{{$product->image}}" class="d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" style="height: 200px" alt="image-description" />
                                        </a>
                                    </div>
                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                        <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                            <a href="{{route('product.detail', $product->id)}}">{{$product->title}}</a>
                                        </h2>
                                        <div class="price d-flex align-items-center font-weight-medium font-size-3">
                                            <span class="woocommerce-Price-amount amount">
                                                {{\App\Helpers\format_currency($product->price)}}
                                            </span>
                                            <span class="woocommerce-Price-amount amount ml-1" style="text-decoration: line-through; color: red">
                                                {{\App\Helpers\format_currency($product->value)}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="product__hover d-flex align-items-center">
                                        <div  class="text-uppercase text-dark h-dark font-weight-medium" onclick="addCart({{$product->id}})">
                                            <span class="product__add-to-cart" style="font-size: 12px">Thêm vào giỏ hàng</span>
                                            <span class="product__add-to-cart-icon font-size-4"><i class="fas fa-cart-plus"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
                @else
                    <header class="mb-4 container">
                        <p class="font-size-5 text-center text-red-1">Không tìm thấy sản phẩm bạn mong muốn</p>
                    </header>
                @endif
            </ul>
            <nav>
                {{$products->links()}}
            </nav>
        </div>
    </section>

    <section class="mb-8">
        <div class="space-bottom-3 space-bottom-lg-4">
            <div class="container">
                <header class="mb-5 d-md-flex align-items-center">
                    <h2 class="font-size-7 mb-3 mb-md-0">Promotion</h2>
                    <div class="mb-3 mb-md-0 ml-md-4 bg-primary rounded-md py-1 text-lh-lg px-3 d-flex text-white font-weight-medium">
                        <div class="days mx-2">114</div>
                        <div class="hrs mx-2">03</div>
                        <div class="min mx-2">60</div>
                        <div class="sec mx-2">25</div>
                    </div>
                </header>
                <div class="row">
                    @foreach($promotions as $promotion)
                        @if ($promotion->product_id)
                        @php
                            $product = \App\Entities\Product::find($promotion->product_id);
                        @endphp
                        <div class="slick-list col-6">
                            <div class="slick-track">
                                <div class="product product__card product__space product__space-primary border rounded-md bg-white">
                                    <div class="media p-3 p-md-4d875">
                                        <a href="#" class="d-block" tabindex="0"><img src="{{asset('web/images/img1(5).jpg')}}" alt="image-description" /></a>
                                        <div class="media-body ml-4d875">
                                            <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="#single-product-v3.html" tabindex="0">Hard Cover</a></div>
                                            <h2 class="woocommerce-loop-product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                <a href="{{route('product.detail', $product->id ?? NULL)}}">{{$product->title}}</a>
                                            </h2>
                                            <div class="font-size-2 mb-1 text-truncate"><a href="#authors-single.html" class="text-gray-700" tabindex="0">{{$product->title}}</a></div>
                                            <div class="price d-flex align-items-center font-weight-medium font-size-3 mb-3">
                                                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>15</span>
                                            </div>
                                            <div class="deal-progress">
                                                <div class="d-flex justify-content-between font-size-2 mb-2d75">
                                                    <span>Đã bán: 14</span>
                                                </div>
                                                <div class="progress height-7">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 82%;" aria-valuenow="14" aria-valuemin="0" aria-valuemax="17"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script>
        function addCart(id) {
            $.ajax({
                url: "{{route('product.add-cart')}}",
                type:'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: id,
                    quantity: 1
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
    </script>
@endsection
