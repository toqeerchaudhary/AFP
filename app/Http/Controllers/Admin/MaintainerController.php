<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Maintainer\RegisterRequest;
use App\Models\Maintainer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class MaintainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintainers = Maintainer::orderBy("id", "desc")->get();
        return view("admin.maintainer.index", compact('maintainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.maintainer.create");
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
        $maintainer = new Maintainer($request->all());
        $maintainer->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mediaName = $maintainer->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/maintainers";
            $file->move($destinationPath,$mediaName);
            $maintainer->image = URL::to("/backend/assets/maintainers/$mediaName");
            $maintainer->update();
        }

        Mail::send("emails.registration.maintainer",['maintainer' => $maintainer, 'password' => $password], function($m) use ($maintainer) {
            $m->from("admin@abdullahfireprotection.com.pk", "Admin");
            $m->to($maintainer->email);
            $m->subject("Maintainer Registration!!!");
        });

        return redirect()->route("admin.maintainer.index")->with("success", "Maintainer added successfully!");
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
    public function destroy(Maintainer $maintainer)
    {
        $maintainer->delete();
        return redirect()->back()->with("success", "Maintainer Deleted Successfully");
    }
}
