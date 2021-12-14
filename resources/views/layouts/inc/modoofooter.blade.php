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
                <a href="/v1/move/custom_business">파트너제휴</a>
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
        <a href="mailto:master@modoo24.net">광고 및 제휴문의 – modoo24try@naver.com </a>

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
<style>
.fc .fc-daygrid-body-natural .fc-daygrid-day-events {
    height: 12px;
    max-height: 12px;
    font-size: 0;
    line-height: 0;
}
.popcal_sub_wrap{
    margin: 10px;
}
.popcal_sub_header{
    margin-bottom: 10px;
}
.popcal_sub_header:after{
  clear:both;
}
.popcal_son_box{
  width: 20px;
  height: 20px;
  display: inline-block;
  background-color: #b3eaea;
  line-height: 60px;
  border-radius: 5px;
  border: 1px solid #ddd;
  margin-right: 9px;
  float: left;
}
.popcal_sub_body{
  font-size: 14px;
  margin: 5px 5px 0 10px;
}
.warning-text{
  color: #e02525;
  margin-top: 5px;
}
/*
.popcal_sub_body{
  position: absolute;
  bottom: 0;
  padding-top: 24px !important;
  left: 0;
  right: 0;
  margin: 5px 2px 3px;
  background-color: white;
  z-index: 100;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;

  border-bottom: none;
  padding-left: 10px;
  padding-right: 10px;
  box-shadow: 0px -3px 4px 2px rgb(0 0 0 / 39%);
}
.popcal_sub_body_handle{
  height: 16px;
  position: absolute;
  left: 0;
  width: 100%;
  top: 0;
  background: #fff;
  cursor: pointer;
  z-index: 10;
  border-radius: 10px;
}
.popcal_sub_body_handle:after {
    content: '';
    width: 36px;
    height: 6px;
    position: absolute;
    left: 50%;
    top: 50%;
    margin-left: -18px;
    margin-top: -3px;
    border-radius: 3px;
    background: #666;
}
*/
</style>
<div class="modal fade" id="popcalendar_pop" tabindex="-1" role="dialog" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" id="popcalendar_pop_body">
      <div class="popcalendar_content">

        <div class="popcalendar_wrap">
          <div id="popcalendar"></div>
          <div class="popcal_sub_wrap">
            <div class="popcal_sub_header"><span class="popcal_son_box"></span><span>손 없는 날</span></div>
            <div class="popcal_sub_body">
              <div class="popcal_sub_body_handle"></div>
              <p>예부터 '손 없는 날'이란 악귀가 없는 날이란 뜻으로, 귀신이나 악귀가 돌아다니지 않아 길한 날을 의미합니다.</p>
              <p>비교적 비싼 이사 비용이 책정되고 있습니다.</p>
              <div class="warning-text">* 금요일, 월말, 손없는날을 피하면 보다 합리적인 이사 진행이 가능합니다.</div>
            </div>
          </div>
        </div>
      </div>
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
                              모두이사
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

<link href="/community/assets/css/fullcalendar.css" rel="stylesheet">
<script src="/community/assets/js/fullcalendar.js"></script>
<script src="/community/assets/js/calendar_locale.js?v=2"></script>


<style>
.fc {
    font-size: 14px;
}
.fc-toolbar-title{
  font-size: 22px;
}
.fc table {
    border-collapse: collapse;
    border-spacing: 0;
    font-size: 12px;
}
.fc .fc-daygrid-body-natural .fc-daygrid-day-events {
     margin-bottom: 0;
}
.fc .fc-daygrid-day-number-v2 {
    position: relative;
    z-index: 4;
    padding: 4px;
}
.fc .fc-button {
    padding: 1px 5px;
    margin-right: 2px;
  }
</style>
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
        @if (session('warning'))
          swal.fire('',`{!! session('warning') !!}`)
        @endif
    });
    //# sourceURL=pen.js

</script>


<script>
   /*************************************
       Menu Area
   *************************************/
   $(".menu-icon").click(function() {
      $('.menu-area').fadeIn();
      $('body').css({ "overflow-y": "hidden", "height": "100%" });
   });

   $("#colophon .company-information #footer-navigation ul li:nth-child(3)").click(function() {
      $('.menu-area').fadeIn();
      $('body').css({ "overflow-y": "hidden", "height": "100%" });
   });

   $(".menu-area .close-icon").click(function() {
      $('.menu-area').fadeOut();
      $('body').css({ "overflow-y": "auto", "height": "auto" });
   });
</script>

<script>
let calendar
function viewpopcal(){
  $("#popcalendar_pop").modal('show')
  setTimeout(drawcal, 500)
}
function drawcal(){
  var calendarEl = document.getElementById('popcalendar');
  calendar = new FullCalendar.Calendar( calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'ko',
            height:'auto',
            headerToolbar: {
                      left: '',
                      center: 'title',
                      right: 'prev,next'
                    },
            events: '/community/api/son',
            dayCellDidMount: function(info){
                var day = moment(info.date).format('D') // custom the text for example

                // hide the original one
                var originElement = info.el.querySelectorAll(".fc-daygrid-day-number")
                originElement.forEach(e => e.classList.add("d-none")  );

                // insert new text
                var targetElement = info.el.querySelectorAll(".fc-daygrid-day-top");
                targetElement.forEach(e => e.innerHTML = `<span class="fc-daygrid-day-number-v2">${day}</span>` );
            },
          });
  calendar.render()
  $("#popcalendar_pop").modal('handleUpdate')
}

</script>
@yield('script')

<!-- Google Tag Manager (noscript) -->
   <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MWJDGCQ"
   height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
   <!-- End Google Tag Manager (noscript) -->


<!-- 공통 적용 스크립트 , 모든 페이지에 노출되도록 설치. 단 전환페이지 설정값보다 항상 하단에 위치해야함 -->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"> </script>
<script type="text/javascript">
if (!wcs_add) var wcs_add={};
wcs_add["wa"] = "s_3a589317ff16";
if (!_nasa) var _nasa={};
if(window.wcs){
wcs.inflow();
wcs_do(_nasa);
}
</script>


<!-- 공통 적용 스크립트 20210730 엣지랭크 크로스타켓 -->
<script type='text/javascript'>
    !function (w,d,s,u,t,ss,fs) {
        if(w.ex2cts)return;t=w.ex2cts={};if(!window.t) window.t = t;
        t.push = function() {t.callFunc?t.callFunc.apply(t,arguments) : t.cmd.push(arguments);};
        t.cmd=[];ss = document.createElement(s);ss.async=!0;ss.src=u;
        fs=d.getElementsByTagName(s)[0];fs.parentNode.insertBefore(ss,fs);
    }(window,document,'script','//st2.exelbid.com/js/cts2.js');
    ex2cts.push('init', '60f8d4488d0fd855188b456c' , '.modoo24.net');

</script>

<!-- 공통 적용 스크립트 20210730 Global site tag (gtag.js) - Google Ads: 328335033 -->

<script async src="https://www.googletagmanager.com/gtag/js?id=AW-328335033"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-328335033');
</script>



<!-- AceCounter Log Gathering Script V.8.0.2019080601 -->
<script language='javascript'>
	var _AceGID=(function(){var Inf=['gtp7.acecounter.com','8080','BH6A44246780886','AW','0','NaPm,Ncisy','ALL','0']; var _CI=(!_AceGID)?[]:_AceGID.val;var _N=0;var _T=new Image(0,0);if(_CI.join('.').indexOf(Inf[3])<0){ _T.src =( location.protocol=="https:"?"https://"+Inf[0]:"http://"+Inf[0]+":"+Inf[1]) +'/?cookie'; _CI.push(Inf);  _N=_CI.length; } return {o: _N,val:_CI}; })();
	var _AceCounter=(function(){var G=_AceGID;var _sc=document.createElement('script');var _sm=document.getElementsByTagName('script')[0];if(G.o!=0){var _A=G.val[G.o-1];var _G=(_A[0]).substr(0,_A[0].indexOf('.'));var _C=(_A[7]!='0')?(_A[2]):_A[3];var _U=(_A[5]).replace(/\,/g,'_');_sc.src=(location.protocol.indexOf('http')==0?location.protocol:'http:')+'//cr.acecounter.com/Web/AceCounter_'+_C+'.js?gc='+_A[2]+'&py='+_A[4]+'&gd='+_G+'&gp='+_A[1]+'&up='+_U+'&rd='+(new Date().getTime());_sm.parentNode.insertBefore(_sc,_sm);return _sc.src;}})();
</script>
<noscript><img src='http://gtp7.acecounter.com:8080/?uid=BH6A44246780886&je=n&' border='0' width='0' height='0' alt=''></noscript>
<!-- AceCounter Log Gathering Script End -->

</body>
</html>
