@extends('layout')

@push('styles')
<style>
    body {
        /* min-height: 1200px !important; */
    }
    .uk-tab > li > a {
        font-size: 1.50em;
    }
    /* Active */
    .uk-tab > .uk-active > a {
        color: #ffffff;
        border-color: #31403A;
    }
    /* Hover + Focus */
    .uk-tab > * > a:hover,
    .uk-tab > * > a:focus {
        color: rgb(148, 202, 160);
        text-decoration: none;
    }
    .uk-tab > * > a {
        color: #999;
        font-size: 1.50em;
    }
</style>
@endpush

@section('content')
<div uk-grid>
    <div class="uk-width-auto"></div>
    <div class="uk-width-1-3">
        <ul class="uk-subnav uk-subnav-pill" uk-switcher>
            <li><a href="#">{{ __('timing.morning') }}</a></li>
            <li><a href="#">{{ __('timing.evening') }}</a></li>
        </ul>
        <ul class="uk-switcher uk-margin">
            <li>
                @include('shared.timetable', ['morning' => true])
            </li>
            <li>
                @include('shared.timetable', ['morning' => false])
            </li>
        </ul>
    </div>
    <div class="uk-width-auto"></div>
</div>
@endsection

@push('scripts')

@endpush
