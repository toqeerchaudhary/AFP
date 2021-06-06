@extends("layouts.backend")

@section("title")
    Add Accountant
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('admin.accountant.store')}}" method="post" enctype="multipart/form-data" class="needs-validation">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="name">Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" minlength="3" maxlength="15" value="{{old('name')}}" required>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="email">Email: <span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control" minlength="3" maxlength="50" value="{{old('email')}}" required>
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