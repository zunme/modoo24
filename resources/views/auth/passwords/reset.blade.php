@extends('layouts.modooblank')

@section('css')
<link rel="stylesheet" type="text/css" href="/v1/css/community.css" />
@endsection

@section('content')
<div class="container">
    <section id="modoologin" class="row">
        <div class="col-md-8 col-md-offset-2">
            <div>
                <a class="ereset_logo" href="/"><img src="/NEW/image/main_N/logo.png">모두이사</a>
                <div class="login_title">
                 <h1 class="ereset_title">비밀번호 재설정</h1>
                <!-- <h5>본인인증 이메일 클릭 후 비밀번호 재설정 페이지입니다.</h5>-->
                </div>
                <div class="panel-body">
                     <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12 control-label">이메일 입력 E-Mail Address</label>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">패스워드 입력 Password</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">패스워드 확인 Confirm Password</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn login-btn">
                              비밀번호 재설정 하기
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
