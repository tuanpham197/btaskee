<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceDetail;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    const SERVICE_ONE = 1;
    const SERVICE_TWO = 2;

    public function getListService(Request $request)
    {
        $services = Service::all();
    }

    /**
     * @param $id int
     */
    public function detail($id, Request $request)
    {
        $service = Service::with('details')->find($id);

        $view = $id == self::SERVICE_ONE ? 'customers.service_one' : 'customers.service_two';
        return view($view, compact('service'));
    }

    public function ajaxDetailList(Request $request, $serviceId)
    {
        $selected = $request->only('selected')['selected'] ?? 1;
        $details = ServiceDetail::where('service_id', $serviceId)->get();
        return view('ajax.service_details', compact('details', 'selected'));
    }
}
