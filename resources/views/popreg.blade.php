<link rel="stylesheet" href="/community/assets/css/flexgrid.css">
<link rel="stylesheet" href="/community/assets/css/orderpop.css">
<link rel="stylesheet" href="/community/assets/css/orderpopdetail.css">
<style>
.w-100{
  width: 100%;
}
.pop-page-step-footer{
  display: flex;
  justify-content: center;
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


        </div>
      </div>


      <div class="pop-page-content overflowhidden">
        <form id="pop-page-form">
          <input class="input js-persist" type="checkbox" name="save" checked style="display:none">

          <div class="pop-page-step step1  step-avail-open step-opened step-last-call" data-step='1' id="popn_step_1" data-url="step1">
            @include('Front.Poporder.Inc.nfacestep1')
          </div>

          <div class="pop-page-step step2" data-step='2' id="popn_step_2" data-url="step2">
            @include('Front.Poporder.Inc.nfacestep2')
          </div>
          <div class="pop-page-step step3" data-step='3' id="popn_step_3" data-url="step3">
            @include('Front.Poporder.Inc.nfacestep3')
          </div>
          <div class="pop-page-step step4 " data-step='4' id="popn_step_4" data-url="step4">
            @include('Front.Poporder.Inc.nfacestep4')
          </div>

          <div class="pop-page-step step5 " data-step='5' id="popn_step_5" data-url="steplast">
            @include('Front.Poporder.Inc.nfacestep5')
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
<!-- 견적신청 -->
<script src='https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js'></script>
<script src='/community/assets/js/orderpop_daum.js'></script>

<script src='/community/assets/js/mfformstorage.js?v=20220106152300'></script>
<script src='/community/assets/js/mfuploader.js?v=20220106152300'></script>

<script>
var pop_step_history = 0
var pop_step_open = 1;
var pop_step_availMax = 1;
var mfform = new mfFormStorage('pop-page-form','pop-page-form-nface' )

function addModalSet(data,pop_step_opened){
    var old_no = pop_step_history;
    history.pushState({}, '', '#estimate'+pop_step_opened )
    modal_set_arr.push(data);
    if( pop_step_history < 0 ) pop_step_history = 1;
    else ++pop_step_history;
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


  // DATA
  mfform.loadData()

  $("#pop-page-form input").off('change').on('change', function (e) {
    mfform.save()
    //var currentstep = getCurrentStep();
  })

  if( $("#nface-step-mdate-inp").val() != ''){
    $('#nface-step-movedate').datepicker('update', $("#nface-step-mdate-inp").val() );
  }else console.log( 'date not load2 ')
  $("body").trigger( "stepPopOpended" );
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
  var step = $(".step-last-call").data('step');
  if( typeof step =="undefined" || step < 1 ) step = 1;
  getOrderNfaceFromCheck(step, $(".step-last-call").data('url') )
}
function gotoStep(no){
  $("#popn_step_" + no ).children(".pop-page-step-header").trigger("click")
}
function getCurrentStep(){
  var step = $(".step-last-call").data('step')
  return ( step < 1 ) ? '1' : step
}
$("document").ready( function() {
  $(".pop-page-step .pop-page-step-header").on("click", function (e){
    console.log ( "header clicked")
    var target = $(e.target).closest('.pop-page-step');
    if( !$(target).hasClass('step-avail-open') ) {
      console.log ( "not...")
      return;
    }
    var step_no = $(target).data('step')
    if( step_no > pop_step_availMax ){
      toast('전 단계를 먼저 입력해주세요', 'topCenter')
      return;
    }

    else if( $(target).hasClass('step-last-call')) {
      return;
    }

    console.log( $(target))
    old_step = pop_step_open
    pop_step_open = $(target).data('step')

    addModalSet({'type':'popn', "step": old_step , 'command':'step' },pop_step_open);

    drawstep(target)
  })
  $(".top-steps-wrap div[class^='step-']").on("click", function (e){
    var target = $(e.target).closest('.pop-page-step');
    if( !$(e.target).hasClass('top-step-done') && !$(e.target).hasClass('top-step-ing') ) {
      console.log ( "not...")
      return;
    }
    var step_no = $(e.target).data('step')
    console.log ( step_no)
    if( step_no > pop_step_availMax ){
      toast('전 단계를 먼저 입력해주세요', 'topCenter')
      return;
    }
    else $("#popn_step_" + step_no ).children(".pop-page-step-header").trigger("click")
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

// /pop script


<script>
  function startaddress( addr, extraAddr, data ){

    // 주소관련
    var jbAddr = data.jibunAddress;
		if(jbAddr === '')  jbAddr = data.autoJibunAddress;

    $("#s_addr1").val( (addr + extraAddr).trim() )
    $("#s_bcode").val( data.bcode )
    $("#s_sigunguCode").val( data.sigunguCode )

    $("#s_zip1").val( data.zonecode )
    $("#s_jibun_addr1").val( data.jbAddr )

  }
  // 주소관련
  function endaddress( addr, extraAddr, data ){
    var jbAddr = data.jibunAddress;
		if(jbAddr === '')  jbAddr = data.autoJibunAddress;

    $("#e_addr1").val( (addr + extraAddr).trim() )
    $("#e_bcode").val( data.bcode )
    $("#e_sigunguCode").val( data.sigunguCode )

    $("#e_zip1").val( data.zonecode )
    $("#e_jibun_addr1").val( data.jbAddr )
  }
  function getOrderNfaceFromCheck(step, url){
      getpost('/v2/order/nface/'+url, $("#pop-page-form").serialize(), nextlevel, console.log, orderNfaceFormCheckError )
  }


  function nextlevel(res){
    var step = $(".step-last-call").data('step')
    if( step < 1) step = 1;
    ++pop_step_availMax;
    $("#popn_step_" + (parseInt(step)+1) ).addClass("step-avail-open");
    $("#popn_step_" + (parseInt(step)+1) ).children(".pop-page-step-header").trigger("click")

    $("#topstepper_" + parseInt(step)  ).addClass("top-step-done").removeClass('top-step-ing')
    $("#topstepper_" + (parseInt(step)+1) ).addClass("top-step-ing");

    if( typeof res.data !='undefined' && typeof res.data.command !='undefined' ){
      if( typeof window[res.data.command] =='function') window[res.data.command]( res.data )
    }
  }

  function orderNfaceFormCheckError(res){
    ajaxErrorST(res )
    if( typeof res.responseJSON.data != 'undefined' && typeof res.responseJSON.data.step != 'undefined'){
      resetNowStep(res.responseJSON.data.step)
    }
  }
  function resetNowStep(step_no){
    $("#popn_step_" + step_no ).children(".pop-page-step-header").trigger("click")
  }
</script>



<!--
<script type="module">
			import devtools from 'https://unpkg.com/devtools-detect';
      console.log ( devtools.isOpen ? 'yes' : 'no' )
      console.log (devtools.orientation ? devtools.orientation : '' )

	window.addEventListener('devtoolschange', event => {
    console.log ( event.detail.isOpen ? 'yes' : 'no' )
    console.log (event.detail.orientation ? event.detail.orientation : '' )
	});
</script>
-->
