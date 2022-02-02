<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\PriceCoupon;
use App\Models\ProductCoupon;
use App\Models\User;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    protected function getRules()
    {
        return [
            'name' => 'required',
            'discount' => 'required|numeric',
            'validity' => 'required',
        ];
    }

    protected function getMSG()
    {
        return [
            'name.required' => __('This field is required'),
            'discount.required' => __('This field is required'),
            'discount.numeric' => __('Must be a number'),
            'validity.required' => __('This field is required'),
        ];
    }

    public function CouponView()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('admin.coupon.view_coupon', compact('coupons'));
    }


    public function CouponStore(Request $request)
    {

        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        Coupon::create([
            'name' => strtoupper($request->name),
            'discount' => $request->discount,
            'validity' => $request->validity
        ]);

        $notification = array(
            'message' => __('Coupon Inserted Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method


    public function CouponEdit($id)
    {
        $coupons = Coupon::findOrFail($id);
        return view('admin.coupon.edit_coupon', compact('coupons'));
    }


    public function CouponUpdate(Request $request, $id)
    {

        Coupon::findOrFail($id)->update([
            'name' => strtoupper($request->name),
            'discount' => $request->discount,
            'validity' => $request->validity
        ]);

        $notification = array(
            'message' => __('Coupon Updated Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->route('manage-coupon')->with($notification);


    } // end mehtod


    public function CouponDelete($id)
    {

        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => __('Coupon Deleted Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }

    /*----- price coupon -----*/

    public function PriceCouponView()
    {
        $coupons = PriceCoupon::orderBy('id', 'DESC')->get();
        return view('admin.coupon_price.view_coupon', compact('coupons'));
    }


    public function PriceCouponStore(Request $request)
    {

        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        PriceCoupon::create([
            'name' => strtoupper($request->name),
            'discount' => $request->discount,
            'validity' => $request->validity
        ]);

        $notification = array(
            'message' => __('Coupon Inserted Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method


    public function PriceCouponEdit($id)
    {
        $coupons = PriceCoupon::findOrFail($id);
        return view('admin.coupon_price.edit_coupon', compact('coupons'));
    }


    public function PriceCouponUpdate(Request $request, $id)
    {

        PriceCoupon::findOrFail($id)->update([
            'name' => strtoupper($request->name),
            'discount' => $request->discount,
            'validity' => $request->validity
        ]);

        $notification = array(
            'message' => __('Coupon Updated Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->route('price.manage-coupon')->with($notification);


    } // end mehtod


    public function PriceCouponDelete($id)
    {

        PriceCoupon::findOrFail($id)->delete();
        $notification = array(
            'message' => __('Coupon Deleted Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }



    /*----- user coupon -----*/

    public function UserCouponView()
    {
        $coupons = UserCoupon::with('user')->orderBy('id', 'DESC')->get();
        return view('admin.coupon_user.view_coupon', compact('coupons'));
    }


    public function UserCouponStore(Request $request)
    {

        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $user = User::where('email',$request->email)->first();
        if (!$user) {
            $notification = array(
                'message' => __('User not exist'),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification)->withInput($request->all());
        }


        UserCoupon::create([
            'name' => strtoupper($request->name),
            'discount' => $request->discount,
            'validity' => $request->validity,
            'user_id' => $user->id
        ]);

        $notification = array(
            'message' => __('Coupon Inserted Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method


    public function UserCouponEdit($id)
    {
        $coupons = UserCoupon::with('user')->findOrFail($id);
        return view('admin.coupon_user.edit_coupon', compact('coupons'));
    }


    public function UserCouponUpdate(Request $request, $id)
    {

        UserCoupon::findOrFail($id)->update([
            'name' => strtoupper($request->name),
            'discount' => $request->discount,
            'validity' => $request->validity
        ]);

        $notification = array(
            'message' => __('Coupon Updated Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->route('user.manage-coupon')->with($notification);


    } // end mehtod


    public function UserCouponDelete($id)
    {

        UserCoupon::findOrFail($id)->delete();
        $notification = array(
            'message' => __('Coupon Deleted Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }


    /*----- product coupon -----*/

    public function ProductCouponView()
    {
        $categories = Category::orderBy('name_en', 'ASC')->get();
        $coupons = ProductCoupon::with('product')->orderBy('id', 'DESC')->get();
        return view('admin.coupon_product.view_coupon', compact('coupons', 'categories'));
    }


    public function ProductCouponStore(Request $request)
    {

        $rules = [
            'name' => 'required|unique:product_coupons',
            'discount' => 'required|numeric',
            'validity' => 'required',
            'product_id' => 'required',
        ];
        $customMSG = [
            'name.required' => __('This field is required'),
            'name.unique' => __('This coupon must be unique'),
            'discount.required' => __('This field is required'),
            'discount.numeric' => __('Must be a number'),
            'validity.required' => __('This field is required'),
            'product_id.required' => __('This field is required'),
        ];
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        ProductCoupon::create([
            'name' => strtoupper($request->name),
            'discount' => $request->discount,
            'validity' => $request->validity,
            'product_id' => $request->product_id
        ]);

        $notification = array(
            'message' => __('Coupon Inserted Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method


    public function ProductCouponEdit($id)
    {
        $coupons = ProductCoupon::findOrFail($id);
        return view('admin.coupon_product.edit_coupon', compact('coupons'));
    }


    public function ProductCouponUpdate(Request $request, $id)
    {

        ProductCoupon::findOrFail($id)->update([
            'name' => strtoupper($request->name),
            'discount' => $request->discount,
            'validity' => $request->validity
        ]);

        $notification = array(
            'message' => __('Coupon Updated Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->route('product.manage-coupon')->with($notification);


    } // end mehtod


    public function ProductCouponDelete($id)
    {

        ProductCoupon::findOrFail($id)->delete();
        $notification = array(
            'message' => __('Coupon Deleted Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }

}
