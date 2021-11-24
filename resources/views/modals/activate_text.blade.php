<form id="activate-text" action="{{ route('announcements.activate-text') }}" method="post" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title" style="background: #ffffff !important">{{ __('announcements.activate-text') }}</h2>
        <div class="uk-margin">
            <div class="content-text" uk-grid>
                <div class="uk-width-1-2">
                    <label class="uk-form-label uk-padding-small" style="color: #26473C !important">{{ __('screens.from') }}</label>
                    <div class="uk-form-controls">
                        <input type="text" name="content_start" id="begin" class="uk-input datetimepicker" autocomplete="off" value="{{ isset($screen->content_start) ? $screen->content_start->format('Y/m/d h:i') : '' }}">
                    </div>
                </div>

                <div class="uk-width-1-2">
                    <label class="uk-form-label uk-padding-small" style="color: #26473C !important">{{ __('screens.to') }}</label>
                    <div class="uk-form-controls">
                        <input type="text" name="content_end" id="end" class="uk-input datetimepicker" autocomplete="off" value="{{ isset($screen->content_end) ? $screen->content_end->format('Y/m/d h:i') : '' }}">
                    </div>
                </div>
            </div>
        </div>
        @csrf
        <input type="hidden" name="id" value="{{ $announcement->id }}">
        <p class="uk-text-left" style="background: #ffffff !important">
            <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.cancel') }}</button>
            <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
        </p>
    </div>
</form>
