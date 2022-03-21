<div class="popup modal-in modal-out" id="popcleanmodal">
  <div class="page">
    <div class="pop-navbar elevation-1">
      <div class="pop-navbar-bg"></div>

      <div class="pop-navbar-inner">
        <div class="pop-left">
          <span class="link pop-back" onClick="history.back()"><i class="fas fa-chevron-left"></i></span>
        </div>
        <div class="pop-title">방문이사 견적신청</div>
        <div class="pop-right">
          <span class="link pop-close" onClick="closepopnbtn()">
            <i class="fas fa-times"></i>
          </span>
        </div>
      </div>

      <!--div class="pop-navbar-inner pop-navbar-stepper">
        <div class='top-steps-wrap'>
          <div class='step-1 top-step-ing' id="topstepper_1" data-step='1' >1</div>
          <div class='line-1'></div>
          <div class='step-2 ' id="topstepper_2" data-step='2' >2</div>
          <div class='line-2'></div>
          <div class='step-3' id="topstepper_3" data-step='3' >3</div>
          <div class='line-3'></div>
          <div class='step-4' id="topstepper_4" data-step='4' >4</div>
          <div class='line-5'></div>
          <div class='step-6' id="topstepper_5" data-step='5' >5</div>
        </div>
      </div>
      <div class="inpopup-inline-progressbar-wrap">
        <div class="inpopup-inline-progressbar">
          <span id="inpopup-inline-progressbar"></span>
        </div>
      </div-->
    </div>



    <div class="pop-page-content overflowhidden">
      <form id="popclean-page-form">

        <div
          class="pop-page-step step1 step-avail-open step-opened step-last-call"
          data-step="1"
          id="popclean_step_1"
          data-url="step1">
          @include('Front.Poporder.Inc.cleanstep1')
        </div>

        <div
          class="pop-page-step step2"
          data-step="2"
          id="popclean_step_2"
          data-url="step2">
          @include('Front.Poporder.Inc.cleanstep2')
        </div>

        <div
          class="pop-page-step step3"
          data-step="3"
          id="popclean_step_3"
          data-url="step3">
          @include('Front.Poporder.Inc.cleanstep3')
        </div>

        <div
          class="pop-page-step step4"
          data-step="4"
          id="popclean_step_4"
          data-url="step4">
          @include('Front.Poporder.Inc.cleanstep4')
        </div>

        <div
          class="pop-page-step step5"
          data-step="5"
          id="popclean_step_5"
          data-url="step5">
          @include('Front.Poporder.Inc.cleanstep5')
        </div>

        <div
          class="pop-page-step step5"
          data-step="6"
          id="popclean_step_6"
          data-url="step6">
          @include('Front.Poporder.Inc.cleanstep6')
        </div>

      </form>

    </div>

  </div>
</div>
<style>
#popcleanmodal {
--pop-stepper-no : 6; /*stepper 갯수*/
--pop-page-content-addition-height : 1px;

--navbar-stepper-height: 0px; /*44px;*/ /*pop-navbar-stepper 높이*/
/*--pop-footer-height:40px;*/ /* pop-footer-navbar 높이 */
--pop-footer-height:0px;

--calendar-cell-width: 50px;
--calendar-cell-height: 50px;
--input-line-color: #d8dadb;
/* --inout-bg-color: transparent; */
--input-bg-color: rgb(255 255 255 / 40%);
--input-font-size: 16px;
--input-title-color: #6a6a6a;
--page-step-header-height: 36px;
--page-step-header-realheight: 40px;
--f7-grid-gap: 0px;
--f7-grid-row-gap: 0px;
--f7-popup-border-radius: 0px;
--f7-popup-tablet-border-radius: 10px;
}
#popcleanmodal .pop-page-step.step-opened.step-last-call .pop-page-step-header,
#popcleanmodal .pop-page-step.step-opened.step-last-call .pop-page-step-header-inner {
/*background-color: #07c563;*/
}
</style>
<script>
var popclean_step_history = 0
var popclean_step_open = 1;
var popclean_step_availMax = 5;

var mfcleanform = new mfFormStorage('popclean-page-form','pop-page-form-clean' )

function openpopclean(){
var fomrid = "#popclean-page-form"
if($(`${fomrid} .step-last-call`).data("step") > 0) popclean_step_open = $(`${fomrid} .step-last-call`).data("step");
else {
  popclean_step_open = 1;
  $("#popclean_step_1").addClass("step-opened").addClass("step-last-call")
}

addModalSet({'type':'popclean', "step": popclean_step_open , 'command':'open' },popclean_step_open, "cleanpop");

$("body").addClass("overflowhidden")
$("#popnbackdrop").removeClass('backdrop-out').addClass('backdrop-in');
$("#popcleanmodal").removeClass('modal-out');

// DATA
mfcleanform.loadData()

$("#popclean-page-form input").off('change').on('change', function (e) {
  mfcleanform.save()
  //var currentstep = getCurrentStep();
})

}
function gotoCleanNextStep() {
/*
var step = $("#popclean-page-form .step-last-call").data('step');
if( typeof step =="undefined" || step < 1 ) step = 1;
getOrderCleanFromCheck(step, $("#popclean-page-form .step-last-call").data('url') )
*/
gotoCleanStep(popclean_step_open+1)
}
function gotoCleanStep(no){
$("#popclean_step_" + no ).children(".pop-page-step-header").trigger("click")
}
function getOrderCleanFromCheck(step, url){
  inCleanPopLoaderOpen()
  getpost('/v2/order/clean/'+url, $("#popclean-page-form").serialize(), nextcleanlevel, inCleanPopLoaderClose, orderCleanFormCheckError )
}

/*TODO 로딩 만들어야 함*/
function inCleanPopLoaderOpen(){
$("#cleanpoploader").addClass('loading');
}
function inCleanPopLoaderClose(){
$("#cleanpoploader").addClass('loading');
}
/*TODO 성공시 */
function nextcleanlevel(res){

}
/*TODO 실패시 */
function orderCleanFormCheckError(res){
ajaxErrorST(res )

if( typeof res == 'object' && typeof res.responseJSON == 'object' && typeof res.responseJSON.data != 'undefined' && typeof res.responseJSON.data.step != 'undefined'){
  resetNowStep(res.responseJSON.data.step)
}
if( typeof res == 'object' && typeof res.responseJSON == 'object'
  && typeof res.responseJSON.data != 'undefined'
  && typeof res.responseJSON.data.data != 'undefined'){
    var msg = res.responseJSON.data.data

  for(key in msg) {
    if(msg.hasOwnProperty(key)) {

      if(key.indexOf('.') < 0 ) {
        setTimeout( function(){
          $('#popclean-page-form input[name='+key+']').focus();
        }, 50)
        console.log( `input[name=${key}]` ,"================")
        break;
      }
    }
  }
}

}



$("document").ready( function() {
$("#popclean-page-form .pop-page-step .pop-page-step-header").on("click", function (e){
  var target = $(e.target).closest('.pop-page-step');
  if( !$(target).hasClass('step-avail-open') ) {
    return;
  }
  var step_no = $(target).data('step')
  if( step_no > popclean_step_availMax ){
    toast('전 단계를 먼저 입력해주세요', 'topCenter')
    return;
  }

  else if( $(target).hasClass('step-last-call')) {
    return;
  }
  old_step = popclean_step_open
  popclean_step_open = $(target).data('step')

  addModalSet({'type':'popclean', "step": old_step , 'command':'step' },popclean_step_open, "clean");

  drawstep(target)
})
if( window.location.hash.includes( '#clean') ){
  history.pushState("", document.title, window.location.pathname + window.location.search);
  openpopclean();
}
});
</script>
