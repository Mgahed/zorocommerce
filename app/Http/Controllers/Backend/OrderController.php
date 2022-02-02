<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use App\Mail\ShippingMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class OrderController extends Controller
{
    // return Orders
    public function ReturnRequest()
    {
        $orders = Order::where('status', 'return requested')->orderBy('id', 'DESC')->get();
        return view('admin.orders.return_request', compact('orders'));

    } // end mehtod

    public function ReturnedOrder()
    {
        $orders = Order::where('status', 'returned')->orderBy('id', 'DESC')->get();
        return view('admin.orders.returned_order', compact('orders'));

    } // end mehtod

    /// // Pending Orders
    public function PendingOrders()
    {
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('admin.orders.pending_orders', compact('orders'));

    } // end mehtod


    // Pending Order Details
    public function PendingOrdersDetails($order_id)
    {

        $order = Order::with('division', 'user', 'district')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('admin.orders.pending_orders_details', compact('order', 'orderItem'));

    } // end method


    // Confirmed Orders
    public function ConfirmedOrders()
    {
        $orders = Order::where('status', 'confirm')->orderBy('id', 'DESC')->get();
        return view('admin.orders.confirmed_orders', compact('orders'));

    } // end mehtod


    // Processing Orders
    public function ProcessingOrders()
    {
        $orders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();
        return view('admin.orders.processing_orders', compact('orders'));

    } // end mehtod


    // Picked Orders
    public function PickedOrders()
    {
        $orders = Order::where('status', 'picked')->orderBy('id', 'DESC')->get();
        return view('admin.orders.picked_orders', compact('orders'));

    } // end mehtod


    // Shipped Orders
    public function ShippedOrders()
    {
        $orders = Order::where('status', 'shipped')->orderBy('id', 'DESC')->get();
        return view('admin.orders.shipped_orders', compact('orders'));

    } // end mehtod


    // Delivered Orders
    public function DeliveredOrders()
    {
        $orders = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();
        return view('admin.orders.delivered_orders', compact('orders'));

    } // end mehtod


    // Cancel Orders
    public function CancelOrders()
    {
        $orders = Order::where('status', 'cancelled')->orWhere('status', 'cancelled by admin')->orderBy('id', 'DESC')->get();
        return view('admin.orders.cancel_orders', compact('orders'));

    } // end mehtod


    public function ReturnStatus($order_id)
    {

        Order::findOrFail($order_id)->update([
            'status' => 'returned',
            'return_date' => Carbon::now()
        ]);

        $notification = array(
            'message' => __('Order return confirmed'),
            'alert-type' => 'success'
        );

        return redirect()->route('return-request-orders')->with($notification);

    } // end method

    public function PendingToConfirm($order_id)
    {

        Order::findOrFail($order_id)->update([
            'status' => 'confirm',
            'confirmed_date' => Carbon::now()
        ]);

        $notification = array(
            'message' => __('Order Confirmed Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('pending-orders')->with($notification);

    } // end method

    public function PendingToCancelByAdmin($order_id)
    {

        Order::findOrFail($order_id)->update([
            'status' => 'cancelled by admin',
            'cancel_date' => Carbon::now()
        ]);

        $notification = array(
            'message' => __('Order Cancelled Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('pending-orders')->with($notification);

    } // end method


    public function ConfirmToProcessing($order_id)
    {

        Order::findOrFail($order_id)->update([
            'status' => 'processing',
            'processing_date' => Carbon::now()
        ]);

        $notification = array(
            'message' => __('Order Processing Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('confirmed-orders')->with($notification);


    } // end method


    public function ProcessingToPicked($order_id)
    {

        $order = Order::findOrFail($order_id);
        $order->update([
            'status' => 'picked',
            'picked_date' => Carbon::now()
        ]);

        $email_data = [
            'name' => __('Dear customer, ') . $order->name,
            'email' => $order->email,
            'invoice' => __('Order number ') . $order->invoice_number,
            'msg' => __('Your order is ready and it will be delivered to you soon')
        ];

        Mail::to($order->email)->send(new ShippingMail($email_data));

        $notification = array(
            'message' => __('Order Picked Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('processing-orders')->with($notification);


    } // end method


    public function PickedToShipped($order_id)
    {

        $product = OrderItem::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            $current_product = Product::findOrFail($item->product_id);
            Product::where('code', $current_product->code)
                ->update(['quantity' => DB::raw('quantity-' . $item->qty)]);
        }

        Order::findOrFail($order_id)->update([
            'status' => 'shipped',
            'shipped_date' => Carbon::now()
        ]);

        $notification = array(
            'message' => __('Order Shipped Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('picked-orders')->with($notification);


    } // end method


    public function ShippedToDelivered($order_id)
    {

        Order::findOrFail($order_id)->update([
            'status' => 'delivered',
            'delivered_date' => Carbon::now()
        ]);

        $notification = array(
            'message' => __('Order Delivered Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('shipped-orders')->with($notification);


    } // end method


    public function AdminInvoiceDownload($order_id)
    {

        $order = Order::with('division', 'district', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('admin.orders.order_invoice', compact('order', 'orderItem'));

        $pdf = PDF::loadView('admin.orders.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    } // end method


    public function AdminShippingDownload($order_id)
    {

        $order = Order::with('division', 'district', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('admin.orders.shipping_invoice' , compact('order', 'orderItem'));

        $pdf = PDF::loadView('admin.orders.shipping_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('shipping_invoice.pdf');

    } // end method
}
