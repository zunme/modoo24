@section('footer')
<!--푸터-->
<footer>
    <div class="center">
        <ul class="ft_link">
            <li class="modalpop_link" link="/new_common/popup/accessterms.html">
                이용약관
            </li>
            <li class="modalpop_link" link="/new_common/popup/personal_data.html">
               개인정보처리방침
            </li>
            <li class="modalpop_link" link="/new_common/popup/personal_3.html">
                제 3자 제공동의
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
