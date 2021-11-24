<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/uikit-rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/monitor.css') }}">

    <style>
        .container {
            /* display: flow-root; */
            /* box-sizing: content-box; */
            max-width: none;
            margin-left: 0;
            margin-right: 0;
            padding-left: 0;
            padding-right: 0;
            -webkit-transition: background-color 2s ease-out;
            -moz-transition: background-color 2s ease-out;
            -o-transition: background-color 2s ease-out;
            transition: background-color 2s ease-out;
        }
        h1, h2, h3, h5, th, td, tr {
            color: #363D39  !important;
        }
    </style>
</head>
<body>
    @include('monitor.corners')
<div id="seconds">30</div>
     <div id="announcements" class="container uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="animation: fade; autoplay: true; draggable: false; autoplay-interval: 30000; pause-on-hover: false">
        <ul id="contnet" class="uk-slideshow-items" uk-height-viewport="offset-top: true; offset-bottom: true">
        </ul>
    </div>

    <script src="{{ url('js/uikit.min.js') }}"></script>
    <script src="{{ url('js/uikit-icons.min.js') }}"></script>
    <script src="{{ url('js/moment-with-locales.min.js') }}"></script>
    @if (env('FORCEUPDATE', true))
    <!-- <script>
        var update = setInterval(() => {
            //document.location.reload(); 
            loadContnet();       
            
             }, 1000);  // 5 minuets
    </script> -->
    @endif
    <script>

        var seconds = 10;

        var timer = setInterval(() => {
            seconds--;
            if(seconds === 0) {
                loadContnet();
                seconds = 10;
            }
             document.getElementById('seconds').innerText = seconds;
        }, 1000);
        loadContnet();

        function loadContnet() {
      var screen = '{{ $screen }}';
        var fingerprint = '';
        var url = "{{ route('api.monitor', ['screen' => $screen, 'fingerprint' => 'xxxx']) }}";
            fetch(url.replace('xxxx', fingerprint))
                .then(res => res.json())
                .then(data => {
                    if (data.fingerprint !== fingerprint) {
                        if (data.logo) {
                            var _logo = "{{ url('images/cte.jpg') }}";
                            document.body.style.background = 'url("' + _logo + '") no-repeat fixed 0 0';
                            document.body.style.backgroundSize = '100% 100%';
                        } else  {
                            document.getElementById('contnet').innerHTML = data.html;
                            fingerprint = data.fingerprint;

                            const width = document.body.clientWidth;
                            const height = document.body.clientHeight;
                            const images = document.querySelectorAll('.content-image');
                            const videos = document.querySelectorAll('.content-video');

                            images.forEach((item) => {
                                item.style.maxWidth = width;
                                item.style.maxHeight = height;
                                item.style.minWidth = width;
                                item.style.minHeight = height;
                                item.setAttribute('height', height);
                                item.setAttribute('width', width);
                            });

                            videos.forEach((item) => {
                                item.setAttribute('height', height);
                                item.setAttribute('width', width);
                            });

                            // if (data.announcements) {
                            //     UIkit.slideshow('#announcements', {
                            //         animation: 'fade',
                            //         autoplay: true,
                            //         draggable: false,
                            //         'autoplay-interval': 5000,
                            //         'pause-on-hover': false,
                            //         ratio: '',
                            //     });
                            // }
                        }
                    }
                })
                .catch(err => {
                    clearInterval(timer);
                    clearInterval(update);
                    setTimeout(() => { document.location.reload(); }, 5000);
                });
        }
    </script>
</body>
</html>
