<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housekeeping</title>

    <!-- Bootstrap CSS (for styling, not collapse) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/img/favicon-d.png') }}" type="image/vnd.microsoft.icon"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <style>
    body {
        font-family: "Ubuntu", sans-serif;
    }

    /* Sidebar styling */
    .sidebar {
        height: 100vh;
        width: 280px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #343a40;
        color: white;
        padding: 20px;
        overflow-y: auto;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px;
        transition: background 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #495057;
    }

    .content {
        margin-left: 300px;
        padding: 20px;
    }

    /* Custom Submenu Toggle */
    .submenu {
        list-style: none;
        display: none;
        transition: all 0.3s ease-in-out;
        padding-left: 15px; /* General left padding for submenu */
    }

    .submenu.open {
        display: block;
    }

    /* Add right indentation to submenu items */
    .submenu li a {
        padding-left: 35px; /* Right indentation for better hierarchy */
        font-size: 0.9rem; /* Optional: Smaller font for submenu items */
    }

    /* Caret rotation */
    .toggle-caret {
        transition: transform 0.3s ease;
    }

    .rotate {
        transform: rotate(90deg);
    }
</style>
</head>
<body>
    <!-- Header -->
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
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ route('housekeeping.dashboard') }}" class="nav-link {{ request()->routeIs('housekeeping.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <!-- Hotel Menu -->
        <li class="nav-item">
            <a href="#" class="nav-link d-flex justify-content-between align-items-center toggle-link">
                <span><i class="bi bi-server me-2"></i> Hotel</span>
                <i class="bi bi-caret-right toggle-caret"></i>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('housekeeping.hotel.badges') }}" class="nav-link {{ request()->routeIs('housekeeping.hotel.badges') ? 'active' : '' }}">Badges</a></li>
                <li><a href="{{ route('housekeeping.users.bannedusers') }}" class="nav-link {{ request()->routeIs('housekeeping.users.bannedusers') ? 'active' : '' }}">Bans</a></li>
                <li><a href="{{ route('housekeeping.users.index') }}" class="nav-link {{ request()->routeIs('housekeeping.users.index') ? 'active' : '' }}">Users</a></li>
                <li><a href="{{ route('housekeeping.hotel.roomchatlogs') }}" class="nav-link {{ request()->routeIs('housekeeping.hotel.roomchatlogs') ? 'active' : '' }}">Room Chatlogs</a></li>
                <li><a href="{{ route('housekeeping.permissions.index') }}" class="nav-link {{ request()->routeIs('housekeeping.permissions.index') ? 'active' : '' }}">Permissions</a></li>
                <li><a href="{{ route('housekeeping.hotel.privatechatlogs') }}" class="nav-link {{ request()->routeIs('housekeeping.hotel.privatechatlogs') ? 'active' : '' }}">Private Chatlogs</a></li>
                <li><a href="{{ route('housekeeping.hotel.alert') }}" class="nav-link {{ request()->routeIs('housekeeping.hotel.alert') ? 'active' : '' }}">Hotel Alert</a></li>
                <li><a href="{{ route('housekeeping.hotel.wordfilter') }}" class="nav-link {{ request()->routeIs('housekeeping.hotel.wordfilter') ? 'active' : '' }}">Word Filters</a></li>
            </ul>
        </li>

        <!-- Website Menu -->
        <li class="nav-item">
            <a href="#" class="nav-link d-flex justify-content-between align-items-center toggle-link">
                <span><i class="bi bi-globe me-2"></i> Website</span>
                <i class="bi bi-caret-right toggle-caret"></i>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('housekeeping.support.siteticket') }}" class="nav-link {{ request()->routeIs('housekeeping.support.siteticket') ? 'active' : '' }}">Tickets</a></li>
                <li><a href="{{ route('housekeeping.articles.create') }}" class="nav-link {{ request()->routeIs('housekeeping.articles.create') ? 'active' : '' }}">Articles</a></li>
                <li><a href="{{ route('housekeeping.camera.cameraweb') }}" class="nav-link {{ request()->routeIs('housekeeping.camera.cameraweb') ? 'active' : '' }}">Camera Web</a></li>
            </ul>
        </li>

        <!-- Catalogue Menu -->
        <li class="nav-item">
            <a href="#" class="nav-link d-flex justify-content-between align-items-center toggle-link">
                <span><i class="bi bi-bag me-2"></i> Catalogue</span>
                <i class="bi bi-caret-right toggle-caret"></i>
            </a>
            <ul class="submenu">
                <li><a href="#" class="nav-link">Catalogue Pages</a></li>
                <li><a href="#" class="nav-link">Catalogue Items</a></li>
            </ul>
        </li>

        <!-- Admin Menu -->
        @if (Auth::check() && Auth::user()->rank >= 7)
        <li class="nav-item">
            <a href="#" class="nav-link d-flex justify-content-between align-items-center toggle-link">
                <span><i class="bi bi-person-badge"></i> Admin</span>
                <i class="bi bi-caret-right toggle-caret"></i>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('housekeeping.admin.activitylogs') }}" class="nav-link {{ request()->routeIs('housekeeping.admin.activitylogs') ? 'active' : '' }}">Activity Logs</a></li>
                <li><a href="{{ route('housekeeping.admin.sitesettings') }}" class="nav-link {{ request()->routeIs('housekeeping.admin.sitesettings') ? 'active' : '' }}">Website Settings</a></li>
                <li><a href="{{ route('housekeeping.admin.staffapps') }}" class="nav-link {{ request()->routeIs('housekeeping.admin.staffapps') ? 'active' : '' }}">Staff Applications</a></li>
                <li><a href="{{ route('housekeeping.admin.passwordrestore') }}" class="nav-link {{ request()->routeIs('housekeeping.admin.passwordrestore') ? 'active' : '' }}">Password Restore Tool</a></li>
            </ul>
        </li>
        @endif
    </ul>
</div>


    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggles = document.querySelectorAll('.toggle-link');

            toggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    const submenu = this.nextElementSibling;
                    const caret = this.querySelector('.toggle-caret');

                    // Toggle submenu visibility
                    submenu.classList.toggle('open');

                    // Rotate caret icon
                    caret.classList.toggle('rotate');
                });
            });
        });
    </script>
</body>
</html>
