<form class="uk-form-stacked add-content" action="{{ route('announcements.create') }}" method="post" enctype="multipart/form-data" hidden>
    <fieldset class="uk-fieldset">
        @include('screens._form')
        <div class="uk-margin">
            <button class="uk-button uk-button-default uk-width-1-4 uk-align-left">{{ __('announcements.add') }}</button>
            <button class="uk-button uk-button-default uk-align-right" type="button" uk-toggle="target: .add-content"><span uk-icon="close"></span></button>
        </div>
    </fieldset>
</form>
