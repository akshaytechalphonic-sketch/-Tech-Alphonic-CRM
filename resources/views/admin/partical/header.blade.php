<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <!-- DataTables Buttons CSS -->
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css" rel="stylesheet" />
    <!-- DataTables Buttons CSS -->
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/responsive.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <section class="dashboard-main">
        <div class="header d-flex justify-content-between">
            <div class="d-flex align-items-center gap-4">
                <div class="desktop-toggle">
                    <div class="toggle1">
                        <img src="{{ asset('public/admin/assets/images/icons/arrow.png') }}" alt="" />
                    </div>
                    <div class="toggle2">
                        <img src="{{ asset('public/admin/assets/images/icons/arrow.png') }}" alt="" />
                    </div>
                </div>
                <div class="mob-toggle">
                    <div class="toggle-btn">
                        <img width="32" height="30"
                            src="https://img.icons8.com/external-creatype-glyph-colourcreatype/36/external-hamburger-basic-creatype-glyph-colourcreatype-5.png"
                            alt="external-hamburger-basic-creatype-glyph-colourcreatype-5" />
                    </div>
                </div>
                <div class="welcome-admin">
                    <h3 class="fs-5 fw-4 mb-0 d-lg-block d-none">Welcome, Admin</h3>
                </div>
            </div>
            <div class="header-right d-flex align-items-center gap-4">
                <!--<div class="search-bar">-->
                <!--    <img src="{{ asset('public/admin/assets/images/icons/search-icon.png') }}" alt="" />-->
                <!--    <input type="text" placeholder="Search..." />-->
                <!--</div>-->
                <!--<a href="notification.php">-->
                <!--    <div class="notification position-relative">-->
                <!--        <img src="{{ asset('public/admin/assets/images/icons/notification-icon.png') }}"-->
                <!--            alt="" />-->
                <!--        <div class="notification-indication">6</div>-->
                <!--    </div>-->
                <!--</a>-->
                <div class="profile d-flex align-items-center gap-2">
                    <div class="profile-img">
                        <img src="{{ asset('public/admin/assets/images/user.png') }}" alt="" />
                    </div>
                    <div class="user-info">
                        <h4 class="title">{{ Auth::guard('admin')->user()->name }}</h4>
                        <h5 class="user-name">{{ Auth::guard('admin')->user()->email }}</h5>
                    </div>
                    <div class="logout-dropdown">
                        <a href="{{ route('admin.logout') }}">Logout <i class="fa fa-sign-out"
                                aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mob-menu-layer"></div>
        <div class="sidebar sidebar-mob">
            <div class="logo">
                <img class="full-logo" src="{{ asset('public/admin/assets/images/tech-logo.svg') }}" alt="" />
                <img class="half-logo" src="{{ asset('public/admin/assets/images/favicon.png') }}" alt="" />
                <div class="close-mob-menu">
                    <img width="30" height="30" src="https://img.icons8.com/ios/30/close-window.png"
                        alt="close-window" />
                </div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-list">
                    <ul>
                        <li class="menu-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><img
                                    src="{{ asset('public/admin/assets/images/icons/icon1.png') }}" alt="" />
                                <span class="item-name">My Dashboard</span></a>
                        </li>

                        <li class="menu-item menu-dropdown">
                            <a href="javascript:void(0)"><img
                                    src="{{ asset('public/admin/assets/images/icons/icon2.png') }}" alt="" />
                                <span class="item-name">My Office</span><img class="dropdown-icon"
                                    src="{{ asset('public/admin/assets/images/icons/arrow-right.png') }}"
                                    alt="" /></a>
                            <div class="dropdown-menu-sidebar"
                                style="display: {{ Request::is('admin/office*') ||
                                Request::is('admin/office-leads*') ||
                                Request::is('admin/leads-integration*') ||
                                Request::is('admin/projects*') ||
                                Request::is('admin/task-management*') ||
                                Request::is('admin/Ip-address*')
                                    ? 'block'
                                    : 'none' }};">
                                <ul>
                                    <li class="dropdown-item-sidebar">
                                        <a href="{{ route('admin.office.index') }}"
                                            class="{{ Request::is('admin/office') ? 'active' : '' }}">
                                            <img src="{{ asset('public/admin/assets/images/icons/users.png') }}"
                                                alt="">
                                            <span class="item-name">Create Employee</span>
                                        </a>
                                    </li>
                                     <li class="dropdown-item-sidebar">
                                        <a href="{{ route('admin.leads.uploaded_excels') }}"
                                            class="{{ Request::is('admin/uploaded-excels') ? 'active' : '' }}">
                                            <img src="{{ asset('public/admin/assets/images/icons/date-time.png') }}"
                                                alt="">
                                            <span class="item-name">Uploaded-excels</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="{{ route('admin.leads.index') }}"
                                            class="{{ Request::is('admin/office-leads') ? 'active' : '' }}">
                                            <img src="{{ asset('public/admin/assets/images/icons/date-time.png') }}"
                                                alt="">
                                            <span class="item-name">Leads</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="{{route('admin.office.meetings')}}"
                                            class="{{ Request::is('office/meetings*') ? 'active' : '' }}">
                                            <img src="{{ asset('public/admin/assets/images/icons/date-time.png')}}"
                                                alt="">
                                            <span class="item-name">Meetings</span>
                                        </a>
                                    </li>

                                    <li class="dropdown-item-sidebar">
                                        <a href="{{ route('admin.leads_integration.index') }}"
                                            class="{{ Request::is('admin/leads-integration*') ? 'active' : '' }}">
                                            <img src="{{ asset('public/admin/assets/images/icons/date-time.png') }}"
                                                alt="">
                                            <span class="item-name">Leads Integration</span>
                                        </a>
                                    </li>

                                    <li class="dropdown-item-sidebar">
                                        <a href="{{ route('admin.ip.index') }}"
                                            class="{{ Request::is('admin/Ip-address*') ? 'active' : '' }}">
                                            <img src="{{ asset('public/admin/assets/images/icons/salary.png') }}"
                                                alt="">
                                            <span class="item-name">IP Address</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="{{ route('admin.projects.index') }}"
                                            class="{{ Request::is('admin/projects*') ? 'active' : '' }}">
                                            <img src="{{ asset('public/admin/assets/images/icons/salary.png') }}"
                                                alt="">
                                            <span class="item-name">Project Management</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="{{ route('admin.task_management.index') }}"
                                            class="{{ Request::is('admin/office-task-management*') ? 'active' : '' }}">
                                            <img src="{{ asset('public/admin/assets/images/icons/salary.png') }}"
                                                alt="">
                                            <span class="item-name">Task Management</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </li>


                        <li class="menu-item menu-dropdown d-none">
                            <a href="#!"
                                class="{{ request()->routeIs('admin.client.*', 'admin.employee.*') ? 'active' : '' }}"><img
                                    src="{{ asset('public/admin/assets/images/icons/icon2.png') }}" alt="" />
                                <span class="item-name">My Client</span><img class="dropdown-icon"
                                    src="{{ asset('public/admin/assets/images/icons/arrow-right.png') }}"
                                    alt="" /></a>
                            <div class="dropdown-menu-sidebar">
                                <ul>
                                    <li
                                        class="dropdown-item-sidebar {{ request()->routeIs('admin.client.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.client.index') }}"><img
                                                src="{{ asset('public/admin/assets/images/icons/users.png') }}"
                                                alt="" />
                                            <span class="item-name">Client</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="{{ route('admin.employee.index') }}"><img
                                                src="{{ asset('public/admin/assets/images/icons/person-board.png') }}"
                                                alt="" />
                                            <span class="item-name">Employee</span></a>
                                    </li>



                                    <li class="dropdown-item-sidebar">
                                        <a href="adminwages.php"><img
                                                src="{{ asset('public/admin/assets/images/icons/icon5.png') }}"
                                                alt="" />
                                            <span class="item-name">Edit Wages</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="#!"><img
                                                src="{{ asset('public/admin/assets/images/icons/date-time.png') }}"
                                                alt="" />
                                            <span class="item-name">Attendance</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="adminsalery.php"><img
                                                src="{{ asset('public/admin/assets/images/icons/salary.png') }}"
                                                alt="" />
                                            <span class="item-name">Salary</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="menu-item menu-dropdown d-none">
                            <a href="#!"><img src="{{ asset('public/admin/assets/images/icons/icon2.png') }}"
                                    alt="" />
                                <span class="item-name">Accounts</span><img class="dropdown-icon"
                                    src="{{ asset('public/admin/assets/images/icons/arrow-right.png') }}"
                                    alt="" /></a>
                            <div class="dropdown-menu-sidebar">
                                <ul>
                                    <li class="dropdown-item-sidebar">
                                        <a href="#!"><img
                                                src="{{ asset('public/admin/assets/images/icons/users.png') }}"
                                                alt="" />
                                            <span class="item-name">Client</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="{{ route('admin.employee.index') }}"><img
                                                src="{{ asset('public/admin/assets/images/icons/person-board.png') }}"
                                                alt="" />
                                            <span class="item-name">Employee</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="#!"><img
                                                src="{{ asset('public/admin/assets/images/icons/icon5.png') }}"
                                                alt="" />
                                            <span class="item-name">Edit Wages</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="#!"><img
                                                src="{{ asset('public/admin/assets/images/icons/date-time.png') }}"
                                                alt="" />
                                            <span class="item-name">Attendance</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="#!"><img
                                                src="{{ asset('public/admin/assets/images/icons/salary.png') }}"
                                                alt="" />
                                            <span class="item-name">Salary</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item menu-dropdown d-none">
                            <a href="#!"><img src="{{ asset('public/admin/assets/images/icons/icon2.png') }}"
                                    alt="" />
                                <span class="item-name">Bid Management</span><img class="dropdown-icon"
                                    src="{{ asset('public/admin/assets/images/icons/arrow-right.png') }}"
                                    alt="" /></a>
                            <div class="dropdown-menu-sidebar">
                                <ul>
                                    <li class="dropdown-item-sidebar">
                                        <a href="#!"><img
                                                src="{{ asset('public/admin/assets/images/icons/users.png') }}"
                                                alt="" />
                                            <span class="item-name">Client</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="#!"><img
                                                src="{{ asset('public/admin/assets/images/icons/person-board.png') }}"
                                                alt="" />
                                            <span class="item-name">Employee</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="#!"><img
                                                src="{{ asset('public/admin/assets/images/icons/icon5.png') }}"
                                                alt="" />
                                            <span class="item-name">Edit Wages</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="#!"><img
                                                src="{{ asset('public/admin/assets/images/icons/date-time.png') }}"
                                                alt="" />
                                            <span class="item-name">Attendance</span></a>
                                    </li>
                                    <li class="dropdown-item-sidebar">
                                        <a href="saler#!hp"><img
                                                src="{{ asset('public/admin/assets/images/icons/salary.png') }}"
                                                alt="" />
                                            <span class="item-name">Salary</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
