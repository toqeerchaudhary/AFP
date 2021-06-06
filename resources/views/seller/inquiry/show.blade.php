@extends("layouts.seller")

@section("title")
    Check Inquiry
@stop

@section("styles")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    {{--    <link rel="stylesheet" href="{{ URL::to("backend/assets/libs/dist/css/select2.min.css") }}">--}}
    <style>
        .select2-selection__choice { color: black!important;}
        .tox-notifications-container {
            display: none!important;
        .select2-selection--multiple {
            height: 37px!important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #999;
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-right: 2px;
        }
        .select2-selection__choice__remove {
            background-color: #e8ecf3!important;
            border-color: #e8ecf3!important;;
            color: #fff;
        }

    </style>
@stop

@section("content")
    @include("includes.info-box")

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="company_name">Company Name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" minlength="3" maxlength="50" value="{{ $inquiry->company_name }}" name="company_name" required>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="person_name">Person Name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" minlength="3" maxlength="50" value="{{ $inquiry->person_name }}" name="person_name" required>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="contact">Contact: <span class="text-danger">*</span></label>
                    <input type="number"
                           oninput="javascript: if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                           class="form-control" name="contact"  value="{{ $inquiry->contact }}" required>
                </div>
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
                    </tr>
                    </thead>
                    <tbody id="appendProduct">
                        @foreach($inquiry->Products as $product)
                            <tr class="text-center">
                                <td>{{ $product->pivot->name }}</td>
                                <td>{{ $product->pivot->short_description }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ $product->pivot->sale_price }}</td>
                                <td>{{ $product->pivot->total_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center col-12">
                {{--@if(\App\Models\Quotation::where("reference", $inquiry->reference)->first())--}}
                    {{--<button disabled class="btn btn-info">Generate Quotation</button><br>--}}
                    {{--<small class="text-danger">Quotation already generated</small>--}}
                {{--@else--}}
                    {{--<a href="{{ route("seller.quotation.index")."?inquiry=$inquiry->id" }}" class="btn btn-info">Generate Quotation</a>--}}
                {{--@endif--}}
                    <a href="{{ route("seller.quotation.index")."?inquiry=$inquiry->id" }}" class="btn btn-info">Generate Quotation</a>

            </div>
        </div>


@stop

@section("scripts")

@stop