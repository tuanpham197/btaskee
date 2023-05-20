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
                    <h4>Đơn hàng đã thanh toán</h4>
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên dịch vụ</th>
                                    <th>Tổng tiền</th>
                                    <th>Tên người giúp việc</th>
                                    <th>Người đặt dịch vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td><a href="{{route('assign-worker', $item->id)}}">{{$item->id}}</a></td>
                                        <td>{{$item->service->name}}</td>
                                        <td>{{number_format($item->total, 0, ',', '.');}} VND</td>
                                        <td>
                                            @if (empty($item->worker))
                                            <a href="{{route('assign-worker', $item->id)}}">
                                                <button class="btn btn-primary">Chọn người giúp việc</button>
                                            </a>
                                            @else
                                                {{$item->worker->username ?? ''}}</td>
                                            @endif
                                        <td>{{$item->user->username ?? ''}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex">
                        {{ $orders->links() }}
                    </div>
                </div>

            </div>
            <div>
                123
            </div>
        </div>
    </div>
@endsection
