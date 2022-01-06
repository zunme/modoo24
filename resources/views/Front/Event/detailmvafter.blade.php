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
                    <dt>칭찬후기 작성하고 커피쿠폰 받자</dt>
                    <dd class="blue announce">진행중</dd>
                    <dd class="period">기간 : 이벤트 종료시까지</dd>
                </dl>
                <!--<div class="btn_inner">   
                    <button type="button" class="btn btn_viewbtn1" onclick="window.open('https://www.samsungsales.co.kr/event/moveEventB.sesc?id=APTPR000533&dprt=CST002');">
                       이사 고객 혜택 받기
                    </button>
                </div> -->
                <ul class="view_inner" style="margin-bottom:20px">
                    <li>
                        <img width="100%" src="/v1/image/sub/220106_event_big.jpg" alt="칭찬후기 작성하고 커피쿠폰 받자">
                    </li>

                </ul>
                <ul class="choice">
                    <li><a><span class="ch_txt"> ▲ 현재글 : </span> <span class="ch_btxt txt_line"> 칭찬후기 작성하고 커피쿠폰 받자 </span></a></li>
                    <li><a href="/v2/event/samsung"><span class="ch_txt"> ▼ 다음글 : </span> <span class="txt_line"> 삼성전자 특별전 모두이사 고객 대상</span></a></li>
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
