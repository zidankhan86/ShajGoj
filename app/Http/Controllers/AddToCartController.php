<?php

namespace App\Http\Controllers;

use notify;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AddToCartController extends Controller
{
    public function addToCart($id)
    {

        $product=Product::find($id);
        if($product)
        {
            $cart=session()->get('cart');
//            dd($cart);
            if(!$cart)
            {
                //step 1: cart empty
                //add to cart- first product
                    $myCart[$id]=[
                      'name'=>$product->name,
                      'discounted_price'=>$product->discounted_price,
                      'price'=>$product->price,
                      'quantity'=>1,
                      'subtotal'=>$product->price,//price x quantity
                    ];

                  session()->put('cart',$myCart);
                  notify()->success('Product added to the cart');

                  return redirect()->back();
            }


            //step 2:Cart not empty but product not exist
            //add to cart

            if(!array_key_exists($id,$cart)){
                $cart[$id]=[
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'quantity'=>1,
                    'subtotal'=>$product->price,//price x quantity
                    'discounted_price'=>$product->discounted_price,
                ];

                session()->put('cart',$cart);
              notify()->success('New product added.');
                return redirect()->back();

            }

            //step 3 : cart not empty but product exist
            // quantity , subtotal update
            $cart[$id]['quantity']=$cart[$id]['quantity']+1;
            $cart[$id]['subtotal']=$cart[$id]['quantity'] * $cart[$id]['price'];
            session()->put('cart',$cart);

           notify()->success('Cart updated.');
            return redirect()->back();
          }

          Alert::toast()->success('No Product Found.');
          return redirect()->back();



            }

            public function viewCart()
            {
              return view('frontend.pages.addToCart.viewCard');
            }

            public function clearCart()
            {
                session()->forget('cart');
                notify()->success('Cart Clear Success.');
                return redirect()->back();
            }

            public function cartItemDelete($id)
            {
              $cart=session()->get('cart');
        //      dd($cart);
              unset($cart[$id]);
        //      dd($cart);
                session()->put('cart',$cart);
                notify()->success('Item removed.');
              return redirect()->back();
            }

            public function updateCartQuantity(Request $request, $id)
              {
                  $cart = session()->get('cart');

                  if(isset($cart[$id])) {
                      $cart[$id]['quantity'] = $request->quantity;
                      $cart[$id]['subtotal'] = $cart[$id]['quantity'] * $cart[$id]['price'];
                      
                      session()->put('cart', $cart);

                      notify()->success('Cart quantity updated successfully.');
                  } else {
                      notify()->error('Product not found in cart.');
                  }

                  return redirect()->back();
              }
        }
