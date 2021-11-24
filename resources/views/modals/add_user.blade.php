<form id="add-user" action="{{ route('users.store') }}" method="POST" uk-modal>
    @csrf
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-modal-header">
            <h2 class="uk-modal-title">{{ __('users.add-user') }}</h2>
        </div>

        <div class="uk-modal-body" class="uk-form-stacked">

            <div class="uk-margin">
                <label class="uk-form-label" for="name">{{ __('users.name') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="name" type="text" placeholder="{{ __('users.name') }}" maxlength="100" required>
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="username">{{ __('users.username') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="username" type="text" placeholder="{{ __('users.username') }}" required maxlength="15">
                </div>
            </div>

            <div class="uk-margin">
                <label><input class="uk-checkbox" name="is_admin" type="checkbox"> {{ __('users.is_admin') }}</label>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="section">{{ __('users.section') }}</label>
                <div class="uk-form-controls">
                    <select class="uk-input" name="section" placeholder="{{ __('users.section') }}" maxlength="100">
                       
                        <option value="الدراسات العامة">الدراسات العامة</option>
                        <option value="الحاسب الالي"> الحاسب الالي</option>
                        <option value="الالكترونيات">الالكترونيات</option>
                        <option value="الاتصالات">الاتصالات</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-left">
            <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.cancel') }}</button>
            <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
        </div>
    </div>
</form>
