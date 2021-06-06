<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Purchaser\RegisterRequest;
use App\Models\Purchaser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PurchaserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchasers = Purchaser::orderBy("id", "desc")->get();
        return view("admin.purchaser.index", compact('purchasers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.purchaser.create");
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
        $purchaser = new Purchaser($request->all());
        $purchaser->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mediaName = $purchaser->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/purchasers";
            $file->move($destinationPath,$mediaName);
            $purchaser->image = URL::to("/backend/assets/purchasers/$mediaName");
            $purchaser->update();
        }

        Mail::send("emails.registration.purchaser",['purchaser' => $purchaser, 'password' => $password], function($m) use ($purchaser) {
            $m->from("admin@abdullahfireprotection.com.pk", "Admin");
            $m->to($purchaser->email);
            $m->subject("Purchaser Registration!!!");
        });

        return redirect()->route("admin.purchaser.index")->with("success", "Purchaser added successfully!");
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
    public function destroy(Purchaser $purchaser)
    {
        $purchaser->delete();
        return redirect()->back()->with("success", "Purchaser Deleted Successfully");
    }
}
