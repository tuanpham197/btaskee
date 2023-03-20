<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\URL;
use Omnipay\Omnipay;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $uuid = Uuid::uuid4();
        $data = $request->only('payment_method', 'total', 'order_id');
        $paymentMethod = $data['payment_method'] ?? 2;
        $total = $data['total'];
        $orderId = $data['order_id'];

        switch ($paymentMethod) {
            case 1:
                $redirectUrl = $this->payWithMomo($orderId, $total);
                return redirect($redirectUrl);
                break;

            default:
                # code...
                break;
        }

    }

    private function payWithMomo($orderId, $total)
    {
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
        $orderId = $orderId . '_' . time(); // Mã đơn hàng

        $requestId = time() . "";
        // $requestType = "payWithATM";
        $requestType = "captureWallet";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
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
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there

        return $jsonResult['payUrl'];
    }

    public function payWithCash($orderId, $total)
    {

    }

    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        echo($result);
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
                $order  = Order::find($orderId);
                $order->status = Order::ORDER_STATUS_PAID;
                $order->save();
                return view('customers.checkout_success');
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

    public function test()
    {
        $url = URL::to('/');

        dd($url);
    }
}
