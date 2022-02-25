<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, , maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">

    @if( empty($meta) )
    <meta property="og:title" content="우리집 이사, 청소엔 모두이사" />
    <meta property="og:image" content="{{\URL::to('/images/default_og_image.jpg')}}">
    <meta property="og:description" content="정식허가업체정보, 후기, 평가등급을 한눈에 확인하고 무료 견적 비교하자" />
    <meta property="og:url" content="http://modoo24.net" />
    <meta name="description" content="정식허가업체정보, 후기, 평가등급을 한눈에 확인하고 무료 견적 비교하자">
    @else
    <meta property="og:title" content="{{$meta->title}}" />
    <meta property="og:image" content="{{$meta->image}}" />
    <meta property="og:description" content="{{$meta->description}}" />
    <meta property="og:url" content="{{$meta->url}}" />
    <meta name="description" content="{{$meta->description}}">
    @endif
    <meta name="author" content="모두이사">
    <meta name="keywords" content="이사,포장이사,비대면이사,비대면">
    <meta name="format-detection" content="telephone=no, address=no, email=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>모두이사</title>

    <link rel="shortcut icon" href="/modoo24.ico">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">



    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="/v1/css/material-kit.css?v=2.0.7" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/v1/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />




    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ko.min.js" integrity="sha512-L4qpL1ZotXZLLe8Oo0ZyHrj/SweV7CieswUODAAPN/tnqN3PA1P+4qPu5vIryNor6HQ5o22NujIcAZIfyVXwbQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="/v1/css/main_ct.css?v=20220126" />

    @section('usesub')
    <link rel="stylesheet" type="text/css" href="/v1/css/sub.css" />
    @show
    <link rel="stylesheet" type="text/css" href="/v1/css/common.css" />
    <link rel="stylesheet" type="text/css" href="/v1/css/font.css" />
    <link rel="stylesheet" type="text/css" href="/v1/css/main_popup.css" />

    <!--   Core JS Files 메뉴    -->
    <script src="/v1/js/core/popper.min.js" type="text/javascript"></script>
    <script src="/v1/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->

    @if( in_array(Request::path(), ['/','testhome']) )
    <!-- 홈에 clse tag 안맞는 현상으로 스크립트 죽임 -->
    <script src="/v2/assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
    @else
    <script src="/v1/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
    @endif



    <!-- handlebar -->
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- toast -->
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js" integrity="sha256-321PxS+POvbvWcIVoRZeRmf32q7fTFQJ21bXwTNWREY=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/community/assets/stisla/node_modules/izitoast/dist/css/iziToast.min.css">
    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!--  custom  -->
    <script src="/community/assets/js/default.js?v=20220111150300"></script>

    <script>
     /*************************************
     Menu Area
     *************************************/
        $(".menu-icon").click(function() {
            $('.menu-area').fadeIn();
            $('body').css({
                "overflow-y": "hidden",
                "height": "100%"
            });
        });

        $("#colophon .company-information #footer-navigation ul li:nth-child(3)").click(function() {
            $('.menu-area').fadeIn();
            $('body').css({
                "overflow-y": "hidden",
                "height": "100%"
            });
        });

        $(".menu-area .close-icon").click(function() {
            $('.menu-area').fadeOut();
            $('body').css({
                "overflow-y": "auto",
                "height": "auto"
            });
        });
    </script>
    @yield('css')

</head>

<body>

    @section('header')


    <!--pc 및 mobile 메뉴-->
    <!-- .menu-area start -->
			<div class="menu-area">
				<div class="inner">
					<p class="mobile-only site-title"><a class="fmenu_logo gotohome" href="#"><img src="/v1/image/main_N/logo.png"><span>모두이사</span></a></p>
					<strong>사이트맵</strong>
					<span class="close-icon"></span>

					<nav class="mobile-only" id="lang-navigation">
						<ul class="mobile-only">
						</ul>
					</nav><!-- #lang-navigation -->

					<span class="search-icon mobile-only"></span>

					<nav id="sitemap">
						<ul>
							<li class="main-beyond-build has-children">
								<a href="/v1/modoo/service">모두이사</a>
								<ul class="sub-menu">
									<li><a href="/v1/modoo/service">서비스소개</a></li>
									<li><a href="/v1/modoo/contact_info.php">방문견적 가이드</a></li>
									<li><a href="/v1/modoo/untact_info.php">비대면견적 가이드</a></li>
								</ul>
							</li>
							<li class="main-business-area has-children">
								<a href="/v2/posts/tip">커뮤니티</a>
								<ul class="sub-menu">
									<li><a href="/v2/posts/tip">모두꿀 TIP</a></li>
									<li><a href="/v2/posts/fun">모두 FUN</a></li>
								</ul>
							</li>
							<li class="main-innovation has-children">
								<a href="/community/posts/jisik">이사지식인</a>
								<ul class="sub-menu">
									<li><a href="/community/posts/jisik">이사지식인</a></li>
								</ul>
							</li>
							<li class="main-esg has-children">
                                <a href="/v2/event">이벤트</a>
                                <ul class="sub-menu">
									<li><a href="/v2/event">이벤트</a></li>
								</ul>
							</li>
							<li class="main-career has-children">
								<a href="/v1/move/review">후기&amp;평가</a>
								<ul class="sub-menu">
									<li class="has-children">
										<a href="/v2/review">이사후기</a>
									</li>
									<li class="has-children">
										<a href="/v2/review/my">업체평가하기</a>
									</li>
								</ul>
							</li>
							<li class="main-about-us has-children">
								<a href="/v2/my/request">이사신청내역</a>
								<ul class="sub-menu">
									<li><a href="/v2/my/request">이사신청내역</a></li>
								</ul>
							</li>
							<li class="main-newsroom has-children">
								<a href="/v1/move/custom_business">파트너제휴</a>
								<ul class="sub-menu">
									<li><a href="/v1/move/custom_business">파트너제휴</a></li>
								</ul>
							</li>
							<li class="main-career has-children">
								<a href="/v1/customer/notice">고객센터</a>
								<ul class="sub-menu">
									<li class="has-children">
										<a href="/v1/customer/notice">모두 뉴스</a>
									</li>
									<li class="has-children">
										<a href="/v1/customer/faq.php">자주묻는 질문</a>
									</li>
									<li class="has-children">
										<a href="/v1/customer/contact_info.php">이사정보</a>
									</li>
									<li onclick="viewpopcal()" class="has-children">
										<a>손없는날<div class="ripple-container"></div><div class="ripple-container"></div></a>
									</li>
								</ul>
							</li>

						</ul>
					</nav>
					<!-- #utility-line -->
					<p class="with-posco mobile-only"></p><!-- .with-posco -->
				</div><!-- .inner -->
			</div>
			<!-- .menu-area end -->


    <header class="pc" id="menu_wrap">
        <div class="menu_floor01">
            <div class="center">
                <a class="logoN gotohome" href="#"><img src="/v1/image/main_N/logo.png"><span>모두이사</span></a>
                <div class="right_menu">
                    <ul class="menu01">
                        <li><a href="{{ Request::is('/') ? 'javascript:openpopn();' : '/v2/#estimate1' }}">비대면견적</a></li>
                        <li><a href="/front/orderpop?s=1">방문견적</a></li>
                        <li><a href="/v2/my/request">신청내역</a></li>
                    </ul>

                    <div class="btn_boxright2">
                        <div class="btn_know">
                            <!--<p class="color_pt"><b>이사지식인</b></p>-->
                            <button type="button" class="btn_question_1 " onclick="location.href='/community/posts/jisik' ">이사지식인
                                <i class="fas fa-angle-double-right" style="color:#000"></i>
                            </button>

                        </div>


                        @section ( 'login-pc')
                        @guest
                        <button type="button" class="login" onClick="location.href='/community/login';">
                            <a href="/community/login">
                                <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>로그인
                            </a>
                        </button>
                        @endguest

                        @auth
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle mypage" id="navbarDropdownMenuMy" data-toggle="dropdown">
                                    <p>My모두</p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-center mymenu" aria-labelledby="navbarDropdownMenuMy">
                                    <span class="dropdown-item" onClick="logout()">
                                        로그아웃
                                    </span>
                                    <a class="dropdown-item" href="/community/member/modify">
                                        회원정보수정
                                    </a>
                                    <a class="dropdown-item" href="/community/member/myinfo">
                                        나의정보
                                    </a>
                                </div>

                            </li>
                        </ul>
                        @endauth
                        @show
                    </div>

                   <!-- <a class="clean_fast" href="http://www.modooclean.com/" target="_blank">
                        <p class="clean01"><b>청소는</b></p>
                        <p class="clean03"><b>모두클린</b><span><img src="/v1/image/main_N/clean_icon.png"></span></p>
                    </a>-->
                    <a class="clean_fast" href="http://www.modooclean.com/" target="_blank">
                        <p class="clean03">모두클린<span><img src="/v1/image/main_N/clean_icon1.png"></span></p>
                    </a>
                    <li class="modalpop_link story" link="/new_common/popup/free_event.html">
                        사연 모집
                    </li>

                    <span class="menu-icon"></span>
                </div>
            </div>
        </div>
        <div class="menu_floor02">
            <ul class="left_menu">
                <li><a class="color_pt">이사</a></li>
                <li><a href="http://modooclean.com/" target="_blank">청소</a></li>
            </ul>
            <ul class="middle_menu">
                <li><a class="color_pt" href="/v2/posts/tip"><span class="glyphicon glyphicon-paperclip"></span> 모두꿀TIP</a></li>
                <li><a class="color_pt" href="/v2/posts/fun">모두FUN</a></li>


            </ul>

            <ul class="middle_drop">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">모두이사</a>
                    <ul class="dropdown-menu" style="left: -20px">
                        <li><a href="/v1/modoo/service.php">서비스소개</a></li>
                        <li><a href="/v1/modoo/contact_info.php">방문견적 가이드</a></li>
                        <li><a href="/v1/modoo/untact_info.php">비대면견적 가이드</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">고객센터</a>
                    <ul class="dropdown-menu">
                        <li><a href="/v1/customer/notice">모두 뉴스</a></li>
                        <li><a href="/v1/customer/faq">자주묻는 질문</a></li>
                        <li><a href="/v1/customer/contact_info">이사정보</a></li>
                        <li onclick="viewpopcal()"><a>손없는날<div class="ripple-container">
                                    <div class="ripple-decorator ripple-on ripple-out" style="left: 62.4584px; top: 12.592px; background-color: rgb(255, 255, 255); transform: scale(20);"></div>
                                </div></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="/v2/event" role="button" aria-haspopup="true" aria-expanded="false">이벤트</a>
                </li>

            </ul>

            <ul class="menu_tip">
                <li>
                    <a href="/v2/review">
                        이사후기
                    </a>
                </li>
                <li>
                    <a href="/v2/review/my">
                        이사업체평가하기
                    </a>
                </li>
                <li><a class="color_bk" href="tel:16007728">고객센터 <b>1600-7728</b></a></li>
            </ul>
        </div>

    </header>
    <div class="mobile">

        <nav class="navbar  navbar-color-on-scroll fixed-top navbar-expand-lg mobile" color-on-scroll="100" id="sectionsNav">
            <div class="container">
                <div class="navbar-translate">
                    <a class="navbar-brand gotohome" href="#" style="margin-left: 0">
                        <img src="/v1/image/main_N/logo_w.png" width="40" class="d-inline-block align-top" alt="모두이사">
                    </a>
                    <div class="mtop_btn_set">
                        <a href="/v1/modoo/contact_info.php"><button type="button" class="btn btn_info" onclick=""><span class="infortxt01">모두이사</span> <span class="infortxt02">이사 견적</span> <span class="infortxt03">비교 서비스</span></button></a>
                    </div>

                    <a class="right" href="tel:1600-7728" style="top:12px; right:50px; position: absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M21 16.42v3.536a1 1 0 0 1-.93.998c-.437.03-.794.046-1.07.046-8.837 0-16-7.163-16-16 0-.276.015-.633.046-1.07A1 1 0 0 1 4.044 3H7.58a.5.5 0 0 1 .498.45c.023.23.044.413.064.552A13.901 13.901 0 0 0 9.35 8.003c.095.2.033.439-.147.567l-2.158 1.542a13.047 13.047 0 0 0 6.844 6.844l1.54-2.154a.462.462 0 0 1 .573-.149 13.901 13.901 0 0 0 4 1.205c.139.02.322.042.55.064a.5.5 0 0 1 .449.498z" fill="rgba(255,255,255,1)" />
                        </svg>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">토글네비게이션</span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fas fa-truck-moving"></i> 모두이사
                            </a>
                            <div class="dropdown-menu dropdown-with-icons">
                                <a href="/v1/modoo/service" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 서비스소개
                                </a>
                                <a href="/v1/modoo/contact_info.php" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 방문견적 가이드
                                </a>
                                <a href="/v1/modoo/untact_info.php" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 비대면견적 가이드
                                </a>
                            </div>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fas fa-bullhorn"></i> 커뮤니티
                            </a>
                            <div class="dropdown-menu dropdown-with-icons">
                                <a href="/v2/posts/tip" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 모두꿀TIP
                                </a>
                                <a href="/v2/posts/fun" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 모두FUN
                                </a>
                                <!--<a href="void(0);" onclick="alert('준비중입니다.');return false;" class="dropdown-item">
                                <i class="material-icons">content_paste</i> 우리동네자랑하기
                            </a>-->
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/community/posts/jisik">
                                <i class="fas fa-atlas"></i> 이사지식인
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/v2/event">
                                <i class="fas fa-calendar-day"></i> 이벤트
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fas fa-bullhorn"></i> 후기&amp;평가
                            </a>
                            <div class="dropdown-menu dropdown-with-icons">
                                <a href="/v2/review" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 이사후기
                                </a>
                                <a href="/v2/review/my" class="dropdown-item">
                                    <i class="material-icons">content_paste</i>업체평가하기
                                </a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/v2/my/request">
                                <i class="far fa-list-alt"></i> 이사신청내역
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/v1/move/custom_business">
                                <i class="far fa-list-alt"></i> 파트너제휴
                            </a>
                        </li>

                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fas fa-user-tag"></i> 고객센터
                            </a>
                            <div class="dropdown-menu dropdown-with-icons">
                                <a href="/v1/customer/notice" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 모두 뉴스
                                </a>
                                <a href="/v1/customer/faq" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 자주묻는 질문
                                </a>
                                <a href="/v1/customer/contact_info" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 이사정보
                                </a>
                                <a onclick="viewpopcal()" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 손없는날
                                    <div class="ripple-container"></div>
                                </a>
                            </div>
                        </li>

                        @section("login-mobile")
                        @guest
                        <li class="nav-item m-login">
                            <a class="nav-link" href="/community/login">
                                <i class="fas fa-sign-in-alt"></i> 로그인
                            </a>
                        </li>

                        @endguest
                        @auth()
                        <li class="dropdown nav-item m-login">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fas fa-user-tag"></i> My모두
                            </a>
                            <div class="dropdown-menu dropdown-with-icons">
                                <a href="javascript:logout();" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> 로그아웃
                                </a>
                                <a class="dropdown-item" href="/community/member/modify">
                                    <i class="fab fas fa-edit"></i> 회원정보수정
                                </a>
                                <a class="dropdown-item" href="/community/member/myinfo">
                                    <i class="fab fas fa-address-book"></i> 나의정보
                                </a>
                            </div>
                        </li>

                        @endauth
                        @show

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
                <ul class="right_menu_m">
                    <li class="modalpop_link story" link="/new_common/popup/free_event.html">
                        사연 모집
                    </li>
                    <!--<li>지금 물어보자!</li>-->
                    <li>
                        <a href="/community/posts/jisik">
                            <button type="button" class="btn_question_1" style="display: inline-block">이사지식인
                                <i class="fas fa-angle-double-right" style="color:#000"></i></button>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="m_floor3">
                <li><a href="/v2/posts/tip">모두꿀TIP</a></li>
                <li><a href="/v2/posts/fun">모두FUN</a></li>
                <li><a href="/v1/move/review">이사후기</a></li>
                <li><a href="/v2/event"><b>이벤트</b></a></li>
            </ul>
        </div>
    </div>
    <!--//pc 및 mobile 메뉴-->
    @show
