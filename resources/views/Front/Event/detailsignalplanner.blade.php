@extends('layouts.modoo')

@section('css')

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
            <div>
                <dl class="view_title">
                    <dt>시그널플래너 설치만 해도 가전제품 고장 수리비 최대 100만원 지원해 드려요!</dt>
                    <dd class="blue announce">진행중</dd>
                    <dd class="period">기간 : 이벤트 종료시까지</dd>
                </dl>
                <ul class="view_inner" style="margin-bottom:20px">
                    <li>
                        <!-- <img width="100%" src="/v2/images/signal_event220216.jpg" alt="시그널플래너이벤트" usemap=""> -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-rwdImageMaps/1.6/jquery.rwdImageMaps.min.js"></script>
                        <img style="width: 100%;" data-filename="이벤트페이지_시그널플래너.jpg" src="/v2/images/signal_event220216.jpg" usemap="#imgmap2022216152927">
                        <map id="imgmap2022216152927" name="imgmap2022216152927">
                            <area shape="rect" alt="" title="" coords="214,5857,869,5971" href="https://blink.do/modoo" target="blank" onmouseover="document.body.style.cursor='pointer';" onmouseout="document.body.style.cursor='default';"/>
                            <area shape="rect" alt="" title="" coords="213,1454,873,1578" href="https://blink.do/modoo" target="blank" onmouseover="document.body.style.cursor='pointer';" onmouseout="document.body.style.cursor='default';"/>
                        </map>
                        <script type="text/javascript">
                            // rwdImageMaps로 이미지맵 동적 할당하도록 설정
                            $('img[usemap]').rwdImageMaps();
                        </script>
                    </li>
                    <li>
                      <!-- <a href="/v2/review/my" class="btn btn-lg" style="background-color: #333e52;border-color: #333e52; margin-top:20px;">칭찬후기 작성하기</a> -->
                      <!-- <a href="https://blink.do/modoo" class="go_signalplanner" target="blank"></a> -->
                      <!-- <a href="https://blink.do/modoo" class="go_signalplanner02" target="blank"></a> -->
                    </li>

                </ul>
                <ul class="choice">
                    <li><a><span class="ch_txt"> ▲ 현재글 : </span> <span class="ch_btxt txt_line"> 시그널플래너 설치만 해도 가전제품 고장 수리비 최대 100만원 지원해 드려요! </span></a></li>
                    <li><a href="/v2/event/mvafter"><span class="ch_txt"> ▼ 다음글 : </span> <span class="txt_line"> 칭찬후기 작성하고 커피쿠폰 받자</span></a></li>
                </ul>
            </div>
        </section>
        <button type="button" class="btn event_btn" onclick="location.href='/v2/event';">이벤트 목록</button>
    </div>
</div>

@endsection


@section('script')
<script>
</script>
@endsection
