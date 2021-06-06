<?php

namespace App\Http\Controllers\Hr;

use App\Http\Requests\Hr\ProfileRequest;
use App\Models\Hr;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class HrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET["edit"])) {
            $hr = auth("hr")->user();
            return view("hr.profile",compact('hr'));
        }
        return view("hr.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        $hr = auth("hr")->user();
        return view("hr.profile",compact('hr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $hr = auth('hr')->user();
        $request['password'] = $request->password ? Hash::make($request->password) : $hr->password;

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $mediaName = $hr->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/hrs";
            $file->move($destinationPath,$mediaName);
            $request['image'] = URL::to("/backend/assets/hrs/$mediaName");
        }

        $hr->update($request->all());
        return redirect()->back()->with("success","Profile updated successfully");
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
