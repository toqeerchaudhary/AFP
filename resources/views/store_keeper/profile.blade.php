@extends("layouts.store_keeper")

@section("title")
    Update Profile
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('store_keeper.dashboard.update', $store_keeper->id)}}" method="post" enctype="multipart/form-data" class="needs-validation">
                   @method("put")
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="name">Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" minlength="3" maxlength="15" value="{{$store_keeper->name}}">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="email">Email: <span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control" minlength="3" maxlength="50" value="{{$store_keeper->email}}" disabled>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="password">Password: </label>
                            <input type="password" name="password" class="form-control" minlength="3" maxlength="50" >
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