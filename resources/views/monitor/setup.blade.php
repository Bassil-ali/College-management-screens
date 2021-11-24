<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/uikit-rtl.min.css') }}">
    <style>
        @font-face {
            font-family: hanimation;
            src: url("{{ url('fonts/hanimation-regular.ttf') }}");
        }
        html {
            background: rgb(180,212,187);
            background: -moz-linear-gradient(90deg, rgba(180,212,187,1) 0%, rgba(179,224,210,1) 35%);
            background: -webkit-linear-gradient(90deg, rgba(180,212,187,1) 0%, rgba(179,224,210,1) 35%);
            background: linear-gradient(90deg, rgba(180,212,187,1) 0%, rgba(179,224,210,1) 35%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#b4d4bb",endColorstr="#b3e0d2",GradientType=1);

            font-family: hanimation !important;
        }
        body, h1, h2, h3, div {
            font-family: hanimation !important;
        }
        .arial {
            font-family: Arial, Helvetica, sans-serif !important;
        }
    </style>
</head>
<body>
    <div id="contnet" class="uk-container uk-container-expand uk-padding">
        <form class="uk-text-center uk-margin-xlarge-top" action="{{ route('set-monitor') }}" method="post">
            @csrf
            <div class="uk-margin">
                <input class="uk-text-center uk-input uk-form-width-medium uk-form-large uk-text-large" type="number" placeholder="رقم الشاشة" name="id" autofocus>
                <p class="uk-text-mute">اكتب رقم الشاشة ثم اضغط موافق</p>
            </div>

            <div class="uk-margin">
                <button class="uk-button uk-button-primary uk-button-large" type="submit">موافق</button>
            </div>
        </form>
    </div>

    <script src="{{ url('js/uikit.min.js') }}"></script>
    <script src="{{ url('js/uikit-icons.min.js') }}"></script>
</body>
</html>
