<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $provinces = Province::all();
        return view('customers.booking', compact('provinces'));
    }
}
