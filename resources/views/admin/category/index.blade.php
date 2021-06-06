@extends("layouts.backend")

@section("title")
    All Categories
@stop

@section("content")

    <div class="card">
        <div class="card-body">
            @include('includes.info-box')
            <div class="table-responsive">
                <table id="categoriesTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <td>Sr #</td>
                        <td>Name</td>
                        <td>Code</td>
                        <td>No of Products</td>
                        <td>No of Sub Categories</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->code}}</td>
                            <td>{{$category->Products->count()}}</td>
                            <td>{{$category->SubCategories->count()}}</td>
                            <td>
                                <a href="{{route('admin.category.edit',['id' => $category->id])}}" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                {{--@if($category->Products->count())--}}
                                {{--<form class="d-inline" action="{{ route('admin.category.destroy',$category->id) }}" method="post"--}}
                                      {{--onsubmit="return confirm('Are you sure ?')">--}}
                                    {{--@method("delete")--}}
                                    {{--@csrf--}}
                                    {{--<button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>--}}
                                {{--</form>--}}
                                {{--@endif--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#categoriesTable').DataTable();
        });
    </script>
@stop