<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\VoucherRequest;
use App\Mail\WelcomeEmail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            ->paginate(10);
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
        $order = Order::with('service', 'province', 'district', 'ward', 'user', 'worker')
            ->where('id', $orderId)
            ->first();

        if (empty($order)) {
            return redirect()->route('admin-home');
        }
        $input = $request->only('worker_id');
        $workerId = $input['worker_id'] ?? '';
        $order->worker_id = $workerId;
        $order->save();

        $user = User::find($workerId);

        $to = $user->email;
        $subject = 'Bạn vừa được chỉ định một công việc';

        Mail::to($to)->send(new WelcomeEmail($order, $subject));

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

        if (isset($input['image'])) {
            $image = $input['image'];
            $path = $image->store('/');
            $input['image'] = $path;
        }
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
        if (isset($input['image'])) {
            $image = $input['image'];
            $path = $image->store('/');
            $voucher->image = $path;
        }

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

    public function listUser()
    {
        $users = User::whereIn('role', [2,3])
            ->latest()
            ->paginate(10);

        return view('admin.users.list', compact('users'));
    }

    public function updateUser(UserRequest $request, $userId)
    {
        $user = User::find($userId);
        $input = $request->validated();
        $user->phone_number = $input['phone_number'];
        $user->role = $input['role'];

        $user->save();

        return redirect()->route('list-user');
    }


    public function editUser($userId)
    {
        $user = User::find($userId);
        return view('admin.users.edit', compact('user'));
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        $user->delete();
        return redirect()->route('list-user');
    }

    public function listServices()
    {
        $data = Service::all();
        $message = session('message') ?? '';
        return view('admin.services.list', compact('data', 'message'));
    }

    public function detailServices($id)
    {
        $service = Service::with('details')
            ->where('id', $id)
            ->first();

        $message = session('message') ?? '';

        return view('admin.services.detail', compact('service', 'message'));
    }

    public function detailChildServices($serviceId, $serviceDetailId)
    {
        $detail = ServiceDetail::where('id', $serviceDetailId)->first();
        return view('admin.services.details.edit', compact('detail'));
    }

    public function updateChildSerivce(Request $request, $detailId)
    {
        $input = $request->all();

        $detail =  ServiceDetail::find($detailId);
        if (!$detail) {
            return redirect()->route('home');
        }

        $detail->name = $input['name'];
        $detail->price = $input['price'];
        $detail->area = $input['area'];
        $detail->people = $input['people'];
        $detail->hours = $input['hours'];
        $detail->room = $input['room'];
        $detail->save();

        return redirect()->route('detail-service', $detail->service_id);
    }

    public function deleteChildSerivce($detailId)
    {

        // check order detail
        $check = OrderDetail::where('service_detail_id', $detailId)->first();
        if ($check) {
            return redirect()->route('detail-service', $detailId)->with('message', 'Chi tiết dịch vụ đang tồn tại thông tin đơn hàng, không thể xóa');
        }

        $detail =  ServiceDetail::find($detailId);
        $detail->delete();
        return redirect()->route('list-service');
    }

    public function deleteService($serviceId)
    {
        $check = Order::where('service_id', $serviceId)->first();
        if ($check) {
            return redirect()->route('list-service')->with('message', 'Chi tiết dịch vụ đang tồn tại thông tin đơn hàng, không thể xóa');
        }

        $detail =  Service::find($serviceId);
        $detail->delete();
        return redirect()->route('list-service');
    }

    public function storeService(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $input = $request->all();

        $input['thumbnail'] = '';
        $input['created_at'] = Carbon::now();

        Service::create($input);

        return redirect()->route('list-service');
    }

    public function storeServiceView()
    {
        return view('admin.services.add');
    }


    public function detailAdd($serviceId)
    {
        return view('admin.services.details.add', compact('serviceId'));
    }

    public function storeDetailService(Request $request, $serviceId)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $input = $request->all();
        $input['service_id'] = $serviceId;

        ServiceDetail::create($input);

        return redirect()->route('list-service');
    }
}
