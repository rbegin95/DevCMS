<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <script src="{{ asset('/web/manifest.js') }}"></script>
    <script src="{{ asset('/web/vendor.js') }}"></script>
    <script src="{{ asset('/web/app.js') }}"></script>

    @yield('script')


</body>
</html>
