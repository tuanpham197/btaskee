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
        'created_at'
    ];

    protected $cats = [
        'created_at'
    ];
}
