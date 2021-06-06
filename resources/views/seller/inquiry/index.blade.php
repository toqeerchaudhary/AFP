@extends("layouts.seller")

@section("title")
    All Inquiries
@stop

@section("styles")
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
                        <td>Reference #</td>
                        <td>Contact</td>
                        <td>Person Name</td>
                        <td>Products</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inquiries as $inquiry)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$inquiry->reference}}</td>
                            <td>{{$inquiry->contact}}</td>
                            <td>{{$inquiry->person_name}}</td>
                            <td>{{$inquiry->Products->count()}}</td>
                            <td>
                                <a href="{{route('seller.inquiry.show',['id' => $inquiry->id])}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

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