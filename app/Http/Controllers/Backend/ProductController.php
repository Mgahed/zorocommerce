<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\ProductColor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class ProductController extends Controller
{
    protected function getRules()
    {
        return [
            'name_en' => 'required',
            'name_ar' => 'required',
            'code' => 'required',
            'quantity' => 'required|numeric|min:0',
            'color_en' => 'required',
            'color_ar' => 'required',
            'sell_price' => 'required|numeric|min:0',
            /*'discount_price' => 'numeric|min:0',*/
            'short_descp_en' => 'required',
            'short_descp_ar' => 'required',
            'long_descp_en' => 'required',
            'long_descp_ar' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
            'brand' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ];
    }

    protected function getMSG()
    {
        return [
            'name_en.required' => __('This field is required'),
            'name_ar.required' => __('This field is required'),
            'code.required' => __('This field is required'),
            'quantity.required' => __('This field is required'),
            'quantity.numeric' => __('Must be a number'),
            'quantity.min' => __('Must be greater than 0'),
            'color_en.required' => __('This field is required'),
            'color_ar.required' => __('This field is required'),
            'sell_price.required' => __('This field is required'),
            'sell_price.numeric' => __('Must be a number'),
            'sell_price.min' => __('Must be grater than 0'),
            /*'discount_price.numeric' => __('Must be a number'),
            'discount_price.min' => __('Must be grater than 0'),*/
            'short_descp_en.required' => __('This field is required'),
            'short_descp_ar.required' => __('This field is required'),
            'long_descp_en.required' => __('This field is required'),
            'long_descp_ar.required' => __('This field is required'),
            'thumbnail.required' => __('This field is required'),
            'brand.required' => __('This field is required'),
            'category_id.required' => __('This field is required'),
            'subcategory_id.required' => __('This field is required'),
        ];
    }

    public function AddProduct()
    {
        $categories = Category::orderBy('name_en', 'ASC')->get();
        return view('admin.product.product_add', compact('categories'));
    }

//    public function DuplicateProduct(Request $request)
//    {
////        return $request;
//        $check = Product::with('multiimg')->findOrFail($request->product_id);
//        $flag = true;
//        $check_product = Product::where('code', $check->code)->get();
//        foreach ($check_product as $product) {
//            if ($product->category_id == $request->category_id) {
//                $flag = false;
//            }
//        }
////        return $flag;
//        if ($check->category_id == $request->category_id || !$flag) {
//            $notification = [
//                'message' => __('Product already have this category'),
//                'alert-type' => 'error'
//            ];
//            return redirect()->back()->with($notification);
//        }
//        /*----- Duplicate -----*/
//        $oldPath = $check->thumbnail;
//        $fileExtension = \File::extension($oldPath);
//        $newName = md5(rand()) . strtotime(Carbon::now()) . '.' . $fileExtension;
////        $newName = 'new file.'.$fileExtension;
////        $newPathWithName = 'images/'.$newName;
//        $newPathWithName = public_path('/upload/products/thumbnail/' . $newName);
//        \File::copy(public_path($oldPath), $newPathWithName);
////        $thumbnail_img = $request->file('thumbnail');
////        Image::Make($thumbnail_img)->resize(400, 400)->save(public_path('/upload/products/thumbnail/' . $name_gen));
////        $save_thumbnail_img = 'upload/products/thumbnail/' . $name_gen;
//        $product = Product::create([
//            'name_en' => strtolower($check->name_en),
//            'name_ar' => $check->name_ar,
//            'code' => $check->code,
//            'quantity' => $check->quantity,
//            'color_en' => $check->color_en,
//            'color_ar' => $check->color_ar,
//            'sell_price' => $check->sell_price,
//            'discount_price' => $check->discount_price,
//            'short_descp_en' => $check->short_descp_en,
//            'short_descp_ar' => $check->short_descp_ar,
//            'long_descp_en' => $check->long_descp_en,
//            'long_descp_ar' => $check->long_descp_ar,
//            'thumbnail' => 'upload/products/thumbnail/' . $newName,
//            'special_offer' => $check->special_offer ? $check->special_offer : 0,
//            'best_seller' => $check->best_seller ? $check->best_seller : 0,
//            'brand' => $check->brand,
//            'category_id' => $request->category_id,
//            'subcategory_id' => null,
//        ]);
//
//        /*----- Multi IMG Upload -----*/
////        $multi_imgs = $request->file('multi_img');
//        $product_id = Product::orderBy('id', 'desc')->first();
//        if ($check->multiimg) {
//            foreach ($check->multiimg as $multi_img) {
//                $oldPath = $multi_img->name;
//                $fileExtension = \File::extension($oldPath);
//                $newName = md5(rand()) . strtotime(Carbon::now()) . '.' . $fileExtension;
//                $newPathWithName = public_path('/upload/products/multi-image/' . $newName);
//                \File::copy(public_path($oldPath), $newPathWithName);
//
//                /*$name_gen = md5($multi_img->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $multi_img->getClientOriginalExtension();
//                Image::Make($multi_img)->resize(400, 400)->save(public_path('/upload/products/multi-image/' . $name_gen));
//                $save_multi_img = 'upload/products/multi-image/' . $name_gen;*/
//
//                MultiImg::create([
//                    'product_id' => $product_id->id,
//                    'name' => 'upload/products/multi-image/' . $newName,
//                ]);
//            }
//        }
//        $notification = [
//            'message' => __('Product added successfully'),
//            'alert-type' => 'success'
//        ];
//        return redirect()->back()->with($notification);
//    }

    public function StoreProduct(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $colors_en = explode(',', $request->color_en);
        $colors_ar = explode(',', $request->color_ar);
        if (count($colors_en) != count($colors_ar)) {
            $notification = [
                'message' => __('Numbers of colors must be same'),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }

//        return $request;
        $thumbnail_img = $request->file('thumbnail');
        $name_gen = md5($thumbnail_img->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $thumbnail_img->getClientOriginalExtension();
        Image::Make($thumbnail_img)->resize(400, 400)->save(public_path('/upload/products/thumbnail/' . $name_gen));
        $save_thumbnail_img = 'upload/products/thumbnail/' . $name_gen;

        $product = Product::create([
            'name_en' => strtolower($request->name_en),
            'name_ar' => $request->name_ar,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'color_en' => $request->color_en,
            'color_ar' => $request->color_ar,
            'sell_price' => $request->sell_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ar' => $request->short_descp_ar,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ar' => $request->long_descp_ar,
            'thumbnail' => $save_thumbnail_img,
            'special_offer' => $request->special_offer ? $request->special_offer : 0,
            'best_seller' => $request->best_seller ? $request->best_seller : 0,
            'brand' => $request->brand,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id == 'null' ? null : $request->subcategory_id
        ]);

        /*----- create color in productcolors table -----*/
        $latest_product_id = Product::latest()->first('id');
        foreach ($colors_en as $key => $item) {
            ProductColor::create([
                'color_en' => $item,
                'color_ar' => $colors_ar[$key],
                'qty' => $request->quantity / count($colors_en),
                'product_color_id' => $latest_product_id->id
            ]);
        }

        /*----- Multi IMG Upload -----*/
        $multi_imgs = $request->file('multi_img');
        $product_id = Product::orderBy('id', 'desc')->first();
        if ($multi_imgs) {
            foreach ($multi_imgs as $multi_img) {
                $name_gen = md5($multi_img->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $multi_img->getClientOriginalExtension();
                Image::Make($multi_img)->resize(400, 400)->save(public_path('/upload/products/multi-image/' . $name_gen));
                $save_multi_img = 'upload/products/multi-image/' . $name_gen;

                MultiImg::create([
                    'product_id' => $product_id->id,
                    'name' => $save_multi_img,
                ]);
            }
        }
        $notification = [
            'message' => __('Product added successfully'),
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function ManageProduct()
    {
        $products = Product::withTrashed()->with('category')->latest()->get();
        return view('admin.product.product_view', compact('products'));
    }

    public function EditProduct($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::orderBy('name_en', 'asc')->get();
        $product = Product::with('category')/*->with('subcategory')*/ ->findOrFail($id);

        return view('admin.product.product_edit', compact('product', 'categories', 'multiImgs'));
    }

    public function ProductDataUpdate(Request $request)
    {
        $rules = $this->getRules();
        unset($rules['thumbnail']);
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        Product::findOrFail($request->id)->update([
            'name_en' => strtolower($request->name_en),
            'name_ar' => $request->name_ar,
            'code' => $request->code,
            'quantity' => $request->quantity,
            /*'color_en' => $request->color_en,
            'color_ar' => $request->color_ar,*/
            'sell_price' => $request->sell_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ar' => $request->short_descp_ar,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ar' => $request->long_descp_ar,
            'special_offer' => $request->special_offer ? $request->special_offer : 0,
            'best_seller' => $request->best_seller ? $request->best_seller : 0,
            'brand' => $request->brand,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id == 'null' ? null : $request->subcategory_id
        ]);
        $products = Product::where('code', $request->code)->get();
        foreach ($products as $product) {
            Product::findOrFail($product->id)->update(['quantity' => $request->quantity]);
        }

        $notification = [
            'message' => __('Product updated without updating Images'),
            'alert-type' => 'success'
        ];

        return redirect()->route('manage-product')->with($notification);
    }

    public function MultiImageUpdate(Request $request)/*----- For multi img update -----*/
    {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            if (file_exists(public_path($imgDel->name))) {
                unlink(public_path($imgDel->name));
            }
            $name_gen = md5($img->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $img->getClientOriginalExtension();
            Image::Make($img)->resize(400, 400)->save(public_path('/upload/products/multi-image/' . $name_gen));
            $save_multi_img = 'upload/products/multi-image/' . $name_gen;

            $imgDel->update([
                'name' => $save_multi_img,
            ]);
        }

        $notification = [
            'message' => __('Product multi image updated successfully'),
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function ThambnailImageUpdate(Request $request)
    {
        $rules = [
            "product_thumbnail" => 'required'
        ];
        $customMSG = [
            "product_thumbnail.required" => __('This field is required')
        ];
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $product_id = $request->id;
        $oldImg = $request->old_img;
        if (file_exists(public_path($oldImg))) {
            unlink(public_path($oldImg));
        }

        $img = $request->file('product_thumbnail');

        $name_gen = md5($img->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $img->getClientOriginalExtension();
        Image::Make($img)->resize(400, 400)->save(public_path('/upload/products/thumbnail/' . $name_gen));
        $save_multi_img = 'upload/products/thumbnail/' . $name_gen;

        Product::findOrFail($product_id)->update([
            'thumbnail' => $save_multi_img
        ]);

        $notification = [
            'message' => __('Product main image updated successfully'),
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function MultiImageDelete($id)
    {
        $img = MultiImg::findOrFail($id);
        if (file_exists(public_path($img->name))) {
            unlink(public_path($img->name));
        }
        $delete = $img->delete();
        if ($delete) {
            $notification = [
                'message' => __('Image deleted successfully'),
                'alert-type' => 'success'
            ];
            return redirect()->back()->with($notification);
        }
        $notification = [
            'message' => __('Can not delete image successfully'),
            'alert-type' => 'error'
        ];
        return redirect()->back()->with($notification);
    }

    public function ProductDelete($id)
    {
        $product = Product::with('multiimg')->findOrFail($id);
        foreach ($product->multiimg as $img) {
            if (file_exists(public_path($img->name))) {
                unlink(public_path($img->name));
            }
            MultiImg::findOrFail($img->id)->delete();
        }
        if (file_exists(public_path($product->thumbnail))) {
            unlink(public_path($product->thumbnail));
        }
        $delete = $product->forceDelete();
        if ($delete) {
            $notification = [
                'message' => __('Product deleted successfully'),
                'alert-type' => 'success'
            ];
            return redirect()->back()->with($notification);
        }
        $notification = [
            'message' => __('Can not delete product'),
            'alert-type' => 'error'
        ];
        return redirect()->back()->with($notification);
    }

    public function ProductNotification()
    {
        $products = Product::where('quantity', '<=', 5)->get();
        return view('admin.product.product_view', compact('products'));

    }

    public function ProductFreeShipping(Request $request)
    {
        $product = Product::findOrFail($request->product_id_shipping);
        $products = Product::where('code', $product->code)->get();
        foreach ($products as $item) {
            $item->update([
                'free_shipping' => $request->date
            ]);
        }
        return redirect()->back();
    }

    public function GetAllProducts($category_id, $subcategory_id)
    {
        $products = Product::where('category_id', $category_id)->where('subcategory_id', $subcategory_id)->orderBy('name_en', 'ASC')->get();
        return json_encode($products);
    }

    public function deactivate($id)
    {
        Product::findOrFail($id)->delete();
        $notification = [
            'message' => __('Product deactivated successfully'),
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }

    public function activate($id)
    {
        Product::onlyTrashed()->findOrFail($id)->restore();
        $notification = [
            'message' => __('Product activated successfully'),
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }

    public function ProductColorEdit($product_id)
    {
        $qty = Product::findOrFail($product_id)->quantity;
        $product_colors = ProductColor::where('product_color_id', $product_id)->get();
        return view('admin.product.product_colors_edit', compact('product_colors', 'qty'));
    }

    public function ProductColorUpdate($id, Request $request)
    {
        ProductColor::findOrFail($id)->update([
            'qty' => $request->qty
        ]);

        $notification = [
            'message' => __('Quantity Updated Successfully'),
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }

    public function ProductColorAdd(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $final_color_en = $product->color_en . "," . $request->color_en;
        $final_color_ar = $product->color_ar . "," . $request->color_ar;
        $product->update([
            'color_en' => $final_color_en,
            'color_ar' => $final_color_ar
        ]);

        ProductColor::create([
            'color_en' => $request->color_en,
            'color_ar' => $request->color_ar,
            'product_color_id' => $request->product_id
        ]);
        return redirect()->back();
    }

    public function ProductMultiimgAdd(Request $request)
    {

        /*----- Multi IMG Upload -----*/
        $multi_imgs = $request->file('multi_img');
        $product_id = $request->product_id;
        if ($multi_imgs) {
            foreach ($multi_imgs as $multi_img) {
                $name_gen = md5($multi_img->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $multi_img->getClientOriginalExtension();
                Image::Make($multi_img)->resize(400, 400)->save(public_path('/upload/products/multi-image/' . $name_gen));
                $save_multi_img = 'upload/products/multi-image/' . $name_gen;

                MultiImg::create([
                    'product_id' => $product_id,
                    'name' => $save_multi_img,
                ]);
            }
        }
        $notification = [
            'message' => __('Images added successfully'),
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
