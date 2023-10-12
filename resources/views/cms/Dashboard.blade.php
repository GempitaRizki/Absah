@extends('seller.cmsheader')

@section('content')
    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description"
            content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
        <meta name="theme-name" content="sleek" />
        <title>Seller Dashboard</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
            rel="stylesheet" />
        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
        <link href="{{ asset('asset/css/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />
        <link href="{{ asset('asset/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
        <link href="{{ asset('asset/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet">
        <link href="{{ asset('asset/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('asset/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link id="sleek-css" rel="stylesheet" href="{{ asset('asset/css/sleek.css') }}" />
        <link href="{{ asset('asset/img/favicon.png') }}" rel="shortcut icon" />
        <link href="{{ asset('asset/css/appbrand.css') }}" rel="stylesheet" />

        <script src="{{ asset('asset/plugins/nprogress/nprogress.js') }}"></script>
    </head>

    <body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
        <script>
            NProgress.configure({
                showSpinner: false
            });
            NProgress.start();
        </script>
            <aside class="left-sidebar bg-sidebar">
                <div id="sidebar" class="sidebar sidebar-with-footer">
                    <div class="app-brand">
                        <a href="/index.html" title="Sleek Dashboard">
                            <span class="brand-name text-truncate">Seller Dashboard</span>
                            <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"
                                width="30" height="33" viewBox="0 0 30 33">
                                <g fill="none" fill-rule="evenodd">
                                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                </g>
                            </svg>
                        </a>
                    </div>                    
                    <br>
                    <div class="container-fluid">
                        <h1 style="font-size: 15px; color: white; text-align: center;">{{ Auth::user()->username }}</h1>
                    </div>

                    @include('seller.partials.sidebar')
                </div>
            </aside>

            <div class="page-wrapper">
                @include('seller.partials.header')



                <!-- Javascript -->
                <script src="{{ asset('asset/plugins/jquery/jquery.min.js') }}"></script>
                <script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                <script src="{{ asset('asset/plugins/simplebar/simplebar.min.js') }}"></script>
                <script src="{{ asset('asset/plugins/charts/Chart.min.js') }}"></script>
                <script src="{{ asset('asset/js/chart.js') }}"></script>
                <script src="{{ asset('asset/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
                <script src="{{ asset('asset/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
                <script src="{{ asset('asset/js/vector-map.js') }}"></script>
                <script src="{{ asset('asset/plugins/daterangepicker/moment.min.js') }}"></script>
                <script src="{{ asset('asset/plugins/daterangepicker/daterangepicker.js') }}"></script>
                <script src="{{ asset('asset/js/date-range.js') }}"></script>
                <script src="{{ asset('asset/plugins/toastr/toastr.min.js') }}"></script>
                <script src="{{ asset('asset/js/sleek.js') }}"></script>
                <link href="{{ asset('asset/options/optionswitch.css') }}" rel="stylesheet">
                <script src="{{ asset('asset/options/optionswitcher.js') }}"></script>
    </body>

    </html>
@endsection
