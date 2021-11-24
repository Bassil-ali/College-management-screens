@foreach ($announcements as $item)
<li>
    @switch($item->type)
        @case('photo')
            <img class="content-image" src="{{ url('content/'.$item->value) }}" alt="{{ $item->value }}">
            @break

        @case('video')
            <video class="content-video" src="{{ url('content/'.$item->value) }}" loop="true" muted playsinline uk-video="autoplay: inview"></video>
            @break

        @case('pdf')
            <iframe src="{{ url('content/'.$item->value) }}" frameborder="0" width="100%" height="600px"></iframe>
            @break

        @default
            <div class="uk-text-center uk-height-1-1">
                <h1 style="color: #1a4e3e" class="uk-margin-xlarge-top">{{ $item->value }}</h1>
                <h3 style="position: absolute; color: #1a4e3e; bottom: 25px;">{{ $item->user->name }}</h3>
            </div>
    @endswitch
</li>
@endforeach
