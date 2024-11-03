<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="https://www.habboon.pw/favicon-pride.png" type="image/vnd.microsoft.icon" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1" />
    <title>Habboon - Client</title>
    <link rel="stylesheet" href="https://assets.habboon.pw/nitro/static/assets/index-ecc28c5a.css">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5QGSTM6M29"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-5QGSTM6M29');
    </script>

    <!-- Cloudflare Web Analytics --><script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "0b91a479a24b4238acb0183fa5de8104"}'></script><!-- End Cloudflare Web Analytics -->

    <!-- WebSockets -->
    <script>
        window.config = {
            userId: 293530,
            token: 'bws-VdMdwFCJPvg7xQEnqlAxUj7YPi8lqFA1'
        };

        let app = {
            debug: true,
            host: '127.0.0.1',
            port: 2096,
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
            'https://assets.habboon.pw/nitro/renderer-config.json?hash=JAFjbRXmebWH',
            'https://assets.habboon.pw/nitro/ui-config.json?hash=JAFjbRXmebWH',
        ],
        'socket.url': 'wss://client.habboon.pw:2096',
        'asset.url': 'https://assets.habboon.pw/nitro/',
        'image.library.url': 'https://assets.habboon.pw/c_images/',
        'hof.furni.url': 'https://assets.habboon.pw/dcr/hof_furni/',
        'camera.url': '//static.habboon.pw/camera/',
        'thumbnails.url': '//static.habboon.pw/navigator-thumbnail/%thumbnail%.png',
        'url.prefix': 'https://www.habboon.pw',
        'sso.ticket': 'booncms-293887/1e93daa1b6e6d506644d3fe41ce7594f1-293530146765',
        'system.currency.types': [
            -1,0,5,103
        ],
        'forward.type': (new URLSearchParams(window.location.search).get('room') ? 2 : -1),
        'forward.id': (new URLSearchParams(window.location.search).get('room') || 0),
        'friend.id': (new URLSearchParams(window.location.search).get('friend') || 0),
    };
</script>

<script type="module" crossorigin src="https://assets.habboon.pw/nitro/static/assets/index-79123188.js"></script>
    <link rel="modulepreload" crossorigin href="https://assets.habboon.pw/nitro/static/assets/vendor-da6e8cc3.js">

<script>
    window.FlashExternalInterface = {};
    window.FlashExternalInterface.disconnect = function() {
        window.location.href = "https://www.habboon.pw/client";
    };
</script>

<div id="client-alerts"></div>

</body>
</html>