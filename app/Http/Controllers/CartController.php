<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
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
        $shipping=$request['shipping'];
        
        return view("frontend/checkout", compact("carts","shipping"));
    }

    public function confirmation(Request $request)
    {

    }

    public function productview(Request $request)
    {

    }
}
