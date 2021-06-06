@extends("layouts.backend")

@section("title")
    All Suppliers
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
                        <td>Color</td>
                        <td>No of Products</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$supplier->name}}</td>
                            <td>{{$supplier->code}}</td>
                            <td>{{$supplier->color}}</td>
                            <td>{{$supplier->Products->count()}}</td>
                            <td>
                                <a href="{{route('admin.supplier.edit',['id' => $supplier->id])}}" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
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