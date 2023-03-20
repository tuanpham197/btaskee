<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    //

    public function getProvinces()
    {
        $provinces = Province::all();
        return view('ajax.provinces', compact('provinces'));
    }

    public function getDistricts(Request $request, $provinceId)
    {
        $selected = $request->only('selected')['selected'] ?? 1;
        $districts = District::where('province_id', $provinceId)->get();
        return view('ajax.districts', compact('districts', 'selected'));
    }

    public function getWards(Request $request, $districtId)
    {
        $selected = $request->only('selected')['selected'] ?? 1;
        $districts = Ward::where('district_id', $districtId)->get();
        return view('ajax.districts', compact('districts', 'selected'));
    }
}
