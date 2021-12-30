<style>
  /* === Popup === */
:root {
  --f7-popup-border-radius: 0px;
  --f7-popup-tablet-width: 630px;
  --f7-popup-tablet-height: 630px;
  --f7-popup-transition-duration: 400ms;
  --f7-popup-push-border-radius: 10px;
  --f7-popup-push-offset: var(--f7-safe-area-top);
  /*
  --f7-popup-tablet-border-radius: var(--f7-popup-border-radius);
  */
  --f7-navbar-bg-color : rgb(96 125 139 / 18%);
  --navbar-stepper-height: 0px;
  --pop-stepper-no : 4;

  --elevation-0: 0px 0px 0px 0px rgba(0, 0, 0, 0);
  --elevation-1: 0px 2px 1px -1px rgba(0, 0, 0, 0.2),0px 1px 1px 0px rgba(0, 0, 0, 0.14),0px 1px 3px 0px rgba(0, 0, 0, 0.12);
  --elevation-2: 0px 3px 1px -2px rgba(0, 0, 0, 0.2),0px 2px 2px 0px rgba(0, 0, 0, 0.14),0px 1px 5px 0px rgba(0, 0, 0, 0.12);
  --elevation-3: 0px 3px 3px -2px rgba(0, 0, 0, 0.2),0px 3px 4px 0px rgba(0, 0, 0, 0.14),0px 1px 8px 0px rgba(0, 0, 0, 0.12);
  --elevation-4: 0px 2px 4px -1px rgba(0, 0, 0, 0.2),0px 4px 5px 0px rgba(0, 0, 0, 0.14),0px 1px 10px 0px rgba(0, 0, 0, 0.12);
  --elevation-5: 0px 3px 5px -1px rgba(0, 0, 0, 0.2),0px 5px 8px 0px rgba(0, 0, 0, 0.14),0px 1px 14px 0px rgba(0, 0, 0, 0.12);
  --elevation-6: 0px 3px 5px -1px rgba(0, 0, 0, 0.2),0px 6px 10px 0px rgba(0, 0, 0, 0.14),0px 1px 18px 0px rgba(0, 0, 0, 0.12);
  --elevation-7: 0px 4px 5px -2px rgba(0, 0, 0, 0.2),0px 7px 10px 1px rgba(0, 0, 0, 0.14),0px 2px 16px 1px rgba(0, 0, 0, 0.12);
  --elevation-8: 0px 5px 5px -3px rgba(0, 0, 0, 0.2),0px 8px 10px 1px rgba(0, 0, 0, 0.14),0px 3px 14px 2px rgba(0, 0, 0, 0.12);
  --elevation-9: 0px 5px 6px -3px rgba(0, 0, 0, 0.2),0px 9px 12px 1px rgba(0, 0, 0, 0.14),0px 3px 16px 2px rgba(0, 0, 0, 0.12);
  --elevation-10: 0px 6px 6px -3px rgba(0, 0, 0, 0.2),0px 10px 14px 1px rgba(0, 0, 0, 0.14),0px 4px 18px 3px rgba(0, 0, 0, 0.12);
  --elevation-11: 0px 6px 7px -4px rgba(0, 0, 0, 0.2),0px 11px 15px 1px rgba(0, 0, 0, 0.14),0px 4px 20px 3px rgba(0, 0, 0, 0.12);
  --elevation-12: 0px 7px 8px -4px rgba(0, 0, 0, 0.2),0px 12px 17px 2px rgba(0, 0, 0, 0.14),0px 5px 22px 4px rgba(0, 0, 0, 0.12);
  --elevation-13: 0px 7px 8px -4px rgba(0, 0, 0, 0.2),0px 13px 19px 2px rgba(0, 0, 0, 0.14),0px 5px 24px 4px rgba(0, 0, 0, 0.12);
  --elevation-14: 0px 7px 9px -4px rgba(0, 0, 0, 0.2),0px 14px 21px 2px rgba(0, 0, 0, 0.14),0px 5px 26px 4px rgba(0, 0, 0, 0.12);
  --elevation-15: 0px 8px 9px -5px rgba(0, 0, 0, 0.2),0px 15px 22px 2px rgba(0, 0, 0, 0.14),0px 6px 28px 5px rgba(0, 0, 0, 0.12);
  --elevation-16: 0px 8px 10px -5px rgba(0, 0, 0, 0.2),0px 16px 24px 2px rgba(0, 0, 0, 0.14),0px 6px 30px 5px rgba(0, 0, 0, 0.12);
  --elevation-17: 0px 8px 11px -5px rgba(0, 0, 0, 0.2),0px 17px 26px 2px rgba(0, 0, 0, 0.14),0px 6px 32px 5px rgba(0, 0, 0, 0.12);
  --elevation-18: 0px 9px 11px -5px rgba(0, 0, 0, 0.2),0px 18px 28px 2px rgba(0, 0, 0, 0.14),0px 7px 34px 6px rgba(0, 0, 0, 0.12);
  --elevation-19: 0px 9px 12px -6px rgba(0, 0, 0, 0.2),0px 19px 29px 2px rgba(0, 0, 0, 0.14),0px 7px 36px 6px rgba(0, 0, 0, 0.12);
  --elevation-20: 0px 10px 13px -6px rgba(0, 0, 0, 0.2),0px 20px 31px 3px rgba(0, 0, 0, 0.14),0px 8px 38px 7px rgba(0, 0, 0, 0.12);
  --elevation-21: 0px 10px 13px -6px rgba(0, 0, 0, 0.2),0px 21px 33px 3px rgba(0, 0, 0, 0.14),0px 8px 40px 7px rgba(0, 0, 0, 0.12);
  --elevation-22: 0px 10px 14px -6px rgba(0, 0, 0, 0.2),0px 22px 35px 3px rgba(0, 0, 0, 0.14),0px 8px 42px 7px rgba(0, 0, 0, 0.12);
  --elevation-23: 0px 11px 14px -7px rgba(0, 0, 0, 0.2),0px 23px 36px 3px rgba(0, 0, 0, 0.14),0px 9px 44px 8px rgba(0, 0, 0, 0.12);
  --elevation-24: 0px 11px 15px -7px rgba(0, 0, 0, 0.2),0px 24px 38px 3px rgba(0, 0, 0, 0.14),0px 9px 46px 8px rgba(0, 0, 0, 0.12)
}
.ios {
  --f7-popup-tablet-border-radius: 5px;
  --f7-popup-box-shadow: none;
}
.md {
  --f7-popup-tablet-border-radius: 4px;
  --f7-popup-box-shadow: 0px 20px 44px rgba(0, 0, 0, 0.5);
}
.aurora {
  --f7-popup-tablet-border-radius: 8px;
  --f7-popup-box-shadow: 0px 20px 44px rgba(0, 0, 0, 0.5);
}
.elevation+*{
  transition-duration: .5s;
  transition-property: box-shadow;
}
.elevation-1 { box-shadow: var(--elevation-1)!important;}
.elevation-2 { box-shadow: var(--elevation-2)!important;}
.elevation-3 { box-shadow: var(--elevation-3)!important;}
.elevation-4 { box-shadow: var(--elevation-4)!important;}
.elevation-5 { box-shadow: var(--elevation-5)!important;}
.elevation-6 { box-shadow: var(--elevation-6)!important;}
.elevation-7 { box-shadow: var(--elevation-7)!important;}
.elevation-8 { box-shadow: var(--elevation-8)!important;}
.elevation-9 { box-shadow: var(--elevation-9)!important;}

.popup-backdrop{
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.4);
    z-index: 13000;
    visibility: hidden;
    opacity: 0;
    transition-duration: .4s;
    z-index: 10500;
}
.popup-backdrop.backdrop-in{
    visibility: visible;
    opacity: 1;
}
.popup {
  position: fixed;
  left: 0;
  top: 0px;
  width: 100%;
  height: 100%;
  display: none;
  box-sizing: border-box;
  transition-property: transform;
  transform: translate3d(0, 100vh, 0);
  background: #fff;
  z-index: 11000;
  overflow: hidden;
  border-radius: var(--f7-popup-border-radius);
}
.theme-dark .popup,
.popup.theme-dark {
  background: #000;
}
.popup.modal-in,
.popup.modal-out {
  transition-duration: var(--f7-popup-transition-duration);
}
.popup.not-animated {
  transition-duration: 0ms;
}
.popup.modal-in {
  display: block;
  transform: translate3d(0, 0, 0);
}
.popup.modal-out {
  transform: translate3d(0, 100vh, 0);
}
.popup.swipe-close-to-top.modal-out {
  transform: translate3d(0, -100vh, 0);
}
@media (min-width: 630px) and (min-height: 630px) {
  .popup:not(.popup-tablet-fullscreen) {
    --f7-safe-area-top: 0px;
    --f7-safe-area-bottom: 0px;
    width: var(--f7-popup-tablet-width);
    height: var(--f7-popup-tablet-height);
    left: 50%;
    top: 50%;
    margin-left: calc(-1 * var(--f7-popup-tablet-width) / 2);
    margin-top: calc(-1 * var(--f7-popup-tablet-height) / 2);
    transform: translate3d(0, 100vh, 0);
    box-shadow: var(--f7-popup-box-shadow);
    border-radius: var(--f7-popup-tablet-border-radius, var(--f7-popup-border-radius));
  }
  .popup:not(.popup-tablet-fullscreen).modal-in {
    transform: translate3d(0, 0, 0);
  }
  .popup:not(.popup-tablet-fullscreen).modal-out {
    transform: translate3d(0, 100vh, 0);
  }
  .popup:not(.popup-tablet-fullscreen).swipe-close-to-top.modal-out {
    transform: translate3d(0, -100vh, 0);
  }
  .popup:not(.popup-tablet-fullscreen).popup-behind {
    transform: translate3d(0, 0, 0) scale(0.9);
    pointer-events: none;
  }
  .popup:not(.popup-tablet-fullscreen).popup-behind.modal-out {
    transform: translate3d(0, 100vh, 0) scale(0.9);
  }
}

@keyframes popup-dark-push-overlay-fade-in {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
@keyframes popup-dark-push-overlay-fade-out {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
  }
}
.link {
    --f7-touch-ripple-color: var(--f7-link-touch-ripple-color, rgba(var(--f7-theme-color-rgb), 0.25));
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    align-content: center;
    justify-content: center;
    position: relative;
    box-sizing: border-box;
    z-index: 1;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    transition: opacity .3s;
}
.pop-navbar .link {
    display: flex;
    justify-content: flex-start;
    line-height: 44px;
    height: 44px;
    padding: 0 5px;
}
.page {
    box-sizing: border-box;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    transform: none;
    background-color: var(--f7-page-bg-color);
    z-index: 1;
}
.pop-navbar {
    z-index: 500;
    left: 0;
    top: 0;
    width: 100%;
    --f7-navbar-large-collapse-progress: 0;
    position: relative;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    box-sizing: border-box;
    margin: 0;
    height: calc( 44px + var(--navbar-stepper-height) );
    color: var(--f7-navbar-text-color,var(--f7-bars-text-color));
    font-size: var(--f7-navbar-font-size);
    position: absolute;
    background-color: white;
    /*box-shadow: 0 13px 27px -5px rgb(50 50 93 / 25%), 0 8px 16px -8px rgb(0 0 0 / 30%), 0 -6px 16px -6px rgb(0 0 0 / 3%);*/
}
.pop-navbar-bg {
    --f7-navbar-large-collapse-progress: 1;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
    background-color: #3b5998;
    transition-property: transform;
}
.pop-navbar-bg:after, .pop-navbar-bg:before {
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}
.pop-navbar-bg:before {
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    content: '';
    position: absolute;
    right: 0;
    width: 100%;
    top: 100%;
    bottom: auto;
    height: 8px;
    pointer-events: none;
    background: rgb(0 0 0 / 1%);
}
.pop-navbar-bg-temp:after {
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    content: '';
    position: absolute;
    background-color: rgb(0 0 0 / 25%);
    display: block;
    z-index: 15;
    top: auto;
    right: auto;
    bottom: 0;
    left: 0;
    height: 1px;
    width: 100%;
    transform-origin: 50% 100%;
    z-index: 1;
}
.pop-navbar-inner {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 44px;
    display: flex;
    align-items: center;
    box-sizing: border-box;
    padding: 8px;
    transform: translate3d(0,0,0);
    z-index: 10;
    justify-content: space-between;
}

.pop-navbar-inner .fas{
  color: rgb(255 255 255 / 72%) !important;
}

.pop-navbar-stepper{
  top: auto;
  bottom:0;
  height:var(--navbar-stepper-height);
  background-color: whitesmoke;
  padding:10px;
  display:none;
  border-top: 1px solid var(--f7-navbar-bg-color);
}
.pop-navbar .pop-title {
    z-index: 10;
    position: relative;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    flex-shrink: 10;
    font-weight: 600;
    display: inline-block;
    line-height: 44px;
    text-align: center;
    font-size: 16px;
    color: white;
    padding-top: 4px;
}
.pop-navbar .pop-left, .pop-navbar .pop-right {
  position: relative;
  z-index: 10;
  flex-shrink: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  min-width: 28px;
}
.pop-page-content {
    overflow: auto;
    -webkit-overflow-scrolling: touch;
    box-sizing: border-box;
    height: calc(100% - 44px);
    position: relative;
    z-index: 1;
    padding-top: calc( 44px + 1px + var(--navbar-stepper-height) );
    padding-bottom: 10px;
}
.pop-page-section{

}
.overflowhidden{
      overflow: hidden;
}
.pop-page-step{
  overflow: auto;
  -webkit-overflow-scrolling: touch;
  box-sizing: border-box;
  height: 100%;
  position: relative;
  z-index: 1;
  position: absolute;
  z-index: 1;
  width: 100%;
  height: 100%;
  background-color: #eee;
  --page-step-header-height:26px;
  --page-step-header-realheight:38px;
}
.pop-page-step:not(:first-child){
    box-shadow: 0px -7px 6px 2px rgb(50 50 93 / 25%), 0px -8px 16px -8px rgb(0 0 0 / 30%), 0 -6px 16px -6px rgb(0 0 0 / 3%);
}
.pop-page-step.step2{
  z-index: 2;
  top : calc( 100% - var(--page-step-header-height) - var(--page-step-header-height) * ( var(--pop-stepper-no) - 2 ) ) ;
  transition: all 500ms;
}
.pop-page-step.step3{
  z-index: 3;
  top : calc( 100% - var(--page-step-header-height) - var(--page-step-header-height) * ( var(--pop-stepper-no) - 3 ) );
  transition: all 500ms;
}
.pop-page-step.step4{
  z-index: 4;
  top : calc( 100% - var(--page-step-header-height) - var(--page-step-header-height) * ( var(--pop-stepper-no) - 4 ) );
  transition: all 500ms;
}
.pop-page-step.step5{
  z-index: 4;
  top : calc( 100% - var(--page-step-header-height) - var(--page-step-header-height) * ( var(--pop-stepper-no) - 5 ) );
  transition: all 500ms;
}
.pop-page-step.step6{
  z-index: 4;
  top : calc( 100% - var(--page-step-header-height) - var(--page-step-header-height) * ( var(--pop-stepper-no) - 6 ) );
  transition: all 500ms;
}
.pop-page-step.step7{
  z-index: 4;
  top : calc( 100% - var(--page-step-header-height) - var(--page-step-header-height) * ( var(--pop-stepper-no) - 7 ) );
  transition: all 500ms;
}
.pop-page-step.step2.step-avail-open.step-opened{
  top : calc( 44px + var(--page-step-header-height) );
  transition: all 500ms;
}
.pop-page-step.step3.step-avail-open.step-opened{
  top : calc( 44px + ( var(--page-step-header-height)*2 ) );
  transition: all 500ms;
}
.pop-page-step.step4.step-avail-open.step-opened{
  top : calc( 44px + ( var(--page-step-header-height)*3 ) );
  transition: all 500ms;
}
.pop-page-step.step5.step-avail-open.step-opened{
  top : calc( 44px + ( var(--page-step-header-height)*4 ) );
  transition: all 500ms;
}
.pop-page-step.step6.step-avail-open.step-opened{
  top : calc( 44px + ( var(--page-step-header-height)*5 ) );
  transition: all 500ms;
}
.pop-page-step.step7.step-avail-open.step-opened{
  top : calc( 44px + ( var(--page-step-header-height)*6 ) );
  transition: all 500ms;
}

.pop-page-step-header{
  background-color: #55acee;
  border-top: 1px solid #84b6db;
  border-bottom: 1px solid #eeeeee;
  line-height: 38px;
  padding-left: 32px;
}
.pop-page-step .pop-page-step-header:before{
  font-family: "Font Awesome 5 Free";
  -webkit-font-smoothing: antialiased;
  display: inline-block;
  font-style: normal;
  font-variant: normal;
  text-rendering: auto;
  line-height: 1;
  font-weight: 900;
  width: 14px;
  height: 8px;
  margin-top: -4px;
  line-height: 8px;
  color: rgb(0 0 0 / 34%);
  position: absolute;
  top: 17px;
  left: 10px;
}
.pop-page-step-header-inner{
  display: flex;
  color: rgb(255 255 255 / 60%);
}
.step-opened .pop-page-step-header-inner, .prc-done .pop-page-step-header-inner{
  color: rgb(255 255 255 / 94%);
}
.pop-page-step:not(.step-opened):not(.prc-done) .pop-page-step-header:before{
  /*content: '\f078';*/
  content: '\f058';
  color:rgb( 0 0 0 / 15%);
}
.pop-page-step.step-opened:not(.prc-done) .pop-page-step-header:before{
  /*content: '\f077';*/
  content: '\f058';
  color: rgb(255 255 255 / 88%);
}
.pop-page-step.prc-done .pop-page-step-header:before{
  content: '\f058';
  color: rgb(255 255 255 / 88%);
}
.pop-page-step-body{
  height: calc( 100% - 44px - var(--navbar-stepper-height) - var(--page-step-header-realheight) - ( var( --page-step-header-height ) * ( var(--pop-stepper-no) - 1 ) ) );
  overflow-y: auto;
}
.step-body-section{padding:10px;}

.pop-footer-naver{
  z-index: 500;
  left: 0;
  bottom: 0;
  width: 100%;
  position: relative;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  box-sizing: border-box;
  margin: 0;
  height: 44px;
  position: absolute;
  background-color: white;
}
.pop-footer-navbar-inner{
  display: flex;
    justify-content: flex-end;
    padding: 0 16px;
    background-color:#c7c7c7;
}

.btn-pop-next {
  color: #fff;
  background-color: blue;
  border-color: #999999;
  box-shadow: 0 2px 2px 0 rgba(153, 153, 153, 0.14), 0 3px 1px -2px rgba(153, 153, 153, 0.2), 0 1px 5px 0 rgba(153, 153, 153, 0.12);
}

.btn-pop-next:hover {
  color: #fff;
  background-color: lightblue;
  border-color: #7a7a7a;
}

/* daum */
#daumlayer{
  display:none;position:fixed;overflow:hidden;z-index:11100;-webkit-overflow-scrolling:touch;
  border: 1px solid #999 !important;
  padding: 5px;
  border-radius: 5px;
  background-color: white;
}
#daumbtnCloseLayer{
  cursor:pointer;position:absolute;right:3px;top:3px;z-index:1
}

</style>
<div class="popup-backdrop" id="popnbackdrop"></div>

  <div id="daumlayer" style="">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="daumbtnCloseLayer" style="" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>

  <div class="popup modal-in modal-out" id="popnmodal">
    <div class="page">
      <div class="pop-navbar elevation-1">
        <div class="pop-navbar-bg"></div>

        <div class="pop-navbar-inner">
          <div class="pop-left">
            <span class="link pop-back" onClick="history.back()"><i class="fas fa-chevron-left"></i></span>
          </div>
          <div class="pop-title">비대면견적신청</div>
          <div class="pop-right">
            <span class="link pop-close" onClick="closepopnbtn()">
              <i class="fas fa-times"></i>
            </span>
          </div>
        </div>

        <div class="pop-navbar-inner pop-navbar-stepper">

        </div>
      </div>


      <div class="pop-page-content overflowhidden">
        <form>
          <div class="pop-page-step step1 step-avail-open" data-step='1' id="popn_step_1">
            <div class="pop-page-step-header">
              <div class="pop-page-step-header-inner">
                도착지/출발지
              </div>
            </div>
            <div class="pop-page-step-body">
              <div class="step-body-section">
                <div class="pop-content-wrap start-address">
                  <input type="text" name="s_addr1" id="s_addr1" required="required" placeholder="지번, 도로명, 건물명 검색" readonly="" onclick="getAddress();">
                </div>
              </div>
            </div>
          </div>
          <div class="pop-page-step step2 step-avail-open" data-step='2' id="popn_step_2">
            <div class="pop-page-step-header">
              <div class="pop-page-step-header-inner">
                이사종류
              </div>
            </div>
            <div class="step-body-section">
              2<br>2<br>2<br>2<br>2<br>2<br>2<br>2<br>2<br>2<br>2<br>2<br>2<br>2<br>2<br>2<br>2<br>
            </div>
          </div>
          <div class="pop-page-step step3 step-avail-open" data-step='3' id="popn_step_3">
            <div class="pop-page-step-header">
              <div class="pop-page-step-header-inner">
                짐체크
              </div>
            </div>
            <div class="pop-page-step-body">
              <div class="step-body-section">
                1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>
                1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>
                1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>
                1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>
                1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>
              </div>
            </div>
          </div>
          <div class="pop-page-step step4 step-avail-open" data-step='4' id="popn_step_4">
            <div class="pop-page-step-header">
              <div class="pop-page-step-header-inner">
                확인
              </div>
            </div>
            <div class="pop-page-step-body">
              <div class="step-body-section">
                1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>
                1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>
                1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>
                1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>
                1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>1<br>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="pop-footer-navbar">
        <div class="pop-footer-navbar-inner">
          <span class="btn btn-sm btn-secondary" onClick="gotoNextStep()">다음</div>
        </div>
      </div>

    </div>
  </div>

<!-- daum 주소 -->
<script src='https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js'></script>
<script>
  var daumelement_layer = document.getElementById('daumlayer');

  function closeDaumPostcode() {
      // iframe을 넣은 element를 안보이게 한다.
      daumelement_layer.style.display = 'none';
  }

  function getAddress( callbackFunction ){
    new daum.Postcode({
          oncomplete: function(data) {
              var addr = ''; // 주소 변수
              var extraAddr = ''; // 참고항목 변수
              if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                  addr = data.roadAddress;
              } else { // 사용자가 지번 주소를 선택했을 경우(J)
                  addr = data.jibunAddress;
              }

              if(data.userSelectedType === 'R'){
                  if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                      extraAddr += data.bname;
                  }
                  if(data.buildingName !== '' && data.apartment === 'Y'){
                      extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                  }
                  if(extraAddr !== ''){
                      extraAddr = ' (' + extraAddr + ')';
                  }
              } else {
                  extraAddr = '';
              }
              daumelement_layer.style.display = 'none';
              console.log ( addr, extraAddr, data)
              if( typeof callbackFunction != 'undefined') callbackFunction( addr, extraAddr, data)
          },
          width : '100%',
          height : '100%',
          maxSuggestItems : 5
      }).embed(daumelement_layer);

      // iframe을 넣은 element를 보이게 한다.
      daumelement_layer.style.display = 'block';

      // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
      initLayerPosition();
  }
  function initLayerPosition(){
    var width = 300; //우편번호서비스가 들어갈 element의 width
    var height = 400; //우편번호서비스가 들어갈 element의 height
    var borderWidth = 5; //샘플에서 사용하는 border의 두께

    // 위에서 선언한 값들을 실제 element에 넣는다.
    daumelement_layer.style.width = width + 'px';
    daumelement_layer.style.height = height + 'px';
    daumelement_layer.style.border = borderWidth + 'px solid';
    // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
    daumelement_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
    daumelement_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
}
</script>
<!-- / daum -->

<script>
var pop_step_history = 0
var pop_step_open = 1;
var pop_step_availMax = 3;

function addModalSet(data,pop_step_opened){
    var old_no = pop_step_history;
    history.pushState({}, '', '#estimate'+pop_step_opened )
    modal_set_arr.push(data);
    if( pop_step_history < 0 ) pop_step_history = 1;
    else ++pop_step_history;
    console.log ( "=====push ====")
    console.log ( data )
    console.log ( "start : " + old_no)
    console.log ( "history : "+ pop_step_history)
    console.log ( "open : " + pop_step_open)
}
function openpopn(){
  if($(".step-last-call").data("step") > 0) pop_step_open = $(".step-last-call").data("step");
  else {
    pop_step_open = 1;
    $("#popn_step_1").addClass("step-opened").addClass("step-last-call")
  }

  addModalSet({'type':'popn', "step": pop_step_open , 'command':'open' },pop_step_open);

  $("body").addClass("overflowhidden")
  $("#popnbackdrop").removeClass('backdrop-out').addClass('backdrop-in');
  $("#popnmodal").removeClass('modal-out');
}
function closepopnbtn(){
  history.go(pop_step_history * -1)
  if (  pop_step_history > 1 ){
    for ( var i = 0; i < pop_step_history-1; i++ ) {
        modal_set_arr.pop();
    }
  }
  pop_step_history = 0;
}
function closepopn(){
  $("#popnmodal").addClass('modal-out');
  $("#popnbackdrop").addClass('backdrop-out').removeClass('backdrop-in');
  $("body").removeClass("overflowhidden")
}
function checkStepBeforeOpend(target){
  if( $(target).prev().length > 0 && !$(target).prev().hasClass('step-opened') ){
    $(target).prev().addClass("step-opened")
    checkStepBeforeOpend( $(target).prev() )
  }
}
function checkStepNextClosed(target){
  if( $(target).next().length > 0 && $(target).next().hasClass('step-opened') ){
    $(target).next().removeClass("step-opened")
    checkStepNextClosed( $(target).next() )
  }
}
function drawstep(target){
  checkStepBeforeOpend(target)
  $(".step-last-call").removeClass('step-last-call')
  $(target).addClass("step-opened").addClass("step-last-call")
  checkStepNextClosed(target)

  $(".pop-navbar").removeClass (function (index, css) {
      return (css.match (/(^|\s)elevation\S+/g) || []).join(' ');
    }).addClass("elevation-" + (pop_step_open*3) );
}

function gotoNextStep() {
  $(".step-last-call").next().children(".pop-page-step-header").trigger("click")
}
function gotoStep(no){
  $("#popn_step_" + no ).children(".pop-page-step-header").trigger("click")
}
$("document").ready( function() {
  $(".step-avail-open").on("click", function (e){
    var target = $(e.target).closest('.pop-page-step');
    var step_no = $(target).data('step')
    if( step_no > pop_step_availMax ){
      toast('전 단계를 먼저 입력해주세요', 'topCenter')
      return;
    }
    else if( $(target).hasClass('step-last-call')) {
      return;
    }

    old_step = pop_step_open
    pop_step_open = $(target).data('step')

    addModalSet({'type':'popn', "step": old_step , 'command':'step' },pop_step_open);

    drawstep(target)
  })

  if( window.location.hash.includes( '#estimate') ){
    history.pushState("", document.title, window.location.pathname + window.location.search);
    openpopn();
  }
})
//history back event
function onpopstatefn ( pop ) {
    if( typeof pop != 'undefined' && pop.type == 'popn'){
      if( pop.command == 'open' ) closepopn()
      else if(  pop.command=='step') {
        var gotopop = ( pop.step> pop_step_availMax) ? pop_step_availMax : pop.step;
        drawstep($("#popn_step_" + gotopop))
      }
      pop_step_history--;
    }
}
</script>

<script type="module">
			import devtools from 'https://unpkg.com/devtools-detect';
      console.log ( devtools.isOpen ? 'yes' : 'no' )
      console.log (devtools.orientation ? devtools.orientation : '' )

	window.addEventListener('devtoolschange', event => {
    console.log ( event.detail.isOpen ? 'yes' : 'no' )
    console.log (event.detail.orientation ? event.detail.orientation : '' )
	});
</script>
