<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Favicons -->
    <link href="{{ URL::asset('new/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ URL::asset('new/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    {{-- <link href="new/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="new/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="new/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="new/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="new/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="new/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="new/assets/vendor/simple-datatables/style.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ URL::asset('new/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('new/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('new/assets/vendor/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('new/assets/vendor/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('new/assets/vendor/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('new/assets/vendor/remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('new/assets/vendor/simple-datatables/style.css') }}">

    <!-- Template Main CSS File -->
    {{-- <link href="new/assets/css/style.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ URL::asset('new/assets/css/style.css') }}">

    @yield('css')


    {{-- dri lamaa --}}


    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery-ui.css') }}">
    @yield('css')
    <link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
    <script src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

    {{-- batass --}}
 <!-- datatables -->
 <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/css/jquery.dataTables.min.css') }}">
 <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/buttons.jqueryui.min.css') }}">
 <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery-ui.css') }}">

 <link rel="stylesheet"
 href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css">
<link rel="stylesheet" href="https://cdn.datatables.net/scroller/1.5.1/css/scroller.dataTables.min.css">
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/toastr/toastr.min.css') }}">
<!-- sweetalert -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<!-- bootstrap toogle -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<!--   <link rel="stylesheet" href="{{ URL::asset('bower_components/bootstrap-toggle-master/css/bootstrap-toggle.min.css') }}" > -->


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{ URL::asset('new/assets/img/favicon.png') }}" width="30px" height="80px" alt="">
                <span class="d-none d-lg-block">Sales CDI</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->





                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ URL::asset('dist/img/pincobra.png') }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->jabatan }}</h6>
                            <span>{{ Auth::user()->kode_cabang }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{!! route('account_setting') !!}">
                                <i class="bi bi-person"></i>
                                <span>Account</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>


                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->




    @if (Auth::user()->role_id == 3)
        @include('layouts/menuuser')
    @elseif (Auth::user()->role_id == 2)
        @include('layouts/menuadmin')
    @elseif (Auth::user()->role_id == 1)
        @include('layouts/menusuper')
    @elseif (Auth::user()->role_id == 4)
        @include('layouts/menuarea')
    @elseif (Auth::user()->role_id == 5)
        @include('layouts/menucustomer')
    @endif
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@yield('minititle')</h1>
            {{-- <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav> --}}
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->


                @yield('content')




            </div><!-- End Right side columns -->


        </section>
        @include('layouts._modal')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>PT.Cobra Dental Indonesia</span></strong>
        </div>

    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ URL::asset('new/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('new/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('new/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ URL::asset('new/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ URL::asset('new/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ URL::asset('new/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ URL::asset('new/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('new/assets/vendor/php-email-form/validate.js') }}"></script>

    {{-- @yield('javascript') --}}

    <!-- Template Main JS File -->
    <script src="{{ URL::asset('new/assets/js/main.js') }}"></script>


    {{-- dri lamaa --}}

    @yield('javascript')
    <script src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.js') }}"></script>

    <script src="{{ URL::asset('bower_components/bootstrap/js/modal.js') }}"></script>

{{--  --}}

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<!-- validate -->
<script src="{{ URL::asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- datatables -->
<script src="{{ URL::asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/js/dataTables.select.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/js/buttons.jqueryui.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/js/dataTables.fixedColumns.min.js') }}"></script>

   <!-- bootstrap-toggle-master -->
   <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
   <!-- <script type="text/javascript"
       src="{{ URL::asset('bower_components/bootstrap-toggle-master/js/bootstrap-toggle.min.js') }}"></script>   -->
   <!-- Slimscroll -->
   <script src="{{ URL::asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
   <!-- FastClick -->
   <script src="{{ URL::asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
   <!-- AdminLTE App -->
   <script src="{{ URL::asset('dist/js/adminlte.min.js') }}"></script>
   <script src="{{ URL::asset('plugins/handlebars.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ URL::asset('plugins/toastr/toastr.min.js') }}"></script>
</body>
@yield('page-script')

</html>
