<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Hr\RegisterRequest;
use App\Models\Hr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class HrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hrs = Hr::orderBy("id", "desc")->get();
        return view("admin.hr.index", compact('hrs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.hr.create");
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
        $hr = new Hr($request->all());
        $hr->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mediaName = $hr->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/hrs";
            $file->move($destinationPath,$mediaName);
            $hr->image = URL::to("/backend/assets/hrs/$mediaName");
            $hr->update();
        }

        Mail::send("emails.registration.hr",['hr' => $hr, 'password' => $password], function($m) use ($hr) {
            $m->from("admin@abdullahfireprotection.com.pk", "Admin");
            $m->to($hr->email);
            $m->subject("Hr Registration!!!");
        });

        return redirect()->route("admin.hr.index")->with("success", "Hr added successfully!");
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
    public function destroy(Hr $hr)
    {
        $hr->delete();
        return redirect()->back()->with("success", "Hr Deleted Successfully");
    }
}
