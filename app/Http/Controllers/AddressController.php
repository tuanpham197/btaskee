<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //

    public function getProvinces()
    {
        $provinces = Province::all();
        return view('ajax.provinces', compact('provinces'));
    }

    public function getDistricts($provinceId)
    {
        $districts = District::where('province_id', $provinceId)->get();
        return view('ajax.districts', compact('districts'));
    }

    public function getWards($districtId)
    {
        $districts = Ward::where('district_id', $districtId)->get();
        return view('ajax.districts', compact('districts'));
    }
}
