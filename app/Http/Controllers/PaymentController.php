<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class PaymentController extends Controller
{
    public function charge(Request $request,$price)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'company' => 'required',
            'pnumber' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'compemailany' => 'required',
            'country' => 'required',
            'add1' => 'required',
            'add2' => 'required',
            'district' => 'required',
            'zip' => 'required'
        ]);
 
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }
        
        $user = Auth::user();
        return view('frontend/payment',[
            'user'=>$user,
            'intent' => $user->createSetupIntent(),
            'price' => $price
        ]);
    }

    public function processPayment(Request $request, $price)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        try
        {
        $user->charge($price, $paymentMethod);
        }
        catch (\Exception $e)
        {
        return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        //session()->get('cart', []);
        session()->forget('cart');
        return redirect('dashboard');
    }
}
