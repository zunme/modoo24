@foreach ( $stars as $star)
  @if ( $star == 1 )
  <i class="fas fa-star"></i>
  @elseif($star == 0.5 )
  <i class="fas fa-star-half-alt"></i>
  @else
  <i class="far fa-star"></i>
  @endif
@endforeach
