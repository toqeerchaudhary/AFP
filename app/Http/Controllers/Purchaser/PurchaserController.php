<?php

namespace App\Http\Controllers\Purchaser;

use App\Http\Requests\Purchaser\ProfileRequest;
use App\Models\Purchaser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class PurchaserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET["edit"])) {
            $purchaser = auth("purchaser")->user();
            return view("purchaser.profile",compact('purchaser'));
        }
        return view("purchaser.index");
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
        $purchaser = auth("purchaser")->user();
        return view("purchaser.profile",compact('purchaser'));
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
        $purchaser = auth('purchaser')->user();
        $request['password'] = $request->password ? Hash::make($request->password) : $purchaser->password;

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $mediaName = $purchaser->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/purchasers";
            $file->move($destinationPath,$mediaName);
            $request['image'] = URL::to("/backend/assets/purchasers/$mediaName");
        }

        $purchaser->update($request->all());
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
