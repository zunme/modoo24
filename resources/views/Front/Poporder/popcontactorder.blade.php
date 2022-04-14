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
        <!-- todo exception -->
        <input type="hidden" name="contact_orderid" value="" />

        <div
          class="pop-page-step step1 step-avail-open step-opened "
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
<!-- todo step-opened step-last-call -->
        <div
          class="pop-page-step step5" class2="step-avail-open step-opened step-last-call"
          data-step="5"
          id="popcontact_step_5"
          data-url="step5">
          @include('Front.Poporder.Inc.contactstep5')
        </div>

      </form>

    </div>
    <div class="pop-page-content overflowhidden contact-complete" id="contact-complete-area">
      @include('Front.Poporder.Inc.contactcomplete')
    </div>

    <!-- 업체 상세보기 모달 -->
    <div class="modal fade" id="staffmodal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="staffmodal_body">

        </div>
      </div>
    </div>
    <!-- / 업체 상세보기 모달 -->

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
p.alert60day{
  font-size: 22px;
  margin-bottom: 10px;
}
</style>

<script>
Handlebars.registerHelper('gt2', function(a, b) {
  console.log ( a, b)
  console.log ( a >  b )
  return (a > b);
});
let popcontactcompleteRecommendTemplate = `
<div class="contact_popup">
    <div class="contact_popupCon">
        <ul>
            <li>
                고객님 감사합니다.
            </li>
            <li>
                이사신청이 <strong>완료</strong> 되었습니다.
            </li>
        </ul>
        <p class="popup_close" onclick="closepopnbtn()">닫기</p>
    </div>
</div>
`
let popcontactcompleteOverTemplate = `
<div class="contact_popup contact_popup60">
    <div class="contact_popupCon">
        <ul>
            <li>
                모두이사는 오늘부터<br> <b>60일 이내</b> 이사일의 방문견적이 가능합니다.
            </li>
            <li>
                <strong>@{{calldate}}</strong> 이후에 연락드리겠습니다.
            </li>
        </ul>
        <p class="popup_close" onclick="closepopnbtn()">닫기</p>
    </div>
</div>
`
let popcontactcompleteSelectionTemplate = `
<div class="contact_popup contact_select_popup">
    <div class="contact_popupCon contact_select_popupCon">
        <ul>
            <li>
                고객님 감사합니다.
            </li>
            <li>
                이사신청이 <strong>완료</strong> 되었습니다.
            </li>
        </ul>
        <div class="contact_selectBox">
            <div class="contact_myInfo">
                <h2>나의 이사정보</h2>
                <ul>
                    <li>
                        <span>이사종류</span>
                        <p>@{{stype}}이사</p>
                    </li>
                    <li>
                        <span>이사날짜</span>
                        <p>@{{mdate}}</p>
                    </li>
                    <li>
                        <span>이름/연락처</span>
                        <p><span>@{{name}}</span> <span>@{{hp}}</span></p>
                    </li>
                    <li>
                        <span>출발지</span>
                        <p>@{{arrivals}}</p>
                    </li>
                    <li>
                        <span>도착지</span>
                        <p>@{{depatures}}</p>
                    </li>
                </ul>
            </div>
            <div class="contact_mySelect_company">
                <h2>내가 선택한 이사업체</h2>
                <ul>
                @{{#each companies}}
                    <li>
                        <p>@{{s_company}}</p>
                        <span onClick="staffmodalpop('/v2//pop/company/@{{ base64 s_uid}}')">상세보기</span>
                    </li>
                @{{/each}}
                </ul>
            </div>
        </div>
        <p class="popup_close" onclick="closepopnbtn()">닫기</p>
    </div>
</div>
`
var popcontactcompleteCompiled
var popcontactcompleteOverCompiled


var popcontact_step_history = 0
var popcontact_step_open = 1;
/*TODO 5=>1*/
var popcontact_step_availMax = 1;

var mfcontactform = new mfFormStorage('popcontact-page-form','pop-page-form-contact' )

var contact_search_template = `<div class="contact_companylist_searching">
        <div class="contact_search_ing">
          <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
          검색중입니다.
        </div>
      </div>`

function scrollToCompanylist(){
  var diffoffset = $("#contact_companylist").offset().top - $("#contact_companylist").parent().offset().top
  setTimeout(function(){
    $("#contact_companylist").closest(".pop-page-step-body").scrollTop(diffoffset)
  },300)

}
function checkAllFnContact(btn){
  checkAllFn(btn)
}
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

  dataLayer.push({'event' : 'conatctpop_event_1' });
  $.get('/v2/tracelog/contact/1');
  console.log ( "event : conatctpop_event_1" )
}
function resetCompanyList(e){
  var exceptName = [
        'contact_list_recommend',
        // 'agree1','agree2','agree_marketing',
        'except_reset_cehck',
        //'use_container','use_clean','internet_call',
        //'register_name','register_phone','memo',
        'company[]'
    ]
  var name = $(e.target).prop('name')
  console.log( name )
  if( !exceptName.includes(name) || ( !$("#popcontact-page-form input[name='agree1']").prop("checked") || !$("#popcontact-page-form input[name='agree2']").prop("checked") ) ) {
    console.log("reset companylist")
    resetCompanyPrc(e);
  }else {
    if($("input[name='contact_list_recommend']:checked").val()=='recommend') $("#contact_companylist").empty()
  }

}
function resetCompanyPrc(e) {
  var nowstep = popcontact_step_open;

  if( typeof e == 'object' && typeof e.target != 'undefined'){
    nowstep =  $(e.target).closest('.pop-page-step').data('step')
    popcontact_step_availMax = nowstep;
  }else if ( popcontact_step_open > 4) popcontact_step_availMax=4;

  popcontact_step_open = popcontact_step_availMax;
  console.log ( "avail :" + popcontact_step_availMax, ", open : " +  popcontact_step_open);

  for ( var i = popcontact_step_open + 1; i < 6; i ++ ){
    $("#popcontact_step_"+i).removeClass("step-avail-open").removeClass("step-opened").removeClass("step-last-call")
    $("#popcontactmodal .top-steps-wrap .step-" + i).removeClass("top-step-done").removeClass("top-step-ing");
  }
  $("#popcontactmodal .top-steps-wrap .step-" + popcontact_step_open).removeClass("top-step-done").addClass("top-step-ing");


  $("input[name='contact_list_recommend']:checked").prop("checked",false)
  $("#contact_companylist").empty()
  //$("#popcontact_step_5").removeClass("step-avail-open").removeClass("step-opened").removeClass("step-last-call")
  console.log ( "avail :" + popcontact_step_availMax, ", open : " +  popcontact_step_open);
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
  $("#popcontact_step_" + step ).children(".pop-page-step-header").trigger("click")
}

/*TODO 성공시 daum 새로만들것*/
function nextcontactlevel(res){
  var step = $("#popcontactmodal .step-last-call").data('step')
  if( step < 1) step = 1;
  //++pop_step_availMax;
  if( typeof res.data == 'object' && typeof res.data.diffday !='undefined' && !res.data.diffday ){
    console.log ("60일 이상");
    //Swal.fire('<p class="alert60day alert60dayline1">모두이사는 오늘부터 60일 이내 이사 일의 방문견적이 가능합니다.</p><p class="alert60day alert60dayline2">'+res.data.calldate+' 이후에 연락드리겠습니다.</p>', '', 'success');
    $("#contact-complete-area").html(popcontactcompleteOverCompiled(res.data))
    closeContact('60');
    mfcontactform.clearInpusts();
    return;
  }
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

  if( typeof res.data == 'object' && res.data.orderid ){
    $("input[name='contact_orderid']").val( res.data.orderid )
  }
  /*TODO*/
  dataLayer.push({'event' : 'conatctpop_event_' + (parseInt(step)+1) })
  $.get('/v2/tracelog/contact/'+ (parseInt(step)+1))
  console.log ( "event : conatctpop_event_"+ (parseInt(step)+1) )
}
/*TODO 실패시 */
function orderContactFormCheckError(res){
ajaxErrorST(res )
resetCompanyPrc();
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
  if( typeof data.buildingName !='undefined' && data.buildingName !='' ) jbAddr += ' ('+data.buildingName+')'
  //$("#popcontactmodal input[name='s_addr1']").val( (addr + extraAddr).trim() )
  $("#popcontactmodal input[name='s_addr1']").val( jbAddr.trim() )
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
  if( typeof data.buildingName !='undefined' && data.buildingName !='' ) jbAddr += ' ('+data.buildingName+')'

  //$("#popcontactmodal input[name='e_addr1']").val( (addr + extraAddr).trim() )
  $("#popcontactmodal input[name='e_addr1']").val( jbAddr.trim() )
  $("#popcontactmodal input[name='e_bcode']").val( data.bcode )
  $("#popcontactmodal input[name='e_sigunguCode']").val( data.sigunguCode )

  $("#popcontactmodal input[name='e_zip1']").val( data.zonecode )
  $("#popcontactmodal input[name='e_jibun_addr1']").val( data.jbAddr )
  $("#popcontactmodal input[name='e_addr1']").trigger("change")
}

$("document").ready( function() {

   popcontactcompleteCompiled = Handlebars.compile(popcontactcompleteSelectionTemplate)
   popcontactcompleteOverCompiled =  Handlebars.compile(popcontactcompleteOverTemplate)

  $("#popcontact-page-form .pop-page-step .pop-page-step-header").on("click", function (e){
    var target = $(e.target).closest('.pop-page-step');
    if( !$(target).hasClass('step-avail-open') ) {
      return;
    }
    var step_no = $(target).data('step')
    if( step_no > popcontact_step_availMax ){
      toast('전 단계를 먼저 입력, 저장 해주세요', 'topCenter')
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
      toast('전 단계를 먼저 입력, 저장 해주세요', 'topCenter')
      return;
    }
    else $("#popcontact_step_" + step_no ).children(".pop-page-step-header").trigger("click")
  })
  if( window.location.hash.includes( '#contact') ){
    history.pushState("", document.title, window.location.pathname + window.location.search);
    openpopcontact();
  }
});

function contact_companylist_recommendprcforce(){
  /* TODO */
}

function contactprc(){
  getpost('/v2/order/contact/complete', $("#popcontact-page-form").serialize(), contactSelectionSuccess, inContactPopLoaderClose, orderContactFormCheckError )
  //Swal.fire('고객님 감사합니다<br> 이사신청이 완료 되었습니다.', '', 'success')
  //closeContact();
}
function contactSelectionSuccess(res){
  if (typeof res =='object' &&  typeof res.data != 'undefined' && res.data.companies.length > 0 ){
    //res = JSON.parse(`{"status":"Success","message":null,"data":{"stype":"\uac00\uc815","mdate":"2022-04-09","name":"\ud14c\uc2a4\ud2b81","hp":"010-2537-6460","depatures":"\uc11c\uc6b8 \uc1a1\ud30c\uad6c \uac00\ub77d\ub85c 2 (\uc11d\ucd0c\ub3d9) 12","arrivals":"\ubd80\uc0b0 \uc5f0\uc81c\uad6c \uacbd\uae30\uc7a5\ub85c 7-52 (\uac70\uc81c\ub3d9)","companies":[{"s_uid":1139,"s_company":"\ud14c\uc2a4\ud2b85 \uc774\uc0ac\ub791\uccad\uc18c\ub791"}]}}`)
    $("#contact-complete-area").html( popcontactcompleteCompiled(res.data) )
  }else{
    $("#contact-complete-area").html( popcontactcompleteRecommendTemplate )
  }
  closeContact()
  mfcontactform.clearInpusts()
}


function maxLengthCheck(object){
  if (object.value.length > object.maxLength){
    object.value = object.value.slice(0, object.maxLength);
  }
}
</script>
