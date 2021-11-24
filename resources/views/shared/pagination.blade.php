@if ($paginator->hasPages())
<ul class="uk-pagination" uk-margin>
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="uk-disabled"><a href="#"><span uk-pagination-previous></span></a></li>
    @else
    <li><a style="color: #ffffff" href="{{ $paginator->previousPageUrl() }}"><span uk-pagination-previous></span></a></li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="uk-disabled"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li class="uk-active"><a href="{{ $url }}"><span>{{ $page }}</span></a></li>
                @else
                <li><a style="color: #ffffff" href="{{ $url }}"><span>{{ $page }}</span></a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li><a style="color: #ffffff" href="{{ $paginator->nextPageUrl() }}"><span uk-pagination-next></span></a></li>
    @else
    <li class="uk-disabled"><a href="#"><span uk-pagination-next></span></a></li>
    @endif
</ul>
@endif
