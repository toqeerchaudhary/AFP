@extends("layouts.backend")

@section("title")
    Edit Customer
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('admin.customer.update',$customer->id)}}" method="post"
                      enctype="multipart/form-data">
                    @method("put")
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="name">Company Name:</label>
                            <input type="text" readonly class="form-control" value="{{$customer->company_name}}" >
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label for="name">Name:</label>
                            <input type="text" readonly class="form-control"  value="{{$customer->name}}" >
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label for="email">Email:</label>
                            <input type="text" readonly class="form-control" minlength="3" value="{{$customer->email}}" >
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label for="contact">Contact:</label>
                            <input type="text" readonly class="form-control"  value="{{$customer->contact}}" >
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label for="name">Category:</label>
                            <select name="category" class="form-control" id="">
                                <option value="">Select Category</option>
                                <option value="A Category" {{ $customer->category == "A Category" ? "selected" : "" }}>A Category</option>
                                <option value="B Category" {{ $customer->category == "B Category" ? "selected" : ""   }}>B Category</option>
                                <option value="C Category" {{ $customer->category == "C Category" ? "selected" : ""   }}>C Category</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <button class="btn btn-info" type="submit" >Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop