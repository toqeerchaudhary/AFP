<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Coordinator\RegisterRequest;
use App\Models\Coordinator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coordinators = Coordinator::orderBy("id", "desc")->get();
        return view("admin.coordinator.index", compact('coordinators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.coordinator.create");
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
        $coordinator = new Coordinator($request->all());
        $coordinator->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mediaName = $coordinator->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/coordinators";
            $file->move($destinationPath,$mediaName);
            $coordinator->image = URL::to("/backend/assets/coordinators/$mediaName");
            $coordinator->update();
        }

        Mail::send("emails.registration.coordinator",['coordinator' => $coordinator, 'password' => $password], function($m) use ($coordinator) {
            $m->from("admin@abdullahfireprotection.com.pk", "Admin");
            $m->to($coordinator->email);
            $m->subject("Coordinator Registration!!!");
        });

        return redirect()->route("admin.coordinator.index")->with("success", "Coordinator added successfully!");
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
    public function destroy(Coordinator $coordinator)
    {
        $coordinator->delete();
        return redirect()->back()->with("success", "Coordinator Deleted Successfully");
    }
}
