<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Customer Reviews">
    <meta name="author" content="Craaser">
    <meta name="keywords" content="customer review">

    <!-- Title Page-->
    <title>Dashboard | Society Manager</title>

    <!-- Fontfaces CSS-->
    <link href="{{ URL::asset('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ URL::asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ URL::asset('css/theme.css') }}" rel="stylesheet" media="all">
    <script src="{{ URL::asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.js" integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA=" crossorigin="anonymous"></script>

    @yield('head')

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <strong><b>Society Manager</b></strong>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <!-- Add More Side Bar Menus to Mobile-->
                        @if (Route::currentRouteName() == 'get-meetings')
                        <li class="active has-sub">
                        @else
                        <li class="has-sub">
                        @endif
                        <a class="js-arrow" href="#">
                            <i class="fas fa-tachometer-alt"></i>Meetings</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{ route('get-meetings') }}">All Meetings</a>
                                </li>
                                <li>
                                    <a href="#">Reports</a>
                                </li>
                                <li>
                                    <a href="{{ route('get-society-matters') }}">Matters</a>
                                </li>
                                <li>
                                    <a href="#">Tasks</a>
                                </li>
                            </ul>
                        </li>
                        @if (Route::currentRouteName() == 'members')
                        <li class="active has-sub">
                        @else
                        <li class="has-sub">
                        @endif
                        <a class="js-arrow" href="#">
                                <i class="fas fa-address-book"></i>Members</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{ route('members') }}">All Members</a>
                                </li>
                                <li>
                                    <a href="#">Commitees</a>
                                </li>
                                <li>
                                    <a href="{{ route('executives') }}">Executivies</a>
                                </li>
                                <li>
                                    <a href="{{ route('roles') }}">Roles</a>
                                </li>
                            </ul>
                        </li>
                        @if (Route::currentRouteName() == 'get-collected-dues')
                        <li class="active has-sub">
                        @else
                        <li class="has-sub">
                        @endif
                        <a class="js-arrow" href="#">
                                <i class="fas fa-money-bill-alt"></i>Finance</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                                    <a href="{{ route('get-collected-dues') }}">Dues</a>
                                </li>
                                <li>
                                    <a href="#">Levies</a>
                                </li>
                                <li>
                                    <a href="#">Donations</a>
                                </li>
                                <li>
                                    <a href="#">Expenses</a>
                                </li>
                            </ul>
                        </li>
                        @if (Route::currentRouteName() == 'upcoming-events')
                        <li class="active has-sub">
                        @else
                        <li class="has-sub">
                        @endif
                        <a class="js-arrow" href="#">
                                <i class="fas fa-calendar"></i>Events</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="#">Up-Coming Events</a>
                                </li>
                                <li>
                                    <a href="#">Event Reminders</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
            <strong><b>Society Manager</b></strong>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <!-- Add More Side Bar Menus to Desktop-->
                        @if (Route::currentRouteName() == 'get-meetings')
                        <li class="active has-sub">
                        @else
                        <li class="has-sub">
                        @endif
                        <a class="js-arrow" href="#">
                            <i class="fas fa-tachometer-alt"></i>Meetings</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                    <a href="{{ route('get-meetings') }}">All Meetings</a>
                                </li>
                                <li>
                                    <a href="#">Reports</a>
                                </li>
                                <li>
                                    <a href="{{ route('get-society-matters') }}">Matters</a>
                                </li>
                                <li>
                                    <a href="#">Tasks</a>
                                </li>
                            </ul>
                        </li>
                        @if (Route::currentRouteName() == 'members')
                        <li class="active has-sub">
                        @else
                        <li class="has-sub">
                        @endif
                        <a class="js-arrow" href="#">
                                <i class="fas fa-address-book"></i>Members</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{ route('members') }}">All Members</a>
                                </li>
                                <li>
                                    <a href="#">Commitees</a>
                                </li>
                                <li>
                                    <a href="{{ route('executives') }}">Executivies</a>
                                </li>
                                <li>
                                    <a href="{{ route('roles') }}">Roles</a>
                                </li>
                            </ul>
                        </li>
                        @if (Route::currentRouteName() == 'get-collected-dues')
                        <li class="active has-sub">
                        @else
                        <li class="has-sub">
                        @endif
                        <a class="js-arrow" href="#">
                                <i class="fas fa-money-bill-alt"></i>Finance</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{ route('get-collected-dues') }}">Dues</a>
                                </li>
                                <li>
                                    <a href="#">Levies</a>
                                </li>
                                <li>
                                    <a href="#">Donations</a>
                                </li>
                                <li>
                                    <a href="#">Expenses</a>
                                </li>
                            </ul>
                        </li>
                        @if (Route::currentRouteName() == 'upcoming-events')
                        <li class="active has-sub">
                        @else
                        <li class="has-sub">
                        @endif
                        <a class="js-arrow" href="#">
                                <i class="fas fa-calendar"></i>Events</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="#">Up-Coming Events</a>
                                </li>
                                <li>
                                    <a href="#">Event Reminders</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="#" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search ..." />
                                <button class="au-btn--submit" type="button">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <span class=""></span>
                                        <div class="">
                                            
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <span class=""></span>
                                        <div class="">
                                         
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">0</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 0 Messages</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="{{ URL::asset('images/icon/profile.png') }}" alt="{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{ URL::asset('images/icon/profile.png') }}" alt="{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</a>
                                                    </h5>
                                                    <span class="email">{{ $generalData['name'] }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('single-member', ['member' => Auth::user()->id])}}">
                                                        <i class="zmdi zmdi-account"></i>Profile</a>
                                                </div>
                                                <!-- <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-bill-alt-box"></i>Billing</a>
                                                </div> -->
                                            </div>
                                            <div class="account-dropdown__footer">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                <i class="zmdi zmdi-power"></i>{{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
            @if(session()->has('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {!!session()->get('message')!!}
                </div>
            @endif
            @if($errors->any())
            @foreach($errors->all() as $message)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {!! $message !!}
                </div>
            @endforeach
            @endif

            @yield('content')
                
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ URL::asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ URL::asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ URL::asset('vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ URL::asset('vendor/wow/wow.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ URL::asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ URL::asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ URL::asset('js/main.js') }}"></script>

@yield('javascript')
</body>

</html>
<!-- end document-->
