@extends("layouts.backend")

@section("title")
    Edit Brand
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('admin.brand.update',$brand->id)}}" method="post"
                      enctype="multipart/form-data">
                    @method("put")
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" minlength="3" maxlength="15" value="{{$brand->name}}" required>
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