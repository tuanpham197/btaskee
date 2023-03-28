@extends('admin.master')

@section('admin-content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>

                <!-- Content Row -->
                @include('admin.bade')

                <!-- Content Row -->

                <div class="row">
                    <div class="col-md-12">
                        <h4>Thông tin đơn hàng mã số: <b>{{ $order->id }}</b></h4>
                    </div>
                    <div class="col-md-4 mb-3">
                        <form action="{{route('assign-worker-post', $order->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            <div class="row" style="align-items: end;">
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">Chọn người giúp việc</label>
                                    <select class="form-control " name="worker_id">
                                        <option value="">-- Vui lòng chọn --</option>
                                        @foreach ($workers as $user)
                                            <option value="{{ $user->id }}" {{$order->worker_id == $user->id ? 'selected' : ''}}>{{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" type="submit">Assign</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên dịch vụ</th>
                                <th>Total</th>
                                <th>User đặt dịch vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$order->service->name}}</td>
                                <td>{{number_format($order->total, 0, ',', '.');}} VND</td>
                                <td>{{$order->user->username ?? ''}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
