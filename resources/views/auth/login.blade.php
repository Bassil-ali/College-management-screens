<!DOCTYPE html>
<html lang="ar" dir="rtl">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ config('app.name', 'Laravel') }}</title>
		<link rel="icon" href="favicon.ico">
		<!-- CSS FILES -->
        <link rel="stylesheet" type="text/css" href="{{ url('css/uikit-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ url('css/style.css') }}">
	</head>
	<body class="{{ Route::currentRouteName() == 'login' ? 'uk-flex uk-flex-center uk-flex-middle uk-background-muted uk-height-viewport' : '' }}" data-uk-height-viewport>
		<div class="uk-position-bottom-center uk-position-small uk-visible@m uk-position-z-index">
			<img data-src="images/login-footer.png" width="290" height="64" alt="login-footer" uk-img>
        </div>

        <div class="uk-width-medium uk-padding-small">
            <!-- login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <fieldset class="uk-fieldset">
                    <div class="uk-margin-small">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: user"></span>
                            <input class="uk-input uk-border-pill" name="username" required placeholder="{{ __('auth.username') }}" type="text">
                        </div>

                        @error('username')
                        <div class="uk-text-center">
                            <span class="uk-text-danger">
                                <span class="uk-label uk-label-danger">{{ $message }}</span>
                            </span>
                        </div>
                        @enderror
                    </div>

                    <div class="uk-margin-small">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: lock"></span>
                            <input class="uk-input uk-border-pill" name="password" required placeholder="{{ __('auth.password') }}" type="password">
                        </div>

                        @error('password')
                        <div class="uk-text-center">
                            <span class="uk-text-danger">
                                <span class="uk-label uk-label-danger">{{ $message }}</span>
                            </span>
                        </div>
                        @enderror
                    </div>

                    <div class="uk-margin-small">
                        <label><input class="uk-checkbox" type="checkbox" name="remember"> &nbsp; <span style="color: #ffffff !important">{{ __('auth.remember') }}</span></label>
                    </div>
                    <div class="uk-margin-bottom">
                        <button type="submit" class="uk-button uk-button-green uk-border-pill uk-width-1-1">{{ __('auth.login') }}</button>
                    </div>
                </fieldset>
            </form>
            <!-- /login -->
        </div>

		<!-- JS FILES -->
		<script src="{{ url('js/uikit.min.js') }}"></script>
        <script src="{{ url('js/uikit-icons.min.js') }}"></script>
        @stack('scripts')
	</body>
</html>
