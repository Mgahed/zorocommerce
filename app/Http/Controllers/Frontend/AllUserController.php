<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use PDF;

class AllUserController extends Controller
{
    public function MyOrders()
    {

        $orders = Order::where('user_id', auth()->id())->orderBy('id', 'DESC')->get();
        return view('front.user.order.order_view', compact('orders'));

    } // end mehtod


    public function OrderDetails($order_id)
    {

        $order = Order::with('division', 'user')->where('id', $order_id)->where('user_id', auth()->id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('front.user.order.order_details', compact('order', 'orderItem'));

    } // end mehtod


    public function InvoiceDownload($order_id)
    {
        $order = Order::with('division', 'user')->where('id', $order_id)->where('user_id', auth()->id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('front.user.order.order_invoice', compact('order', 'orderItem'));
        $pdf = PDF::loadView('front.user.order.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');


    } // end mehtod


    public function ReturnOrder(Request $request, $order_id)
    {

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now(),
            'return_reason' => $request->return_reason,
            'status' => 'return requested'
        ]);


        $notification = array(
            'message' => __('Return Request Sent Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);

    } // end method


    public function ReturnOrderList()
    {

        $orders = Order::where('user_id', auth()->id())->where('status', 'returned')->orderBy('id', 'DESC')->get();
        return view('front.user.order.return_order_view', compact('orders'));

    } // end method


    public function CancelOrders()
    {
        $orders = Order::where('user_id', auth()->id())->where(function ($query) {
            $query->where('status', 'cancelled')->orWhere('status', 'cancelled by admin');
        })->orderBy('id', 'DESC')->get();
        return view('front.user.order.cancel_order_view', compact('orders'));
    } // end method


    public function CancelOrder($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'cancelled',
            'cancel_date' => Carbon::now()
        ]);

        $notification = array(
            'message' => __('Order Cancelled Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);
    }


    ///////////// Order Traking ///////

    public function OrderTraking(Request $request)
    {

        $invoice = $request->code;

        $track = Order::where('invoice_number', $invoice)->first();

        if ($track) {

            // echo "<pre>";
            // print_r($track);

            return view('front.traking.track_order', compact('track'));

        }

        $notification = array(
            'message' => 'Invoice Code Is Invalid',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);

    } // end mehtod

    ///////////// themes ///////
    public function light()
    {
        DB::table('users')->update(array('theme' => 'light'));
//        User::findOrFail(\Auth::user()->id)->update(['theme'=>'light']);
        return redirect()->back();
    }

    public function mint()
    {
        DB::table('users')->update(array('theme' => 'mint'));
//        User::findOrFail(\Auth::user()->id)->update(['theme'=>'mint']);
        return redirect()->back();
    }

    public function dark()
    {
        DB::table('users')->update(array('theme' => 'dark'));
//        User::findOrFail(\Auth::user()->id)->update(['theme'=>'dark']);
        return redirect()->back();
    }
}
