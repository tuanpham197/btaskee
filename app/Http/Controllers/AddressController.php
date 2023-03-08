<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //

    public function getProvinces()
    {
        $data = Province::all();
        dd($data);
    }
}
