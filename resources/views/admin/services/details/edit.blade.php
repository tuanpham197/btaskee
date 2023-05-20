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
                        <h4>Chỉnh sửa thông tin chi tiết dịch vụ</b></h4>
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
                        <form action="{{ route('update-child-service', $detail->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên chi tiết dịch vụ</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$detail->name}}">
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label> (VND)
                                <input type="number" class="form-control" id="price" name="price" value="{{$detail->price}}">
                            </div>
                            <div class="form-group">
                                <label for="area">Diện tích</label>(mét vuông)
                                <input type="number" class="form-control" id="area" name="area" value="{{$detail->area}}">
                            </div>

                            <div class="form-group">
                                <label for="people">Số người</label>
                                <input type="number" class="form-control" id="people" name="people" value="{{$detail->people}}">
                            </div>

                            <div class="form-group">
                                <label for="hours">Giờ</label>
                                <input type="number" class="form-control" id="hours" name="hours" value="{{$detail->hours}}">
                            </div>

                            <div class="form-group">
                                <label for="room">Phòng</label>
                                <input type="number" class="form-control" id="room" name="room" value="{{$detail->room}}">
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
