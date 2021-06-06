@extends("layouts.backend")

@section("title")
    All StoreKeepers
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
                        <td>Image</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($store_keepers as $store_keeper)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="w-25"><img src="{{ $store_keeper->image ? $store_keeper->image : URL::to("/backend/assets/images/users/1.jpg") }}" alt="user" class="img-fluid w-25"></td>
                            <td>{{$store_keeper->name}}</td>
                            <td>{{$store_keeper->email}}</td>
                            <td>
                            <form action="{{ route('admin.store_keeper.destroy',$store_keeper->id) }}" method="post"
                            onsubmit="return confirm('Are you sure ?')">
                            @method("delete")
                            @csrf
                            <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
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