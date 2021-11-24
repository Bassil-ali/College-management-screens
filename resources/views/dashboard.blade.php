@extends('layout')

@section('content')
<div  class="uk-grid-large uk-child-width-expand@s uk-text-center" uk-grid>
    @foreach (array_slice(__('dashboard'), 3) as $item)
    <div>
        @if ($item[0] == 'ignore')
        <div style="border-radius: 2%" class="uk-card uk-card-default uk-card-body uk-padding">
            <img data-src="{{ url('images/cte.jpg') }}" alt="" uk-img>
        </div>
        @else
        <div style="color: rgb(255, 255, 255)">{{ $item[1] }}</div><br>
       <center> <div style="border-radius: 2%" class="uk-card uk-card-default uk-card-body button" data-link="{{ $item[2] }}"
            >
            <span uk-icon="icon: {{ $item[0] }}; ratio: 5.0"></span>
        </div></center>
        @endif
    </div>
    @endforeach
</div>
<div class="uk-grid-large uk-child-width-expand@s uk-text-center" uk-grid>
    @foreach (array_slice(__('dashboard'), 0, 3) as $item)
    
    <div>
        <div style="color: rgb(255, 255, 255)">{{ $item[1] }}</div><br>
        <div style="border-radius: 2%" class="uk-card uk-card-default uk-card-body button" data-link="{{ $item[2] }}" >
            <span uk-icon="icon: {{ $item[0] }}; ratio: 5.0"></span>
        </div>
    </div>
    @endforeach
</div>


@endsection

@push('scripts')
@endpush
