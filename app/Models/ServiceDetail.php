<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'service_id',
        'price',
        'area',
        'people',
        'hours',
        'room',
        'created_at'
    ];

    protected $cats = [
        'created_at'
    ];

    public function getPriceFormatAttribute()
    {
        return number_format($this->price, 0, ',', '.');
    }
}
