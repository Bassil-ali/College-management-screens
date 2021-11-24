@if(auth()->user()->is_admin == 1)
<div class="uk-card uk-margin-medium-bottom uk-text-center uk-padding global">
    <button class="uk-button uk-button-default uk-margin-small-right uk-text-large uk-width-1-2 uk-padding" type="button" uk-toggle="target: .global; animation: uk-animation-fade">{{ $button }}</button>
</div>
<div class="uk-card uk-margin-medium-bottom uk-text-center uk-padding global">
    <a href="{{route('All.Announcement')}}" class="uk-button uk-button-default uk-margin-small-right uk-text-large uk-width-1-2 uk-padding"
        type="button"  animation: uk-animation-fade>عرض وتعديل كافة الاعلانات</a>
</div>
@endif
<form id="global" action="{{ route('announcements.global') }}" method="POST" class="uk-card uk-card-default uk-width-1-1 uk-margin-medium-bottom uk-box-shadow-large global" enctype="multipart/form-data" hidden>
    <div class="uk-card-header">
        {{ $button }}
        <button type="button" class="uk-close-large uk-align-left" uk-toggle="target: .global; animation: uk-animation-fade" uk-close></button>
    </div>

    <div class="uk-padding uk-card-body">
        @include('screens._form', ['screen_id' => 0, 'color' => '#314039'])
    </div>

    <div class="uk-card-footer uk-text-left">
        <button class="uk-button uk-button-default uk-modal-close" type="button" uk-toggle="target: .global; animation: uk-animation-fade">{{ __('app.cancel') }}</button>
        <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
    </div>
</form>
