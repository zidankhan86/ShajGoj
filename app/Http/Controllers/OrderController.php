<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList(){

        $orders = Order::latest()->get();

        return view('backend.pages.order.orderList',compact('orders'));
    }

    public function orderinvoice($id){

        $invoice = Order::find($id);

        return view('backend.pages.order.orderView',compact('invoice'));
    }


    public function report()
    {
        //dd('yes');
        $oders = Order::all();
        
        return view('backend.pages.report.report',compact('oders'));
    }

    public function reportSearch(Request $request)
    {

    //dd('yes');
        $validator = Validator::make($request->all(), [
            'from_date'    => 'required|date',
            'to_date'      => 'required|date|after:from_date',
        ]);

        if($validator->fails())
        {

           Alert:: toast()->error('From date and to date required and to should greater then from date.');
            return redirect()->back();
        }

       $from=$request->from_date;
       $to=$request->to_date;

//       $status=$request->status;

        $orders=Order::whereBetween('created_at', [$from, $to])->get();
        return view('backend.pages.report.report',compact('orders'));

    }
}
