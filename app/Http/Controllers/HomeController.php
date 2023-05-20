<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $point = Auth::user()->point ?? 0;
        return view('customers.home', compact('services', 'point'));
    }
}
