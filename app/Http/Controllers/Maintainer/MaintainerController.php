<?php

namespace App\Http\Controllers\Maintainer;

use App\Http\Requests\Maintainer\ProfileRequest;
use App\Models\Maintainer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class MaintainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET["edit"])) {
            $maintainer = auth("maintainer")->user();
            return view("maintainer.profile",compact('maintainer'));
        }
        return view("maintainer.index");
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
        $maintainer = auth("maintainer")->user();
        return view("maintainer.profile",compact('maintainer'));
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
        $maintainer = auth('maintainer')->user();
        $request['password'] = $request->password ? Hash::make($request->password) : $maintainer->password;

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $mediaName = $maintainer->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/maintainers";
            $file->move($destinationPath,$mediaName);
            $request['image'] = URL::to("/backend/assets/maintainers/$mediaName");
        }

        $maintainer->update($request->all());
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
