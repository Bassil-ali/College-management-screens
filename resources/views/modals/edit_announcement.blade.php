<form id="edit-{{ $announcement->id }}" action="{{ route('announcements.update') }}" method="post" enctype="multipart/form-data" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">{{ __('announcements.edit') }}</h2>
        </div>
        <div class="uk-modal-body">
            @csrf
            <input type="hidden" name="id" value="{{ $announcement->id }}">
            @include('screens._form', ['screen_id' => $announcement->screen->id, 'color' => '#343E39 !important'])
        </div>
        <div class="uk-modal-footer uk-text-left">
            <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.cancel') }}</button>
            <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
        </div>
    </div>
</form>
