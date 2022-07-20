<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ url('css/lib/calendar2/semantic.ui.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/lib/calendar2/pignose.calendar.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/lib/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/lib/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/helper.css') }}" rel="stylesheet">
    <link href="{{ url('css/style_admin.css') }}" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2"
                stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                        <span><img src="{{ url('images/logo.png') }}" alt="homepage" class="dark-logo" height="100"
                                width="150" /></span>
                        <p class="font-italic" style="color:rgb(178, 14, 82)">Carrot Di Perfume Magic</p>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  "
                                href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  "
                                href="javascript:void(0)"><i class="ti-menu"></i></a> </li>


                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <!-- đăng nhập -->
                            <a class="nav-link dropdown-toggle text-muted  " href="" data-toggle="dropdown" style="text-align: center"
                                aria-haspopup="true" aria-expanded="false">
                                <!-- avatar -->
                                <img src="/image/avarta_admin.png" alt="" width="50px" height="100px" class="profile-pic" /><br>
                                <!-- tên user -->
                                <span class="middle">Admin</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">

                                <ul class="dropdown-user">
                                    <!-- đăng xuất -->
                                    <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Log out</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider">
                        </li>
                        <li class="nav-devider"></li>
                        <li><a aria-expanded="false" href="{{ route('invoiceAdmin') }}"><i
                                    class="fa fa-file-text"></i><span class="hide-menu">Invoice </span></a></li>
                        <li><a aria-expanded="false" href="{{ route('receipt') }}"><i
                                    class="fa fa-indent"></i><span class="hide-menu">Import Receipt</span></a></li>
                        <li><a aria-expanded="false" href="{{ route('productad.index') }}"><i
                                    class="fa fa-pagelines "></i><span class="hide-menu ">Perfume Model</span></a></li>
                        <li><a aria-expanded="false" href="{{ route('product_detail.index') }}"><i
                                    class="fa fa-snowflake-o "></i><span class="hide-menu ">Perfume</span></a></li>
                        <li><a aria-expanded="false" href="{{ route('brand.index') }}"><i
                                    class="fa fa-leaf"></i><span class="hide-menu">Brand</span></a></li>
                        <li><a aria-expanded="false" href="{{ route('scentad.index') }}"><i
                                    class="fa fa-star"></i><span class="hide-menu">Scent</span></a></li>
                        <li><a aria-expanded="false" href="{{ route('salead.index') }}"><i
                                    class="fa fa-bookmark"></i><span class="hide-menu">Promotion</span></a></li>
                        <li><a aria-expanded="false" href="{{ route('sale_detailad.index') }}"><i
                                    class="fa fa-gift"></i><span class="hide-menu">Promotion Detail</span></a>
                        </li>
                        <li><a aria-expanded="false" href=""><i class="fa fa-user"></i><span
                                    class="hide-menu">Account</span></a></li>
                        {{-- <li ><a aria-expanded="false" href=""><i class="fa fa-comment"></i><span class="hide-menu">Comment</span></a></li> --}}

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <div class="page-wrapper">
            @yield('container')
            <div class="container-fluid">
                <!-- Start Page Content -->
                @yield('main')
            </div>
            <footer class="footer"> Design by Tran Thi Tuyet Nhu, Huynh Thao Vy</footer>
        </div>
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="{{ url('js/lib/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ url('js/lib/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ url('js/jquery.slimscroll.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ url('js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ url('js/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

    <script src="{{ url('js/lib/morris-chart/raphael-min.js') }}"></script>
    <script src="{{ url('js/lib/morris-chart/morris.js') }}"></script>
    <script src="{{ url('js/lib/morris-chart/dashboard1-init.js') }}"></script>


    <script src="{{ url('js/lib/calendar-2/moment.latest.min.js') }}"></script>
    <script src="{{ url('js/lib/calendar-2/semantic.ui.min.js') }}"></script>
    <script src="{{ url('js/lib/calendar-2/prism.min.js') }}"></script>
    <script src="{{ url('js/lib/calendar-2/pignose.calendar.min.js') }}"></script>
    <script src="{{ url('js/lib/calendar-2/pignose.init.js') }}"></script>
    <script src="{{ url('js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('js/lib/owl-carousel/owl.carousel-init.js') }}"></script>
    <script src="{{ url('js/scripts.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>
    <script src="{{ url('js/lib/datatables/datatables.min.js') }}"></script>
    <script src="{{ url('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js') }}"></script>
    <script src="{{ url('js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js') }}"></script>
    <script src="{{ url('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') }}"></script>
    <script src="{{ url('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') }}"></script>
    <script src="{{ url('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('js/lib/datatables/datatables-init.js') }}"></script>
    <script src="{{ url('js/lib/money/simple.money.format.js') }}"></script>
 
</html>
