<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const ORDER_STATUS_DRAFT = 1;
    const ORDER_STATUS_PROCESSING = 2;
    const ORDER_STATUS_PAID = 3;
    const ORDER_STATUS_FAIL = 4;

    const PAYMENT_METHOD_CASH = 1;
    const PAYMENT_METHOD_MOMO = 2;
    // const PAYMENT_METHOD_BPAY = 3;
    const convertToDayVi = [
        'Thứ Hai',
        'Thứ Ba',
        'Thứ Tư',
        'Thứ Năm',
        'Thứ Sáu',
        'Thứ Bảy',
        'Chủ Nhật',
    ];


    protected $fillable = [
        'total',
        'address',
        'ward_id',
        'province_id',
        'district_id',
        'payment_method',
        'service_id',
        'status',
        'created_at'
    ];

    public function orderDetails()
    {
        return $this->hasOne(OrderDetail::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}