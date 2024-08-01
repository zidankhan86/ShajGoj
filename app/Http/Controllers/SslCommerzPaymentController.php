<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{



    public function index(Request $request ,$id)
    {
        $validator = Validator::make($request->all(), [
            
            'address'           => 'required|string',
            'phone'             => 'required|string',
            'email'             => 'required|email',
            'total_price'       => 'nullable|numeric|min:0',
            'name'              => 'nullable|string',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $product = Product::find($id);

        $cart = session()->get('cart', []);

        foreach ($cart as $productId => $cartItem) {
            $product = Product::find($id);
    
            if ($product) {
                if ($product->stock >= $cartItem['quantity']) {
                    $product->stock -= $cartItem['quantity'];
                    $product->save();
                } else {
                    notify()->error("Product {$product->name} is out of stock");
                    return redirect()->back();
                }
            }
        }
        
        $productNames = implode(', ', $request->input('product_names', []));
        $subtotal = $request->input('total_price');

        $post_data = array();
        $post_data['total_amount'] = $product->price;
        $post_data['total_price'] = $subtotal;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['name'] = $productNames;
        $post_data['full_name'] = $request->full_name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['user_id'] = auth()->user()->id;
        $post_data['product_id'] = $product->id;
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'full_name' => $post_data['full_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'price' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'user_id' => $post_data['user_id'],
                'product_id' => $post_data['product_id'],
                'name' => $post_data['name'],
                'total_price' => $post_data['total_price'],
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');
        notify()->success('Order successful!.');
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
            notify()->success('Order successful!.');
            return redirect()->route('home');
        } 

    }

    public function success(Request $request)
    {
        notify()->success('Order successful!.');
        return redirect()->route('home');

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'price')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            return redirect()->route('home')->with('success', 'Order successful');
        } else {
            return back()->with('error', 'No Product available');
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            return redirect()->route('home')->with('success', 'Order successful');
        } else {
            return back()->with('error', 'No Product available');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

   

}
