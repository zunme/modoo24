<link rel="stylesheet" href="/community/assets/css/clean_order_pop.css" />
<script src="/v2/assets/js/popperv2.js"></script>
<link
  rel="stylesheet"
  href="https://unpkg.com/tippy.js@6/animations/scale.css"
/>
<style>
.clean-complete{
  display:none;
}
.clean-completed .clean-complete{
  display: block;
}
.clean-completed .clean-prc{
  display: none;
}
/* popper css*/
.tippy-box[data-theme~='clean'] {
  background-color: deeppink;
  color: white;
  font-size: 14px;
}
.tippy-box[data-theme~='clean'][data-placement^='top'] > .tippy-arrow::before {
  border-top-color: deeppink;
}
.tippy-box[data-theme~='clean'][data-placement^='bottom'] > .tippy-arrow::before {
  border-bottom-color: deeppink;
}
.tippy-box[data-theme~='clean'][data-placement^='left'] > .tippy-arrow::before {
  border-left-color: deeppink;
}
.tippy-box[data-theme~='clean'][data-placement^='right'] > .tippy-arrow::before {
  border-right-color: deeppink;
}
</style>
<div class="popup modal-in modal-out" id="popcleanmodal">
  <div class="page">
    <div class="pop-navbar elevation-1">
      <div class="pop-navbar-bg"></div>

      <div class="pop-navbar-inner">
        <div class="pop-left">
          <span class="link pop-back" onClick="history.back()"><i class="fas fa-chevron-left"></i></span>
        </div>
        <div class="pop-title">청소 견적 신청</div>
        <div class="pop-right">
          <span class="link pop-close" onClick="closepopnbtn()">
            <i class="fas fa-times"></i>
          </span>
        </div>
      </div>

      <div class="pop-navbar-inner pop-navbar-stepper">
        <div class='top-steps-wrap'>
          <div class='step-1 top-step-ing' id="top_clean_stepper_1" data-step='1' >1</div>
          <div class='line-1'></div>
          <div class='step-2 ' id="top_clean_stepper_2" data-step='2' >2</div>
          <div class='line-2'></div>
          <div class='step-3' id="top_clean_stepper_3" data-step='3' >3</div>
          <div class='line-3'></div>
          <div class='step-4' id="top_clean_stepper_4" data-step='4' >4</div>
          <div class='line-5'></div>
          <div class='step-5' id="top_clean_stepper_5" data-step='5' >5</div>
          <div class='line-6'></div>
          <div class='step-6' id="top_clean_stepper_6" data-step='6' >6</div>
        </div>
      </div>
      <div class="inpopup-inline-progressbar-wrap">
        <div class="inpopup-inline-progressbar">
          <span id="inpopup-inline-progressbar"></span>
        </div>
      </div>
    </div>



    <div class="pop-page-content overflowhidden clean-prc">
      <form id="popclean-page-form">
        <!-- todo exception -->
        <input type="hidden" name="clean_orderid" value="" />

        <input type="hidden" name="s_bcode" value="" />
        <input type="hidden" name="s_sigunguCode" value="" />
        <input type="hidden" name="s_zip1" value="" />
        <input type="hidden" name="s_jibun_addr1" value="" />

        <div
          class="pop-page-step step1 step-avail-open step-opened "
          data-step="1"
          id="popclean_step_1"
          data-url="step1">
          @include('Front.Poporder.Inc.cleanstep1')
          <input type="text" name="null" style="height:0;width:0;border:none;">
        </div>

        <div
          class="pop-page-step step2"
          data-step="2"
          id="popclean_step_2"
          data-url="step2">
          @include('Front.Poporder.Inc.cleanstep2')
          <input type="text" name="null" style="height:0;width:0;border:none;">
        </div>

        <div
          class="pop-page-step step3"
          data-step="3"
          id="popclean_step_3"
          data-url="step3">
          @include('Front.Poporder.Inc.cleanstep3')
          <input type="text" name="null" style="height:0;width:0;border:none;">
        </div>

        <div
          class="pop-page-step step4"
          data-step="4"
          id="popclean_step_4"
          data-url="step4">
          @include('Front.Poporder.Inc.cleanstep4')
          <input type="text" name="null" style="height:0;width:0;border:none;">
        </div>
<!-- todo step-opened step-last-call -->
        <div
          class="pop-page-step step5"
          data-step="5"
          id="popclean_step_5"
          data-url="step5">
          @include('Front.Poporder.Inc.cleanstep5')
          <input type="text" name="null" style="height:0;width:0;border:none;">
        </div>

        <div
          class="pop-page-step step6"
          data-step="6"
          id="popclean_step_6"
          data-url="step6">
          @include('Front.Poporder.Inc.cleanstep6')
          <input type="text" name="null" style="height:0;width:0;border:none;">
        </div>

      </form>


    </div>
    <div class="pop-page-content overflowhidden clean-complete" id="clean-complete-area">
      @include('Front.Poporder.Inc.cleancompleted')
    </div>

  </div>
</div>

<script>
let nextsidebtn = `<div class="clean-next-side-btn" onClick="gotoCleanNextStep(this)"><i class="fas fa-angle-right"></i><div>다음</div></div>`
function adddatepickerside(){
  $("#clean-step-movedate .datepicker-days").append(nextsidebtn )
}
let popcleancompleteRecommendTemplate = `
<div class="clean_popup">
    <div class="clean_popupCon">
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

var popclean_step_history = 0
var popclean_step_open = 1;
/*TODO 5=>1*/
var popclean_step_availMax = 1;

var mfcleanform = new mfFormStorage('popclean-page-form','pop-page-form-clean' )

function checkAllFnClean(btn){
  $("#popcleanmodal input[name='s_addr1']").trigger("change")
  checkAllFn(btn)
}
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
    resetClean(e);
    //var currentstep = getCurrentStep();
  })
  if( $("#conatct-step-mdate-inp").val() != ''){
    $('#conatct-step-movedate').datepicker('update', $("#conatct-step-mdate-inp").val() );
  }else console.log( 'date not load2 ')

  if( $("input[name=room_except]").prop("checked")) disableCleanOptionNumber( $("input[name=room_except]") )
  if( $("input[name=toilet_except]").prop("checked")) disableCleanOptionNumber( $("input[name=toilet_except]") )
  if( $("input[name=veranda_except]").prop("checked")) disableCleanOptionNumber( $("input[name=veranda_except]") )

}
function disableCleanOptionNumber(btn){
  $(btn).closest('.clean_area_item').addClass("noneoptioned")
  $(btn).closest('.clean_area_item').find('.stepper-init').addClass("stepper-disabled")
  $(btn).closest('.clean_area_item').find('input').prop('readonly', true)
}
function resetClean(e) {
  console.log ( "reset clean")
  var nowstep = popclean_step_open;

  if( typeof e == 'object' && typeof e.target != 'undefined'){
    nowstep =  $(e.target).closest('.pop-page-step').data('step')
    popclean_step_availMax = nowstep;
  }else if ( popclean_step_open > 4) popclean_step_availMax=4;

  popclean_step_open = popclean_step_availMax;
  console.log ( "avail :" + popclean_step_availMax, ", open : " +  popclean_step_open);

  for ( var i = popclean_step_open + 1; i < 6; i ++ ){
    $("#popclean_step_"+i).removeClass("step-avail-open").removeClass("step-opened").removeClass("step-last-call")
    $("#popcleanmodal .top-steps-wrap .step-" + i).removeClass("top-step-done").removeClass("top-step-ing");
  }
  $("#popcleanmodal .top-steps-wrap .step-" + popclean_step_open).removeClass("top-step-done").addClass("top-step-ing");


  $("input[name='clean_list_recommend']:checked").prop("checked",false)
  $("#clean_companylist").empty()
  //$("#popclean_step_5").removeClass("step-avail-open").removeClass("step-opened").removeClass("step-last-call")
  console.log ( "avail :" + popclean_step_availMax, ", open : " +  popclean_step_open);
}
var testtarget
function gotoCleanNextStep(btn) {
  var target = $(btn).closest('.pop-page-step')
  testtarget = target
  var step = $(target).data('step');
  if( typeof step =="undefined" || step < 1 ) step = 1;
  getOrderCleanFromCheck(step, $(target).data('url') )
}
function gotoCleanStep(no){
  $("#popclean_step_" + no ).children(".pop-page-step-header").trigger("click")
}
function getOrderCleanFromCheck(step, url){
  console.log ( step, url)
  inCleanPopLoaderOpen()
  getpost('/v2/order/clean/'+url, $("#popclean-page-form").serialize(), nextcleanlevel, inCleanPopLoaderClose, orderCleanFormCheckError )
}

/*로딩*/
function inCleanPopLoaderOpen(){
  loaderAttach("#popcleanmodal .page")
}
function inCleanPopLoaderClose(){
  loaderAttach("#popcleanmodal .page", false)
}
/*TODO*/
function resetNowCleanStep(step){
  $("#popclean_step_" + step ).children(".pop-page-step-header").trigger("click")
}

/*TODO 성공시 daum 새로만들것*/
function nextcleanlevel(res){
  var step = $("#popcleanmodal .step-last-call").data('step')
  if( step < 1) step = 1;
  //++pop_step_availMax;

  popclean_step_availMax = step+1;

  $("#popclean_step_" + (parseInt(step)+1) ).addClass("step-avail-open");
  $("#popclean_step_" + (parseInt(step)+1) ).children(".pop-page-step-header").trigger("click")

  $("#top_clean_stepper_" + parseInt(step)  ).addClass("top-step-done").removeClass('top-step-ing')
  $("#top_clean_stepper_" + (parseInt(step)+1) ).addClass("top-step-ing");

  if( typeof res.data !='undefined' && typeof res.data.command !='undefined' ){
    if( typeof window[res.data.command] =='function') window[res.data.command]( res.data )
  }

  var depth = 5;
  var precentage = (100 - ( step * 100 / depth )) * -1;
  $("#popcleanmodal #inpopup-inline-progressbar").css('transform', 'translate3d('+ precentage +'%, 0px, 0px)')
  closeDaumPostcode()
  /*TODO*/
  //dataLayer.push({'event' : 'conatctpop_event_' + (parseInt(step)+1) })

  if( typeof res.data == 'object' && res.data.orderid ){
    $("input[name='clean_orderid']").val( res.data.orderid )
  }
  console.log ( "gtag : conatctpop_event_"+ (parseInt(step)+1) )
}
/*TODO 실패시 */
var poppertarget
function orderCleanFormCheckError(res){
ajaxErrorST(res )
//resetCompanyPrc();
if( typeof res == 'object' && typeof res.responseJSON == 'object' && typeof res.responseJSON.data != 'undefined' && typeof res.responseJSON.data.step != 'undefined'){
  resetNowCleanStep(res.responseJSON.data.step)
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
          console.log( key)
          console.log (poppsers[key])
          if (typeof poppsers[key] !='undefined'){
              if( $(poppsers[key].reference).closest('.step-body-section').length > 0) {
                $(poppsers[key].reference).closest('.pop-page-step-body').scrollTop( $(poppsers[key].reference).offset().top - $(poppsers[key].reference).closest('.step-body-section').offset().top)
              }

              poppsers[key].show();
          }
        }, 50)
        break;
      }
    }
  }
}

}

// 주소관련
function startCleanAddress( addr, extraAddr, data ){
  var jbAddr = data.jibunAddress;
  if(jbAddr === '')  jbAddr = data.autoJibunAddress;

  $("#popcleanmodal input[name='s_addr1']").val( (addr + extraAddr).trim() )
  $("#popcleanmodal input[name='s_bcode']").val( data.bcode )
  $("#popcleanmodal input[name='s_sigunguCode']").val( data.sigunguCode )

  $("#popcleanmodal input[name='s_zip1']").val( data.zonecode )
  $("#popcleanmodal input[name='s_jibun_addr1']").val( data.jbAddr )
  $("#popcleanmodal input[name='s_addr1']").trigger("change")
}

var poppsers = []
function createPopperInstance(target,content, delay,theme){
  if( typeof delay == 'undefined') delay=2000;
  if( typeof theme == 'undefined') theme='clean';
  var instance =tippy(target, {
  	content: content ,duration:[250, 1000],trigger:'manual',allowHTML:true,theme:theme,
  	onShow(instance){
  		setTimeout(function () {
          if (instance.state.isVisible) {
            instance.hide();
          }
        }, delay);
  	}
  });
  if( typeof instance == 'object' && typeof instance[0] == 'object' ) return instance[0];
  else return false;
}
$("document").ready( function() {
  /*popper setting */
  poppsers['stype'] = createPopperInstance( '#clean_check_stype', '청소종류를 선택해주세요')
  poppsers['mdate'] = createPopperInstance( '#clean-step-movedate table tbody tr:nth-child(3)', '청소날짜를 선택해주세요')
  poppsers['clean_building'] = createPopperInstance( '.clean_select_building > ul > li:nth-child(2) label', '건물형태를 선택해주세요')
  poppsers['clean_space'] = createPopperInstance( '.clean_select_space > ul > li:nth-child(2) label', '공간형태를 선택해주세요')
  poppsers['options'] = createPopperInstance( '.clean_option > ul > li:nth-child(2) label', '옵션을 선택해주세요')
  poppsers['s_addr1'] = createPopperInstance( '.clean_address input[name=s_addr1]', '주소를 입력해주세요')
  poppsers['s_addr2'] = createPopperInstance( '.clean_address input[name=s_addr2]', '상세주소를 입력해주세요')
  poppsers['s_pyeong'] = createPopperInstance( '.clean_address input[name=s_pyeong]', '평수를 입력해주세요')
  poppsers['s_floor'] = createPopperInstance( '.clean_address input[name=s_floor]', '층수를 입력해주세요')


  $("#popclean-page-form .pop-page-step .pop-page-step-header").on("click", function (e){
    var target = $(e.target).closest('.pop-page-step');
    if( !$(target).hasClass('step-avail-open') ) {
      return;
    }
    var step_no = $(target).data('step')
    if( step_no > popclean_step_availMax ){
      toast('전 단계를 먼저 입력, 저장 해주세요', 'topCenter')
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
  $("#popcleanmodal .top-steps-wrap div[class^='step-']").on("click", function (e){
    var target = $(e.target).closest('.pop-page-step');
    if( !$(e.target).hasClass('top-step-done') && !$(e.target).hasClass('top-step-ing') ) {
      return;
    }
    var step_no = $(e.target).data('step')
    if( step_no > popclean_step_availMax ){
      toast('전 단계를 먼저 입력, 저장 해주세요', 'topCenter')
      return;
    }
    else $("#popclean_step_" + step_no ).children(".pop-page-step-header").trigger("click")
  })
  if( window.location.hash.includes( '#clean') ){
    history.pushState("", document.title, window.location.pathname + window.location.search);
    openpopclean();
  }
});

function cleanprc(){
  inCleanPopLoaderOpen()
  getpost('/v2/order/clean/complete', $("#popclean-page-form").serialize(), cleanSuccess, inCleanPopLoaderClose, orderCleanFormCheckError )
  return;
}
function cleanSuccess(res){
  closeClean()
}
function closeClean(){
  $("#popcleanmodal").addClass("clean-completed")
  $("#popcleanmodal .inpopup-inline-progressbar > span").css('transform', 'translate3d(0px, 0px, 0px)')

  $("#popcleanmodal .top-steps-wrap").html('<i class="fas fa-check"></i> <div class="completeClean-step-title">견적신청완료</div>');
}
</script>
