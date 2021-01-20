@extends("web::layouts.master")

@section("content")
    <div class="site-content bg-punch-light overflow-hidden mt-12" id="content">
        <div class="container">
            <header class="entry-header space-top-2 space-bottom-1 mb-2">
                <h1 class="entry-title font-size-7">Giỏ hàng của bạn: <span id="qtyInCart">{{$quantityInCart ?? 0}}</span> sản phẩm</h1>
            </header>
            <div class="row pb-8">
                <div id="primary" class="content-area col-md-9">
                    <main id="main" class="site-main ">
                        <div class="page type-page status-publish hentry">

                            <div class="entry-content">
                                <div class="woocommerce">
                                    <form id="list-items" class="woocommerce-cart-form table-responsive" action="#" method="post">
                                        <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                            <thead>
                                            <tr>
                                                <th class="product-name">Sản phẩm</th>
                                                <th class="product-price">Giá bán</th>
                                                <th class="product-quantity">Số lượng</th>
                                                <th class="product-subtotal">Tổng</th>
                                                <th class="product-remove">&nbsp;</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($itemsInCart as $item)
                                            <tr class="woocommerce-cart-form__cart-item cart_item">
                                                <input type="hidden" id="product_id" name="item['product_id']" value="{{$item->product_id}}">
                                                <input type="hidden" id="price" @if ($item->promotion_price==0)
                                                    value="{{$item->product->price}}"
                                                @else
                                                    value="{{$item->promotion_price}}"
                                                @endif >
                                                <td class="product-name" data-title="Product">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#">
                                                            <img src="{{$item->product->image}}" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" width="45" alt="">
                                                        </a>
                                                        <div class="ml-3 m-w-200-lg-down">
                                                            <a href="{{route('product.detail', $item->product_id)}}">{{$item->product->title}}</a>
                                                            <input type="hidden" name="item['title']" value="{{$item->product->title}}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product-price" data-title="Price">
                                                    @if ($item->promotion_price==0)
                                                        <span class="woocommerce-Price-amount amount">{{\App\Helpers\format_currency($item->product->price)}}</span>
                                                    @else
                                                        <span class="woocommerce-Price-amount amount">{{\App\Helpers\format_currency($item->promotion_price)}}</span>
                                                    @endif
                                                </td>
                                                <td class="product-quantity" data-title="Quantity">
                                                    <div class="quantity d-flex align-items-center">

                                                        <div class="border px-3 width-120">
                                                            <div class="js-quantity">
                                                                <div class="d-flex align-items-center">
                                                                    @if ($item->promotion_price==0)
                                                                    <span class="js-minus text-dark" onclick="decrementQuantity(this, {{$item->product_id}}, {{$item->product->price}})"><i class="fas fa-minus"></i></span>
                                                                    @else
                                                                    <span class="js-minus text-dark" onclick="decrementQuantity(this, {{$item->product_id}}, {{$item->promotion_price}})"><i class="fas fa-minus"></i></span>
                                                                    @endif

                                                                    <input type="text" class="input-text qty text js-result form-control text-center border-0" id="quantity" pattern="\d+" name="item['quantity']" value="{{$item->quantity}}" readonly/>

                                                                    @if ($item->promotion_price==0)

                                                                    <span class="js-plus text-dark" onclick="incrementQuantity(this, {{$item->product_id}},  {{$item->product->price}})"><i class="fas fa-plus"></i></span>
                                                                    @else
                                                                    <span class="js-plus text-dark" onclick="incrementQuantity(this, {{$item->product_id}},  {{$item->promotion_price}})"><i class="fas fa-plus"></i></span>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td class="product-subtotal">
                                                    @if ($item->promotion_price==0)
                                                    <span class="woocommerce-Price-amount amount" id="total-price-{{$item->product_id}}">{{\App\Helpers\calculate_total_price($item->quantity, $item->product->price)}}</span>
                                                    @else
                                                    <span class="woocommerce-Price-amount amount" id="total-price-{{$item->product_id}}">{{\App\Helpers\calculate_total_price($item->quantity, $item->promotion_price)}}</span>
                                                    @endif
                                                </td>
                                                <td class="product-remove">
                                                    <a href="#" class="remove" onclick="removeItem(this)">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5" class="actions">
                                                    <input type="submit" class="button" value="Cập nhật giỏ hàng">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
                <div id="secondary" class="sidebar cart-collaterals order-1" role="complementary">
                    <div id="cartAccordion" class="border border-gray-900 bg-white mb-5">
                        <div class="p-4d875 border">
                            <table class="shop_table shop_table_responsive">
                                <tbody>
                                <tr class="order-total">
                                    <th>Tổng số tiền</th>
                                    <td class="ml-4">
                                        <strong>
                                            <span id="total-amount" class="woocommerce-Price-amount amount">{{\App\Helpers\format_currency($totalAmount)}}</span>
                                        </strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="wc-proceed-to-checkout">
                        <a href="{{route("web.checkout")}}" class="checkout-button button alt wc-forward btn btn-dark btn-block rounded-0 py-4">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let totalAmount = {{$totalAmount}};

        function changeInput(e) {
            let root = $(e).parent();
            let price = $(root).find("#price").val();
            let quantity = $(root).find("#quantity").val();
            totalAmount = totalAmount - quantity * price;
            $('#total-amount').html(formatPrice(totalAmount));
        }

        function incrementQuantity(e, product_id, price) {
            let inputEl = $(e).parent().children()[1];
            let quantity = parseInt($(inputEl).val()) + 1;
            $(inputEl).val(quantity);
            $('#total-price-' + product_id).html(formatPrice(quantity * price));
            totalAmount = totalAmount + price;
            $('#total-amount').html(formatPrice(totalAmount));
        }

        function decrementQuantity(e, product_id, price) {
            let inputEl = $(e).parent().children()[1];
            let quantity = parseInt($(inputEl).val()) - 1;
            if(quantity > 0) {
                $(inputEl).val(quantity);
                $('#total-price-' + product_id).html(formatPrice(quantity * price));
                totalAmount = totalAmount - price;
                $('#total-amount').html(formatPrice(totalAmount));
            }
        }

        function formatPrice(price) {
            let nf = new Intl.NumberFormat();
            return nf.format(price) + "đ";
        }

        function removeItem(e) {
            let root = $(e).parent().parent();
            let productId = $(root).find("#product_id").val();
            let price = $(root).find("#price").val();
            let quantity = $(root).find("#quantity").val();
            $.ajax({
                url: "{{route('product.remove-item')}}",
                type:'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                },
                success: function(result){
                    if(result.status) {
                        $(root).remove();
                        totalAmount = totalAmount - quantity * price;
                        $('#total-amount').html(formatPrice(totalAmount));
                        $('#cart-item').html(result.cartItem);
                        $('#qtyInCart').html(parseInt($('#qtyInCart').text()) - 1);
                    } else {
                        alert(result.message);
                    }
                },
            });
        }

        document.querySelector('form#list-items').addEventListener('submit', (event) => {
            event.preventDefault();
            let data = $('form#list-items').serializeArray();
            let items = [];
            for(var i = 0; i < data.length; i = i + 3) {
                let item = {};
                item['product_id'] = data[i].value;
                item['title'] = data[i+1].value;
                item['quantity'] = data[i+2].value;
                items.push(item);
            }
            updateCartSubmit(items);
        });

        function  updateCartSubmit(data) {
            $.ajax({
                url: "{{route('product.update-cart')}}",
                type:'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    items: data,
                },
                success: function(result){
                    console.log(result);
                    if(result.status) {
                        alert(result.message);
                    } else {
                        let messages = '';
                        if(Array.isArray(result.message)) {
                            result.message.forEach((item) => messages += item.message + "\n");
                        }
                        alert(messages);
                    }
                },
            });
        }
    </script>
@endsection
