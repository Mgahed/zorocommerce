<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\FreeShipping;
use App\Models\Order;
use App\Models\Seo;
use App\Models\SocialMedia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('admin.user.all_user', compact('users'));
    }

    public function SetAdmin($id)
    {
        User::findOrFail($id)->update([
            'role' => 'admin'
        ]);
        $notification = [
            'message' => __('User role changed to admin'),
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function SetNormal($id)
    {
        User::findOrFail($id)->update([
            'role' => 'normal'
        ]);
        $notification = [
            'message' => __('User role changed to normal'),
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function SeoSetting()
    {

        $seo = Seo::find(1);
        return view('admin.setting.seo_update', compact('seo'));
    }


    public function SeoSettingUpdate(Request $request)
    {

        $seo_id = $request->id;

        Seo::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_tag' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,

        ]);

        $notification = array(
            'message' => __('Seo Updated Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    } // end mehtod


    public function SocialSetting()
    {

        $social = SocialMedia::find(1);
        return view('admin.setting.social_update', compact('social'));
    }


    public function SocialSettingUpdate(Request $request)
    {

        $seo_id = $request->id;

        SocialMedia::findOrFail($seo_id)->update([
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'youtube' => $request->youtube,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'google_map_address' => $request->google_map_address,

        ]);

        $notification = array(
            'message' => __('Updated Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    } // end mehtod

    public function AboutEdit()
    {
        $about = About::findOrFail(1);
        return view('admin.setting.about_us', compact('about'));
    }

    public function AboutUpdate(Request $request)
    {
        $pattern = '#\<pre.*?\>(.*?)\<\/pre\>#si';
        $replace = '$1';
        About::findOrFail(1)->update([
            'description_en' => preg_replace($pattern, $replace, $request->description_en),
            'description_ar' => preg_replace($pattern, $replace, $request->description_ar),
        ]);
        $notification = array(
            'message' => __('Updated Successfully'),
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function FreeShipping()
    {
        $data = FreeShipping::findOrFail(1);
        return view('admin.free_shipping', compact('data'));
    }

    public function SetFreeShipping(Request $request)
    {
        $data = FreeShipping::findOrFail(1)->update(['free_shipping_date' => $request->date]);
        return redirect()->back();
    }

    public function UpdateLogo(Request $request)
    {
//        return $request;
        if ($request->file('img')) {
            if (file_exists(public_path('logo.png'))) {
                unlink(public_path('logo.png'));
            }
            $img = $request->file('img');
            $name_gen = 'logo' . '.' . 'png';
            Image::Make($img)->resize(500, 500)->save(public_path($name_gen));
            $notification = [
                'message' => __('Logo changed successfully'),
                'alert-type' => 'success'
            ];
            return redirect()->back()->with($notification);
        }

        $notification = [
            'message' => __('Cannot change logo'),
            'alert-type' => 'error'
        ];
        return redirect()->back()->with($notification);
    }

    public function Report()
    {
        $data = User::select(DB::raw("count(orders.id) as count"), DB::raw("SUM(orders.amount) as sum"), 'users.name as name', 'users.email as email', 'users.phone as phone')
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->where('orders.delivered_date', '!=', null)
            ->groupBy('users.id')->get();
        return view('admin.user.report', compact('data'));
    }
}
