@if ($paginator->hasPages())
    <ul class="pagination modal-3">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <!--li class="page-item disabled"><span class="page-link">&laquo;</span></li-->
        @else
            <li class=""><a class="next" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-double-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class=""><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class=""><a class="active">{{ $page }}</a></li>
                    @else
                        <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class=""><a class="next" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-angle-double-right"></i></a></li>
        @else
            <!--li class="page-item disabled"><span class="page-link"><i class="fas fa-angle-double-right"></i></span></li-->
        @endif
    </ul>
@endif
