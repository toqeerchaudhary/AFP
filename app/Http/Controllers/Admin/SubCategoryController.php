<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = SubCategory::orderBy('id','desc')->get();
        return view('admin.sub-category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.sub-category.create", compact('categories'));
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
        $category = new SubCategory($request->all());
        $category->save();


        return redirect()->back()->with("success","Sub Category Added Successfully");
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
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('admin.sub-category.edit',compact('categories','subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
//        dd($request->all());

        $this->validate($request, [
            'name' => "required|max:15|min:3",
            'category_id' => "required|integer",
        ]);

        $duplicateSubCategory = SubCategory::where("name",$request->name)->where("category_id",$request->category_id)->first();
        if ($duplicateSubCategory) {
            return redirect()->back()->with("fail","Name already exists");
        }
        $subCategory->update($request->all());
        return redirect()->route('admin.sub-category.index')->with("success","Sub Category Updated Successfully");

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
}
