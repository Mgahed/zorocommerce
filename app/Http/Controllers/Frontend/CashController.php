<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;

class CashController extends Controller
{
    public function CashOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }


        // dd($charge);
//        $number = strtotime(Carbon::now()) . mt_rand(10000000, 99999999);
        $last_order = Order::orderBy('id', 'DESC')->first();
        if ($last_order) {
            $id = $last_order->id + 1;
        } else {
            $id = 1;
        }
        $number = str_pad($id, 9, "0", STR_PAD_LEFT);
        $order_id = Order::insertGetId([
            'user_id' => auth()->id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,

            'payment_type' => 'cash',
            'payment_method' => 'cash',

            'amount' => $total_amount + $request->shipping_cost,

            'order_number' => $number,
            'invoice_number' => 'EOS' . $number,
            'status' => 'pending',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'qty' => $cart->qty,
                'price' => $cart->price,
            ]);
        }

        // Start Send Email
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_number' => $invoice->invoice_number,
            'amount' => $total_amount + $request->shipping_cost,
            'amountbefore' => $total_amount,
            'cost' => $request->shipping_cost,
            'name' => $invoice->name,
            'email' => $invoice->email,

        ];

        Mail::to($request->email)->send(new OrderMail($data));

        // End Send Email


        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
            'message' => __('Your Order Place Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('home')->with($notification);


    } // end method
}
