<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Accountant\RegisterRequest;
use App\Models\Accountant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AccountantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountants = Accountant::orderBy("id", "desc")->get();
        return view("admin.accountant.index", compact('accountants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.accountant.create");
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
        $accountant = new Accountant($request->all());
        $accountant->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mediaName = $accountant->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/accountants";
            $file->move($destinationPath,$mediaName);
            $accountant->image = URL::to("/backend/assets/accountants/$mediaName");
            $accountant->update();
        }

        Mail::send("emails.registration.accountant",['accountant' => $accountant, 'password' => $password], function($m) use ($accountant) {
            $m->from("admin@abdullahfireprotection.com.pk", "Admin");
            $m->to($accountant->email);
            $m->subject("Accountant Registration!!!");
        });

        return redirect()->route("admin.accountant.index")->with("success", "Accountant added successfully!");
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
    public function destroy(Accountant $accountant)
    {
        $accountant->delete();
        return redirect()->back()->with("success", "Accountant Deleted Successfully");
    }
}
