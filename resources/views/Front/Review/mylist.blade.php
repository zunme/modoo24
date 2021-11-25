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
    }

    #board ul .border_list:after {
        display: none
    }

    #board ul .border_list {
        padding: 0px;
    }

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
        border-bottom: 1px solid #cccccc;
    }

    li.mylist-item {
        position: relative;
        box-sizing: border-box;
        padding: 20px 0;
        border-bottom: 1px solid #cccccc;
    }

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
        width: 30px
    }

    .level-wrap .level-inner {
        width: 30px
    }

    .level-wrap .level-inner img {
        width: 100%
    }
    .mylist_img{display: flex; margin: 20px 0}
    .mylist_img li{ background: url('/v1/image/sub/know_logo.png') no-repeat center center; width: 23%; height: 150px; background-size: cover;border: 1px solid #eee; margin-right: 3px}
.panel {margin-bottom: 0}
.after_partner{background: #fff; border: 1px solid #cecece; border-radius: 30px; padding: 20px}    
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
            <li onclick="location.href='/v1/move/review' ">이사후기</li>
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
                    <ul>
                        <li class="border_list">
                            <ul class="mylist-items">
                                <li class="mylist-item">
                                    <div class="mylist-item-inner">
                                        <div class="mylist-item-media">
                                            <div class="item-media-imgbox"></div>
                                        </div>
                                        <div class="mylist-item-body">
                                            <div class="mylist-item-body-line">
                                                <span class="mylist-item-body-title">이사일 :</span>
                                                <span class="mylist-item-body-text"> 2021-10-29</span>
                                            </div>
                                            <div class="mylist-item-body-line">
                                                <span class="mylist-item-body-title">출발지 :</span>
                                                <span class="mylist-item-body-text">인천시 남동구 선학동</span>
                                            </div>
                                            <div class="mylist-item-body-line">
                                                <span class="mylist-item-body-title">도착지 :</span>
                                                <span class="mylist-item-body-text">인천시 남동구 선학동</span>
                                            </div>
                                        </div>

                                    </div>
                                </li>

                            </ul>
                        </li>
                        <div class="panel">
                            <dl class="panel_view new_review">
                                <dt class="partner_info">
                                    <ul class="partner_name_info">
                                        <li class="level">
                                            <p><img src="/v1/image/sub/rating_2.png" alt="최우수업체"></p>
                                        </li>
                                        <li class="patn">주성</li>
                                        <li class="starbox">
                                            <ul class="star_list_b">
                                                <li><img src="/NEW/image/sub/starB.png" alt=""></li>
                                                <li><img src="/NEW/image/sub/starB.png" alt=""></li>
                                                <li><img src="/NEW/image/sub/starB.png" alt=""></li>
                                                <li><img src="/NEW/image/sub/starB.png" alt=""></li>
                                                <li><img src="/NEW/image/sub/starB_off.png" alt=""></li>
                                                <li>4.53점 </li>
                                            </ul>
                                        </li>

                                    </ul>
                                    <dl class="partner_name">
                                        <dd>
                                            <ul class="star_kind">
                                                <li>
                                                    <ul>
                                                        <li class="part_state">전문성</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li class="part_state">친절성</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li class="part_state">가격도</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li class="part_state">마무리</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB_off.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li class="part_state">사후관리</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li class="part_state">포장도</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </dd>
                                        <dd class="partner_after_pic">
                                            <ul></ul>
                                        </dd>
                                        <dd class="partner_after_txt">
                                            <p class="mar0">이사하기 두달 전에 이사업체 선정을 먼저 해야 마음이 편할거 같아서모두이사 통해 3곳 비교견적 받았습니다3곳 중 주성이란 업체 통해서 이사하게 되었어요처음엔 반신반의 했는데 이사당일날 작업방향에 대해 설명해주시고손놀림이 빠르고 순차적으로 진행되어전문적이고 많이 능숙하다는 느낌 받았습니다이사 무사히 잘마쳐서 다행이라고 생각합니다. 감사합니다.&nbsp;</p>
                                        </dd>
                                        <dd>
                                            <ul class="mylist_img">
                                                <li>1</li>
                                                <li>2</li>
                                                <li>3</li>
                                                <li>4</li>
                                            </ul>
                                                        
                                        </dd>
                                        <dd>
                                            <div class="after_partner">
                                                 <div>수인-개인용달</div> 
                                                 <div>2021-11-19</div> 
                                                <p>감사합니다.우리 이사를 사랑해주셔서 감사합니다.! 냐하하하하하하 </p>
                                            </div>    
                                        </dd>
                                    </dl>
                                </dt>
                            </dl>
                            
                        </div>
                        <li class="border_list">
                            <ul class="mylist-items">
                                <li class="mylist-item">
                                    <div class="mylist-item-inner">
                                        <div class="mylist-item-media">
                                            <div class="item-media-imgbox"></div>
                                        </div>
                                        <div class="mylist-item-body">
                                            <div class="mylist-item-body-line">
                                                <span class="mylist-item-body-title">이사일 :</span>
                                                <span class="mylist-item-body-text"> 2021-10-29</span>
                                            </div>
                                            <div class="mylist-item-body-line">
                                                <span class="mylist-item-body-title">출발지 :</span>
                                                <span class="mylist-item-body-text">인천시 남동구 선학동</span>
                                            </div>
                                            <div class="mylist-item-body-line">
                                                <span class="mylist-item-body-title">도착지 :</span>
                                                <span class="mylist-item-body-text">인천시 남동구 선학동</span>
                                            </div>
                                        </div>

                                    </div>
                                </li>

                            </ul>
                        </li>
                        <div class="panel">
                            <dl class="panel_view new_review">
                                <dt class="partner_info">
                                    <ul class="partner_name_info">
                                        <li class="level">
                                            <p><img src="/v1/image/sub/rating_2.png" alt="최우수업체"></p>
                                        </li>
                                        <li class="patn">주성</li>
                                        <li class="starbox">
                                            <ul class="star_list_b">
                                                <li><img src="/NEW/image/sub/starB.png" alt=""></li>
                                                <li><img src="/NEW/image/sub/starB.png" alt=""></li>
                                                <li><img src="/NEW/image/sub/starB.png" alt=""></li>
                                                <li><img src="/NEW/image/sub/starB.png" alt=""></li>
                                                <li><img src="/NEW/image/sub/starB_off.png" alt=""></li>
                                                <li>4.53점 </li>
                                            </ul>
                                        </li>

                                    </ul>
                                    <dl class="partner_name">
                                        <dd>
                                            <ul class="star_kind">
                                                <li>
                                                    <ul>
                                                        <li class="part_state">전문성</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li class="part_state">친절성</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li class="part_state">가격도</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li class="part_state">마무리</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB_off.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li class="part_state">사후관리</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li class="part_state">포장도</li>
                                                        <li>
                                                            <ul class="star_list_b star_list_b_small">
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                                <li><img src="/v1/image/sub/starB.png" alt=""></li>
                                                            </ul>
                                                        </li>
                                                        <li class="pntxt"></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </dd>
                                        <dd class="partner_after_pic">
                                            <ul></ul>
                                        </dd>
                                        <dd class="partner_after_txt">
                                            <p class="mar0">이사하기 두달 전에 이사업체 선정을 먼저 해야 마음이 편할거 같아서모두이사 통해 3곳 비교견적 받았습니다3곳 중 주성이란 업체 통해서 이사하게 되었어요처음엔 반신반의 했는데 이사당일날 작업방향에 대해 설명해주시고손놀림이 빠르고 순차적으로 진행되어전문적이고 많이 능숙하다는 느낌 받았습니다이사 무사히 잘마쳐서 다행이라고 생각합니다. 감사합니다.&nbsp;</p>
                                        </dd>
                                        <dd>
                                            <ul class="mylist_img">
                                                <li>1</li>
                                                <li>2</li>
                                                <li>3</li>
                                                <li>4</li>
                                            </ul>
                                                        
                                        </dd>
                                        <dd>
                                             <div>수인-개인용달</div> 
                                             <div>2021-11-19</div> 
                                            <p>감사합니다.우리 이사를 사랑해주셔서 감사합니다.! 냐하하하하하하 </p>
                                        </dd>
                                    </dl>
                                </dt>
                            </dl>
                            
                        </div>


                       
                    </ul>
                </div>
                <div>
                    <div>알림사항</div>
                    <div>
                        견적 신청 시 작성해 주신 고객님의 정보와 일치하지 않을 경우, 업체 평가가 어렵습니다.
                        불편 신고의 진위 확인 처리 시간은 영업일 기준 3-4일이 소요되어 평가 즉시 공개되지
                        않는 점을 안내드립니다.
                    </div>
                </div>

            </div>






        </div>
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

    </div>
    @endsection

    @section('script')
    @endsection
