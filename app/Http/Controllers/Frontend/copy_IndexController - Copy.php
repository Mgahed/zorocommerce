<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use App\Models\BlogPost;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\User;
use App\Traits\SEOTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    use SEOTrait;

    protected function getRules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'phone' => 'required|unique:users'
        ];
    }

    protected function getMSG()
    {
        return [
            'name.required' => __('Must enter the name'),
            'email.required' => __('Must enter an email'),
            'email.unique' => __('You cant use this email'),
            'email.email' => __('Must be valid email'),
            'phone.required' => __('Must enter the number'),
            'phone.unique' => __('You cant use this number')
        ];
    }

    public function index()
    {
//        $blogpost = BlogPost::latest()->get();
        //$products = Product::/*where('status', 1)->*/ orderBy('id', 'DESC')->limit(6)->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $categories = Category::with('subcategory')->orderBy('name_en', 'ASC')->get();

        return view('front.index', compact('categories','sliders'));
//        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(6)->get();
//
//        $skip_product_0 = null;
//        $skip_product_1 = null;
//        $skip_product_2 = null;
//        $skip_category_0 = Category::skip(0)->first();
//        if ($skip_category_0) {
//            $skip_product_0 = Product::/*where('status', 1)->*/ where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->get();
//        }
//
//        $skip_category_1 = Category::skip(1)->first();
//        if ($skip_category_1) {
//            $skip_product_1 = Product::/*where('status', 1)->*/ where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->get();
//        }
//
//        $skip_category_2 = Category::skip(2)->first();
//        if ($skip_category_2) {
//            $skip_product_2 = Product::/*where('status', 1)->*/ where('category_id', $skip_category_2->id)->orderBy('id', 'DESC')->get();
//        }



        // return $skip_category->id;
        // die();

//        return view('front.index', compact('categories', 'sliders', 'products', /*'featured', 'hot_deals',*/ 'special_offer', /*'special_deals',*/ 'skip_category_0', 'skip_product_0', 'skip_category_1', 'skip_product_1', 'skip_category_2', 'skip_product_2'/*, 'skip_brand_1', 'skip_brand_product_1', 'blogpost'*/));

    }


//    public function UserLogout()
//    {
//        Auth::logout();
//        return Redirect()->route('login');
//    }


    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('front.profile.user_profile', compact('user'));
    }


    public function UserProfileStore(Request $request)
    {
        $rules = $this->getRules();
        unset($rules['email']);
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        /*$data->email = $request->email;*/
        $data->phone = $request->phone;
        $data->address = $request->address;


        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/' . $data->profile_photo_path));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => __('User Profile Updated Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method


    public function UserChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('front.profile.change_password', compact('user'));
    }


    public function UserPasswordUpdate(Request $request)
    {

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            $notification = array(
                'message' => __('Password changed Successfully'),
                'alert-type' => 'success'
            );
            auth('web')->logout();
            return redirect()->route('login')->with($notification);
        } else {
            $notification = array(
                'message' => __('Password incorrect'),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


    }// end method


    public function ProductDetails($id)
    {
        $product = Product::with('multiimg')->findOrFail($id);

        $color_en = $product->color_en;
        $product_color_en = explode(',', $color_en);

        $color_ar = $product->color_ar;
        $product_color_ar = explode(',', $color_ar);

        $multiImag = MultiImg::where('product_id', $id)->get();

        $this->SEOTrait($product->name_en, '/' . $product->thumbnail);

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        return view('front.product.product_details', compact('product', 'multiImag', 'product_color_en', 'product_color_ar', 'relatedProduct'));

    }


    public function TagWiseProduct($tag)
    {
        $products = Product::where('status', 1)->where('product_tags_en', $tag)->where('product_tags_hin', $tag)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('front.tags.tags_view', compact('products', 'categories'));

    }


    // Subcategory wise data
    public function SubCatWiseProduct($subcat_id)
    {
        $products = Product::/*where('status', 1)->*/ where('subcategory_id', $subcat_id)->orderBy('id', 'DESC')->paginate(6);
        $categories = Category::orderBy('name_en', 'ASC')->get();

        $breadsubcat = SubCategory::with(['category'])->where('id', $subcat_id)->get();


        ///  Load More Product with Ajax
        /*if ($request->ajax()) {
            $grid_view = view('front.product.grid_view_product', compact('products'))->render();

            $list_view = view('front.product.list_view_product', compact('products'))->render();
            return response()->json(['grid_view' => $grid_view, 'list_view', $list_view]);

        }*/
        ///  End Load More Product with Ajax

        return view('front.product.subcategory_view', compact('products', 'categories', 'breadsubcat'));

    }

    // Category wise data
    public function CatWiseProduct($cat_id)
    {
        $products = Product::/*where('status', 1)->*/ where('category_id', $cat_id)->orderBy('id', 'DESC')->paginate(6);
        $categories = Category::orderBy('name_en', 'ASC')->get();

        $breadsubcat = SubCategory::with(['category'])->where('id', $cat_id)->get();


        return view('front.product.subcategory_view', compact('products', 'categories', 'breadsubcat'));

    }

    public function special_offer()
    {
        $products = Product::where('special_offer', 1)->orderBy('id', 'DESC')->paginate(6);
        return view('front.product.subcategory_view', compact('products'));
    }

    public function best_seller()
    {
        $products = Product::where('best_seller', 1)->orderBy('id', 'DESC')->paginate(6);
        return view('front.product.subcategory_view', compact('products'));
    }

    // Sub-Subcategory wise data
    public function SubSubCatWiseProduct($subsubcat_id, $slug)
    {
        $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcat_id)->orderBy('id', 'DESC')->paginate(6);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        $breadsubsubcat = SubSubCategory::with(['category', 'subcategory'])->where('id', $subsubcat_id)->get();

        return view('front.product.sub_subcategory_view', compact('products', 'categories', 'breadsubsubcat'));

    }


    /// Product View With Ajax
    public function ProductViewAjax($id)
    {
        $product = Product::with('category')->findOrFail($id);

        if (app()->getLocale() === 'en') {
            $color = $product->color_en;
        } else {
            $color = $product->color_ar;
        }

        $product_color = explode(',', $color);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
        ));

    } // end method

    // Product Seach
    public function ProductSearch(Request $request)
    {

        $request->validate(["search" => "required"]);

        $item = $request->search;
        // echo "$item";
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('product_name_en', 'LIKE', "%$item%")->get();
        return view('front.product.search', compact('products', 'categories'));

    } // end method


    ///// Advance Search Options

    public function SearchProduct(Request $request)
    {

        $rules = [
            'search' => 'required',
        ];

        $customMSG = [
            'search.required' => __('Search field is required'),
        ];

        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $item = $request->search;
        $cateory = $request->category;
//        return $cateory;

        if ($cateory === 'all') {
            $products = Product::where('name_en', 'LIKE', "%$item%")->orWhere('name_ar', 'LIKE', "%$item%")->paginate(6);
        } else {
            $products = Product::with('category')->where('category_id', $cateory)->where(function ($query) use ($item) {
                $query->where('name_en', 'LIKE', "%$item%")->orWhere('name_ar', 'LIKE', "%$item%");
            })->paginate(6);
        }

        return view('front.product.subcategory_view', compact('products'));


    } // end method


    public function contact_us(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'msg' => 'required'
        ];

        $customMSG = [
            'name.required' => __('Must enter the name'),
            'email.required' => __('Must enter an email'),
            'email.email' => __('Must be valid email'),
            'msg.required' => __('Must enter the message')
        ];

        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $email_data = [
            'name' => $request->name,
            'email' => $request->email,
            'msg' => $request->msg
        ];

        Mail::to('info@zurrostore.com')->send(new ContactUs($email_data));

        $notification = array(
            'message' => __('Email sent successfully'),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
