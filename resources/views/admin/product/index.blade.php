@extends("layouts.backend")

@section("title")
    All Products
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
                        <td>Category</td>
                        <td>Sub Category</td>
                        <td>Sale Price</td>
                        <td>Purchase Price</td>
                        <td>Quantity</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->code}}</td>
                            <td>{{$product->Category ? $product->Category->name : ""}}</td>
                            <td>{{$product->SubCategory ? $product->SubCategory->name : ""}}</td>
                            <td>{{$product->sale_price}}</td>
                            <td>{{$product->purchase_price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>
                                <a href="{{route('admin.product.edit',['id' => $product->id])}}" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
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