<!DOCTYPE html>
<html lang="ar" dir="rtl">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name', 'Laravel') }}</title>
		<link rel="icon" href="{{ url('favicon.ico') }}">
        <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
		<!-- CSS FILES -->
        <link rel="stylesheet" type="text/css" href="{{ url('css/uikit-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ url('css/style.css') }}">
        @stack('styles')
	</head>
    <style>
        table.dd tbody td {
            padding: 8px 10px;
            color: black;
            background: rgba(0, 87, 63, 1) 100%;
            border: double;
    
        }
    
        .dataTables_wrapper .dataTables_filter {
            color: wheat;
        }
    
        .dataTables_wrapper .dataTables_filter input {
            background-color: wheat;
        }
    </style>
    <body class="{{ Route::currentRouteName() == 'login' ? 'uk-flex uk-flex-center uk-flex-middle uk-background-muted uk-height-viewport' : '' }}" data-uk-height-viewport>

        @include('shared.nav')

        <div class="uk-container uk-padding-large">
            @yield('content')
        </div>

        <footer class="uk-text-center" uk-sticky="bottom: body">
            <img data-src="{{ url('images/login-footer.png') }}" width="290" height="64" alt="login-footer" uk-img>
        </footer>

        <form id="logout-form" action="{{ route('logout') }}" method="post">
            @csrf
        </form>

		<!-- JS FILES -->
		<script src="{{ url('js/uikit.min.js') }}"></script>
        <script src="{{ url('js/uikit-icons.min.js') }}"></script>
        <script src="{{ url('js/jquery-3.5.1.min.js') }}"></script>
        <script>
            var modalOptions = {
                    labels: {
                        ok: "{{ __('app.ok') }}",
                        cancel: "{{ __('app.cancel') }}"
                    }
                };

            $('#logout').click(function() {

                UIkit.modal.confirm("{{ __('app.logout') }}", modalOptions).then(function() {
                    $('#logout-form').submit();
                }, function () {});
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    // 'Content-Type': 'application/json',
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.responseJSON) {
                        var message = jqXHR.responseJSON.message;

                        UIkit.notification({
                            message: '<span uk-icon=\'icon: warning\'></span>&nbsp;' + message,
                            status: 'danger',
                            pos: 'top-center',
                            timeout: 5000
                        });
                        console.log('Exception: ' + jqXHR.responseJSON.exception);
                        console.log('File: ' + jqXHR.responseJSON.file);
                        console.log('Line: ' + jqXHR.responseJSON.line);
                        console.log('Message: ' + jqXHR.responseJSON.message);
                    } else {
                        UIkit.notification({
                            message: '<span uk-icon=\'icon: warning\'></span>&nbsp;' + errorThrown,
                            status: 'danger',
                            pos: 'top-center',
                            timeout: 5000
                        });
                        console.error(jqXHR);
                    }
                }
            });

            $('[data-link]').click(function() {
                var route = $(this).data('link');
                if (route) {
                    document.location.assign(route);
                }
            });
        </script>
        <script type="text/javascript" src="DataTables/datatables.min.js"></script>

        @include('shared.flashes')
        @stack('scripts')
	</body>
</html>
