<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Seller\RegisterRequest;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::orderBy("id", "desc")->get();
        return view("admin.seller.index", compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.seller.create");
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
        $seller = new Seller($request->all());
        $seller->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mediaName = $seller->id.".".$file->getClientOriginalExtension();
            $destinationPath = $_SERVER['DOCUMENT_ROOT']."/backend/assets/sellers";
            $file->move($destinationPath,$mediaName);
            $seller->image = URL::to("/backend/assets/sellers/$mediaName");
            $seller->update();
        }

        Mail::send("emails.registration.seller",['seller' => $seller, 'password' => $password], function($m) use ($seller) {
            $m->from("admin@abdullahfireprotection.com.pk", "Admin");
            $m->to($seller->email);
            $m->subject("Seller Registration!!!");
        });

        return redirect()->route("admin.seller.index")->with("success", "Seller added successfully!");
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
    public function destroy(Seller $seller)
    {
        $seller->delete();
        return redirect()->back()->with("success", "Seller Deleted Successfully");
    }
}
