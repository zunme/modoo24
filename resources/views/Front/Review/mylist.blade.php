@extends('layouts.modoo')

@section('css')
<style>
    .nav .nav-item {
        background: #eee;
        padding: 10px;
        height: 50px;
        line-height: 30px;
    }

    #accordion .panel {
        padding: 0;
        background: #fff;
        max-height: initial;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        font-size: 15px;
    }

    .afmove_list .aftitle {
        font-size: 1.2em;
        padding-bottom: 10px;
        padding-top: 20px;
    }

    .nav-tabs,
    .nav-pills {
        padding: 20px 0;
    }

    #board {
        margin: 0 0 50px;
        border-top: 1px solid #333;
        margin-bottom: 70px;
        border-bottom: 1px solid #333;
    }

    #board ul .border_list:after {
        display: none
    }

    #board ul .border_list {
        padding: 0px;
    }

li.mylist-item {    border-top: 1px solid #ccc;}
li.mylist-item:first {    border-top: 1px solid #000;}


    #board .panel{background: #f5f5f5;
    border-radius: 15px;}

    .item-media-imgbox {
        width: 135px;
        height: 90px;
        background: url(/v1/image/sub/know_logo.png) no-repeat center center;
        background-size: cover;
        border: 1px solid #dedede;
        border-radius: 10px;
    }


    li.mylist-item {
        position: relative;
        box-sizing: border-box;
        padding: 20px 0;
        border-bottom: 0
    }
    #board ul .border_list{border-bottom: 0}
    li.mylist-item:last-child {
        border-bottom: 0
    }

    .mylist-item .mylist-item-inner {
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

    .mylist-item-body {
        margin-left: 20px;
        font-size: .95em;
        font-weight: 500;
    }



    .mylist-item .mylist-item-media {
        display: flex;
        flex-shrink: 0;
        flex-wrap: nowrap;
        align-self: center;
        box-sizing: border-box;
    }

    .item-media-imgbox {
        width: 135px;
        height: 90px;
        background: url('/v1/image/sub/know_logo.png') no-repeat center center;
        background-size: cover;
    }

    .mylist-item-body {
        flex-grow: 1;
    }

    .inline-panel-title .d-flex {
        display: flex
    }

    .level-wrap {
        width: 40px
    }

    .level-wrap .level-inner {
        width: 30px
    }

    .level-wrap .level-inner img {
        width: 100%
    }

    .mylist_img {
        display: flex;
        margin: 20px 0
    }

    .mylist_img li {
       
        width: 23%;
        height: 150px;
        background-size: cover;
        border: 1px solid #eee;
        margin-right: 3px !important;
        float: none
    }

    .panel {
        margin-bottom: 0
    }

    .inline-post {
        display: none;
    }

    .inline-panel {
        margin: 10px;
        padding: 30px 22px;
    }

    .inline-panel>div {
        margin-bottom: 12px;
    }

    .level-inner {
        padding-right: 10px;
    }

    .level-inner img {
        width: 30px;
    }

    .inline-panel-title {
        flex-wrap: wrap;
        max-width: 580px;
    }

    .inline-panel-title>div.d-flex>div:first-child {
        padding-right: 10px;
    }

    .inline-panel-title>div.d-flex>div:last-child {
        padding-left: 10px;
        padding-right: 20px
    }

    .inline-panel-title>div:last-child {
        justify-content: flex-end;
    }

    .patn {
        font-size: 1.2em;
        font-weight: bold;
        line-height: 36px;
        font-family: 'GmarketSansMedium';
    }

    .inline-panel-total-rating {
        font-size: 22px;
        margin-top: 5px;

    }

    .inline-panel-rating-title {
        width: 70px;
    }

    .inline-panel-rating {
        flex-wrap: wrap;
        max-width: 610px;
    }

    .inline-panel-rating-wrap {
        margin-right: 30px;
        text-align: left
    }

    .inline-panel-rating-inner>i.fas {
        color: #00beff;
    }

    .inline-panel-subtitle-inner {
        margin-right: 20px;
    }

    .inline-panel-subtitle-title {
        margin-right: 10px;
    }

    #board ul .border_list2 dl dd {
        vertical-align: bottom;
    }

    .ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .ml-1-depth {
        /* margin-left: 18px; */
        /* margin-right: 18px; */
        word-break: break-all;
        text-align: left
    }

    .after-pt-reply {
        display: flex
    }

    .after-pt-wrap .after-pt-txt {
        color: #999;
        padding-top: 5px;
        text-align: left;
    }

    .after-pt-wrap {
        position: relative;
        width: 100%;
        padding: 0px;
        background: #FFFFFF;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        padding: 20px
    }

    .after-pt-wrap:after {
        content: '';
        position: absolute;
        border-style: solid;
        border-width: 0 15px 15px;
        border-color: #FFFFFF transparent;
        display: block;
        width: 0;
        z-index: 1;
        top: -15px;
        left: 110px;
    }

    .after-pt-wrap .after-pt-name {
        font-weight: bold;margin-right: 10px;

    }

    .after-pt-notice {
        border: 1px solid #ddd;
        display: flex;
        padding: 20px 100px;
        border-radius: 20px;
        margin-bottom: 40px
    }

    .after-pt-notice-title {
        text-align: center;
        margin-right: 7%
    }

    .after-pt-notice-title-icon {}

    .after-pt-notice-title-txt {
        font-size: 1em
    }

    .after-pt-notice-txt {
        color: #666;
        font-weight: 200;
        align-self: center;
        font-size: .85em
    }

    .after-pt-notice-title-txt {
        color: #999
    }
.panel { border: 0px }
    @media only screen and (max-width: 600px) {
        .nav .nav-item {
            height: 40px;
            line-height: 20px;
        }

        .nav-tabs,
        .nav-pills {
            padding: 20px 0;
        }

        .item-media-imgbox {
            display: none
        }

        #board .panel {
            padding: 0px
        }

        .after-pt-notice {
            padding: 20px 30px
        }



        .mylist_img {
            flex-wrap: wrap;
        }

        .mylist_img li {
            flex: 1 1 40%;
            margin-bottom: 3px
        }

        .after-pt-notice-title {
            display: none
        }

        .after-pt-notice-txt {
            font-size: .85em
        }

        #board {
            margin-bottom: 20px;
        }
        .inline-panel {padding-top: 5px}


    }

</style>

<style>
    #accordion .panel {
        margin-bottom: 0px
    }
 .thumbnail2{
    background-repeat:no-repeat; background-position:100%; background-size:cover; height: 100%; width:100%;display: block;
 }
</style>

@endsection

@section('content')
<div class="visual4">
    <h1>후기&amp;평가</h1>
</div>

<div class="content-wrap contents_wrap">
    <div class="sub_menu_N">
        <ul class="center">
            <li class="h_icon" onclick="window.open('/v2/')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19z" fill="rgba(255,255,255,1)" />
                </svg>
            </li>
            <li onclick="location.href='/v2/review' ">이사후기</li>
            <li class="on">이사업체 평가하기</li>
        </ul>
    </div>

    <div class="content-inner">
        <div class="mylist-wrap center">
            <nav class="nav nav-pills nav-fill">
                <a class="nav-item nav-link" href="/v2/review/my">이사업체 평가하기</a>
                <a class="nav-item nav-link active">이사업체 평가 내역</a>
            </nav>
            <div class="center afmove_list">
                <h2 class="aftitle">이사업체 평가 내역 </h2>
                <div id="board">
                    <ul id="board-list">
                      @forelse( $data as $row)
                      <li class="border_list">
                          <ul class="mylist-items">
                              <li class="mylist-item">
                                  <div class="mylist-item-inner">
                                      <div class="mylist-item-media">
                                          <div class="item-media-imgbox"></div>
                                      </div>
                                      <div class="mylist-item-body">
                                          <div class="mylist-item-body-line">
                                              <span class="mylist-item-body-text"> 비대면 견적 이사 <!--방문 견적 이사--></span>
                                          </div>
                                          <div class="mylist-item-body-line">
                                              <span class="mylist-item-body-title">이사일 :</span>
                                              <span class="mylist-item-body-text"> {{$row->b_mdate}}</span>
                                          </div>
                                          <div class="mylist-item-body-line">
                                              <span class="mylist-item-body-title">출발지 :</span>
                                              <span class="mylist-item-body-text">{{$row->order->s_addr1}}</span>
                                          </div>
                                          <div class="mylist-item-body-line">
                                              <span class="mylist-item-body-title">도착지 :</span>
                                              <span class="mylist-item-body-text">{{$row->order->e_addr1}}</span>
                                          </div>
                                      </div>

                                  </div>
                              </li>

                          </ul>
                      </li>
                      <div class="panel">
                          <div class="inline-panel">
                              <div class="inline-panel-title d-flex">
                                  <div class="d-flex">
                                      <div class="level-wrap">
                                          <span class="level-inner"><img src="/v1/image/sub/rating_{{$row->companyGrade['pic']}}.png" alt="{{$row->companyGrade['title']}}"></span>
                                      </div>
                                      <div class="patn">
                                          {{$row->s_company}}
                                      </div>
                                  </div>
                                  <div class="d-flex">
                                      <div class="inline-panel-total-rating d-flex">
                                          @include('Front.Review.ratingshow',['star'=> round( ($row->b_star_pro + $row->b_star_kind+$row->b_star_price+$row->b_star_finish+$row->b_star_expost+$row->b_star_pave)/6) ])
                                      </div>
                                      <div class="patn">
                                          {{ number_format( round( ($row->b_star_pro + $row->b_star_kind+$row->b_star_price+$row->b_star_finish+$row->b_star_expost+$row->b_star_pave)/6) , 1) }} 점
                                      </div>
                                  </div>
                              </div>
                              <div class="inline-panel-rating d-flex ml-2-depth newcolor">
                                  <div class="inline-panel-rating-wrap d-flex">
                                      <div class="inline-panel-rating-title">전문성</div>
                                      <div class="inline-panel-rating-inner">
                                            @include('Front.Review.ratingshow',['star'=> $row->b_star_pro ])
                                      </div>
                                  </div>
                                  <div class="inline-panel-rating-wrap d-flex">
                                      <div class="inline-panel-rating-title">친절성</div>
                                      <div class="inline-panel-rating-inner">
                                          @include('Front.Review.ratingshow',['star'=> $row->b_star_kind ])
                                      </div>
                                  </div>
                                  <div class="inline-panel-rating-wrap d-flex">
                                      <div class="inline-panel-rating-title">가격도</div>
                                      <div class="inline-panel-rating-inner">
                                          @include('Front.Review.ratingshow',['star'=> $row->b_star_price ])
                                      </div>
                                  </div>
                                  <div class="inline-panel-rating-wrap d-flex">
                                      <div class="inline-panel-rating-title">마무리</div>
                                      <div class="inline-panel-rating-inner">
                                          @include('Front.Review.ratingshow',['star'=> $row->b_star_finish ])
                                      </div>
                                  </div>
                                  <div class="inline-panel-rating-wrap d-flex">
                                      <div class="inline-panel-rating-title">사후관리</div>
                                      <div class="inline-panel-rating-inner">
                                          @include('Front.Review.ratingshow',['star'=> $row->b_star_expost ])
                                      </div>
                                  </div>
                                  <div class="inline-panel-rating-wrap d-flex">
                                      <div class="inline-panel-rating-title">포장도</div>
                                      <div class="inline-panel-rating-inner">
                                          @include('Front.Review.ratingshow',['star'=> $row->b_star_pave ])
                                      </div>
                                  </div>
                              </div>
                              <div class="inline-panel-body ml-1-depth">
                                  {{$row->b_note}}
                              </div>
                              @if( $row->files)
                              <ul class="mylist_img">
                                @foreach( $row->files as $file)
                                  <li>
                                    <!--a href="/v2/storage{{$file->url}}" data-lightbox="img_{{$row->b_uid}}">{{$row->s_company}}</a-->
                                    <a href="/v2/storage{{$file->url}}" data-lightbox="photos_{{$row->b_uid}}" class="thumbnail2"
                                      style="background-image: url(/v2/storage{{$file->url}});"
                                      >

                                     </a>
                                  </li>
                                @endforeach
                              </ul>
                              @endif
                              @if( $row->repl)
                              <div class="after-pt-wrap">
                                  <ul class="after-pt-reply">
                                      <li class="after-pt-name">{{$row->repl->r_name}}</li>
                                      <li class="after-pt-date">{{$row->repl->r_reg_date->format('Y-m-d')}}</li>
                                  </ul>
                                  <div class="after-pt-txt">{!! nl2br($row->repl->r_content) !!}</div>
                              </div>
                              @endif
                          </div>

                      </div>
                      @empty
                      <li class="none-data" id="none-data">
                          <div class="icon">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="46" height="46">
                                  <path fill="none" d="M0 0h24v24H0z" />
                                  <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-5h2v2h-2v-2zm0-8h2v6h-2V7z" fill="rgba(0,190,255,1)" />
                              </svg>
                          </div>
                          <div class="no-afmovedate" style="padding-top:10px">
                              평가하신 이사 업체가 없습니다.
                          </div>
                      </li>
                      @endforelse
                    </ul>
                </div>
                <div class="after-pt-notice">
                    <div class="after-pt-notice-title">
                        <div class="after-pt-notice-title-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50" height="50">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-7v2h2v-2h-2zm0-8v6h2V7h-2z" fill="rgba(253,126,13,1)" />
                            </svg>
                        </div>
                        <div class="after-pt-notice-title-txt">알림사항</div>
                    </div>
                    <div class="after-pt-notice-txt">
                        견적 신청 시 작성해 주신 고객님의 정보와 일치하지 않을 경우, 업체 평가가 어렵습니다.<br />
                        <b class="col_ptog">불편 신고</b>의 진위 확인 처리 시간은 <b class="col_ptog">영업일 기준 3-4일이 소요</b>되어 평가 즉시 공개되지
                        않는 점을 안내드립니다.
                    </div>
                </div>

            </div>

        </div>

    </div>


</div>


        @endsection

        @section('script')
<script id='listtemplate' type='text/template'>

</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

<script>
    var acc = document.getElementsByClassName("border_list");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }

</script>
<!--// faq스크립트-->

<script>
let template;

$.ajax({
  url : '/v2/review/my/list/api',
  method:'get',
  dataType:'JSON',
  success:function(res){
    var template = Handlebars.compile( $("#listtemplate").html() );

    $("#none-data").hide();
    $("#board-list").append( template(res.data) )
    console.log (res.data)
  },
  error: function ( err ){

  },
});
</script>
        @endsection
