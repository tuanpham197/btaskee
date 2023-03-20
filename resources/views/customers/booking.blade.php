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
    </style>
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 p-5">
                <h1>Đặt dịch vụ</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/booking" method="POST">
                    @csrf
                    <div class="row pt-3">
                        <div class="col">
                            <h4>Chọn địa chỉ</h4>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Tỉnh thành </label>
                            <select id="provinces" class="form-select form-select-md mb-3" aria-label=".form-select-md example" name="province_id">
                                <option value="">-- Chọn tỉnh thành --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" {{$province->id == old('province_id') ? 'selected' : ''}}>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Quận huyện </label>
                            <select id="districts" class="form-select form-select-md mb-3" aria-label=".form-select-md example" name="district_id">
                                <option value="">-- Chọn quận huyện --</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Phường xã</label>
                            <select id="wards" class="form-select form-select-md mb-3" aria-label=".form-select-md example" name="ward_id">
                                <option value="">-- Chọn phường xã --</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Số nhà / tên đường</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="address"
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
                                <select id="services" class="form-select form-select-md mb-3" aria-label=".form-select-md example" name="service_id">
                                    <option selected>--- Chọn dịch vụ ----</option>
                                    @foreach ($services as $service)
                                        <option value="{{$service->id}}" {{old('service_id') == $service->id ? 'selected' : ''}}>{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Gói dich vu</label>
                                <div id="service_details">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="">Info</button>
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
        let oldProvinceId = '{{old("province_id")}}'
        let oldDistrictId = '{{old("district_id")}}'
        let oldWardId = '{{old("ward_id")}}'
        let serviceId = '{{old("service_id")}}'
        let serviceDetailId = '{{old("service_detail_id")}}'

        $(document).ready(function() {
            $('#provinces').change(function() {
                $('#districts').html('');
                $('#wards').html('');
                var provinceId = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route("ajax.districts", ":provinceId") }}'.replace(':provinceId', provinceId),
                    success: function(data) {
                        $('#districts').html(data);
                    }
                });
            });

            if (oldProvinceId) {
                generateDistrict(oldProvinceId, oldDistrictId)
            }
            if (oldDistrictId) {
                generateWard(oldDistrictId, oldWardId)
            }

            if (serviceId) {
                generateService(serviceId, serviceDetailId)
            }

            $('#districts').change(function() {
                $('#wards').html('');
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

        function generateDistrict(provinceId, oldDistrictId) {
            let url = ''
            if (oldDistrictId) {
                url = 'address/district/:provinceId?selected=:oldDistrictId'.replace(':provinceId', provinceId).replace(':oldDistrictId', oldDistrictId)
            } else {
                url = 'address/district/:provinceId'.replace(':provinceId', provinceId)
            }
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    $('#districts').html(data);
                }
            });
        }

        function generateWard(districtId, oldWardId) {
            let url = ''
            if (oldWardId) {
                url = 'address/ward/:districtId?selected=:oldWardId'.replace(':districtId', districtId).replace(':oldWardId', oldWardId)
            } else {
                url = 'address/ward/:districtId'.replace(':districtId', districtId)
            }
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    $('#wards').html(data);
                }
            });
        }

        function generateService(serviceId, oldServiceDetailId) {
            let url = ''
            if (oldServiceDetailId) {
                url = 'services-detail/:serviceId?selected=:oldServiceDetailId'.replace(':serviceId', serviceId).replace(':oldServiceDetailId', oldServiceDetailId)
            } else {
                url = 'services-detail/:serviceId'.replace(':serviceId', serviceId)
            }
            $.ajax({
                type: 'GET',
                url,
                success: function(data) {
                    $('#service_details').html(data);
                }
            });
        }


    </script>
@endsection
