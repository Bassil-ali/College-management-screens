<h3 class="uk-heading-divider" style="font-family: hanimation">{{ __('screens.show_announcements') }}</h3>
<form class="uk-grid-collapse uk-margin-small-top" action="{{ route('screens.update-times', ['screen' => $screen]) }}" method="post" uk-grid>
    @csrf

    <div>
        <label class="uk-form-label uk-padding-small uk-margin-small-top uk-text-large" style="color: #26473C !important">{{ __('screens.from') }}</label>
    </div>
    <div>
        <div class="uk-form-controls">
            <input type="text" name="content_start" id="begin" class="uk-input datetimepicker" autocomplete="off" value="{{ isset($screen->content_start) ? $screen->content_start->format('Y/m/d h:i') : '' }}">
        </div>
    </div>

    <div class="uk-margin-medium-right">
        <label class="uk-form-label uk-padding-small uk-margin-small-top uk-text-large" style="color: #26473C !important">{{ __('screens.to') }}</label>
    </div>
    <div>
        <div class="uk-form-controls">
            <input type="text" name="content_end" id="end" class="uk-input datetimepicker" autocomplete="off" value="{{ isset($screen->content_end) ? $screen->content_end->format('Y/m/d h:i') : '' }}">
        </div>
    </div>

    <div>
        &nbsp;
        <button class="uk-button uk-button-default"><span uk-icon="icon: check" style="color: #26473C !important"></span></button>
        <button class="uk-button uk-button-default" type="button" data-remove="{{ $screen->id }}" onclick="removeTimes(event)"><span uk-icon="icon: close" style="color: #26473C !important"></span></button>
    </div>
</form>
