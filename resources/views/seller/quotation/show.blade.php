@extends("layouts.seller")

@section("title")
    Show Quotation
@stop

@section("styles")

@stop

@section("content")
    @include("includes.info-box")
        <div class="row">
            <div class="col-md-10 col-12 order-2 order-md-1" style="border-right: 2px solid black">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="company_name">Company Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="50" value="{{ $quotation->company_name }}"  name="company_name" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="person_name">Person Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="50" value="{{ $quotation->person_name }}"  name="person_name" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" value="{{ $quotation->address }}" maxlength="200"  name="address" >
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="designation">Designation:</label>
                            <input type="text" class="form-control" maxlength="50" value="{{ $quotation->designation }}"  name="designation" >
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="designation">STRN #:</label>
                            <input type="text" class="form-control" value="32-77-8761-604-40" readonly>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" class="form-control" value="{{ $quotation->subject }}" maxlength="50"  name="subject" >
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="designation">Date of Quote:</label>
                            <input type="text" class="form-control" value="{{ date("l, F, j, Y", strtotime($quotation->created_at)) }}" readonly>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="project">Project:</label>
                            <input type="text" class="form-control" value="{{ $quotation->project }}" maxlength="200"  name="project" >
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="validity">Validity:</label>
                            <input type="date" class="form-control"  value="{{ date("Y-m-d", strtotime($quotation->validity)) }}" maxlength="200"  name="validity" >
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" value="{{ $quotation->location }}" maxlength="200"  name="location" >
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="contact">Contact: <span class="text-danger">*</span></label>
                            <input type="number"
                                   oninput="javascript: if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                   class="form-control"  name="contact"  value="{{ $quotation->contact }}" required>
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="client_reference">Your Reference:</label>
                            <input type="text" class="form-control" value="{{ $quotation->client_reference }}" maxlength="200"  name="client_reference" >
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" value="{{ $quotation->email }}"  name="email" >
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="warranty">Warranty:</label>
                            <input type="text" class="form-control" value="{{ $quotation->warranty }}"  name="warranty" >
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <label for="">Include GST?:</label><br>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" value="yes" {{ $quotation->include_gst ? "checked" : "" }}  name="include_gst">
                            <label class="form-check-label">
                                Yes
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio"  name="include_gst" value="no" {{ $quotation->include_gst ? "" : "checked" }}>
                            <label class="form-check-label">
                                No
                            </label>
                        </div>
                    </div>



                    <div class="col-12 col-md-4">
                        <label for="">Select Terms:</label><br>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" {{ $quotation->selected_terms == "project_terms" ? "checked" : "" }} value="project_terms"  name="selected_terms">
                            <label class="form-check-label">
                                Project Terms
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio"  {{ $quotation->selected_terms == "general_terms" ? "checked" : "" }}  name="selected_terms" value="general_terms">
                            <label class="form-check-label">
                                General Terms
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="description">Quotation Description <span class="text-danger">*</span></label>
                        <input type="text" name="description" class="form-control" value="{{ $quotation->description }}" required>
                    </div>

                    <div class="col-12">
                        <label for="row_heading">Row Heading <span class="text-danger">*</span></label>
                        <input type="text" name="row_heading" class="form-control" value="{{ $quotation->row_heading }}" required>
                    </div>

                    <div class="container mt-3 col-12">
                        <table class="table table-sm table-bordered ">
                            <thead>
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Description</th>
                                <th style="width: 10px">Quantity</th>
                                <th style="width: 200px">Sale Price</th>
                                <th style="width: 200px">Total Price</th>
                                <th style="width: 10px">Discount</th>
                            </tr>
                            </thead>
                            <tbody id="appendProduct">
                            @foreach($quotation->Products as $product)
                                <tr id="product-{{ $product->id }}">
                                    <input type="hidden" name="product[]" value='{{ $product->id }}'>
                                    <td><input type="text" name="name[]"  required class="form-control" value='{{ $product->pivot->name }}'></td>
                                    <td><input type="text" maxlength="200" name="short_description[]" class="form-control" required value='{{ $product->pivot->short_description }}'></td>
                                    <td><input type="number" name="quantity[]" data-id="{{ $product->id }}" id="quantity_{{ $product->id }}" min="1" value="{{ $product->pivot->quantity }}" class="form-control quantity" required></td>
                                    <td><input type="text" name="sale_price[]" data-id="{{ $product->id }}" id="sale_price_{{ $product->id }}" class="form-control sale_price" min="1" required value='{{ $product->pivot->sale_price }}'></td>
                                    <td><input type="text" class="form-control" min="1" id="total_price_{{ $product->id }}" disabled value='{{ $product->pivot->total_price }}'></td>
                                    <td><input type="text" class="form-control" name="discount[]" min="1"  value='{{ $product->pivot->discount }}'></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-12 order-1 order-md-2">
                <div class="col-12">
                    @if(!$isPdfExist)
                        <a href="{{ route("seller.quotation.show", $quotation->id)."?pdf=true" }}" class="btn btn-secondary rounded-0 btn-block text-white">Generate PDF</a>
                        <small class="text-danger">Please generate PDF first to send quotation</small>
                        <button class="btn btn-info rounded-0 btn-block text-white"
                           href="#" disabled>Send To Whatsapp</button>
                        <button class="btn btn-secondary rounded-0 btn-block text-white" disabled>Send To Email</button>
                        <button class="btn btn-info rounded-0 btn-block text-white" disabled>Download</button>
                        <button class="btn btn-secondary rounded-0 btn-block text-white" disabled>Preview</button>
                    @else
                        <a href="{{ route("seller.quotation.show", $quotation->id)."?pdf=true" }}" class="btn btn-secondary rounded-0 btn-block text-white">Generate PDF</a>
                        <a class="btn btn-info rounded-0 btn-block text-white" target="_blank"
                           href="https://api.whatsapp.com/send?phone={{ $quotation->phone }}&text=Thanks for Quotation, %0aYour Quotation code is *{{ $quotation->code }}*.    %0aYou can download your quotation from following url %0a {{ URL::to("/quotations/$quotation->code.pdf") }}">
                            Send To Whatsapp</a>
                        <a href="{{ route("seller.quotation.show", $quotation->id)."?email=true" }}" class="btn btn-secondary rounded-0 btn-block text-white">Send To Email</a>
                        <a href="{{ route("seller.quotation.show", $quotation->id)."?download=true" }}" class="btn btn-info rounded-0 btn-block text-white">Download</a>
                        <a href="{{ route("seller.quotation.show", $quotation->id)."?preview=true" }}" target="_blank" class="btn btn-secondary rounded-0 btn-block text-white">Preview</a>
                    @endif
                        <a class="btn btn-info rounded-0 btn-block" href="{{ route("seller.quotation.edit", $quotation->id) }}">Create Revision</a>
                </div>

            </div>
        </div>

@stop

@section("scripts")

@stop