@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/v1/css/community.css" />
<style>
:root {
  --device-pixel-ratio: 1;
  --list-border-color: rgb(0 0 0 / 50%);
  --list-item-border-color:rgb(0 0 0 / 20%);
}
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 2dppx) {
  :root {
    --device-pixel-ratio: 2;
  }
}
@media (-webkit-min-device-pixel-ratio: 3), (min-resolution: 3dppx) {
  :root {
    --device-pixel-ratio: 3;
  }
}
.loaderWrap {
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background-color: #66666673;
    display: flex;
    justify-content: center;
		margin-top: 0 !important;
		margin-bottom: 0 !important;
}
.loaderWrap > .loaderWrapInner{
	    margin: 0 !important;
}
.loadersvg{
	width: 99%;height: 99%;margin: auto;
  max-width: 100px;
}
#body_loader_bg{
  position: fixed !important;
}
.iziToast-wrapper-bottomCenter{
    bottom: 90px;
}

#board h1{
  border: none;
}
.post_wrap{
  position: relative;
  background: white;
}
.post_wrap:before {
    content: '';
    position: absolute;
    background-color: var(--list-border-color);
    display: block;
    z-index: 15;
    top: 0;
    right: auto;
    bottom: auto;
    left: 0;
    height: 1px;
    width: 100%;
    transform-origin: 50% 0%;
    transform: scaleY(calc(1 / var(--device-pixel-ratio)));
}
.post_desc_wrap{
  position:relative;
}
.post_desc_wrap:after{
  content: '';
  position: absolute;
  background-color: var(--list-border-color);
  display: block;
  z-index: 15;
  top: auto;
  right: auto;
  bottom: 0;
  left: 0;
  height: 1px;
  width: 100%;
  transform-origin: 50% 100%;
  transform: scaleY(calc(1 / var(--pixel-ratio)));
}
.post_header_wrap{
  margin-top: 20px;
  margin-bottom: 20px;
  position: relative;
}
.post_title_wrap,.post_body_wrap,.post_desc_wrap{
  position: relative;
  margin: 15px;
  padding-top:15px;
  padding-bottom:15px;
  font-size: .9em;
  color: #666;
}
.post_title_wrap:after {
  content: '';
  position: absolute;
  background-color: var(--list-item-border-color);
  display: block;
  z-index: 15;
  top: auto;
  right: auto;
  bottom: 0;
  left: 0;
  height: 1px;
  width: 100%;
  transform-origin: 50% 100%;
  transform: scaleY(calc(1 / var(--device-pixel-ratio)));
}
.post_title_wrap,.post_desc_inner{
  display: flex;
  justify-content: space-between;
}
.post_title_row{
  font-size: 16px;
  color: #444;
  word-break: break-all;
}
.post_title_subrow{
  font-size: 14px;
  color: #666;
}
.tag:before{
  content:'#';
  display: inline-block;
  margin-right: 5px;
}
.post_sns_wrap{
  min-width: 126px;
  max-width: 126px;
  margin-left: 16px;
  display: flex;
  justify-content: space-between;
}
.snsbtn i{
  font-size: 41px;
}
.snsbtn img{
  width : 41px;
  display: inline-block;
  line-height: 1;
  vertical-align: top;
}

.comments_wrap .commentul li{
  margin-bottom:10px;
  margin-left:10px;
  margin-right:10px;
  padding-bottom: 10px;
  padding-top:5px;
  position: relative;font-size: .9em;color: #999;
}
.comments_wrap .commentul li:after {
    content: '';
    position: absolute;
    background-color: var(--list-item-border-color);
    display: block;
    z-index: 15;
    top: auto;
    right: auto;
    bottom: 0;
    left: 0;
    height: 1px;
    width: 100%;
    transform-origin: 50% 100%;
    transform: scaleY(calc(1 / var(--device-pixel-ratio)));
}
.comment_body{
  display: flex;
}
.comment_left{
  flex-grow: 1;
}
.comment-nick{
  font-size: 14px;
font-weight: 600; color: #666
}
.comment-row{
  word-break: break-all;
  font-size: 14px;
}
.comment_right{
    flex-direction: column;
    flex-shrink: 0;
}
.comment_right .btn-sm{
  margin-bottom: 0;
}
.comment_footer{
  display: flex;
    justify-content: space-between;
    margin-top: 10px;
}
.commment_footer_left .btn-sm{
    margin-bottom: 5px;
}
.commment_footer_right{
  font-size: 0.6875rem;
  color:#666;
  line-height: 1.5;
  margin-top: 10px;
}
.ct{
  margin-bottom: 10px;
}
.ct > .pagination {
  margin-bottom: 0;
}

.comment_write_wrap{
  position: relative; margin-top: 15px;
}

.form-control {
    background-color: transparent;
    border: 1px solid #e3e3e3;
    border-radius: 30px;
    color: #2c2c2c;
    height: auto;
    line-height: normal;
    font-size: .8571em;
    transition: color .3s ease-in-out,border-color .3s ease-in-out,background-color .3s ease-in-out;
    box-shadow: none;
    padding: 10px 18px;
    border-radius: 10px;
}
.form-control, .is-focused .form-control{
    background-image:none;
}
.form-control:focus {
    border: 1px solid #0994ef;
    box-shadow: none;
    outline: 0!important;
    color: #2c2c2c;
}
.comment_write_nickname{
  margin-left: 16px;
  color:#666; font-size: .9em
}
.comment_write_btn_wrap{
  display: flex;
  justify-content: end;
}
.comment_cnt_wrap{
  display: flex;
  justify-content: end;
  color: #666;
  font-size: 14px;
  margin-bottom: 10px;
}
.comment_footer_inner{
  flex-grow: 1;
    display: flex;
    justify-content: space-between;
}
.reply_depth{
  flex-shrink: 0;
  min-width: 18px;
}

.btnborder{ border: 1px solid #ddd; border-radius: 20px;box-shadow: none;}

.comment_body .reply_depth_icon:last-child{background-color: #eee;}
@media screen and (max-width: 820px) {

  .post_title_wrap{
    flex-direction: column;
  }
  .post_title_subrow{
    text-align: right;
  }
  .post_sns_wrap{
    max-width: 100%;
    width: 100%;
    justify-content: end;
    padding-right: 20px;
  }
  .post_sns_wrap .snsbtn {
    margin-left: 10px;
  }
  .snsbtn i {
    font-size: 35px;
  }
  .snsbtn img{
    width : 35px;
  }
  .post_desc_inner .btn.btn-lg{
    padding: 10px 13px;
    font-size: .75rem;
    line-height: 1.428571;
  }
}


.overhide{
  overflow: hidden;
}
.sheet-backdrop {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.4);
    z-index: 12000;
    visibility: hidden;
    opacity: 0;
    transition-duration: .4s;
}
.sheet-backdrop.backdrop-in {
    visibility: visible;
    opacity: 1;
}
.sheet-modal {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 260px;
    display: none;
    box-sizing: border-box;
    transition-property: transform;
    transform: translate3d(0,100%,0);
    background: white;
    z-index: 12500;
    will-change: transform,opacity;
    border-radius: 15px 15px 0 0;
    overflow: hidden;
}
.sheet-modal.modal-in {
    transition-duration: 300ms;
    transform: translate3d(0,0,0);
    height: auto;
    display: block;
}
.sheet-modal .sheet-modal-inner {
    height: 100%;
    position: relative;
    overflow: hidden;
}
.swipe-handler {
    height: 16px;
    position: absolute;
    left: 0;
    width: 100%;
    top: 0;
    background: 0 0;
    cursor: pointer;
    z-index: 10;
}
.swipe-handler-btn {
  content: '';
  width: 36px;
  height: 8px;
  position: absolute;
  left: 50%;
  top: 50%;
  margin-left: -18px;
  margin-top: -3px;
  border-radius: 3px;
  background: #666;
}
.swipe-handler-btn:before{
  content: '\f0d7';
  font-family: "Font Awesome 5 Free";
  color: white;
  -webkit-font-smoothing: antialiased;
  display: inline-block;
  font-style: normal;
  font-variant: normal;
  text-rendering: auto;
  line-height: 7px;
  font-weight: 900;
  margin-top: -1px;
  position: absolute;
  top: 1px;
  left: 13px;
}
.sheet-modal .sheet-modal-inner .page-content {
    overflow: auto;
    -webkit-overflow-scrolling: touch;
    box-sizing: border-box;
    height: 100%;
    position: relative;
    z-index: 1;
    padding-top: 10px;
    padding-bottom: 10px;

}
.block-line-title{
  position: relative;
  overflow: hidden;
  margin: 0;
  white-space: nowrap;
  text-overflow: ellipsis;
  text-transform: none;
  color: #333;
  font-size: 20px;
  font-weight: var(--f7-block-title-font-weight);
  line-height: 1.6;
  margin-top: 35px;
  margin-bottom: 25px;
  margin-left: 16px;
  margin-right: 16px;
}
.block-line{
  box-sizing: border-box;
  position: relative;
  z-index: 1;
  margin: 25px 0;
  padding-top: 0;
  padding-bottom: 0;
  padding-left: 16px;
  padding-right: 16px;
}
.block-line-title+.block-line {
    margin-top: 0px;
}
    .btncolor_pt{background: #1e9af9!important;}

@media screen and (min-width: 820px) {
  .sheet_modal{
    transform: translate3d(-50%,100%,0);
  }
  .sheet-modal.modal-in{
    width: 600px;
    bottom: 50%;
    left: 50%;
    transform: translate3d(-50%,+30%,0);
    border-radius: 15px;
  }
}
.usertag:before{
  content:'@';
  display: inline-block;
  margin-right: 2px;
}
.usertag{
  margin-right: 5px;
}
.toUser{
  display: none;
}
/* 공감 */
.myfavorite{
  color:red;
}
.myunfavorite{
  color:silver;
}
.ql-editor{
  font-size: 13px;
}
</style>
<!-- Theme included stylesheets -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />

<link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css" />
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<!-- Core build with no theme, formatting, non-essential modules -->
<link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">

@endsection
@section('body_bottom','')

@section('content')
<!--common_visual-->
<div class="visual6">
     <h1>{{$config->title}}</h1>
</div><!--//common_visual-->


<div class="sub_menu_N">
    <ul>
        <li class="h_icon" onclick="window.open('/v2/')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"/><path d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19z" fill="rgba(255,255,255,1)"/></svg>
            </li>
        <li class="@if($code=='tip') on @endif"><a href="/community/posts/tip">모두꿀TIP</a></li>
        <li class="@if($code=='fun') on @endif"><a href="/community/posts/fun">모두FUN</a></li>
        <!--<li class="@if($code=='hometown') on @endif"><a href="/community/posts/hometown">우리동네자랑하기</a></li>-->
    </ul>
</div>


<div class="center" >
  <div id="board">
    <div class="post_header_wrap">
      <h1 class="post_header_title">{{$config->title}} 게시물 보기</h1>
    </div>

<!-- 주소 보기 알맞은 위치에 넣어주세요-->
@if ($config->address_use && $post->address )
<div>
  {{$post->address->sido}} {{$post->address->gu}} {{$post->address->dong}}
</div>
@endif
<!-- / 주소 보기 -->


    <div class="post_wrap">
      <div class="post_title_wrap">
        <div class="post_title_inner">
          <div class="post_title_row">{{$post->title}}</div>
          <div class="post_title_subrow">
            <span class="post_writer">{{$post->nickname}}</span>
            <span class="post_date">{{$post->created_at}}</span>
          </div>
        </div>
        <div class="post_sns_wrap">
          <span href="#pablo" class="snsbtn twitter-btn" onClick="snsShare( 'twitter', snsdata);">
            <i class="fab fa-twitter-square" style="color:#1da1f2"></i>
          </span>
          <span href="#pablo" class="snsbtn facebook-btn" onClick="snsShare( 'facebook', snsdata);" style="color:#3a5898">
            <i class="fab fa-facebook-square"></i>
          </span>
          <span href="#pablo" class="snsbtn kako-btn" onClick="snsShare( 'kakao', snsdata);">
            <img src='/community/images/kakao.logo.png'>
          </span>
        </div>
      </div>

      <div class="post_body_wrap">
        <div class="post_body ql-editor">
          @if ( $config->html_use =='Y')
            {!! $post->body !!}
          @else
            {!! nl2br(e($post->body)) !!}
          @endif
        </div>
      </div>

      <div class="post_desc_wrap">
        <div class="post_desc_inner">
          <div class="post_desc_left">
            <span class="btn btn-white btn-sm btn-like btnborder" onClick="addFavCnt(this)">
              <i class="fas fa-heart @if($post_favorite) myfavorite @else myunfavorite @endif"></i> 공감
               <span id="favcnt">{{($post->fav_cnt <1 ? 0 : $post->fav_cnt)}}</span></span>
            <span class="btn btn-white btn-sm btnborder" onClick="toScroll('comments_wrap',200)">댓글 <span id="post_comment_cnt">{{$post->comment_cnt}}</span></span>
          </div>
          @if ( $is_writer )
          <div class="post_desc_right">
            <span class="btn btn-sm btnborder">수정</span>
            <span class="btn btn-sm btnborder">삭제</span>
          </div>
          @endif
        </div>
      </div>


      <div class="comments_wrap" id="comments_wrap">

      </div>
          <a type="button" class="btn btn-white btn-sm btnborder" href="/community/posts/{{$code}}">목록</a>
    </div>



    <div class="comment_write_wrap" id="comment_write_wrap">
      <div class="comment_write_nickname">
        @guest
         로그인 후 댓글을 작성하실 수 있습니다.
        @endguest
        @auth
         @if(Auth::user()->level < 1024 ) {{Auth::user()->nickname}} @else 관리자 @endif;
        @endauth
      </div>
      <form id="comment_form">
        <div class="row comment_write_box">
          <input type="hidden" name="post_id" value="{{$post->id}}" >
          <div class="col-12">
            <textarea id="comment_textarea" name= "comment" class="form-control form-control-sm mb-3" rows="3" placeholder="게시물에 댓글 작성을 부탁드립니다. 모두이사 커뮤니티와 연관 없는 댓글은 삭제 될 수 있습니다"></textarea>
          </div>

        </div>
      </form>
      <div class="comment_cnt_wrap"> <span id="comment_cnt">0</span>/3000 </div>
      <div class="comment_write_btn_wrap">
        <span class="btn btn-sm btncolor_pt" onClick="write_comment(this)">댓글등록</span>
      </div>
    </div>

  </div>
</div>

<div id="body_loader_bg" class="loaderWrap loading hide"></div>

<div class="sheet-backdrop"></div>
<div class="sheet-modal demo-sheet-swipe-to-close" id="sheet_modal">
  <div class="sheet-modal-inner">
    <div class="swipe-handler" onClick="close_swipe(this)">
        <div class="swipe-handler-btn"></div>
    </div>
    <div class="page-content" id="sheet_modal_content">

    </div>
  </div>
</div>

@endsection

@section('script')
<script src="/community/assets/js/kakao.min.js"></script>
<script src="/community/assets/js/sns.js"></script>
<script>
@guest
let logined = false;
@endguest
@auth
let logined = true;
let nickname = @if(Auth::user()->level < 1024 ) "{{Auth::user()->nickname}}" @else"관리자"@endif;
@endauth

let snsdata = {
        'title' : '{{$post->title}}',
        'image' : '{{ \URL::to( str_replace('/community/storage/','/storage/',$post->repImg) ) }}',
        'url' : '{{\URL::to( '/posts/'.$code.'/view/'.$post->id )}}',
        'description' : ``,
}
let snsDefaultImage = '{{ \URL::to( '/snsdefault.jpg' ) }}'

let currnetCommentPage;
$("document").ready( function() {

    Kakao.init('139b5101d3bf7ebdf5daa822e2b298fc');
    Kakao.isInitialized();
    getComment('/community/posts/{{$code}}/comment/view/'+{{$post->id}},1)
    $('#comment_textarea').keyup(function (e){
      var content = $(this).val();
      $('#comment_cnt').text(content.length);    //글자수 실시간 카운팅

      if (content.length > 3000){
          $(this).val(content.substring(0, 3000));
          $('#comment_cnt').text('3000');
      }
    });
    loaderAttach(".btn-like")
    loaderAttach(".comment_write_wrap")

})

function changepage(link){
  let url = $(link).attr('href')
  if( url != 'undefined') getComment(url);
}
function getComment(url){
  $.ajax({
    url: url,
    method:"get",
    dataType:'html',
    success:function(res)
    {
      $("#comments_wrap").html(res)
    },
    error: function ( err ){

    },
  });
}

function write_comment(btn){
  if (!logined){
    toast('로그인 후 사용해주세요','bottomCenter')
    return;
  }
  let wrap = $(btn).closest('.comment_write_wrap');
  let notloading = $(wrap).children(".notloading")
  let loading = $(wrap).children(".loading")
  if ( !$(loading).hasClass("hide") ) return;
  $(loading).removeClass("hide");

  data = $("#comment_form").serialize();
  getpost( '/community/posts/commentv2', data, commentCallback,callbackWriteComplete);
}
function commentCallback (res){
  toast('댓글이 등록되었습니다','bottomCenter')
  getComment(res.data.url);
  $("#comment_textarea").val('')
  $("#comment_cnt").text('0')

}
function callbackWriteComplete() {
  $('.comment_write_wrap').children(".loading").addClass("hide");
}
@verbatim
let recommenttemplate =`
<div class="block-line-title">
  {{#if id}}
  댓글 수정하기
  {{else}}
  {{to}}님의 댓글에 답변달기
  {{/if}}
</div>
<div class="block-line">
  <div class="comment_write_wrap" >
    <div class="comment_write_nickname">{{nickname}}</div>
    <form >
      <div class="row comment_write_box">
        {{#if id}}
        <input type="hidden" name="comment_id" value="{{id}}" >
        {{else}}
        <input type="hidden" name="parent_id" value="{{parent_id}}" >
        {{/if}}
        <div class="col-12">
          <textarea name= "comment" class="form-control form-control-sm mb-3" rows="3" placeholder="댓글에 댓글 작성을 부탁드립니다. 모두이사 커뮤니티와 연관 없는 댓글은 삭제 될 수 있습니다">{{#if id}}{{comment}}{{/if}}</textarea>
        </div>

      </div>
      <div class="comment_write_btn_wrap">
        {{#if id}}
          <span class="btn btn-white" onClick="update_recomment(this)">수정</span>
        {{else}}
          <span class="btn btn-white" onClick="write_recomment(this)">등록</span>
        {{/if}}
      </div>
    </form>
  </div>
</div>
`;
@endverbatim
//대댓글
let recommentCompiled
function sheet_backdrop_clicked(){
  history.back()
}
function recomment(btn){

  if (!logined){
    toast('로그인 후 사용해주세요','center')
    return;
  }
  if(typeof recommentCompiled =='undefined') recommentCompiled = Handlebars.compile( recommenttemplate );
  let data={parent_id : $(btn).data('id'), nickname : nickname,to : $(btn).data('nick') };
  $("#sheet_modal_content").html( recommentCompiled(data) )
  open_sheet_modalV1("#sheet_modal")
  return;
  Swal.fire({
    title: '댓글을 적어주세요',
    input: 'textarea'
  }).then(function(result) {
    if (result.value) {
      Swal.fire(result.value)
    }
  })
}
function comment_update(btn){
  if (!logined){
    toast('로그인 후 사용해주세요','center')
    return;
  }
  let comment_id = $(btn).data('commentid')
  if(typeof recommentCompiled =='undefined') recommentCompiled = Handlebars.compile( recommenttemplate );

  $.ajax({
    url : '/community/posts/commentv2/info?comment_id='+ comment_id,
    method:'get',
    dataType:'JSON',
    success:function(res){
      if( res.data.use_comment_confirm='Y' && res.data.is_confirmed !='R'){
        toast('더 이상 수정 하실수 없습니다.','center')
        return;
      }else if ( res.data.is_confirmed =='R' || res.data.is_confirmed =='Y' ){
        $("#sheet_modal_content").html( recommentCompiled(res.data) )
        open_sheet_modalV1("#sheet_modal")
      }else toast('수정 하실수 없습니다.','center')
    },
    error: function ( err ){
     ajaxErrorST(err)
    },
    complete:function() {
    }
  });
}

function write_recomment(btn){
  let url = "/community/posts/recomment"
  getpost( url, $(btn).closest('form').serialize(),recommentSuccess );
  history.back();

}
function update_recomment(btn){
  let url = "/community/posts/commentupdate"
  getpost( url, $(btn).closest('form').serialize(),recommentSuccess );
  history.back();
}
function recommentSuccess(res){
  let url="/community/posts/{{$code}}/comment/view/{{$post->id}}?page=" + currnetCommentPage;
  getComment(url)
}
function addFavCnt (btn){
  //let url = "/community/posts/comment/addfavcnt"
  let url = "/community/posts/{{$code}}/favorite/{{$post->id}}"
  let notloading = $(btn).children(".notloading")
  let loading = $(btn).children(".loading")
  if ( !$(loading).hasClass("hide") ) return;
  $(loading).removeClass("hide");

  getpost( url, {}, callbackFav ,callbackFavComplete);
}
function callbackFav(res){
  let iclass;
  let data = res.data
  toast(data.msg,'bottomCenter')
  $("#favcnt").text( data.fav_cnt);
  if( data.add ) iclass="myfavorite";
  else iclass="myunfavorite";
  $("#favcnt").closest('.btn-like').children('i.fas').removeClass('myfavorite').removeClass('myunfavorite').addClass(iclass)
}
function callbackFavComplete() {
  $('.btn-like').children(".loading").addClass("hide");
}

function loaderAttach(target,on) {
	if( on == false ){
		$(target).children(".loaderWrap").slideUp(500).remove()
		return;
	}
	let loader = `<div class="loaderWrap loading hide"><div class="loaderWrapInner">
<svg class="loadersvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<rect x="17.5" y="30" width="15" height="40" fill="#1d3f72">
  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
</rect>
<rect x="42.5" y="30" width="15" height="40" fill="#5699d2">
  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
</rect>
<rect x="67.5" y="30" width="15" height="40" fill="#d8ebf9">
  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
</rect>
</svg>
</div></div>
`
	$(target).append(loader);
}

let toastInstance, toastToast;

function comment_del_prc(btn){
  $("#body_loader_bg").removeClass("hide");
  iziToast.show({
      theme: 'dark',
      icon: 'icon-warning',
      title: '',
      message: '삭제하시겠습니까?',
      position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
      progressBarColor: 'rgb(0, 255, 184)',
      timeout:0,
      buttons: [
          ['<button>삭제</button>', function (instance, toast) {
            instance.hide({
                transitionOut: 'fadeOutUp',
            }, toast, '');
              comment_del_confirmed(btn);
          }, true], // true to focus
          ['<button>취소</button>', function (instance, toast) {
              instance.hide({
                  transitionOut: 'fadeOutUp',
                  onClosing: function(instance, toast, closedBy){
                      console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                  }
              }, toast, 'buttonName');
              $("#body_loader_bg").addClass("hide");
          }]
      ],
  });
}
function comment_del_confirmed(btn){
  let id = $(btn).data("commentid");
  let url = "/community/posts/commentv2/del"
  $(btn).addClass("comment-del-prc");
  getpost( url, {id:id}, console.log ,callbackCommentDelComplete);
}
function callbackCommentDelComplete(){
  $("#body_loader_bg").addClass("hide");
  recommentSuccess({})
}
</script>
@endsection
