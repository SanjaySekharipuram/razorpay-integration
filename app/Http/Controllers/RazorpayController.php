<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Log;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;

class RazorpayController extends Controller
{
    protected $razorpay;

    public function __construct()
    {
        $this->razorpay = new Api(config('razorpay.key'), config('razorpay.secret'));
    }

    public function formPage()
    {
        return view('payment');
    }

    public function makeOrder(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'name' => 'required'
        ]);

        try {
            $amount = $request->amount;
            $name = $request->name;

            $orderData = [
                'receipt'         => 'rcptid_11',
                'amount'          => $amount * 100, //rupees in paise
                'currency'        => 'INR'
            ];

            $razorpayOrder = $this->razorpay->order->create($orderData);

            $payment = new Payment();
            $payment->amount = $amount;
            $payment->name = $name;
            $payment->razorpay_order_id = $razorpayOrder['id'];
            $payment->save();
        } catch (Exception $e) {
            $errorMessage = 'An error occurred. Please try again later.';
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(new MessageBag(['error' => $e->getMessage()]));
        }
        return view('order_details', compact('razorpayOrder'));
    }

    public function pay(Request $request)
    {
        $paymentId = $request->payment_id;
        $razorpayOrderId = $request->razorpay_order_id;
        $payment = $this->razorpay->payment->fetch($paymentId);
        
        $payment_status = Payment::where('razorpay_order_id', $razorpayOrderId)->first();
        
        if ($payment->status == 'captured') {
            $payment_status->payment_done = true;
            $payment_status->razorpay_payment_id = $paymentId;
            $payment_status->save();
        }
        return Redirect::route('payment');
    }
}
