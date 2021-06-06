@extends("layouts.backend")

@section("title")
    Admin Dashboard
@stop

@section("content")
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="/" class="btn btn-info btn-block rounded-0">Add Quote</a>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.product.create") }}" class="btn btn-secondary btn-block rounded-0">Add Product</a>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.category.create") }}" class="btn btn-secondary btn-block rounded-0">Add Category</a>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.sub-category.create") }}" class="btn btn-info btn-block rounded-0">Add Sub Category</a>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.brand.create") }}" class="btn btn-info btn-block rounded-0">Add Brand</a>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.supplier.create") }}" class="btn btn-secondary btn-block rounded-0">Add Supplier</a>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.seller.create") }}" class="btn btn-secondary btn-block rounded-0">Add Seller</a>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.purchaser.create") }}" class="btn btn-info btn-block rounded-0">Add Purchaser</a>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.accountant.create") }}" class="btn btn-info btn-block rounded-0">Add Accountant</a>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.hr.create") }}" class="btn btn-secondary btn-block rounded-0">Add HR</a>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.coordinator.create") }}" class="btn btn-secondary btn-block rounded-0">Add Coordinator</a>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.maintainer.create") }}" class="btn btn-info btn-block rounded-0">Add Maintainer</a>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xlg-6 mb-2">
                        <a href="{{ route("admin.store_keeper.create") }}" class="btn btn-info btn-block rounded-0">Add Store Keeper</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-products-center">
                            <div>
                                <h4 class="card-title">Site Analysis</h4>
                                <h5 class="card-subtitle">Overview of Latest Month</h5>
                            </div>
                        </div>
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-9">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-line-chart"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <i class="fa fa-user m-b-5 font-16"></i>
                                            <h5 class="m-b-0 m-t-5">2540</h5>
                                            <small class="font-light">Total Users</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <i class="fa fa-plus m-b-5 font-16"></i>
                                            <h5 class="m-b-0 m-t-5">120</h5>
                                            <small class="font-light">New Users</small>
                                        </div>
                                    </div>
                                    <div class="col-6 m-t-15">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <i class="fa fa-cart-plus m-b-5 font-16"></i>
                                            <h5 class="m-b-0 m-t-5">656</h5>
                                            <small class="font-light">Total Shop</small>
                                        </div>
                                    </div>
                                    <div class="col-6 m-t-15">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <i class="fa fa-tag m-b-5 font-16"></i>
                                            <h5 class="m-b-0 m-t-5">9540</h5>
                                            <small class="font-light">Total Orders</small>
                                        </div>
                                    </div>
                                    <div class="col-6 m-t-15">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <i class="fa fa-table m-b-5 font-16"></i>
                                            <h5 class="m-b-0 m-t-5">100</h5>
                                            <small class="font-light">Pending Orders</small>
                                        </div>
                                    </div>
                                    <div class="col-6 m-t-15">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <i class="fa fa-globe m-b-5 font-16"></i>
                                            <h5 class="m-b-0 m-t-5">8540</h5>
                                            <small class="font-light">Online Orders</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- column -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

@section("scripts")
    <!-- Charts js Files -->
    <script src="{{ URL::to("/backend/assets/libs/flot/excanvas.js") }}"></script>
    <script src="{{ URL::to("/backend/assets/libs/flot/jquery.flot.js") }}"></script>
    <script src="{{ URL::to("/backend/assets/libs/flot/jquery.flot.pie.js") }}"></script>
    <script src="{{ URL::to("/backend/assets/libs/flot/jquery.flot.time.js") }}"></script>
    <script src="{{ URL::to("/backend/assets/libs/flot/jquery.flot.stack.js") }}"></script>
    <script src="{{ URL::to("/backend/assets/libs/flot/jquery.flot.crosshair.js") }}"></script>
    <script src="{{ URL::to("/backend/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js") }}"></script>
    <script src="{{ URL::to("/backend/dist/js/pages/chart/chart-page-init.js") }}"></script>
@stop