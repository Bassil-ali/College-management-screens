@extends('layout')

@push('styles')
<style>
.uk-heading-divider {
    background: inherit !important;
}
</style>
@endpush

@section('content')
@include('shared.validation')
<form class="uk-child-width-expand" method="POST" action="{{ route('instructors.upload') }}" enctype="multipart/form-data" uk-grid>
    @csrf
    <div></div>
    <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
        <div class="uk-grid-collapse uk-child-width-expand uk-margin-medium-bottom" uk-grid>
            <div>
                <a href="{{ route('instructors.index') }}" style="color: #174F3F !important" class="uk-button uk-button-text"><span style="color: #174F3F !important" uk-icon="chevron-left"></span> {{ __('instructors.title') }}</a>
            </div>
            <div></div>
            <div></div>
        </div>
        <div uk-grid>
            <div class="uk-width-2-3">
                <div class="uk-form-stacked">
                    <div>
                        <label class="uk-form-label">{{ __('instructors.id') }}</label>
                        <div class="uk-form-controls">
                            <input class="uk-input uk-width-1-1" type="text" readonly value="{{ $instructor->computer_id }}">
                        </div>
                    </div>
                    <div class="uk-margin-top uk-margin-bottom">
                        <div class="uk-form-label">{{ __('instructors.name') }}</div>
                        <div class="uk-form-controls">
                            <input class="uk-input uk-width-1-1" type="text" readonly value="{{ $instructor->name }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-3">
                @if (isset($instructor->photo))
                <div class="uk-box-shadow-medium uk-padding-remove uk-text-center">
                    <img data-src="{{ url('photos/'.$instructor->photo) }}" width="153" height="153" alt="photo" uk-img>
                </div>
                @else
                <div class="uk-box-shadow-medium uk-padding uk-text-center">
                    <span uk-icon="icon: user; ratio: 5"></span>
                </div>
                @endif
            </div>
        </div>

        <div class="uk-margin-remove" uk-grid>
            <div class="uk-width-1-2 uk-padding-remove">
                <label class="uk-form-label">{{ __('instructors.email') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" name="email" type="email" value="{{ $instructor->email }}" maxlength="255">
                </div>
            </div>
            <div class="uk-width-1-2">
                <label class="uk-form-label">{{ __('instructors.phone') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input uk-width-1-1" name="phone" type="text" value="{{ $instructor->phone }}" maxlength="5">
                </div>
            </div>
        </div>

        <div class="uk-grid-collapse uk-child-width-expand uk-margin-medium-top" uk-grid>
            <div>
                <div class="uk-width-1-1" uk-form-custom>
                    <input type="file" name="photo">
                    <input type="hidden" name="id" value="{{ $instructor->id }}">
                    <button class="uk-button uk-button-default uk-width-1-1" type="button" style="color: #174F3F !important" tabindex="-1">{{ __('instructors.pick-file') }}</button>
                </div>
            </div>
            <div>
                <button type="submit" class="uk-button uk-button-default uk-width-1-1" style="color: #174F3F !important"><span style="color: #174F3F !important" uk-icon="push"></span> {{ __('instructors.save-photo') }}</button>
            </div>
            <div>
                <button class="uk-button uk-button-default uk-width-1-1" style="color: #174F3F !important" type="button" onclick="document.getElementById('instructors.remove').submit();">
                    <span uk-icon="close" style="color: #174F3F !important"></span> {{ __('instructors.remove-photo') }}
                </button>
            </div>
        </div>
        <div>
            <span id="file-name" class="uk-text-center"></span>
        </div>
    </div>
    <div></div>
</form>

<div class="uk-margin-top">
    <ul id="screen-tab" class="uk-subnav uk-subnav-pill" uk-switcher>
        <li><a href="#">{{ __('instructors.lectures') }}</a></li>
        <li><a href="#">{{ __('app.log') }}</a></li>
    </ul>

    <ul id="switcher-content" class="uk-switcher uk-margin">
        <li>
            @include('schedules._lectures', ['rows' => $instructor->lectures()->orderBy('day_index')->orderBy('start')->get()])
        </li>
        <li>
            @include('shared._log', ['logs' => $instructor->logs])
        </li>
    </ul>


</div>

<form id="instructors.remove" method="POST" action="{{ route('instructors.remove') }}">
    @csrf
    <input type="hidden" name="id" value="{{ $instructor->id }}">
</form>
@endsection

@push('scripts')
<script>
    $('#upload-btn').click(function() {
        $('#upload-from').submit();
    });

    $('[name="photo"]').change(function() {
        $('#file-name').text($(this).val());
    });


    $('#remove-photo').click(function() {
        $('#instructors.remove').submit();
    });
</script>
@endpush
