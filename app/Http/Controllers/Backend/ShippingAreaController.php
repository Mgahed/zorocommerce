<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingAreaController extends Controller
{
    protected function getRules()
    {
        return [
            'name_en' => 'required|unique:ship_divisions',
            'name_ar' => 'required|unique:ship_divisions',
            'cost' => 'required'
        ];
    }

    protected function getMSG()
    {
        return [
            'name_en.required' => __('This field is required'),
            'name_ar.required' => __('This field is required'),
            'cost.required' => __('This field is required'),
            'name_en.unique' => __('Name should be unique'),
            'name_ar.unique' => __('Name should be unique')
        ];
    }

    protected function getRulesDist()
    {
        return [
            'name_en' => 'required|unique:districts',
            'name_ar' => 'required|unique:districts',
            'cost' => 'required'
        ];
    }

    protected function getMSGDist()
    {
        return [
            'name_en.required' => __('This field is required'),
            'name_ar.required' => __('This field is required'),
            'cost.required' => __('This field is required'),
            'name_en.unique' => __('Name should be unique'),
            'name_ar.unique' => __('Name should be unique')
        ];
    }


    public function DivisionView()
    {
        $divisions = ShipDivision::orderBy('name_en', 'ASC')->get();
        return view('admin.ship.division.view_division', compact('divisions'));

    }


    public function DivisionStore(Request $request)
    {

        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        ShipDivision::create([
            'name_en' => ucfirst(strtolower($request->name_en)),
            'name_ar' => $request->name_ar,
            'cost' => $request->cost

        ]);

        $notification = array(
            'message' => __('City Inserted Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method


    public function DivisionEdit($id)
    {

        $division = ShipDivision::findOrFail($id);
        return view('admin.ship.division.edit_division', compact('division'));
    }


    public function DivisionUpdate(Request $request, $id)
    {

        $rules = [
            "cost" => 'required'
        ];
        $customMSG = [
            "cost.required" => __('This field is required')
        ];
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        ShipDivision::findOrFail($id)->update([
            'name_en' => ucfirst(strtolower($request->name_en)),
            'name_ar' => $request->name_ar,
            'cost' => $request->cost,
        ]);

        $notification = array(
            'message' => __('City Updated Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->route('manage-division')->with($notification);


    } // end mehtod


    public function DivisionDelete($id)
    {

        ShipDivision::findOrFail($id)->delete();

        $notification = array(
            'message' => __('City Deleted Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    } // end method


    ////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////

    public function DistrictView()
    {
        $districts = District::orderBy('name_en', 'ASC')->get();
        return view('admin.ship.district.view_district', compact('districts'));

    }


    public function DistrictStore(Request $request)
    {

        $rules = $this->getRulesDist();
        $customMSG = $this->getMSGDist();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        District::create([
            'name_en' => ucfirst(strtolower($request->name_en)),
            'name_ar' => $request->name_ar,
            'cost' => $request->cost,
            'city_id' => $request->city_id

        ]);

        $notification = array(
            'message' => __('District Inserted Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method


    public function DistrictEdit($id)
    {

        $district = District::findOrFail($id);
        return view('admin.ship.district.edit_district', compact('district'));
    }


    public function DistrictUpdate(Request $request, $id)
    {

        $rules = [
            "cost" => 'required'
        ];
        $customMSG = [
            "cost.required" => __('This field is required')
        ];
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        District::findOrFail($id)->update([
            'name_en' => ucfirst(strtolower($request->name_en)),
            'name_ar' => $request->name_ar,
            'cost' => $request->cost,
            'city_id' => $request->city_id,
        ]);

        $notification = array(
            'message' => __('District Updated Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->route('manage-district')->with($notification);


    } // end mehtod


    public function DistrictDelete($id)
    {

        District::findOrFail($id)->delete();

        $notification = array(
            'message' => __('District Deleted Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    } // end method

    public function DistrictAjax($id)
    {
        $districts = District::select('name_' . app()->getLocale() . ' as name', 'id')->orderBy('name_' . app()->getLocale(), 'ASC')->where('city_id', $id)->get();
        return json_encode($districts);
    }

}
