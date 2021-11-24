<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li>
                <a id="logout" href="#" class="uk-button uk-button-default uk-text-muted" uk-icon="icon: sign-out; ratio: 2"></a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="uk-button uk-button-default uk-text-muted" uk-icon="icon: home; ratio: 2"></a>
            </li>
            <li>
                <a href="#users-password" class="uk-button uk-button-default uk-text-muted" uk-icon="icon: lock; ratio: 2" uk-toggle></a>
            </li>

            @if (Route::currentRouteName() == 'screens.index' && Auth::user()->is_admin)
            <li>
                <a href="#add-screen" class="uk-button uk-button-default uk-text-muted" uk-icon="icon: desktop; ratio: 2" uk-toggle><span class="uk-text-large my-font">&nbsp;&nbsp;إضافة شاشة&nbsp;&nbsp;</span></a>
            </li>
            @endif

            @if (Route::currentRouteName() == 'screens.show' && Auth::user()->is_admin)
                @if ($screen->id > 40)
                <li>
                    <a href="#delete-screen" class="uk-button uk-button-default uk-text-danger" uk-icon="icon: trash; ratio: 2" uk-toggle><span class="uk-text-large my-font">&nbsp;&nbsp;حذف الشاشة&nbsp;&nbsp;</span></a>
                </li>
                @endif
            @endif

        </ul>
        @include('modals.password')
    </div>

    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li>
                <h2 class="my-font uk-margin-small-left" style="color: #ffffff; !important; background: none !important;">{{ Auth::user()->name }}</h2>
            </li>
            <li>
                <h2 class="my-font uk-margin-small-left uk-padding-remove" style="color: #ffffff; !important; background: none !important;">{{ isset($title) ? '/' : '' }}</h2>
            </li>
            <li>
                <h2 class="my-font uk-margin-large-left" style="color: #ffffff; !important; background: none !important;">{{ isset($title) ? $title : '' }}</h2>
            </li>
        </ul>
    </div>
</nav>
