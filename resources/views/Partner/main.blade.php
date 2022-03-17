<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="format-detection" content="telephone=yes">
	<link rel="stylesheet" type="text/css" href="/m/css/common.css?v=20220121">


	<title>모두이사지점관리자</title>
	<!-- <script src="http://code.jquery.com/jquery-3.1.1.slim.min.js"></script>  -->
	<script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
	<script src="/m/js/m_common2.js"></script>

	<!-- handlebar -->
	<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>


	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer">

	

	<link rel="stylesheet" type="text/css" href="/m/css/sub.css?v=20210819">

	<link rel="stylesheet" type="text/css" href="/m/css/font.css?v=20210819">

</head>

<header>
	<a class="arrow_L" href="javascript:history.back(-1);"><img src="/m/image/arrow_L.png" alt="<"></a> <p class="title">내정보</p>
	<div class="mobile-nav-button main-nav-button">
	<div class="mobile-nav-button__line"></div>
	<div class="mobile-nav-button__line"></div>
	<div class="mobile-nav-button__line"></div>
	</div>

<nav class="mobile-menu">
    <div id="company_info">
        <div>
            <a class="home" href="/m/">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path d="M6 19h12V9.157l-6-5.454-6 5.454V19zm13 2H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM7.5 13h2a2.5 2.5 0 1 0 5 0h2a4.5 4.5 0 1 1-9 0z"></path>
                </svg>
            </a>
            <a class="mn_logout" href="/m/index?cmd=logout" traget="_self"><span>로그아웃 </span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path d="M5 22a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v3h-2V4H6v16h12v-2h2v3a1 1 0 0 1-1 1H5zm13-6v-3h-7v-2h7V8l5 4-5 4z" fill="rgba(122,122,122,1)"></path>
                </svg>
            </a>

        </div>

        <h2>{{$staff->s_company}}</h2>
        <div class="pn_info">
            <h1 class="point">{{$staff->point}} <span>p</span></h1>
            <div class="btn_type">
                <!-- <button class="pn_type" type="button">방문 일반제</button> -->
                <button class="pn_type" type="button">{{$staff_type_str}}</button>                            </div>
            <div class="point">
                <ul>
                    <li class="fl_L pointxt"></li>
                    <li class="fl_R"></li>
                </ul>
            </div>

        </div>
    </div>



	<div class="flight-types">
		  <input type="radio" name="share_flag" value="Y" id="coach" checked="" onclick="set_share('Y');">
		  <label for="coach">
		      분배허용
		  </label>

		  <input type="radio" name="share_flag" value="N" id="business" onclick="set_share('N');">
		  <label for="business">
		      분배금지
		  </label>
	</div>


	<div id="feedback_share_area"></div>

	<div class="icon_menuBox">
		<ul>
			<li onclick="location.href='/m/mypage/my_graph' "><span class="icon_mygraph"></span><span class="icon_txt">나의통계</span></li>
			<li onclick="location.href='/m/mypage/my_point' "><span class="icon_mypoint"></span><span class="icon_txt">포인트내역</span></li>
			<li onclick="location.href='/m/mypage/deadline' "><span class="icon_mycalreder"></span><span class="icon_txt">마감설정</span></li>
		</ul>
	</div>
    <div class="icon_menuBox2">
        <ul>
            <li onclick="location.href='/m/community/jisik' "><span class="icon_knowledge"> </span> <span class="icon_txt2">나의  이사지식인 답글</span></li>
            <li onclick="location.href='/m/feedback/fb_wait' "><span class="icon_myfeedback"> </span> <span class="icon_txt2">이용후기 피드백관리</span></li>
            <li onclick="location.href='/m/calendar/monthly' "><span class="icon_myday"> </span><span class="icon_txt2">일정관리</span></li>
            <!--<li onclick="location.href='/m/mypage/my_page' "><span class="icon_myinfo"> </span><span class="icon_txt2">내정보</span></li>-->
            <li onclick="location.href='/m/mypage/area_setup' "><span class="icon_mylocation"> </span><span class="icon_txt2">지역설정</span></li>
            <li onclick="location.href='/m/notice/notice' "><span class="icon_mynotice"> </span><span class="icon_txt2">공지사항</span></li>
            <li onclick="location.href='/community/partner?id={{$staff->s_uid}}' "><span class="icon_mysetup"> </span><span class="icon_txt2">내정보 설정</span></li>
        </ul>
    </div>
    <div class="menuft">사업자 등록번호 : 236-81-01081 Copyright (c) 2019 ModooPlatform</div>
</nav>

</header>

<body>

<style>
	.flight-types {
	  display: flex;
	  position: relative;
	  user-select: none;
	  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	  position: relative;
	  z-index: 1;
	  margin: 0 auto;
	  font-size: 16px;
	  border: 1px solid #00beff;
	  border-radius: 3px;
	  color: #000;
	  font-weight: bold;
	}
	.flight-types > input {
	  display: none;
	}
	.flight-types > input:checked + label {
	  color: #ffffff;
	  background-color: blue;
	}
	.flight-types > input:nth-of-type(1):checked ~ label:last-of-type:before {
	  transform: translateX(calc(0% + 0px));
	}
	.flight-types > input:nth-of-type(2):checked ~ label:last-of-type:before {
	  transform: translateX(calc(100% + 0px));
	}
	.flight-types > input:nth-of-type(3):checked ~ label:last-of-type:before {
	  transform: translateX(calc(200% + 0px));
	}
	.flight-types label {
	  flex: 1;
	  text-align: center;
	  white-space: nowrap;
	  overflow: hidden;
	  text-overflow: ellipsis;
	  cursor: pointer;
	}
	.flight-types label:last-of-type:before {
	  content: "";
	  display: block;
	  max-width: calc(33.3333333333% - 0px);
	  margin: 0px;
	  position: absolute;
	  top: 0;
	  right: 0;
	  bottom: 0;
	  left: 0;
	  z-index: -1;
	  transform: translateX(0);
	}
	.flight-types label {
	  padding: 6px 3px;
	  transition: color 250ms cubic-bezier(0, 0.95, 0.38, 0.98);
	}
	.flight-types label:before {
	  transition: all 250ms cubic-bezier(0, 0.95, 0.38, 0.98);
	}
	.flight-types label:not(:last-child) {
	  border-right: 1px solid #fff;
	}

</style>

<style>
    .addr_area {
        z-index: 1000001;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: none;
    }

    #addr_search {
        margin: 5% auto 0 auto;
    }

    .layer_pop_close_btn {
        float: right;
        margin: 20px;
        padding: 3px 13px;
        border: 1px solid #999;
        border-radius: 5px;
        background: #000;
        font-size: 1.4em;
        color: #fff;
        cursor: pointer;
    }

    .custom-file-container__image-multi-preview {
	    position: relative;
	    box-sizing: border-box;
	    transition: all 0.2s ease;
	    border-radius: 6px;
	    background-size: cover;
	    background-position: center center;
	    background-repeat: no-repeat;
	    float: left;
	    margin: 20px;
	    width: 130px;
	    height: 90px;
	    box-shadow: 0 4px 10px 0 rgb(51 51 51 / 25%);
	}


    body {
        background: #e7e7e7;
    }

       .pic_icon{color:#398adb; margin-right:3px;}
       .imgbox-wrap{overflow: hidden;}
       .imgstyle{background:#fff; text-align:center;}
       .need_upload_txt {
           display: none;
           padding-bottom: 15px;
           height: 28px;
       }


       .imgprevbox-comp {
           z-index: 1000;
           width: 97%;
       }

       .my_title dt {
          margin-bottom: 0px !important;
       }

       .my_title {padding-left: 10px;}
       .my_title dt{font-size: 1.15em; color:#666666; position:relative;}
       .my_title dt i{color:#cccccc;}
       .my_title dd.txt_darkred{font-family: "NotoSansCJKkr-Light"; color:#cc0000; padding-left: 14px; font-size: 0.95em;}
       .my_title dd.txt_gray{color:#666666;}

       .add_pic {
          cursor: pointer;
          position: absolute;
          right: 0.5em;
          top: 10px;
          font-size: 0.9em;
       }

       #pvev_area{
		text-align: center; 
		margin:10px 0 15px 0;
	}
       #pvev_area .imgprevcol{
           width: 50%;
           float:left;
        }

       .imgprevbox .thumbnail {
           min-height: 100px;
           max-width: 100%;
           margin: auto;
           text-align: center;
           background-color: #fff;
           border: 1px solid #ddd !important;
           -webkit-transition: border .2s ease-in-out;
           -o-transition: border .2s ease-in-out;
           transition: border .2s ease-in-out;
       }


       .imgprevbox .thumbnail img{
           max-width: 100%;
           max-height: 100px;
       }

       .thumbnail a>img, .thumbnail>img {
           margin-right: auto;
           margin-left: auto;
       }

       .service{
           background: #f7f7f7;
           border-radius: 15px;
           margin: 10px 10px;
           padding: 6px 0 6px 9px;
        }

       .visit{padding-top: 3px !important; margin:0.5em 0;}
       .visit dt {
           width: 19%;
           display: inline-block;
           font-size: 0.85em;
           color: #666666;
           letter-spacing: -1px;
       }
        .visit dd{
           display: inline-block;
        }

        .service_tabs input[type=checkbox]{
          display: none;
        }

        .service_tabs input[type=checkbox] + label {
           font-size: 0.8em;
           background: #ffffff;
           text-align: center;
           color: #4a87c6;
           transition: all 0.2s ease;
           border-radius: 10px;
           box-sizing: border-box;
           border: 1px solid #cccccc;
           padding:0.2em 0.5em 0.3em 0.4em;
        }

        .service_tabs input[type=checkbox]:checked + label {
           background: #55acee;
           color: #ffffff;
           border: 1px solid #4790c8;
        }

        .service_tabs label i{
          font-size: 0.95em;
          margin-right: 2px;
          vertical-align: middle;
        }

        .my_title .my_select{
           padding: 0.5em 0 1em;
        }

        .my_title .my_select select{
             color:#666666;
             font-size: 1em;
             width:95%;
             padding:0.65em;
             border:1px solid #d1d1d1;
             background:url('/m/image/select_arw.png') no-repeat 95% 50%;
             border-radius:10px;
             -webkit-appearance: none;
             -moz-appearance: none;
             appearance : none;
        }

        input.bank_input{
            width: 46%;
            margin-right: 0.4em;
            padding-left: 10px;
        }

        input.bs_input{
            width:95%;
            padding-left:10px;
        }

        .my_title .my_bank{margin:1em 0;}

        .payment_tabs {
           height: 4.5em;
           padding: 0em 0.5em 0.7em 0.5em;
        }

        .payment_tabs input[type=checkbox]{
          display: none;
        }

        .payment_tabs input[type=checkbox] + label {
           font-size: 1em;
           background: #ffffff;
           text-align: center;
           color: #4a87c6;
           transition: all 0.2s ease;
           border-radius: 10px;
           box-sizing: border-box;
           border: 1px solid #cccccc;
           padding: 0.2em 0.8em 0.3em;
           display: inline-block;
           margin: 0em 0.2em 0.7em 0.3em;
        }

        .payment_tabs input[type=checkbox]:checked + label {
           background: #55acee;
           color: #ffffff;
           border: 1px solid #4790c8;
        }
	.btn_add{
	    cursor: pointer;
	}

	#modal_popview{
		display:none;
	}

	.imgprevbox .thumbnail {
		min-height:110px !important;
	}

	.company_photo{
		color: #2e2e2e;
		margin-bottom: 15px;
		font-size: 16px;
	}
	.company_photo li:last-of-type{
		color: #226ab2;
		font-weight: bold;
	}

</style>




<div id="mypage">
    <h2>{{$staff->s_company}}</h2>
    <div class="case_wrap">
	<div class="case">{{$staff_type_str}}</div>
	
    </div>
</div>

<div class="addr_area">
    <p class="layer_pop_close_btn">X</p>
    <div id="addr_search"></div>
</div>

<div id="wrapper" class="pdt0">
	<div class="part_tabs">
		<input id="public_cus" class="tablinks active" type="radio" name="tab_item" value="public" checked onclick="openTab(event, 'tab1')">
		<label class="tab_item_vit" for="public_cus" style="margin-left:10px;" >고객에게 <strong>공개</strong></label>

		<input id="untact_mypage" class="tablinks" type="radio" name="tab_item" value="untact" onclick="openTab(event, 'tab2')" >
		<label class="tab_item_vit" for="untact_mypage" >고객에게 <strong>비공개</strong></label>
	</div>

	<form class="wrapper_95box" id="submit_form" style="padding-bottom: 100px" enctype="multipart/form-data" >
	{{ csrf_field() }}
	<input name="cmd" type="hidden" value="modify" />
	<input name="s_uid" type="hidden" value="{{$staff->s_uid}}" />

        <div class="mypage">
		<div id="tab1" class="tabcontent public" style="display:block">
			<h3><i class="fas fa-info-circle"></i> 고객에게 공개되는 정보</h3>
			<ul class="company_photo">
				<li>업체명과 함께 로고, 작업 사진을 보내주시면 확인 즉시 업로드됩니다.</li>
				<li>모두이사 010-3012-7728</li>
			</ul>
			<div class="sub-block-wrap">
				<div class="sub-header-title" style="display:flex;justify-content: space-between;">
				   <div>
				       <!-- <span class="pic_icon"><i class="far fa-clone"></i></span> <span>대표사진 등록(로고)<br><b class="pic_cmt">연락처 정보 입력 시, 사전 안내 없이&nbsp;수정,&nbsp;삭제될 수&nbsp;있습니다.</b><span> -->
					   </span></span>
				   </div>
				<!--
				   <div class="btn_add">
				       <span class="btn_search" onclick="addCompImage()">
					   찾아보기
				       </span>
				   </div>
				-->
				</div>
				<div class="display-flex justify-content-flex-end" style="  flex-direction: column; justify-content: flex-end;">

				   <div class="display-flex imgbox-wrap" id="companyimgprevarea">
				   	<!--
				       <div class="need_upload_txt imgstyle" onclick="addCompImage()">
					   이미지파일을 선택해주세요
				       </div>
				       -->
				   </div>
				</div>
			</div>

			<div>
				<dl class="my_title">
				  <dt><i class="fas fa-chevron-right"></i> 이사 작업 사진
					<!--
					 <div class="add_pic">
					  <span class="btn_search" onclick="addImage()">
					      찾아보기
					  </span>
					 </div>
					 -->
				  </dt>
				  <!-- <dd class="txt_darkred">최대 4장의 사진을 업로드하세요</dd> -->
				</dl>
				<div class="row" id="pvev_area">
				@if($subfiles)
					@foreach ($subfiles as $key => $value)
						@if(isset($value->file_name))
						<div class="imgprevcol">
							<div class="imgprevbox img-raised">
								<!--
								<i class="remove_file_btn fas fa-times ui-1_simple-remove" data-id="{{$key}}" onclick="removeOrgFile(this)"></i>
								-->
								<div class="thumbnail">
									<img src="{{ $value->path }}/{{ $value->file_name_real }}">
								</div>
								<div class="thumbnail-byte">{{$value->file_size}} bytes</div>
								<div class="thumbnail-title ellipsis">{{ $value->file_name }}</div>
							</div>
						</div>
						@endif
					@endforeach
				@endif
				</div>
			</div>

			<div style="display: inline-block;width: 100%;">
				<dl class="my_title">
				  <dt><i class="fas fa-chevron-right"></i> 제공 서비스
				  </dt>
				  <dd class="txt_gray">수정이 필요하신 경우, 고객센터에 연락주세요</dd>
				</dl>
				<div class="service">
				  <dl class="visit">
				      <dt>방문견적</dt>
				      <dd class="service_tabs">
					<input type="checkbox" id="service_cus1" name="service_item1" disabled @if( $staff->s_classify1 =='1' ) checked @endif>
					<label for="service_cus1"><i class="fas fa-home"></i>가정</label>

					<input type="checkbox" id="service_cus2" name="service_item2" disabled @if( $staff->s_classify2 =='1' ) checked @endif>
					<label for="service_cus2"><i class="fas fa-building"></i>사무실</label>

					<input type="checkbox" id="service_cus3" name="service_item3" disabled @if( $staff->s_classify3 =='1' ) checked @endif>
					<label for="service_cus3"><i class="fas fa-box-open"></i>소형</label>
				      </dd>
				  </dl>
				  <dl class="visit">
				      <dt>비대면견적</dt>
				      <dd class="service_tabs">
					<input type="checkbox" id="service_cus4" name="service_item4" disabled @if( $staff->s_classify4 =='1' ) checked @endif>
					<label for="service_cus4"><i class="fas fa-home"></i>가정</label>

					<input type="checkbox" id="service_cus5" name="service_item5" disabled @if( $staff->s_classify5 =='1' ) checked @endif>
					<label for="service_cus5"><i class="fas fa-building"></i>사무실</label>

					<input type="checkbox" id="service_cus6" name="service_item6" disabled @if( $staff->s_classify6 =='1' ) checked @endif>
					<label for="service_cus6"><i class="fas fa-box-open"></i>소형</label>

					<input type="checkbox" id="service_cus7" name="service_item7" disabled @if( $staff->s_classify7 =='1' ) checked @endif>
					<label for="service_cus7"><i class="fas fa-truck"></i>차량만</label>
				      </dd>
				  </dl>
				</div>
			</div>
			<div>
				<dl class="my_title">
				  <dt><i class="fas fa-chevron-right"></i> 경력
				  </dt>
				  <dd class="my_select">
				    <select name="s_career">
				      <option value= "" @if( !$staff->s_career ) selected @endif>경력을 입력해주세요</option>
				      <option value = "1" @if( $staff->s_career =='1' ) selected @endif>1년 이상</option>
				      <option value = "3" @if( $staff->s_career =='3' ) selected @endif>3년 이상</option>
				      <option value = "5" @if( $staff->s_career =='5' ) selected @endif>5년 이상</option>
				      <option value = "10" @if( $staff->s_career =='10' ) selected @endif>10년 이상</option>
				      <option value = "15" @if( $staff->s_career =='15' ) selected @endif>15년 이상</option>
				      <option value = "20" @if( $staff->s_career =='20' ) selected @endif>20년 이상</option>
				      <option value = "30" @if( $staff->s_career =='30' ) selected @endif>30년 이상</option>
				    </select>
				  </dd>
				</dl>
			</div>

			<div>
				<dl class="my_title">
				  <dt><i class="fas fa-chevron-right"></i> 직원 수
				  </dt>
				  <dd class="my_select">
				    <select name="s_staff_num">
				      <option value= "" @if( !$staff->s_staff_num ) selected @endif>직원 수를 입력해주세요</option>
				      <option value = "1" @if( $staff->s_staff_num =='1' ) selected @endif>1~10명</option>
				      <option value = "2" @if( $staff->s_staff_num =='2' ) selected @endif>11~20명</option>
				      <option value = "3" @if( $staff->s_staff_num =='3' ) selected @endif>20~40명</option>
				      <option value = "4" @if( $staff->s_staff_num =='4' ) selected @endif>41명 이상</option>
				    </select>
				  </dd>
				</dl>
			</div>

			<div>
				<dl class="my_title">
				  <dt><i class="fas fa-chevron-right"></i> 계좌번호
				  </dt>
				  <dd class="my_bank">
				     <input class="bank_input" name="s_bank_title" type="text" maxlength='10' placeholder="은행명" value="{{$staff->s_bank_title}}"> <input class="bank_input" name="s_bank_ac_name" type="text" maxlength='10' placeholder="예금주" value="{{$staff->s_bank_ac_name}}">
				  </dd>
				  <dd class="my_bank">
				     <input class="bs_input" name="s_bank_ac_number" type="text" placeholder="계좌번호 0000-000-000000" value="{{$staff->s_bank_ac_number}}">
				  </dd>
				</dl>
			</div>

			<div>
				<dl class="my_title">
				  <dt><i class="fas fa-chevron-right"></i> 결제수단
				  </dt>
				</dl>
				<div class="service">
				  <dl class="visit">
				      <dd class="payment_tabs">
						<input type="checkbox" id="payment_cus1" name="s_payment[]" value="C" @if (in_array('C', $pay_ment)) checked @endif>
						<label for="payment_cus1">카드</label>
						<input type="checkbox" id="payment_cus2" name="s_payment[]" value="P" @if (in_array('P', $pay_ment)) checked @endif >
						<label for="payment_cus2">현금결제</label>
						<input type="checkbox" id="payment_cus3" name="s_payment[]" value="A" @if (in_array('A', $pay_ment)) checked @endif >
						<label for="payment_cus3">계좌이체</label>
						<input type="checkbox" id="payment_cus4" name="s_payment[]" value="R" @if (in_array('R', $pay_ment)) checked @endif >
						<label for="payment_cus4">현금영수증</label>
						<input type="checkbox" id="payment_cus5" name="s_payment[]" value="T" @if(in_array('T', $pay_ment)) checked @endif >
						<label for="payment_cus5">세금계산서</label>						
				      </dd>
				  </dl>
				</div>
			</div>

		</div>

		<div id="tab2" class="tabcontent untact" style="display:none">
			<div class="mp_wrap">
				<div class="mypage_title"><i class="fas fa-chevron-right"></i> 대표자</div>
				<div class="mypage_input"><input type="text" name="s_ceo_name" placeholder="홍길동" value="{{$staff->s_ceo_name}}"></div>
			</div>
			<div class="mp_wrap">
				<div class="mypage_title"><i class="fas fa-chevron-right"></i> 사무실주소</div>
				<div class="mypage_input"><input name="s_zip" id="s_zip" type="text" placeholder="우편번호" value="{{$staff->s_zip}}"></div>
				<div class="mypage_input"><input name="s_addr1" id="s_addr1" type="text" placeholder="주소" value="{{$staff->s_addr1}}" readonly onclick="sample2_execDaumPostcode();"/></div>
				<div class="mypage_input"><input name="s_addr2" placeholder="상세주소" value="{{$staff->s_addr2}}" type="text"  /></div>
			</div>

			<div class="mp_wrap">
				<div class="mypage_title"><i class="fas fa-chevron-right"></i> 고객접수번호</div>
				<div class="mp_numberwrap">
					<span class="mpnum">&#9312;</span>
					<div class="mypage_input"><input name="s_ceo_hp" type="text" placeholder="000-0000-0000" value="{{$staff->s_ceo_hp}}"></div>
					<div class="mypage_input_info">알림톡, 비대면 상담통화 </div>
				</div>
				<div class="mp_numberwrap">
					<span class="mpnum">&#9313;</span>
					<div class="mypage_input"><input name="s_ceo_hp_plus" type="text" placeholder="000-0000-0000" value="{{$staff->s_ceo_hp_puls}}"></div>
					<div class="mypage_input_info">알림톡 </div>
				</div>
			</div>
			<div class="mp_wrap">
				<div class="mypage_title"><i class="fas fa-chevron-right"></i> 장비현황</div>
				<div class="equip-wrap">
					<div class="equip-wrap-detail">
						<div class="eq-tltle">사다리차</div>
						<div class="eq-ipbox"><input type="number" name="s_sadari" placeholder="0" oninput='handleOnInput(this, 2)' value="{{$staff->s_sadari}}"></div>

						<div class="eq-num">대</div>
					</div>
					<div class="equip-wrap-detail">
						<div class="eq-tltle">0.5톤 라보</div>
						<div class="eq-ipbox"><input type="number" name="s_r_05t" placeholder="0" oninput='handleOnInput(this, 2)' value="{{$staff->s_r_05t}}"></div>
						<div class="eq-num">대</div>
					</div>
					<div class="equip-wrap-detail">
						<div class="eq-tltle">0.5톤 다마스</div>
						<div class="eq-ipbox"><input type="number" name="s_d_05t" placeholder="0" oninput='handleOnInput(this, 2)' value="{{$staff->s_d_05t}}"></div>
						<div class="eq-num">대</div>
					</div>
					<div class="equip-wrap-detail">
						<div class="eq-tltle">1톤</div>
						<div class="eq-ipbox"><input type="number" name="s_1t" placeholder="0" oninput='handleOnInput(this, 2)' value="{{$staff->s_1t}}"></div>
						<div class="eq-num">대</div>
					</div>
					<div class="equip-wrap-detail">
						<div class="eq-tltle">2.5톤</div>
						<div class="eq-ipbox"><input type="number" name="s_2_5t" placeholder="0" oninput='handleOnInput(this, 2)' value="{{$staff->s_2_5t}}"></div>
						<div class="eq-num">대</div>
					</div>
					<div class="equip-wrap-detail">
						<div class="eq-tltle">5톤</div>
						<div class="eq-ipbox"><input type="number" name="s_5t" placeholder="0" oninput='handleOnInput(this, 2)'  value="{{$staff->s_5t}}"></div>
						<div class="eq-num">대</div>
					</div>
				</div>
		      </div>
		</div>
        </div>

	<input type="hidden" name="s_mobile_memo" value="{{$staff->s_mobile_memo}}">

	<button type="button" class="button" style="width: 100%" onclick="modify('{{$staff->s_uid}}') ">수정</button>
	@if(isset($p_ip))
		@if($p_ip == '221.154.134.7')
		<a href="/community/partner/test">테스트</a>
		@endif
	@endif
    </form>
</div>

<div id="feedback"></div>





<script>
  @if($regfiles)
	  @if(isset($regfiles['title_img']->thumb))
	  let companyimage = '{{ $regfiles['title_img']->thumb }}';
	  @else
	  let companyimage = '{{ $regfiles['title_img']->path }}/{{$regfiles['title_img']->file_name_real}}';
	  @endif
  @Else 
	let companyimage = '';
  @endif
</script>



<script type="text/javascript">
    <!--
    var set_share = function(f) {
        $.ajax({
            type: "POST",
            url: "/m/index",
            data: {
                cmd: "share_chagne_proc",
                flag: f
            },
            success: function(html) {
                $("#feedback_share_area").html(html);
            }
        });
    }

	function openTab(evt, tabName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent"); // 컨텐츠를 불러옵니다.
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none"; //컨텐츠를 모두 숨깁니다.
		}

		tablinks = document.getElementsByClassName("tablinks"); //탭을 불러옵니다.
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", ""); //탭을 초기화시킵니다.
		}
		document.getElementById(tabName).style.display = "block"; //해당되는 컨텐츠만 보여줍니다.
		evt.currentTarget.className += " active"; //클릭한 탭을 활성화시킵니다.
	}


	function handleOnInput(el, maxlength) {
		if(el.value.length > maxlength)  {
			el.value = el.value.substr(0, maxlength);
		}
	}

    -->
</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="/community/assets/modoo/mypage.css?ver=20211020000002">
<script src="/community/assets/modoo/mypage_v2.js?ver=202202240000000"></script>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script charset="UTF-8" type="text/javascript" src="//t1.daumcdn.net/postcode/api/core/190611/1560237575423/190611.js"></script>


<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
<script>
    var upload;
    $("document").ready(function() {

	
    })
   
    $(".layer_pop_close_btn").on("click", function() {
            $(".addr_area").hide();
        });


	totalImgCnt = {{$totalImgCount}}

	function removeOrgFile(btn) {
		let no = $(btn).data('id')
		$("#submit_form").append("<input type='hidden' name='delfile[]' value='"+no+"'>")
		$(btn).closest('.imgprevcol').remove()
		totalImgCnt--;
	}
	function addImage() {
		if ( totalImgCnt >= 4 ){
			alert('최대 4장까지만 사진 업로드가 가능합니다.');
			return
		}
		//console.log(totalImgCnt);
		++inpCnt;
		var inpdata = { inpCnt : inpCnt }
		var template = Handlebars.compile( $("#imgup_template" ).html() );
		$("#pvev_area").append( template(inpdata));
		$("#upfile" +inpCnt+ "_imp").trigger('click')
	}

</script>

<script type="text/javascript">
    <!--
    /* 레이어 팝업용 */
    var element_layer = document.getElementById('addr_search'); // 우편번호 찾기 화면을 넣을 element

    function closeDaumPostcode() {
        element_layer.style.display = 'none'; // iframe을 넣은 element를 안보이게 한다.
    }

    function sample2_execDaumPostcode() {
        // 검색 레이어 view
        $(".addr_area").show();

        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = data.address; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 기본 주소가 도로명 타입일때 조합한다.
                if (data.addressType === 'R') {
                    //법정동명이 있을 경우 추가한다.
                    if (data.bname !== '') {
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if (data.buildingName !== '') {
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    // fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                    // 바로위는 epp통신때문에 문자열 100바이트 제한때문에 사용 못함
                    fullAddr += (extraAddr !== '' ? '' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('s_zip').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('s_addr1').value = fullAddr;
                //document.getElementById('sample6_address_eng').value = data.addressEnglish;

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_layer.style.display = 'none';

                // 검색 레이어 view
                $(".addr_area").hide();
            },
            width: '100%',
            height: '100%'
        }).embed(element_layer);

        element_layer.style.display = 'block'; // iframe을 넣은 element를 보이게 한다.
        initLayerPosition(); // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
    }

    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
    function initLayerPosition() {
        var width = 400; //우편번호서비스가 들어갈 element의 width
        var height = 460; //우편번호서비스가 들어갈 element의 height
        var borderWidth = 2; //샘플에서 사용하는 border의 두께

        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';

        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width) / 2 - borderWidth) + 'px';
        element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height) / 2 - borderWidth) + 'px';
    }



    // 수정
    var modify = function(no) {
        var url = '/community/partner/modify/'+no
	var form = 'submit_form'
	
	if (!confirm("수정 하시겠습니까?")) return;

	$(".imgprevcol.hide").remove()
	
	var data= new FormData( document.getElementById(form) );

	$.ajax({
		url : '/community/refresh',
		method:"get",
		dataType:'JSON',
		success:function(result){
			//console.log(result)
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
					contentType: false,
					cache: false,
					processData: false,
					success:function(res)
					{
						console.log (res)
						if(res.status == 'Success'){
							alert(res.message);
							location.reload();
						} else {
							alert(res.message);
						}
					},
					error: function ( err ){
						if(err.status != 422 && err.status != 500 ) {
							alert('잠시 후 이용해주세요');
						} else {
							var jsonString = JSON.stringify(err.responseJSON);

							alert(jsonString);
						}
					}
				});

		} // end success
	});

    }


    -->
</script>



@verbatim
<script type="text/template" id="imgup_template">
	<div class="imgprevcol hide" id="upfile{{ inpCnt }}_col">
		<div class="imgprevbox img-raised">


			<div class="thumbnail ">
				<img src="" alt="..."  id="upfile{{ inpCnt }}_preview">
			</div>
			<div class="thumbnail-byte" id="upfile{{ inpCnt }}_byte">
				byte
			</div>
			<div class="thumbnail-title ellipsis" id="upfile{{ inpCnt }}_filename">
				name
			</div>
			<input type="file" name="upload_img1[]" accept=".jpg, .png, .jpeg" class="hide" id="upfile{{ inpCnt }}_imp" onChange="readURL(this, 'upfile{{ inpCnt }}')"/>
		</div>
	</div>
</script>
@endverbatim


</body>
</html>
