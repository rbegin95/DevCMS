<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1" />
    <title>{{ config('app.name') }} - Nitro Client</title>
    
    <link rel="stylesheet" href="https://assets.habboon.pw/nitro/static/assets/index-ecc28c5a.css">

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5QGSTM6M29"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-5QGSTM6M29');
    </script>

    <!-- WebSocket Configuration -->
    <script>
        window.config = {
            userId: {{ Auth::id() }},
            token: '{{ Auth::user()->auth_ticket }}'
        };

        let app = {
            debug: true,
            host: '{{ env('WEBSOCKET_HOST', '127.0.0.1') }}', // Configurable host
            port: {{ env('WEBSOCKET_PORT', 2096) }}, // Configurable port
            webSocket: null,
            reconnectionInterval: null,
            authenticated: false
        };
    </script>
</head>
<body>
<noscript>You need to enable JavaScript to run this app.</noscript>

<div id="root" class="w-100 h-100"></div>

<script>
    const NitroConfig = {
        'config.urls': [
            '{{ url('nitro-react/public/renderer-config.json') }}',
            '{{ url('nitro-react/public/ui-config.json') }}'
        ],
        'socket.url': 'ws://127.0.0.1:2096',
        'asset.url': 'http://localhost:8080/nitro-assets',
        'image.library.url': 'http://localhost:8080/swf/c_images/',
        'hof.furni.url': 'http://localhost:8080/swf/dcr/hof_furni/',
        'camera.url': '//static.habboon.pw/camera/',
        'thumbnails.url': '//static.habboon.pw/navigator-thumbnail/%thumbnail%.png',
        'url.prefix': 'http://localhost:8080/',
        'sso.ticket': '{{ Auth::user()->auth_ticket }}', // Dynamically set SSO ticket
        'system.currency.types': [-1,0,5,103],
        'forward.type': (new URLSearchParams(window.location.search).get('room') ? 2 : -1),
        'forward.id': (new URLSearchParams(window.location.search).get('room') || 0),
        'friend.id': (new URLSearchParams(window.location.search).get('friend') || 0),
    };
</script>

<!-- Nitro Script Modules -->
<script type="module" crossorigin src="https://assets.habboon.pw/nitro/static/assets/index-79123188.js"></script>
<link rel="modulepreload" crossorigin href="https://assets.habboon.pw/nitro/static/assets/vendor-da6e8cc3.js">

<script>
    window.FlashExternalInterface = {};
    window.FlashExternalInterface.disconnect = function() {
        window.location.href = "{{ route('nitro-client') }}";
    };
</script>

<div id="client-alerts"></div>

</body>
</html>
