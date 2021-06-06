@extends("layouts.backend")

@section("title")
    Add Sub Category
@stop

@section("content")
    <div class="card mt-3">
        <div class="card-body">
            @include('includes.info-box')
            <div class="">
                <form action="{{route('admin.sub-category.store')}}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="category_id">Category:</label>
                            <select name="category_id" class="form-control" id="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" minlength="3" maxlength="15" value="{{old('name')}}" required>
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