<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>{{ config('app.name')}} - Login</title>
    
    <link rel="stylesheet" href="{{asset('/web/app.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    

</head>
<body>
    <header class="position-relative">
        <div id="pride"></div>
        <div class="container">
            <div class="row justify-content-center justify-content-md-between justify-content-lg-between align-items-center">
                <div class="col-lg-3 col-md-6 d-lg-block d-md-block d-flex justify-content-center">
                    <a href="/">
                        <img src="{{ asset('/img/dev.gif') }}" alt="Habboon Logo" loading="lazy">
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mt-2 mt-md-0">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center justify-content-md-end ">
                            <div class="online" style="max-width: 220px;">
                                <i class="fas fa-users"></i>
                                <span class="count">{{ $online_user_count }}</span>
                                {{ config('app.name')}} Online
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center justify-content-md-end mt-1">
                            <div class="w-100" style="max-width: 220px;">
                                <a href="/register" class="enter w-100" id="ga-header-registration-button" aria-label="Register">
                                    <div>
                                        <i class="fas fa-plus"></i>
                                         Register now!
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-md navbar-dark habboon-nav">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ml-2 ml-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link ">
                            Homepage 
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" id="communityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Community
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="/community" class="dropdown-item ">Community</a>
                            <a href="/gallery" class="dropdown-item ">Gallery</a>
                            <a href="/community/gotw" class="dropdown-item ">GOTW Leaderboards</a>
                            <a href="/community/leaderboards" class="dropdown-item ">Leaderboards</a>
                            <a href="/community/online-players" class="dropdown-item ">Online Players</a>
                            <a href="/community/staff" class="dropdown-item ">Staff</a>
                        </div>
                    </li>
                    <li class="nav-item d-md-none d-lg-block">
                        <a href="/marketplace" class="nav-link ">Marketplace</a>
                    </li>
                    <li class="nav-item   d-md-none d-lg-block">
                        <a href="/store" class="nav-link ">Store</a>
                    </li>
                    <li class="nav-item ">
                        <a href="/help" class="nav-link ">Help</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-lg-auto navbar-user-dropdown ml-2 ml-lg-0">
                    <li class="nav-item">
                        <a href="/register" class="btn btn-primary my-2 my-sm-0 ml-2 d-none d-lg-block" id="ga-navbar-register">Register</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-enter-button position-absolute"></div>
        </div>
    </nav>
    <main class="position-relative container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-3 d-lg-block d-none">
            <h5 class="silver">
                Latest Article 
                <span class="float-right">
                    <i class="fas fa-newspaper"></i>
                </span>
            </h5>
           <div id="articles-strip">
    <div class="row">
        <div class="col-12">
              @if ($latestArticle)
            <div class="card mb-3">
                <div class="card-body" style="background-image: url('{{ asset('/' . $latestArticle->img) }}')">
                    <div class="avatar">
                        <img src="https://imager.habboon.pw/?figure={{ $latestArticle->user->look }}&size=m&direction=2&head_direction=2&gesture=sml&headonly=1" alt="Glee" data-toggle="tooltip" data-placement="top" data-title="Glee" loading="lazy">
                    </div>
                </div>
                <div class="card-footer">
                    <h6>
                        <a href="#" aria-label="{{ $latestArticle->title }}">{{ $latestArticle->title }}</a>
                    </h6>
                    <p>
                        {{ $latestArticle->desc }}
                        <br/>
                        <br/>
                    </p>
                    <div class="info">
                        <div class="initial">
                            <span class="username">{{ $latestArticle->published_by }}</span>
                            <span class="published">
                                <i class="fas fa-clock"></i>
                                {{ $latestArticle->created_at->timezone('-04:00')->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="silver">Login to DevCMS!</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger">These credentials do not match our records.</div>
                        @endif
                        <div class="forum-group">
                            <x-label for="username" value="{{ __('Username') }}" />
                            <x-input id="username" class="form-control" type="username" name="username" :value="old('username')" required autofocus autocomplete="username" />
                            <div id="preview-user" style="background-image: url('https://www.habboon.pw/img/ghost.png');"></div>
                        </div>
                        <p>
                        <div class="forum-group">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                        </div>
                        <p>
                        <div class="cf-turnstile">
                            @if (Route::has('password.request'))
                            <small>
                                <a href="/forgot-password" aria-label="Forgot your password?">Forgot your password?</a>
                            </small>
                            @endif
                        </div>
                        <x-button class="btn btn-primary btn-block">
                            {{ __('Log in') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-lg-block d-none">
            <!-- Additional content if needed -->
        </div>
    </div>
</main>
    <footer class="position-relative mt-5">
        <div id="footer" class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 d-lg-block d-none">
                        <h4 class="mb-3">Online Users</h4>
                        
                    </div>
                    <div class="col-lg-3 col-6">
                        <h4 class="mb-3">Help</h4>
                        <ul class="links">
                            <li class="mb-1">
                                <a href="https://www.habboon.pw/help" aria-label="Help">
                                    <i class="fas fa-question" style="left: -5px;margin-top: 2px;"></i>
                                     Help
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="https://www.habboon.pw/help/tickets" aria-label="Tickets">
                                    <i class="fas fa-ticket-alt" style="left: -6px;margin-top: 2px;"></i>
                                     Tickets
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-6">
                        <h4 class="mb-3">Social</h4>
                        <ul class="social">
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="legal-footer">
            <p>{{ config('app.name')}} is a not for profit educational project.</p>
        </div>
    </footer>
    <script src="{{asset('/web/manifest.js')}}"></script>
    <script src="{{asset('/web/vendor.js')}}"></script>
    <script src="{{asset('/web/app.js')}}"></script>
    <script>
    $(function() {
        $('input[name="username"]').keyup(debounce(function() {
            $.get('/api/figure/' + $(this).val(), function(e) {
                if (e !== undefined && e.figure !== undefined && e.figure.length > 0) {
                    $('#preview-user').css('background-image', 'url(https://imager.habboon.pw/?figure=' + e.figure + '&size=m&direction=4&head_direction=3&gesture=sml&action=wav)');
                } else {
                    $('#preview-user').css('background-image', 'url(/img/ghost.png)');
                }
            });
        }, 500));

        function debounce(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this,
                    args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate)
                        func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow)
                    func.apply(context, args);
            };
        }
        ;
    });
    </script>
</body>
</html>
