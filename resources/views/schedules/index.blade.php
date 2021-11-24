@extends('layout')

@push('styles')

@endpush

@section('content')
@include('shared.validation')

<div uk-grid>
    <div class="uk-form-horizontal">
        <a class="uk-button uk-button-default" href="{{ route('schedules.download') }}"><span
                uk-icon="cloud-download"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('schedules.download') }}</a>
    </div>
    @if(auth()->user()->is_admin == 1)
    <form class="uk-form-horizontal" action="{{ route('schedules.upload') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div uk-form-custom>
            <input type="file" name="excel">
            <button class="uk-button uk-button-default" type="button" tabindex="-1">{{ __('schedules.select-file')
                }}</button>
        </div>
        <button class="uk-button uk-button-secondary uk-margin-small-right"><span
                uk-icon="cloud-upload"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('schedules.upload') }}</button>
        <button id="file-name" class="uk-button uk-button-text uk-margin-small-right" disabled></button>
    </form>
  @endif
</div>


@include('schedules._lectures', ['rows' => $rows])
<div class="uk-text-center">
    {{ $rows->links('shared.pagination') }}
</div>
@endsection

@push('scripts')
<script>
    $('[name="excel"]').change(function() {
        $("#file-name").text($(this).val());
    });
</script>
<script>
    $(document).ready( function () {
$('#myTable').DataTable({
    "paging": false,
    "info": false
});
} );
</script>
@endpush