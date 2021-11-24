<form id="edit-{{ $user->id }}" class="uk-flex-top" action="{{ route('users.update', ['user' => $user]) }}" method="POST" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-form-stacked uk-modal-body">
            <div class="uk-margin edit-toggle">
                <label class="uk-form-label" for="name">{{ __('users.name') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="name" type="text" placeholder="{{ __('users.name') }}" value="{{ $user->name }}" required maxlength="255">
                </div>
            </div>

            <div class="uk-margin edit-toggle">
                <label class="uk-form-label" for="username">{{ __('users.username') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="username" type="text" placeholder="{{ __('users.username') }}" value="{{ $user->username }}" required maxlength="15">
                </div>
            </div>

            <div class="uk-margin edit-toggle">
                <label><input class="uk-checkbox" name="is_admin" type="checkbox" {{ $user->is_admin ? 'checked' : '' }}> {{ __('users.is_admin') }}</label>
            </div>

            <div class="uk-margin edit-toggle">
                <label class="uk-form-label" for="section">{{ __('users.section') }}</label>
                <div class="uk-form-controls">
                   <select class="uk-input"  name="section" placeholder="{{ __('users.section') }}" maxlength="100">
                        <option value="{{$user->section}}" selected>{{$user->section}}</option>
                        <option value="الدراسات العامة">الدراسات العامة</option>
                        <option value="الحاسب الالي"> الحاسب الالي</option>
                        <option value="الالكترونيات">الالكترونيات</option>
                        <option value="الاتصالات">الاتصالات</option>
                    </select>
                </div>
            </div>
        </div>

        @csrf

        <div class="uk-modal-footer uk-text-left">
            <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.cancel') }}</button>
            <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
        </div>
    </div>
</form>
