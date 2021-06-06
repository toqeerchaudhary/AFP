<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\Uom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $gst = 17;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy("id", "desc")->get();
        return view("admin.product.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $subCategories = SubCategory::all();
        $suppliers = Supplier::all();
        $uoms = Uom::all();
        return view("admin.product.create", compact('categories', 'brands', 'subCategories', 'suppliers', 'uoms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => "required|unique:products|max:50|min:3",
            'category_id' => "required|integer",
            'sub_category_id' => "required|integer",
            'brand_id' => "nullable|integer",
            'uom_id' => "nullable|integer",
            'supplier_id' => "nullable|integer",
            'quantity' => "required|integer",
            'sale_price' => "required",
            'purchase_price' => "required",
            'description' => "required|max:250",
            'short_description' => "required|max:160",
            'file'       => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,jpg',
        ]);

        $category_code = $request['category_code'];
        unset($request['category_code']);
        $check = true;

        while ($check) {
            $code = $this->generateCode($category_code);
            $is_Found = Product::where("code", $code)->first();
            if (!$is_Found) {
                $check = false;
            }
        }

        $product = new Product($request->all());
        $product['code'] = $code;
        $product['gst_tax'] = $this->gst;
        $product->save();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $mediaName = $product->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/documents";
            $file->move($destinationPath,$mediaName);
            $product['file_type'] = $file->getClientOriginalExtension();;
            $product['file'] = URL::to("/backend/assets/documents/$mediaName");
            $product->update();
        }

        return redirect()->back()->with("success", "Product added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $subCategories = SubCategory::all();
        $suppliers = Supplier::all();
        $uoms = Uom::all();
        return view("admin.product.edit", compact('product', 'categories', 'uoms', 'brands', 'subCategories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => "required|max:50|min:3|unique:products,name,".$product->id,
            'category_id' => "required|integer",
            'sub_category_id' => "required|integer",
            'brand_id' => "nullable|integer",
            'uom_id' => "nullable|integer",
            'supplier_id' => "nullable|integer",
            'quantity' => "required|integer",
            'sale_price' => "required",
            'purchase_price' => "required",
            'description' => "required|max:250",
            'short_description' => "required|max:160",
            'file'       => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,jpg',
        ]);

        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $mediaName = $product->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/documents";
            $file->move($destinationPath,$mediaName);
            $data['file_type'] = $file->getClientOriginalExtension();;
            $data['file'] = URL::to("/backend/assets/documents/$mediaName");
        }
        $data['gst_tax'] = $this->gst;
        $product->update($data);
        return redirect()->back()->with("success", "Product updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generateCode($code) {
        return $code.mt_rand(100,999).Str::random(2);
    }
}
