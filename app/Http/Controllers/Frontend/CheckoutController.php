<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{

    protected function getRules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'division_id' => 'required',
            'address' => 'required'
        ];
    }

    protected function getMSG()
    {
        return [
            'name.required' => __('Must enter the name'),
            'email.required' => __('Must enter the email'),
            'email.email' => __('Must be valid email'),
            'phone.required' => __('Must enter the phone number'),
            'phone.numeric' => __('Must be a number'),
            'division_id.required' => __('Must select a city'),
            'address.required' => __('Must enter the address')
        ];
    }

    /*public function DistrictGetAjax($division_id)
    {

        $ship = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($ship);

    } // end method


    public function StateGetAjax($district_id)
    {

        $ship = ShipState::where('district_id', $district_id)->orderBy('state_name', 'ASC')->get();
        return json_encode($ship);

    } // end method*/


    public function CheckoutStore(Request $request)
    {

        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        /*dd($request->all());*/
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id == 'null' ? null : $request->district_id;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();

//        return $data['district_id'];

        if ($request->payment_method === 'stripe') {
            return view('frontend.payment.stripe', compact('data', 'cartTotal'));
        } elseif ($request->payment_method === 'card') {
            return 'card';
        } else {
            return view('front.payment.cash', compact('data', 'cartTotal'));
        }


    }// end mehtod.
}
