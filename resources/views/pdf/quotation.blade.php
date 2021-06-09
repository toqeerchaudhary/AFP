@php
    $totalPrice = 0;
    $totalGst = 0;
    $setting = \App\Models\Setting::first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link rel="stylesheet" href="{{ (isset($path) ? $path : public_path())."/backend/assets/libs/bootstrap/dist/css/bootstrap.min.css" }}">
    <style>
        table, th, td {
            border: 3px solid black;
            font-size: 10px;
        }

        h1 {
            font-size: 1.5rem;
        }

        p {
            font-size: 12px;
        }

        .bg-grey {
            background: #eae8e8;
        }

        @page {
            margin: 0cm 0cm;
        }
        body {
            margin-left: 0.5cm;
            margin-right: 0.5cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
        }


    </style>
</head>
<body>

<div style="position: relative">
    <div class="header mt-2">
        <img src="{{ (isset($path) ? $path : public_path()).'/images/quotation/header.png' }}" class="img-fluid w-100"  alt="">
    </div>



   <main>
       <div>
           <div style="float: left!important; width: 50%; font-size: 12px">
               Prepared For: <strong>{{ $quotation->company_name }}</strong><br>
               Address: <strong>{{ $quotation->address }}</strong>
           </div>

           <div style=" font-size: 12px">
               To: <strong>{{ $quotation->person_name }}</strong><br>
               Designation: <strong>{{ $quotation->designation }}</strong>
           </div>
       </div>

       <div style="clear: both!important;">
           <table class="table table-sm bg-grey" style="border-collapse: collapse!important;" cellpadding="5" cellspacing="0">
               <tbody>
               <tr>
                   <th>STRN #</th>
                   <td>32-77-8761-604-40</td>
                   <th>Subject</th>
                   <td>{{ $quotation->subject }}</td>
               </tr>
               <tr>
                   <th>Date of Quote</th>
                   <td>{{ date("l, F, j, Y", strtotime($quotation->created_at)) }}</td>
                   <th>Project</th>
                   <td>{{ $quotation->project }}</td>
               </tr>
               <tr>
                   <th>Validity</th>
                   <td>{{ date("l, F, j, Y", strtotime($quotation->validity)) }}</td>
                   <th>Location</th>
                   <td>{{ $quotation->location }}</td>
               </tr>
               <tr>
                   <th>Our Reference</th>
                   <td>{{ $quotation->reference }}</td>
                   <th>Contact</th>
                   <td>{{ $quotation->contact }}</td>
               </tr>
               <tr>
                   <th>Your Reference</th>
                   <td>{{ $quotation->client_reference }}</td>
                   <th>Email</th>
                   <td>{{ $quotation->email }}</td>
               </tr>
               </tbody>
           </table>
       </div>

       <div>
           <h1 class="text-center bg-grey" style="border: 3px solid black">Quotation</h1>
           <p>{{ $quotation->description }}</p>
       </div>

       <table class="table table-condensed">
           <tbody>
           <tr class="bg-grey">
               <th></th>
               <td colspan="6" class="text-center">
                   <strong>{{ $quotation->row_heading }}</strong>
               </td>
           </tr>
           <tr class="bg-grey table-sm  text-center">
               <th>Sr#</th>
               <th>Code</th>
               <th>DESCRIPTION & SPECIFICATION</th>
               <th>QTY</th>
               <th>UOM</th>
               <th>Unit Price</th>
               <th>Total Price</th>
           </tr>

           @foreach($quotation->Products as $product)
               <tr class="text-center">
                   <td>{{ $loop->iteration }}</td>
                   <td>{{ $product->code }}</td>
                   <td class="text-left">{{ $product->pivot->short_description }}</td>
                   <td>{{ $product->pivot->quantity }}</td>
                   <td>{{ ucfirst($product->Uom ? $product->Uom->name : "") }}</td>
                   <td>PKR {{ number_format($product->pivot->sale_price) }}</td>
                   {{--<td>{{ $product->pivot->discount }}</td>--}}
                   @php
                       $price = $product->pivot->discount ? ($product->pivot->total_price - ($product->pivot->discount * $product->pivot->total_price / 100)) : $product->pivot->total_price ;
                       $totalPrice += $price
                   @endphp
                   <td>PKR {{ number_format($price) }}</td>
               </tr>
           @endforeach

           @if($quotation->include_gst)
               <tr class="font-weight-bold">
                   <td></td>
                   <td colspan="5" align="right">Grand Total Without GST</td>
                   <td class="text-center">PKR {{ number_format($totalPrice) }}</td>
               </tr>
               <tr class="font-weight-bold">
                   <td></td>
                   <td colspan="5" align="right"> GST @ 17%</td>
                   <td class="text-center">PKR
                       @php
                           $totalGst = ($totalPrice * 17) / 100;
                       @endphp
                       {{ number_format($totalGst) }}
                   </td>
               </tr>
               <tr class="font-weight-bold">
                   <td></td>
                   <td colspan="5"  align="right"> Total Amount Inclusive of GST</td>
                   <td  class="text-center">PKR {{ number_format($totalGst + $totalPrice) }}</td>
               </tr>
           @else
               <tr class="font-weight-bold">
                   <td></td>
                   <td colspan="5"  align="right"> Total Amount</td>
                   <td class="text-center">PKR {{ number_format($totalPrice) }}</td>
               </tr>
           @endif

           </tbody>
       </table>


       <div>
           <h3>Terms & Conditions</h3>
           <div>
               @if($quotation->selected_terms == "general_terms")
                   {!! $setting->general_terms ? $setting->general_terms : "No Terms"  !!}
               @else
                   {!! $setting->project_terms ? $setting->project_terms : "No Terms"  !!}
               @endif
           </div>
       </div>
   </main>

    <div style="position: relative">
        <div style="position:  absolute; bottom: 0px!important;">
            <img src="{{(isset($path) ? $path : public_path()).'/images/quotation/footer.png' }}" class="img-fluid w-100"  alt="">
        </div>


    </div>
</div>

<script type="text/php">
    if (isset($pdf)) {
        $x = 550;
        $y = 800;
        $text = "{PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 12;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
{{--        $image = "{{ public_path()."/images/quotation/logo.png" }}";--}}
        {{--$pdf->image($image, 'png',800,0,50,100);--}}
        // header
        {{--$pdf->page_text(250,10,"",$font,$size,$color,$word_space,$char_space,$angle);--}}
        // footer
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>
</body>
</html>