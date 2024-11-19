@extends('layouts.app')

@section('title')
    {{ config('app.name') }} - Articles
@endsection

@section('content')
    <main class="position-relative container justify-content-center py-4">
        <div class="row">
            <div class="col-lg-3 col-12">
                <h5 class="silver">Filter Articles</h5>
                <div class="card">
                    <div class="card-body">
                        <ul class="article-list-filter">
                            <a href="#" class="select-category" data-category="0">
                            All Articles
                            </a>
                            <li>
                                <a href="#" class="select-category" data-category="3">
                                Generic
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="4">
                                Events
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="5">
                                Gamer of the Week
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="6">
                                Room of the Week
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="7">
                                Story of the Week
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="8">
                                Badge of the Week
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="9">
                                Outfit of the Week
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="10">
                                Pixel by Pixel
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="11">
                                Casino of the Month
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="12">
                                Boon Adventures
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="13">
                                Guess the Furni
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="14">
                                Snapshot of the Week
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="15">
                                Author of the Week
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="16">
                                Connect
                                </a>
                            </li>
                            <li>
                                <a href="#" class="select-category" data-category="17">
                                Habboon Happenings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-12" id="articles-strip">
    <h5 class="silver">{{ config('app.name') }} News</h5>
    <div class="row" id="articles-row">
        @forelse ($articles as $article)
            <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
                <a href="{{ route('articles.show', ['id' => $article->id, 'name' => \Illuminate\Support\Str::slug($article->name)]) }}">
                    <div class="card">
                        <div class="card-body" style="background-image: url('{{ asset('img/webpromo/' . $article->img) }}');">
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

</main>
 
    <script>
    $('.select-category').on('click', function(e) {
        e.preventDefault();

        var selectedCategory = $(this).data('category');

        $('#articles-row .article').each(function() {
            var articleCategory = $(this).data('category');

            if (selectedCategory === 0 || articleCategory === selectedCategory) {
                $(this).fadeIn();
            } else {
                $(this).fadeOut();
            }
        });
    });
    </script>
</body>
</html>
@endsection
