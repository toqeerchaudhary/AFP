@extends("layouts.backend")

@section("title")
    All Uom
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
                        <td>No of Products</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($uoms as $uom)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$uom->name}}</td>
                            <td>{{$uom->Products->count()}}</td>
                            <td>
                                <a href="{{route('admin.uom.edit',['id' => $uom->id])}}" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
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