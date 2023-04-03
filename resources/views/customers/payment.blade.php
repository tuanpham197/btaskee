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
                <h1>Thanh toán</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form autocomplete="off" method="POST" action="/checkout">
                    @csrf
                    <div class="row pt-3">
                        <div class="col">
                            <h4>Thông tin đặt dịch vụ</h4>
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
                                        <td colspan="2" class="text-left"><strong>Tổng tiền: {{$order->total}}</strong> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Chọn phương thức thanh toán</h5>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            <input type="hidden" name="total" value="{{$order->total}}">
                            <div class="form-check">
                                <input class="form-check-input" value="1" type="radio" name="payment_method"
                                    id="payment_method_1">
                                <label class="form-check-label" for="payment_method_1">
                                    <img src="{{asset('images/icon-payment-method-momo.svg')}}" alt=""> Thanh toán bằng ví MoMo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="2" type="radio" name="payment_method"
                                    id="payment_method_2">
                                <label class="form-check-label" for="payment_method_2">
                                    <img src="{{asset('images/icon-payment-method-cod.svg')}}" alt=""> Thanh toán tiền mặt khi hoàn thành
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col">
                            <button type="bubmit" class="">Thanh toán</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
@section('footer-js')
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script> --}}
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
