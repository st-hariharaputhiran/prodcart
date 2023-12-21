<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductOrders;
use App\Models\Coupon;
use Session;
use Auth;

class CartController extends Controller
{
    protected $shipping;
    protected $totalpriceup=0;

    public function index()
    {
        $products = Product::with('productImages')->get();
        return view("frontend/products", compact("products"));
    }

    public function addProducttoCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['product_quantity']++;
        } else {
            $cart[$id] = [
                "product_title" => $product->product_title,
                "product_quantity" => 1,
                "product_price" => $product->product_price,
                "image_url" => $product->productImages->take(1)
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product has been added to cart!');
    }
    
    public function updateCart(Request $request)
    {
        foreach($request['req'] as $id=>$quantity)
        {
            
            if($id != 0)
            {
                $cart = session()->get('cart');
                $cart[$id]["product_quantity"] = $quantity;
                session()->put('cart', $cart);
            }
        }
        $msg="Cart Updated";
        return $msg;
    }
  
    public function deleteProduct(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted.');
        }
    }

    public function cart(Request $request)
    {
        

        $carts = session()->get('cart');
        if(!empty($carts))
        {
            foreach($carts as $k=>$cart)
            {
                $carts[$k]['total'] = $cart['product_price'] * $cart['product_quantity'];
            }
        }
        else
        {
            $carts=array();
        }
        return view("frontend/cart", compact("carts"));

    }

    public function checkout(Request $request)
    {
        $request->validate([
            'shipping' => 'required'
        ]);
        $carts = session()->get('cart');
        $subtotal=0;
        if(!empty($carts))
        {
            foreach($carts as $k=>$cart)
            {
                $carts[$k]['total'] = $cart['product_price'] * $cart['product_quantity'];
                $subtotal+=$carts[$k]['total'];
            }
        }
        else
        {
            $carts=array();
        }
        $this->shipping=$shipping=$request['shipping'];
        $totalprice=$subtotal+$shipping;
        
        if($this->totalpriceup == 0)
        {
            session()->put('totalprice', $totalprice);
        }
        else
        {
            session()->put('totalprice', $this->totalpriceup);
        }
        session()->save();
        $coupons = Coupon::with('users')->get();
        
        return view("frontend/checkout", compact("carts","shipping","coupons"));
    }

    public function productdetail($id)
    {
        $product = Product::with('productImages')->findOrFail($id);
        return view("frontend/single-product",compact("product"));
    }

    public function applycoupon(Request $request)
    {
        $ccode=$request['ccode'];
        $user = Auth::user();
        $coupons = Coupon::withCount('users')->where('coupon_code','LIKE','%'.$ccode.'%')->get();
        foreach ($coupons as $coupon) { 
                 $instance[] = $coupon->id;
                 if($coupon->users_count == 0)
                 {
                    $cid=$coupon->id;
                    $coup = Coupon::with('users')->findOrFail($cid);
                    $cdate=date("Y-m-d",strtotime(date("Y-m-d")));
                    $sdate=date("Y-m-d",strtotime($coup->start_at));
                    $edate=date("Y-m-d",strtotime($coup->expire_at));
                    $type=$coup->coupon_type;
                    $damount=$coup->discount_amount;
                    $tprice=session()->get("totalprice");
                    if(($cdate >= $sdate) && ($cdate <= $edate)){
                      if($type == "fixed")
                      {
                        $tprice-=$damount;
                      }  
                      else
                      {
                        $tempprice=($tprice-(($tprice*$damount)/100));
                        $tprice=$tempprice;
                      }
                      //dd($tprice);
                      $this->totalpriceup=$tprice;
                      
                      $uid=$user->id;
                      $coup->users()->attach($uid);
                      return $this->totalpriceup;
                    }else{
                        $msg="Coupon Expired";
                        return $msg;
                    }
                    
                 }
                 else
                 {
                    //dd($coupon->users);
                    foreach($coupon->users as $usercoup)
                    {
                        if($user->id == $usercoup->id)
                        {
                            $msg="Coupon Already Applied";
                            return $msg;
                        }
                        else
                        {
                            $cid=$coupon->id;
                            $coup = Coupon::with('users')->findOrFail($cid);
                            $cdate=date("Y-m-d",strtotime(date("Y-m-d")));
                            $sdate=date("Y-m-d",strtotime($coup->start_at));
                            $edate=date("Y-m-d",strtotime($coup->expire_at));
                            $type=$coup->coupon_type;
                            $damount=$coup->discount_amount;
                            $tprice=session()->get("totalprice");
                            if(($cdate >= $sdate) && ($cdate <= $edate)){
                            if($type == "fixed")
                            {
                                $tprice-=$damount;
                            }  
                            else
                            {
                                $tempprice=($tprice-(($tprice*$damount)/100));
                                $tprice=$tempprice;
                            }
                            $this->totalpriceup=$tprice;
                            
                            $uid=$user->id;
                            $coup->users()->attach($uid);
                            return $this->totalpriceup;
                            }else{
                                $msg="Coupon Expired";
                                return $msg;
                            }
                            
                        }
                    }
                 }
         
             }
        $msg="Coupon Applied";
        return $msg;

    }

    public function myorders()
    {
        $user = Auth::user();
        $pos = ProductOrders::with('products')->with('products.productImages')->where("user_id","=",$user->id)->get();
        return view("frontend/myorders",compact("pos"));
    }

    public function confirmation(Request $request)
    {

    }

    public function productview(Request $request)
    {

    }
}
