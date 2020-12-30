@extends('web::layouts.master')
@section('content')
    <div id="content" class="site-content bg-punch-light space-bottom-3 mt-13">
        <div class="col-full container">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <article id="post-6" class="post-6 page type-page status-publish hentry">
                        <header class="entry-header space-top-2 space-bottom-1 mb-2">
                            <h4 class="entry-title font-size-7 text-center">Thanh toán</h4>
                        </header>

                        <div class="entry-content">
                            <div class="woocommerce">
                                <form id="checkout" method="post" class="checkout woocommerce-checkout row mt-8" action="{{route('web.post-checkout')}}">
                                    @csrf
                                    <div class="col2-set col-md-6 col-lg-7 col-xl-8 mb-6 mb-md-0" id="customer_details">
                                        <div class="px-4 pt-5 bg-white border">
                                            <div class="woocommerce-billing-fields">
                                                <h3 class="mb-4 font-size-3">Thông tin nhận hàng</h3>
                                                <div class="woocommerce-billing-fields__field-wrapper row">
                                                    <p class="col-12 mb-4d75 form-row form-row-first" id="billing_first_name_field" data-priority="10">
                                                        <a href="javascript:;" onclick="clearForm()" style="color: red; text-decoration-line: underline;">+ Thêm địa chỉ giao hàng khác</a>
                                                        <input type="hidden" name="type" value="{{!empty($shipInfo) ? 0 : 1}}">
                                                    </p>

                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="billing_first_name_field" data-priority="10">
                                                        <label class="form-label">Họ tên người nhận <span style="color: red">*</span></label>
                                                        @if(!empty($shipInfo))
                                                            <input type="hidden" name="id" value="{{$shipInfo->id}}">
                                                        @endif
                                                        <input type="text" class="input-text form-control" name="name" placeholder="Nhập họ tên người nhận" value="{{$shipInfo->receiver_name ?? ""}}" required>
                                                    </p>
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                        <label class="form-label">Email <span style="color: red">*</span></label>
                                                        <input type="email" class="input-text form-control" name="email" value="{{$shipInfo->receiver_email ?? ""}}" placeholder="Nhập email liên hệ">
                                                    </p>
                                                    <p class="col-12 mb-4d75 form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                        <label class="form-label">Phone number <span style="color: red">*</span></label>
                                                        <input type="text" class="input-text form-control" name="phone_number" value="{{$shipInfo->receiver_phone_number ?? ""}}" placeholder="Nhập số điện thoại người nhận">
                                                    </p>
                                                    <p class="col-12 mb-4d75 form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                        <label class="form-label">Tỉnh/Thành phố <span style="color: red">*</span></label>
                                                        <select name="province" class="form-control" tabindex="-1">
                                                            <option value="">Chọn tỉnh/thành phố</option>
                                                            <option value="hn" @if($shipInfo->province ?? "" == "hn") selected @endif>Hà Nội</option>
                                                            <option value="hcm" @if($shipInfo->province ?? "" == "hcm") selected @endif>Hồ Chí Minh</option>
                                                        </select>
                                                    </p>
                                                    <p class="col-12 mb-3 form-row form-row-wide address-field validate-required" id="billing_address_1_field" data-priority="50">
                                                        <label class="form-label">Địa chỉ <span style="color: red">*</span></label>
                                                        <input type="text" class="input-text form-control" name="address" value="{{$shipInfo->receiver_phone_number ?? ""}}" placeholder="Địa chỉ cụ thể khi nhận hàng">
                                                    </p>
                                                    <p class="col-12 mb-3 form-row form-row-wide address-field validate-required">
                                                        <label class="form-label">Ghi chú (không bắt buộc)</label>
                                                        <textarea name="note" class="input-text form-control" placeholder="Thêm ghi chú cho đơn hàng của bạn" rows="8" cols="5"></textarea>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pt-5 bg-white border border-top-0 mt-n-one">
                                            <div class="woocommerce-additional-fields">
                                                <h3 class="mb-4 font-size-3">Thông tin thanh toán</h3>
                                                <div class="woocommerce-billing-fields__field-wrapper row">
                                                    <div class="col-12 mb-4d75 form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field">
                                                        <label class="form-label">Loại thanh toán <span style="color: red">*</span></label>
                                                        <select name="credit[cart_type]" class="form-control" disabled>
                                                            <option value="1" selected>Credit Card</option>
                                                        </select>
                                                    </div>
                                                    <p class="col-12 mb-4d75 form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field">
                                                        <label for="billing_first_name" class="form-label">Mã số thẻ <span style="color: red">*</span></label>
                                                        <input type="text" class="input-text form-control" name="credit[card_number]" required>
                                                    </p>
                                                    <p class="col-lg-4 mb-4d75 form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                        <label class="form-label">Tháng <span style="color: red">*</span></label>
                                                        <select name="credit[month]" class="form-control" required>
                                                            <option value="">---</option>
                                                            @foreach(range(1, 12) as $m)
                                                                <option value="{{ $m }}">{{ $m }}</option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                    <p class="col-lg-4 mb-4d75 form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                        <label class="form-label">Năm <span style="color: red">*</span></label>
                                                        <select name="credit[year]" class="form-control" required>
                                                            <option value="">---</option>
                                                            @foreach(range(date('Y'), date('Y') + 10) as $y)
                                                                <option value="{{ $y }}">{{ $y }}</option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                    <p class="col-lg-4 mb-4d75 form-row form-row-wide" data-priority="30">
                                                        <label class="form-label">Mã CVV <span style="color: red">*</span></label>
                                                        <input type="text" class="input-text form-control" name="credit[cvv]">
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 id="order_review_heading" class="d-none">Danh sách sản phẩm</h3>
                                    <div id="order_review" class="col-md-6 col-lg-5 col-xl-4 woocommerce-checkout-review-order">
                                        <div id="checkoutAccordion" class="border border-gray-900 bg-white mb-5">
                                            <div class="p-4d875 border">
                                                <div class="checkout-head">
                                                    <a href="#" class="text-dark d-flex align-items-center justify-content-between collapsed" aria-expanded="true">
                                                        <h3 class="checkout-title mb-0 font-weight-medium font-size-3">Danh sách sản phẩm</h3>
                                                    </a>
                                                </div>
                                                <div id="checkoutCollapseOnee" class="mt-4 checkout-content collapse-show" aria-labelledby="checkoutHeadingOnee" data-parent="#checkoutAccordion" style="">
                                                    <table class="shop_table woocommerce-checkout-review-order-table">
                                                        <tbody>
                                                        @foreach($itemsInCart as $item)
                                                            <tr class="cart_item">
                                                                <td class="product-name">
                                                                    {{$item->product->title}}&nbsp; <strong class="product-quantity">X {{$item->quantity}}</strong>
                                                                </td>
                                                                <td class="product-total">
                                                                    <span class="woocommerce-Price-amount amount">{{\App\Helpers\calculate_total_price($item->quantity, $item->product->price)}}</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="p-4d875 border">
                                                <table class="shop_table shop_table_responsive">
                                                    <tbody>
                                                    <tr class="order-total">
                                                        <th>Tổng</th>
                                                        <td data-title="Total"><strong><span class="woocommerce-Price-amount amount">{{\App\Helpers\format_currency($totalAmount)}}</span></strong> </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-row place-order">
                                            <a href="javascript:;" class="button alt btn btn-dark btn-block rounded-0 py-4" onclick="submitForm()">Đặt hàng</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </article>
                </main>
            </div>
        </div>
    </div>
    <script>
        function clearForm() {
            $(':input', 'form#checkout').not(':button, :submit, :reset, :hidden').val('').prop('checked', false).prop('selected', false);
            $('form#checkout').find('input[name=type]').val(1);
        }

        function submitForm() {
            $('form#checkout').submit();
        }
    </script>
@endsection
