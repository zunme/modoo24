
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta property="og:title" content="모두이사" />
    <meta property="og:site_name" content="모두이사" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://modoo24.net" />
    <meta property="og:description" content="이사할땐 모두이사" />
    <meta name="format-detection" content="telephone=no, address=no, email=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>모두이사</title>

    <link rel="shortcut icon" href="../modoo24.ico">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">


    <!--부트스크랩메뉴-->

    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!--//부트스크랩메뉴-->
    

	<!-- -->
	<style>
		@font-face {
				font-family: 'GmarketSansMedium';
				src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_2001@1.1/GmarketSansMedium.woff') format('woff');
				font-weight: normal;
				font-style: normal;
		}
		@font-face {
    font-family: 'GmarketSansLight';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_2001@1.1/GmarketSansLight.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}
		@font-face {
    font-family: 'GmarketSansBold';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_2001@1.1/GmarketSansBold.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="/community/assets/js/handlebars.js"></script>
	<!-- date picker -->
	<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ko.min.js" integrity="sha512-L4qpL1ZotXZLLe8Oo0ZyHrj/SweV7CieswUODAAPN/tnqN3PA1P+4qPu5vIryNor6HQ5o22NujIcAZIfyVXwbQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- sweetalert -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- toast -->
	<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js" integrity="sha256-321PxS+POvbvWcIVoRZeRmf32q7fTFQJ21bXwTNWREY=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/community/assets/stisla/node_modules/izitoast/dist/css/iziToast.min.css">
	<!-- swiper -->
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
	<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>	
	
	<script src="/community/newmain.js"></script>
	<style>
		.datepicker-title{text-align:right !important;}
		.div-sonclass{
			display:flex;
			justify-content: end;
		}
		.span-sonclass-title{
			font-size : 10px !important;
			padding-top: 2px;
		}
		.span-sonclass {
			display:inline-block;
			width: 16px;height:16px;
				background-color: rgb(91 192 222 / 41%);
			border-radius: 50px !important;
			font-size : 10px !important;
		}
		.son-active{
			background-color: rgb(91 192 222 / 41%);
			border-radius: 50px !important;
		}
		.simplyregSuccessWrap, .loaderWrap{
				position: absolute;
				top: 0;
				bottom: 0;
				right: 0;
				left: 0;
				background-color: #66666673;
				display: flex;
				justify-content: center;
		}
		.simplyregSuccessinner, .loaderWrapInner{
    display: flex;
		}
		.simplyregSuccessinner > span{
			    margin: auto;
    display: block;
    width: 300px;
    text-align: center;
    background-color: white;
    height: 60px;
    line-height: 60px;
    border-radius: 10px;
    box-shadow: 0 3px 8px 0 rgb(0 0 0 / 60%);
    font-weight: 800;
    font-size: 16px;
		}
	</style>
	<!-- / -->
    

    <link rel="stylesheet" type="text/css" href="/NEW/css/main_ct.css" />
    <link rel="stylesheet" type="text/css" href="/NEW/css/menu.css" />
    <link rel="stylesheet" type="text/css" href="/NEW/css/common.css" />
    <link rel="stylesheet" type="text/css" href="/NEW/css/font.css" />
    <link rel="stylesheet" type="text/css" href="/NEW/css/main_popup.css" />
</head>

<body>
    <!--날개배너-->
    <div id="simpleorder" class="banner_right_box pc" style="z-index: 9;top: 190px;">
        <img src="/NEW/image/main_N/wing_banner.jpg" alt="날개배너">
    </div>
    <!--//날개배너-->

    <header class="pc center" id="menu_wrap">
        <div class="menu_floor01">
            <a class="logoN" href="/"><img src="/NEW/image/main_N/logo.png"><span>모두이사</span></a>
            <ul class="menu01">
                <li><a>비대면견적</a></li>
                <li><a>방문견적</a></li>
                <li><a>커뮤니티 <span>+</span></a></li>
            </ul>
            <div class="btn_know">
                <p class="color_pt"><b>이사지식인</b></p>
                <button type="button" class="btn_question">질문하기</button>
            </div>
            <a class="clean_fast" href="http://www.modooclean.com/" target="_blank">
                <p class="clean01"><b>입주청소</b></p>
                <p class="clean02"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z" fill="rgba(197,197,197,1)" />
                    </svg></p>
                <p class="clean03"><b>모두클린</b><span><img src="/NEW/image/main_N/clean_icon.png"></span></p>
            </a>
        </div>
        <div class="menu_floor02">
            <ul class="menu_main">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">모두이사<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/front/modoo_service">서비스소개</a></li>
                        <li><a href="/front/modoo_service">방문견적 가이드</a></li>
                        <li><a href="/front/modoo_service">비대면견적 가이드</a></li>
                    </ul>
                </li>
                <li>업체평가하기</li>
                <li>칭찬후기</li>
                <li>고객센터 +</li>
            </ul>
            <ul class="menu_tip">
                <li><a class="color_blue"><span class="glyphicon glyphicon-list-alt"></span> 신청내역</a></li>
                <li><a class="color_pt"><span class="glyphicon glyphicon-paperclip"></span> 생활꿀TIP</a></li>
                <li><a class="color_pt"><span class="glyphicon glyphicon-gift"></span> 이벤트</a></li>
                <li><a class="color_bk" href="tel:16007728">고객센터 1600-7728</a></li>
            </ul>
        </div>

    </header>


    <div class="mobile">
        <nav class="navbar navbar-inverse"  id="blue_menu_wrap">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="border:0; float: left">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/" style="padding: 15px 0;">
                        <img src="/NEW/image/main_N/logo_w.png" width="40" class="d-inline-block align-top" alt="모두이사">
                    </a>
                    <div class="mtop_btn_set">
                        <button type="button" class="btn_top_m">비대면견적</button>
                        <button type="button" class="btn_top_m">방문견적</button>
                    </div>
                    
                    <a class="right" href="tel:1600-7728" style="top: 10px;right: 10px;position: absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M21 16.42v3.536a1 1 0 0 1-.93.998c-.437.03-.794.046-1.07.046-8.837 0-16-7.163-16-16 0-.276.015-.633.046-1.07A1 1 0 0 1 4.044 3H7.58a.5.5 0 0 1 .498.45c.023.23.044.413.064.552A13.901 13.901 0 0 0 9.35 8.003c.095.2.033.439-.147.567l-2.158 1.542a13.047 13.047 0 0 0 6.844 6.844l1.54-2.154a.462.462 0 0 1 .573-.149 13.901 13.901 0 0 0 4 1.205c.139.02.322.042.55.064a.5.5 0 0 1 .449.498z" fill="rgba(255,255,255,1)"/></svg>
                    </a>    

                </div>
                <div class="collapse navbar-collapse" id="myNavbar" style="color: #fff">
                    <ul class="nav navbar-nav">
                        <li class="active" style="display: none"><a href="#">Home</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">모두이사<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/front/modoo_service">서비스소개</a></li>
                                <li><a href="/front/modoo_service">방문견적 가이드</a></li>
                                <li><a href="/front/modoo_service">비대면견적 가이드</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">모두소식<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">이벤트</a></li>
                                <li><a href="/front/custom_notice">공지사항</a></li>
                                <li><a href="/front/modoo_info">이사/생활정보</a></li>
                            </ul>
                        </li>
                        <li><a href="https://www.internetfriends.co.kr/index.php?s1=modoo24_event&action=reg&utm_source=modoo24&utm_medium=partner&utm_campaign=landing&utm_content=modoo24-2021-01-22" target="_blank">이사인터넷 설치</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">커뮤니티<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">생활꿀TIP</a></li>
                                <li><a href="#">모두FUN</a></li>
                                <li><a href="#">이사가기 좋은집</a></li>
                                <li><a href="#">우리동네가 좋아요</a></li>
                            </ul>
                        </li>
                        <li><a href="#">이사지식인</a></li>
                        <li><a href="/front/custom_review">칭찬후기</a></li>
                        <li><a href="#">업체평가하기</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">고객센터<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/front/mem_apply?mode=my_request">신청내역</a></li>
                                <li><a href="/front/custom_faq">자주묻는질문</a></li>
                                <li><a href="/front/custom_business?cmd=setup_form">파트너제휴</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul style="display: none" class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> 회원가입</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> 로그인</a></li>
                    </ul>
                </div>
            </div>

        </nav>
        <div id="m_menu_wrap">
            <div class="m_floor2">
                <ul class="left_menu">
                    <li><a class="color_pt">이사</a></li>
                    <li><a href="http://modooclean.com/" target="_blank">청소</a></li>
                </ul>
                <ul class="right_menu">
                    <li><a><b>커뮤니티 +</b></a></li>
                    <li>
                        <a><b>이사지식인</b></a>
                    </li>
                    <li> <button type="button" class="btn_question" style="display: inline-block">질문하기</button></li>
                </ul>
            </div>
            <ul class="m_floor3">
                <li><a href="/front/custom_review">칭찬후기</a></li>
                <li><a>생활꿀TIP</a></li>
                <li><a>이벤트</a></li>
                <li><a href="/front/mem_apply?mode=my_request"><b>신청내역</b></a></li>
            </ul>
        </div>
    </div>

    <!--메인배너-->
    <section id="banner_visual" class="center">
        <ul>
            <li>
                <a class="pc" href><img src="/NEW/image/main_N/main_bn01.png"></a>
                <a class="mobile" href><img src="/NEW/image/main_N/main_m_bn01.png"></a>
                <button type="button" class="btn_untact mobile" style="width:100%; margin-top:10px"><b>비대면 견적 </b>가이드</button>
            </li>
            <li>
                <a class="pc"><img src="/NEW/image/main_N/main_bn02.png"></a>
                <a class="mobile"><img src="/NEW/image/main_N/main_m_bn02.png"></a>
                <button type="button" class="btn_contact mobile" style="width:100%;margin-top:10px"><b>방문 견적 </b>가이드</button>
            </li>
            <li class="pc">
                <a href="http://modooclean.com/" target="_blank"><img src="/NEW/image/main_N/main_bn03.png"></a>
            </li>
        </ul>
        <div class="row" style="display:none">
            <div class="col-md-4 col-sm-6"><img src="/NEW/image/main_N/main_bn01.png"></div>
            <div class="col-md-4 col-sm-6"><img src="/NEW/image/main_N/main_bn02.png"></div>
            <div class="col-md-4 col-sm-6 pc"><a href="http://modooclean.com/" target="_blank"><img src="/NEW/image/main_N/main_bn03.png"></a></div>

        </div>
    </section>
    <!--pc간편견적-->
    <section id="simply_move" class="center pc">
        <div class="box01">
            <h2><span class="color_pt">간편</span> 이사견적</h2>
            <p>간단한 정보 입력과 동의로
                이사견적 신청 완료
            </p>
        </div>
        <ul class="box02" id="simplyReg">
            <li><span>이사일</span>
                <div class="move_Box">
                    <input type="text" placeholder="이사일" name="t_dday">
                </div>

            </li>
            <li>
                <span>이사종류</span>
                <div class="move_Box">
                    <select name="t_kinds">
											<option value="">이사종류</option>
											<option value='소형'>소형</option>
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
                    <input placeholder="번호만 입력해주세요" maxlength="11" name="t_hp">
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
                            전체 동의(필수동의)
                        </p>
                    </div>
                </div>
            </li>
            <li>
                <div class="checks">
                    <div class="checks etrans">
                        <input type="checkbox" id="ex_chk2" onclick="selectAll(this)" name="simplyRegPrivacy" value="Y">
                        <label for="ex_chk2"></label>
                        <p>
                            개인정보수집 및 이용에 동의 보기
                        </p>
                    </div>
                </div>
            </li>
            <li>
                <div class="checks">
                    <div class="checks etrans">
                        <input type="checkbox" id="ex_chk3" onclick="selectAll(this)" name="simplyRegJoint" value="Y">
                        <label for="ex_chk3"></label>
                        <p>
                            개인정보의 제3자 제공 동의 보기
                        </p>
                    </div>
                </div>
            </li>
        </ul>
        <button type="button" class="btn_simply" onClick="simplyReg()"><span class="color_yw">간편견적</span><br />신청하기</button>
    </section>
    <!--견적가이드-->
    <section class="center move_kind pc">
        <div class="left_Box">
            <h2 class="color_pt">무료 비대면 견적</h2>
            <h4>이사짐 체크와 사진으로 간편하게 집에서 이사견적을 받아보세요</h4>
            <p class="txt">24시간 동안 최대 10개 업체의 꼼꼼한 이사 견적을 제안 드립니다.</p>
            <button type="button" class="btn btn-info"><b>비대면 견적 </b>가이드</button>
            <p class="img"><img src="/NEW/image/main_N/untact_info.jpg" alt="비대면 견적 가이드"></p>
        </div>
        <div class="right_Box">
            <h2 class="color_blue">무료 방문 견적</h2>
            <h3>파트너 업체의 직접 방문을 통해 정확한 이사 견적을 제안 드립니다. </h3>
            <button type="button" class="btn btn-primary"><b>방문 견적 </b>가이드</button>
            <p class="img"><img src="/NEW/image/main_N/tact_info.jpg" alt="비대면 견적 가이드"></p>
        </div>
    </section>
    <!--이벤트-->
    <section class="center event_wrap">
        <a href="https://blog.naver.com/modoo24try/222488994124" target="_blank">
            <img src="/NEW/image/main_N/event_210923.jpg" class="pc" alt="황금열쇠이벤트">
            <img src="/NEW/image/main_N/event_210923_m.jpg" class="mobile" alt="황금열쇠이벤트">
        </a>
    </section>

	
	    <section class="center event_wrap">
        <a href="https://blog.naver.com/modoo24try/222488994124" target="_blank">
            <img src="/NEW/image/main_N/event_210923.jpg" class="pc" alt="황금열쇠이벤트">
            <img src="/NEW/image/main_N/event_210923_m.jpg" class="mobile" alt="황금열쇠이벤트">
        </a>
    </section>


    <!--칭찬후기 슬라이드-->
    
    <script type="text/javascript">
        /*! responsiveCarousel.JS - v1.2.0
         * http://basilio.github.com/responsiveCarousel
         *
         * Copyright (c) 2013 Basilio C‡ceres <basilio.caceres@gmail.com>;
         * Licensed under the MIT license */
        (function(e) {
            "use strict";
            e.fn.carousel = function(t) {
                var n, r;
                n = {
                    infinite: true,
                    visible: 1,
                    speed: "fast",
                    overflow: false,
                    autoRotate: false,
                    navigation: e(this).data("navigation"),
                    itemMinWidth: 0,
                    itemEqualHeight: false,
                    itemMargin: 0,
                    itemClassActive: "crsl-active",
                    imageWideClass: "wide-image",
                    carousel: true
                };
                return e(this).each(function() {
                    r = e(this);
                    if (e.isEmptyObject(t) === false) e.extend(n, t);
                    if (e.isEmptyObject(e(r).data("crsl")) === false) e.extend(n, e(r).data("crsl"));
                    n.isTouch = "ontouchstart" in document.documentElement || navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i) ? true : false;
                    r.init = function() {
                        n.total = e(r).find(".crsl-item").length;
                        n.itemWidth = e(r).outerWidth();
                        n.visibleDefault = n.visible;
                        n.swipeDistance = null;
                        n.swipeMinDistance = 100;
                        n.startCoords = {};
                        n.endCoords = {};
                        e(r).css({
                            width: "100%"
                        });
                        e(r).find(".crsl-item").css({
                            position: "relative",
                            "float": "left",
                            overflow: "hidden"
                        });
                        e(r).find("." + n.imageWideClass).each(function() {
                            e(this).css({
                                display: "block",
                                width: "100%",
                                height: "auto"
                            })
                        });
                        e(r).find(".crsl-item iframe").attr({
                            width: "100%"
                        });
                        if (n.carousel) e(r).find(".crsl-item:first-child").addClass(n.itemClassActive);
                        if (n.carousel && n.infinite && n.visible < n.total) e(r).find(".crsl-item:first-child").before(e(".crsl-item:last-child", r));
                        if (n.overflow === false) {
                            e(r).css({
                                overflow: "hidden"
                            })
                        } else {
                            e("html, body").css({
                                "overflow-x": "hidden"
                            })
                        }
                        e(r).trigger("initCarousel", [n, r]);
                        r.testPreload();
                        r.config();
                        r.initRotate();
                        r.triggerNavs()
                    };
                    r.testPreload = function() {
                        if (e(r).find("img").length > 0) {
                            var t = e(r).find("img").length,
                                i = 1;
                            e(r).find("img").each(function() {
                                r.preloadImage(this, i, t);
                                i++
                            })
                        } else {
                            e(r).trigger("loadedCarousel", [n, r])
                        }
                    };
                    r.preloadImage = function(t, i, s) {
                        var o = new Image,
                            u = {};
                        u.src = e(t).attr("src") !== undefined ? t.src : "";
                        u.alt = e(t).attr("alt") !== undefined ? t.alt : "";
                        e(o).attr(u);
                        e(o).on("load", function() {
                            if (i === 1) e(r).trigger("loadingImagesCarousel", [n, r]);
                            if (i === s) e(r).trigger("loadedImagesCarousel", [n, r])
                        })
                    };
                    r.config = function() {
                        n.itemWidth = Math.floor((e(r).outerWidth() - n.itemMargin * (n.visibleDefault - 1)) / n.visibleDefault);
                        if (n.itemWidth <= n.itemMinWidth) {
                            n.visible = Math.floor((e(r).outerWidth() - n.itemMargin * (n.visible - 1)) / n.itemMinWidth) === 1 ? Math.floor(e(r).outerWidth() / n.itemMinWidth) : Math.floor((e(r).outerWidth() - n.itemMargin) / n.itemMinWidth);
                            n.visible = n.visible < 1 ? 1 : n.visible;
                            n.itemWidth = n.visible === 1 ? Math.floor(e(r).outerWidth()) : Math.floor((e(r).outerWidth() - n.itemMargin * (n.visible - 1)) / n.visible)
                        } else {
                            n.visible = n.visibleDefault
                        }
                        if (n.carousel) {
                            r.wrapWidth = Math.floor((n.itemWidth + n.itemMargin) * n.total);
                            r.wrapMargin = r.wrapMarginDefault = n.infinite && n.visible < n.total ? parseInt((n.itemWidth + n.itemMargin) * -1, 10) : 0;
                            if (n.infinite && n.visible < n.total && e(r).find(".crsl-item." + n.itemClassActive).index() === 0) {
                                e(r).find(".crsl-item:first-child").before(e(".crsl-item:last-child", r));
                                r.wrapMargin = r.wrapMarginDefault = parseInt((n.itemWidth + n.itemMargin) * -1, 10)
                            }
                            e(r).find(".crsl-wrap").css({
                                width: r.wrapWidth + "px",
                                marginLeft: r.wrapMargin
                            })
                        } else {
                            r.wrapWidth = e(r).outerWidth();
                            e(r).find(".crsl-wrap").css({
                                width: r.wrapWidth + n.itemMargin + "px"
                            });
                            e("#" + n.navigation).hide()
                        }
                        e(r).find(".crsl-item").css({
                            width: n.itemWidth + "px",
                            marginRight: n.itemMargin + "px"
                        });
                        r.equalHeights();
                        if (n.carousel) {
                            if (n.visible >= n.total) {
                                n.autoRotate = false;
                                e("#" + n.navigation).hide()
                            } else {
                                e("#" + n.navigation).show()
                            }
                        }
                    };
                    r.equalHeights = function() {
                        if (n.itemEqualHeight !== false) {
                            var t = 0;
                            e(r).find(".crsl-item").each(function() {
                                e(this).css({
                                    height: "auto"
                                });
                                if (e(this).outerHeight() > t) {
                                    t = e(this).outerHeight()
                                }
                            });
                            e(r).find(".crsl-item").css({
                                height: t + "px"
                            })
                        }
                        return true
                    };
                    r.initRotate = function() {
                        if (n.autoRotate !== false) {
                            r.rotateTime = window.setInterval(function() {
                                r.rotate()
                            }, n.autoRotate)
                        }
                    };
                    r.triggerNavs = function() {
                        e("#" + n.navigation).delegate(".previous, .next", "click", function(t) {
                            t.preventDefault();
                            r.prepareExecute();
                            if (e(this).hasClass("previous") && r.testPrevious(r.itemActive)) {
                                r.previous()
                            } else if (e(this).hasClass("next") && r.testNext()) {
                                r.next()
                            } else {
                                return
                            }
                        })
                    };
                    r.prepareExecute = function() {
                        if (n.autoRotate) {
                            clearInterval(r.rotateTime)
                        }
                        r.preventAnimateEvent();
                        r.itemActive = e(r).find(".crsl-item." + n.itemClassActive);
                        return true
                    };
                    r.preventAnimateEvent = function() {
                        if (e(r).find(".crsl-wrap:animated").length > 0) {
                            return false
                        }
                    };
                    r.rotate = function() {
                        r.preventAnimateEvent();
                        r.itemActive = e(r).find(".crsl-item." + n.itemClassActive);
                        r.next();
                        return true
                    };
                    r.testPrevious = function(t) {
                        return e(".crsl-wrap", r).find(".crsl-item").index(t) > 0
                    };
                    r.testNext = function() {
                        return !n.infinite && r.wrapWidth >= (n.itemWidth + n.itemMargin) * (n.visible + 1) - r.wrapMargin || n.infinite
                    };
                    r.previous = function() {
                        r.wrapMargin = n.infinite ? r.wrapMarginDefault + e(r.itemActive).outerWidth(true) : r.wrapMargin + e(r.itemActive).outerWidth(true);
                        var t = e(r.itemActive).index();
                        var i = e(r.itemActive).prev(".crsl-item");
                        var s = "previous";
                        e(r).trigger("beginCarousel", [n, r, s]);
                        e(r).find(".crsl-wrap").animate({
                            marginLeft: r.wrapMargin + "px"
                        }, n.speed, function() {
                            e(r.itemActive).removeClass(n.itemClassActive);
                            e(i).addClass(n.itemClassActive);
                            if (n.infinite) {
                                e(this).css({
                                    marginLeft: r.wrapMarginDefault
                                }).find(".crsl-item:first-child").before(e(".crsl-item:last-child", r))
                            } else {
                                if (r.testPrevious(i) === false) e("#" + n.navigation).find(".previous").addClass("previous-inactive");
                                if (r.testNext()) e("#" + n.navigation).find(".next").removeClass("next-inactive")
                            }
                            e(this).trigger("endCarousel", [n, r, s])
                        })
                    };
                    r.next = function() {
                        r.wrapMargin = n.infinite ? r.wrapMarginDefault - e(r.itemActive).outerWidth(true) : r.wrapMargin - e(r.itemActive).outerWidth(true);
                        var t = e(r.itemActive).index();
                        var i = e(r.itemActive).next(".crsl-item");
                        var s = "next";
                        e(r).trigger("beginCarousel", [n, r, s]);
                        e(r).find(".crsl-wrap").animate({
                            marginLeft: r.wrapMargin + "px"
                        }, n.speed, function() {
                            e(r.itemActive).removeClass(n.itemClassActive);
                            e(i).addClass(n.itemClassActive);
                            if (n.infinite) {
                                e(this).css({
                                    marginLeft: r.wrapMarginDefault
                                }).find(".crsl-item:last-child").after(e(".crsl-item:first-child", r))
                            } else {
                                if (r.testPrevious(i)) e("#" + n.navigation).find(".previous").removeClass("previous-inactive");
                                if (r.testNext() === false) e("#" + n.navigation).find(".next").addClass("next-inactive")
                            }
                            e(this).trigger("endCarousel", [n, r, s])
                        })
                    };
                    var i = false,
                        s;
                    e(window).on("mouseleave", function(t) {
                        if (t.target) s = t.target;
                        else if (t.srcElement) s = t.srcElement;
                        if (e(r).attr("id") && e(s).parents(".crsl-items").attr("id") === e(r).attr("id") || e(s).parents(".crsl-items").data("navigation") === e(r).data("navigation")) {
                            i = true
                        } else {
                            i = false
                        }
                        return false
                    });
                    e(window).on("keydown", function(e) {
                        if (i === true) {
                            if (e.keyCode === 37) {
                                r.prepareExecute();
                                r.previous()
                            } else if (e.keyCode === 39) {
                                r.prepareExecute();
                                r.next()
                            }
                        }
                        return
                    });
                    if (n.isTouch) {
                        e(r).on("touchstart", function(t) {
                            e(r).addClass("touching");
                            n.startCoords = t.originalEvent.targetTouches[0];
                            n.endCoords = t.originalEvent.targetTouches[0];
                            e(".touching").on("touchmove", function(e) {
                                n.endCoords = e.originalEvent.targetTouches[0];
                                if (Math.abs(parseInt(n.endCoords.pageX - n.startCoords.pageX, 10)) > Math.abs(parseInt(n.endCoords.pageY - n.startCoords.pageY, 10))) {
                                    e.preventDefault();
                                    e.stopPropagation()
                                }
                            })
                        }).on("touchend", function(t) {
                            t.preventDefault();
                            t.stopPropagation();
                            n.swipeDistance = n.endCoords.pageX - n.startCoords.pageX;
                            if (n.swipeDistance >= n.swipeMinDistance) {
                                r.previous()
                            } else if (n.swipeDistance <= -n.swipeMinDistance) {
                                r.next()
                            }
                            e(".touching").off("touchmove").removeClass("touching")
                        })
                    }
                    e(r).on("loadedCarousel loadedImagesCarousel", function() {
                        r.equalHeights()
                    });
                    e(window).on("carouselResizeEnd", function() {
                        if (n.itemWidth !== e(r).outerWidth()) r.config()
                    });
                    e(window).ready(function() {
                        e(r).trigger("prepareCarousel", [n, r]);
                        r.init();
                        e(window).on("resize", function() {
                            if (this.carouselResizeTo) clearTimeout(this.carouselResizeTo);
                            this.carouselResizeTo = setTimeout(function() {
                                e(this).trigger("carouselResizeEnd")
                            }, 10)
                        })
                    });
                    e(window).load(function() {
                        r.testPreload();
                        r.config()
                    })
                })
            }
        })(jQuery)
    </script>
    <!--//칭찬후기 슬라이드-->


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

            <h2 class="gd_title">모두이사 고객 <span class="color_pt">칭찬 후기</span></h2>
            <a class="more" href="/front/custom_review">후기 더보기 + </a>


            <div class="crsl-items" data-navigation="navbtns" style="width: 100%; overflow: hidden;">
                <div class="crsl-wrap" onclick="location.href='/front/custom_review' " style="cursor: pointer; width: 1135px; margin-left: -227px;">


                    <div class="crsl-item" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
                        <a class="review" href="/front/custom_review" style="display: block">
                            <h3>all익스프레스</h3>
                            <h4>(우수업체)</h4>
                            <dl>
                                <dt><img src="/NEW/image/main_N/big_star.png" alt="star"></dt>
                                <dd>
                                    <span class="num">4.0</span>
                                    <span class="numtxt">전체 누적 평점</span>
                                </dd>
                            </dl>
                            <p class="review_txt">고생하셨습니다. 글을 많이 쓴다면 어떤일이 벌어질까요? 깜짝 놀랄일이 짜자자자잔</p>
                            <span class="review_date">이사일 2020-11-20</span>
                        </a>
                    </div>
                    <div class="crsl-item crsl-active" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
                        <a class="review" href="/front/custom_review" style="display: block">
                            <h3>피카츄이사</h3>
                            <h4>(최우수업체)</h4>
                            <dl>
                                <dt><img src="/NEW/image/main_N/big_star.png" alt="star"></dt>
                                <dd>
                                    <span class="num">4.0</span>
                                    <span class="numtxt">전체 누적 평점</span>
                                </dd>
                            </dl>
                            <p class="review_txt">고생하셨습니다. 글을 많이 쓴다면 어떤일이 벌어질까요? 깜짝 놀랄일이 짜자자자잔</p>
                            <span class="review_date">이사일 2020-11-20</span>
                        </a>
                    </div>

                    <div class="crsl-item" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
                        <a class="review" href="/front/custom_review" style="display: block">
                            <h3>이사공간</h3>
                            <h4>(우수업체)</h4>
                            <dl>
                                <dt><img src="/NEW/image/main_N/big_star.png" alt="star"></dt>
                                <dd>
                                    <span class="num">4.5</span>
                                    <span class="numtxt">전체 누적 평점</span>
                                </dd>
                            </dl>
                            <p class="review_txt">고생하셨습니다. 두줄로 제안합시다.</p>
                            <span class="review_date">이사일 2020-11-20</span>
                        </a>
                    </div>

                    <div class="crsl-item" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
                        <a class="review" href="/front/custom_review" style="display: block">
                            <h3>우리모두옮겨</h3>
                            <h4>(우수업체)</h4>
                            <dl>
                                <dt><img src="/NEW/image/main_N/big_star.png" alt="star"></dt>
                                <dd>
                                    <span class="num">4.0</span>
                                    <span class="numtxt">전체 누적 평점</span>
                                </dd>
                            </dl>
                            <p class="review_txt">고생하셨습니다. 글을 많이 쓴다면 어떤일이 벌어질까요? 깜짝 놀랄일이 짜자자자잔</p>
                            <span class="review_date">이사일 2020-11-20</span>
                        </a>
                    </div>

                    <div class="crsl-item" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
                        <a class="review" href="/front/custom_review" style="display: block">
                            <h3>밍밍이이사업체</h3>
                            <h4>(우수업체)</h4>
                            <dl>
                                <dt><img src="/NEW/image/main_N/big_star.png" alt="star"></dt>
                                <dd>
                                    <span class="num">4.0</span>
                                    <span class="numtxt">전체 누적 평점</span>
                                </dd>
                            </dl>
                            <p class="review_txt">고생하셨습니다. 글을 많이 쓴다면 어떤일이 벌어질까요? 깜짝 놀랄일이 짜자자자잔</p>
                            <span class="review_date">이사일 2020-11-20</span>
                        </a>
                    </div>



                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function() {
                $('.crsl-items').carousel({
                    visible: 4,
                    itemMinWidth: 200,
                    itemEqualHeight: 200,
                    itemMargin: 5,
                });

                $("a[href=#]").on('click', function(e) {
                    e.preventDefault();
                });
            });
        </script>
			
			
<!-- swiper ver -->
<div class="modal" tabindex="-1" role="dialog" id="detailModal">
  <div class="modal-dialog" id="detailModal_content" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div>
					<div>
						이사일 2021-09-21
					</div>
					
					<button type="button" class="close abs-top" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					
				</div>
      </div>
      <div class="modal-body">
        	<div>
						<span class="modal-review-company-title">[최우수업체]</span>
						<span class="modal-review-company">주원토탈무빙</span>
					</div>
					<div class="modal-review-star_wrap">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
						<i class="far fa-star"></i>
						<span class="modal-review-point-total">4.8</span>
					</div>
				
					<div class="row modal-review-points_wrap">
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">전문성</div>
								<div class="s-col modal-review-point-row-pointwrap">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<i class="far fa-star"></i>
								</div>								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">친절성</div>
								<div class="s-col modal-review-point-row-pointwrap">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<i class="far fa-star"></i>
								</div>								
							</div>
						</div>
					</div>
					<div class="row modal-review-points_wrap">
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">가격도</div>
								<div class="s-col modal-review-point-row-pointwrap">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<i class="far fa-star"></i>
								</div>								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">마무리</div>
								<div class="s-col modal-review-point-row-pointwrap">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<i class="far fa-star"></i>
								</div>								
							</div>
						</div>
					</div>
					<div class="row modal-review-points_wrap">
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">사후관리</div>
								<div class="s-col modal-review-point-row-pointwrap">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<i class="far fa-star"></i>
								</div>								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">포장도</div>
								<div class="s-col modal-review-point-row-pointwrap">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<i class="far fa-star"></i>
								</div>								
							</div>
						</div>
					</div>
				
				<div class="modal-review-contents-wrap">
					<div class="modal-review-contents">
						123123132
					</div>
				</div>
				
      </div>
			
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>
			<style>
				.swiper-button-next, .swiper-button-prev {
							box-shadow: 1px 2px 5px 0 rgb(0 0 0 / 32%);
							background-color: rgb(170 170 170 / 15%);
							border-radius: 5px;
							color:black;
					}
				.modal-header .close.abs-top {
						margin-top: -2px;
						position: absolute;
						top: 14px;
						right: 14px;
				}
				.s-col{
					position: relative;
					min-height: 1px;
					padding-right: 15px;
					padding-left: 15px;
					float: left;
				}
				.modal-review-point-row-title{
					min-width: 94px;
				}
				.move_review_more_wrap{
					    text-align: right;
							padding: 10px;
							margin-bottom: 10px;
					margin-top: 10px;
				}
				.swiper-button-next:after, .swiper-button-prev:after {
						font-family: swiper-icons;
						font-size: 30px;
						font-weight: bold;
				}
				#move_review_slider{
					height : 410px;
					width: 100%;
					overflow-x: hidden;
				}
				.move_review_item_inner{
					padding: 34px 25px 0;
					background-color: white;
					display: flex;
					flex-direction: column;
					height: 350px;
					/* justify-content: space-between; */
					border-radius: 10px;
					box-shadow: 0 3px 8px 0 rgb(0 0 0 / 32%);
				}
				.move_review_item_header{
					text-align: center;
					margin-bottom: 20px;
				}
				.move_review_item_header h3{
					display: block;
    			padding-bottom: 5px;
				  white-space: nowrap;
					overflow: hidden;
					text-overflow: ellipsis;
				}
				.move_review_item_star_wrap {
					display:flex;
					justify-content: center;
				}
				
				.move_review_item_point_wrap{
					display: flex;
					/* justify-content: center; */
					flex-direction: column;
					margin-left: 10px;
				}
				.move_review_item_point{
					font-size: 38px;
					line-height: 38px;
					text-align: center;
				}
				.move_review_item_point_desc{
					font-size: 12px;
				}
				.move_review_item_txt{
					padding: 20px 10px 10px;
					max-height: 136px;
					font-size: 16px;
					height: 140px;
					word-break: break-all;
					overflow: hidden;
					text-overflow: ellipsis;
					display: -webkit-box;
					-webkit-box-orient: vertical;
					-webkit-line-clamp: 5;
					line-height: 23px;
				}
				.move_review_item_date{
					text-align: right;
					padding: 5px 20px 0;
					font-size: 12px;
					color: #6a6a6a;
				}
				.modal-review-contents{
					max-height: 25vh;
    			overflow-y: auto;
				}
				
				#event_swiper > .swiper-wrapper > .swiper-slide img{
					width:100%;
				}
			</style>
			<div class="center">
				<h2 class="gd_title">모두이사 고객 <span class="color_pt">칭찬 후기</span></h2>
				<div class="move_review_more_wrap">
					<a class="moreV2" href="/front/custom_review">후기 더보기 + </a>	
				</div>
				
				<div class="" id="move_review_slider">
					<!--div class="swiper-wrapper">
						
						<div class="swiper-slide move_review_item">
							<div href="/" class="move_review_item_inner" onClick="viewReview(this)">
								<div class="move_review_item_header">
									<h3>all익스프레스</h3>
									<h4>(최우수업체)</h4>
								</div>
								<div class="move_review_item_star_wrap">
									<div class="move_review_item_star">
										<img src="/NEW/image/main_N/big_star.png" alt="star">
									</div>
									<div class="move_review_item_point_wrap">
										<div class="move_review_item_point">
											4.0
										</div>
										<div class="move_review_item_point_desc">
											전체 누적 평점
										</div>
									</div>
								</div>
								<div class="move_review_item_txt">
									고생하셨습니다. 글을 많이 쓴다면 어떤일이 벌어질까요? 깜짝 놀랄일이 짜자자자잔<br>
									고생하셨습니다. 글을 많이 쓴다면 어떤일이 벌어질까요?<br> 깜짝 놀랄일이 짜자자자잔
								</div>
								<div class="move_review_item_date">
									이사일 2020-11-20
								</div>								
							</div>
						</div>
						


					</div-->
					<div class="swiper-button-next"></div>
      		<div class="swiper-button-prev"></div>
				</div>
			</div>
			<!-- / swiper ver -->
    </section>

	    <!--이벤트 swiper-->
    <section class="center_event_wrap swiper_event_wrap" >
			<div id="event_swiper" style="position:relative;">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<a href="https://blog.naver.com/modoo24try/222488994124" target="_blank">
								<img src="/NEW/image/main_N/event_210923.jpg" class="pc" alt="황금열쇠이벤트">
								<img src="/NEW/image/main_N/event_210923_m.jpg" class="mobile" alt="황금열쇠이벤트">
						</a>
					</div>
					<div class="swiper-slide">
						<a href="https://blog.naver.com/modoo24try/222488994124" target="_blank">
								<img src="/NEW/image/main_N/event_210923.jpg" class="pc" alt="황금열쇠이벤트">
								<img src="/NEW/image/main_N/event_210923_m.jpg" class="mobile" alt="황금열쇠이벤트">
						</a>
					</div>
				</div>
				
					<div class="swiper-button-next"></div>
      		<div class="swiper-button-prev"></div>
				<div class="swiper-pagination"></div>
			</div>
										
        
    </section>



    <!--지식인검색-->
    <section class="center search_wrap">
        <div class="left_box">
            <i><img src="/NEW/image/main_N/icon_truck.png" alt="이사지식인아이콘"></i>
            <h5>
                <span class="color_pt">이사지식인</span> 검색
            </h5>
            <div class="search_Box">
                <input type="text" placeholder="이사지식인검색">
                <label></label>
                <a class="btn_form">검색</a>
            </div>
        </div>
        <div class="mobile know_m_info">
            <h4><b>이사 지식인<span class="plus color_pt">+</span></b></h4>
            <div>
                이사에 대한 궁금한 사항을 모두이사
                파트너업체가 답변해 드립니다.
            </div>
            <p><img src="/NEW/image/main_N/icon_qna.png" alt="qna"></p>
            <button type="button" class="btn_question">
                자세히보기
            </button>
        </div>
        <div class="faq_box pc">
            <i><img src="/NEW/image/main_N/icon_faq.png" alt="자주묻는질문"></i>
            <a href="/front/custom_faq">
                <h3>모두이사에 <span class="color_pt">자주 묻는 질문</span> Best 10</h3>
                <h4>이사 고객님들이 궁금해하는 자주 묻는 질문 10가지를 정리 하였습니다. </h4>
            </a>
        </div>

    </section>
    <!--커뮤니티-->
    <section class="community_wrap center">
        <h2>모두이사 고객과 <span class="color_pt">함께하는 커뮤니티</span></h2>
        <ul>
            <li class="pc">
                <h4>이사 <span class="color_pt">지식인</span> <span class="plus">+</span></h4>
                <ul class="know_list">
                    <li>
                        <div>Q. 반포장이사시 준비해야 할 것은 어떤게...</div>
                        <div>A. 반포장이사나 포장이사시 자차로 가셔도 되시고 동승하셔도 되세요.</div>
                    </li>
                    <li>
                        <div>Q. 시간이 안되서 오후나 저녁에 이사..</div>
                        <div>A. 이사할 때 한군데에서만 견적을 받아보시면 안됩니다.</div>
                    </li>
                    <li>
                        <div>Q. 다음달쯤에 이사준비로 이사비교견적</div>
                        <div>A. 저렴한 가격에 중점을 둔 이삿짐센터의 경우, 이용시 서비스 품질저하등으로..</div>
                    </li>
                </ul>
            </li>
            <li>
                <h4 class="bgg">모두 <span class="color_blue">FUN</span> <span class="plus">+</span></h4>
                <ul class="fun_list">
                    <li>
                        <a href="">
                            <div>
                                <img src="/NEW/image/main_N/img01.jpg" alt="">
                            </div>
                            <p>모두이사 이사후기!
                                사다리차를 이용한
                                이사 동영상 공개!~</p>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <div>
                                <img src="/NEW/image/main_N/img02.jpg" alt="">
                            </div>
                            <p>집에서 수익실현!
                                비대면 아르바이트 모집!
                                랜딩페이지 제공
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <h4 class="bgg">이사가기 <span class="color_pt">좋은 집</span> <span class="plus">+</span></h4>
                <ul class="fun_list">
                    <li>
                        <a>
                            <div>
                                <img src="/NEW/image/main_N/img03.jpg" alt="">
                            </div>
                            <p>신림스카이 아파트
                                서울특별시 관악구 신림로
                                185(신림동)지하철 2호선
                                신림역, 봉천역</p>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div>
                                <img src="/NEW/image/main_N/img04.jpg" alt="">
                            </div>
                            <p>
                                부산 동원시티비스타
                                부산광역시 연제구 연산동
                                1360-13번지 부산시청역,
                                연산역 환승역 인접
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <h4 class="bgg"><span class="color_blue">우리동네</span>가 좋아요!<span class="plus">+</span></h4>
                <ul class="fun_list">
                    <li>
                        <a>
                            <div>
                                <img src="/NEW/image/main_N/img05.jpg" alt="">
                            </div>
                            <p>
                                서울시 신정4동 맛집
                                베이커리 카폐 블라썸
                                캠패니언 우리 동네는
                                주변에 맛집이 많다
                            </p>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div>
                                <img src="/NEW/image/main_N/img06.jpg" alt="">
                            </div>
                            <p>
                                제가 사는 인천청라는
                                수변공원 조성이 크고 길게
                                아주 잘 만들어진 편입니다.
                                그 수변은 결국에 호수공원.
                            </p>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>

    <!--이사생활정보-->
    <section class="center living_wrap">
        <div class="living_pic_box">
            <h2><b>모두이사</b> 와 함께하는 <b class="color_pt">이사/생활정보</b></h2>
            <ul class="living_pic_list">
                <li><a href="http://modoo24.net//front/modoo_info?cmd=view&idx=32"><img src="http://24auction.co.kr/data/upload/01_20210830_20210831101302.png" alt="image"></a></li>
                <li><a href="http://modoo24.net//front/modoo_info?cmd=view&idx=31"><img src="http://24auction.co.kr/data/upload/KakaoTalk_20210823_111559795_20210823112946.png" alt="image"></li>
                <li><a href="http://modoo24.net//front/modoo_info?cmd=view&idx=30"><img src="http://24auction.co.kr/data/upload/01_20210813_20210817093447.png" alt="image"></a></li>
                <li><a href="http://modoo24.net//front/modoo_info?cmd=view&idx=28"><img src="http://24auction.co.kr/data/upload/01_20210728_20210728175028.png" alt="image"></a></li>
                <li><a href="http://modoo24.net//front/modoo_info?cmd=view&idx=26"><img src="http://24auction.co.kr/data/upload/01_20210604_20210607084847.png" alt="image"></a></li>
                <li><a href="http://modoo24.net//front/modoo_info?cmd=view&idx=25"><img src="http://24auction.co.kr/data/upload/01_20210525_20210526165612.png" alt="image"></a></li>
            </ul>
        </div>
        <!--생활꿀팁-->
        <div class="living_tip_box">
            <h2><b>고객</b>과 함께하는 <b class="color_blue">생활꿀TIP</b></h2>
            <ul>
                <li>
                    <a>
                        <div class="left_img">
                            <img src="/NEW/image/main_N/img07.jpg" alt="">
                        </div>
                        <div class="left_txt">
                            <h4>조금만 알아두면 시간과 노력을 아껴주는..</h4>
                            <p>
                                이사비용 줄이는 방법 꿀팁!<br />
                                새로운 보금자리에서의 시작을 여는 이사,<br />
                                가져갈 짐이 많든 적든 이사는 누구에게나 신경도 많이 써야하고..
                            </p>
                        </div>
                    </a>
                </li>
                <li>
                    <a>
                        <div class="left_img">
                            <img src="/NEW/image/main_N/img08.jpg" alt="">
                        </div>
                        <div class="left_txt">
                            <h4>원룸이사 할 경우에 알아두어야 할 것.</h4>
                            <p>
                                안녕하세요? 국내 최대 이사플랫폼 모두이사입니다.<br />
                                오늘 알아볼 내용은 원룸이사에 관련한 것인데요.<br />
                                어떻게 하면 쉽고 빠르게 또 스마트하게 원룸이사를 할 수 있는지..</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a>
                        <div class="left_img">
                            <img src="/NEW/image/main_N/img09.jpg" alt="">
                        </div>
                        <div class="left_txt">
                            <h4>이사업체 선정방법 이것만 체크하세요~ </h4>
                            <p>
                                이사라는 키워드만 검색을 해보아도 정말 무수히 많은 <br />
                                업체 들이 나오는데요~<br />
                                그 수많은 이사업체 중 어느곳을 믿고 결정해야 할지 선택하기...</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </section>


    <!--파트너문의 고객센터-->
    <section class="customer_wrap">
        <div class="center">
            <div class="left_box">
                <h2><span class="color_pt">파트너</span> 입점 문의</h2>
                <p>이사업체 및 용달업체 <br />
                    파트너 상시모집</p>
                <button type="button" class="btn_part" onclick="location.href='/front/custom_business?cmd=setup_form' ">자세히 보기</button>
            </div>
            <div class="right_box">
                <p><img src="/NEW/image/main_N/customer_img.png" alt="1600-7728"></p>
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
                    <p><img src="/NEW/image/main_N/info_mf.png" alt="모두플랫폼"></p>
                    <span>회사소개</span>
                </a>
            </li>
            <li>
                <a href="http://modooclean.com/" target="_blank">
                    <p><img src="/NEW/image/main_N/info_mc.png" alt="청소서비스"></p>
                    <span>청소서비스</span>
                </a>
            </li>
            <li>
                <a href="https://blog.naver.com/modoo24try" target="_blank">
                    <p><img src="/NEW/image/main_N/info_bg.png" alt="모두블로그"></p>
                    <span>모플블로그</span>
                </a>
            </li>
            <li>
                <a href="https://www.facebook.com/Modooplatform/" target="_blank">
                    <p><img src="/NEW/image/main_N/info_fb.png" alt="모두페이스북"></p>
                    <span>모플페이스북</span>
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/modooplatform/" target="_blank">
                    <p><img src="/NEW/image/main_N/info_it" alt="모두인스타"></p>
                    <span>모플인스타</span>
                </a>
            </li>
            <li>
                <a href="" target="_blank">
                    <p><img src="/NEW/image/main_N/info_evt.png" alt="모두이벤트"></p>
                    <span>모플이벤트</span>
                </a>
            </li>
            <li>
                <a href="/front/custom_review">
                    <p><img src="/NEW/image/main_N/info_good.png" alt="칭찬후기"></p>
                    <span>칭찬후기</span>
                </a>
            </li>
            <li>
                <a href="/front/modoo_noson" target="_blank">
                    <p><img src="/NEW/image/main_N/info_son.png" alt="손없는날"></p>
                    <span>손없는날</span>
                </a>
            </li>
        </ul>
    </section>
    



    
    <!--푸터-->
    <footer>
        <div class="center">
            <ul class="ft_link">
                <li>
                    <a href="javascript:openAgreePop('/new_common/popup/agreement.html')">이용약관</a>
                </li>
                <li>
                    <a href="javascript:openAgreePop('/new_common/popup/info_pop.html')">개인정보처리방침</a>
                </li>
                <li>
                    <a href="javascript:openAgreePop1('/new_common/popup/use_pop_02.html')">제 3자 제공동의</a>
                </li>
                <li onclick="window.open('/NEW/customer/business_up')">파트너제휴</li>

                <li class="tabs">
                    <div class="tab">
                        <input type="checkbox" id="chck1">
                        <label class="tab-label" for="chck1">사업자정보</label>
                        <div class="tab-content">
                            (주)모두플랫폼 대표 : 심준보 <span>|</span> 주소 : 인천광역시 연수구 함박뫼로 50번길 95, 5층(연수동) <span>|</span> TEL : 1600 - 7728 <span>|</span>
                            FAX : 032 - 811 - 2482<span>|</span>사업자 등록번호 : 236-81-01081 <span>|</span> 통신판매업신고증 : 제 2019-인천연수구-0290 호<span>|</span>
                        </div>
                    </div>
                </li>


                <script>
                    window.console = window.console || function(t) {};
                </script>



                <script>
                    if (document.location.search.match(/type=embed/gi)) {
                        window.parent.postMessage("resize", "*");
                    }
                </script>

            </ul>
            <p class="addr pc">(주)모두플랫폼 대표 : 심준보 <span>|</span> 주소 : 인천광역시 연수구 함박뫼로 50번길 95, 5층(연수동)</p>
            <ul class="tel pc">
                <li>TEL : 1600 - 7728</li>
                <li>FAX : 032 - 811 - 2482</li>
                <li>사업자 등록번호 : 236-81-01081</li>
                <li>통신판매업신고증 : 제 2019-인천연수구-0290 호</li>
            </ul>

            <p class="clearb">모두플랫폼은 OnLine Total Life Care Service Open Market을 주사업으로 하며
                <span class="color_pt">이사서비스의 계약과 운송책임은 이사서비스제공 운송사업자와 계약당사자간에 있습니다.</span>
            </p>
            <p class="copy">Copyright © 모두플랫폼 Corporation All rights reserved.</p>
            <a href="mailto:modoo24try@naver.com">광고 및 제휴문의 – modoo24try@naver.com </a>

        </div>

    </footer>
    
    <!--토글-->
<div class="mobile" style="z-index: 900;position: relative">
    <input type="checkbox" name="toggle" id="toggle" />
    <label for="toggle"></label>
    
    <div class="message">
        <ul class="box02">
            <li><span>이사일</span>
                <div class="move_Box">
                    <input type="text" placeholder="이사일">
                </div>

            </li>
            <li>
                <span>이사종류</span>
                <div class="move_Box">
                    <input type="text" placeholder="이사종류">
                </div>
            </li>
            <li>
                <span>고객명</span>
                <div class="move_Box">
                    <input type="text" placeholder="고객명">
                </div>
            </li>
            <li>
                <span>연락처</span>
                <div class="move_Box">
                    <input placeholder="번호만 입력해주세요" maxlength="11">
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
                            전체 동의(필수동의)
                        </p>
                    </div>
                </div>
            </li>
            <li>
                <div class="checks">
                    <div class="checks etrans">
                        <input type="checkbox" id="ex_m_chk2" onclick="selectAll(this)">
                        <label for="ex_m_chk2"></label>
                        <p>
                            개인정보수집 및 이용에 동의 보기
                        </p>
                    </div>
                </div>
            </li>
            <li>
                <div class="checks">
                    <div class="checks etrans">
                        <input type="checkbox" id="ex_m_chk3" onclick="selectAll(this)">
                        <label for="ex_m_chk3"></label>
                        <p>
                            개인정보의 제3자 제공 동의 보기
                        </p>
                    </div>
                </div>
            </li>
        </ul>
        <button type="button" class="btn_simply"><span class="color_yw">간편견적</span><br />신청하기</button>
    </div>
</div>
	
    
    
</body>

<!--bottom 팝업 스크립트-->
<script language="javascript">
    function openAgreePop(url) {
        window.open(url, "small", "width=537, height=500, scrollbars=no, menubar=no");
    }

    function openAgreePop1(url) {
        window.open(url, "small", "width=537, height=330, scrollbars=no, menubar=no");
    }
</script>
<!--bottom 팝업 스크립트-->
<!--메뉴 스크립트-->
<script id="rendered-js">
    /*global $ */
    $(document).ready(function() {

        "use strict";

        $('.menu > ul > li:has( > ul)').addClass('menu-dropdown-icon');
        //Checks if li has sub (ul) and adds class for toggle icon - just an UI

        $('.menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');
        //Checks if drodown menu's li elements have anothere level (ul), if not the dropdown is shown as regular dropdown, not a mega menu (thanks Luka Kladaric)

        $(".menu > ul").before("<a href=\"#\" class=\"menu-mobile\"></a>");

        //Adds menu-mobile class (for mobile toggle menu) before the normal menu
        //Mobile menu is hidden if width is more then 959px, but normal menu is displayed
        //Normal menu is hidden if width is below 959px, and jquery adds mobile menu
        //Done this way so it can be used with wordpress without any trouble

        $(".menu > ul > li").hover(function(e) {
            if ($(window).width() > 943) {
                $(this).children("ul").stop(true, false).fadeToggle(150);
                e.preventDefault();
            }
        });
        //If width is more than 943px dropdowns are displayed on hover

        $(".menu > ul > li").click(function() {
            if ($(window).width() <= 943) {
                $(this).children("ul").fadeToggle(150);
            }
        });
        //If width is less or equal to 943px dropdowns are displayed on click (thanks Aman Jain from stackoverflow)

        $(".menu-mobile").click(function(e) {
            $(".menu > ul").toggleClass('show-on-mobile');
            e.preventDefault();

        });
        //when clicked on mobile-menu, normal menu is shown as a list, classic rwd menu story (thanks mwl from stackoverflow)

    });
    //# sourceURL=pen.js
</script>

<!--간편접수 퀵메뉴-->
<script>
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
<!--//간편접수 퀵메뉴--></html>
