@extends('layouts.modoo')

@section('css')
<style>
.visual3{
  position: relative;
  background-image: url(https://images.unsplash.com/photo-1455390582262-044cdead277a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1073&q=80);
  background-size: cover;
  background-position-x: center;
  background-position-y: center;
  color:white;
  overflow: hidden;
}
.visual3:after {
    box-sizing: border-box;
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    content: "";
    background: rgba(0,190,255,.42);
    background: linear-gradient(
45deg,rgba(0,190,255,.42),rgba(44,140,208,.15));
    background: -webkit-linear-gradient(
135deg,rgb(0 190 255 / 42%),rgb(44 140 208 / 15%));
}
.visual3 >h1{
  position: absolute;
  z-index: 2;
  width: 100%;
  color: #dbf1fb;
}
.visual3 h4{
  color: wheat;
}
.st-sub-menu-wrap {
    width: 100%;
    margin: 0 auto;
    position: absolute;
    bottom: -1px;
    z-index: 2;
    background-color: rgb(85 172 238 / 36%);
    padding: 6px 0;
    font-size: 16px;
}
.st-sub-menu-inner {
    width: 1200px;
    margin: 0 auto;
}
.st-sub-menu{
  width: 550px;
  margin-left: 330px;
  display: flex;
  padding: 0 24px 0 12px;
}
.st-sub-menu-item{margin-right: 24px;color: white;font-size: 15px;    line-height: 23px;}
.st-sub-menu-item  .fas{
  color: white;
}

.st-sub-menu-item > a.active{
  color: wheat !important;
  background-color: rgb(255 255 255 / 30%);
  padding: 6px 8px;
  border-radius: 5px;
}
@media only screen and (max-width: 630px){
  .st-sub-menu {
    padding-right:10px;
  }
  .st-sub-menu > .st-sub-menu-item:last-child{
    margin-right: 0;
  }
}
@media only screen and (max-width: 959px){
  .visual3 h1{
    padding-top: 30px;
  }
  .st-sub-menu-wrap{
    padding: 3px 0;
    width: 100%;
  }
  .st-sub-menu-inner {
    width: 100%;
  }
  .st-sub-menu {
    margin-left: 0;
    width: 100%;
    justify-content:flex-end;
  }
  .st-sub-menu-item{
    font-size: 13px;
  }
  .st-sub-menu-item > a.active {
    background-color: rgb(255 255 255);
    padding: 7px 8px;
    border-top-right-radius: 5px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    color: #666 !important;
  }
}

.myorder_Box {
    border-radius: 6px;
}
.myorder_Box .btn_form {
  height: inherit;
  bottom: -1px;
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px;
}
.myorder_Box .btn_form.btn-blue{ background-color:#00beff}




li.applylist-item {
    position: relative;
    box-sizing: border-box;
    padding: 15px 0;
}
.applylist-item .applylist-item-inner {
    color: inherit;
    display: flex;
    justify-content: space-between;
    box-sizing: border-box;
    align-items: center;
    min-height: 44px;
    padding-left: 16px;
    padding-right: 16px;
    transition-duration: .3s;
    transition-property: background-color, color;
    position: relative;
    overflow: hidden;
    z-index: 0;
    user-select: none;
}
.applylist-item .applylist-item-media {
    display: flex;
    flex-shrink: 0;
    flex-wrap: nowrap;
    align-self: center;
    box-sizing: border-box;
}
.item-media-imgbox{
  width: 70px;
  height: 70px;
  background: url( '/v1/image/sub/know_logo.png' ) no-repeat center center ;background-size: cover;
}
.applylist-item-body{
  flex-grow: 1;
}
</style>

<!-- toolbar -->
<style>
:root {
  --topbar-view-height: 100%;
}
body.fixed{
  overflow: hidden;
}
.bt_modal-back{
  position: fixed;
  top: 0;bottom: 0;left: 0;right: 0;
  background-color: black;
  opacity: .3;
  z-index: 10;
  display: none;
}
.bt_modal-back.open{
  display:block;
}
.bt_modal {
  width: 99vw;
  max-width: 500px;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;

  background-color: rgba(255, 255, 255, 83%);
  position: fixed;
  bottom: 0px;
  left: 50%;

  transform: translate(-50%, var(--topbar-view-height) );
  backdrop-filter: blur(6px) saturate(180%);
  box-shadow: 0 1px 8px #0000001a;
  z-index: 999999;
  -webkit-transition: transform 500ms ease-in-out;
  -moz-transition:transform 500ms ease-in-out;
  -ms-transition:transform 500ms ease-in-out;
}
.bt_modal h3 {
  text-align: center;
  font-size: 20px;
  color: white;
}
.bt_modal.open {
  box-shadow: 0 1px 20px #0000001a;
  transform: translate(-50%, 0);
  -webkit-transition: transform 500ms ease-in-out;
  -moz-transition:transform 500ms ease-in-out;
  -ms-transition:transform 500ms ease-in-out;
}
.bt_modal_header{
  padding-top: 6px;
  background-color: #42768e;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
}
.bt_modal div#topBar {
  width: 50px;
  height: 7px;
  background: #aaa;
  border-radius: 14px;
  margin: 0 auto 6px;
  cursor: pointer;
  position: relative;
}
.bt_modal  div#topBar > i.fa-caret-down{display:none}
.bt_modal.open  div#topBar > i.fa-caret-up{display:none}
.bt_modal.open  div#topBar > i.fa-caret-down{display:inline-block;}

.bt_modal  div#topBar > i {
  margin: 0 !important;
  padding: 0 !important;
  line-height: 5px;
  position: absolute;
  top: 1px;
  left: 50%;
  transform: translate(-50%, 0);
  color:black;
}
.bt_modal > .bt_modal_body{
  max-height: 50vh;
  overflow-y: auto;
  min-height: 30vh;
}
footer , .bt_modal_header, .bt_modal_body{
  -webkit-user-select:none; -moz-user-select:none; -ms-user-select:none; user-select:none;
}
</style>

<!-- 팝업 내부 css -->
<style>
.bt_modal_cont_wrap ul li {
  display:flex;
  padding: 5px;
  position: relative;
  flex-direction: row-reverse;
}
.bt_modal_cont_wrap li:after {
    content: '';
    position: absolute;
    background-color: rgba(255, 255, 255, 83%);
    display: block;
    z-index: 15;
    top: auto;
    right: auto;
    bottom: 0;
    left: 0;
    height: 1px;
    width: 100%;
    transform-origin: 50% 100%;
    transform: scaleY(1);
}
.bt_modal_cont_btn_wrap, .bt_modal_cont_title_wrap{
  padding:5px;
}
.bt_modal_cont_title{
  margin-top:3px;
}
.bt_modal_cont_title_wrap{
  flex-grow: 1;
}
.btn.btn-selectbtn {
    color: #fff;
    background-color: #55acee;
    border-color: #55acee;
    box-shadow: 0 2px 2px 0 rgba(85,172,238,.14),0 3px 1px -2px rgba(85,172,238,.2),0 1px 5px 0 rgba(85,172,238,.12);
    margin:0;
}
.none-company{
  padding: 30px 0;
text-align: center;
}
</style>
@endsection


@section('content')
<div class="visual3">
    <h1>이사후기</h1>
    <h4>Review</h4>
    <div class="st-sub-menu-wrap">
      <div class="st-sub-menu-inner">
        <div class="st-sub-menu">
          <div class="st-sub-menu-item">
              <a class="gotohome"><i class="fas fa-home"></i></a>
          </div>
          <div class="st-sub-menu-item">
              <a href="/v1/move/review">이사후기</a>
          </div>
          <div class="st-sub-menu-item">
              <a href="/v2/review/my" class="active">이사업체 평가하기</a>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="content-wrap">
  <div class="content-inner">
    <div class="applylist-wrap">
    <div class="applylist-inner">
      <div class="applylist-header">
        <span class="applylist-header-span1">이사업체 평가 작성 가능한 이사</span>
        <span class="applylist-header-span2">(최근 6개월 이사 내역)</span>
      </div>
      <div class="applylist-body">
        <div class="applylist-body-inner">
          <ul class="applylist-items">

            @forelse( $data as $row)
            <li class="applylist-item">
              <div class="applylist-item-inner">
                <div class="applylist-item-media">
                  <div class="item-media-imgbox"></div>
                </div>
                <div class="applylist-item-body">
                  <div class="applylist-item-body-line">
                    <span class="applylist-item-body-title">이사일 :</span>
                    <span class="applylist-item-body-text">{{$row->mdate}}</span>
                  </div>
                  <div class="applylist-item-body-line">
                    <span class="applylist-item-body-title">출발지 :</span>
                    <span class="applylist-item-body-text">{{$row->startaddr}}</span>
                  </div>
                  <div class="applylist-item-body-line">
                    <span class="applylist-item-body-title">도착지 :</span>
                    <span class="applylist-item-body-text">{{$row->endaddr}}</span>
                  </div>
                </div>
                <div class="applylist-item-btn-wrap">
                  <div>
                    <span class="btn btn-outerline-primary" onClick="review({{$row->uid}},'{{$row->kindtype}}','{{$row->staff_cnt}}')">이사업체평가</span>
                  </div>
                  <div>
                    <span>평가 가능시간 : {{\Carbon\Carbon::createFromFormat('Y-m-d', $row->mdate, 'Asia/Seoul')->addMonth(6)->format('Y-m-d')}}</span>
                  </div>
                </div>
              </div>
            </li>
            @empty
            <li class="none-data">
              <div>평가 가능한 이사 업체가 없습니다.</div>
              <div>이사업체 평가는 이사일부터 6개월동안 가능합니다.</div>
            </li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>





<div class="bt_modal-back" onClick="resetElement()">
</div>
<div class="bt_modal" id="bt_modal">
  <div class="bt_modal_header">
    <div id="topBar">
      <i class="fas fa-caret-up"></i>
      <i class="fas fa-caret-down"></i>
    </div>
    <h3>이사업체 선택</h3>
  </div>
  <div class="bt_modal_body" id="bt_modal_body">
    <div class="bt_modal_cont_wrap">
      <ul>
      </ul>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
var template
function review(id, kindtype, cnt){
  if( cnt < 1 ){
    swal.fire("업체평가", "매칭된(계약완료) 업체가 없습니다.", "error");
    return;
  }
  if( kindtype == 'auction_order_nface') {
    location.href='/v2/review/write/order_nface/'+id+'/'+id;
    return;
  }
  let url = '/v2/review/my/companylist';
  $.ajax({
    url : url,
    method:'get',
    dataType:'JSON',
    data : {uid: id} ,
    success:function(res){
      drawCompany(res.data)
    },
    error: function ( err ){
     ajaxErrorST(err)
    },
    complete:function() {
      ;
    }
  });
}
function sel( id, s_uid){
  location.href='/v2/review/write/order/'+id+'/'+s_uid;
}
function drawCompany(data){
    if(!template) template = Handlebars.compile( btmodaltemplate );
    $("#bt_modal_body" ).html ( template(data) );
    resetElementUp();
  console.log (data);
}
</script>
<!-- toolbar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

var css_variable;
var btmodal_el = document.getElementById("topBar");
var btmodal = document.getElementById("bt_modal");
var btmodalHeight;

var START_X = '50%';
var START_Y = 0;
var ticking = false;
var transform;
var timer;
var modal_moving = false;
$("document").ready( function() {
  css_variable = document.querySelector(':root');
  //START_Y = ($(".bt_modal").height()-$(".bt_modal_header").outerHeight());
  START_Y = ($(".bt_modal").height() );
  btmodalHeight = $(".bt_modal").height();
  resetElement()
  //css_variable_set( '--topbar-view-height', START_Y +"px");
});
window.onresize = function(event){
  //START_Y = ($(".bt_modal").height()-$(".bt_modal_header").outerHeight());
  START_Y = ($(".bt_modal").height() );
  if( $(".bt_modal").hasClass("open") ) resetElementUp()
  else resetElement()
}
function css_variable_set(variable , val ) {
  css_variable.style.setProperty(variable, val);
}

var reqAnimationFrame = (function () {
	    return window[Hammer.prefixed(window, 'requestAnimationFrame')] || function (callback) {
	        window.setTimeout(callback, 1000 / 60);
	    };
	})();



var mc = new Hammer.Manager(btmodal_el); //Hammer 이벤트 관리자 생성 및 이벤트 등록
mc.add( new Hammer.Pan({ direction: Hammer.DIRECTION_VERTICAL , threshold: 0 }) );
mc.add(new Hammer.Swipe()).recognizeWith(mc.get('pan'));
mc.add(new Hammer.Tap({ event: 'doubletap', taps: 2 }));
mc.add(new Hammer.Tap());
//mc.on("doubletap", onDoubleTap);
mc.on("tap", onDoubleTap);
mc.on("panstart panmove", onPan);

function onPan(ev) {
  if(ev.additionalEvent == "panup") onPanDown(ev)
  else if(ev.additionalEvent == "pandown") onPanUp(ev)
}
function onPanUp(ev){
  if( !$(".bt_modal").hasClass("open")) return;
  btmodal_el.className = '';
  transform.translate = {
      x: '50%',
      y:  ev.deltaY*5
  };
  clearTimeout(timer);
  if(  ev.deltaY >60){
    resetElement()
  }else{
    timer = setTimeout(function () {
        resetElementUp();
    }, 200);
    requestElementUpdate();
  }
}
function onPanDown(ev){
  if( $(".bt_modal").hasClass("open")) return;
  btmodal_el.className = '';
  transform.translate = {
      x: '50%',
      y: START_Y + ev.deltaY*5
  };
  clearTimeout(timer);
  if(  ev.deltaY < -80){
    resetElementUp()
  }else{
    timer = setTimeout(function () {
        resetElement();
    }, 200);
    requestElementUpdate();
  }
}

function onDoubleTap(ev) {
  if( $(".bt_modal").hasClass("open")){
    resetElement()
  }else {
    resetElementUp()
  }
}

function updateElementTransform() {
    var value = [
        'translate(-50%, ' + transform.translate.y + 'px)'
    ];
    if( !modal_moving){
      value = value.join(" ");
      btmodal.style.webkitTransform = value;
      btmodal.style.mozTransform = value;
      btmodal.style.transform = value;
    }
      ticking = false;
}
function resetElement() {
  $("body").removeClass("fixed")
  $(".bt_modal").removeClass("open")
  $(".bt_modal-back").removeClass("open")
  transform = {
      translate: { x: START_X, y: START_Y },
      scale: 1,
      angle: 0,
      rx: 0,
      ry: 0,
      rz: 0
  };
  requestElementUpdate();
}
function resetElementUp(){
  $("body").addClass("fixed")
  $(".bt_modal").addClass("open")
  $(".bt_modal-back").addClass("open")
  transform = {
      translate: { x: START_X, y: 0 },
      scale: 1,
      angle: 0,
      rx: 0,
      ry: 0,
      rz: 0
  };
  requestElementUpdate();

}
function requestElementUpdate() {
	    if(!ticking && !modal_moving) {
	        reqAnimationFrame(updateElementTransform);
	        ticking = true;
	    }
}
@verbatim
let btmodaltemplate = `
<div class="bt_modal_cont_wrap">
  <ul>
    {{#each companyData}}
    <li>
      <div class="bt_modal_cont_btn_wrap">
        <span class="btn btn-selectbtn btn-sm" onClick="sel({{../uid}}, {{s_uid}})">선택</span>
      </div>
      <div class="bt_modal_cont_title_wrap">
        <div class="bt_modal_cont_title">{{s_company}}</div>
      </div>
    </li>
    {{else}}
    <li>
      <div class="bt_modal_cont_title_wrap none-company">
         선택 가능한 업체가 없습니다.
      </div>
    </li>
    {{/each}}
  </ul>
</div>
`
@endverbatim
</script>
@endsection
