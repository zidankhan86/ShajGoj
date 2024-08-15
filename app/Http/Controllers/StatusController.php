<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StatusController extends Controller
{
    public function confirm($id)
    {
        $status = Order::findOrFail($id);

        $status->update([

            'status' => 'confirm',
        ]);

        Alert::toast()->warning('Order Confirmed successfully.');
        return redirect()->back();
    }

    public function cancel($id)
    {
        $status = Order::findOrFail($id);

        $status->update([

            'status' => 'Cancelled',
        ]);

        Alert::toast()->warning('Order Cancelled successfully.');
        return redirect()->back();
    }
}
