@extends('layouts.modoo')

@section('css')
<style>
.event_body{
  margin-bottom:20px;
  margin-top:20px;
}
.btn-customblue{
  background-color: #4472c4 !important;
  border-color: #4472c4  !important;
  color:white !important;
  font-weight: 500 !important;
  font-size: 19px !important;
}
.btn-customgreen{
  background-color: #47aba9 !important;
  border-color: #47aba9  !important;
  color:white !important;
  font-weight: 500 !important;
  font-size: 19px !important;
}
.btn-customblue a, .btn-customgreen a{
  color:white !important;
}
</style>
@endsection


@section('content')
<!--common_visual-->
<div class="visual_event">
    <h1>이벤트</h1>
   <!-- <h4>Event</h4> -->
</div>
<!--//common_visual-->

<!-- 메뉴 숨김
<div class="sub_menu">
    <ul class="center">
        <li class="h_icon gotohome"></li>
        <li class=" on "><a href="event">이벤트</a></li>
    </ul>
</div>
-->

<!--//event_list-->
<div class="center">
  <div id="event">
    <h1><b>모두이사 이벤트</b>에 참여해 주세요</h1>
    <section id="event_view">

        <dl class="view_title">
          <dt>{{$data->title}}</dt>
          <dd class="@if($data->prc_ing=='진행중') blue @endif announce">{{$data->prc_ing}} {!! $data->prc_ing_sub!!}</dd>
          <dd class="period">기간 : {{$data->duration}}</dd>
        </dl>
        <div class="event_body">

          @if( $data->loadexternal )
          <!-- load -->
            @include('Front/Event/'.$data->loadexternal)
            <!-- /load -->
          @else
          {!! $data->desc !!}
          @endif
        </div>
        <ul class="choice">
          @if ( $before_data )
          <li>
            <a href="/v2/event/view/{{$before_data->id}}">
              <span class="ch_txt"> ▲ 이전글  : </span>
              <span class="ch_btxt txt_line"> {{$before_data->title}} </span>
            </a>
          </li>
          @endif
          @if ( $after_data )
          <li>
            <a href="/v2/event/view/{{$after_data->id}}">
              <span class="ch_txt"> ▼ 다음글  : </span>
              <span class="txt_line"> {{$after_data->title}} </span>
            </a>
          </li>
          @endif
        </ul>

    </section>
    <button type="button" class="btn event_btn" onclick="location.href='/v2/event';">이벤트 목록</button>
  </div>
</div>

@endsection


@section('script')
<script>
</script>
@endsection
