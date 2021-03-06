@extends("web::layouts.master")

@section("content")
    <main id="content" class="mt-13">
        <div class="container">
            <div class="row">
                <div class="col-md-2 border-right">
                    <h6 class="font-weight-medium font-size-7 pt-5 pt-lg-8  mb-5 mb-lg-7">Tài khoản của tôi</h6>
                    <div class="tab-wrapper">
                        <ul class="my__account-nav nav flex-column mb-0" role="tablist" id="pills-tab">
{{--                            <li class="nav-item mx-0">--}}
{{--                                <a class="nav-link d-flex align-items-center px-0 active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="false">--}}
{{--                                    <span class="font-weight-normal text-gray-600">Thông tin cá nhân</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li class="nav-item mx-0">
                                <a class="nav-link d-flex align-items-center px-0" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                    <span class="font-weight-normal text-gray-600">Lịch sử mua hàng</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="tab-content" id="pills-tabContent">
{{--                        <div class="tab-pane fade show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">--}}
{{--                            <div class="pt-5 pt-lg-8 pl-md-5 pl-lg-9 space-bottom-2 space-bottom-lg-3 mb-xl-1">--}}
{{--                                <h6 class="font-weight-medium font-size-7 ml-lg-1 mb-lg-8 pb-xl-1">Thông tin cá nhân</h6>--}}
{{--                                <div class="ml-lg-1 mb-4">--}}
{{--                                    <span class="font-size-22">Hello {{$user->name}}</span>--}}
{{--                                </div>--}}
{{--                                <div class="mb-4">--}}
{{--                                    <p class="mb-0 font-size-2 ml-lg-1 text-gray-600">From your account dashboard you can view your <span class="text-dark">recent orders,</span> manage your <span class="text-dark">shipping and billing addresses,</span> and edit your <span class="text-dark">password and account details.</span></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="tab-pane fade show active" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab">
                            <div class="pt-5 pl-md-5 pt-lg-8 pl-lg-9 space-bottom-lg-2 mb-lg-4">
                                <h6 class="font-weight-medium font-size-7 ml-lg-1 mb-lg-8 pb-xl-1">Lịch sử mua hàng</h6>
                                <table class="table">
                                    <thead>
                                    <tr class="border">
                                        <th scope="col" class="py-3 border-bottom-0 font-weight-medium pl-3 pl-lg-5">Mã đơn hàng</th>
                                        <th scope="col" class="py-3 border-bottom-0 font-weight-medium">Ngày mua hàng</th>
                                        <th scope="col" class="py-3 border-bottom-0 font-weight-medium">Tổng tiền</th>
                                        <th scope="col" class="py-3 border-bottom-0 font-weight-medium">Trạng thái đơn hàng</th>
                                        <th scope="col" class="py-3 border-bottom-0 font-weight-medium text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                    <tr class="border">
                                        <th class="pl-3 pl-md-5 font-weight-normal align-middle py-6">{{$order->order_no}}</th>
                                        <td class="align-middle py-5">{{$order->ordered_at}}</td>
                                        <td class="align-middle py-5">{{\App\Helpers\format_currency($order->order_amount * VAT + $order->shipping_amount)}}</td>
                                        <td class="align-middle py-5">{{ORDER_STATUS_MESSAGES[$order->order_status]}}</td>
                                        <td class="align-middle py-5">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{route('account.order.detail', $order->id)}}" class="btn btn-dark rounded-0 btn-wide font-weight-medium mr-1" style="color: white">Xem
                                                </a>
                                                @if($order->order_status != ORDER_SUCCESS && $order->order_status != ORDER_FAILURE)
                                                <a href="javascript:;" onclick="cancelOrder({{$order->id}})" class="btn btn-dark rounded-0 btn-wide font-weight-medium" style="color: white">Hủy đơn
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function cancelOrder(orderId) {
            if(confirm('Bạn chắc chắn muốn hủy đơn hàng này ?')) {
                console.log(11);
                $.ajax({
                    url: "{{route('order.cancel')}}",
                    type:'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order_id: orderId
                    },
                    success: function(result){
                        if(result.status) {
                            alert("Hủy đơn hàng thành công");
                            location.reload();
                        } else {
                            alert("Hủy đơn hàng không thành công");
                        }
                    },
                });
            }
        }
    </script>
@endsection
