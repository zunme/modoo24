@for ($i = 0; $i < 5; $i++)
    @if (floor($star) - $i >= 1)
        {{--Full Start--}}
        <i class="fas fa-star"> </i>
    @elseif ($star - $i > 0)
        {{--Half Start--}}
        <i class="fas fa-star-half-alt"> </i>
    @else
        {{--Empty Start--}}
        <i class="far fa-star"> </i>
    @endif
@endfor
