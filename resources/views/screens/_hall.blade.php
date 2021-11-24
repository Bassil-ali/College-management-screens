<form class="uk-grid-collapse" action="{{ route('screens.update', ['screen' => $screen]) }}" method="POST" uk-grid>
    @csrf
    <div>
        <label class="uk-form-label uk-padding-small uk-margin-small-top uk-text-large" style="color: #26473C !important">{{ __('screens.hall') }}</label>
    </div>
    <div>
        <div class="uk-form-controls">
            <input class="uk-input uk-width-1-1" type="text" name="hall" value="{{ $screen->hall }}" placeholder="{{ __('screens.hall') }}">
        </div>
    </div>
    <div>
        <button class="uk-button uk-button-secondary uk-input uk-width-1-1">{{ __('screens.update') }}</button>
    </div>
</form>

