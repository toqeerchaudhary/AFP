@extends("layouts.backend")

@section("title")
    Add Category
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('admin.category.store')}}" method="post" class="needs-validation">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" minlength="3" maxlength="15" value="{{old('name')}}" required>
                        </div>

                        <div class="form-group col-12">
                            <label for="code">Code:</label>
                            <input type="text" name="code" class="form-control" minlength="3" maxlength="5" value="{{old('code')}}" required>
                        </div>

                        <div class="form-group col-12">
                            <button class="btn btn-info" type="submit" >Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop