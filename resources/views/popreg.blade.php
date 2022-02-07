<link rel="stylesheet" href="/community/assets/css/flexgrid.css">
<link rel="stylesheet" href="/community/assets/css/orderpop.css?v=20220207164444">

@if ( request()->get('css') =='test')
<link rel="stylesheet" href="/community/assets/css/orderpopdetailv2.css?v=20220207164444">
@else
<link rel="stylesheet" href="/community/assets/css/orderpopdetail.css?v=20220207164444">
@endif
@if ( request()->get('cssv2') =='test')
<link rel="stylesheet" href="/community/assets/css/orderpopdetailv2_more.css?v=20220207164444">
@endif
<style>
.w-100{
  width: 100%;
}
.pop-page-step-footer{
  display: flex;
  justify-content: center;
}

.pop-page-content-pop-bg{
    z-index : 1005;
    position: absolute;
    background-color: rgb(0 0 0 / 0%);
    top: 0;bottom: 0;left: 0;right: 0;
    transition: background 500ms;
    display:none;
}
.pop-page-content-pop-bg.opened{
  background-color: rgb(0 0 0 / 80%);
  transition: background-color 800ms;
  display:block;
}
.pop-page-content-pop{
  max-height: calc( 100% - 44px - var(--navbar-stepper-height) - ( var(--page-step-header-realheight) * 3 ) );
  position: absolute;
  z-index: 1005;
  bottom: 0;
  right: 0;
  left: 0;
  overflow: hidden;
  transform: translate3d(0, 2000px, 0);
  transition: background-color 800ms
}
.pop-page-content-pop.opened{
  transform: translate3d(0, 0, 0);
  transition: transform 500ms;
}

.pop-page-content-pop-head{
  background-color: #55acee;
  color: white;
  margin: 0 10px;
  padding: 10px 20px;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  border: 1px solid #406b8b;
  display: flex;
  justify-content: space-between;
}

.pop-page-content-pop-head-closebtn i{
  font-size: 22px;
  color: #f3f3f3;
  cursor: pointer;
}
.pop-page-content-pop-body{
  max-height: 60vh;
  overflow-y: auto;
  margin: 0 10px;
  background: white;
  border-left: 1px solid #406b8b;
  border-right: 1px solid #406b8b;
}
.pop-page-content-pop-body-cont{
}


.pop-page-options-wrap{
  padding: 20px 10px;
}
.pop-page-options-select{
  display: flex;
  justify-content: end;
  margin-bottom: 10px;
  color: #666;
}
.pop-page-options-select-item{
  margin-right: 8px;
  color: #282828;
}
.pop-page-options-list{
  -webkit-box-shadow: inset 0 1px 0 0 #c7c7c7, inset 0 -1px 0 0 #c7c7c7;
  box-shadow: inset 0 1px 0 0 #c7c7c7, inset 0 -1px 0 0 #c7c7c7;
  --pop-page-options-per-row: 1;
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  justify-content: flex-end;
}
.pop-page-options-list-item{
  --pop-content-list-select-space: 10px;
  --pop-content-list-select-space-bottom: 10px;
  --f7-touch-ripple-color: rgba(0, 122, 255 , 0.25);
  --goods-stepper-height: 28px;
  --goods-stepper-border-radius: 5px;
  --goods-stepper-color: #666;
  --goods-stepper-button-text-color: #666;
  --goods-stepper-button-bg-color: #eee;
  display: flex;
  justify-content: space-between;
  padding:15px 20px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  width: calc( 100% / var(--pop-page-options-per-row) );
  max-width: 400px;
}
.pop-page-options-list .pop-page-options-list-item:last-child{
  border-bottom:none;
}
.pop-page-options-list-item-title{
  line-height: 28px;
  margin-right: 30px;
}

.pop-page-options-btnwrap{
  display: flex;
  justify-content: flex-end;
  padding-right: 15px;
}
</style>

<style>
/* loader */
#nfacepoploader,#aipoploader{
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgb(0 0 0 / 80%);
  z-index: 510;
  display: none;
}
#nfacepoploader.loading,#aipoploader.loading{
  display: block;
}
#nfacepoploader .nfacepoploader-wrapper,
#aipoploader .nfacepoploader-wrapper {
    position: absolute;
    width: 200px;
    height: 2px;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    margin: auto;
}
.nfacepoploader-loader {
  height: 100%;
  display: flex;
  transform: translateZ(0);
}
.nfacepoploader-loader div {
  flex: 1;
  background: #0092ff;
  -webkit-animation: nfacepoploadergo 0.8s infinite alternate ease;
          animation: nfacepoploadergo 0.8s infinite alternate ease;
  box-shadow: 0 0 20px #1469a8;
}
.nfacepoploader-loader div:nth-child(1) {
  -webkit-animation-delay: -0.72s;
          animation-delay: -0.72s;
}
.nfacepoploader-loader div:nth-child(2) {
  -webkit-animation-delay: -0.64s;
          animation-delay: -0.64s;
}
.nfacepoploader-loader div:nth-child(3) {
  -webkit-animation-delay: -0.56s;
          animation-delay: -0.56s;
}
.nfacepoploader-loader div:nth-child(4) {
  -webkit-animation-delay: -0.48s;
          animation-delay: -0.48s;
}
.nfacepoploader-loader div:nth-child(5) {
  -webkit-animation-delay: -0.4s;
          animation-delay: -0.4s;
}
.nfacepoploader-loader div:nth-child(6) {
  -webkit-animation-delay: -0.32s;
          animation-delay: -0.32s;
}
.nfacepoploader-loader div:nth-child(7) {
  -webkit-animation-delay: -0.24s;
          animation-delay: -0.24s;
}
.nfacepoploader-loader div:nth-child(8) {
  -webkit-animation-delay: -0.16s;
          animation-delay: -0.16s;
}
.nfacepoploader-loader div:nth-child(9) {
  -webkit-animation-delay: -0.08s;
          animation-delay: -0.08s;
}
.nfacepoploader-loader div:nth-child(10) {
  -webkit-animation-delay: 0s;
          animation-delay: 0s;
}

@-webkit-keyframes nfacepoploadergo {
  100% {
    background: transparent;
    flex: 10;
    box-shadow: 0 0 0 transparent;
  }
}

@keyframes nfacepoploadergo {
  100% {
    background: transparent;
    flex: 10;
    box-shadow: 0 0 0 transparent;
  }
}
.inpopup-inline-progressbar-wrap{
  position: absolute;
  bottom:0;left:0;right:0;
  height: 3px;
  overflow: hidden;
}
.inpopup-inline-progressbar{
  width: 100%;
  overflow: hidden;
  position: relative;
  display: block;
  transform-style: preserve-3d;
  background: rgb(81 147 182 / 35%);
  transform-origin: center top;
  height: 4px;
  border-radius: 4px;
}
.inpopup-inline-progressbar >span{
  background-color: #5193b6;
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  transform: translate3d(-100%,0,0);
  transition-duration: 150ms;
  border-radius: 4px;
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
        <div class="inpopup-inline-progressbar-wrap">
          <div class="inpopup-inline-progressbar">
            <span id="inpopup-inline-progressbar"></span>
          </div>
        </div>
      </div>



      <div class="pop-page-content overflowhidden">
        <form id="pop-page-form">
          <input class="input jspersist" type="checkbox" checked style="display:none">

          <div class="pop-page-step step1 step-avail-open step-opened step-last-call" data-step='1' id="popn_step_1" data-url="step1">
            @include('Front.Poporder.Inc.nfacestep1')
          </div>

          <div class="pop-page-step step2" data-step='2' id="popn_step_2" data-url="step2">
            @include('Front.Poporder.Inc.nfacestep2')
          </div>
          <div class="pop-page-step step3" data-step='3' id="popn_step_3" data-url="step3">
            @include('Front.Poporder.Inc.nfacestep3')
          </div>
          <div class="pop-page-step step4" data-step='4' id="popn_step_4" data-url="step4">
            @include('Front.Poporder.Inc.nfacestep4',['ordergoods'=>$ordergoods])
          </div>

          <div class="pop-page-step step5 " data-step='5' id="popn_step_5" data-url="steplast">
            @include('Front.Poporder.Inc.nfacestep5')
          </div>

        </form>

      </div>

      <div class="pop-footer-navbar">
        <div class="pop-footer-navbar-inner">
          <span class="btn btn-sm btn-secondary" onClick="gotoNextStep()">다음</span>
        </div>
      </div>

      <div class="pop-page-content-pop-bg" onClick="pop_page_content_pop_close()"></div>
      <div class="pop-page-content-pop" id="inpopup-content">

      </div>
    </div>
  </div>

<!-- daum 주소 -->
<!-- 견적신청 -->
<script src='https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js'></script>
<script src='/community/assets/js/orderpop_daum.js'></script>

<script src='/community/assets/js/mfformstorage.js?v=20220113102100'></script>
<script src='/community/assets/js/mfuploader.js?v=20220113102100'></script>

<script>
var pop_step_history = 0
var pop_step_open = 1;
var pop_step_availMax = 1;
var mfform = new mfFormStorage('pop-page-form','pop-page-form-nface' )

function inPopLoaderCreate(){
  if( $("#nfacepoploader").length < 1){
    var loaderwrap = $('<div>', {
          id: 'nfacepoploader',
        }).prependTo( "#popnmodal" );
    $(loaderwrap).html("<div class='nfacepoploader-wrapper'><div class='nfacepoploader-loader'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>")
  }
}
function inPopLoaderOpen(){
  $("#nfacepoploader").addClass('loading');
}
function inPopLoaderClose(){
  $("#nfacepoploader").removeClass('loading');
}
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
  /* 선택된 옵션 리스트 처리 */
  $(".added_rows").each( function( i, v) { pop_options_select_redraw(v) })
  $(".stepper-input-wrap input").each( function( i, v) { pop_stepper_select_redraw(v) })
  $.get('/v2/tracelog/nfacepop/1')
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
  inPopLoaderCreate();
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
    closeDaumPostcode()
    $("#modal_popview").modal("hide")

    if( typeof pop != 'undefined' && pop.type == 'popn'){
      if( pop.command == 'open' ) closepopn()
      else if(  pop.command=='step') {
        var gotopop = ( pop.step> pop_step_availMax) ? pop_step_availMax : pop.step;
        drawstep($("#popn_step_" + gotopop))
      }
      pop_step_history--;
    }
}


function pop_page_content_pop_open(){
  $(".pop-page-content-pop-bg").addClass("opened")
  $(".pop-page-content-pop").addClass("opened")
}
function pop_page_content_pop_close(){
  $(".pop-page-content-pop").removeClass("opened")
  $(".pop-page-content-pop-bg").removeClass("opened")
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
      inPopLoaderOpen()
      getpost('/v2/order/nface/'+url, $("#pop-page-form").serialize(), nextlevel, inPopLoaderClose, orderNfaceFormCheckError )
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

    var depth = 5;
    var precentage = (100 - ( step * 100 / depth )) * -1;
    $("#inpopup-inline-progressbar").css('transform', 'translate3d('+ precentage +'%, 0px, 0px)')
    closeDaumPostcode()
  }

  function orderNfaceFormCheckError(res){
    ajaxErrorST(res )

    if( typeof res == 'object' && typeof res.responseJSON == 'object' && typeof res.responseJSON.data != 'undefined' && typeof res.responseJSON.data.step != 'undefined'){
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
