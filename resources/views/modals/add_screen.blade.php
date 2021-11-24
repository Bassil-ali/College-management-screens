<form id="add-screen" action="{{ route('screens.add') }}" method="POST" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">إضافة شاشة</h2>
        </div>
        <div class="uk-modal-body uk-form-stacked">
            <div class="uk-margin">
                <label class="uk-form-label" for="id">رقم الشاشة</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="id" name="id" type="text" placeholder="رقم الشاشة" value="{{ App\Screen::count() + 1 }}" readonly>
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="hall">رقم القاعة</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="hall" name="hall" type="text" placeholder="رقم القاعة">
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
