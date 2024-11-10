@extends('layouts.app')

@section('content')
    <main class="position-relative container justify-content-center py-4">
        <div class="row">
            <div class="col-lg-9 col-12">
                <h5 class="silver">
                    Latest Articles 
                    <span class="float-right">
                        <i class="fas fa-newspaper"></i>
                    </span>
                </h5>
                <div id="articles-strip">
    <div class="row">
        @forelse ($articles as $article)
        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
            <a href="{{ route('articles.show', ['id' => $article->id, 'name' => \Illuminate\Support\Str::slug($article->title)]) }}">
                <div class="card">
                    <div class="card-body" style="background-image: url('{{ asset('/' . $article->img) }}');">
                        <div class="avatar">
                            <img src="https://imager.habboon.pw/?figure={{ $article->user->look }}&size=m&direction=2&head_direction=2&gesture=sml&headonly=1" data-toggle="tooltip" data-placement="top" data-title="{{ $article->user->name }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <h6>
                            <a href="{{ route('articles.show', ['id' => $article->id, 'name' => \Illuminate\Support\Str::slug($article->name)]) }}">{{ $article->name }}</a>
                        </h6>
                        <p>{{ $article->desc }}</p>
                        <div class="info">
                            <div class="initial">
                                <span class="username">{{ $article->published_by }}</span>
                                <span class="published">
                                    <i class="fas fa-clock"></i>
                                     {{ $article->created_at->timezone('-04:00')->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12">
            <p>No articles found.</p>
        </div>
        @endforelse
    </div>
</div>
                <h5 class="silver">
                    Latest Photos 
                    <span class="float-right">
                        <i class="fas fa-camera"></i>
                    </span>
                </h5>
                <div class="row" id="latest-photos">
                    <div class="col-12">
                        <div class="camera-carousel owl-carousel">
                            
     @foreach($photos as $photo)
    <div class="item">
        <img src="{{ $photo->url }}" class="img-fluid" alt="{{ $photo->username }}'s Photo" style="border-radius: 5px 5px 0 0;">
        <div class="info blue">
            <div class="row align-items-center">
                <div class="col-4">
                    <div class="me">
                        <img src="https://imager.habboon.pw/?figure={{ $photo->look }}&direction=3&head_direction=3&gesture=sml&headonly=1" alt="{{ $photo->username }}">
                    </div>
                </div>
                <div class="col-8">
                    <p><a href="#">{{ $photo->username }}</a><br/><span style="color: #fff;">{{ \Carbon\Carbon::parse($photo->timestamp)->format('d/m/y') }}</span></p>
                </div>
            </div>
        </div>
    </div>
@endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <h5 class="silver">
                    Random Badges 
                    <span class="float-right">
                        <i class="fas fa-badge"></i>
                    </span>
                </h5>
                <div id="sidebar-badges" class="card">
                    <div class="card-body">
                        @forelse ($randomBadges as $badge)
                            <a href="#" class="badge-item" data-toggle="tooltip" data-placement="top">
                                <img src="{{ asset($badge) }}" alt="Random Badge">
                            </a>
                        @empty
                            <p>No badges available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
