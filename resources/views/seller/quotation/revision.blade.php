@extends("layouts.seller")

@section("title")
    Revise Quotation
@stop

@section("styles")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    {{--    <link rel="stylesheet" href="{{ URL::to("backend/assets/libs/dist/css/select2.min.css") }}">--}}
    <style>
        .select2-selection__choice { color: black!important;}
        .tox-notifications-container {
            display: none !important;
        }
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
        .form-group {
            margin-bottom: 5px!important;
        }

        table th, table td {
            border: 1px solid black!important;
        }
    </style>
@stop

@section("content")
    @include("includes.info-box")
    <form action="{{ route("seller.quotation.update", $quotation->id) }}" method="post">
        @csrf
        @method("put")
        <input type="hidden" name="code" value="{{ $quotation->code }}">

        <div class="row">
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="company_name">Company Name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" maxlength="50" value="{{ $quotation->company_name }}"  name="company_name" required>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="person_name">Person Name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" maxlength="50" value="{{ $quotation->person_name }}"  name="person_name" required>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" value="{{ $quotation->address }}" maxlength="200"  name="address" >
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="designation">Designation:</label>
                    <input type="text" class="form-control" maxlength="50" value="{{ $quotation->designation }}"  name="designation" >
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="designation">STRN #:</label>
                    <input type="text" class="form-control" value="32-77-8761-604-40" readonly>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" value="{{ $quotation->subject }}" maxlength="50"  name="subject" >
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="designation">Date of Quote:</label>
                    <input type="text" class="form-control" value="{{ date("l, F, j, Y", strtotime($quotation->created_at)) }}" readonly>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="project">Project:</label>
                    <input type="text" class="form-control" value="{{ $quotation->project }}" maxlength="200"  name="project" >
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="validity">Validity:</label>
                    <input type="date" class="form-control"  value="{{ date("Y-m-d", strtotime($quotation->validity)) }}" maxlength="200"  name="validity" >
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" value="{{ $quotation->location }}" maxlength="200"  name="location" >
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="contact">Contact: <span class="text-danger">*</span></label>
                    <input type="number"
                           oninput="javascript: if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                           class="form-control"  name="contact"  value="{{ $quotation->contact }}" required>
                </div>
            </div>


            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="client_reference">Your Reference:</label>
                    <input type="text" class="form-control" value="{{ $quotation->client_reference }}" maxlength="200"  name="client_reference" >
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" value="{{ $quotation->email }}"  name="email" >
                </div>
            </div>


            <div class="col-12 col-md-6">
                <label for="description">Quotation Description <span class="text-danger">*</span></label>
                <input type="text" name="description" class="form-control" value="{{ $quotation->description }}" required>
            </div>

            <div class="col-12 col-md-3">
                <label for="row_heading">Row Heading <span class="text-danger">*</span></label>
                <input type="text" name="row_heading" class="form-control" value="{{ $quotation->row_heading }}" required>
            </div>


            <div class="col-12">
                <label for="">Select Product</label>
                <select class="js-example-basic-multiple form-control"
                        multiple="multiple" >
                </select>
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
                        <th style="width: 5%">Disc (%)</th>
                        <th>Action</th>
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
                            <td><button type="button" class="btn btn-danger remove-row" data-id="{{ $product->id }}"><i class="fas fa-trash"></i></button></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
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

        </div>

        <button class="btn btn-success">Submit</button>
    </form>


@stop

@section("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        var proudctArray = [];
        $(".js-example-basic-multiple").select2({
            ajax: {
                url: "{{ route('product.index') }}",
                dataType: 'json',
                data: function (data) {
                    var query = {
                        search: data.term
                        // type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data,
                    };
                },
                cache: true
            },
            placeholder: 'Select Products',
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatTag, // to populate data in select 2
            templateSelection: formatTagSelection // to select data
        });

        function formatTag (product) {
            if (product.quantity == 0) {
                var markup = "<div class='select2-result-tagsitory__title bg-danger'>" + product.name + "  (" + product.code + ")" + " </div>";
            } else {
                var markup = "<div class='select2-result-tagsitory__title'>" + product.name + "  (" + product.code + ")" + " </div>";
            }
            return markup;
        }

        function formatTagSelection (product) {
            return product.name + "  (" + product.code + ")";
        }

        $(".js-example-basic-multiple").on("select2:select", function (e) {
            var params= e.params.data;
            if($("#product-" + params.id).length == 0) {
                $("#appendProduct").append('<tr id="product-'+params.id+'">' +
                    '<input type="hidden" name="product[]" value='+params.id+'>' +
                    '<td><input type="text" name="name[]"  required class="form-control" value='+params.name+'></td>' +
                    '<td><input type="text" maxlength="200" name="short_description[]" class="form-control" required value='+params.short_description+'></td>\'' +
                    '<td><input type="number" name="quantity[]" data-id="'+params.id+'" id="quantity_'+(params.id)+'" min="1" value="1" class="form-control quantity" required></td>' +
                    '<td><input type="text" name="sale_price[]" data-id="'+params.id+'" id="sale_price_'+(params.id)+'" class="form-control sale_price" min="1" required value='+params.sale_price+'></td>' +
                    '<td><input type="text" class="form-control" min="1" id="total_price_'+(params.id)+'" disabled value='+params.sale_price+'></td>' +
                    '<td><input type="text" class="form-control" name="discount[]" min="1"  value=""></td>'+
                    '<td><button type="button" class="btn btn-danger remove-row" data-id="'+params.id+'"><i class="fas fa-trash"></i></button></td>' +
                    '</tr>');
            }
            $('.js-example-basic-multiple').val(null).trigger('change');
        });

        $("#add-row").click(function () {
            var randomNumber = Math.floor((Math.random() * 100) + 1);
            $("#appendProduct").append('<tr id="product-'+randomNumber+'" class="text-center">' +
                '<input type="hidden" name="product[]">' +
                '<td><input type="text" name="name[]" class="form-control" required></td>' +
                '<td><input type="text" maxlength="200" name="short_description[]" class="form-control" required></td>\'' +
                '<td><input type="number" name="quantity[]" data-id="'+randomNumber+'" id="quantity_'+randomNumber+'" min="1" value="1" class="form-control quantity" required></td>' +
                '<td><input type="text" name="sale_price[]" data-id="'+randomNumber+'" id="sale_price_'+randomNumber+'" class="form-control sale_price" min="1" required></td>' +
                '<td><input type="text" class="form-control" min="1" id="total_price_'+randomNumber+'" disabled></td>' +
                '</tr>')
        });
    </script>

    <script>
        $(document).on("change", ".quantity" ,function () {
            var quantity = $(this).val();
            if (quantity == "" || quantity == 0) {
                alert("Please add quantity");
            } else {
                var id = $(this).data("id");
                var sale_price = $("#sale_price_"+id).val();
                $("#total_price_"+id).val(quantity * sale_price);
            }

        });

        $(document).on("change", ".sale_price" ,function () {
            var sale_price = $(this).val();
            if (sale_price == "" || sale_price == 0) {
                alert("Please add sale price");
            } else {
                var id = $(this).data("id");
                var quantity = $("#quantity_"+id).val();
                $("#total_price_"+id).val(quantity * sale_price);
            }

        });
    </script>

    <script>
        $(document).on("click", ".remove-row", function () {
            var id = $(this).data("id");
            $("#product-"+id).remove();
            var productIndex = proudctArray.indexOf(id);//get  "car" index
            proudctArray.splice(productIndex, 1);
        });
    </script>
@stop