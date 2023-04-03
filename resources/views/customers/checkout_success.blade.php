@extends('master')
@section('header-css')
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        button {
            width: 100% !important;
            border-radius: 0 !important;
        }

        button:hover {
            /* color:  */
        }

        .bg-orange {
            background-color: #FF8228 !important;
        }

        .shifts-time {
            display: none;
        }
    </style>
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 p-5">
                <h1>Thông tin thanh toán</h1>
                <div>
                    @if ($order->payment_method == \App\Models\Order::PAYMENT_METHOD_MOMO && $order->status == \App\Models\Order::ORDER_STATUS_PAID)
                        <h4>Bạn đã thanh toán đơn hàng thành công, chúng tôi sẽ sắp xếp người giúp việc và gọi lại cho bạn</h4>
                    @endif
                    @if ($order->payment_method == \App\Models\Order::PAYMENT_METHOD_CASH && $order->status == \App\Models\Order::ORDER_STATUS_PROCESSING)
                        <h4>Bạn đã đặt dịch vụ thành công, chúng tôi sẽ sắp xếp người giúp việc và gọi lại cho bạn</h4>
                    @endif
                    <a href="{{route('home')}}">Trở về trang chủ</a>
                </div>
        </div>
        <div class="row justify-content-center mx-0">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr class="info">
                            <th>Tên dịch vụ</th>
                            <th>Gía</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{$order->service->name}} - {{$order->orderDetails->serviceDetail->name}}</td>
                            <td>{{$order->orderDetails->price}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Địa chỉ: {{sprintf('%s, %s, %s, %s', $order->address, $order->ward->name, $order->district->name, $order->province->name)}}</strong> </td>
                        </tr>
                        <tr>
                            @php
                                $time = $order->orderDetails->shifts;
                                $hour = $time->format('H');
                                $minute = $time->format('i');

                                $dateWork = $order->orderDetails->date_work;
                                $dayStr = \App\Models\Order::convertToDayVi[$dateWork->dayOfWeek];

                                $day = $dateWork->format('d');
                                $month = $dateWork->format('m');
                                $year = $dateWork->format('Y');
                            @endphp
                            <td colspan="2"><strong>Thời gian: {{sprintf('%s:%s, %s - %s/%s/%s', $hour, $minute, $dayStr, $day, $month, $year)}}</strong> </td>
                        </tr>
                        <tr>
                            <td colspan="2">Trạng thái đơn hàng: <b>{{$order->status == 3 ? 'Đã thanh toán' : 'Chờ thanh toán'}}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-left"><strong>Tổng tiền: {{$order->total}}</strong> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('footer-js')

@endsection
