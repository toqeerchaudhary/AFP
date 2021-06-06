@extends("layouts.seller")

@section("title")
    Add Quotation
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
    <form action="{{ route("seller.quotation.store") }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="company_name">Company Name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" maxlength="50" value="{{ old("company_name") }}" name="company_name" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="person_name">Person Name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" maxlength="50" value="{{ old("person_name") }}" name="person_name" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="contact">Contact: <span class="text-danger">*</span></label>
                    <input type="number"
                           oninput="javascript: if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                           class="form-control" name="contact"  value="{{ old("contact") }}" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="designation">Designation:</label>
                    <input type="text" class="form-control" maxlength="50" value="{{ old("designation") }}" name="designation" >
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" value="{{ old("email") }}" name="email" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="project">Project:</label>
                    <input type="text" class="form-control" value="{{ old("project") }}" maxlength="200" name="project" >
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" value="{{ old("subject") }}" maxlength="50" name="subject" >
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" value="{{ old("address") }}" maxlength="200" name="address" >
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" value="{{ old("location") }}" maxlength="200" name="location" >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="client_reference">Your Reference:</label>
                    <input type="text" class="form-control" value="{{ old("client_reference") }}" maxlength="200" name="client_reference" >
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="warranty">Warranty:</label>
                    <input type="text" class="form-control" value="{{ old("warranty") }}" name="warranty" >
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="validity">Validity:</label>
                    <input type="date" class="form-control"  value=""  name="validity">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <label for="">Include GST?:</label><br>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" value="yes" name="include_gst">
                    <label class="form-check-label">
                        Yes
                    </label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="include_gst" value="no" checked>
                    <label class="form-check-label">
                        No
                    </label>
                </div>
            </div>



            <div class="col-12 col-md-4">
                <label for="">Select Terms:</label><br>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" value="project_terms" name="selected_terms">
                    <label class="form-check-label">
                        Project Terms
                    </label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="selected_terms" value="general_terms" checked>
                    <label class="form-check-label">
                        General Terms
                    </label>
                </div>
            </div>



            <div class="col-12">
                <label for="">Select Product</label>
                <select class="js-example-basic-multiple form-control"
                        multiple="multiple" required>
                </select>
            </div>

            <div class="container mt-3 offset-md-4 col-md-4 col-12">
                <table class="table table-sm table-bordered ">
                    <thead>
                    <tr class="text-center">
                        <th>Product Name</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody id="appendProduct">

                    </tbody>
                </table>
            </div>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@stop

@section("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
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
            $("#appendProduct").append('<tr id="product-'+params.id+'" class="text-center">' +
                '<td><input type="hidden" name="product[]" value='+params.id+'>'+params.name+'</td>' +
                '<td><input type="number" name="quantity[]" required></td>' +
                '</tr>')
        });
        // var $exampleMulti = $(".js-example-basic-multiple").select2();
        $(".js-example-basic-multiple").on("select2:unselect", function (e) {
            var params= e.params.data;
            $("#product-"+params.id).remove();
        });
    </script>
@stop