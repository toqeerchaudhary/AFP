<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('id','desc')->get();
        return view('admin.supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.supplier.create");
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
            'name' => "required|unique:suppliers|max:15|min:3",
            'company' => "required|max:20|min:3",
            'phone' => "required|max:15|min:3",
            'address' => "required|max:50|min:3",
            'city' => "required|max:20|min:3",
            'color' => "required",
            'terms_conditions' => "required|max:1000",
            'image'       => 'nullable|mimes:jpeg,png,jpg',
        ]);

        $check = true;

        while ($check) {
            $code = $this->generateCode();
            $is_Found = Supplier::where("code", $code)->first();
            if (!$is_Found) {
                $check = false;
            }
        }
        $supplier = new Supplier($request->all());
        $supplier['code'] = $code;
        $supplier->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mediaName = $supplier->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/suppliers";
            $file->move($destinationPath,$mediaName);
            $supplier->image = URL::to("/backend/assets/suppliers/$mediaName");
            $supplier->update();
        }
        return redirect()->back()->with("success","Supplier Added Successfully");
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
    public function edit(Supplier $supplier)
    {
        return view("admin.supplier.edit", compact("supplier"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'name' => "required|max:15|min:3|unique:suppliers,name,".$supplier->id,
            'company' => "required|max:20|min:3",
            'phone' => "required|max:15|min:3",
            'address' => "required|max:50|min:3",
            'city' => "required|max:20|min:3",
            'color' => "required",
            'terms_conditions' => "required|max:1000",
            'img'       => 'nullable|mimes:jpeg,png,jpg'
        ]);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $mediaName = $supplier->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/suppliers";
            $file->move($destinationPath,$mediaName);
            $request['image'] = URL::to("/backend/assets/suppliers/$mediaName");
        }
       $data =  $request->all();
        unset($data['img']);
        $supplier->update($data);
        return redirect()->route('admin.supplier.index')->with("success","Supplier Updated Successfully");

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

    public function generateCode() {
        return mt_rand(100,999).Str::random(3);
    }
}
