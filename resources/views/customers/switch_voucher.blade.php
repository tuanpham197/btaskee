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
                <h1>Danh sách voucher</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="card" >
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">Số point: </p>
                              <p class="card-text">Discount: </p>
                              <p class="card-text">Ngày hết hạn: </p>
                              <a href="#" class="btn btn-primary text-white">Đổi</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="card" >
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">Số point: </p>
                              <p class="card-text">Discount: </p>
                              <p class="card-text">Ngày hết hạn: </p>
                              <a href="#" class="btn btn-primary text-white">Đổi</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="card" >
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">Số point: </p>
                              <p class="card-text">Discount: </p>
                              <p class="card-text">Ngày hết hạn: </p>
                              <a href="#" class="btn btn-primary text-white">Đổi</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="card" >
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">Số point: </p>
                              <p class="card-text">Discount: </p>
                              <p class="card-text">Ngày hết hạn: </p>
                              <a href="#" class="btn btn-primary text-white">Đổi</a>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="card" >
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">Số point: </p>
                              <p class="card-text">Discount: </p>
                              <p class="card-text">Ngày hết hạn: </p>
                              <a href="#" class="btn btn-primary text-white">Đổi</a>
                            </div>
                          </div>
                    </div>
                </div>
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
