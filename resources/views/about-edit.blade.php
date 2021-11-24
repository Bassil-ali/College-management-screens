@extends('layout')

@section('content')
<center><h2 style="color: wheat">اضف نص حول البرنامج</h2></center>
<form action="{{route('about.edit.update')}}" post="get">
    @csrf
<div class="toggle-text">
    <div class="uk-margin">
        <label class="uk-form-label" for="value" style="color: #ffff">{{ __('announcements.value') }}</label>
        <textarea name="text" class="uk-textarea" rows="8"
            placeholder="{{ __('announcements.value') }}"></textarea>
    </div>
    <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
</div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script src="ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor1' );
    config.direction = 'rtl';
</script>
@endpush