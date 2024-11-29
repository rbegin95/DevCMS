@extends('layouts.app')

@section('title', config('app.name') . ' - Login')

@section('content')
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
   @endsection

   @section('script')
    <script>
        $(function () {
            $('input[name="username"]').keyup(debounce(function() {
                $.get('/api/figure/' + $(this).val(), function (e) {
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
                    var context = this, args = arguments;
                    var later = function() {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) func.apply(context, args);
                };
            };
        });
    </script>
    @endsection
</body>
</html>
