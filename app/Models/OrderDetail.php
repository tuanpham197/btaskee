<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'service_detail_id',
        'shifts',
        'date_work',
        'price',
        'created_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'shifts' => 'datetime',
        'date_work' => 'datetime',

    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function serviceDetail()
    {
        return $this->belongsTo(ServiceDetail::class);
    }
}
