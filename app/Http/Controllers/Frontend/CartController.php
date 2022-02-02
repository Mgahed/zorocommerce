<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\PriceCoupon;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\ShipDivision;
use App\Models\UserCoupon;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        /*return $request;*/
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);
        if ($request->quantity > $product->quantity) {
            if ($request->lang === 'en') {
                $message = 'Quantity not available';
            } else {
                $message = 'كمية غير متوفرة';
            }
            return response()->json(['error' => $message]);
        }


        Cart::add([
            'id' => $id,
            'name' => $request->name,
            'qty' => $request->quantity,
            'price' => $request->price,
            'weight' => 1,
            'options' => [
                'product_id' => $id,
                'image' => $product->thumbnail,
                'color' => $request->color,
            ],
        ]);
        if ($request->lang === 'en') {
            $message = 'Successfully Added on Your Cart';
        } else {
            $message = 'تم الاضافه الى السلة';
        }
        return response()->json(['success' => $message]);


    } // end mehtod


    // Mini Cart Section
    public function AddMiniCart()
    {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),

        ));
    } // end method


/// remove mini cart
    public function RemoveMiniCart($rowId)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::remove($rowId);
        $notification = array(
            'message' => __('Product Removed from Cart'),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } // end mehtod

    public function RemoveAll()
    {
        /*return "dasdas";*/
        $carts = Cart::content();
        return $carts;
        foreach ($carts as $cart) {
            Cart::remove($cart->rowId);
        }
        return redirect()->json(['success' => 'All Products Removed from Cart']);
    }


    public function CouponApply(Request $request)
    {
        $user_coupon = UserCoupon::with('user')->where('name', $request->coupon_name)->where('validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($user_coupon && $user_coupon->user->id === \Auth::user()->id) {
            Session::put('coupon', [
                'coupon_name' => $user_coupon->name,
                'coupon_discount' => $user_coupon->discount,
                'discount_amount' => round($user_coupon->discount),
                'total_amount' => round(Cart::total() - $user_coupon->discount) < 0 ? 0 : round(Cart::total() - $user_coupon->discount)
            ]);
            if ($request->lang === 'en') {
                $message = 'Coupon Applied Successfully';
            } else {
                $message = 'تم استخدام الكوبون بنجاح';
            }
            return response()->json(array(
                'validity' => true,
                'success' => $message
            ));
        }

        $coupon = Coupon::where('name', $request->coupon_name)->where('validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_discount' => $coupon->discount,
                'discount_amount' => round(Cart::total() * $coupon->discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->discount / 100)
            ]);
            if ($request->lang === 'en') {
                $message = 'Coupon Applied Successfully';
            } else {
                $message = 'تم استخدام الكوبون بنجاح';
            }
            return response()->json(array(
                'validity' => true,
                'success' => $message
            ));
        }

        $price_coupon = PriceCoupon::where('name', $request->coupon_name)->where('validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($price_coupon) {
            Session::put('coupon', [
                'coupon_name' => $price_coupon->name,
                'coupon_discount' => $price_coupon->discount,
                'discount_amount' => round($price_coupon->discount),
                'total_amount' => round(Cart::total() - $price_coupon->discount) < 0 ? 0 : round(Cart::total() - $price_coupon->discount)
            ]);
            if ($request->lang === 'en') {
                $message = 'Coupon Applied Successfully';
            } else {
                $message = 'تم استخدام الكوبون بنجاح';
            }
            return response()->json(array(
                'validity' => true,
                'success' => $message
            ));
        }

        $product_coupon = ProductCoupon::where('name', $request->coupon_name)->where('validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($product_coupon) {
            $first_total = Cart::total();
//return  $product_coupon->product_id;
            $carts = Cart::content();
            foreach ($carts as $cart) {
                if ($cart->id == $product_coupon->product_id) {
                    $discount = $cart->subtotal * $product_coupon->discount / 100;
                    $cart->discount = $discount;
                }
            }
            Session::put('coupon', [
                'coupon_name' => $product_coupon->name,
                'coupon_discount' => $first_total - Cart::total(),
                'discount_amount' => $first_total - Cart::total(),
                'total_amount' => round(Cart::total())
            ]);
            if ($request->lang === 'en') {
                $message = 'Coupon Applied Successfully';
            } else {
                $message = 'تم استخدام الكوبون بنجاح';
            }
            return response()->json(array(
                'validity' => true,
                'success' => $message
            ));
        }
        /*----- No Coupon -----*/
        if ($request->lang === 'en') {
            $message = 'Invalid Coupon';
        } else {
            $message = 'كوبون غير صالح';
        }
        return response()->json(['error' => $message]);

    } // end method


    public
    function CouponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }

        return response()->json(array(
            'total' => Cart::total(),
        ));
    } // end method


    // Remove Coupon
    public
    function CouponRemove()
    {
        $carts = Cart::content();
        foreach ($carts as $cart) {
            $cart->discount = 0;
        }

        Session::forget('coupon');

        $notification = array(
            'message' => __('Coupon removed'),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    // Checkout Method
    public
    function CheckoutCreate()
    {

        if (auth()->check()) {
            if (Cart::total() > 0) {

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $divisions = ShipDivision::orderBy('name_en', 'ASC')->get();
                return view('front.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'divisions'));

            }

            $notification = array(
                'message' => __('No Products at cart'),
                'alert-type' => 'error'
            );

            return redirect()->to('/')->with($notification);
        }

        $notification = array(
            'message' => __('You Need to Login First'),
            'alert-type' => 'error'
        );

        return redirect()->route('login')->with($notification);

    } // end method
}
