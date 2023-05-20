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
                @if ($message)
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12" style="display: flex; justify-content: space-between; margin-bottom: 20px">
                        <h4>Danh sách dịch vụ</b></h4>
                        <a href="{{route('store-child-view')}}"><button class="btn btn-primary">Add</button></a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên dịch vụ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $services)
                                <tr>
                                    <td>{{$services->name}}</td>

                                    <td>
                                        <a href="{{route('detail-service', $services->id)}}">
                                            <button class="btn btn-info">Detail</button>
                                        </a>
                                        <a href="{{route('delete-service', $services->id)}}">
                                            <button class="btn btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div>{{ $data->links() }}</div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
