<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Seller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class TestController extends Controller
{
    public function index() {
        $quotation = Quotation::find(24);
//        return view("pdf.quotation", compact('quotation'));
        $pdf = PDF::loadView('pdf.quotation', ['quotation' => $quotation]);
//        $font = $pdf->getFontMetrics()->get_font("helvetica", "bold");
//        $pdf->getCanvas()->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", "", 10, array(0,0,0));
        $pdf->save(public_path() . "/quotations/$quotation->code.pdf");
        return $pdf->stream(public_path() . "/quotations/$quotation->code.pdf", compact('pdf'));
//        $pdf->save(public_path()."/quotations/$quotation->code.pdf");

    }

    public function test() {
        $quotation = Quotation::find(24);
        $path = "";
        return view("welcome", compact('quotation', 'path'));
    }
}
