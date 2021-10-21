@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/NEW/css/community.css" />
@endsection

@section('body_bottom','')

@section('content')
<div class="contents_wrap">

    <div class="visual_mymodoo">
        <h1>모두이사 회원</h1>
        <h4>모두이사 회원정보 페이지입니다.</h4>
    </div>    <!--//common_visual-->


    <div class="sub_menu">
        <ul class="center">
            <li class="h_icon gotohome"></li>
            <li class="">회원정보수정</li>
            <li class="on">나의정보</li>
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
