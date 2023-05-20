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
                        <h4>Thông tin chi tiết dịch vụ</b></h4>
                    </div>
                    <div class="col-md-6">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message)
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @endif
                        <form action="{{ route('update-voucher', $service->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên dich vụ</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $service->name }}">
                            </div>


                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-12">
                                <h4>Danh sách chi tiết dịch vụ</b></h4>
                            </div>
                            <a href="{{route('detail-add', $service->id)}}"><button type="submit" class="btn btn-info mb-2">Thêm mới</button></a>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên chi tiết dịch vụ</th>
                                        <th>Giá</th>
                                        <th>Diện tích</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service->details as $detail)
                                        <tr>
                                            <td>{{ $detail->name }}</td>
                                            <td>{{ $detail->price }}</td>
                                            <td>{{ $detail->area }}</td>

                                            <td>
                                                <a href="{{ route('detail-child-service', [$service->id, $detail->id]) }}">
                                                    <button class="btn btn-info">Detail</button>
                                                </a>
                                                <a href="{{ route('delete-child-service', $detail->id) }}">
                                                    <button class="btn btn-danger">Delete</button>
                                                </a>
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
@endsection
