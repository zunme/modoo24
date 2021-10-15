@extends('layouts.modooblank')

@section('css')
<style>
.container{
	margin-top: 60px;
}
.card .card-header-primary {
    box-shadow: 0 5px 20px 0px rgb(0 0 0 / 20%), 0 13px 24px -11px rgb(9 148 239 / 54%);
}
.card .card-header-primary, .card.bg-primary, .card.card-rotate.bg-primary .front, .card.card-rotate.bg-primary .back {
    background: linear-gradient(
60deg, #00beff, #0994ef);
}
.mg-10{
	margin-top: 10px;
	margin-bottom: 10px;
}
	.btn_login_naver img{
		width:183px;
		height:45px;
	}
	.help-block{
		padding-left: 70px;
	}
	.btn-link > img{
		    width: 180px;
				height:40px;
	}
	.btn-link { padding : 0; margin-top:10px;}
	.autologin-wrap{
		padding: 0 !important;
		margin-top: 10px !important;
		margin-bottom: 10px !important;
	}
	.card-login .form-check label {
    margin-left: 18px;
    line-height: 20px;
}
.forgotpassword{
	font-size: 14px;
	padding-top: 0px;
	color: #51a2d7;
}
.warning-message{
	text-align: center;
    margin: 12px 0;
    color: #e1346f;
    font-size: 14px;
}
</style>
@endsection

@section('content')



<div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-9 ml-auto mr-auto">
					<form class="form-horizontal" method="POST" action="{{ route('login') }}">
							{{ csrf_field() }}
            <div class="card card-login card-hidden">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">모두이사 로그인</h4>
                <div class="social-line">

									<a class="btn btn-link btn-whitebtn_login_kakao" href="login/kakao">
										<img src="/community/images/kakao_login_medium_narrow.png" />
									</a>
									<a class="btn btn-link btn-whitebtn_login_naver" href="login/naver">
										<img src="/community/images/naver_large.png" />
									</a>

                </div>
              </div>
              <div class="card-body ">
                <p class="card-description text-center">우리집 이사, 청소엔 모두이사</p>
@if (session('warning'))
	<p class="warning-message">
	{!! session('warning') !!}
	</p>
@endif
                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">email</i>
                      </span>
                    </div>
										<input id="email" type="email" class="form-control" placeholder="Email..." name="email" value="{{ old('email') }}" required autofocus>
                  </div>
									@if ($errors->has('email') || $errors->has('password') )
											<span class="help-block">
													<strong>이메일과 패스워드를 확인해주세요</strong>
											</span>
									@endif
                </span>
                <span class="bmd-form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock_outline</i>
                      </span>
                    </div>
										<input id="password" type="password" class="form-control" name="password" required>
                  </div>
									@if ($errors->has('password'))
											<span class="help-block">
													<strong>{{ $errors->first('password') }}</strong>
											</span>
									@endif
                </span>


								<div class="row mg-10">
										<div class="col-xs-6">
											<span class="bmd-form-group">
													<div class="form-check autologin-wrap">
							                <label class="form-check-label">
							                  <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
							                  자동로그인
							                  <span class="form-check-sign">
							                    <span class="check"></span>
							                  </span>
							                </label>
							              </div>
												</span>
										</div>
										<div class="col-xs-6 text-right">
											<a class="btn btn-link forgotpassword" href="{{ route('password.request') }}">
													패스워드찾기
											</a>
										</div>
								</div>


              </div>

              <div class="card-footer justify-content-center">
                <button type="submit" class="btn btn-primary btn-md">로그인</button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
