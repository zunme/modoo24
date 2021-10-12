
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if( empty($meta) )
    <meta property="og:title" content="우리집 이사, 청소엔 모두이사"/>
    <meta property="og:image" content="{{\URL::to('/images/default_og_image.jpg')}}">
    <meta property="og:description" content="정식허가업체정보, 후기, 평가등급을 한눈에 확인하고 무료 견적 비교하자"/>
    <meta property="og:url" content="http://modoo24.net"/>
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



    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="/NEW/css/material-kit.css?v=2.0.7" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/NEW/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />




    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ko.min.js" integrity="sha512-L4qpL1ZotXZLLe8Oo0ZyHrj/SweV7CieswUODAAPN/tnqN3PA1P+4qPu5vIryNor6HQ5o22NujIcAZIfyVXwbQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="/NEW/css/main_ct.css" />
    <link rel="stylesheet" type="text/css" href="/NEW/css/common.css" />
    <link rel="stylesheet" type="text/css" href="/NEW/css/font.css" />
    <link rel="stylesheet" type="text/css" href="/NEW/css/main_popup.css" />

    <!--   Core JS Files 메뉴    -->
    <script src="/NEW/js/core/popper.min.js" type="text/javascript"></script>
    <script src="/NEW/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
    <script src="/NEW/js/material-kit.js?v=2.0.7" type="text/javascript"></script>

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
    <script src="/community/assets/js/default.js"></script>
    <script src="/community/newmain.js"></script>


    @yield('css')

</head>

<body>

@section('header')
    <!--pc 및 mobile 메뉴-->
    <header class="pc" id="menu_wrap">
        <div class="menu_floor01">
            <div class="center">
                <a class="logoN" href="/"><img src="/NEW/image/main_N/logo.png"><span>모두이사</span></a>
                <ul class="menu01">
                    <li><a href="/front/orderpop?s=2">비대면견적</a></li>
                    <li><a href="/front/orderpop?s=1">방문견적</a></li>
                    <li><a href="/front/mem_apply?mode=my_request">신청내역</a></li>
                </ul>
                <div class="btn_know">
                    <p class="color_pt"><b>이사지식인</b></p>
                    <button type="button" class="btn_question">질문하기 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" style="vertical-align: middle;">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-5h2v2h-2v-2zm2-1.645V14h-2v-1.5a1 1 0 0 1 1-1 1.5 1.5 0 1 0-1.471-1.794l-1.962-.393A3.501 3.501 0 1 1 13 13.355z" fill="rgba(255,255,255,1)"></path>
                        </svg>
                    </button>
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
        </div>
        <div class="menu_floor02">
            <ul class="left_menu">
                <li><a class="color_pt">이사</a></li>
                <li><a href="http://modooclean.com/" target="_blank">청소</a></li>
            </ul>
            <ul class="middle_menu">
                <li>
                    <a href="void(0);" onclick="alert('준비중입니다.');return false;">
                        모두FUN
                    </a>
                </li>
                <li>
                    <a href="void(0);" onclick="alert('준비중입니다.');return false;">
                        이사가기 좋은집
                    </a>
                </li>
                <li>
                    <a href="void(0);" onclick="alert('준비중입니다.');return false;">
                        우리동네
                    </a>
                </li>
            </ul>

            <ul class="middle_drop">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">모두소식</a>
                    <ul class="dropdown-menu" style="left: -20px">
                        <li><a href="/front/custom_notice">공지사항</a></li>
                        <li><a href="/front/modoo_info">이사/생활정보</a></li>
                        <li><a href="/front/modoo_noson">손없는날</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">고객센터 </a>
                    <ul class="dropdown-menu">
                        <li><a href="/front/mem_apply?mode=my_request">신청내역</a></li>
                        <li><a href="/front/custom_faq">자주묻는질문</a></li>
                        <li><a href="/front/custom_business?cmd=setup_form">파트너제휴</a></li>
                    </ul>
                </li>

            </ul>

            <ul class="menu_tip">
                <li><a class="color_pt" href="void(0);" onclick="alert('준비중입니다.');return false;"><span class="glyphicon glyphicon-paperclip"></span> 생활꿀TIP</a></li>
                <li><a class="color_pt" href="void(0);" onclick="alert('준비중입니다.');return false;"><span class="glyphicon glyphicon-gift"></span> 이벤트</a></li>
                <li><a class="color_bk" href="tel:16007728">고객센터 <b>1600-7728</b></a></li>
            </ul>
        </div>

    </header>
    <div class="mobile">

        <nav class="navbar  navbar-color-on-scroll fixed-top navbar-expand-lg mobile" color-on-scroll="100" id="sectionsNav">
            <div class="container">
                <div class="navbar-translate">
                    <a class="navbar-brand" href="/" style="margin-left: 0">
                        <img src="/NEW/image/main_N/logo_w.png" width="40" class="d-inline-block align-top" alt="모두이사">
                    </a>
                    <div class="mtop_btn_set">
                        <button type="button" class="btn_top_m" onclick="location.href='/front/orderpop?s=2'">비대면견적</button>
                        <button type="button" class="btn_top_m" onclick="location.href='/front/orderpop?s=1'">방문견적</button>
                    </div>

                    <a class="right" href="tel:1600-7728" style="top: 10px;right: 50px;position: absolute">
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
                                <a href="/NEW/modoo/service" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 서비스소개
                                </a>
                                <a href="/NEW/modoo/contact_info.php" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 방문견적 가이드
                                </a>
                                <a href="/NEW/modoo/untact_info.php" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 비대면견적 가이드
                                </a>
                            </div>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fas fa-info-circle"></i> 모두소식
                            </a>
                            <div class="dropdown-menu dropdown-with-icons">
                                <a href="/front/custom_notice" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 공지사항
                                </a>
                                <a href="/front/modoo_info" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 이사/생활정보
                                </a>
                                <a href="/front/modoo_noson" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 손없는날
                                </a>
                            </div>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fas fa-bullhorn"></i> 커뮤니티
                            </a>
                            <div class="dropdown-menu dropdown-with-icons">
                                <a href="void(0);" onclick="alert('준비중입니다.');return false;" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 생활꿀TIP
                                </a>
                                <a href="void(0);" onclick="alert('준비중입니다.');return false;" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 모두FUN
                                </a>
                                <a href="void(0);" onclick="alert('준비중입니다.');return false;" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 이사가기 좋은집
                                </a>
                                <a href="void(0);" onclick="alert('준비중입니다.');return false;" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 우리동네가 좋아요
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/NEW/knows/knows_list.php">
                                <i class="fas fa-atlas"></i> 이사지식인
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/NEW/knows/knows_list.php">
                                <i class="fas fa-calendar-day"></i> 이벤트
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/front/custom_review" target="_blank">
                                <i class="far fa-sticky-note"></i> 이사후기
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="void(0);" onclick="alert('준비중입니다.');return false;" target="_blank">
                                <i class="fas fa-pen-square"></i> 업체평가하기
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fas fa-user-tag"></i> 고객센터
                            </a>
                            <div class="dropdown-menu dropdown-with-icons">
                                <a href="/front/mem_apply?mode=my_request" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 신청내역
                                </a>
                                <a href="/front/custom_faq" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 자주묻는질문
                                </a>
                                <a href="/front/custom_business?cmd=setup_form" class="dropdown-item">
                                    <i class="material-icons">content_paste</i> 파트너제휴
                                </a>
                            </div>
                        </li>
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
                    <li>지금 물어보자!</li>
                    <li>
                        <a href="/NEW/knows/knows_list.php"><b>이사지식인</b></a>
                    </li>
                    <li> <button type="button" class="btn_question" style="display: inline-block">질문하기 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" style="vertical-align: middle;">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-5h2v2h-2v-2zm2-1.645V14h-2v-1.5a1 1 0 0 1 1-1 1.5 1.5 0 1 0-1.471-1.794l-1.962-.393A3.501 3.501 0 1 1 13 13.355z" fill="rgba(255,255,255,1)"></path>
                            </svg></button></li>
                </ul>
            </div>
            <ul class="m_floor3">
                <li><a onclick="alert('준비중입니다.');return false;">모두FUN</a></li>
                <li><a onclick="alert('준비중입니다.');return false;">생활꿀TIP</a></li>
                <li><a onclick="alert('준비중입니다.');return false;">우리동네</a></li>
                <li><a onclick="alert('준비중입니다.');return false;"><b>이벤트</b></a></li>
            </ul>
        </div>
    </div>
    <!--//pc 및 mobile 메뉴-->
@show
<div class="main_wrap_st">
  @yield('content')
</div>


@section('footer')
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
                <li>
                    <a href="/NEW/customer/business_up">파트너제휴</a>
                </li>

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
@show


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
														<p>
																<a href="javascript:openAgreePop('/new_common/popup/info_pop.html')"> 개인정보수집 및 이용에 동의(필수) </a>
														</p>
												</div>
										</div>
								</li>
								<li>
										<div class="checks">
												<div class="checks etrans">
														<input type="checkbox" id="ex_m_chk3" name="simplyRegJoint" value="Y">
														<label for="ex_m_chk3"></label>
														<p>
																<a href="javascript:openAgreePop1('/new_common/popup/use_pop_02.html')"> 개인정보의 제3자 제공 동의(필수) </a>
														</p>
												</div>
										</div>
								</li>
								<li>
										<div class="checks">
												<div class="checks etrans">
														<input type="checkbox" id="ex_m_chk4" name="simplyRegJoint" value="Y">
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
@show


<!-- ST 10.12-->


<!-- modal & logout -->
<form id="logout-form" action="/logout" method="POST" style="display: none;">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content" id="modal_default_body">

  </div>
</div>
</div>

<div class="modal fade" id="smModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
  <div class="modal-content" id="modal_sm_body">

  </div>
</div>
</div>
<div class="modal fade" id="lgModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content" id="modal_lg_body">

  </div>
</div>
</div>
<div class="modal fade" id="xlModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content" id="modal_xl_body">
      XL MODAL
  </div>
</div>
</div>

  <!-- Login Modal -->
<div class="modal fade modal-primary" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="card card-login card-plain" data-background-color>
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="now-ui-icons ui-1_simple-remove"></i>
          </button>

          <div class="header header-primary text-center">
                          <div class="logo-container">
                              <img src="https://modoo24.run.goorm.io/front/image/main/logo.png" alt="">
                          </div>
                      </div>
        </div>
        <div class="modal-body">
          <form class="form" method="POST" action="{{ Config::get('site.defaultStartUrl') }}/login" id="loginpopform">
            <div class="card-body">


              <div class="input-group no-border input-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="now-ui-icons users_circle-08"></i></span>
                </div>
                <input id="email" type="email" name="email" value="" required="required" autofocus="autofocus" class="form-control" placeholder="Email">
              </div>

              <div class="input-group no-border input-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="now-ui-icons ui-1_lock-circle-open"></i></span>
                </div>
                <input id="password" type="password" name="password" required="required" class="form-control" placeholder="Password...">
              </div>


              <span onClick="loginpopform()" class="btn btn-neutral btn-round btn-lg btn-block">이메일로 로그인</span>
            </div>
          </form>
        </div>
        <div class="modal-footer text-center">
          <div class="social_login_inner">
            <a href="{{ Config::get('site.defaultStartUrl') }}/login/kakao" class="" >
              <img src="/community/images/kakao_login_medium_narrow.png" style="width: 185px;height: 45px;">
            </a>
            <a href="{{ Config::get('site.defaultStartUrl') }}/login/naver" class="" >
              <img src="/community/images/naver_large.png" style="width: 185px;height: 45px;margin-top: 10px;">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--  End Modal -->
<!-- /modal & logout -->

<!-- default script -->
<script src="{{ Config::get('site.defaultStartUrl') }}/assets/stisla/node_modules/moment/moment.js"></script>
<script src="{{ Config::get('site.defaultStartUrl') }}/assets/stisla/node_modules/moment/locale/ko.js"></script>
<!--
 <script src="{{ Config::get('site.defaultStartUrl') }}/assets/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="{{ Config::get('site.defaultStartUrl') }}/assets/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ Config::get('site.defaultStartUrl') }}/assets/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.1/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/kt-2.6.4/r-2.2.9/rg-1.1.3/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.css"/>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.1/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/kt-2.6.4/r-2.2.9/rg-1.1.3/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>
<!-- template -->
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js" integrity="sha256-qXBd/EfAdjOA2FGrGAG+b3YBn2tn5A6bhz+LSgYD96k=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/template7@1.4.2/dist/template7.min.js" integrity="sha256-AR7mrm2lYY5i4wWxxAznbMCTVOCMD5kvqLUmtW/6iCY=" crossorigin="anonymous"></script>
<!-- summer note -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


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

@yield('script')

</body>





</html>
