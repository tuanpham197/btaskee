@extends('master')
@section('header-css')
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 p-5">
                <h1>My First Bootstrap Page</h1>
                <form action="">
                    <div class="row pt-3">
                        <div class="col">
                            <h4>Chọn địa chỉ</h4>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Tỉnh thành </label>
                            <select id="provinces" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
                                <option value="">-- Chọn tỉnh thành --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Quận huyện </label>
                            <select id="districts" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
                                <option value="">-- Chọn quận huyện --</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Phường xã</label>
                            <select id="wards" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
                                <option value="">-- Chọn phường xã --</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Số nhà / tên đường</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Nhập địa chỉ chi tiết">
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col">
                            <h4>Chọn service</h4>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Service</label>
                                <select id="services" class="form-select form-select-md mb-3" aria-label=".form-select-md example">
                                    <option selected>--- Chọn dịch vụ ----</option>
                                    @foreach ($services as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Goi dich vu</label>
                                <div id="service_details">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-info">Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
@section('footer-js')
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#provinces').change(function() {
                var provinceId = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route("ajax.districts", ":provinceId") }}'.replace(':provinceId', provinceId),
                    success: function(data) {
                        $('#districts').html(data);
                    }
                });
            });

            $('#districts').change(function() {
                var districtId = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route("ajax.wards", ":districtId") }}'.replace(':districtId', districtId),
                    success: function(data) {
                        $('#wards').html(data);
                    }
                });
            });

            $('#services').change(function() {
                var serviceId = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route("ajax.services", ":serviceId") }}'.replace(':serviceId', serviceId),
                    success: function(data) {
                        $('#service_details').html(data);
                    }
                });
            });

        });

    </script>
@endsection
