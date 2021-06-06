<?php

namespace App\Http\Controllers\StoreKeeper;

use App\Http\Requests\StoreKeeper\ProfileRequest;
use App\Models\StoreKeeper;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class StoreKeeperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET["edit"])) {
            $store_keeper = auth("store_keeper")->user();
            return view("store_keeper.profile",compact('store_keeper'));
        }
        return view("store_keeper.index");
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
        $store_keeper = auth("store_keeper")->user();
        return view("store_keeper.profile",compact('store_keeper'));
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
        $store_keeper = auth('store_keeper')->user();
        $request['password'] = $request->password ? Hash::make($request->password) : $store_keeper->password;

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $mediaName = $store_keeper->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/store_keepers";
            $file->move($destinationPath,$mediaName);
            $request['image'] = URL::to("/backend/assets/store_keepers/$mediaName");
        }

        $store_keeper->update($request->all());
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
