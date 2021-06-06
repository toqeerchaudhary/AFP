<?php

namespace App\Http\Controllers\Admin;

use App\Models\Uom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uoms = Uom::orderBy('id','desc')->get();
        return view('admin.uom.index',compact('uoms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.uom.create");
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
            'name' => "required|unique:uoms|max:15|min:3",
        ]);
        $uom = new Uom($request->all());
        $uom->save();
        return redirect()->back()->with("success","Uom Added Successfully");
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
    public function edit(Uom $uom)
    {
        return view("admin.uom.edit", compact("uom"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Uom $uom)
    {
        $this->validate($request, [
            'name' => "required|max:15|min:3|unique:uoms,name,".$uom->id,
        ]);

        $uom->update($request->all());
        return redirect()->route('admin.uom.index')->with("success","Uom Updated Successfully");

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
