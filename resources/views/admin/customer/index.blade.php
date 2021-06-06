@extends("layouts.backend")

@section("title")
    All Customers
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
                        <td>Contact</td>
                        <td>Email</td>
                        <td>Category</td>
                        <td>No of Quotations</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->contact}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->category}}</td>
                            <td>{{$customer->Quotations->count()}}</td>
                            <td>
                                <a href="{{route('admin.customer.edit',['id' => $customer->id])}}" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
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