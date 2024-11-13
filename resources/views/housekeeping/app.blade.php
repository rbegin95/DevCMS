<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap 5.3.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/img/favicon-d.png') }}" type="image/vnd.microsoft.icon"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS Styles -->
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            background-color: #343a40;
            color: white;
        }

        .content {
            margin-left: 280px;
            padding: 20px;
        }

        .sidebar a {
            color: white;
        }

        .sidebar a:hover {
            color: #adb5bd;
        }

        /* Collapsible menu styles with transition */
        #hotelSubMenu, #websiteSubMenu, #adminSubMenu {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.0s ease, visibility 0.0s ease;
        }

        #hotelSubMenu.show, #websiteSubMenu.show, #adminSubMenu.show {
            opacity: 1;
            visibility: visible;
        }

        .collapse.nav {
            transition: all 0.0s ease;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none"></a>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://imager.habboon.pw/?figure={{ Auth::guard('housekeeping')->user()->look ?? '' }}&size=m&direction=4&head_direction=4&gesture=sml&headonly=1" alt="mdo" width="50" height="50" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('housekeeping-logout-form').submit();">
                                Sign out
                            </a>
                        </li>
                    </ul>
                    <form id="housekeeping-logout-form" action="{{ route('housekeeping.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar p-3">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
            <span class="fs-4">Housekeeping</span>
        </a>
        <br />

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('housekeeping.dashboard') }}" class="nav-link {{ request()->routeIs('housekeeping.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
    
            <!-- Hotel Collapsible Menu -->
            <li class="nav-item">
                <a href="#hotelSubMenu" class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="false">
                    <span>
                        <i class="bi bi-server me-2"></i> Hotel
                    </span>
                    <i class="bi bi-caret-right" id="hotelCaret"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="hotelSubMenu">
                    
                    <li class="nav-item">
                        <a href="{{ route('housekeeping.hotel.badges') }}" class="nav-link {{ request()->routeIs('housekeeping.hotel.badges') ? 'active' : '' }}">
                            Badges
                        </a>
                    </li>
                    <li>

                    <li class="nav-item">
                        <a href="{{ route('housekeeping.users.bannedusers') }}" class="nav-link {{ request()->routeIs('housekeeping.users.bannedusers') ? 'active' : '' }}">
                            Bans
                        </a>
                    </li>
                    <li>

                    <li class="nav-item">
                        <a href="{{ route('housekeeping.users.index') }}" class="nav-link {{ request()->routeIs('housekeeping.users.index') ? 'active' : '' }}">
                            Users
                        </a>
                    </li>
                    <li>
                <a href="{{ route('housekeeping.hotel.roomchatlogs') }}" class="nav-link {{ request()->routeIs('housekeeping.hotel.roomchatlogs') ? 'active' : '' }}">
                     Room Chatlogs
                </a>
            </li>
            <li>
                <a href="{{ route('housekeeping.hotel.privatechatlogs') }}" class="nav-link {{ request()->routeIs('housekeeping.hotel.privatechatlogs') ? 'active' : '' }}">
                     Private Chatlogs
                </a>
            </li>
                     <li>
                <a href="{{ route('housekeeping.hotel.alert') }}" class="nav-link {{ request()->routeIs('housekeeping.hotel.alert') ? 'active' : '' }}">
                     Hotel Alert
                </a>
            </li>
             <li>
                <a href="{{ route('housekeeping.hotel.wordfilter') }}" class="nav-link {{ request()->routeIs('housekeeping.hotel.wordfilter') ? 'active' : '' }}">
                     Word Filters
                </a>
            </li>
                </ul>
            </li>

            <!-- Website Collapsible Menu -->
            <li class="nav-item">
                <a href="#websiteSubMenu" class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="false">
                    <span>
                        <i class="bi bi-globe me-2"></i> Website
                    </span>
                    <i class="bi bi-caret-right" id="websiteCaret"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="websiteSubMenu">
                    <li class="nav-item">
                        <a href="{{ route('housekeeping.support.siteticket') }}" class="nav-link {{ request()->routeIs('housekeeping.support.siteticket') ? 'active' : '' }}">
                            Website Tickets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('housekeeping.articles.create') }}" class="nav-link {{ request()->routeIs('housekeeping.articles.create') ? 'active' : '' }}">
                            Website Article
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('housekeeping.camera.cameraweb') }}" class="nav-link {{ request()->routeIs('housekeeping.camera.cameraweb') ? 'active' : '' }}">
                           Camera Web
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Admin Section -->
            @if (Auth::check() && Auth::user()->rank >= 7)
            <li class="nav-item">
                <a href="#adminSubMenu" class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="false">
                    <span>
                        <i class="bi bi-person-badge"></i> Admin
                    </span>
                    <i class="bi bi-caret-right" id="adminCaret"></i>
                </a>
                <ul class="collapse nav flex-column ms-3" id="adminSubMenu">
                    <li class="nav-item">
                        <a href="{{ route('housekeeping.admin.activitylogs') }}" class="nav-link {{ request()->routeIs('housekeeping.admin.activitylogs') ? 'active' : '' }}">
                            Acitivity Logs
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('housekeeping.admin.sitesettings') }}" class="nav-link {{ request()->routeIs('housekeeping.admin.sitesettings') ? 'active' : '' }}">
                            Website Settings
                        </a>
                    </li>
                     <li>
                <a href="{{ route('housekeeping.admin.staffapps')}}" class="nav-link {{ request()->routeIs('housekeeping.admin.staffapps') ? 'active' : '' }}">
                            Staff Applications
                </a>
            </li>
                </ul>
            </li>
            @endif
    </div>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var hotelSubMenu = document.getElementById('hotelSubMenu');
            var hotelCaret = document.getElementById('hotelCaret');
    
            var websiteSubMenu = document.getElementById('websiteSubMenu');
            var websiteCaret = document.getElementById('websiteCaret');
    
            var adminSubMenu = document.getElementById('adminSubMenu');
            var adminCaret = document.getElementById('adminCaret');

            // Hotel Menu
            hotelSubMenu.addEventListener('show.bs.collapse', function () {
                hotelCaret.classList.remove('bi-caret-right');
                hotelCaret.classList.add('bi-caret-down');
            });

            hotelSubMenu.addEventListener('hide.bs.collapse', function () {
                hotelCaret.classList.remove('bi-caret-down');
                hotelCaret.classList.add('bi-caret-right');
            });

            // Website Menu
            websiteSubMenu.addEventListener('show.bs.collapse', function () {
                websiteCaret.classList.remove('bi-caret-right');
                websiteCaret.classList.add('bi-caret-down');
            });

            websiteSubMenu.addEventListener('hide.bs.collapse', function () {
                websiteCaret.classList.remove('bi-caret-down');
                websiteCaret.classList.add('bi-caret-right');
            });

            //Admin Menu

            adminSubMenu.addEventListener('show.bs.collapse', function () {
                adminCaret.classList.remove('bi-caret-right');
                adminCaret.classList.add('bi-caret-down');
            });

            adminSubMenu.addEventListener('hide.bs.collapse', function () {
                adminCaret.classList.remove('bi-caret-down');
                adminCaret.classList.add('bi-caret-right');
            });
        });
    </script>
</body>
</html>
