<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStep1Request;
use App\Http\Requests\ShiftRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Province;
use App\Models\ServiceDetail;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $provinces = Province::all();
        return view('customers.booking', compact('provinces'));
    }

    public function detail(Request $request, $bookingId)
    {
        $order = Order::with([
            'orderDetails.serviceDetail',
            'service',
            'province',
            'district',
            'ward'
        ])->find($bookingId);

        $voucherUsers = Voucher::where('expried_at', '>', Carbon::now())
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                  ->from('user_vouchers')
                  ->where('user_id', Auth::user()->id);
            })
            ->get();

        return view('customers.payment', compact('order', 'voucherUsers'));
    }

    public function booking(BookingStep1Request $request)
    {
        $input = $request->validated();

        try {
            DB::beginTransaction();
            $serviceDetail = ServiceDetail::where('id', $input['service_detail_id'])
                ->first();

            // create order draft
            $dataOrder = [
                'total' => $serviceDetail->price ?? 0,
                'address' => $input['address'] ?? '',
                'ward_id' => $input['ward_id'],
                'district_id' => $input['district_id'],
                'province_id' => $input['province_id'],
                'status' => Order::ORDER_STATUS_DRAFT,
                'payment_method' => null,
                'service_id' => $input['service_id'] ?? null,
                'user_id' => Auth::user()->id
            ];

            $order = Order::create($dataOrder);

            // create order detail (need update info in next step)
            $dataDetailOrder = [
                'order_id' => $order->id,
                'service_detail_id' => $input['service_detail_id'] ?? null,
                'price' => $serviceDetail->price ?? 0
            ];
            $orderDetail = OrderDetail::create($dataDetailOrder);
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            abort(404);
        }

        $dataRes = [
            'order' => $order,
            'orderDetail' => $orderDetail
        ];

        return redirect()->route('shifts')->with('data', $dataRes);
    }

    public function shifts()
    {
        $dataRedirect = session()->get('data') ?? '';
        $data = $this->generateRangeTime();
         if (blank($dataRedirect)) {
            return redirect()->route('render-shifts');
        }

        $order = $dataRedirect['order'];
        $orderDetail = $dataRedirect['orderDetail'];

        return view('customers.shifts', compact('data', 'order', 'orderDetail'));
    }

    public function payment(ShiftRequest $request)
    {
        try {
            DB::beginTransaction();
            $shifts = $request->validated();
            $serviceDetail = OrderDetail::where('id', $shifts['order_detail_id'])
                    ->first();

            if (!$serviceDetail) {
                abort(404);
            }
            $order = Order::find($shifts['order_detail_id']);

            $serviceDetail->shifts = $shifts['times'];
            $serviceDetail->date_work = Carbon::createFromFormat('d-m-Y', $shifts['date'])->startOfHour();
            $serviceDetail->save();

            $order->status = Order::ORDER_STATUS_PROCESSING;
            $order->save();
            DB::commit();
            return Redirect::route('detail-booking', [$serviceDetail->order_id]);
        } catch (\Exception $th) {
            Log::error('ERROR: '. $th->getMessage());
            DB::rollBack();
            return redirect()->route('render-shifts');
        }

        // return view('customers.payment', compact('serviceDetail'));
    }

    private function generateRangeTime($dateSelected='24-03-2023')
    {
        $date = Carbon::createFromFormat('d-m-Y',$dateSelected)->startOfHour();
        $now = Carbon::now()->startOfHour()->addHour(1);
        $data = [];
        $check = $date->gt($now);
        $startTime = Carbon::now()->startOfDay()->addHours(5);
        $cutTime = Carbon::now()->endOfDay()->subHours(3);
        if (!$check) {
            $startTime = Carbon::now()->startOfHour();
        }
        $intervals = CarbonPeriod::since($startTime)->hours(1)->until($cutTime)->toArray();
        foreach ($intervals as $interval) {
            array_push($data, $interval->format('H:i'));
        }
        return $data;
    }

    public function generateRangeTimeAjax(Request $request)
    {
        $data = $request->only('date_work');
        $shifts = $this->generateRangeTime($data['date_work']);
        return view('ajax.shifts_range', compact('shifts'));
    }

    public function renderPayment(Request $request)
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect()->route('login');
        }

        $order = Order::with('orderDetails')
                    ->where('user_id', $user->id)
                    ->where('status', Order::ORDER_STATUS_DRAFT)
                    ->latest()
                    ->first();
        $orderDetail = $order->orderDetails[0] ?? null;
        if (empty($orderDetail)) {
            return redirect()->route('booking');
        }
        $data = $this->generateRangeTime();
        return view('customers.shifts', compact('data', 'order', 'orderDetail'));

    }
}
