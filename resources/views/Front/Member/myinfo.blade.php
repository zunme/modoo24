@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/NEW/css/community.css" />
@endsection

@section('body_bottom','')

@section('content')
<div class="contents_wrap">

    <div class="visual_mymodoo">
        <h1>모두이사 회원</h1>
        <!--<h4>모두이사 회원정보 페이지입니다.</h4>-->
    </div>    <!--//common_visual-->

    
    <div class="sub_menu_N">
      <ul>
          <li class="h_icon" onclick="window.open('/v2/')">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                  <path fill="none" d="M0 0h24v24H0z"></path>
                  <path d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19z" fill="rgba(255,255,255,1)"></path>
              </svg>
          </li>
          <li class=""><a href="modify">회원정보수정</a></li>
          <li class=" on "><a href="myinfo">나의정보</a></li>
          <!-- <li class=""><a href="hometown">우리동네자랑하기</a></li>-->
      </ul>
    </div>

    <form id="form_submit">
        <input name="cmd" type="hidden" value="write_proc" />

        <div class="center">
            <div id="knows_form">
                <form class="form-horizontal" method="POST" action="">
                    <h2 class="cop_title" style="margin-bottom: 5px;">모두이사 나의 정보</h2>
                    <h4 class="cop_title_s" style="margin-top: 0px;">모두이사 고객님의 회원정보와 활동정보 입니다.</h4>
                    <div class="home_center" style="margin-bottom:40px; padding:20px 0;">
                        <div class="my_home_cp">
                            <div class="card_bg">
                                <ul class="myinfo">
                                    <li>
                                        <h2 class="">닉네임</h2>
                                        <div class="mytxt">
                                            <span>{{$user->nickname}}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="">이메일</h2>
                                        <div class="mytxt">
                                            <span>{{$user->email}}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="">이 름</h2>
                                        <div class="mytxt">
                                            <span>{{$user->name}}</span><!-- 선택항목에 이름을 넣지 않을을 경우 나오지 않습니다. -->
                                        </div>
                                    </li>

                                    <li>
                                        <h2>휴대폰번호</h2>
                                        <div class="mytxt">
                                            <span>@if($user->phone=='')휴대폰번호를 등록해주세요.@else{{$user->phone}}@endif</span><!-- 선택항목에 휴대폰번호를 넣지 않을을 경우 나오지 않습니다. -->
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="">연동계정</h2>
                                        @if ( $user->provider =='web' )
                                        <div class="account"><p class="modoo_bg"></p><span class="sns_txt">모두이사 회원가입 계정 사용</span></div>
                                        @elseif ( $user->provider =='kakao' )
                                        <div class="account"><p class="kakao_bg"></p><span class="sns_txt">카카오톡 계정 사용</span></div>
                                        @elseif ( $user->provider =='naver' )
                                        <div class="account"><p class="naver_bg"></p><span class="sns_txt">네이버 계정 사용</span></div>
                                        @endif

                                    </li>
                                    <li>
                                      <a type="button" class="btn btn_w_ok" href="/community/member/modify">나의정보 수정하기</a>
                                      <a type="button" class="btn btn_m_remove" href="/community/member/withdrawal">회원탈퇴</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <a id="simpleorder" class="Refresh" href="/" style="top: 250px;"> <img src="/bmk/image/sub/Refresh.png" alt=""> </a>
                    </div>
                </form>
            </div>
        </div>
    </form>


</div>

@endsection

@section('script')
<script>

</script>
@endsection
