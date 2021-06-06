@extends("layouts.backend")

@section("title")
    All Hrs
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
                    @foreach($hrs as $hr)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="w-25"><img src="{{ $hr->image ? $hr->image : URL::to("/backend/assets/images/users/1.jpg") }}" alt="user" class="img-fluid w-25"></td>
                            <td>{{$hr->name}}</td>
                            <td>{{$hr->email}}</td>
                            <td>
                            <form action="{{ route('admin.hr.destroy',$hr->id) }}" method="post"
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