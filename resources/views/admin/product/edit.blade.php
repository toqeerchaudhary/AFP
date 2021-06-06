@extends("layouts.backend")

@section("title")
    Edit Product
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('admin.product.update',$product->id)}}" method="post"
                      enctype="multipart/form-data">
                    @method("put")
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="category_id">Category: <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control" id="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? "selected" : "" }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="sub_category_id">Sub Category: <span class="text-danger">*</span></label>
                            <select name="sub_category_id" class="form-control" id="sub_category_id" required>
                                <option value="{{ $product->SubCategory ? $product->SubCategory->id  : ""}}">
                                    {{ $product->SubCategory ? $product->SubCategory->name  : ""}}
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="brand_id">Brand: </label>
                            <select name="brand_id" class="form-control" id="brand_id" >
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? "selected" : "" }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="uom_id">Uom:  <span class="text-danger">*</span></label>
                            <select name="uom_id" class="form-control" id="uom_id" required>
                                <option value="">Select Uom</option>
                                @foreach($uoms as $uom)
                                    <option value="{{ $uom->id }}" {{ $product->uom_id == $uom->id ? "selected" : "" }}>{{ $uom->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="supplier_id">Supplier: </label>
                            <select name="supplier_id" class="form-control" id="supplier_id" >
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"  {{ $product->supplier_id == $supplier->id ? "selected" : "" }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label for="name">Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" maxlength="50" minlength="5" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="form-group col-12">
                            <label for="short_description">Short Description: <span class="text-danger">*</span></label>
                            <input type="text" name="short_description" maxlength="50" minlength="5" class="form-control" value="{{ $product->short_description }}" required>
                        </div>

                        <div class="form-group col-12">
                            <label for="description">Description: <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10" required>{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="quantity">Quantity: <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" minlength="3" maxlength="50" value="{{ $product->quantity }}" required>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="warranty">Warranty: </label>
                            <input type="text" name="warranty" class="form-control" minlength="3" maxlength="50" value="{{$product->warranty}}" >
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="sale_price">Sale Price: <span class="text-danger">*</span></label>
                            <input type="number" name="sale_price" class="form-control" value="{{ $product->sale_price }}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="purchase_price">Purchase Price: <span class="text-danger">*</span></label>
                            <input type="number" name="purchase_price" class="form-control" value="{{ $product->purchase_price }}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="hsn_code">HSN Code:</label>
                            <input type="text" name="hsn_code" class="form-control" value="{{$product->hsn_code}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="custom_tax">Custom Charges:</label>
                            <input type="number" name="custom_tax" class="form-control" value="{{$product->custom_tax}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="gst_tax">GST:</label>
                            <input type="number" readonly class="form-control" value="17"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="withholding_tax">Withholding:</label>
                            <input type="number" name="withholding_tax" class="form-control" value="{{$product->withholding_tax}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="transportation_charges">Transportation charges:</label>
                            <input type="number" name="transportation_charges" class="form-control" value="{{$product->transportation_charges}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="service_tax">Services Tax:</label>
                            <input type="number" name="service_tax" class="form-control" value="{{$product->service_tax}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="provincial_tax">Provincial Tax:</label>
                            <input type="number" name="provincial_tax" class="form-control" value="{{$product->provincial_tax}}"  >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="file">File:</label>
                            <input type="file" name="file" class="form-control-file" >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <button class="btn btn-info" type="submit" >Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section("scripts")
    <script>
        // $(document).ready(function () {
        //     $("#category_id").trigger("change");
        // });

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