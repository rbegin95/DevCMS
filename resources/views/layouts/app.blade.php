<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/web/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('/img/favicon-d.png') }}" type="image/vnd.microsoft.icon"/>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }
    .content {
        flex: 1;
    }
    footer {
        background-color: #343a40;
        color: #868e96;
        margin-top: auto;
    }
    #footer {
        padding: 20px 0;
    }
    #legal-footer {
        background-color: #343a40;
        color: #868e96;
        text-align: center;
        padding: 10px 0;
    }
</style>
</head>
<body class="@yield('body-class')">
    @include('layouts.header')

    <div class="content">
        @yield('content')
    </div>

    @include('layouts.footer')

    @yield('script')

    <script src="{{ asset('/web/manifest.js') }}"></script>
    <script src="{{ asset('/web/vendor.js') }}"></script>
    <script src="{{ asset('/web/app.js') }}"></script>


    <script>
$(document).ready(function() {
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
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }
});
</script>

</body>
</html>
