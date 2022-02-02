<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class CategoryController extends Controller
{
    protected function getRules()
    {
        return [
            'name_en' => 'required',//|unique:categories',
            'name_ar' => 'required',//|unique:categories',
        ];
    }

    protected function getMSG()
    {
        return [
            'name_en.required' => __('Must enter the name'),
            'name_ar.required' => __('Must enter the name'),
            'name_en.unique' => __('Name should be unique'),
            'name_ar.unique' => __('Name should be unique')
        ];
    }

    public function CategoryView()
    {
        $category = Category::latest()->get();
        return view('admin.category.category_view', compact('category'));
    }

    public function CategoryStore(Request $request)
    {
        $save_img = null;
        if ($request->file('img')) {
            $img = $request->file('img');
            $name_gen = md5($img->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $img->getClientOriginalExtension();
            Image::Make($img)->resize(200, 200)->save(public_path('/upload/category/' . $name_gen));
            $save_img = 'upload/category/' . $name_gen;
        }

        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $category = Category::create([
            'name_en' => strtolower($request->name_en),
            'name_ar' => $request->name_ar,
            'img' => $save_img,
        ]);
        if ($category) {
            $notification = array(
                'message' => __('Category added successfully'),
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => __('Can not added category'),
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function CategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request)
    {
        $rules = $this->getRules();
        $customMSG = $this->getMSG();
        $validator = Validator::make($request->all(), $rules, $customMSG);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $id = $request->id;

        $category = Category::findOrFail($id);
        if ($request->file('img')) {
            if ($category->img != null) {
                if (file_exists(public_path($category->img))) {
                    unlink(public_path($category->img));
                }
            }
            $img = $request->file('img');
            $name_gen = md5($img->getClientOriginalName()) . strtotime(Carbon::now()) . '.' . $img->getClientOriginalExtension();
            Image::Make($img)->resize(200, 200)->save(public_path('/upload/category/' . $name_gen));
            $save_img = 'upload/category/' . $name_gen;
            $category->update([
                'name_en' => strtolower($request->name_en),
                'name_ar' => $request->name_ar,
                'img' => $save_img
            ]);
        } else {
            $category->update([
                'name_en' => strtolower($request->name_en),
                'name_ar' => $request->name_ar
            ]);
        }

        $notification = [
            'message' => __('Category update successfully'),
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notification);
    }

    public function CategoryDelete($id)
    {
        $category = Category::findOrFail($id);
        if ($category->img != null) {
            if (file_exists(public_path($category->img))) {
                unlink(public_path($category->img));
            }
        }
        $products = Product::where('category_id', $id)->get();
        foreach ($products as $product) {
            $product->update([
                'category_id' => 0
            ]);
        }
        $category->delete();

        $notification = [
            'message' => __('Category deleted successfully'),
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
