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
                        <h4>Thêm mới voucher</b></h4>
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
                        <form action="{{ route('update-voucher', $voucher->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên voucher</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$voucher->name}}">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Loại voucher</label>
                                <select class="form-control" aria-label="Default select example" name="type">
                                    <option selected>Chọn ...</option>
                                    <option value="1" {{$voucher->type == 1 ? 'selected' : ''}}>Tiền</option>
                                    <option value="2" {{$voucher->type == 2 ? 'selected' : ''}}>Discount %</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Số tiền/ Phần trăm</label>
                                <input type="number" class="form-control" id="name" name="number" value="{{$voucher->number}}">
                            </div>
                            <div class="form-group">
                                <label for="name">Point</label>
                                <input type="number" class="form-control" id="point" name="point" value="{{$voucher->point}}">
                            </div>
                            <div class="form-group">
                                <label for="name">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <img src="{{asset('images/'.$voucher->image)}}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="expried_at">Ngày hết hạn</label>
                                <input type="date" class="form-control" id="expried_at" name="expried_at"
                                    min="{{ $now }}" value="{{$voucher->expried_at}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
