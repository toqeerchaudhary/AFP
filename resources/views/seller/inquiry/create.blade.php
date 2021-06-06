@extends("layouts.seller")

@section("title")
    Add Inquiry
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

        .autocomplete {
            /*the container must be positioned relative:*/
            position: relative;
            display: inline-block;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }
        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }
        .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9;
        }
        .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
@stop

@section("content")
    @include("includes.info-box")
    <form action="{{ route("seller.inquiry.store") }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="company_name">Company Name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" minlength="3" maxlength="50" value="{{ old("company_name") }}" name="company_name" required>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="person_name">Person Name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" minlength="3" maxlength="50" value="{{ old("person_name") }}" name="person_name" required>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="contact">Contact: <span class="text-danger">*</span></label>
                    <input type="number"
                           oninput="javascript: if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                           class="form-control" name="contact"  value="{{ old("contact") }}" required>
                </div>
            </div>

            <div class="col-12 col-md-4 ">
                <label for="">Select Product:</label>
                <select class="js-example-basic-multiple form-control"
                        multiple="multiple">
                </select>
            </div>

            <div class="container mt-3 col-12">
                {{--<button type="button" class="btn btn-info my-2 float-right" id="add-row">Add Row</button>--}}
                <table class="table table-sm table-bordered ">
                    <thead>
                    <tr class="text-center">
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width: 10px">Quantity</th>
                        <th style="width: 200px">Sale Price</th>
                        <th style="width: 200px">Total Price</th>
                        <th>Action</th>
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
            if (!proudctArray.includes(params.id)) {
                proudctArray.push(params.id);
                $("#appendProduct").append('<tr id="product-'+params.id+'" class="text-center">' +
                    '<input type="hidden" name="product[]" value='+params.id+'>' +
                    '<td><input type="text" name="name[]"  required class="form-control" value='+params.name+'></td>' +
                    '<td><input type="text" maxlength="200" name="short_description[]" class="form-control" required value='+params.short_description+'></td>\'' +
                    '<td><input type="number" name="quantity[]" data-id="'+params.id+'" id="quantity_'+(params.id)+'" min="1" value="1" class="form-control quantity" required></td>' +
                    '<td><input type="text" name="sale_price[]" data-id="'+params.id+'" id="sale_price_'+(params.id)+'" class="form-control sale_price" min="1" required value='+params.sale_price+'></td>' +
                    '<td><input type="text" class="form-control" min="1" id="total_price_'+(params.id)+'" disabled value='+params.sale_price+'></td>' +
                    '<td><button class="btn btn-danger remove-row" data-id="'+params.id+'"><i class="fas fa-trash"></i></button></td>' +
                    '</tr>');
            }

            $('.js-example-basic-multiple').val(null).trigger('change');
        });
        // var $exampleMulti = $(".js-example-basic-multiple").select2();
        // $(".js-example-basic-multiple").on("select2:unselect", function (e) {
        //     var params= e.params.data;
        //     $("#product-"+params.id).remove();
        // });

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