@extends('seller.topbar')

@section('content')
    
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
    <meta name="theme-name" content="sleek" />
    <title>Seller Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="{{ asset('asset/css/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet">
    <link href="{{ asset('asset/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{ asset('asset/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link id="sleek-css" rel="stylesheet" href="{{ asset('asset/css/sleek.css')}}" />
    <link href="{{ asset('asset/img/favicon.png')}}" rel="shortcut icon" />
    <script src="{{ asset('asset/plugins/nprogress/nprogress.js')}}"></script>
  </head>

  <body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    <div id="toaster"></div>

    <div class="wrapper">

      <a href="https://github.com/tafcoder/sleek-dashboard"  target="_blank" class="github-link">
        <svg width="70" height="70" viewBox="0 0 250 250" aria-hidden="true">
          <defs>
            <linearGradient id="grad1" x1="0%" y1="75%" x2="100%" y2="0%">
              <stop offset="0%" style="stop-color:#896def;stop-opacity:1" />
              <stop offset="100%" style="stop-color:#482271;stop-opacity:1" />
            </linearGradient>
          </defs>
          <path d="M 0,0 L115,115 L115,115 L142,142 L250,250 L250,0 Z" fill="url(#grad1)"></path>
        </svg>
        <i class="mdi mdi-github-circle"></i>
      </a>




        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="/index.html" title="Sleek Dashboard">
                <svg
                  class="brand-icon"
                  xmlns="http://www.w3.org/2000/svg"
                  preserveAspectRatio="xMidYMid"
                  width="30"
                  height="33"
                  viewBox="0 0 30 33">
                  <g fill="none" fill-rule="evenodd">
                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                  </g>
                </svg>

                <span class="brand-name text-truncate">Seller Dashboard</span>
              </a>
            </div>

            <!-- begin sidebar scrollbar -->
            <div class="" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="has-sub active expand">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                    aria-expanded="false" aria-controls="dashboard">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                    <span class="nav-text">Dashboard</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse show" id="dashboard" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="active">
                        <a class="sidenav-item-link" href="index.html">
                          <span class="nav-text">Ecommerce</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="analytics.html">
                          <span class="nav-text">Analytics</span>
                          <span class="badge badge-success">new</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                    aria-expanded="false" aria-controls="app">
                    <i class="mdi mdi-pencil-box-multiple"></i>
                    <span class="nav-text">App</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="app" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="chat.html">
                          <span class="nav-text">Chat</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="contacts.html">
                          <span class="nav-text">Contacts</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="team.html">
                          <span class="nav-text">Team</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="calendar.html">
                          <span class="nav-text">Calendar</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>

                <!-- <li class="section-title">
                  UI Elements
                </li> -->

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#components"
                    aria-expanded="false" aria-controls="components">
                    <i class="mdi mdi-folder-multiple-outline"></i>
                    <span class="nav-text">Components</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="components" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="alert.html">
                          <span class="nav-text">Alert</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="badge.html">
                          <span class="nav-text">Badge</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="breadcrumb.html">
                          <span class="nav-text">Breadcrumb</span>

                        </a>
                      </li>

                      <li class="has-sub ">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#buttons"
                          aria-expanded="false" aria-controls="buttons">
                          <span class="nav-text">Buttons</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse " id="buttons">
                          <div class="sub-menu">
                            <li class="">
                              <a href="button-default.html">Button Default</a>
                            </li>

                           <li class="">
                              <a href="button-dropdown.html">Button Dropdown</a>
                            </li>

                           <li class="">
                              <a href="button-group.html">Button Group</a>
                            </li>

                           <li class="">
                              <a href="button-social.html">Button Social</a>
                            </li>

                           <li class="">
                              <a href="button-loading.html">Button Loading</a>
                            </li>
                          </div>
                        </ul>
                      </li>
                      
                      <li class="">
                        <a class="sidenav-item-link" href="card.html">
                          <span class="nav-text">Card</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="carousel.html">
                          <span class="nav-text">Carousel</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="collapse.html">
                          <span class="nav-text">Collapse</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="list-group.html">
                          <span class="nav-text">List Group</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="modal.html">
                          <span class="nav-text">Modal</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="pagination.html">
                          <span class="nav-text">Pagination</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="popover-tooltip.html">
                          <span class="nav-text">Popover & Tooltip</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="progress-bar.html">
                          <span class="nav-text">Progress Bar</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="spinner.html">
                          <span class="nav-text">Spinner</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="switcher.html">
                          <span class="nav-text">Switcher</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="tab.html">
                          <span class="nav-text">Tab</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#icons"
                    aria-expanded="false" aria-controls="icons">
                    <i class="mdi mdi-diamond-stone"></i>
                    <span class="nav-text">Icons</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="icons" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="material-icon.html">
                          <span class="nav-text">Material Icon</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="flag-icon.html">
                          <span class="nav-text">Flag Icon</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#forms"
                    aria-expanded="false" aria-controls="forms">
                    <i class="mdi mdi-email-mark-as-unread"></i>
                    <span class="nav-text">Forms</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="forms" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="basic-input.html">
                          <span class="nav-text">Basic Input</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="input-group.html">
                          <span class="nav-text">Input Group</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="checkbox-radio.html">
                          <span class="nav-text">Checkbox & Radio</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="form-validation.html">
                          <span class="nav-text">Form Validation</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="form-advance.html">
                          <span class="nav-text">Form Advance</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#tables"
                    aria-expanded="false" aria-controls="tables">
                    <i class="mdi mdi-table"></i>
                    <span class="nav-text">Tables</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="tables" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="basic-tables.html">
                          <span class="nav-text">Basic Tables</span>
                        </a>
                      </li>

                      <li class="has-sub ">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#data-tables"
                          aria-expanded="false" aria-controls="data-tables">
                          <span class="nav-text">Data Tables</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse " id="data-tables">
                          <div class="sub-menu">
                            <li class="">
                              <a href="basic-data-table.html">Basic Data Table</a>
                            </li>

                           <li class="">
                              <a href="responsive-data-table.html">Responsive Data Table</a>
                            </li>

                           <li class="">
                              <a href="hoverable-data-table.html">Hoverable Data Table</a>
                            </li>

                           <li class="">
                              <a href="expendable-data-table.html">Expendable Data Table</a>
                            </li>
                          </div>
                        </ul>
                      </li>
                    </div>
                  </ul>
                </li>

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#maps"
                    aria-expanded="false" aria-controls="maps">
                    <i class="mdi mdi-google-maps"></i>
                    <span class="nav-text">Maps</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="maps" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="google-map.html">
                          <span class="nav-text">Google Map</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="vector-map.html">
                          <span class="nav-text">Vector Map</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#widgets"
                    aria-expanded="false" aria-controls="widgets">
                    <i class="mdi mdi-widgets"></i>
                    <span class="nav-text">Widgets</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="widgets" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="general-widget.html">
                          <span class="nav-text">General Widget</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="chart-widget.html">
                          <span class="nav-text">Chart Widget</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#charts"
                    aria-expanded="false" aria-controls="charts">
                    <i class="mdi mdi-chart-pie"></i>
                    <span class="nav-text">Charts</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="charts" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="chartjs.html">
                          <span class="nav-text">ChartJS</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>

                <!-- <li class="section-title">
                  Pages
                </li> -->

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#pages"
                    aria-expanded="false" aria-controls="pages">
                    <i class="mdi mdi-image-filter-none"></i>
                    <span class="nav-text">Pages</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="pages" data-parent="#sidebar-menu">
                    <div class="sub-menu ">
                      <li class="">
                        <a class="sidenav-item-link" href="user-profile.html">
                          <span class="nav-text">User Profile</span>
                        </a>
                      </li>

                      <li class="has-sub ">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#authentication"
                          aria-expanded="false" aria-controls="authentication">
                          <span class="nav-text">Authentication</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse " id="authentication">
                          <div class="sub-menu">
                            <li class="">
                              <a href="sign-in.html">Sign In</a>
                            </li>

                           <li class="">
                              <a href="sign-up.html">Sign Up</a>
                            </li>
                          </div>
                        </ul>
                      </li>

                      <li class="has-sub ">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#others"
                          aria-expanded="false" aria-controls="others">
                          <span class="nav-text">Others</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse " id="others">
                          <div class="sub-menu">
                            <li class="">
                              <a href="invoice.html">Invoice</a>
                            </li>

                           <li class="">
                              <a href="404.html">404 Page</a>
                            </li>
                          </div>
                        </ul>
                      </li>
                    </div>
                  </ul>
                </li>

                <li class="has-sub ">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#documentation"
                    aria-expanded="false" aria-controls="documentation">
                    <i class="mdi mdi-book-open-page-variant"></i>
                    <span class="nav-text">Documentation</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="documentation" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="section-title">
                        Getting Started
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="introduction.html">
                          <span class="nav-text">Introduction</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="quick-start.html">
                          <span class="nav-text">Quick Start</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="customization.html">
                          <span class="nav-text">Customization</span>
                        </a>
                      </li>

                      <li class="section-title">
                        Layouts
                      </li>

                      <li class="has-sub ">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#header-variations" aria-expanded="false" aria-controls="header-variations">
                          <span class="nav-text">Header Variations</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse " id="header-variations">
                          <div class="sub-menu">
                            <li class="">
                              <a href="header-fixed.html">Header Fixed</a>
                            </li>

                            <li class="">
                              <a href="header-static.html">Header Static</a>
                            </li>

                            <li class="">
                              <a href="header-light.html">Header Light</a>
                            </li>

                            <li class="">
                              <a href="header-dark.html">Header Dark</a>
                            </li>
                          </div>
                        </ul>
                      </li>

                      <li class="has-sub ">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#sidebar-variations" aria-expanded="false" aria-controls="sidebar-variations">
                          <span class="nav-text">Sidebar Variations</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse " id="sidebar-variations">
                          <div class="sub-menu">
                            <li class="">
                              <a href="sidebar-fixed-default.html">Sidebar Fixed Default</a>
                            </li>

                            <li class="">
                              <a href="sidebar-fixed-minified.html">Sidebar Fixed Minified</a>
                            </li>

                            <li class="">
                              <a href="sidebar-fixed-offcanvas.html">Sidebar Fixed Offcanvas</a>
                            </li>

                            <li class="">
                              <a href="sidebar-static-default.html">Sidebar Static Default</a>
                            </li>

                            <li class="">
                              <a href="sidebar-static-minified.html">Sidebar Static Minified</a>
                            </li>

                            <li class="">
                              <a href="sidebar-static-offcanvas.html">Sidebar Static Offcanvas</a>
                            </li>

                            <li class="">
                              <a href="sidebar-with-footer.html">Sidebar With Footer</a>
                            </li>

                            <li class="">
                              <a href="sidebar-without-footer.html">Sidebar Without Footer</a>
                            </li>

                            <li class="">
                              <a href="right-sidebar.html">Right Sidebar</a>
                            </li>
                          </div>
                        </ul>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="rtl.html">
                          <span class="nav-text">RTL Direction</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>

                <!-- <li class="section-title">
                  Documentation
                </li> -->
              </ul>
            </div>

            <div class="sidebar-footer">
              <hr class="separator mb-0" />
              <div class="sidebar-footer-content">
                <h6 class="text-uppercase">
                  Cpu Uses <span class="float-right">40%</span>
                </h6>

                <div class="progress progress-xs">
                  <div class="progress-bar active" style="width: 40%;" role="progressbar"></div>
                </div>

                <h6 class="text-uppercase">
                  Memory Uses <span class="float-right">65%</span>
                </h6>

                <div class="progress progress-xs">
                  <div class="progress-bar progress-bar-warning" style="width: 65%;" role="progressbar"></div>
                </div>
              </div>
            </div>
          </div>
        </aside>


          <!-- ====================================
        ——— PAGE WRAPPER
        ===================================== -->
        <div class="page-wrapper">
          
          <!-- Header -->
          <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <!-- search form -->
              <div class="search-form d-none d-lg-inline-block">
                <div class="input-group">
                  <button type="button" name="search" id="search-btn" class="btn btn-flat">
                    <i class="mdi mdi-magnify"></i>
                  </button>
                  <input type="text" name="query" id="search-input" class="form-control" placeholder="'button', 'chart' etc."
                    autofocus autocomplete="off" />
                </div>
                <div id="search-results-container">
                  <ul id="search-results"></ul>
                </div>
              </div>

              <div class="navbar-right ">
                <ul class="nav navbar-nav">
                  <li class="dropdown notifications-menu custom-dropdown">
                    <button class="dropdown-toggle notify-toggler custom-dropdown-toggler">
                      <i class="mdi mdi-bell-outline"></i>
                    </button>

                    <div class="card card-default dropdown-notify dropdown-menu-right mb-0">
                      <div class="card-header card-header-border-bottom px-3">
                        <h2>Notifications</h2>
                      </div>

                      <div class="card-body px-0 py-3">
                        <ul class="nav nav-tabs nav-style-border p-0 justify-content-between" id="myTab" role="tablist">
                          <li class="nav-item mx-3 my-0 py-0">
                            <a class="nav-link active pb-3" id="home2-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home2" aria-selected="true">All (11)</a>
                          </li>

                          <li class="nav-item mx-3 my-0 py-0">
                            <a class="nav-link pb-3" id="profile2-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false">Msgs (6)</a>
                          </li>

                          <li class="nav-item mx-3 my-0 py-0">
                            <a class="nav-link pb-3" id="contact2-tab" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false">Others (5)</a>
                          </li>
                        </ul>

                        <div class="tab-content" id="myTabContent3">
                          <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home2-tab">
                            <ul class="list-unstyled" data-simplebar style="height: 360px">
                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">
                                  <div class="position-relative mr-3">
                                    <img class="rounded-circle" src="assets/img/user/u2.jpg" alt="Image">
                                    <span class="status away"></span>
                                  </div>
                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Aaren</h4>
                                      <p class="last-msg">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam itaque doloremque odio, eligendi delectus vitae.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 30 min ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification media-active">
                                  <div class="position-relative mr-3">
                                    <img class="rounded-circle" src="assets/img/user/u1.jpg" alt="Image">
                                    <span class="status active"></span>
                                  </div>
                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Abril</h4>
                                      <p class="last-msg">Donec mattis augue a nisl consequat, nec imperdiet ex rutrum. Fusce et vehicula enim. Sed in enim eu odio vehic.</p>

                                      <span class="font-size-12 font-weight-medium text-white">
                                        <i class="mdi mdi-clock-outline"></i> Just now...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">
                                  <div class="position-relative mr-3">
                                    <img class="rounded-circle" src="assets/img/user/u5.jpg" alt="Image">
                                    <span class="status away"></span>
                                  </div>
                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Emma</h4>
                                      <p class="last-msg">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam itaque doloremque odio, eligendi delectus vitae.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 1 hrs ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification event-active">

                                  <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
                                    <i class="mdi mdi-calendar-check font-size-20"></i>
                                  </div>

                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">New event added</h4>
                                      <p class="last-msg font-size-14">03/Jan/2020 (1pm - 2pm)</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 10 min ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">

                                  <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                    <i class="mdi mdi-chart-areaspline font-size-20"></i>
                                  </div>

                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Sales report</h4>
                                      <p class="last-msg font-size-14">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam itaque doloremque odio, eligendi delectus vitae.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 1 hrs ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">

                                  <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                    <i class="mdi mdi-account-multiple-check font-size-20"></i>
                                  </div>

                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Add request</h4>
                                      <p class="last-msg font-size-14">Add Dany Jones as your contact consequat nec imperdiet ex rutrum. Fusce et vehicula enim. Sed in enim.</p>

                                      <button type="button" class="my-1 btn btn-sm btn-success">Accept</button>
                                      <button type="button" class="my-1 btn btn-sm btn-secondary">Delete</button>

                                      <span class="font-size-12 font-weight-medium text-secondary d-block">
                                        <i class="mdi mdi-clock-outline"></i> 5 min ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">

                                  <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                    <i class="mdi mdi-server-network-off font-size-20"></i>
                                  </div>

                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Server overloaded</h4>
                                      <p class="last-msg font-size-14">Donec mattis augue a nisl consequat, nec imperdiet ex rutrum. Fusce et vehicula enim. Sed in enim eu odio vehic.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 30 min ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">

                                  <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-purple text-white">
                                    <i class="mdi mdi-playlist-check font-size-20"></i>
                                  </div>

                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Task complete</h4>
                                      <p class="last-msg font-size-14">Nam ut nisi erat. Ut quis tortor varius, hendrerit arcu quis, congue nisl. In scelerisque, sem ut ve.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 2 hrs ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                            </ul>
                          </div>

                          <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile2-tab">
                            <ul class="list-unstyled" data-simplebar style="height: 360px">
                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">
                                  <div class="position-relative mr-3">
                                    <img class="rounded-circle" src="assets/img/user/u6.jpg" alt="Image">
                                    <span class="status away"></span>
                                  </div>
                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">William</h4>
                                      <p class="last-msg">Donec mattis augue a nisl consequat, nec imperdiet ex rutrum. Fusce et vehicula enim. Sed in enim eu odio vehic.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 1 hrs ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">
                                  <div class="position-relative mr-3">
                                    <img class="rounded-circle" src="assets/img/user/u7.jpg" alt="Image">
                                    <span class="status away"></span>
                                  </div>
                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Camble</h4>
                                      <p class="last-msg">Nam ut nisi erat. Ut quis tortor varius, hendrerit arcu quis, congue nisl. In scelerisque, sem ut ve.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 1 hrs ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification media-active">
                                  <div class="position-relative mr-3">
                                    <img class="rounded-circle" src="assets/img/user/u1.jpg" alt="Image">
                                    <span class="status active"></span>
                                  </div>
                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Abril</h4>
                                      <p class="last-msg">Donec mattis augue a nisl consequat, nec imperdiet ex rutrum. Fusce et vehicula enim. Sed in enim eu odio vehic.</p>

                                      <span class="font-size-12 font-weight-medium text-white">
                                        <i class="mdi mdi-clock-outline"></i> Just now...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">
                                  <div class="position-relative mr-3">
                                    <img class="rounded-circle" src="assets/img/user/u2.jpg" alt="Image">
                                    <span class="status away"></span>
                                  </div>
                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Aaren</h4>
                                      <p class="last-msg">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam itaque doloremque odio, eligendi delectus vitae.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 1 hrs ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">
                                  <div class="position-relative mr-3">
                                    <img class="rounded-circle" src="assets/img/user/u5.jpg" alt="Image">
                                    <span class="status away"></span>
                                  </div>
                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Emma</h4>
                                      <p class="last-msg">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam itaque doloremque odio, eligendi delectus vitae.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 1 hrs ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                            </ul>
                          </div>

                          <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2-tab">
                            <ul class="list-unstyled" data-simplebar style="height: 360px">
                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification event-active">

                                  <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
                                    <i class="mdi mdi-calendar-check font-size-20"></i>
                                  </div>

                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">New event added</h4>
                                      <p class="last-msg font-size-14">03/Jan/2020 (1pm - 2pm)</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 10 min ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">

                                  <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                    <i class="mdi mdi-chart-areaspline font-size-20"></i>
                                  </div>

                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Sales report</h4>
                                      <p class="last-msg font-size-14">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam itaque doloremque odio, eligendi delectus vitae.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 1 hrs ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">

                                  <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                    <i class="mdi mdi-account-multiple-check font-size-20"></i>
                                  </div>

                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Add request</h4>
                                      <p class="last-msg font-size-14">Add Dany Jones as your contact consequat nec imperdiet ex rutrum. Fusce et vehicula enim. Sed in enim.</p>

                                      <button type="button" class="my-1 btn btn-sm btn-success">Accept</button>
                                      <button type="button" class="my-1 btn btn-sm btn-secondary">Delete</button>

                                      <span class="font-size-12 font-weight-medium text-secondary d-block">
                                        <i class="mdi mdi-clock-outline"></i> 5 min ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">

                                  <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                    <i class="mdi mdi-server-network-off font-size-20"></i>
                                  </div>

                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Server overloaded</h4>
                                      <p class="last-msg font-size-14">Donec mattis augue a nisl consequat, nec imperdiet ex rutrum. Fusce et vehicula enim. Sed in enim eu odio vehic.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 30 min ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a href="javscript:void(0)" class="media media-message media-notification">

                                  <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-purple text-white">
                                    <i class="mdi mdi-playlist-check font-size-20"></i>
                                  </div>

                                  <div class="media-body d-flex justify-content-between">
                                    <div class="message-contents">
                                      <h4 class="title">Task complete</h4>
                                      <p class="last-msg font-size-14">Nam ut nisi erat. Ut quis tortor varius, hendrerit arcu quis, congue nisl. In scelerisque, sem ut ve.</p>

                                      <span class="font-size-12 font-weight-medium text-secondary">
                                        <i class="mdi mdi-clock-outline"></i> 2 hrs ago...
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>

                    <ul class="dropdown-menu dropdown-menu-right d-none">
                      <li class="dropdown-header">You have 5 notifications</li>
                      <li>
                        <a href="#">
                          <i class="mdi mdi-account-plus"></i> New user registered
                          <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="mdi mdi-account-remove"></i> User deleted
                          <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 07 AM</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="mdi mdi-chart-areaspline"></i> Sales report is ready
                          <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 12 PM</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="mdi mdi-account-supervisor"></i> New client
                          <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="mdi mdi-server-network-off"></i> Server overloaded
                          <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 05 AM</span>
                        </a>
                      </li>
                      <li class="dropdown-footer">
                        <a class="text-center" href="#"> View All </a>
                      </li>
                    </ul>
                  </li>
                  <li class="right-sidebar-in right-sidebar-2-menu">
                    <i class="mdi mdi-settings mdi-spin"></i>
                  </li>
                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <img src="assets/img/user/user.png" class="user-image" alt="User Image" />
                      <span class="d-none d-lg-inline-block">Abdus Salam</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <!-- User image -->
                      <li class="dropdown-header">
                        <img src="assets/img/user/user.png" class="img-circle" alt="User Image" />
                        <div class="d-inline-block">
                          Abdus Salam <small class="pt-1">iamabdus@gmail.com</small>
                        </div>
                      </li>

                      <li>
                        <a href="user-profile.html">
                          <i class="mdi mdi-account"></i> My Profile
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="mdi mdi-email"></i> Message
                        </a>
                      </li>
                      <li>
                        <a href="#"> <i class="mdi mdi-diamond-stone"></i> Projects </a>
                      </li>
                      <li class="right-sidebar-in">
                        <a href="javascript:0"> <i class="mdi mdi-settings"></i> Setting </a>
                      </li>

                      <li class="dropdown-footer">
                        <a href="index.html"> <i class="mdi mdi-logout"></i> Log Out </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </header>

          
          <!-- ====================================
          ——— CONTENT WRAPPER
          ===================================== -->
          <div class="content-wrapper">
            <div class="content">





		
                  <!-- Top Statistics -->
                  <div class="row">
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-1">71,503</h2>
                          <p>Online Signups</p>
                          <div class="chartjs-wrapper">
                            <canvas id="barChart"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini  mb-4">
                        <div class="card-body">
                          <h2 class="mb-1">9,503</h2>
                          <p>New Visitors Today</p>
                          <div class="chartjs-wrapper">
                            <canvas id="dual-line"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-1">71,503</h2>
                          <p>Monthly Total Order</p>
                          <div class="chartjs-wrapper">
                            <canvas id="area-chart"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-1">9,503</h2>
                          <p>Total Revenue This Year</p>
                          <div class="chartjs-wrapper">
                            <canvas id="line"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


		<div class="row">
			<div class="col-xl-8 col-md-12">
				
                      <!-- Sales Graph -->
                      <div class="card card-default">
                        <div class="card-header">
                          <h2>Sales Of The Year</h2>
                        </div>
                        <div class="card-body">
                          <canvas id="linechart" class="chartjs"></canvas>
                        </div>
                        <div class="card-footer d-flex flex-wrap bg-white p-0">
                          <div class="col-6 px-0">
                            <div class="text-center p-4">
                              <h4>$6,308</h4>
                              <p class="mt-2">Total orders of this year</p>
                            </div>
                          </div>
                          <div class="col-6 px-0">
                            <div class="text-center p-4 border-left">
                              <h4>$70,506</h4>
                              <p class="mt-2">Total revenue of this year</p>
                            </div>
                          </div>
                        </div>
                      </div>

			</div>

			<div class="col-xl-4 col-md-12">
				
                  <!-- Doughnut Chart -->
                  <div class="card card-default">
                    <div class="card-header justify-content-center">
                      <h2>Orders Overview</h2>
                    </div>
                    <div class="card-body" >
                      <canvas id="doChart" ></canvas>
                    </div>
                    <a href="#" class="pb-5 d-block text-center text-muted"><i class="mdi mdi-download mr-2"></i> Download overall report</a>
                    <div class="card-footer d-flex flex-wrap bg-white p-0">
                      <div class="col-6">
                        <div class="py-4 px-4">
                          <ul class="d-flex flex-column justify-content-between">
                            <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #4c84ff"></i>Order Completed</li>
                            <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #80e1c1 "></i>Order Unpaid</li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-6 border-left">
                        <div class="py-4 px-4 ">
                          <ul class="d-flex flex-column justify-content-between">
                            <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #8061ef"></i>Order Pending</li>
                            <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #ffa128"></i>Order Canceled</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

			</div>
		</div>

		<div class="row">
			<div class="col-xl-4 col-lg-6 col-12">
				
                  <!-- Polar and Radar Chart -->
                  <div class="card card-default">
                    <div class="card-header justify-content-center">
                      <h2>Sales Overview</h2>
                    </div>
                    <div class="card-body pt-0">
                      <ul class="nav nav-pills mb-5 mt-5 nav-style-fill nav-justified" id="pills-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Sales Status</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Monthly Sales</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                          <canvas id="polar"></canvas>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                          <canvas id="radar"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>

			</div>

			<div class="col-xl-4 col-lg-6 col-12">
				
                  <!-- Top Sell Table -->
                  <div class="card card-table-border-none">
                    <div class="card-header justify-content-between">
                      <h2>Sold by Units</h2>
                      <div>
                          <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-cached"></i></button>
                          <div class="dropdown show d-inline-block widget-dropdown">
                              <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-units" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-units">
                                <li class="dropdown-item"><a  href="#">Action</a></li>
                                <li class="dropdown-item"><a  href="#">Another action</a></li>
                                <li class="dropdown-item"><a  href="#">Something else here</a></li>
                              </ul>
                            </div>
                      </div>
                    </div>
                    <div class="card-body py-0 compact-units" data-simplebar style="height: 384px;">
                      <table class="table ">
                        <tbody>
                          <tr>
                            <td class="text-dark">Backpack</td>
                            <td class="text-center">9</td>
                            <td class="text-right">33% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                          </tr>
                          <tr>
                            <td class="text-dark">T-Shirt</td>
                            <td class="text-center">6</td>
                            <td class="text-right">150% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                          </tr>
                          <tr>
                            <td class="text-dark">Coat</td>
                            <td class="text-center">3</td>
                            <td class="text-right">50% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                          </tr>
                          <tr>
                            <td class="text-dark">Necklace</td>
                            <td class="text-center">7</td>
                            <td class="text-right">150% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                          </tr>
                          <tr>
                            <td class="text-dark">Jeans Pant</td>
                            <td class="text-center">10</td>
                            <td class="text-right">300% <i class="mdi mdi-arrow-down-bold text-danger pl-1 font-size-12"></i> </td>
                          </tr>
                          <tr>
                            <td class="text-dark">Shoes</td>
                            <td class="text-center">5</td>
                            <td class="text-right">100% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                          </tr>
                          <tr>
                            <td class="text-dark">T-Shirt</td>
                            <td class="text-center">6</td>
                            <td class="text-right">150% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                          </tr>
                        </tbody>
                      </table>

                    </div>
                    <div class="card-footer bg-white py-4">
                      <a href="#" class="btn-link py-3 text-uppercase">View Report</a>
                    </div>
                  </div>

			</div>

			<div class="col-xl-4 col-12">
				
                        <!-- Notification Table -->
                        <div class="card card-default">
                          <div class="card-header justify-content-between mb-1">
                            <h2>Latest Notifications</h2>
                            <div>
                                <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-cached"></i></button>
                                <div class="dropdown show d-inline-block widget-dropdown">
                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-notification">
                                      <li class="dropdown-item"><a  href="#">Action</a></li>
                                      <li class="dropdown-item"><a  href="#">Another action</a></li>
                                      <li class="dropdown-item"><a  href="#">Something else here</a></li>
                                    </ul>
                                  </div>
                            </div>

                          </div>
                          <div class="card-body compact-notifications" data-simplebar style="height: 434px;">
                            <div class="media pb-3 align-items-center justify-content-between">
                              <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                <i class="mdi mdi-cart-outline font-size-20"></i>
                              </div>
                              <div class="media-body pr-3 ">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New Order</a>
                                <p >Selena has placed an new order</p>
                              </div>
                              <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                            </div>

                            <div class="media py-3 align-items-center justify-content-between">
                              <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                                <i class="mdi mdi-email-outline font-size-20"></i>
                              </div>
                              <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New Enquiry</a>
                                <p >Phileine has placed an new order</p>
                              </div>
                              <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 9 AM</span>
                            </div>


                            <div class="media py-3 align-items-center justify-content-between">
                              <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                <i class="mdi mdi-stack-exchange font-size-20"></i>
                              </div>
                              <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Support Ticket</a>
                                <p >Emma has placed an new order</p>
                              </div>
                              <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                            </div>

                            <div class="media py-3 align-items-center justify-content-between">
                              <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                <i class="mdi mdi-cart-outline font-size-20"></i>
                              </div>
                              <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New order</a>
                                <p >Ryan has placed an new order</p>
                              </div>
                              <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                            </div>

                            <div class="media py-3 align-items-center justify-content-between">
                              <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
                                <i class="mdi mdi-calendar-blank font-size-20"></i>
                              </div>
                              <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="">Comapny Meetup</a>
                                <p >Phileine has placed an new order</p>
                              </div>
                              <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                            </div>

                            <div class="media py-3 align-items-center justify-content-between">
                              <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                <i class="mdi mdi-stack-exchange font-size-20"></i>
                              </div>
                              <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Support Ticket</a>
                                <p >Emma has placed an new order</p>
                              </div>
                              <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                            </div>

                            <div class="media py-3 align-items-center justify-content-between">
                              <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                                <i class="mdi mdi-email-outline font-size-20"></i>
                              </div>
                              <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New Enquiry</a>
                                <p >Phileine has placed an new order</p>
                              </div>
                              <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 9 AM</span>
                            </div>

                          </div>
                          <div class="mt-3"></div>
                        </div>

			</div>
		</div>

		<div class="row">
			<div class="col-12">
				
                  <!-- Recent Order Table -->
                  <div class="card card-table-border-none recent-orders" id="recent-orders">
                    <div class="card-header justify-content-between">
                      <h2>Recent Orders</h2>
                      <div class="date-range-report ">
                        <span></span>
                      </div>
                    </div>
                    <div class="card-body pt-0 pb-5">
                      <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                        <thead>
                          <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th class="d-none d-lg-table-cell">Units</th>
                            <th class="d-none d-lg-table-cell">Order Date</th>
                            <th class="d-none d-lg-table-cell">Order Cost</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td >24541</td>
                            <td >
                              <a class="text-dark" href=""> Coach Swagger</a>
                            </td>
                            <td class="d-none d-lg-table-cell">1 Unit</td>
                            <td class="d-none d-lg-table-cell">Oct 20, 2018</td>
                            <td class="d-none d-lg-table-cell">$230</td>
                            <td >
                              <span class="badge badge-success">Completed</span>
                            </td>
                            <td class="text-right">
                              <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                  <li class="dropdown-item">
                                    <a href="#">View</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a href="#">Remove</a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td >24541</td>
                            <td >
                              <a class="text-dark" href=""> Toddler Shoes, Gucci Watch</a>
                            </td>
                            <td class="d-none d-lg-table-cell">2 Units</td>
                            <td class="d-none d-lg-table-cell">Nov 15, 2018</td>
                            <td class="d-none d-lg-table-cell">$550</td>
                            <td >
                              <span class="badge badge-warning">Delayed</span>
                            </td>
                            <td class="text-right">
                              <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order2">
                                  <li class="dropdown-item">
                                    <a href="#">View</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a href="#">Remove</a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td >24541</td>
                            <td >
                              <a class="text-dark" href=""> Hat Black Suits</a>
                            </td>
                            <td class="d-none d-lg-table-cell">1 Unit</td>
                            <td class="d-none d-lg-table-cell">Nov 18, 2018</td>
                            <td class="d-none d-lg-table-cell">$325</td>
                            <td >
                              <span class="badge badge-warning">On Hold</span>
                            </td>
                            <td class="text-right">
                              <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order3" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order3">
                                  <li class="dropdown-item">
                                    <a href="#">View</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a href="#">Remove</a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td >24541</td>
                            <td >
                              <a class="text-dark" href=""> Backpack Gents, Swimming Cap Slin</a>
                            </td>
                            <td class="d-none d-lg-table-cell">5 Units</td>
                            <td class="d-none d-lg-table-cell">Dec 13, 2018</td>
                            <td class="d-none d-lg-table-cell">$200</td>
                            <td >
                              <span class="badge badge-success">Completed</span>
                            </td>
                            <td class="text-right">
                              <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order4">
                                  <li class="dropdown-item">
                                    <a href="#">View</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a href="#">Remove</a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td >24541</td>
                            <td >
                              <a class="text-dark" href=""> Speed 500 Ignite</a>
                            </td>
                            <td class="d-none d-lg-table-cell">1 Unit</td>
                            <td class="d-none d-lg-table-cell">Dec 23, 2018</td>
                            <td class="d-none d-lg-table-cell">$150</td>
                            <td >
                              <span class="badge badge-danger">Cancelled</span>
                            </td>
                            <td class="text-right">
                              <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order5" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order5">
                                  <li class="dropdown-item">
                                    <a href="#">View</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a href="#">Remove</a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

			</div>
		</div>

		<div class="row">
			<div class="col-xl-6">
				
                  <!-- To Do list -->
                  <div class="card card-default todo-table" id="todo">
                    <div class="card-header d-block pb-0 ">
                      <div class="todo-single-item mb-0" id="todo-input">
                        <form class="todo-form">
                          <div class="input-group mb-0">
                            <input type="text" class="form-control border-right-0" placeholder="Add Todo" required="" autofocus>
                            <div class="input-group-append ml-0">
                              <button class="input-group-text border-0 btn bg-primary" type="submit">
                                <?xml version="1.0"?>
                                <svg xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 0 448 448" width="18" class="">
                                  <g><path d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFFFFF"/>
                                  </g>
                                </svg>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>

                    <div class="card-body compact-to-do-list" data-simplebar style="height: 450px;">
                      <div class="todo-list" id="todo-list" >
                        <div id="item" class="todo-single-item todo-item d-flex flex-row justify-content-between finished alert alert-dismissible fade show" role="alert">
                          <i class="mdi"></i>
                          <span>Finish Dashboard UI Kit update</span>

                          <div class="task-content">
                            <span data-dismiss="alert" aria-label="Close">
                              <svg class="remove-task" id="Capa_1" enable-background="new 0 0 515.556 515.556" height="16" viewBox="0 0 515.556 515.556" width="16" xmlns="http://www.w3.org/2000/svg"><path class="" d="m64.444 451.111c0 35.526 28.902 64.444 64.444 64.444h257.778c35.542 0 64.444-28.918 64.444-64.444v-322.222h-386.666z"/><path d="m322.222 32.222v-32.222h-128.889v32.222h-161.111v64.444h451.111v-64.444z"/></svg>
                            </span>
                          </div>
                        </div>

                        <div class="todo-single-item d-flex flex-row justify-content-between current alert alert-dismissible fade show" role="alert">
                          <i class="mdi"></i>
                          <span>Create new prototype for the landing page</span>

                          <div class="task-content">
                            <span data-dismiss="alert" aria-label="Close">
                              <svg class="remove-task" id="Capa_1" enable-background="new 0 0 515.556 515.556" height="16" viewBox="0 0 515.556 515.556" width="16" xmlns="http://www.w3.org/2000/svg"><path class="" d="m64.444 451.111c0 35.526 28.902 64.444 64.444 64.444h257.778c35.542 0 64.444-28.918 64.444-64.444v-322.222h-386.666z"/><path d="m322.222 32.222v-32.222h-128.889v32.222h-161.111v64.444h451.111v-64.444z"/></svg>
                            </span>
                          </div>
                        </div>

                        <div class="todo-single-item d-flex flex-row justify-content-between alert alert-dismissible fade show" role="alert">
                          <i class="mdi"></i>
                          <span>Add new Google Analytics code to all main files sed auctor lacus in sem interdum, ac gravida tortor elementum. Cras magna enim.</span>

                          <div class="task-content">
                            <span data-dismiss="alert" aria-label="Close">
                              <svg class="remove-task" id="Capa_1" enable-background="new 0 0 515.556 515.556" height="16" viewBox="0 0 515.556 515.556" width="16" xmlns="http://www.w3.org/2000/svg"><path class="" d="m64.444 451.111c0 35.526 28.902 64.444 64.444 64.444h257.778c35.542 0 64.444-28.918 64.444-64.444v-322.222h-386.666z"/><path d="m322.222 32.222v-32.222h-128.889v32.222h-161.111v64.444h451.111v-64.444z"/></svg>
                            </span>
                          </div>
                        </div>

                        <div class="todo-single-item d-flex flex-row justify-content-between alert alert-dismissible fade show" role="alert">
                          <i class="mdi"></i>
                          <span>Update parallax scroll on team page</span>

                          <div class="task-content">
                            <span data-dismiss="alert" aria-label="Close">
                              <svg class="remove-task" id="Capa_1" enable-background="new 0 0 515.556 515.556" height="16" viewBox="0 0 515.556 515.556" width="16" xmlns="http://www.w3.org/2000/svg"><path class="" d="m64.444 451.111c0 35.526 28.902 64.444 64.444 64.444h257.778c35.542 0 64.444-28.918 64.444-64.444v-322.222h-386.666z"/><path d="m322.222 32.222v-32.222h-128.889v32.222h-161.111v64.444h451.111v-64.444z"/></svg>
                            </span>
                          </div>
                        </div>

                        <div class="todo-single-item d-flex flex-row justify-content-between alert alert-dismissible fade show" role="alert">
                          <i class="mdi"></i>
                          <span>Integer et porta odio, pulvinar pretium eros. Curabitur vel tellus erat.</span>

                          <div class="task-content">
                            <span data-dismiss="alert" aria-label="Close">
                              <svg class="remove-task" id="Capa_1" enable-background="new 0 0 515.556 515.556" height="16" viewBox="0 0 515.556 515.556" width="16" xmlns="http://www.w3.org/2000/svg"><path class="" d="m64.444 451.111c0 35.526 28.902 64.444 64.444 64.444h257.778c35.542 0 64.444-28.918 64.444-64.444v-322.222h-386.666z"/><path d="m322.222 32.222v-32.222h-128.889v32.222h-161.111v64.444h451.111v-64.444z"/></svg>
                            </span>
                          </div>
                        </div>

                        <div class="todo-single-item d-flex flex-row justify-content-between alert alert-dismissible fade show" role="alert">
                          <i class="mdi"></i>
                          <span>Pellentesque blandit ut eros sed vehicula.</span>

                          <div class="task-content">
                            <span data-dismiss="alert" aria-label="Close">
                              <svg class="remove-task" id="Capa_1" enable-background="new 0 0 515.556 515.556" height="16" viewBox="0 0 515.556 515.556" width="16" xmlns="http://www.w3.org/2000/svg"><path class="" d="m64.444 451.111c0 35.526 28.902 64.444 64.444 64.444h257.778c35.542 0 64.444-28.918 64.444-64.444v-322.222h-386.666z"/><path d="m322.222 32.222v-32.222h-128.889v32.222h-161.111v64.444h451.111v-64.444z"/></svg>
                            </span>
                          </div>
                        </div>

                        <div class="todo-single-item d-flex flex-row justify-content-between alert alert-dismissible fade show" role="alert">
                          <i class="mdi"></i>
                          <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec felis ligula, fringilla in volutpat sit amet, viverra nec mi. Donec at dui dolor.</span>

                          <div class="task-content">
                            <span data-dismiss="alert" aria-label="Close">
                              <svg class="remove-task" id="Capa_1" enable-background="new 0 0 515.556 515.556" height="16" viewBox="0 0 515.556 515.556" width="16" xmlns="http://www.w3.org/2000/svg"><path class="" d="m64.444 451.111c0 35.526 28.902 64.444 64.444 64.444h257.778c35.542 0 64.444-28.918 64.444-64.444v-322.222h-386.666z"/><path d="m322.222 32.222v-32.222h-128.889v32.222h-161.111v64.444h451.111v-64.444z"/></svg>
                            </span>
                          </div>
                        </div>

                        <div class="todo-single-item d-flex flex-row justify-content-between mb-1 alert alert-dismissible fade show" role="alert">
                          <i class="mdi"></i>
                          <span>Update parallax scroll on team page</span>

                          <div class="task-content">
                            <span data-dismiss="alert" aria-label="Close">
                              <svg class="remove-task" id="Capa_1" enable-background="new 0 0 515.556 515.556" height="16" viewBox="0 0 515.556 515.556" width="16" xmlns="http://www.w3.org/2000/svg"><path class="" d="m64.444 451.111c0 35.526 28.902 64.444 64.444 64.444h257.778c35.542 0 64.444-28.918 64.444-64.444v-322.222h-386.666z"/><path d="m322.222 32.222v-32.222h-128.889v32.222h-161.111v64.444h451.111v-64.444z"/></svg>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mt-3"></div>
                  </div>

			</div>

			<div class="col-xl-6">
				
                  <!-- area chart -->
                  <div class="card card-default" >
                    <div class="card-header d-block d-md-flex justify-content-between">
                      <h2>World Wide Customer </h2>
                      <div class="dropdown show d-inline-block widget-dropdown ml-auto">
                        <a class="dropdown-toggle" href="#" role="button" id="world-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                          World Wide
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="world-dropdown">
                          <li class="dropdown-item"><a href="#">Continetal chart</a></li>
                          <li class="dropdown-item"><a href="#">Sub-continental</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="card-body vector-map-world">
                      <div id="world" style="height: 100%; width: 100%;"></div>
                    </div>
                    <div class="card-footer d-flex flex-wrap bg-white p-0">
                      <div class="col-6">
                        <div class="p-4">
                          <ul class="d-flex flex-column justify-content-between">
                            <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #29cc97"></i>America <span class="float-right">5k</span></li>
                            <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #4c84ff "></i>Australia <span class="float-right">3k</span></li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="p-4 border-left">
                          <ul class="d-flex flex-column justify-content-between">
                            <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #ffa128"></i>Europe <span class="float-right">4k</span></li>
                            <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #fe5461"></i>Africa <span class="float-right">2k</span></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

			</div>
		</div>

		<div class="row">
			<div class="col-xl-5">
				
                  <!-- New Customers -->
                  <div class="card card-table-border-none">
                    <div class="card-header justify-content-between ">
                      <h2>New Customers</h2>
                      <div>
                          <button class="text-black-50 mr-2 font-size-20">
                            <i class="mdi mdi-cached"></i>
                          </button>
                          <div class="dropdown show d-inline-block widget-dropdown">
                              <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-customar"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                              </a>
                              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-customar">
                                <li class="dropdown-item"><a  href="#">Action</a></li>
                                <li class="dropdown-item"><a  href="#">Another action</a></li>
                                <li class="dropdown-item"><a  href="#">Something else here</a></li>
                              </ul>
                            </div>
                      </div>
                    </div>
                    <div class="card-body pt-0" data-simplebar style="height: 468px;">
                      <table class="table ">
                        <tbody>
                          <tr>
                            <td >
                              <div class="media">
                                <div class="media-image mr-3 rounded-circle">
                                  <a href="profile.html"><img class="rounded-circle w-45" src="assets/img/user/u1.jpg" alt="customer image"></a>
                                </div>
                                <div class="media-body align-self-center">
                                  <a href="profile.html"><h6 class="mt-0 text-dark font-weight-medium">Selena Wagner</h6></a>
                                  <small>@selena.oi</small>
                                </div>
                              </div>
                            </td>
                            <td >2 Orders</td>
                            <td class="text-dark d-none d-md-block">$150</td>
                          </tr>
                          <tr>
                            <td >
                              <div class="media">
                                <div class="media-image mr-3 rounded-circle">
                                  <a href="profile.html"><img class="rounded-circle w-45" src="assets/img/user/u2.jpg" alt="customer image"></a>
                                </div>
                                <div class="media-body align-self-center">
                                  <a href="profile.html"><h6 class="mt-0 text-dark font-weight-medium">Walter Reuter</h6></a>
                                  <small>@walter.me</small>
                                </div>
                              </div>
                            </td>
                            <td >5 Orders</td>
                            <td class="text-dark d-none d-md-block">$200</td>
                          </tr>
                          <tr>
                            <td >
                              <div class="media">
                                <div class="media-image mr-3 rounded-circle">
                                  <a href="profile.html"><img class="rounded-circle w-45" src="assets/img/user/u3.jpg" alt="customer image"></a>
                                </div>
                                <div class="media-body align-self-center">
                                  <a href="profile.html"><h6 class="mt-0 text-dark font-weight-medium">Larissa Gebhardt</h6></a>
                                  <small>@larissa.gb</small>
                                </div>
                              </div>
                            </td>
                            <td >1 Order</td>
                            <td class="text-dark d-none d-md-block">$50</td>
                          </tr>
                          <tr>
                            <td >
                              <div class="media">
                                <div class="media-image mr-3 rounded-circle">
                                  <a href="profile.html"><img class="rounded-circle w-45" src="assets/img/user/u4.jpg" alt="customer image"></a>
                                </div>
                                <div class="media-body align-self-center">
                                  <a href="profile.html"><h6 class="mt-0 text-dark font-weight-medium">Albrecht Straub</h6></a>
                                  <small>@albrech.as</small>
                                </div>
                              </div>
                            </td>
                            <td >2 Orders</td>
                            <td class="text-dark d-none d-md-block">$100</td>
                          </tr>
                          <tr>
                            <td >
                              <div class="media">
                                <div class="media-image mr-3 rounded-circle">
                                  <a href="profile.html"><img class="rounded-circle w-45" src="assets/img/user/u5.jpg" alt="customer image"></a>
                                </div>
                                <div class="media-body align-self-center">
                                  <a href="profile.html"><h6 class="mt-0 text-dark font-weight-medium">Leopold Ebert</h6></a>
                                  <small>@leopold.et</small>
                                </div>
                              </div>
                            </td>
                            <td >1 Order</td>
                            <td class="text-dark d-none d-md-block">$60</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

			</div>

			<div class="col-xl-7">
				
                  <!-- Top Products -->
                  <div class="card card-default">
                    <div class="card-header justify-content-between mb-4">
                      <h2>Top Products</h2>
                      <div>
                          <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-cached"></i></button>
                          <div class="dropdown show d-inline-block widget-dropdown">
                              <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-product" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                              </a>
                              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-product">
                                <li class="dropdown-item"><a  href="#">Update Data</a></li>
                                <li class="dropdown-item"><a  href="#">Detailed Log</a></li>
                                <li class="dropdown-item"><a  href="#">Statistics</a></li>
                                <li class="dropdown-item"><a  href="#">Clear Data</a></li>
                              </ul>
                            </div>
                      </div>

                    </div>
                    <div class="card-body py-0">
                      <div class="media d-flex mb-5">
                        <div class="media-image align-self-center mr-3 rounded">
                          <a href="#"><img src="assets/img/products/p1.jpg" alt="customer image"></a>
                        </div>
                        <div class="media-body align-self-center">
                          <a href="#"><h6 class="mb-3 text-dark font-weight-medium"> Coach Swagger</h6></a>
                          <p class="float-md-right"><span class="text-dark mr-2">20</span>Sales</p>
                          <p class="d-none d-md-block">Statement belting with double-turnlock hardware adds “swagger” to a simple.</p>
                          <p class="mb-0">
                            <del>$300</del>
                            <span class="text-dark ml-3">$250</span>
                          </p>
                        </div>
                      </div>

                      <div class="media d-flex mb-5">
                        <div class="media-image align-self-center mr-3 rounded">
                          <a href="#"><img src="assets/img/products/p2.jpg" alt="customer image"></a>
                        </div>
                        <div class="media-body align-self-center">
                          <a href="#"><h6 class="mb-3 text-dark font-weight-medium"> Coach Swagger</h6></a>
                          <p class="float-md-right"><span class="text-dark mr-2">20</span>Sales</p>
                          <p class="d-none d-md-block">Statement belting with double-turnlock hardware adds “swagger” to a simple.</p>
                          <p class="mb-0">
                            <del>$300</del>
                            <span class="text-dark ml-3">$250</span>
                          </p>
                        </div>
                      </div>

                      <div class="media d-flex mb-5">
                        <div class="media-image align-self-center mr-3 rounded">
                          <a href="#"><img src="assets/img/products/p3.jpg" alt="customer image"></a>
                        </div>
                        <div class="media-body align-self-center">
                          <a href="#"><h6 class="mb-3 text-dark font-weight-medium"> Gucci Watch</h6></a>
                          <p class="float-md-right"><span class="text-dark mr-2">10</span>Sales</p>
                          <p class="d-none d-md-block">Statement belting with double-turnlock hardware adds “swagger” to a simple.</p>
                          <p class="mb-0">
                            <del>$300</del>
                            <span class="text-dark ml-3">$50</span>
                          </p>
                        </div>
                      </div>
                      </div>
                  </div>

			</div>
		</div>





      </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
    
    
    <!-- Footer -->
    <footer class="footer mt-auto">
      <div class="copyright bg-white">
        <p>
          Copyright &copy; <span id="copy-year"></span> a template by <a class="text-primary" href="https://themefisher.com" target="_blank">Themefisher</a>.
        </p>
      </div>
      <script>
        var d = new Date();
        var year = d.getFullYear();
        document.getElementById("copy-year").innerHTML = year;
      </script>
    </footer>

    </div> <!-- End Page Wrapper -->
  </div> <!-- End Wrapper -->

    <!-- Javascript -->
    <script src="{{ asset('asset/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('asset/plugins/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('asset/plugins/charts/Chart.min.js')}}"></script>
    <script src="{{ asset('asset/js/chart.js')}}"></script>
    <script src="{{ asset('asset/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script src="{{ asset('asset/plugins/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
    <script src="{{ asset('asset/js/vector-map.js')}}"></script>
    <script src="{{ asset('asset/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{ asset('asset/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ asset('asset/js/date-range.js')}}"></script>
    <script src="{{ asset('asset/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('asset/js/sleek.js')}}"></script>
  <link href="{{ asset('asset/options/optionswitch.css')}}" rel="stylesheet">
<script src="{{ asset('asset/options/optionswitcher.js')}}"></script>
</body>
</html>


@endsection
