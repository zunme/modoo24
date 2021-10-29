@php
$pagination_eachside = isset($pagination_eachside) ? $pagination_eachside : 3;
@endphp

@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <!--li class="page-item disabled"><span>«</span></li-->
        @else
            <li class="page-item"><span onClick="changepage(this)" class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-double-left"></i></span></li>
        @endif

        @if($paginator->currentPage() > $pagination_eachside)
            <li class="page-item hidden-xs"><span onClick="changepage(this)" class="page-link" href="{{ $paginator->url(1) }}">1</span></li>
        @endif
        @if($paginator->currentPage() > ($pagination_eachside+1))
            <li class="page-item"><span class="page-link">...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - ($pagination_eachside-1) && $i <= $paginator->currentPage() + ($pagination_eachside-1) )
                @if ($i == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><span onClick="changepage(this)" class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</span></li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - $pagination_eachside )
            <li class="page-item"><span class="page-link">...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - ($pagination_eachside-1))
            <li class="page-item hidden-xs"><span onClick="changepage(this)" class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</span></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><span onClick="changepage(this)" class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-angle-double-right"></i></span></li>
        @else
            <!-- li class="page-item disabled"><span class="page-link">»</span></li-->
        @endif
    </ul>
@endif
