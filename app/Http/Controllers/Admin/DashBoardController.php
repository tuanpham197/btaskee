<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
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

    public function listVoucher()
    {
        $vouchers = Voucher::whereIn('type', [Voucher::TYPE_MONEY, Voucher::TYPE_PERCENT])->paginate(20);
        return view('admin.vouchers.list', compact('vouchers'));
    }

    public function addView()
    {
        $now = Carbon::now()->format('Y-m-d');
        return view('admin.vouchers.add', compact('now'));
    }

    public function storeVoucher(VoucherRequest $request)
    {
        $input = $request->validated();
        Voucher::create($input);

        return redirect()->route('list-voucher');
    }

    public function editView($voucherId)
    {
        $now = Carbon::now()->format('Y-m-d');
        $voucher = Voucher::find($voucherId);
        return view('admin.vouchers.edit', compact('voucher', 'now'));
    }

    public function updateVoucher(VoucherRequest $request, $voucherId)
    {
        $voucher = Voucher::find($voucherId);
        $input = $request->validated();
        $voucher->name = $input['name'];
        $voucher->point = $input['point'];
        $voucher->number = $input['number'];
        $voucher->expried_at = $input['expried_at'];
        $voucher->save();

        return redirect()->route('list-voucher');
    }

    public function deleteVoucher($voucherId)
    {
        $voucher = Voucher::find($voucherId);
        $voucher->delete();
        return redirect()->route('list-voucher');
    }
}
