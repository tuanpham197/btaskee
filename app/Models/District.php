<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'province_id'
    ];

    public function province()
    {
        return $this->hasOne(Province::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
