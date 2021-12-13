@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/v1/css/community.css" />
<style>
    .mt-20 {
        margin-top: 20px;
    }

    .mb-20 {
        margin-bottom: 20px;
    }

    .my-20 {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .clearboth:after {
        content: '';
        clear: both;
    }

    :root {
        --device-pixel-ratio: 1;
        --list-border-color: rgb(0 0 0 / 50%);
        --list-item-border-color: rgb(0 0 0 / 20%);
    }

    @media (-webkit-min-device-pixel-ratio: 2),
    (min-resolution: 2dppx) {
        :root {
            --device-pixel-ratio: 2;
        }
    }

    @media (-webkit-min-device-pixel-ratio: 3),
    (min-resolution: 3dppx) {
        :root {
            --device-pixel-ratio: 3;
        }
    }

    .media-list {
        position: relative;
        z-index: 1;
        margin-top: 20px;
    }

    .media-list ul {
        list-style: none;
        margin: 0;
        padding: 0;
        position: relative;
        background: white;
    }

    .media-list ul:before {
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

    .media-list ul:after {
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

    .media-list li {
        position: relative;
        box-sizing: border-box; padding: 15px 0; cursor: pointer;
    }

    .media-list .item-link {
        color: inherit;
        display: flex;
        justify-content: space-between;
        box-sizing: border-box;
        align-items: center;
        min-height: 44px;
        padding-left: 16px;
        transition-duration: .3s;
        transition-property: background-color, color;
        position: relative;
        overflow: hidden;
        z-index: 0;
        user-select: none;
    }

    .media-list li:not(:last-child):after {
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

    .media-list .item-media {
        display: flex;
        flex-shrink: 0;
        flex-wrap: nowrap;
        align-self: center;
        box-sizing: border-box;
    }

    .item-media-imgbox {
        width: 100px;
        height: 100px;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .media-list .item-inner {
        position: relative;
        width: 100%;
        min-width: 0;
        display: flex;
        justify-content: space-between;
        box-sizing: border-box;
        align-items: center;
        align-self: stretch;
        padding-left: 30px;
        padding-top: 16px;
        padding-bottom: 6px;
        min-height: 44px;
        display: block;
        align-self: stretch;
    }

    .item-title-row {
        position: relative;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        display: -webkit-box;
        font-weight: 400;
        line-height: 22px;
        max-height: 22px;
        margin-bottom: 7px;
    }

    .item-text {
        position: relative;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        display: -webkit-box;
        font-size: 14px;
        font-weight: 400;
        color: #999;
        line-height: 21px;
        max-height: 42px;
        word-break: break-all;
    }

    .item-title-row.confirm_ready {
        padding-right: 66px;
    }

    .item-title-row.confirm_ready:after {
        content: '(대기중)';
        position: absolute;
        right: 0;
        color: #0994ef;
    }

    .item-desc {
        display: flex;
        justify-content: space-between;
    }

    .item-desc-main {
        padding-right: 16px;
    }

    .item-desc-sub {
        max-width: 116px;
        min-width: 116px;
        width: 116px;
        padding-right: 16px;
        font-size: 14px;
    }

    /*****************mkcss***************
    .list>.funlist li {
        width: calc((100% - 75px)/3);
        float: left;
        display: inline-block ;border: 1px solid #ddd;margin: 20px 0;padding: 20px;margin-right: 30px;cursor: pointer;}
    .list>.funlist li:last-child{margin-right: 0}

    .media-list .item-media {
        flex-shrink: 0;
        flex-wrap: nowrap;
        align-self: center;
        box-sizing: border-box;
        width: 100%;
        height: 200px;
        background-size: cover;}
    .item-media-imgbox {    width: 100%;height: 100%;background-repeat: no-repeat;}
    .media-list .item-link{display: block}
    .item-desc {display: block;}
    .item-desc-sub{width: 100%;max-width: 100%;overflow: hidden;color: #666;margin-top: 3px}
    .item-text{display: none}
    .item-desc-nickname,
    .item-desc-date,
    .item-desc-commentcnt {float: left; display: inline-block;  margin-right: 10px; }
    .media-list li:not(:last-child):after {height: 0px}
    .media-list .item-link {padding-left: 0px}
    .ct {clear: both }***/

    }


    .ct>.pagination>.page-item>.page-link,
    .ct>.pagination>.page-item>span {
        font-size: 14px !important;
        color: #337ab7;
    }

    .ct>.pagination>.page-item.active>span {
        color: white!important;
    }

    li.notconfirmed .item-media-imgbox {
       background-color: rgba(0,0,0,0.8)!important;background-blend-mode: overlay;
    }

   @media only screen and (max-width: 600px) {
    .item-media-imgbox {width: 100px;height:100px}
    .item-desc {
            flex-direction: column;
        }
        .item-desc-sub {
            display: flex;
            width: 100%;
            max-width: 100%;
            min-width: 100%;
            justify-content: flex-end;
            flex-wrap: wrap;    margin: 10px 0;}

        .item-desc-nickname,
        .item-desc-date,
        .item-desc-commentcnt {
            padding-right: 10px;
        }



    }


       @media only screen and (max-width: 948px) {


       .round_btn {background-color: #1e9af9;color: #fff;border-radius: 100px!important;padding:14px;width: 50px;height: 50px; text-align: center;font-size: 1.2em;}
       .round_btn i{color: #fff}

    }


</style>
@endsection
@section('body_bottom','')

@section('content')
<!--common_visual-->
<div class="visual6">
    <h1>{{$config->title}}</h1>
</div>
<!--//common_visual-->


<div class="sub_menu_N">
    <ul>
        <li class="h_icon" onclick="window.open('/v2/')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"/><path d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19z" fill="rgba(255,255,255,1)"/></svg>
            </li>
        <li class="@if($code=='tip') on @endif"><a href="tip">모두꿀TIP</a></li>
        <li class="@if($code=='fun') on @endif"><a href="fun">모두FUN</a></li>
        <!-- <li class="@if($code=='hometown') on @endif"><a href="hometown">우리동네자랑하기</a></li>-->
    </ul>
</div>


<div class="center">
    <div id="board">
        <div class="good_after">
           <!-- <h1 style="border: 0"><b>{{$config->title}}</b></h1>-->
            <div class="mt-20">

                <form id="searchform" action="{{url()->current()}}">
                    <!-- search box -->
                    <div class="display-flex justify-space-between ">
                        <div class="search_box clearboth">

                            <select class="cmt_select" id="search_option" name="search_option">
                                <option value="title" @if($request->search_option !='cont' && $request->search_option !='writer' ) selected @endif >제목</option>
                                <option value="cont" @if($request->search_option=='cont') selected @endif >제목+내용</option>
                                <option value="writer" @if($request->search_option=='writer') selected @endif>글쓴이</option>
                            </select>

                            <div class="cmt_form_Box">
                                <input name="search" id="search" type="text" value="{{$request->search}}" maxlength="11" placeholder="검색어를 입력해주세요">
                                <label></label>
                                <span class="btn_form" onClick="search_data(this)">검색</button>
                            </div>

                            @if ( $config->use_write=='Y' || (Auth::user() && Auth::user()->level >= 1024) )
                            <a type="button" class="cmnty_button_blue pc" href="{{$code}}/write">글쓰기</a>
                            @endif

                        </div>
                    </div>
                    <!-- / search box -->
                    <div style="clear: both;"></div>
                    <div class="list media-list">
                        <ul class="funlist">
                            @forelse ($data as $post)
                            <li class="@if($post->is_confirmed == 'R') notconfirmed @endif">

                                @if($post->is_confirmed == 'Y' || (Auth::user() && Auth::user()->id == $post->user_id) )
                                  <a href="{{$code}}/view/{{$post->id}}" data-code="{{$code}}" data-id="{{$post->id}}" class="item-link">
                                @else
                                  <span onClick="comfirmMessage()" class="item-link">
                                @endif

                                        <div class="item-media">
                                            @php
                                            $imgurl = ( $post->repImg ) ? $post->repImg : '/NEW/image/sub/know_logo.png';
                                            @endphp
                                            <div class="item-media-imgbox" style="background: url( '{{$imgurl}}' ) no-repeat center center ;background-size: cover;">
                                            </div>
                                        </div>
                                        <div class="item-inner">
                                            <div class="item-desc">
                                                <div class="item-desc-main">
                                                    <div class="item-title-row @if($post->is_confirmed != 'Y') confirm_ready @endif">
                                                        {{$post->title}}
                                                    </div>
                                                    <div class="item-subtitle">
                                                    </div>
                                                    <div class="item-text">
                                                        {{ strip_tags($post->body)}}
                                                    </div>
                                                </div>
                                                <div class="item-desc-sub">
                                                    <div class="item-desc-nickname">{{$post->nickname}}</div>
                                                    <div class="item-desc-date">
                                                        @if( $post->created_at > '2021-10-01')
                                                        {{ $post->created_at->format('H:i') }}
                                                        @else
                                                        {{ $post->created_at->format('Y-m-d') }}
                                                        @endif
                                                    </div>
                                                    <div class="line100"></div>
                                                    <div class="item-desc-commentcnt">
                                                        <i class="far fa-comment-dots"></i>
                                                        <span>{{$post->comment_cnt}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @if($post->is_confirmed == 'Y' || (Auth::user() && Auth::user()->id == $post->user_id) )
                                  </a>
                                @else
                                  </span>
                                @endif
                            </li>
                            @empty
                            <li>
                                <div class="item-inner">
                                    작성된 글이 없습니다.
                                </div>
                            </li>
                            @endforelse
                        </ul>
                    </div>

                </form>
                <div class="ct">
                    {{ $pagingres }}
                </div>
                <div style="display: flex; flex-direction: row-reverse">
                <a type="button" class="round_btn mobile btn" href="{{$code}}/write"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".comfirmMessage").on("click", comfirmMessage)
        @if(session('noti_alert_message'))
        swal.fire('', `{!! session('noti_alert_message') !!}`)
        @endif
    })

    function comfirmMessage() {
        swal.fire('규정 확인 대기중', '커뮤니티 규정 확인 후 글이 노출됩니다.');
    }

    function search_data(btn) {
        $("#searchform").submit()
    }

</script>
@endsection
