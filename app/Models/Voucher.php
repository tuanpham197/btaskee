<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    const TYPE_MONEY = 1;
    const TYPE_PERCENT = 2;
    use HasFactory;

    protected $fillable = [
        'name',
        'point',
        'number',
        'type',
        'expried_at',
        'image'
    ];
}
