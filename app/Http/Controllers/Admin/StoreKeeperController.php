<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreKeeper\RegisterRequest;
use App\Models\StoreKeeper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class StoreKeeperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store_keepers = StoreKeeper::orderBy("id", "desc")->get();
        return view("admin.store_keeper.index", compact('store_keepers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.store_keeper.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $password = Str::random(10);
        $request["password"] = Hash::make($password);
        $store_keeper = new StoreKeeper($request->all());
        $store_keeper->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mediaName = $store_keeper->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/store_keepers";
            $file->move($destinationPath,$mediaName);
            $store_keeper->image = URL::to("/backend/assets/store_keepers/$mediaName");
            $store_keeper->update();
        }

        Mail::send("emails.registration.store_keeper",['store_keeper' => $store_keeper, 'password' => $password], function($m) use ($store_keeper) {
            $m->from("admin@abdullahfireprotection.com.pk", "Admin");
            $m->to($store_keeper->email);
            $m->subject("StoreKeeper Registration!!!");
        });

        return redirect()->route("admin.store_keeper.index")->with("success", "StoreKeeper added successfully!");
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreKeeper $store_keeper)
    {
        $store_keeper->delete();
        return redirect()->back()->with("success", "StoreKeeper Deleted Successfully");
    }
}
