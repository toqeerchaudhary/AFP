<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to("/backend/assets/images/favicon.png") }}">
    <title>@yield("title")</title>
    <!-- Custom CSS -->
    <link href="{{ URL::to("/backend/assets/libs/flot/css/float-chart.css") }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ URL::to("/backend/dist/css/style.min.css") }}" rel="stylesheet">
    <link href="{{ URL::to("backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::to("backend/assets/libs/toastr/build/toastr.min.css") }}">
    <style>
        #main-wrapper .left-sidebar[data-sidebarbg=skin5] ul {
            background: #2255a4!important;
            color: #fff!important;;
        }
        .bg-custom {
            background: #2255a4!important;
            color: #fff!important;;
        }
        .text-custom {
            color: #2255a4;
        }
        #navbarSupportedContent {
            background: #2255a4!important;
        }
        #main-wrapper .left-sidebar[data-sidebarbg=skin5], #main-wrapper .left-sidebar[data-sidebarbg=skin5] ul {
            background: #2255a4;
        }
        label {
            font-weight: bold;
        }
        .sidebar-nav ul .sidebar-item .sidebar-link {
            padding: 5px 15px;
        }
        .sidebar-nav ul .sidebar-item .first-level .sidebar-item .sidebar-link {
            padding: 5px 15px;
        }
        .sidebar-nav .has-arrow:after {
            top: 15px!important;
        }
    </style>
@yield("styles")
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin5">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand " href="/">
                    <!-- Logo icon -->
                {{--<b class="logo-icon p-l-10">--}}
                {{--<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->--}}
                {{--<!-- Dark Logo icon -->--}}
                {{--<img src="{{ URL::to("/backend/assets/images/logo-icon.png") }}" alt="homepage" class="light-logo" />--}}

                {{--</b>--}}
                <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text ">
                             <!-- dark Logo text -->
                                <h5 >Abdullah Fire Protection</h5>
                        {{--<img src="{{ URL::to("/backend/assets/images/logo-text.png") }}" alt="homepage" class="light-logo" />--}}

                        </span>
                    <!-- Logo icon -->
                    <!-- <b class="logo-icon"> -->
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                <!-- <img src="{{ URL::to("/backend/assets/images/logo-text.png") }}" alt="homepage" class="light-logo" /> -->

                    <!-- </b> -->
                    <!--End Logo icon -->
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-left mr-auto">
                    <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    <!-- ============================================================== -->
                    <!-- create new -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                            <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                        <form class="app-search position-absolute">
                            <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                        </form>
                    </li>
                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">
                    <!-- ============================================================== -->
                    <!-- Comment -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Comment -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Messages -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                            <ul class="list-style-none">
                                <li>
                                    <div class="">
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                                <div class="m-l-10">
                                                    <h5 class="m-b-0">Event today</h5>
                                                    <span class="mail-desc">Just a reminder that event</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                <div class="m-l-10">
                                                    <h5 class="m-b-0">Settings</h5>
                                                    <span class="mail-desc">You can customize this template</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                <div class="m-l-10">
                                                    <h5 class="m-b-0">Pavan kumar</h5>
                                                    <span class="mail-desc">Just see the my admin!</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                                <div class="m-l-10">
                                                    <h5 class="m-b-0">Luanch Admin</h5>
                                                    <span class="mail-desc">Just see the my new admin!</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Messages -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ URL::to("/backend/assets/images/users/1.jpg") }}" alt="user" class="rounded-circle" width="31"></a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated">
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <div class="dropdown-divider"></div>
                            <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="p-t-30">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ route("admin.dashboard.index") }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-tag"></i><span class="hide-menu">Category </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.category.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Categories </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.category.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Category </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-bookmark"></i><span class="hide-menu">Sub Category </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.sub-category.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Sub Categories </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.sub-category.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Sub Category </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-clipboard-check"></i><span class="hide-menu">Brand </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.brand.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Brands </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.brand.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Brand </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-tag"></i><span class="hide-menu">Uom </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.uom.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Uom </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.uom.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Uom </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Supplier </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.supplier.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Suppliers </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.supplier.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Supplier </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-database"></i><span class="hide-menu">Product </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.product.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Products </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.product.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Product </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-database"></i><span class="hide-menu">Quotation </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.quotation.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Quotations </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Seller </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.seller.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Sellers </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.seller.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Seller </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Purchaser </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.purchaser.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Purchasers </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.purchaser.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Purchaser </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Accountant </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.accountant.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Accountants </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.accountant.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Accountant </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">HR </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.hr.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All HRs </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.hr.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add HR </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Coordinator </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.coordinator.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Coordinators </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.coordinator.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Coordinator </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Maintainer </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.maintainer.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Maintainers </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.maintainer.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Maintainer </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Store Keeper </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.store_keeper.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Store Keepers </span></a></li>
                            <li class="sidebar-item"><a href="{{ route("admin.store_keeper.create") }}" class="sidebar-link"><i class="mdi mdi-plus-circle"></i><span class="hide-menu"> Add Store Keeper </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Customer </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.customer.index") }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> All Customers </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route("admin.settings.index") }}" class="sidebar-link"><i class="mdi mdi-settings"></i><span class="hide-menu"> Change Settings </span></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        {{--<div class="page-breadcrumb">--}}
            {{--<div class="row">--}}
                {{--<div class="col-12 d-flex no-block align-items-center">--}}
                    {{--<h4 class="page-title">Dashboard</h4>--}}
                    {{--<div class="ml-auto text-right">--}}
                        {{--<nav aria-label="breadcrumb">--}}
                            {{--<ol class="breadcrumb">--}}
                                {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                                {{--<li class="breadcrumb-item active" aria-current="page">Library</li>--}}
                            {{--</ol>--}}
                        {{--</nav>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid bg-white">
            @yield("content")
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            All Rights Reserved by Abdullah Fire Protection
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ URL::to("/backend/assets/libs/jquery/dist/jquery.min.js")}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ URL::to("/backend/assets/libs/popper.js/dist/umd/popper.min.js")}}"></script>
<script src="{{ URL::to("/backend/assets/libs/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<script src="{{ URL::to("/backend/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js")}}"></script>
<script src="{{ URL::to("/backend/assets/extra-libs/sparkline/sparkline.js")}}"></script>
<!--Wave Effects -->
<script src="{{ URL::to("/backend/dist/js/waves.js") }}"></script>
<!--Menu sidebar -->
<script src="{{ URL::to("/backend/dist/js/sidebarmenu.js") }}"></script>
<!--Custom JavaScript -->
<script src="{{ URL::to("/backend/dist/js/custom.min.js") }}"></script>
<!--This page JavaScript -->
<!-- <script src="{{ URL::to("/backend/dist/js/pages/dashboards/dashboard1.js") }}"></script> -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script  src="{{ URL::to("backend/assets/libs/toastr/build/toastr.min.js") }}"></script>

@yield("scripts")
</body>

</html>