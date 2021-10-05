<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>모두이사</title>

  	<meta name=”robots” content=”index”>
	<meta property="og:site_name" content="@yield('meta_site_name', '모두이사' )" />
	<meta property="og:type" content="website"/>
	
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
	
	<!-- Styles -->
	<link rel="shortcut icon" href="/modoo24.ico" />
	
	
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- CSS Files -->
	<link href="/community/assets/now/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/community/assets/now/css/now-ui-kit2.min.css?v=1.3.1" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="/community/assets/now/demo/demo.css" rel="stylesheet" />
	
	  <!-- CSS Libraries -->
	<!--
  <link rel="stylesheet" href="{{ Config::get('site.defaultStartUrl') }}/assets/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ Config::get('site.defaultStartUrl') }}/assets/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
-->
  <link rel="stylesheet" href="{{ Config::get('site.defaultStartUrl') }}/assets/stisla/node_modules/izitoast/dist/css/iziToast.min.css">
  <link rel="stylesheet" href="{{ Config::get('site.defaultStartUrl') }}/assets/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css">
	
	<style>
	.pt-10{padding-top:10px;}
	.pt-20{padding-top:20px;}
	.mt-10{		margin-top:10px !important;	}
	.mt-20{		margin-top:20px !important;	}
		.mt-0{		margin-top:0px !important;	}
		.mb-0{		margin-bottom:0px !important;	}
	.hide , .hidden {display:none !important}
		.ellipsis {
			width: 100%;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		.display-inline-block{
			display: inline-block;
		}
		.display-block{
			display: block !important;
		}
.page-header.page-header-small {
    min-height: 200px;
    max-height: 350px;
    height: 60vh;
}
.navbar .navbar-brand, .navbar .navbar-nav .nav-link:not(.btn) {
    font-size: 14px;
	font-weight: 800;
}
		.display-flex{
			display: flex;			
		}
		.justify-space-between{
			justify-content: space-between;				
		}
		.justify-content-flex-end{
			justify-content: flex-end;
		}
		.navbar .navbar-nav .nav-link:not(.btn) {
    padding: .3rem .6rem;
		}
		.forline2{
			    width: 100%;
    display: flex;
    flex-direction: column;
		}
		.menu-side-line{
			line-height: 36px;
    font-size: 18px;
    color: #8888bf;
		}
		.border-top-default{
			border-top: 1px solid #eee;
		}
.btn-white {
    background-color: #fff;
    color: #666;
	border: 1px solid #2ca8ff;
}
	.btn-white:hover{
		background-color: #d9e9f5 !important;
		color: #5d5d5d !important;
		border-color: #d9e9f5 !important;	
	}

	/* 페이징 */	
	.pagination > li > a, .pagination > li > span {
		position: relative;
    display: block;
		
    border: 0;
    border-radius: 30px!important;
    transition: all .3s;
    padding: 0 11px;
    margin: 0 3px;
    min-width: 30px;
    text-align: center;
    box-shadow: none;
    height: 30px;
    line-height: 30px;
    color: #2c2c2c;
    cursor: pointer;
    font-size: 14px;
    text-transform: uppercase;
    background: transparent;
}

.pagination > li.active > span {
		box-shadow: 0 5px 3px 0 rgb(0 0 0 / 20%);
		background-color: #f96332;
		border-color: #f96332;
		color: #fff;
}
		.pagination .page-item.active{
			padding-bottom: 8px;
		}
		.pagination .page-item.active>.page-link {
    box-shadow: 0 5px 3px 0 rgb(0 0 0 / 20%);
}
		.pagination > li:first-child > span,
		.pagination > li:first-child > a,
		.pagination > li:last-child > span,
		.pagination > li:last-child > a{
			font-weight: 900;
			font-size: 18px;
			line-height: 28px;
		}
		.paging-center > .pagination{
			justify-content: center;
		}
		.modal .modal-login .card-login .logo-container {
    margin-bottom: 0px;
		}
		.modal .modal-login {
				max-width: 360px;
		}
		.force-login-btn{
			    line-height: 90px;
    margin: 0;
    background-color: #fa7347;
    color: white;
		}
		
		@media screen and (max-width: 991px){
			.navbar .navbar-nav {
					width: 200px;
					margin-top: 20px;
			}
		}
	</style>
	@yield('css')
</head>
<body class="landing-page sidebar-collapse">
  <!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white fixed-top navbar-transparent display-block" color-on-scroll="50">
	<div class="container">
		<div class="navbar-translate">
			<a class="navbar-brand" href="https://modoo24.net/" rel="tooltip" title="이사업체 추천, 비대면 이사" data-placement="bottom" target="_blank">
				<img src="/front/image/main/logo.png">
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
		   		<span class="navbar-toggler-bar top-bar"></span>
				<span class="navbar-toggler-bar middle-bar"></span>
				<span class="navbar-toggler-bar bottom-bar"></span>
		 	</button>
		</div>

		<div class="collapse navbar-collapse" data-color="orange">
			<div class="forline2">
				<ul class="navbar-nav ml-auto">

					<li class="nav-item">
						<a href="#" class="nav-link" >
							<i class="now-ui-icons design_app" aria-hidden="true"></i>
							<p>비대면견적</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link" >
							<i class="now-ui-icons design_app" aria-hidden="true"></i>
							<p>방문견적</p>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLinkcommunity" data-toggle="dropdown">
							<i class="fab far fa-kiss-wink-heart"></i>
							<p>커뮤니티</p>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLinkcommunity">
							<a class="dropdown-item" href="#">
								<i class="fab fas fa-grin-hearts"></i>
								칭찬후기
							</a>
							<a class="dropdown-item" href="{{ Config::get('site.defaultStartUrl') }}/posts/jisik">
								<i class="fab fas fa-brain"></i>
								이사지식인
							</a>
							<a class="dropdown-item" href="{{ Config::get('site.defaultStartUrl') }}/posts/hometown">
								<i class="fab fas fa-city"></i>
								우리동네
							</a>						
						</div>
					</li>
					<li class="nav-item">
						<a href="{{ Config::get('site.defaultStartUrl') }}/posts/jisik" class="nav-link" >
							<i class="now-ui-icons shopping_delivery-fast"></i>
							<p>이사지식인</p>
							<span class="btn btn-sm btn-info mt-0 mb-0 d-none d-sm-none d-md-none d-lg-inline-block">질문하기</span>
						</a>
					</li>
@if (Auth::guest())
					<li class="nav-item">
						<a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal" >
							<i class="fas fa-sign-in-alt"></i>
							<p>로그인</p>
						</a>
					</li>						
@else
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuMy" data-toggle="dropdown">
							<i class="now-ui-icons users_single-02"></i>
							<p>My</p>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuMy">
							<a class="dropdown-item" href="#">
								<i class="fab fas fa-edit"></i>
								정보수정
							</a>
							<span class="dropdown-item" onClick="logout()">
								<i class="fas fa-sign-out-alt"></i>
								로그아웃
							</span>						
						</div>

					</li>
@endif
				</ul>
				<ul class="navbar-nav ml-auto nd-navbar-nav border-top-default">
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
							<i class="now-ui-icons shopping_delivery-fast"></i>
							<p>모두이사</p>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
							<a class="dropdown-item" href="#">
								<i class="now-ui-icons travel_info"></i>
								서비스 소개
							</a>
							<a class="dropdown-item" href="#">
								<i class="now-ui-icons travel_info"></i>
								이사정보
							</a>
							<a class="dropdown-item" href="#">
								<i class="now-ui-icons travel_info"></i>
								손 없는 날
							</a>
						</div>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link" >
							<p>업체평가</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link" >
							<p>칭찬후기</p>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLinkCenter" data-toggle="dropdown">
							<p>고객센터</p>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLinkCenter">
							<a class="dropdown-item" href="#">
								<i class="now-ui-icons business_bulb-63"></i>
								자주묻는질문
							</a>
							<a class="dropdown-item" href="#">
								<i class="now-ui-icons business_bulb-63"></i>
								공지사항
							</a>
							<a class="dropdown-item" href="#">
								<i class="now-ui-icons business_bulb-63"></i>
								파트너제휴
							</a>						
						</div>
					</li>

					<li class="menu-side-line d-none d-sm-none d-md-none d-lg-block">|</li>

					<li class="nav-item dropdown">
						<a href="#" class="nav-link" >
							<p>신청내역</p>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link" >
							<p>생활꿀팁</p>
						</a>
					</li>

					<li class="menu-side-line d-none d-sm-none d-md-none d-lg-block">|</li>

					<li class="nav-item">
						<a href="#" class="nav-link" >
							<i class="now-ui-icons files_paper" aria-hidden="true"></i>
							<p>이벤트</p>
						</a>
					</li>

					<li class="menu-side-line d-none d-sm-none d-md-none d-lg-block">|</li>

					<li class="nav-item">
						<a href="tel:16887728" target="_blank" data-original-title="1688-7728" class="nav-link" >
							<p>고객센터 1600-7728</p>
						</a>
					</li>

				</ul>
			</div>
		</div>

	</div>
	
</nav>
  <!-- End Navbar -->
  <div class="wrapper">
    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url('@yield('backgroundimage','/NEW/image/sub/visual1.jpg')');">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title">@yield('title','모두이사 지식인')</h1>
          <div class="text-center">
            <a href="https://www.facebook.com/Modooplatform" target="_blank" class="btn btn-primary btn-icon btn-round">
              <i class="fab fa-facebook-square"></i>
            </a>
            <a href="https://www.instagram.com/modooplatform/" target="_blank" class="btn btn-primary btn-icon btn-round">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://blog.naver.com/modoo24try" target="_blank" class="btn btn-primary btn-icon btn-round">
              <i class="fab fas fa-blog"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
	  
<!-- main section -->	  
	<div class="main">
		@yield('content')
	</div>
<!-- / main section -->	  
	  
    <footer class="footer footer-default">
	  <div class="container">
		<div>
			<div class="" id="copyright">
			  Copyright &copy; 모두플랫폼 Corporation All rights reserved.
			</div>			
		</div>
		<div>
			<div class="">
			  <a href="mailto:modoo24try@naver.com">광고 및 제휴문의 – modoo24try@naver.com </a>
			</div>
		</div>
	  </div>
    </footer>
  </div>
	
	
	
	
	
	
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
	
	
   <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		
  <!--   now Core JS Files   -->
  <!--script src="/community/assets/now/js/core/jquery.min.js" type="text/javascript"></script-->
  <script src="/community/assets/now/js/core/popper.min.js" type="text/javascript"></script>
  <script src="/community/assets/now/js/core/bootstrap.min.js" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="/community/assets/now/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="/community/assets/now/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="/community/assets/now/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>	
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="/community/assets/now/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!--script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script-->
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="/community/assets/now/js/now-ui-kit2.min.js?v=1.3.1" type="text/javascript"></script>
	
	
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
  <script src="{{ Config::get('site.defaultStartUrl') }}/assets/js/handlebars.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/template7@1.4.2/dist/template7.min.js" integrity="sha256-AR7mrm2lYY5i4wWxxAznbMCTVOCMD5kvqLUmtW/6iCY=" crossorigin="anonymous"></script>
	
	
  <!--script src="/stisla/node_modules/sweetalert/dist/sweetalert.min.js"></script-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="{{ Config::get('site.defaultStartUrl') }}/assets/stisla/node_modules/izitoast/dist/js/iziToast.min.js"></script>

  <!-- summer note -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
	
	<!-- back alert message -->
	@if(session()->has('noti_alert_message'))
    <script>
			iziToast.error({
            message: "{{ session()->get('noti_alert_message') }}",
            position: 'topRight'
      });
	  </script>
	@endif
	<script>
		var totalImgCnt = 0;
		var inpCnt = 0;
		
		var lang_kor = {
			"decimal" : "",
			"emptyTable" : "데이터가 없습니다.",
			"info" : "_START_ - _END_ (총 _TOTAL_ 개)",
			"infoEmpty" : "0 개",
			"infoFiltered" : "(전체 _MAX_ 명 중 검색결과)",
			"infoPostFix" : "",
			"thousands" : ",",
			"lengthMenu" : "_MENU_ 개씩 보기",
			"loadingRecords" : "로딩중...",
			"processing" : "WAIT...",
			"search" : "검색 : ",
			"zeroRecords" : "검색된 데이터가 없습니다.",
			"paginate" : {
					"first" : "첫 페이지",
					"last" : "마지막 페이지",
					"next" : "다음",
					"previous" : "이전"
				},
			"aria" : {
					"sortAscending" : " :  오름차순 정렬",
					"sortDescending" : " :  내림차순 정렬"
				}
		};

		function readURL(input, id) {
			if (input.files && input.files[0]) {   
				var reader = new FileReader();
				var filename = $(input).val();
				filename = filename.substring(filename.lastIndexOf('\\')+1);
				reader.onload = function(e) {
					if(e.total >  1024*300 ) {
						$('#'+id+'_col').remove();
						Swal.fire({
							title : '파일사이즈',
							text: '300Kb 까지만 업로드가 가능합니다.',
							icon: 'error',
							confirmButtonText: '확인'
						})
						return;
						//메가 1048576 
					}
					var bytes = formatBytes( e.total);
					
					$('#'+id+'_preview').attr('src', e.target.result);
					
					$('#'+id+'_preview').hide();
					$('#'+id+'_preview').parent().removeClass('hide');
					
					$('#'+id+'_preview').fadeIn(500);
					$('#'+id+'_preview').show();
					$('#'+id+'_byte').text(bytes)
					$('#'+id+'_filename').text(filename)
					$('#'+id+'_col').removeClass('hide');
					totalImgCnt++;
				}
				reader.readAsDataURL(input.files[0]);    
			} 
			//$(".alert").removeClass("loading").hide();
		}
		function removeFile(btn){
			var row = $(btn).closest('.imgprevcol');
			$(row).fadeOut(500, function (){
				$(row).remove();
				totalImgCnt--;
			});
		}
		function formatBytes(bytes, decimals = 2) {
				if (bytes === 0) return '0 Bytes';

				const k = 1024;
				const dm = decimals < 0 ? 0 : decimals;
				const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

				const i = Math.floor(Math.log(bytes) / Math.log(k));

				return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
		}
		function loginpopform() {
				Swal.fire({
					title: '기획후 작성예정',
					text: 'AJAX LOGIN - EMAIL ID',
					icon: 'info',
					confirmButtonText: '확인'
				})
		}
		function logout(){
$.ajax({
		url : '{{ Config::get('site.defaultStartUrl') }}/refresh',
		method:"get",
		dataType:'JSON',
		success:function(result){
			$('meta[name="csrf-token"]').attr('content', result.token);
				$.ajaxSetup({
						headers: {
								'X-CSRF-TOKEN': result.token
						}
				});

				$.ajax({
					url: '{{ Config::get('site.defaultStartUrl') }}/logout',
					method:"POST",
					data: {"_token" : result.token } ,
					success:function(res)
					{
						console.log (res)
					},
					error: function ( err ){
						ajaxErrorST(err)
					},
					complete : function(){
						location.replace('{{ Config::get('site.defaultStartUrl') }}/');
					}
				});

		} // end success
	});			
		}	
		
		
function ajaxErrorST(jqXHR ){
  $('.loading_wrap').hide();
  if(jqXHR.status != 422 && jqXHR.status != 500 ) {
    iziToast.error({
        message: '잠시후에 이용해주세요',
        position: 'bottomRight'
    });
    return;
  }
	
  var msg ;
  var exception ;
  if (jqXHR.responseJSON ) {
    msg = (jqXHR.responseJSON.errors) ? jqXHR.responseJSON.errors : jqXHR.responseJSON;
    exception = jqXHR.responseJSON.exception;
  }
	console.log(msg) ;
	
    if(msg) {
			if( msg.message ){
				iziToast.error({
					message:  msg.message,
					position: 'bottomRight'
				});				
			}else {
				for(key in msg) {
					if(msg.hasOwnProperty(key)) {
						if(key.indexOf('.') < 0 ) {
							$('input[name='+key+']').focus();
						}
						if ( $.isNumeric( key )) {
							iziToast.error({
								message: msg,
								position: 'bottomRight'
							});
						} else {
							iziToast.error({
								message: msg[key][0],
								position: 'bottomRight'
							});
						}
						break;
					}
				}				
			}
    } else {
      iziToast.error({
        message: '시스템 오류입니다',
        position: 'bottomRight'
      });
    }
}    
function pop_tpl( size, id , data, title ){
  if ( typeof id =='undefined') return false;
  var availsize = ['sm', 'lg', 'xl']
  if ( !availsize.includes(size) ) size='default';
  var template = Handlebars.compile( $( "#"+id ).html() );
  $("#modal_"+size+"_body" ).html ( template(data) );
  $( "#"+size+"Modal" ).modal('handleUpdate')
  $( "#"+size+"Modal" ).modal('show')
  if($(".datetimepicker").length) {
    $('.datetimepicker').daterangepicker({
        locale: {format: 'YYYY-MM-DD HH:mm'},
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
      });
  }
}
// onClick="default_form_prc({'form':'updateform', 'url':'/adm/rooms/save','reload':datatable})" 
function default_form_prc(info) {
  var msg = ( typeof info.msg =='undefined') ? '정상적으로 처리되었습니다.' : info.msg;
  $.ajax({
    url : '/adm/refresh',
    method:"get",
    dataType:'JSON',
    success:function(result){
      $('meta[name="csrf-token"]').attr('content', result.token);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': result.token
            }
        });
        $.ajax({
          url:info.url,
          method:"POST",
          data:new FormData( document.getElementById(info.form) ),
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success:function(res)
          {
            if( res.result =='error'){
              iziToast.success({
                message: res.msg,
                position: 'topRight'
              });
              return;
            } else {
              iziToast.success({
                message: msg,
                position: 'topRight'
              });
            }
            if( typeof info.reload !='undefined')   {
                if ( info.reload=="self"){
                  location.reload();
                } else info.reload.ajax.reload(null, false);
              }
            $('.modal.show').modal('hide');
          },
          error: function ( err ){
            ajaxErrorST(err)
          }
        });
    }
  });
}
function default_form_delete( info ){
  let title='';
  if (typeof info.title != 'undefined') title = `[${info.title}] 을(를) 삭제합니다.`;
  swal.fire({
      title: '삭제하시겠습니까?',
      text : title,
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
           url: info.url,
           method:"POST",
           data:{delete_id: info.id },
           dataType:'JSON',
           success:function(res)
           {
             if( res.result =='error'){
               iziToast.success({
                 message: res.msg,
                 position: 'topRight'
               });
               return;
             } else {
               iziToast.success({
                 message: '삭제되었습니다.',
                 position: 'topRight'
               });
             }
             if( typeof info.reload !='undefined')   info.reload.ajax.reload(null, false);
          },
           error: function ( err ){
             ajaxErrorST(err)
           }
         });
      } else {
      swal.fire('취소되었습니다.');
      }
    });
}		
		/* getpost */
	function getpost( url,data , callbackSuccess, callbackCompleted ){
		$.ajax({
							url : '{{ Config::get('site.defaultStartUrl') }}/refresh',
							method:"get",
							dataType:'JSON',
							success:function(result){
								$('meta[name="csrf-token"]').attr('content', result.token);
									$.ajaxSetup({
											headers: {
													'X-CSRF-TOKEN': result.token
											}
									});
						
									$.ajax({
										url: url,
										method:"POST",
										data: data ,
										dataType:'JSON',
										success:function(res)
										{
											callbackSuccess(res)
										},
										error: function ( err ){
											ajaxErrorST(err)
										},
										complete : function() {
											if ( typeof callbackCompleted != 'undefined') callbackCompleted();
										}
									});
							}, // end success
								
						});
	}
	
	
		<!-- test sock -->
		/*
		//var ws = new WebSocket('wss://modoosock.run.goorm.io');
		var ws = new WebSocket('wss://modoo24.net:3000');
		ws.onopen = (event) => {
			console.log ( 'open....')
			let sendData = { event: 'open' }
			ws.send(JSON.stringify(sendData));
		}
		ws.onmessage = (event) => {
			console.log ( event );
			let recData = JSON.parse(event.data);
			switch (recData.event) {
				case 'response':
					console.log(recData.data);
					break;
				case 'pong': 
					iziToast.success({ message : recData.data.msg, position : 'bottomRight'})
					break;
			}
		}
		*/
	</script>
	
	@yield('script')
</body>

</html>
