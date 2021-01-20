@extends('web::layouts.master')
@section('content')
    <main id="content" class="mt-13">
        <div class="bg-gray-200 space-bottom-3">
            <div class="container">
                <div class="py-5 py-lg-7">
                    <h6 class="font-weight-medium font-size-7 text-center mt-lg-1">Đặt hàng thành công</h6>
                </div>
                <div class="max-width-890 mx-auto">
                    <div class="bg-white pt-6 border">
                        <h6 class="font-size-3 font-weight-medium text-center mb-4 pb-xl-1 text-red-1">Cám ơn bạn đã đặt hàng trên hệ thống chúng tôi.</h6>
                        <div class="border-bottom mb-5 pb-5 overflow-auto overflow-md-visible">
                            <div class="pl-3">
                                <table class="table table-borderless mb-0 ml-1">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="font-size-2 font-weight-normal py-0">Mã đơn hàng</th>
                                        <th scope="col" class="font-size-2 font-weight-normal py-0 float-right mr-3">Ngày đặt hàng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="pr-0 py-0 font-weight-medium">{{$order->order_no}}</th>
                                        <td class="pr-0 py-0 font-weight-medium float-right mr-4">{{$order->ordered_at}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="border-bottom mb-5 pb-6">
                            <div class="px-3 px-md-4">
                                <div class="ml-md-2">
                                    <h6 class="font-size-3 on-weight-medium mb-4 pb-1">Chi tiết đơn hàng</h6>
                                    @foreach($order->order_items as $item)
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="d-flex align-items-baseline">
                                            <div>
                                                <h6 class="font-size-2 font-weight-normal mb-1">{{$item->product->title}}</h6>
                                            </div>
                                            <span class="font-size-2 ml-4 ml-md-8">x{{$item->quantity}}</span>
                                        </div>
                                        <span class="font-weight-medium font-size-2">{{\App\Helpers\calculate_total_price($item->quantity, $item->product->price)}}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom mb-5 pb-5">
                            <ul class="list-unstyled px-3 pl-md-5 pr-md-4 mb-0">
                                <li class="d-flex justify-content-between py-2">
                                    <span class="font-weight-medium font-size-2">Phí mua hàng:</span>
                                    <span class="font-weight-medium font-size-2">{{\App\Helpers\format_currency($order->order_amount)}}</span>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <span class="font-weight-medium font-size-2">Phí vận chuyển:</span>
                                    <span class="font-weight-medium font-size-2">@if($order->shipping_amount == 0) Miễn phí vận chuyển @else {{\App\Helpers\format_currency($order->shipping_amount)}} @endif</span>
                                </li>
                                <li class="d-flex justify-content-between pt-2">
                                    <span class="font-weight-medium font-size-2">Phương thức thanh toán:</span>
                                    <span class="font-weight-medium font-size-2">Thanh toán bằng thẻ tín dụng</span>
                                </li>
                            </ul>
                        </div>
                        <div class="border-bottom mb-5 pb-4">
                            <div class="px-3 pl-md-5 pr-md-4">
                                <div class="d-flex justify-content-between">
                                    <span class="font-size-2 font-weight-medium">Tổng tiền (Bao gồm VAT):</span>
                                    <span class="font-weight-medium fon-size-2">{{\App\Helpers\format_currency($order->order_amount * VAT + $order->shipping_amount)}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 pl-md-5 pr-md-4 mb-6 pb-xl-1">
                            <div class="row row-cols-1 row-cols-md-2">
                                <div class="col">
                                    <div class="mb-6 mb-md-0">
                                        <h6 class="font-weight-medium font-size-22 mb-3">Người đặt hàng
                                        </h6>
                                        <address class="d-flex flex-column mb-0">
                                            <span class="text-gray-600 font-size-2">Tên: {{$user->name}}</span>
                                            <span class="text-gray-600 font-size-2">Email: {{$user->email}}</span>
                                            <span class="text-gray-600 font-size-2">Số điện thoại: {{$user->phone_number}}</span>
                                        </address>
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="font-weight-medium font-size-22 mb-3">Người nhận hàng
                                    </h6>
                                    <address class="d-flex flex-column mb-0">
                                        <span class="text-gray-600 font-size-2">Tên: {{$shipInfo->receiver_name}}</span>
                                        <span class="text-gray-600 font-size-2">Email: {{$shipInfo->receiver_email}}</span>
                                        <span class="text-gray-600 font-size-2">Số điện thoại: {{$shipInfo->receiver_phone_number}}</span>
                                        <span class="text-gray-600 font-size-2">Khu vực: {{$shipInfo->province}}</span>
                                        <span class="text-gray-600 font-size-2">Địa chỉ: {{$shipInfo->address}}</span>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
