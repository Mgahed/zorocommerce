<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function AddToWishlist(Request $request, $product_id)
    {

        if (auth()->check()) {

            $exists = Wishlist::where('user_id', auth()->id())->where('product_id', $product_id)->first();

            if (!$exists) {
                Wishlist::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product_id,
                ]);
                if ($request->lang === "en") {
                    $message = 'Successfully Added in Your Wishlist';
                } else {
                    $message = 'تم اضافة المنتج للمفضلة';
                }
                return response()->json(['success' => $message]);

            } else {
                if ($request->lang === "en") {
                    $message = 'This Product has Already in Your Wishlist';
                } else {
                    $message = 'هذا المنتج في المفضلة بالفعل';
                }
                return response()->json(['error' => $message]);

            }

        } else {
            if ($request->lang === "en") {
                $message = 'At First Login Your Account';
            } else {
                $message = 'يجب تسجيل الدخول اولا';
            }
            return response()->json(['error' => $message]);

        }

    } // end method


    public function ViewWishlist()
    {
        $wishlist = Wishlist::with('product')->where('user_id', auth()->id())->latest()->get();
        return view('front.wishlist.view_wishlist', compact('wishlist'));
    }

    public function GetWishlistProduct()
    {
        $wishlist = Wishlist::with('product')->where('user_id', auth()->id())->latest()->get();
        return response()->json($wishlist);
    } // end mehtod


    public function RemoveWishlistProduct($id)
    {

        Wishlist::where('user_id', auth()->id())->where('product_id', $id)->delete();
        $notification = array(
            'message' => __('Product removed from wishlist'),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        /*return response()->json(['success' => 'Successfully Product Remove']);*/
    }
}
