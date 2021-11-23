@extends('layouts.modoo')

@section('usesub','')

@section('css')
<script src="/community/newmain.js?v20211122114201"></script>
<style>
    .right_menu {
        width: 55%
    }
    .move_review_item_point {
        margin-top: 14px;
    }
</style>
@endsection

@section('login-pc','')
@section('login-mobile','')

@section('content')
<!--날개배너-->
<!--div id="simpleorder" class="banner_right_box pc" style="z-index: 899;top: 190px;">
		<a href="void(0);" onclick="alert('준비중입니다.');return false;">
				<img src="/NEW/image/main_N/wing_banner.jpg" alt="날개배너">
		</a>
</div-->
<!--//날개배너-->


<!--메인배너-->
<section id="banner_visual">
    <ul>
        <li>
            <a class="pc" href="/front/orderpop?s=2"><img src="/v1/image/main_N/main_bn01.png"></a>
            <a class="mobile" href="/front/orderpop?s=2"><img src="/v1/image/main_N/main_m_bn01.png"></a>
            <a class="btn_untact mobile" href="/v1/modoo/untact_info.php" style="width:100%; margin-top:10px"><b>비대면 견적 </b>가이드</a>
        </li>
        <li>
            <a class="pc" href="/front/orderpop?s=1"><img src="/v1/image/main_N/main_bn02.png"></a>
            <a class="mobile" href="/front/orderpop?s=1"><img src="/v1/image/main_N/main_m_bn02.png"></a>
            <a class="btn_contact mobile" href="/v1/modoo/contact_info.php" style="width:100%;margin-top:10px"><b>방문 견적 </b>가이드</a>
        </li>
        <li class="pc">
            <a href="http://modooclean.com/" target="_blank"><img src="/v1/image/main_N/main_bn03.png"></a>
        </li>
    </ul>
    <div class="row" style="display:none">
        <div class="col-md-4 col-sm-6"><img src="/v1/image/main_N/main_bn01.png"></div>
        <div class="col-md-4 col-sm-6"><img src="/v1/image/main_N/main_bn02.png"></div>
        <div class="col-md-4 col-sm-6 pc"><a href="http://modooclean.com/" target="_blank"><img src="/v1/image/main_N/main_bn03.png"></a></div>

    </div>
</section>
<!--pc간편견적-->
<section id="simply_move" class="center pc">
    <form>
        <div class="box01">
            <h2><span class="color_pt">간편</span> 이사견적</h2>
            <p>간단한 정보 입력과 동의로
                이사견적 신청 완료
            </p>
        </div>
        <ul class="box02">
            <li><span>이사일</span>
                <div class="move_Box">
                    <input type="text" placeholder="이사일" class="sel-datepicker" name="t_dday">
                </div>

            </li>
            <li>
                <span>이사종류</span>
                <div style="display: inline-block">
                    <select class="select" name="t_kinds">
                        <option value="">이사종류</option>
                        <option value="가정">가정이사</option>
                        <option value="소형">소형이사</option>
                        <option value="사무실">사무실이사</option>
                    </select>
                </div>
            </li>
            <li>
                <span>고객명</span>
                <div class="move_Box">
                    <input type="text" placeholder="고객명" name="t_name">
                </div>
            </li>
            <li>
                <span>연락처</span>
                <div class="move_Box">
                    <input placeholder="번호만 입력" maxlength="12" name="t_hp">
                </div>
            </li>
        </ul>
        <ul class="box03">
            <li>
                <div class="checks">
                    <div class="checks etrans">
                        <input type="checkbox" id="ex_chk0" onclick="selectAll(this)">
                        <label for="ex_chk0"></label>
                        <p>
                            전체 동의
                        </p>
                    </div>
                </div>
            </li>
            <li>
                <div class="checks">
                    <div class="checks etrans">
                        <input type="checkbox" id="ex_chk2" name="simplyRegPrivacy" value="Y">
                        <label for="ex_chk2"></label>
                        <p class="modalpop_link" link="/new_common/popup/personal_data.html">
                            개인정보수집 및 이용에 동의(필수)
                        </p>
                    </div>
                </div>
            </li>
            <li>
                <div class="checks">
                    <div class="checks etrans">
                        <input type="checkbox" id="ex_chk3" name="simplyRegJoint" value="Y">
                        <label for="ex_chk3"></label>
                        <p class="modalpop_link" link="/new_common/popup/personal_3.html">
                            개인정보의 제3자 제공 동의(필수)
                        </p>
                    </div>
                </div>
            </li>
            <li>
                <div class="checks">
                    <div class="checks etrans">
                        <input type="checkbox" id="ex_chk4" name="simplyMarketting" value="Y">
                        <label for="ex_chk4"></label>
                        <p>
                            마케팅 동의(선택)
                        </p>
                    </div>
                </div>
            </li>
        </ul>
        <button type="button" class="btn_simply simple-reg-btn"><span class="color_yw">간편견적</span><br />신청하기</button>
    </form>
</section>
<!--견적가이드-->
<section class="center move_kind pc">
    <div class="left_Box">
        <h2 class="color_pt">무료 비대면 견적</h2>
        <h4>이사짐 체크와 사진으로 간편하게 집에서 이사견적을 받아보세요</h4>
        <p class="txt">24시간 동안 최대 10개 업체의 꼼꼼한 이사 견적을 제안 드립니다.</p>
        <button type="button" class="btn_untact" onclick="location.href='/v1/modoo/untact_info.php' "><b>비대면 견적 </b>가이드</button>
        <p class="img"><img src="/v1/image/main_N/untact_info.jpg" alt="비대면 견적 가이드"></p>
    </div>
    <div class="right_Box">
        <h2 class="color_blue">무료 방문 견적</h2>
        <h3>파트너 업체의 직접 방문을 통해 정확한 이사 견적을 제안 드립니다. </h3>
        <button type="button" class="btn_contact" onclick="location.href='/v1/modoo/contact_info.php' "><b>방문 견적 </b>가이드</button>
        <p class="img"><img src="/v1/image/main_N/tact_info.jpg" alt="방문 견적 가이드"></p>
    </div>
</section>
<!--이벤트-->
<section class="center event_wrap">
    <div id="demo" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <!-- 슬라이드 쇼 -->
            <div class="carousel-item active">
                <a href="https://blog.naver.com/modoo24try/222488994124" target="_blank">
                    <img class="d-block w-100 pc" src="/v1/image/main_N/event_ss.jpg" class="pc" alt="삼성이벤트">
                    <img class="d-block w-100 mobile" src="/v1/image/main_N/event_ss_m.jpg" class="pc" alt="삼성이벤트">
                </a>
            </div>
            <div class="carousel-item">
                <a href="https://www.internetfriends.co.kr/index.php?s1=modoo24_event&action=reg&utm_source=modoo24&utm_medium=partner&utm_campaign=landing&utm_content=modoo24-2021-01-22" target="_blank">
                    <img class="d-block w-100 pc" src="/v1/image/main_N/event_it.jpg" class="pc" alt="인터넷신청">
                    <img class="d-block w-100 mobile" src="/v1/image/main_N/event_it_m.jpg" class="pc" alt="인터넷신청">
                </a>
            </div>
            <!-- / 슬라이드 쇼 끝 -->
            <!-- 왼쪽 오른쪽 화살표 버튼 -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span> <!-- <span>Previous</span> --> </a> <a class="carousel-control-next" href="#demo" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <!-- <span>Next</span> -->
            </a> <!-- / 화살표 버튼 끝 -->
            <!-- 인디케이터 -->
            <ul class="carousel-indicators">
                <!--0번부터시작-->
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
            </ul> <!-- 인디케이터 끝 -->
        </div>
    </div>
</section>
<!--지식인검색-->
<section class="center search_wrap">
    <h2><b>이사에 대해 알고 싶은것!</b> <b class="color_pt">이사지식인</b>에 문의하세요!</h2>
    <div class="left_box">
        <i><img src="/v1/image/main_N/icon_truck.png" alt="이사지식인아이콘"></i>
        <h5>
            <span class="color_pt">이사지식인</span> 검색
        </h5>
        <div class="search_Box">
            <form action="/community/posts/jisik" id="jisikform">
                <input type="search_option" type="hidden" value="title" style="display: none">
                <input type="text" name="search" placeholder="이사지식인검색">
                <label></label>
                <span class="btn_form" href="/community/posts/jisik" onclick="$('#jisikform').submit()">검색</span>
            </form>
        </div>
    </div>
    <div class="mobile know_m_info">
        <h4><b>이사 지식인<span class="plus color_pt">+</span></b></h4>
        <div>
            이사에 대한 궁금한 사항을 모두이사
            파트너업체가 답변해 드립니다.
        </div>
        <p><img src="/v1/image/main_N/icon_qna.png" alt="qna"></p>
        <button type="button" class="btn_question">
            자세히보기
        </button>
    </div>
    <div class="faq_box pc">
        <i class="fas fa-people-carry"></i>
        <a href="/v1/customer/faq">
            <h3>모두이사 <span class="color_pt">자주묻는 질문</span></h3>
            <h4>이사 고객님들이 견적시 알아두면 좋은 내용을 정리 하였습니다. </h4>
        </a>
    </div>

</section>
<!--커뮤니티-->
<section class="community_wrap center">
    <h2>모두이사 고객과 <span class="color_pt">함께하는 커뮤니티</span></h2>
    <ul>
        <li class="pc">
            <h4>이사 <span class="color_pt">지식인</span><a class="plus" href="/community/posts/jisik">+</a></h4>
            <ul class="know_list">
                @foreach ( $jisik as $row )
                <li>
                    <a href="/community/posts/jisik">
                        <div>Q. {{$row->title}}</div>
                        <div>A.
                            @if ( $row->firstcomment)
                            {{$row->firstcomment->body}}
                            @else
                            답변대기중입니다.
                            @endif
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <h4 class="bgg">모두 <span class="color_blue">꿀TIP</span> <a class="plus" href="/v2/posts/tip">+</a></h4>
            <ul class="huney_list">
                @foreach ( $tip as $row)
                <li>
                    <a href="/v2/posts/tip">
                        <div @if( $row->repImg && $row->repImg !='')
                            style="background-image: url('{!!$row->repImg!!}')"
                            @endif
                            >

                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        <!--
            <li>
                <h4 class="bgg">모두 <span class="color_pt">살기 좋은집</span> <span class="plus">+</span></h4>
                <ul class="fun_list">
                    <li>
                        <a>
                            <div>
                                <img src="/v1/image/main_N/img03.jpg" alt="">
                            </div>
                            <p>신림스카이 아파트
                                서울특별시 관악구 신림로
                                185(신림동)지하철 2호선
                                신림역, 봉천역</p>
                        </a>
                    </li>
                </ul>
            </li>
            -->
        <li>
            <h4 class="bgg"><span class="color_blue">모두</span> FUN <a class="plus" href="/v2/posts/fun">+</a></h4>
            <ul class="fun_list">
                @foreach ( $fun as $row)
                <li>
                    <a href="/v2/posts/fun">
                        <div class="fun_pic" @if( $row->repImg && $row->repImg !='')
                            style="background-image: url('{!!$row->repImg!!}')"
                            @endif
                            >
                            <!--이미지-->
                        </div>
                        <div class="fun_txt">
                            <p class="fun_title">
                                {{$row->title}}
                            </p>
                            <div class="item-desc-sub">
                                <div class="item-desc-nickname">{{$row->nickname}}</div>
                                <div class="item-desc-date">
                                    @if ($row->created_at > $startday )
                                    {{$row->created_at->format('H:i')}}
                                    @else
                                    {{$row->created_at->format('y.m.d')}}
                                    @endif
                                </div>
                                <div class="line100"></div>
                                <div class="item-desc-commentcnt">
                                    <i class="far fa-comment-dots"></i>
                                    <span>{{$row->comment_cnt}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </li>

    </ul>
</section>

<!--칭찬후기-->
<section class="good_ct_after">
    <div class="center">
        <nav class="slidernav">
            <div id="navbtns" class="clearfix">
                <a href="#" class="previous">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="64" height="64">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M10.828 12l4.95 4.95-1.414 1.414L8 12l6.364-6.364 1.414 1.414z" fill="rgba(51,51,51,1)" />
                    </svg>
                </a>
                <a href="#" class="next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="64" height="64">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z" fill="rgba(51,51,51,1)" />
                    </svg>
                </a>
            </div>
        </nav>

        <h2 class="gd_title">모두이사 고객 <span class="color_pt">이사 후기</span></h2>
        <a class="more" href="/v1/move/review">후기 더보기 + </a>


        <div class="crsl-items" data-navigation="navbtns" style="width: 100%; overflow: hidden;">
            <div class="crsl-wrap" onclick="location.href='/v1/move/review' " style="cursor: pointer; width: 1135px; margin-left: -227px;">


                <div class="crsl-item" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
                    <a class="review" href="/v1/move/review" style="display: block">
                        <h3>업체명</h3>
                        <h4>(업체등급)</h4>
                        <dl>
                            <dt><img src="/v1/image/main_N/big_star.png" alt="star"></dt>
                            <dd>
                                <span class="num">5.0</span>
                                <span class="numtxt">전체 평점</span>
                            </dd>
                        </dl>
                        <p class="review_txt">후기글</p>
                        <span class="review_date">이사일 2020-11-20</span>
                    </a>
                </div>



            </div>
        </div>
    </div>
</section>


<!--이사생활정보-->



<!--파트너문의 고객센터-->
<section class="customer_wrap">
    <div class="center">
        <div class="left_box">
            <h2><span class="color_pt">파트너</span> 입점 문의</h2>
            <p>이사업체 및 용달업체 <br />
                파트너 상시모집</p>
            <button type="button" class="btn_part" onclick="location.href='/v1/move/custom_business' ">자세히 보기</button>
        </div>
        <div class="right_box">
            <p><img src="/v1/image/main_N/partner2_img.png" alt="1600-7728"></p>
            <dl>
                <dt class="pn_title">광고 및 제휴제안</dt>
                <dd class="pn_tel">모든 <span class="color_pt">업종 업태</span> </dd>
                <dd class="pn_txt">
                    모두플랫폼은 다양한 분야의 사업자와 함께 합니다.
                </dd>
            </dl>
        </div>

        <div class="right_box" style="display: none">
            <p><img src="/v1/image/main_N/customer_img.png" alt="1600-7728"></p>
            <dl>
                <dt class="title">고객센터</dt>
                <dd class="tel">1600-7728</dd>
                <dd>
                    <ul>
                        <li>평일 : 오전 9시 ~ 18시 30분</li>
                        <li>공휴일, 주말 : 오전 9시 ~ 17시</li>
                    </ul>
                </dd>
            </dl>
        </div>
    </div>
</section>
<!--앱나열 회사 소개 아이콘-->
<section class="company_wrap center">
    <ul>
        <li>
            <a href="http://modooplatform.co.kr/" target="_blank">
                <p><img src="/v1/image/main_N/info_mf.png" alt="모두플랫폼"></p>
                <span>회사소개</span>
            </a>
        </li>
        <li>
            <a href="http://modooclean.com/" target="_blank">
                <p><img src="/v1/image/main_N/info_mc.png" alt="청소서비스"></p>
                <span>청소서비스</span>
            </a>
        </li>
        <li>
            <a href="https://blog.naver.com/modoo24try" target="_blank">
                <p><img src="/v1/image/main_N/info_bg.png" alt="모두블로그"></p>
                <span>모플블로그</span>
            </a>
        </li>
        <li>
            <a href="https://www.facebook.com/modoomoving" target="_blank">
                <p><img src="/v1/image/main_N/info_fb.png" alt="모두페이스북"></p>
                <span>모플페이스북</span>
            </a>
        </li>
        <li>
            <a href="https://www.instagram.com/modoo24_official/" target="_blank">
                <p><img src="/v1/image/main_N/info_it" alt="모두인스타"></p>
                <span>모플인스타</span>
            </a>
        </li>
        <li>
            <a href="/v2/event">
                <p><img src="/v1/image/main_N/info_evt.png" alt="모두이벤트"></p>
                <span>모플이벤트</span>
            </a>
        </li>
        <li>
            <a href="/v1/move/review">
                <p><img src="/v1/image/main_N/info_good.png" alt="이사후기"></p>
                <span>이사후기</span>
            </a>
        </li>
        <li>
            <a href="https://pf.kakao.com/_kCylxb" target="_blank">
                <p><img src="/v1/image/main_N/info_kakao.png" alt="모플카카오"></p>
                <span>모플카카오</span>
            </a>
        </li>
    </ul>
</section>


@endsection




@section('body_bottom')
<!--토글-->
<div class="mobile" style="z-index: 900;position: fixed">
    <input type="checkbox" name="toggle" id="toggle" />
    <label for="toggle"></label>

    <div class="message">
        <form>
            <ul class="box02">
                <li><span>이사일</span>
                    <div class="move_Box">
                        <input type="text" placeholder="이사일" class="sel-datepicker" name="t_dday">
                    </div>

                </li>
                <li>
                    <span>이사종류</span>
                    <div style="display: inline-block">
                        <select class="select" name="t_kinds">
                            <option value="">이사종류</option>
                            <option value="가정">가정이사</option>
                            <option value="소형">소형이사</option>
                            <option value="사무실">사무실이사</option>
                        </select>
                    </div>
                </li>
                <li>
                    <span>고객명</span>
                    <div class="move_Box">
                        <input type="text" placeholder="고객명" name="t_name">
                    </div>
                </li>
                <li>
                    <span>연락처</span>
                    <div class="move_Box">
                        <input placeholder="번호만 입력해주세요" maxlength="12" name="t_hp">
                    </div>
                </li>
            </ul>
            <ul class="box03">
                <li>
                    <div class="checks">
                        <div class="checks etrans">
                            <input type="checkbox" id="ex_m_chk0" onclick="selectAll(this)">
                            <label for="ex_m_chk0"></label>
                            <p>
                                전체 동의
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="checks">
                        <div class="checks etrans">
                            <input type="checkbox" id="ex_m_chk2" name="simplyRegPrivacy" value="Y">
                            <label for="ex_m_chk2"></label>
                            <p class="modalpop_link" link="/new_common/popup/personal_data.html">
                                개인정보수집 및 이용에 동의(필수)
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="checks">
                        <div class="checks etrans">
                            <input type="checkbox" id="ex_m_chk3" name="simplyRegJoint" value="Y">
                            <label for="ex_m_chk3"></label>
                            <p class="modalpop_link" link="/new_common/popup/personal_3.html">
                                개인정보의 제3자 제공 동의(필수)
                            </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="checks">
                        <div class="checks etrans">
                            <input type="checkbox" id="ex_m_chk4" name="simplyMarketting" value="Y">
                            <label for="ex_m_chk4"></label>
                            <p>
                                마케팅동의
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
            <button type="button" class="btn_simply simple-reg-btn"><span class="color_yw">간편견적</span><br />신청하기</button>

        </form>
    </div>
</div>
@parent
@endsection




@section('script')
<!--간편접수 퀵메뉴-->
<script>
      let eventData = {'data' : [
      	{
      		'title': "황금열쇠이벤트",
      		'href':'https://blog.naver.com/modoo24try/222488994124',
      		'pc_image':'/v1/image/main_N/event_210923.jpg',
      		'mobile_image':'/v1/image/main_N/event_210923_m.jpg',
      		'target' : true,
      	},
      	{
      		'title': "삼성이벤트",
      		'href':'https://blog.naver.com/modoo24try/222488994124',
      		'pc_image':'/v1/image/main_N/event_ss.jpg',
      		'mobile_image':'/v1/image/main_N/event_ss_m.jpg',
      		'target' : true,
      	},
      	{
      		'title': "인터넷신청",
      		'href':'https://www.internetfriends.co.kr/index.php?s1=modoo24_event&action=reg&utm_source=modoo24&utm_medium=partner&utm_campaign=landing&utm_content=modoo24-2021-01-22',
      		'pc_image':'/v1/image/main_N/event_it.jpg',
      		'mobile_image':'/v1/image/main_N/event_it_m.jpg',
      		'target' : true,
      	},
      ]}
    $(document).ready(function() {
        // 기존 css에서 플로팅 배너 위치(top)값을 가져와 저장한다.
        var floatPosition = parseInt($("#simpleorder").css('top'));
        // 250px 이런식으로 가져오므로 여기서 숫자만 가져온다. parseInt( 값 );

        $(window).scroll(function() {
            // 현재 스크롤 위치를 가져온다.
            var scrollTop = $(window).scrollTop();
            var newPosition = scrollTop + floatPosition + "px";

            /* 애니메이션 없이 바로 따라감
            $("#simpleorder").css('top', newPosition);
            */
            $("#simpleorder").stop().animate({
                "top": newPosition
            }, 500);
        }).scroll();
    });
    //

</script>
<!--//간편접수 퀵메뉴-->

@endsection
