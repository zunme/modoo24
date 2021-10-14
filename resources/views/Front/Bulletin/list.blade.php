@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/NEW/css/community.css" />

<style>
.ct > .pagination>.page-item>.page-link, .ct > .pagination>.page-item>span {
  font-size: 14px !important;
  color: #337ab7;
}
.ct > .pagination>.page-item.active>span{
  color:white !important;
}
</style>

@endsection
@section('body_bottom','')

@section('content')
<!--common_visual-->
<div class="visual6">
    <h1>{{$config->title}}</h1>
    <h4>{{$config->sub_title}}</h4>
</div><!--//common_visual-->


<div class="sub_menu">
    <ul class="center">
        <li class="h_icon gotohome"></li>
        <li class="on">{{$config->title}}</li>
    </ul>
</div>
<div class="center">
    <div id="board">
        <div class="good_after">
            <h1 style="border: 0"><b>{{$config->title}}</b></h1>
            <div class="searchlist_Box">
              <form>
                <select class="cmt_select" name="search_option">
                  <option value="title" @if($request->search_option !='cont' && $request->search_option !='writer' ) selected @endif >제목</option>
                  <option value="cont" @if($request->search_option=='cont') selected @endif >제목+내용</option>
                  <option value="writer" @if($request->search_option=='writer') selected @endif>글쓴이</option>
                </select>

                <div class="cmt_form_Box">
                    <input name="search" type="text" value="{{$request->search}}" maxlength="11" placeholder="이사에 대한 모든 질문">
                    <label></label>
                    <span class="btn_form" onClick="submitbtn(this)">검색</span>
                </div>

                @if ( $config->use_write=='Y' || (Auth::user() && Auth::user()->level >= 1024) )
                <a type="button" class="cmnty_button_blue" href="{{$code}}/write">질문하기</a>
                @endif

              </form>
            </div>
        </div>
        <ul>
            <li class="border_list3">
                <dl>
                    <dt class="no">번호</dt>
                    <dd class="title" style="text-align: center">제목</dd>
                    <dt class="replystate">답변</dt>
                    <dt class="nickname">글쓴이</dt>
                    <dt class="date">날짜</dt>
                </dl>
            </li>
@foreach ( $data as $row)
            <li class="border_list3">
                <a @if($row->is_confirmed =='R') href="javascript:comfirmMessage()" @else href="{{$code}}/view/{{$row->id}}"  @endif >
                    <dl>
                        <dt class="no">{{$row->id}}</dt>
                        <dd class="title">{{$row->title}}
                          @if( $row->is_confirmed =='R')
                          <span class="wait">(대기중)</span>
                          @endif

                          @if( $row->comment_cnt > 0)
                          <span class="replysok_m"> 업체답변 ({{$row->comment_cnt}})</span>
                          @else
                          <span class="replysno_m"> 답변대기</span>
                          @endif

                        </dd>
                        <dt class="replystate"> &nbsp;
                          @if( $row->comment_cnt > 0)
                          <span class="replysok"> 업체답변 ({{$row->comment_cnt}})</span>
                          @else
                          <span class="replysno"> 답변대기</span>
                          @endif
                        </dt>
                        <dt class="nickname">{{$row->nickname}}</dt>
                        <dt class="date">{{$row->created_at->diffForHumans()}}</dt>
                    </dl>
                </a>
            </li>
@endforeach


        </ul>
    </div>


    <div class="ct">
      {{ $data->links('vendor.pagination.dots',['pagination_eachside'=>3]) }}
    </div>
</div>

<div id="topButton" style="cursor: pointer">

    <a class="page_top" href="#cssmenu" id="topButtonImg" >
        <button type="button" id="top_btn">
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.828l-4.95 4.95-1.414-1.414L12 8l6.364 6.364-1.414 1.414z"/>
            </svg>
           <span>TOP</span>
        </button>
    </a>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
  $(".comfirmMessage").on("click", comfirmMessage )
	$(window).scroll(function() {
	    // top button controll
	    if ($(this).scrollTop() > 500) {
	        $('#topButton').fadeIn();
	    } else {
	        $('#topButton').fadeOut();
	    }
	});

	$("#topButtonImg").click(function() {
		$('html, body').animate({scrollTop:0}, '300');
	});

});
function comfirmMessage(){
  swal.fire('규정 확인 대기중','이사지식인 규정 확인 후 글이 노출되며 모두이사 파트너업체가 질문에 대한 답글을 해드립니다.');
}
</script>
<style>
#topButton {position: fixed; right: 2%; bottom: 50px; display: none; z-index: 999;}
</style>

<script>
function submitbtn(btn){
  $(btn).closest('form').submit()
}
</script>
@endsection
