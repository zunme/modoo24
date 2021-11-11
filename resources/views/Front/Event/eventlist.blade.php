@extends('layouts.modoo')

@section('css')

@endsection


@section('content')
<!--common_visual-->
<div class="visual_event">
    <h1>모두이사 이벤트</h1>
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
        <h1><b>모두이사 이벤트</b> 소식입니다.</h1>
        <section id="popular">
			<article class="inner">
				<ul class="popular-list cf">
					<li>
						<a href="https://www.internetfriends.co.kr/index.php?s1=modoo24_event&action=reg&utm_source=modoo24&utm_medium=partner&utm_campaign=landing&utm_content=modoo24-2021-01-22" target="_blank">
							<div class="pic pic1"></div>
							<div class="textGroup">
								<strong><span class="ongoing">진행중</span></strong>
								<p>기간 : 제휴기간 동안 진행</p>
							</div>
						</a>
					</li>
					<li>
						<a href="/v2/event/samsung">
							<div class="pic pic2"></div>
							<div class="textGroup">
								<strong ><span class="ongoing">진행중</span></strong>
								<p>기간 : 제휴기간 동안 진행</p>
							</div>
						</a>
					</li>
					<li>
						<a href="/v2/event/goldkey">
							<div class="pic pic3"></div>
							<div class="textGroup">
								<strong>종료 | <span class="winner">당첨자발표</span></strong>
								<p>기간 : 21.8.1 ~ 9. 30 자정까지</p>
							</div>
						</a>
					</li>
				</ul>
			</article>
		</section>
    </div>
</div>

@endsection


@section('script')
<script>
</script>
@endsection