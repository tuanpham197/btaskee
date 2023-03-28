<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index');
    }

    public function orderPaid()
    {
        $orders = Order::with('service', 'user', 'worker')
            ->where('status', Order::ORDER_STATUS_PAID)
            ->latest()
            ->paginate(1);
        return view('admin.orders.paid', compact('orders'));
    }

    public function assignWorkerOrder(Request $request, $orderId)
    {
        $order = Order::with('service', 'province', 'district', 'ward', 'user', 'worker')
            ->where('id', $orderId)
            ->first();

        if (empty($order)) {
            return redirect()->route('admin-home');
        }

        $workers = User::where('role', User::ROLE_WORKER)
            ->whereNotNull('email_verified_at')
            ->get();

        return view('admin.orders.assign', compact('workers', 'order'));
    }

    public function assignWorkerOrderPost(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        if (empty($order)) {
            return redirect()->route('admin-home');
        }
        $input = $request->only('worker_id');
        $workerId = $input['worker_id'] ?? '';
        $order->worker_id = $workerId;
        $order->save();
        return redirect()->route('admin-order-paid');
    }
}
