@extends("layouts.backend")

@section("title")
    Add Product
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('admin.product.store')}}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                    <input type="hidden" id="category_code" name="category_code">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="category_id" class="col-12 m-0 p-0">Category: <span class="text-danger">*</span>
                                <button type="button" class="btn btn-link text-custom float-right p-1" data-toggle="modal" data-target="#categoryModal">
                                    Add Category
                                </button>
                            </label>
                            <select name="category_id" class="form-control category_class" id="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ old("category_id") == $category->id ? "selected" : "" }}{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="sub_category_id" class="col-12 m-0 p-0">Sub Category: <span class="text-danger">*</span>
                                <button type="button" class="btn btn-link text-custom float-right p-1" data-toggle="modal" data-target="#subCategoryModal">
                                    Add Sub Category
                                </button>
                            </label>
                            <select name="sub_category_id" class="form-control" id="sub_category_id" required>
                                <option value="">Select Sub Category</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="brand_id" class="col-12 m-0 p-0">Brand:
                                <button type="button" class="btn btn-link text-custom float-right p-1" data-toggle="modal" data-target="#brandModal">
                                    Add Brand
                                </button>
                            </label>
                            <select name="brand_id" class="form-control" id="brand_id" >
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old("brand_id") == $brand->id ? "selected" : "" }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="uom_id" class="col-12 m-0 p-0">Uom: <span class="text-danger">*</span>
                                <button type="button" class="btn btn-link text-custom float-right p-1" data-toggle="modal" data-target="#uomModal">
                                    Add Uom
                                </button>
                            </label>
                            <select name="uom_id" class="form-control" id="uom_id" required>
                                <option value="">Select Uom</option>
                                @foreach($uoms as $uom)
                                    <option value="{{ $uom->id }}" {{ old("uom_id") == $uom->id ? "selected" : "" }}>{{ $uom->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="supplier_id">Supplier: </label>
                            <select name="supplier_id" class="form-control" id="supplier_id" >
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old("supplier_id") == $supplier->id ? "selected" : "" }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label for="name">Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" maxlength="50" minlength="5" class="form-control" value="{{old('name')}}" required>
                        </div>

                        <div class="form-group col-12">
                            <label for="short_description">Short Description: <span class="text-danger">*</span></label>
                            <input type="text" name="short_description" maxlength="50" minlength="5" class="form-control" value="{{old('short_description')}}" required>
                        </div>

                        <div class="form-group col-12">
                            <label for="description">Description: <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10" required>{{ old("description") }}</textarea>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="quantity">Quantity: <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" minlength="3" maxlength="50" value="{{old('quantity')}}" required>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="warranty">Warranty: </label>
                            <input type="text" name="warranty" class="form-control" minlength="3" maxlength="50" value="{{old('warranty')}}" >
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="sale_price">Sale Price: <span class="text-danger">*</span></label>
                            <input type="number" name="sale_price" class="form-control" value="{{old('sale_price')}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="purchase_price">Purchase Price: <span class="text-danger">*</span></label>
                            <input type="number" name="purchase_price" class="form-control" value="{{old('purchase_price')}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="hsn_code">HSN Code:</label>
                            <input type="text" name="hsn_code" class="form-control" value="{{old('hsn_code')}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="custom_tax">Custom Charges:</label>
                            <input type="number" name="custom_tax" class="form-control" value="{{old('custom_tax')}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="gst_tax">GST:</label>
                            <input type="number" class="form-control" value="17"  readonly>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="withholding_tax">Withholding:</label>
                            <input type="number" name="withholding_tax" class="form-control" value="{{old('withholding_tax')}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="transportation_charges">Transportation charges:</label>
                            <input type="number" name="transportation_charges" class="form-control" value="{{old('transportation_charges')}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="service_tax">Services Tax:</label>
                            <input type="number" name="service_tax" class="form-control" value="{{old('service_tax')}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="provincial_tax">Provincial Tax:</label>
                            <input type="number" name="provincial_tax" class="form-control" value="{{old('provincial_tax')}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="file">File:</label>
                            <input type="file" name="file" class="form-control-file" >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <button class="btn btn-info" type="submit" >Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="categoryModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-custom">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div>
                        <ul id="category_errors" class="alert-danger">

                        </ul>
                    </div>
                    <form id="category_form"  method="post" class="needs-validation">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="name">Name:</label>
                                <input type="text" id="category_add_name" class="form-control" minlength="3" maxlength="15"  required>
                            </div>

                            <div class="form-group col-12">
                                <label for="code">Code:</label>
                                <input type="text" id="category_add_code" class="form-control" minlength="3" maxlength="5"  required>
                            </div>

                            <div class="form-group col-12">
                                <button class="btn btn-info" type="submit" >Submit</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="brandModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-custom">
                    <h4 class="modal-title">Add Brand</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div>
                        <ul id="brand_errors" class="alert-danger">

                        </ul>
                    </div>
                    <form id="brand_form"  method="post" class="needs-validation">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="name">Name:</label>
                                <input type="text" id="brand_add_name" class="form-control" minlength="3" maxlength="15"  required>
                            </div>


                            <div class="form-group col-12">
                                <button class="btn btn-info" type="submit" >Submit</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="uomModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-custom">
                    <h4 class="modal-title">Add Uom</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div>
                        <ul id="uom_errors" class="alert-danger">

                        </ul>
                    </div>
                    <form id="uom_form"  method="post" class="needs-validation">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="name">Name:</label>
                                <input type="text" id="uom_add_name" class="form-control" minlength="3" maxlength="15"  required>
                            </div>


                            <div class="form-group col-12">
                                <button class="btn btn-info" type="submit" >Submit</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="subCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-custom">
                    <h4 class="modal-title">Add Sub Category</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div>
                        <ul id="sub_category_errors" class="alert-danger">

                        </ul>
                    </div>
                    <form id="sub_category_form"  method="post" class="needs-validation">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="s_category_id">Select Category:</label>
                                <select class="form-control" id="s_category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="name">Name:</label>
                                <input type="text" id="sub_category_add_name" class="form-control" minlength="3" maxlength="15"  required>
                            </div>

                            <div class="form-group col-12">
                                <button class="btn btn-info" type="submit" >Submit</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@stop

@section("scripts")
    <script>
        // $("#category_id").trigger("change");
        $("#category_id").change(function () {
            var category_id = $(this).val();
            var $dropdown = $("#sub_category_id");

            if (category_id != '') {
                $.ajax({
                    url: '/admin/category/'+category_id,
                    type: 'get',
                    success:function (response) {
                        $("#category_code").val(response.category.code);
                        $dropdown.html(''); // emptying the dropdown
                        if(!jQuery.isEmptyObject(response.subCategories)) {
                            // appending the placeholder
                            $dropdown.append($("<option />").val('').text('Select Sub Category'));
                            $.each(response.subCategories, function(iteration,data) {
                                $dropdown.append($("<option />").val(data.id).text(data.name));
                            });
                        } else {
                            // appending the placeholder
                            $dropdown.append($("<option />").val('').text('Select Sub Category'));
                            alert('No sub category found');
                        }
                    }
                })
            } else {
                // emptying the dropdown and appending the placeholder
                $dropdown.html('');
                $dropdown.append($("<option />").val('').text('Select Sub Category'));
            }
        });

    </script>

    <script>
        $("#category_form").submit(function (e) {
            e.preventDefault();
            var name = $("#category_add_name").val();
            var code = $("#category_add_code").val();
            var token = "{{ Session::token() }}";
            $.ajax({
                url: "/admin/add-category",
                type: "post",
                data: {name: name, code: code, _token: token},
                success: function (response) {
                    $("#category_errors").html("");
                    $("#categoryModal").modal("hide");
                    toastr.success(response.message);
                    var $dropdown = $("#category_id");
                    var $dropdown2 = $("#s_category_id");
                    $dropdown.html('');
                    $dropdown2.html('');
                    $dropdown.append($("<option />").val('').text('Select Category'));
                    $dropdown2.append($("<option />").val('').text('Select Category'));
                    $.each(response.categories, function(iteration,data) {
                        $dropdown.append($("<option />").val(data.id).text(data.name));
                        $dropdown2.append($("<option />").val(data.id).text(data.name));
                    });
                    $("#category_form")[0].reset();
                },
                error: function (err) {
                    var errors = err.responseJSON.message;
                    if (errors != []) {
                        $("#category_errors").html("");
                        $.each(errors, function (i, error) {
                            $("#category_errors").append("<li>"+error+"</li>");
                        });
                    }
                }
            })
        });
    </script>

    <script>
        $("#brand_form").submit(function (e) {
            e.preventDefault();
            var name = $("#brand_add_name").val();
            var token = "{{ Session::token() }}";
            $.ajax({
                url: "/admin/add-brand",
                type: "post",
                data: {name: name,  _token: token},
                success: function (response) {
                    $("#brand_errors").html("");
                    $("#brandModal").modal("hide");
                    toastr.success(response.message);
                    var $dropdown = $("#brand_id");
                    $dropdown.html('');
                    $dropdown.append($("<option />").val('').text('Select Brand'));
                    $.each(response.brands, function(iteration,data) {
                        $dropdown.append($("<option />").val(data.id).text(data.name));
                    });
                    $("#brand_form")[0].reset();
                },
                error: function (err) {
                    var errors = err.responseJSON.message;
                    if (errors != []) {
                        $("#brand_errors").html("");
                        $.each(errors, function (i, error) {
                            $("#brand_errors").append("<li>"+error+"</li>");
                        });
                    }
                }
            })
        });
    </script>

    <script>
        $("#sub_category_form").submit(function (e) {
            e.preventDefault();
            var name = $("#sub_category_add_name").val();
            var category_id = $("#s_category_id").val();
            var token = "{{ Session::token() }}";
            $.ajax({
                url: "/admin/add-subcategory",
                type: "post",
                data: {name: name, category_id: category_id, _token: token},
                success: function (response) {
                    $("#sub_ccategory_errors").html("");
                    $("#subCategoryModal").modal("hide");
                    toastr.success(response.message);
                    $("#sub_category_form")[0].reset();
                },
                error: function (err) {
                    var errors = err.responseJSON.message;
                    if (errors != []) {
                        $("#sub_ccategory_errors").html("");
                        $.each(errors, function (i, error) {
                            $("#sub_ccategory_errors").append("<li>"+error+"</li>");
                        });
                    }
                }
            })
        });
    </script>

    <script>
        $("#uom_form").submit(function (e) {
            e.preventDefault();
            var name = $("#uom_add_name").val();
            var token = "{{ Session::token() }}";
            $.ajax({
                url: "/admin/add-uom",
                type: "post",
                data: {name: name,  _token: token},
                success: function (response) {
                    $("#uom_errors").html("");
                    $("#uomModal").modal("hide");
                    toastr.success(response.message);
                    var $dropdown = $("#uom_id");
                    $dropdown.html('');
                    $dropdown.append($("<option />").val('').text('Select Uom'));
                    $.each(response.uoms, function(iteration,data) {
                        $dropdown.append($("<option />").val(data.id).text(data.name));
                    });
                    $("#uom_form")[0].reset();
                },
                error: function (err) {
                    var errors = err.responseJSON.message;
                    if (errors != []) {
                        $("#uom_errors").html("");
                        $.each(errors, function (i, error) {
                            $("#uom_errors").append("<li>"+error+"</li>");
                        });
                    }
                }
            })
        });
    </script>
@stop