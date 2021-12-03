@extends('layouts.modooblank')

@section('css')
<link rel="stylesheet" type="text/css" href="/v1/css/community.css" />
@endsection

@section('content')
<div class="contents_wrap">
    <!-- content ST -->

    <div class="container">
        <section id="modoologin" class="row">
            <div class="col-md-8 col-md-offset-2">
                <div>

                    <div class="login_title"><h1>로그인</h1><a href="/"><img src="/NEW/image/main_N/logo.png">모두이사</a></div>
                    <div class="panel-body">
											<form class="form-horizontal" method="POST" action="{{ route('login') }}">
													{{ csrf_field() }}
                            <div class="form-group">
                                <label for="email" class="col-md-12 control-label">이메일 입력 E-Mail Address</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="" required autofocus>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-12 control-label">패스워드 입력 Password</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                </div>
                            </div>

                            <button type="submit" class="btn login-btn">
                                  로그인하기
                            </button>

                            <div class="join_alert">
															@if (session('warning'))
																{!! session('warning') !!}
															@endif
															@if ($errors->has('email') || $errors->has('password') )
																	이메일과 패스워드를 확인해주세요
															@endif
                            </div>

                            <div class="member">
                                <div class="autologin">
                                    <div class="checks etrans">
                                        <input type="checkbox" id="ex_chk" name="remember" value="Y" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="ex_chk"></label>
                                            <span class="autotext">자동로그인</span>
                                    </div>
                                </div>
                                <div class="repass">
                                    <a class="btn-link" href="{{ route('password.request') }}">
                                        비밀번호 재설정
                                    </a>
                                </div>
                                <div class="memberjoin">
                                    <a class="btn-link" href="{{ route('register') }}">
                                        회원가입
                                    </a>
                                </div>
                            </div>
                        </form>
                        <div class="social_login_wrap">
                            <div class="social_login_inner">
                                <a class="btn btn_login_kakao" href="login/kakao">
                                  <span><img src="/NEW/image/sub/kakaol.png" alt="kakaoci"></span>카카오로 로그인
                                </a>
                                <a class="btn btn_login_naver" href="login/naver">
                                  <span><img src="/NEW/image/sub/naver_ci.png" alt="naverci"></span>네이버로 로그인
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
	</div>
@endsection

@section("script")
  @if (session('warning'))
    <script>
    swal.fire('',`{!! session('warning') !!}`)
    </script>
  @endif
@endsection
