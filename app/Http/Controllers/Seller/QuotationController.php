<?php

namespace App\Http\Controllers\Seller;

use App\Models\Customer;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Quotation;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['inquiry'])) {
            $id = $_GET['inquiry'];
            $inquiry = Inquiry::find($id);
            if (!$inquiry) {
                return redirect()->back()->with("fail", "No inquiry found");
            }
//            elseif (Quotation::where("reference", $inquiry->reference)->first()) {
//                return redirect()->route("seller.inquiry.show", $inquiry->id)->with("fail", "Quotation already generated for this inquiry");
//            }
            return view("seller.quotation.inquiry", compact('inquiry'));
        }
        $quotations = auth("seller")->user()->Quotations()->orderBy("id", "desc")->get();
        return view("seller.quotation.index", compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("seller.quotation.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'company_name' => "required|max:50|min:3",
            'person_name' => "required|max:50|min:3",
            'contact' => "required|max:10",
            'validity' => "required",
            'description' => "required",
            'row_heading' => "required|max:255",
        ]);

        $data = $request->all();
        unset($data['product']);
        unset($data['name']);
        unset($data['quantity']);
        unset($data['short_description']);
        unset($data['sale_price']);
        unset($data['discount']);
        $check = true;
        while ($check) {
            $code = $this->generateCode();
            $is_Found = Quotation::where("code", $code)->first();
            if (!$is_Found) {
                $check = false;
            }
        }

        $customer = $this->createCustomer($request);

        $quotation = new Quotation($data);
        $quotation->validity = date("Y-m-d", strtotime($request->validity));
        $quotation->revision_no = 0;
        $quotation->customer_id = $customer->id;
        $quotation->seller_id = auth("seller")->id();
        $quotation->include_gst = $request->include_gst == "no" ? 0 : 1;
        $quotation->code = $code;
        $quotation->reference = $request->reference;
        $quotation->save();

        $i = 0;
        foreach($request->product as $p){
            if ($p == null) {
                $p = 0;
            }
            $quantity = $request->quantity[$i];
            $short_description = $request->short_description[$i];
            $sale_price = $request->sale_price[$i];
            $name = $request->name[$i];
            $discount = $request->discount[$i] != "" ? $request->discount[$i] : null;
            $total_price = $quantity * $sale_price;
            $ids[$p] = ['quantity' => $quantity, 'short_description' => $short_description,
                "sale_price" => $sale_price, 'total_price' => $total_price, 'name' => $name, 'discount' => $discount];
            $i++;
        }
        $quotation->Products()->sync($ids);

        return redirect()->route("seller.quotation.index")->with("success", "Quotation added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        if (isset($_GET['pdf'])) {
            $pdf = PDF::loadView('pdf.quotation', ['quotation' => $quotation]);
            $pdf->save(public_path() . "/quotations/$quotation->code.pdf");
            return redirect()->back()->with("success", "PDF generated");
        }
         elseif(isset($_GET["email"])) {
             Mail::send("emails.quotation",['quotation' => $quotation], function($m) use ($quotation) {
                 $m->from("admin@abdullahfireprotection.com.pk", "Admin");
                 $m->to($quotation->email);
                 $m->subject("Quotation!!!");
                 $m->attach(public_path()."/quotations/$quotation->code.pdf");
             });
             return redirect()->back()->with("success", "Email Sent!!!");
         } elseif (isset($_GET["download"])) {
            $file= public_path()."/quotations/$quotation->code.pdf";
            $headers = array(
                'Content-Type: application/pdf',
            );

            return Response::download($file, "$quotation->code.pdf", $headers);
        }
        elseif (isset($_GET["preview"])) {
            $pdf = PDF::loadView('pdf.quotation', ['quotation' => $quotation]);
//            $pdf = new PDF();
            return $pdf->stream(public_path() . "/quotations/$quotation->code.pdf", compact('pdf'));
        }
        else {
            $isPdfExist = true;
            if (!file_exists(public_path()."/quotations/$quotation->code.pdf")) {
                $isPdfExist = false;
            }
            return view("seller.quotation.show", compact('quotation', 'isPdfExist'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(Quotation $quotation)
    {
        return view("seller.quotation.revision", compact('quotation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        $data = $request->all();
        unset($data['product']);
        unset($data['name']);
        unset($data['quantity']);
        unset($data['short_description']);
        unset($data['sale_price']);
        unset($data['discount']);

        $q = Quotation::where("code", $quotation->code)->orderBy("id", "desc")->first();
        $newRevisionNo = $q->revision_no + 1;
        $ref = explode("R-", $quotation->reference)[0];

        if ($newRevisionNo < 10) {
            $ref = $ref . "R-0".$newRevisionNo." / SE";
        } else {
            $ref = $ref . "R-".$newRevisionNo." / SE";
        }


        $neWquotation = new Quotation($quotation->toArray());
        $neWquotation->validity = date("Y-m-d", strtotime($request->validity));
        $neWquotation->revision_no = $newRevisionNo;
        $neWquotation->seller_id = auth("seller")->id();
        $neWquotation->include_gst = $request->include_gst == "no" ? 0 : 1;
        $neWquotation->selected_terms = $request->selected_terms;
        $neWquotation->reference = $ref;
        $neWquotation->row_heading = $request->row_heading;
        $neWquotation->description = $request->description;
        $neWquotation->code = $quotation->code;
        $neWquotation->created_at = Carbon::now();
        $neWquotation->updated_at = Carbon::now();
        $neWquotation->save();

        $i = 0;
        foreach($request->product as $p){
            if ($p == null) {
                $p = 0;
            }
            $quantity = $request->quantity[$i];
            $short_description = $request->short_description[$i];
            $sale_price = $request->sale_price[$i];
            $name = $request->name[$i];
            $discount = $request->discount[$i] != "" ? $request->discount[$i] : null;
            $total_price = $quantity * $sale_price;
            $ids[$p] = ['quantity' => $quantity, 'short_description' => $short_description,
                "sale_price" => $sale_price, 'total_price' => $total_price, 'name' => $name, 'discount' => $discount];
            $i++;
        }
        $neWquotation->Products()->sync($ids);
        return redirect()->route("seller.quotation.index")->with("success", "Revision created successfully");
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

    public function createCustomer($quotation) {
        $customer = Customer::where("contact", $quotation->contact)->first();
        if (!$customer) {
            $customer = new Customer();
            $customer->company_name = $quotation->company_name;
            $customer->name = $quotation->person_name;
            $customer->email = $quotation->email ? $quotation->email : "";
            $customer->contact = $quotation->contact;
            $customer->password = Hash::make($quotation->email);
            $customer->save();
        }
        return $customer;
    }
}
