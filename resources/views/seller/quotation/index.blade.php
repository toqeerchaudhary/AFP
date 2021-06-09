@extends("layouts.seller")

@section("title")
    All Quotations
@stop

@section("styles")
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">--}}
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
                        <td>Company Name</td>
                        <td>Person Name</td>
                        <td>Validity</td>
                        <td>Contact</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotations as $quotation)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$quotation->reference}}</td>
                            <td>{{$quotation->company_name}}</td>
                            <td>{{$quotation->person_name}}</td>
                            <td>{{ date("d M Y", strtotime($quotation->validity)) }}</td>
                            <td>{{$quotation->contact}}</td>
                            <td>
                                <a href="{{route('seller.quotation.show',['id' => $quotation->id])}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

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
    {{--<script  src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>--}}
    {{--<script src="{{ URL::to("/js/bootstable.min.js") }}"></script>--}}
    <script>
        $(document).ready(function () {
            $('#categoriesTable').DataTable();
            // $('#categoriesTable').SetEditable({ $addButton: $('#but_add')});
        });
    </script>
@stop