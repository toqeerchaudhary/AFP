@extends("layouts.backend")

@section("title")
    Edit Sub Category
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('admin.sub-category.update',$subCategory->id)}}" method="post"
                      enctype="multipart/form-data">
                    @method("put")
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="category_id">Category:</label>
                            <select name="category_id" class="form-control" id="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{  $category->id == ($subCategory->Category ? $subCategory->Category ->id : "" ) ? "selected" : "" }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-12">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" minlength="3" maxlength="15" value="{{$subCategory->name}}" required>
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