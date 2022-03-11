<link rel="stylesheet" href="/community/assets/css/contact_order_pop.css" />
@php
  $service_center_tel="16007728";
  $service_center_tel_display="1600-7728";
@endphp
<div class="popup modal-in modal-out" id="popcontactmodal">
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

      <div class="pop-navbar-inner pop-navbar-stepper">
        <div class='top-steps-wrap'>
          <div class='step-1 top-step-ing' id="top_contact_stepper_1" data-step='1' >1</div>
          <div class='line-1'></div>
          <div class='step-2 ' id="top_contact_stepper_2" data-step='2' >2</div>
          <div class='line-2'></div>
          <div class='step-3' id="top_contact_stepper_3" data-step='3' >3</div>
          <div class='line-3'></div>
          <div class='step-4' id="top_contact_stepper_4" data-step='4' >4</div>
          <div class='line-5'></div>
          <div class='step-6' id="top_contact_stepper_5" data-step='5' >5</div>
        </div>
      </div>
      <div class="inpopup-inline-progressbar-wrap">
        <div class="inpopup-inline-progressbar">
          <span id="inpopup-inline-progressbar"></span>
        </div>
      </div>
    </div>



    <div class="pop-page-content overflowhidden contact-prc">
      <form id="popcontact-page-form">

        <div
          class="pop-page-step step1 step-avail-open step-opened step-last-call"
          data-step="1"
          id="popcontact_step_1"
          data-url="step1">
          @include('Front.Poporder.Inc.contactstep1')
        </div>

        <div
          class="pop-page-step step2"
          data-step="2"
          id="popcontact_step_2"
          data-url="step2">
          @include('Front.Poporder.Inc.contactstep2')
        </div>

        <div
          class="pop-page-step step3"
          data-step="3"
          id="popcontact_step_3"
          data-url="step3">
          @include('Front.Poporder.Inc.contactstep3')
        </div>

        <div
          class="pop-page-step step4"
          data-step="4"
          id="popcontact_step_4"
          data-url="step4">
          @include('Front.Poporder.Inc.contactstep4')
        </div>

        <div
          class="pop-page-step step5 step-avail-open"
          data-step="5"
          id="popcontact_step_5"
          data-url="step5">
          @include('Front.Poporder.Inc.contactstep5')
        </div>

      </form>

    </div>
    <div class="pop-page-content overflowhidden contact-complete">
      @include('Front.Poporder.Inc.contactcomplete')
    </div>
  </div>
</div>

<style>
.contact-complete{
  display:none;
}
.contact-completed .contact-complete{
  display: block;
}
.contact-completed .contact-prc{
  display: none;
}
</style>

<script>
var popcontact_step_history = 0
var popcontact_step_open = 1;
var popcontact_step_availMax = 1;

var mfcontactform = new mfFormStorage('popcontact-page-form','pop-page-form-contact' )

function openpopcontact(){
  var fomrid = "#popcontact-page-form"
  if($(`${fomrid} .step-last-call`).data("step") > 0) popcontact_step_open = $(`${fomrid} .step-last-call`).data("step");
  else {
    popcontact_step_open = 1;
    $("#popcontact_step_1").addClass("step-opened").addClass("step-last-call")
  }

  addModalSet({'type':'popcontact', "step": popcontact_step_open , 'command':'open' },popcontact_step_open, "contactpop");

  $("body").addClass("overflowhidden")
  $("#popnbackdrop").removeClass('backdrop-out').addClass('backdrop-in');
  $("#popcontactmodal").removeClass('modal-out');

  // DATA
  mfcontactform.loadData()

  $("#popcontact-page-form input").off('change').on('change', function (e) {
    mfcontactform.save()
    resetCompanyList(e);
    //var currentstep = getCurrentStep();
  })
  if( $("#conatct-step-mdate-inp").val() != ''){
    $('#conatct-step-movedate').datepicker('update', $("#conatct-step-mdate-inp").val() );
  }else console.log( 'date not load2 ')
}
function resetCompanyList(e){
  var exceptName = [
        'contact_list_recommend',
        'agree1','agree2','agree_marketing','except_reset_cehck',
        'use_container','use_clean','internet_call',
        'register_name','register_phone','memo',
        'company[]'
    ]
  var name = $(e.target).prop('name')
  if( !exceptName.includes(name)) {
    console.log("reset companylist")
    $("input[name='contact_list_recommend']:checked").prop("checked",false)
    $("#contact_companylist").empty()
  }else {
    if($("input[name='contact_list_recommend']:checked").val()=='recommend') $("#contact_companylist").empty()
  }

}
function gotoContactNextStep(btn) {
  var target = $(btn).closest('.pop-page-step')
  var step = $(target).data('step');
  if( typeof step =="undefined" || step < 1 ) step = 1;
  getOrderContactFromCheck(step, $(target).data('url') )
}
function gotoContactStep(no){
  $("#popcontact_step_" + no ).children(".pop-page-step-header").trigger("click")
}
function getOrderContactFromCheck(step, url){
  inContactPopLoaderOpen()
  getpost('/v2/order/contact/'+url, $("#popcontact-page-form").serialize(), nextcontactlevel, inContactPopLoaderClose, orderContactFormCheckError )
}

/*로딩*/
function inContactPopLoaderOpen(){
  loaderAttach("#popcontactmodal .page")
}
function inContactPopLoaderClose(){
  loaderAttach("#popcontactmodal .page", false)
}
/*TODO*/
function resetNowContactStep(step){

}

/*TODO 성공시 daum 새로만들것*/
function nextcontactlevel(res){
  var step = $("#popcontactmodal .step-last-call").data('step')
  if( step < 1) step = 1;
  //++pop_step_availMax;
  popcontact_step_availMax = step+1;

  $("#popcontact_step_" + (parseInt(step)+1) ).addClass("step-avail-open");
  $("#popcontact_step_" + (parseInt(step)+1) ).children(".pop-page-step-header").trigger("click")

  $("#top_contact_stepper_" + parseInt(step)  ).addClass("top-step-done").removeClass('top-step-ing')
  $("#top_contact_stepper_" + (parseInt(step)+1) ).addClass("top-step-ing");

  if( typeof res.data !='undefined' && typeof res.data.command !='undefined' ){
    if( typeof window[res.data.command] =='function') window[res.data.command]( res.data )
  }

  var depth = 5;
  var precentage = (100 - ( step * 100 / depth )) * -1;
  $("#popcontactmodal #inpopup-inline-progressbar").css('transform', 'translate3d('+ precentage +'%, 0px, 0px)')
  closeDaumPostcode()
  /*TODO*/
  //dataLayer.push({'event' : 'conatctpop_event_' + (parseInt(step)+1) })
  console.log ( "gtag : conatctpop_event_"+ (parseInt(step)+1) )
}
/*TODO 실패시 */
function orderContactFormCheckError(res){
ajaxErrorST(res )

if( typeof res == 'object' && typeof res.responseJSON == 'object' && typeof res.responseJSON.data != 'undefined' && typeof res.responseJSON.data.step != 'undefined'){
  resetNowContactStep(res.responseJSON.data.step)
}
if( typeof res == 'object' && typeof res.responseJSON == 'object'
  && typeof res.responseJSON.data != 'undefined'
  && typeof res.responseJSON.data.data != 'undefined'){
    var msg = res.responseJSON.data.data

  for(key in msg) {
    if(msg.hasOwnProperty(key)) {

      if(key.indexOf('.') < 0 ) {
        setTimeout( function(){
          $('#popcontact-page-form input[name='+key+']').focus();
        }, 50)
        break;
      }
    }
  }
}

}

// 주소관련
function startContractAddress( addr, extraAddr, data ){
  var jbAddr = data.jibunAddress;
  if(jbAddr === '')  jbAddr = data.autoJibunAddress;

  $("#popcontactmodal input[name='s_addr1']").val( (addr + extraAddr).trim() )
  $("#popcontactmodal input[name='s_bcode']").val( data.bcode )
  $("#popcontactmodal input[name='s_sigunguCode']").val( data.sigunguCode )

  $("#popcontactmodal input[name='s_zip1']").val( data.zonecode )
  $("#popcontactmodal input[name='s_jibun_addr1']").val( data.jbAddr )
  $("#popcontactmodal input[name='s_addr1']").trigger("change")
}
// 주소관련
function endContractAddress( addr, extraAddr, data ){
  var jbAddr = data.jibunAddress;
  if(jbAddr === '')  jbAddr = data.autoJibunAddress;

  $("#popcontactmodal input[name='e_addr1']").val( (addr + extraAddr).trim() )
  $("#popcontactmodal input[name='e_bcode']").val( data.bcode )
  $("#popcontactmodal input[name='e_sigunguCode']").val( data.sigunguCode )

  $("#popcontactmodal input[name='e_zip1']").val( data.zonecode )
  $("#popcontactmodal input[name='e_jibun_addr1']").val( data.jbAddr )
  $("#popcontactmodal input[name='e_addr1']").trigger("change")
}

$("document").ready( function() {
  $("#popcontact-page-form .pop-page-step .pop-page-step-header").on("click", function (e){
    var target = $(e.target).closest('.pop-page-step');
    if( !$(target).hasClass('step-avail-open') ) {
      return;
    }
    var step_no = $(target).data('step')
    if( step_no > popcontact_step_availMax ){
      toast('전 단계를 먼저 입력해주세요', 'topCenter')
      return;
    }
    else if( $(target).hasClass('step-last-call')) {
      return;
    }
    old_step = popcontact_step_open
    popcontact_step_open = $(target).data('step')

    addModalSet({'type':'popcontact', "step": old_step , 'command':'step' },popcontact_step_open, "contact");

    drawstep(target)
  })
  $("#popcontactmodal .top-steps-wrap div[class^='step-']").on("click", function (e){
    var target = $(e.target).closest('.pop-page-step');
    if( !$(e.target).hasClass('top-step-done') && !$(e.target).hasClass('top-step-ing') ) {
      return;
    }
    var step_no = $(e.target).data('step')
    if( step_no > popcontact_step_availMax ){
      toast('전 단계를 먼저 입력해주세요', 'topCenter')
      return;
    }
    else $("#popcontact_step_" + step_no ).children(".pop-page-step-header").trigger("click")
  })
  if( window.location.hash.includes( '#contact') ){
    history.pushState("", document.title, window.location.pathname + window.location.search);
    openpopcontact();
  }
});
</script>
