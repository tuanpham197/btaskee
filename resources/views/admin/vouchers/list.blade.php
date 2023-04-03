@extends('admin.master')

@section('admin-content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" style="background-color: white">
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
                        <h4>Danh sách voucher</b></h4>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên voucher</th>
                                <th>Loại voucher</th>
                                <th>Số tiền/ Phần trăm</th>
                                <th>Ngày hết hạn</th>
                                <th>Đổi point</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vouchers as $voucher)
                                <tr>
                                    <td>{{$voucher->name}}</td>
                                    <td>{{$voucher->type == 1 ? 'Tiền' : 'Discount %'}}</td>
                                    <td>{{$voucher->number}}</td>
                                    <td>{{$voucher->expried_at}}</td>
                                    <td>{{$voucher->point}}</td>
                                    <td>
                                        <a href="{{route('edit-view', $voucher->id)}}">
                                            <button class="btn btn-info">Update</button>
                                        </a>
                                        <a href="{{route('delete-voucher', $voucher->id)}}">
                                            <button class="btn btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>{{ $vouchers->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
