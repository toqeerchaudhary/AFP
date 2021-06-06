<?php

namespace App\Http\Controllers\Seller;

use App\Models\Inquiry;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquiries = auth("seller")->user()->Inquiries()->orderBy("id", "desc")->get();
        return view("seller.inquiry.index", compact('inquiries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("seller.inquiry.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'company_name' => "required|max:50|min:3",
            'person_name' => "required|max:50|min:3",
            'contact' => "required|max:10",
        ]);


        $data = $request->all();
        unset($data['product']);
        unset($data['name']);
        unset($data['quantity']);
        unset($data['short_description']);
        unset($data['sale_price']);
        $check = true;
        while ($check) {
            $code = $this->generateCode();
            $is_Found = Inquiry::where("code", $code)->first();
            if (!$is_Found) {
                $check = false;
            }
        }

        $currentMonthInquiries = Inquiry::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();;

        $inquiry = new Inquiry($data);
        $inquiry->seller_id = auth("seller")->id();
        $inquiry->code = $code;
        $inquiry->reference = date('y').date("m").++$currentMonthInquiries. " R-00 / SE";
        $inquiry->save();

        $i = 0;
        foreach($request->product as $p){
            if ($p == null) {
                $p = 0;
            }
            $quantity = $request->quantity[$i];
            $short_description = $request->short_description[$i];
            $sale_price = $request->sale_price[$i];
            $name = $request->name[$i];
            $total_price = $quantity * $sale_price;
            $ids[$p] = ['quantity' => $quantity, 'short_description' => $short_description,
                "sale_price" => $sale_price, 'total_price' => $total_price, 'name' => $name];
            $i++;
        }

        $inquiry->Products()->sync($ids);

        return redirect()->back()->with("success", "Inquiry added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Inquiry $inquiry)
    {
        return view("seller.inquiry.show", compact('inquiry'));
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
    public function destroy($id)
    {
        //
    }

    public function generateCode() {
        return mt_rand(100,9999).Str::random(4);
    }
}
