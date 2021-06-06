<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Requests\Coordinator\ProfileRequest;
use App\Models\Coordinator;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class CoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET["edit"])) {
            $coordinator = auth("coordinator")->user();
            return view("coordinator.profile",compact('coordinator'));
        }
        return view("coordinator.index");
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
        $coordinator = auth("coordinator")->user();
        return view("coordinator.profile",compact('coordinator'));
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
        $coordinator = auth('coordinator')->user();
        $request['password'] = $request->password ? Hash::make($request->password) : $coordinator->password;

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $mediaName = $coordinator->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/coordinators";
            $file->move($destinationPath,$mediaName);
            $request['image'] = URL::to("/backend/assets/coordinators/$mediaName");
        }

        $coordinator->update($request->all());
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
