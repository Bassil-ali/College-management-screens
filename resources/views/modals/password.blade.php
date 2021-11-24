<form id="users-password" action="{{ route('users.password') }}" method="POST" uk-modal>
    @csrf
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">{{ __('users.password-title') }}</h2>
        </div>
        <div class="uk-modal-body" class="uk-form-stacked">
            <div class="uk-margin">
                <label class="uk-form-label" for="current_password">{{ __('users.current-password') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="current_password" type="password" placeholder="{{ __('users.current-password') }}" maxlength="191">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="password">{{ __('users.password') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="password" type="password" placeholder="{{ __('users.password') }}" maxlength="191">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="password_confirmation">{{ __('users.password') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="password_confirmation" type="password" placeholder="{{ __('users.password_confirmation') }}" maxlength="191">
                </div>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-left">
            <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.cancel') }}</button>
            <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
        </div>
    </div>
</form>
