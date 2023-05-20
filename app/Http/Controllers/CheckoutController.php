<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        $data = $request->only('payment_method', 'total', 'order_id', 'voucher');
        $paymentMethod = $data['payment_method'] ?? 2;
        $total = $data['total'];
        $orderId = $data['order_id'];
        if (isset($data['voucher'])) {
            $voucher = Voucher::find($data['voucher']);
            if ($voucher) {
                if ($voucher->type == Voucher::TYPE_MONEY) {
                    $total = $total - $voucher->number;
                } else {
                    $total = $total - (($total * $voucher->number) * 100);
                }
            }
        }

        switch ($paymentMethod) {
            case 1:
                $redirectUrl = $this->payWithMomo($orderId, $total);
                return redirect($redirectUrl);
                break;
            case 2:
                return $this->payWithCash($orderId, $total);
                break;
            case 3:
                return $this->checkoutByVNPay($orderId, $total);
                break;
            default:
                return redirect()->route('home');
                break;
        }
    }

    private function payWithMomo($orderId, $total)
    {
        try {

            DB::beginTransaction();

            $url = URL::to('/');
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $total;
            $redirectUrl =  $url . '/checkout-success';
            $ipnUrl = $url . '/checkout-ipn';
            $extraData = "";
            $order = Order::find($orderId);
            $order->payment_method = Order::PAYMENT_METHOD_MOMO;
            $order->save();
            $orderId = $orderId . '_' . time(); // Mã đơn hàng

            $requestId = time() . "";
            $requestType = "payWithATM";
            // $requestType = "captureWallet";
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json

            //Just a example, please check more in there
            DB::commit();
            return $jsonResult['payUrl'];
        } catch (\Exception $e) {
            Log::error('ORDER FAIL: ' . $e->getMessage());
            return redirect()->route('home');
        }
    }

    public function payWithCash($orderId, $total)
    {
        try {
            $order = Order::with('orderDetails', 'province', 'district', 'ward', 'service')->find($orderId);
            $order->payment_method = Order::PAYMENT_METHOD_CASH;
            $order->save();
            return view('customers.checkout_success', compact('order'));
        } catch (\Exception $e) {
            Log::error('ORDER FAIL: ' . $e->getMessage());
            return redirect()->route('home');
        }
    }

    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        echo ($result);
        $jsonResult = json_decode($result, true);
        if ($jsonResult['payUrl'] != null)
            header('Location: ' . $jsonResult['payUrl']);
        return $result;
    }

    public function checkoutSuccess(Request $request)
    {
        try {
            // http://btaskee.local/checkout-success?partnerCode=MOMOBKUN20180529&orderId=27_1679159221&requestId=1679159221&amount=720000&orderInfo=Thanh+to%C3%A1n+qua+MoMo&orderType=momo_wallet&transId=2937335899&resultCode=0&message=Successful.&payType=napas&responseTime=1679159287643&extraData=&signature=a59354d19c6f50d7070406826faeb4304ae6fbfe297790a85859bc1b9ba98ec9
            $dataRequest = $request->only('orderId', 'resultCode', 'message');

            $strOrderInfo = explode('_', $dataRequest['orderId']);
            $orderId = $strOrderInfo[0] ?? '';
            if (empty($orderId)) {
                return redirect()->route('booking');
            }

            if ($dataRequest['resultCode'] == '0') {
                $order  = Order::with('orderDetails', 'province', 'district', 'ward', 'service')->find($orderId);
                $order->status = Order::ORDER_STATUS_PAID;
                $order->save();
                return view('customers.checkout_success', compact('order'));
            }
        } catch (\Throwable $th) {
            $message = $dataRequest['message'] ?? '';
            return view('customers.checkout_fail', compact('message'));
        }
    }

    public function checkoutIPN(Request $request)
    {
        dd($request->all());
    }

    public function checkoutByVNPay($orderId, $total)
    {
        $url = URL::to('/');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = $url . "/checkout-vnpay-success";
        $vnp_TmnCode = env('VNP_TMNCODE'); //Mã website tại VNPAY
        $vnp_HashSecret = env('VNP_HASHSECRET'); //Chuỗi bí mật
        $vnp_TxnRef = $orderId; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "test";
        $vnp_OrderType = "1";
        $vnp_Amount = $total * 100;
        $vnp_Locale = "vn";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];



        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        if (!empty($vnp_Url)) {
            header('Location: ' . $vnp_Url);
            die();
        }
    }
    public function checkoutVNPaySuccess(Request $request)
    {
        try {
            // http://btaskee.local/checkout-vnpay-success?vnp_Amount=18600000&vnp_BankCode=NCB&vnp_BankTranNo=VNP14014844&vnp_CardType=ATM&vnp_OrderInfo=test&vnp_PayDate=20230517211841&vnp_ResponseCode=00&vnp_TmnCode=6NLD0XGO&vnp_TransactionNo=14014844&vnp_TransactionStatus=00&vnp_TxnRef=94&vnp_SecureHash=081f2310b7e0038e429e96fda9e500a80c0ef7c098f0518c6c365e9295740181d468092c9e167cc0c97624a0f16ab89315aaba6dd1aa874e1e35f33e09158a0c
            $dataRequest = $request->only('vnp_TxnRef', 'vnp_ResponseCode', 'vnp_TransactionNo');

            $orderId = $dataRequest['vnp_TxnRef'] ?? '';
            if (empty($orderId)) {
                return redirect()->route('booking');
            }

            if ($dataRequest['vnp_ResponseCode'] == '00') {

                $order  = Order::with('orderDetails', 'province', 'district', 'ward', 'service')->find($orderId);
                $order->status = Order::ORDER_STATUS_PAID;
                $order->save();
                return view('customers.checkout_success', compact('order'));
            }
        } catch (\Throwable $th) {
            $message = $dataRequest['message'] ?? '';
            return view('customers.checkout_fail', compact('message'));
        }
    }
}
