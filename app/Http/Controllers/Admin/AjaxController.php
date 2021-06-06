<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Uom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AjaxController extends Controller
{
    public function addCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => "required|unique:categories|max:15|min:3",
            'code' => "required|unique:categories|max:5|min:3",
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->errors()->all()],422);
        }
        $category = new Category($request->all());
        $category->save();
        $categories = Category::all();
        return response()->json(["success" => true, "message" => "Success", 'categories' => $categories],200);

    }

    public function addBrand(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => "required|unique:brands|max:15|min:3",
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->errors()->all()],422);
        }
        $brand = new Brand($request->all());
        $brand->save();
        $brands = Brand::all();
        return response()->json(["success" => true, "message" => "Success", 'brands' => $brands],200);
    }

    public function addUom(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => "required|unique:uoms|max:15|min:3",
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->errors()->all()],422);
        }
        $uom = new Uom($request->all());
        $uom->save();
        $uoms = Uom::all();
        return response()->json(["success" => true, "message" => "Success", 'uoms' => $uoms],200);
    }

    public function addSubCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_id' => "required|integer",
            'name' =>  [
                'required',
                'max:15',
                'min:3',
                Rule::unique('sub_categories')->where(function ($query) use ($request) {
                    return $query->where('category_id',$request->category_id);
                })
            ],
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->errors()->all()],422);
        }
        $category = new SubCategory($request->all());
        $category->save();
        return response()->json(["success" => true, "message" => "Success"],200);
    }
}
