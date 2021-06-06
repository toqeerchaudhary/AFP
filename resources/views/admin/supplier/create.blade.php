@extends("layouts.backend")

@section("title")
    Add Supplier
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('admin.supplier.store')}}" method="post" enctype="multipart/form-data" class="needs-validation">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="name">Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" minlength="3" maxlength="15" value="{{old('name')}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="company">Company Name: <span class="text-danger">*</span></label>
                            <input type="text" name="company" class="form-control" minlength="3" maxlength="20" value="{{old('company')}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="city">City: <span class="text-danger">*</span></label>
                            <input type="text" name="city" class="form-control" minlength="3" maxlength="20" value="{{old('city')}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="address">Address: <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control" minlength="3" maxlength="50" value="{{old('address')}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="phone">Phone: <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" minlength="3" maxlength="15" value="{{old('phone')}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="color">Color: <span class="text-danger">*</span></label>
                            <select name="color" id="color" class="form-control" required>
                                <option value="">Select Color</option>
                                <option value="green">Green</option>
                                <option value="blue">Blue</option>
                                <option value="red">Red</option>
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label for="terms_conditions">Terms: <span class="text-danger">*</span></label>
                            <textarea name="terms_conditions" class="form-control" id="terms_conditions" cols="30" rows="10" required></textarea>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="file">Image:</label>
                            <input type="file" name="image" class="form-control-file" >
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <button class="btn btn-info" type="submit" >Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop