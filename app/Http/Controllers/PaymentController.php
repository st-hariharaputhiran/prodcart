<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductOrders;
use App\Models\ProductOrderItems;
use Auth;
use Redirect;

class PaymentController extends Controller
{
    public function charge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'company' => 'required',
            'pnumber' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'compemailany' => 'required',
            'country' => 'required',
            'add1' => 'required',
            'city' => 'required',
            'district' => 'required',
            'zip' => 'required'
        ],
        [
            'fname.required' => 'Please Enter Your First Name',
            'lname.required' => 'Please Enter Your Last Name',
            'company.required' => 'Please Enter Your Company Name',
            'pnumber.required' => 'Please Enter Your Phone Number',
            'compemailany.required' => 'Please Enter Your Company Email',
            'country.required' => 'Please Select your Country',
            'add1.required' => 'Please Enter Your Address',
            'city.required' => 'Please select your City',
            'district.required' => 'Please select your District',
            'zip.required' => 'Please Enter Your Zipcode'
        ]);
        $validator->validate();
        // if($validator->fails()) {
        //     return Redirect::back()->withErrors($validator)->withInput($request->all());
        // }
        
        $user = Auth::user();
        return view('frontend/payment',[
            'user'=>$user,
            'intent' => $user->createSetupIntent(),
            'price' => $request->stotal,
            'prequest' => $request->all()
        ]);
    }

    public function processPayment(Request $request, $price)
    {
        
        $prequest=json_decode($request->prequest);
        
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
        $pomodel = new ProductOrders();
        $etemplate = $pomodel->fill( [
            'user_id' => $user->id,
            'subtotal' => $prequest->stotal,
            'discount' => '0.00',
            'total' => $prequest->totalp,
            'firstname' => $prequest->fname,
            'lastname' => $prequest->lname,
            'mobile' => $prequest->pnumber,
            'email' => $prequest->compemailany,
            'line1' => $prequest->add1,
            'line2' => $prequest->add2,
            'city' => $prequest->city,
            'zipcode' => $prequest->zip
        ] )->save();
        

        $adf = array();
        $carts = session()->get('cart');
        if(!empty($carts))
        {
            foreach ( $carts as $k=>$ad ) {
                //$adf[] = new ProductOrderItems( [ 'product_id' => $k, 'price' => $ad['product_price'],'quantity' =>  $ad['product_quantity']] );
                $pomodel->products()->attach($k,["price" => $ad['product_price'],'quantity'=>$ad['product_quantity']]);
            }
            
        }
        session()->forget('cart');
        return redirect('dashboard');
    }
}
