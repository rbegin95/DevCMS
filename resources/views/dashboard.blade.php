@extends('layouts.app')

@section('title')
    {{ config('app.name') }} - {{ Auth::user()->username }}
@endsection

@section('content')
    <main class="position-relative container justify-content-center py-4">
    <div class="row">
        @if (auth()->check() && optional(auth()->user()->last_password_change)->diffInMonths(now()) >= 12)
        <div class="col-12 mb-2">
            <div class="alert alert-warning rounded-lg shadow-sm py-3" role="alert">
                <div class="row align-items-center">
                    <div class="col-1 alert-icon-col">
                        <i class="fas fa-info-circle" style="font-size: 24px;"></i>
                    </div>
                    <div class="col">We noticed that you haven't changed your password in over 12 months. For your security, we highly recommend updating your password as soon as possible.</div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-lg-9 col-12">
            <div id="me" class="mb-3">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-3 text-center">
                        <div class="avatar">
                            <img src="https://imager.habboon.pw/?figure={{ Auth::user()->look }}&direction=2&head_direction=3&gesture=sml&action=wav" alt="{{ Auth::user()->username }}" loading="lazy">
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-9 offset-lg-1 offset-xl-0 offset-0 col-9">
                        <div class="row align-items-center details">
                            <div class="col-xl-6 col-lg-6 offset-lg-0 col-10">
                                <h4>{{ Auth::user()->username }}</h4>
                                <h6 class="mb-0">
                                    {{ Auth::user()->motto }}
                                </h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 text-right d-none d-lg-block">
                                <div>
                                    <a href="https://www.habboon.pw/client" target="_blank" class="btn btn-success px-3">Enter Hotel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="articles-carousel" class="carousel slide mb-3 mb-lg-0" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($articles as $key => $article)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <a href="{{ route('articles.show', ['id' => $article->id, 'name' => \Illuminate\Support\Str::slug($article->title)]) }}">
                        <img class="d-block w-100" style="background-image: url('{{ asset('/' . $article->img) }}')">
                    </a>
                        <div class="carousel-caption d-none d-md-block">
                            <div class="pl-4">
                                <h5>{{ $article->name }}</h5>
                                <p class="mb-0">
                                    {{ $article->desc }}
                                    <br>
                                    <br>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#articles-carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#articles-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
            </div>
        </div>

        <div class="col-lg-3 col-12">
            <div id="socials" class="mb-3">
                <a href="https://www.facebook.com/#/" target="_blank" class="facebook-banner" rel="noopener">
                    <i class="fab fa-facebook"></i>
                    <span>Like us on Facebook!</span>
                </a>
                <a href="https://twitter.com/#" target="_blank" class="twitter-banner" rel="noopener">
                    <i class="fab fa-twitter-square"></i>
                    <span>Tweet us on Twitter!</span>
                </a>
                <a href="https://discord.gg/#" class="discord-banner">
                    <i class="fab fa-discord"></i>
                    <span>Join our Discord</span>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection
