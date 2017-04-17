@if ($paginator->hasPages())

    <div class="page__pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-prev"><i class="fa fa-caret-left"></i></span>
        @else
            <a href="{{ $paginator->firstPageUrl() }}" class="pagination-prev" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="First Page"><i class="fa fa-backward"></i></a>
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-prev" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Previous Page"><i class="fa fa-caret-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span>{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Next Page"><i class="fa fa-caret-right"></i></a>
            <a href="{{ $paginator->lastPageUrl() }}" class="pagination-next" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last Page"><i class="fa fa-forward"></i></a>
        @else
            <span class="pagination-prev"><i class="fa fa-caret-right"></i></span>
        @endif
    </div>
@endif
