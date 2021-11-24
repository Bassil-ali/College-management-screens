<form class="uk-form-stacked add-content uk-padding uk-background-secondary" action="{{ route('announcements.update') }}" method="post" enctype="multipart/form-data">
    <fieldset class="uk-fieldset">
        <div class="uk-margin">
            <label class="uk-form-label" for="type">{{ __('announcements.type') }}</label>
            <div class="uk-form-controls">
                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                    @foreach (__('') as $key => $value)
                    <label><input class="uk-radio" type="radio" name="type" value="{{ $key }}" {{ $key == $announcement->type ? 'checked' : '' }}> {{ $value }}</label>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="content-text" class="uk-margin" {{ $announcement->type == 'text' ? '' : 'hidden' }}>
            <label class="uk-form-label" for="value">{{ __('announcements.value') }}</label>
            <textarea name="text" class="uk-textarea" rows="5" placeholder="{{ __('announcements.value') }}">{{ $announcement->type === 'text' ? $announcement->value : '' }}</textarea>
        </div>

        <div id="content-file" class="uk-margin" {{ $announcement->type == 'text' ? 'hidden' : '' }}>
            <label class="uk-form-label" for="value">{{ __('announcements.value') }}</label>
            <div uk-form-custom>
                <input type="file" name="content">
                <button class="uk-button uk-button-default" type="button" tabindex="-1">{{ __('schedules.select-file') }}</button>
            </div>
            <button id="file-name" class="uk-button uk-button-text uk-margin-small-right" disabled></button>
        </div>

        <div class="uk-margin">
            <button class="uk-button uk-button-default uk-width-1-4 uk-align-left">{{ __('announcements.edit') }}</button>
        </div>
    </fieldset>

    <input type="hidden" name="id" value="{{ $announcement->id }}">
    @csrf
    @method('PUT')
</form>