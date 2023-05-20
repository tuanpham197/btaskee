<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to our website</title>
</head>
<body>
    @php
        $time = $order->orderDetails->shifts;
        $hour = $time->format('H');
        $minute = $time->format('i');

        $dateWork = $order->orderDetails->date_work;
        $dayStr = \App\Models\Order::convertToDayVi[$dateWork->dayOfWeek];

        $day = $dateWork->format('d');
        $month = $dateWork->format('m');
        $year = $dateWork->format('Y');
    @endphp
    <p>Tên khác hàng: {{ $order->user->username ?? '' }}</p>
    <p>Email: {{ $order->user->username ?? '' }}</p>
    <p>Số điện thoại: {{ $order->user->phone_number ?? '' }}</p>
    <p>Địa chỉ: <strong>
            {{ sprintf('%s, %s, %s, %s', $order->address, $order->ward->name, $order->district->name, $order->province->name) }}
    </p>
    <p>Thời gian: {{sprintf('%s:%s, %s - %s/%s/%s', $hour, $minute, $dayStr, $day, $month, $year)}}</p>
</body>
</html>
