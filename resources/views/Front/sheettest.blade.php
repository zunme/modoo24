@extends('layouts.modoo')

@section('css')
<style>
    .cf:before, .cf:after {
        content: '';
        display: block;
        clear: both;
    }

    .visual_event {
        background: url(/v1/image/sub/visualevent.jpg) no-repeat center/cover;
        height: 254px;
        text-align: center;
    }

    .visual_event h1 {
        font-size: 40px;
        color: #000;
        padding-top: 95px;
        font-weight: bold;
    }

    .visual_event h4 {
        color: #747474;
    }



    #event {
        padding: 30px 0 30px;
        border-bottom:2px solid #dfdfdf;
        margin-bottom:50px;
    }

    #event h1 {
        font-size: 1.6em;
        padding-bottom: 10px;
        border-bottom: 2px solid #333333;
        text-align: center;
    }


    @media only screen and (max-width: 959px) {
        .visual_event {
            background: url(/v1/image/sub/visualevent_m.jpg) right top no-repeat;
            height: 100px;
            background-size: cover;
        }

        .visual_event h1 {
            font-size: 1.0em;
            padding-top: 30px;
            font-family: 'GmarketSansMedium';
        }

        .visual_event h4 {
            font-size: .8em;
        }

        #event h1 {
            font-size: 1.2em;
        }


    }
</style>
@endsection


@section('content')
<!--common_visual-->
<div class="visual_event">
    <h1>이벤트</h1>
    <h4>Event</h4>
</div>
<!--//common_visual-->
<div class="sub_menu">
    <ul class="center">
        <li class="h_icon gotohome"></li>
        <li class=" on "><a href="event">이벤트</a></li>
    </ul>
</div>

<!--//event_list-->
<div class="center">
    <div id="event">
        <h1><b>모두이사 이벤트</b>에 참여해 주세요</h1>
        <section id="event_view">
			<div class="view_title">
			    <ul>
			      <li></li>
			    </ul>
			</div>
		</section>
    </div>
</div>

<style>
:root {
  --topbar-view-height: 100%;
}
.bt_modal {
  width: 99vw;
  max-width: 99vw;
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
  background-color: #00beff;
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
  max-height: 80vh;
  overflow-y: auto;
  min-height: 50vh;
}
footer , .bt_modal_header, .bt_modal_body{
  -webkit-user-select:none; -moz-user-select:none; -ms-user-select:none; user-select:none;
}
</style>
<div class="bt_modal" id="bt_modal">
  <div class="bt_modal_header">
    <div id="topBar">
      <i class="fas fa-caret-up"></i>
      <i class="fas fa-caret-down"></i>
    </div>
    <h3>Modal Header</h3>
  </div>
  <div class="bt_modal_body">
    모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>
    모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>
    모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>모달<br>
    모달<br>모달<br>모달<br>
  </div>
</div>
@endsection


@section('script')
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
  START_Y = ($(".bt_modal").height()-$(".bt_modal_header").outerHeight());
  btmodalHeight = $(".bt_modal").height();
  resetElement()
  //css_variable_set( '--topbar-view-height', START_Y +"px");
});
window.onresize = function(event){
  START_Y = ($(".bt_modal").height()-$(".bt_modal_header").outerHeight());
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
      y:  ev.deltaY*10
  };
  clearTimeout(timer);
  if(  ev.deltaY >120){
    modal_moving = true;
    var value = 'translate(-50%, '+START_Y+'px)'
    btmodal.style.webkitTransform = value;
    btmodal.style.mozTransform = value;
    btmodal.style.transform = value;
    $(".bt_modal").removeClass("open")
    setTimeout(function () {
        modal_moving = false;
    }, 300);
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
      y: START_Y + ev.deltaY*10
  };
  clearTimeout(timer);
  if(  ev.deltaY < -120){
    modal_moving = true;
    var value = 'translate(-50%, 0)'
    btmodal.style.webkitTransform = value;
    btmodal.style.mozTransform = value;
    btmodal.style.transform = value;
    $(".bt_modal").addClass("open")
    setTimeout(function () {
        modal_moving = false;
    }, 300);
  }else{
    timer = setTimeout(function () {
        resetElement();
    }, 200);
    requestElementUpdate();
  }
}

function onDoubleTap(ev) {
  if( $(".bt_modal").hasClass("open")){
    var value = 'translate(-50%, '+START_Y+'px)'
    btmodal.style.webkitTransform = value;
    btmodal.style.mozTransform = value;
    btmodal.style.transform = value;
    $(".bt_modal").removeClass("open")
  }else {
    var value = 'translate(-50%, 0)'
    btmodal.style.webkitTransform = value;
    btmodal.style.mozTransform = value;
    btmodal.style.transform = value;
    $(".bt_modal").addClass("open")
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
    $(".bt_modal").removeClass("open")
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
  $(".bt_modal").addClass("open")
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
</script>

@endsection
