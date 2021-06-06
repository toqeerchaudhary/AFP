@extends("layouts.backend")

@section("title")
    Edit Supplier
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('admin.supplier.update',$supplier->id)}}" method="post"
                      enctype="multipart/form-data">
                    @method("put")
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="name">Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" minlength="3" maxlength="15" value="{{ $supplier->name }}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="company">Company Name: <span class="text-danger">*</span></label>
                            <input type="text" name="company" class="form-control" minlength="3" maxlength="20" value="{{$supplier->company}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="city">City: <span class="text-danger">*</span></label>
                            <input type="text" name="city" class="form-control" minlength="3" maxlength="20" value="{{$supplier->city}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="address">Address: <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control" minlength="3" maxlength="50" value="{{$supplier->address}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="phone">Phone: <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" minlength="3" maxlength="15" value="{{$supplier->phone}}" required>
                        </div>


                        <div class="form-group col-12 col-md-6">
                            <label for="color">Color: <span class="text-danger">*</span></label>
                            <select name="color" id="color" class="form-control" required>
                                <option value="">Select Color</option>
                                <option value="green" {{ $supplier->color == "green" ? "selected" : "" }}>Green</option>
                                <option value="blue" {{ $supplier->color == "blue" ? "selected" : "" }}>Blue</option>
                                <option value="red" {{ $supplier->color == "red" ? "selected" : "" }}>Red</option>
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label for="terms_conditions">Terms: <span class="text-danger">*</span></label>
                            <textarea name="terms_conditions" class="form-control" id="terms_conditions" cols="30" rows="10" required>{{ $supplier->terms_conditions }}</textarea>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="file">Image:</label>
                            <input type="file" name="img" class="form-control-file" >
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