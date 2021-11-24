<form id="delete-screen" action="{{ route('screens.delete', ['screen' => $screen]) }}" method="POST" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">حذف شاشة</h2>
        </div>
        <div class="uk-modal-body">
            <h2 style="background: #ffffff !important;">حذف الشاشة رقم {{ hindi($screen->id) }}؟</h2>
        </div>

        @csrf
        @method('DELETE')
        <div class="uk-modal-footer uk-text-left">
            <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.cancel') }}</button>
            <button class="uk-button uk-button-danger" type="submit">{{ __('app.delete') }}</button>
        </div>
    </div>
</form>
