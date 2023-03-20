@extends('master')
@section('header-css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>

    <style>
        button {
            width: 100% !important;
            border-radius: 0 !important;
        }

        button:hover {
            /* color:  */
        }

        .card {
            box-shadow: 0px 4px 8px 0px #7986CB;
        }

        input {
            padding: 10px 20px !important;
            border: 1px solid #000 !important;
            border-radius: 10px;
            box-sizing: border-box;
            background-color: #616161 !important;
            color: #fff !important;
            font-size: 16px;
            letter-spacing: 1px;
            width: 180px;
        }

        input:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #512DA8;
            outline-width: 0;
        }

        ::placeholder {
            color: #fff;
            opacity: 1;
        }

        :-ms-input-placeholder {
            color: #fff;
        }

        ::-ms-input-placeholder {
            color: #fff;
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0;
        }

        .datepicker {
            background-color: #fff !important;
            color: #FF8228 !important;
            border: none;
            padding: 10px !important;
        }

        .datepicker-dropdown:after {
            border-bottom: 6px solid #FF8228;
            font-weight: 700;
        }

        thead tr:nth-child(3) th {
            color: #FF8228 !important;
            font-weight: bold;
            padding-top: 20px;
            padding-bottom: 10px;
        }
        ::placeholder  {
            color: #FF8228 !important;
        }

        .dow,
        .old-day,
        .day,
        .new-day {
            width: 40px !important;
            height: 40px !important;
            border-radius: 0px !important;
        }

        .old-day:hover,
        .day:hover,
        .new-day:hover,
        .month:hover,
        .year:hover,
        .decade:hover,
        .century:hover {
            border-radius: 6px !important;
            background-color: #eee !important;
            color: #000;
        }

        .active {
            border-radius: 6px !important;
            background-image: linear-gradient(#90CAF9, #64B5F6) !important;
            color: #000 !important;
        }

        .disabled {
            color: #616161 !important;
        }

        .prev,
        .next,
        .datepicker-switch {
            border-radius: 0 !important;
            padding: 20px 10px !important;
            text-transform: uppercase;
            font-size: 20px;
            color: #fff !important;
            opacity: 0.8;
        }

        .prev:hover,
        .next:hover,
        .datepicker-switch:hover {
            background-color: inherit !important;
            opacity: 1;
        }

        .cell {
            border: 1px solid #BDBDBD;
            margin: 2px;
            cursor: pointer;
        }

        .cell:hover {
            border: 1px solid #3D5AFE;
        }

        .cell.select {
            background-color: #3D5AFE;
            color: #fff;
        }

        .fa-calendar {
            color: #fff;
            font-size: 30px;
            padding-top: 8px;
            padding-left: 5px;
            cursor: pointer;
        }
        table tbody>tr:nth-child(odd)>td , table tbody tr:hover>td{
            background-color: inherit !important;
        }
        .bg-orange {
            background-color: #FF8228!important;
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
                <h1>Chọn ngày và ca làm việc</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form autocomplete="off" method="POST" action="/payment">
                    @csrf
                    <div class="row pt-3">
                        <div class="col">
                            <h4>Chọn địa chỉ</h4>
                        </div>
                    </div>
                    <div class="row justify-content-center mx-0">
                        <div class="col-md-12">
                            <div class="card border-0">
                                    <input type="hidden" value="{{$orderDetail->id}}" name="order_detail_id">
                                    <div class="card-header bg-orange">
                                        <div class="mx-0 mb-0 row justify-content-sm-center justify-content-start px-1">
                                            <input type="text" id="dp1" class="datepicker" placeholder="Pick Date"
                                                name="date" readonly><span class="fa fa-calendar"></span>
                                        </div>
                                    </div>
                                    <div class="card-body p-3 p-sm-5">
                                        <div class="row text-center mx-0" id="shifts">
                                            @foreach ($data as $key => $shift)
                                            <div class="col-md-2 col-4 m-1 px-2">
                                                <input type="radio" value="{{$shift}}" id="test_{{$key}}" class="shifts-time" name="times">
                                                <div class="cell p-2"><label for="test_{{$key}}">{{$shift}}</label></div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="bubmit" class="">Checkout</button>
                        </div>
                    </div>
                </form>
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
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                startDate: '0d'
            });
            $('.datepicker').datepicker('setDate', 'today');

            $(".datepicker")
            .datepicker()
            .on("change", function(event) {
                generateShiftsRange(event.target.value)
            });

            $('.cell').click(function() {
                $('.cell').removeClass('select');
                $(this).addClass('select');
            });

            // generateShiftsRange(createDayCurrent())
        });

        function generateShiftsRange(date) {

            let url = 'shift-range?date_work=' + date
            console.log(url, 'Debug ')
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    $('#shifts').html(data);
                }
            });
        }

        function createDayCurrent() {
            const currentDate = new Date();
            // Get the year, month and day from the current date
            const year = currentDate.getFullYear();
            const month = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Month is zero-indexed, so add 1
            const day = ('0' + currentDate.getDate()).slice(-2);

            // Format the date as "YYYY-MM-DD"
            const formattedDate = `${day}-${month}-${year}`;
            return formattedDate;
        }

        const characterList = document.querySelector('.cell')
        characterList.addEventListener('click', toggleDone)

        function toggleDone (event) {
            if (!event.target.matches('.cell')) return
            console.log(event.target)
            //We now have the correct input - we can manipulate the node here
        }
    </script>
@endsection
