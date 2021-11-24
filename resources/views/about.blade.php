@extends('layout')

@section('content')
@if (auth()->user()->is_admin == 1)
<div>
    <a class="uk-button uk-button-default" href="{{route('about.edit')}}" uk-toggle style="color: #ffffff"><span
            uk-icon="plus"></span>&nbsp;&nbsp;تعديل</a>
</div>
@endif
<br><br>
@php
   $text = App\About::select('string')->first();
@endphp
<center>
    <h2 style="font-size: 4cm"><pre style="font-size: larger;color: wheat;background: none;!important">{{$text->string}}</pre></h2>
</center>

@endsection

@push('scripts')
@endpush
