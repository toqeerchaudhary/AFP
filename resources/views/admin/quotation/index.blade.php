@extends("layouts.backend")

@section("title")
    All Quotations
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
                        <td>Code</td>
                        <td>Reference #</td>
                        <td>Contact</td>
                        <td>Seller</td>
                        <td>Coordintator</td>
                        <td>Products</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotations as $quotation)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$quotation->code}}</td>
                            <td>{{$quotation->reference}}</td>
                            <td>{{$quotation->contact}}</td>
                            <td>{{$quotation->Seller ? $quotation->Seller->name : ""}}</td>
                            <td>{{$quotation->Coordinator ? $quotation->Coordinator->name : ""}}</td>
                            <td>{{$quotation->Products->count()}}</td>
                            <td>
                                <a href="{{route('admin.quotation.show',['id' => $quotation->id])}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

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