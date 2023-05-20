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
                        <h4>Chinh sửa thông tin user</b></h4>
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
                        <form action="{{ route('update-user', $user->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên người dùng</label>
                                <input type="text" disabled class="form-control" id="name" name="username" value="{{$user->username}}">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" disabled disabled class="form-control" id="email" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="name">Số diện thoại</label>
                                <input type="text" class="form-control" id="name" name="phone_number" value="{{$user->phone_number}}">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Quyền</label>
                                <select class="form-control" aria-label="Default select example" name="role">
                                    <option selected>Chọn ...</option>
                                    <option value="1" {{$user->role == 1 ? 'selected' : ''}}>Admin</option>
                                    <option value="2" {{$user->role == 2 ? 'selected' : ''}}>Người giúp việc</option>
                                    <option value="3" {{$user->role == 3 ? 'selected' : ''}}>Người dùng</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
