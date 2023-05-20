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
                        <h4>Danh sách thành viên</b></h4>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên </th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Chức vụ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $roles = [
                                    1 => 'Admin',
                                    2 => 'Người giúp việc',
                                    3 => 'Admin',
                                ]
                            ?>
                            @foreach ($users as $user)
                                <tr>
                                    <td><a href="{{route('edit-user', $user->id)}}">{{$user->username}}</a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>{{$roles[$user->role ?? 3]}}</td>
                                    <td>
                                        <a href="{{route('edit-user', $user->id)}}">
                                            <button class="btn btn-info">Update</button>
                                        </a>
                                        <a href="{{route('delete-user', $user->id)}}">
                                            <button class="btn btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
