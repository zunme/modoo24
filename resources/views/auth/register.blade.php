
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
    <link rel="stylesheet" type="text/css" href="/v1/css/common.css" />
    <link rel="stylesheet" type="text/css" href="/v1/css/font.css" />
    <link rel="stylesheet" type="text/css" href="/v1/css/main_popup.css" />

    <!--   Core JS Files 메뉴    -->
    <script src="/v1/js/core/popper.min.js" type="text/javascript"></script>
    <script src="/v1/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
    <script src="/v1/js/material-kit.js?v=2.0.7" type="text/javascript"></script>

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


    <!-- Styles -->
    <link rel="shortcut icon" href="/modoo24.ico" />

    <link rel="stylesheet" type="text/css" href="/v1/css/community.css" />
</head>

<body>
    <section id="modoologin">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="login_title">
                        <h1>회원가입</h1><a href="/"><img src="/v1/image/main_N/logo.png">모두이사</a>
                    </div>
                    <div class="social_login_wrap">
                        <div class="social_register">
                            <a class="btn btn_login_kakao" href="login/kakao">
                                <span><img src="/v1/image/sub/kakaol.png" alt="kakaoci"></span>카카오로 회원가입
                            </a>

                            <a class="btn btn_login_naver" href="login/naver">
                                <span><img src="/v1/image/sub/naver_ci.png" alt="naverci"></span>네이버로 회원가입
                            </a>

                        </div>
                    </div>

                    <div class="">


                        <div class="panel-body">
                          <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="regform">
                              {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="name" class="col-md-12 control-label">닉네임 입력 Nickname</label>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('name'))
                                        <p class="register_alert">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-12 control-label">이메일 입력 E-Mail Address</label>

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <p class="register_alert">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-12 control-label">패스워드 입력 Password</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" required>
                                        <!-- 비밀번호 구성 요건 -->

                                        @if ($errors->has('password'))
                                            <p class="register_alert">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-12 control-label">패드워드 확인 Confirm Password</label>

                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        <!-- 비밀번호 확인 요건 -->

                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn login-btn">
                                            모두이사 회원가입
                                        </button>
                                        <!-- 회원가입 코멘트 : 회원가입을 위해 이메일 인증이 필요합니다.
인증 이메일에서 인증버튼을 클릭하여 인증완료를 해주세요 -->
                                    </div>
                                </div>

                                <div class="member">
                                    <div class="agree_check">
                                        <div class="checks etrans">
                                            <input type="checkbox" id="ex_chk0" onclick="selectAll(this)">
                                            <label for="ex_chk0"></label>
                                            <p>
                                                전체 동의
                                            </p>
                                        </div>
                                        <div class="checks etrans">
                                            <input type="checkbox" id="ex_chk2" name="simplyRegPrivacy" value="Y">
                                            <label for="ex_chk2"></label>
                                            <p class="modalpop_link" link="/new_common/popup/accessterms.html">
                                                이용약관
                                            </p>
                                        </div>
                                        <div class="checks etrans">
                                            <input type="checkbox" id="ex_chk3" name="simplyRegJoint" value="Y">
                                            <label for="ex_chk3"></label>
                                            <p class="modalpop_link" link="/new_common/popup/personal_data.html">
                                                개인정보처리방침
                                            </p>
                                        </div>
                                        <div class="checks etrans">
                                            <input type="checkbox" id="ex_chk4" name="simplyMarketting" value="Y">
                                            <label for="ex_chk4"></label>
                                            <p>
                                                <span class="modalpop_link" link="/new_common/popup/personal_3.html">제3자 제공동의</span> /
                                                <span class="modalpop_link" link="/new_common/popup/mkt_ok.html">마케팅 동의</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div>이미 아이디가 있으신가요?
                                        <button type="button" class="btn agree_login" onclick="location.href='/community/login';">
                                            <a href="/community/login" class="agree_txt">
                                               로그인
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Scripts -->
    <!-- default script -->
    <script src="/community/assets/stisla/node_modules/moment/moment.js"></script>
    <script src="/community/assets/stisla/node_modules/moment/locale/ko.js"></script>
    <!--
     <script src="/community/assets/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/community/assets/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/community/assets/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
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

    <link href="/community/assets/css/fullcalendar.css" rel="stylesheet">
    <script src="/community/assets/js/fullcalendar.js"></script>
    <script>
    $("document").ready( function() {
      $('#regform').on('submit', function (e) {
         if (e.isDefaultPrevented()) {
           // handle the invalid form...
         } else {
           if( $("#ex_chk2:checked").val() !=='Y')   {
             iziToast.error({
                 message: '개인정보수집 및 이용에 동의해주세요',
                 position: 'bottomRight'
             });
             return false;
           }
           if( $("#ex_chk3:checked").val() !=='Y'){
             iziToast.error({
                 message: '개인정보의 제3자 제공에 동의해주세요',
                 position: 'bottomRight'
             });
             return false;
           }
           // everything looks good!
         }
       })
    })

    </script>
</body>

</html>
