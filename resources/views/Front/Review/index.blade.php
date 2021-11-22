@extends('layouts.modoo')

@section('css')
<style>
#accordion .panel {margin-bottom: 0px}
</style>
<style>
.inline-post{
    display: none;
}
.inline-panel{
    margin: 10px;
    padding: 15px;
    background-color: #eee;
    margin-top: 30px;
}
.level-inner{
  padding-right:10px;
}
.level-inner img{  width:30px;}
.inline-panel-title > div{
  padding-right:10px;
}
.patn{
  font-size: 1.2em;
  font-weight: bold;
  line-height: 36px;
  font-family: 'GmarketSansMedium';
}
.inline-panel-total-rating{
  font-size: 22px;
  margin-top: 5px;

}
.inline-panel-rating-title{
  width: 70px;
}
.inline-panel-rating{
    flex-wrap: wrap;
    max-width: 610px;
}
.inline-panel-rating-wrap{
  margin-right:30px;
}
.inline-panel-subtitle-inner {
  margin-right: 20px;
}
.inline-panel-subtitle-title{
  margin-right: 10px;
}
.ellipsis {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
@endsection


@section('content')
<div class="visual4">
    <h1>후기&amp;평가</h1>
</div>
<div class="sub_menu_N">
        <ul class="center">
            <li class="h_icon" onclick="window.open('/v2/')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"></path><path d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19z" fill="rgba(255,255,255,1)"></path></svg>
            </li>
            <li class="on" onclick="location.href='/v2/review' ">이사후기</li>
            <li onClick="location.href='/v2/review/my'">이사업체 평가하기</li>
        </ul>
    </div>
<div class="contents_wrap">
  <div class="center">
    <div id="board">

        <div class="good_after">
          <h1>모두이사를 이용하신 <b>고객님들의 이사후기</b></h1>

          <a class="rating_info" onclick="showmap(spot);">
              <span class="qustion">
                  <img src="/image/sub/icon_rating.png" alt="평가등급"></span>
              <strong>평가등급</strong>은 어떻게 책정 되나요?<span class="rt_arrow"><img src="/image/sub/rating_arrow.gif" alt="">
              </span>
          </a>
          <div id="spot" class="rt_pop" style="position: absolute; right: 0px; top: 35px;visibility: hidden;">
              <dl>
                  <dt>
                      <p><img src="/v1/image/sub/rating_1.png" alt="명예의전당"></p>
                      <span>명예의 전당</span>
                  </dt>
                  <dd>3개월 이상 이사후기 평점 4점 이상 유지</dd>
              </dl>
              <dl>
                  <dt>
                      <p><img src="/v1/image/sub/rating_2.png" alt="최우수업체"></p>
                      <span>최우수 업체</span>
                  </dt>
                  <dd>실시간 이사후기 평점 4점 이상 유지</dd>
              </dl>
              <dl>
                  <dt>
                      <p><img src="/v1/image/sub/rating_3.png" alt="우수업체"></p>
                      <span>우수업체</span>
                  </dt>
                  <dd>실시간 이사후기 평점 3점 이상 유지</dd>
              </dl>
              <dl>
                  <dt>
                      <p><img src="/v1/image/sub/rating_4.png" alt="보통업체"></p>
                      <span>보통업체</span>
                  </dt>
                  <dd>실시간 이사후기 평점 2점 이상 유지</dd>
              </dl>
              <dl>
                  <dt>
                      <p><img src="/v1/image/sub/rating_5.png" alt="미흡업체"></p>
                      <span>미흡업체</span>
                  </dt>
                  <dd>실시간 이사후기 평점 2점 이하</dd>
              </dl>
          </div>
        </div>

        <ul>
          <li class="border_list2">
              <dl>
                  <!--<dt class="no">고객번호</dt>-->
                  <dt class="name">종류</dt>
                  <dt class="company">업체명</dt>
                  <dd class="after">후기</dd>
                  <dt class="star">평점</dt>
                  <dt class="date">상태</dt>
                  <dt class="date">이사일</dt>
              </dl>
          </li>

          <!-- loop -->
          @foreach( $data as $row)
          <li class="border_list2">
            <dl>
              <dt class="name">{{$row->b_type}}</dt>
              <dt class="company">{{$row->s_company}}</dt>
              <dd class="ellipsis">{!! strip_tags(htmlspecialchars_decode($row->b_note, ENT_QUOTES)) !!}</dd>
              <dt class="star">
                <ul class="star_list">
                  <li><img src="/image/sub/star_on.png" alt=""></li>
                  <li><img src="/image/sub/star_on.png" alt=""></li>
                  <li><img src="/image/sub/star_on.png" alt=""></li>
                  <li><img src="/image/sub/star_off.png" alt=""></li>
                  <li><img src="/image/sub/star_off.png" alt=""></li>
                </ul>
              </dt>
              <dt class="date">
                <span><img src="/v1/image/sub/rating_{{$row->gradePic}}.png" alt="우수업체"></span> {{$row->gradeTitle}}
              </dt>
              <dt class="date">{{$row->b_mdate}}</dt>
            </dl>
            <dl class="inline-post">
              <!-- panel -->
              <div class="inline-panel">
                <div class="inline-panel-title d-flex">
                  <div class="level-wrap">
                    <span class="level-inner"><img src="/v1/image/sub/rating_{{$row->gradePic}}.png" alt="우수업체"></span>
                  </div>
                  <div class="patn">
                    {{$row->s_company}}
                  </div>
                  <div class="inline-panel-total-rating d-flex">
                    @include( "Front.componentstar",["stars"=>$row->avgstararr])
                  </div>
                  <div class="patn">
                    {{$row->avgstar}}점
                  </div>
                </div>
                <div class="inline-panel-rating d-flex">
                  <div class="inline-panel-rating-wrap d-flex">
                    <div class="inline-panel-rating-title">전문성</div>
                    <div class="inline-panel-rating-inner">
                      @include( "Front.componentstar",["stars"=>$row->b_star_pro_arr])
                    </div>
                  </div>
                  <div class="inline-panel-rating-wrap d-flex">
                    <div class="inline-panel-rating-title">친절성</div>
                    <div class="inline-panel-rating-inner">
                      @include( "Front.componentstar",["stars"=>$row->b_star_kind_arr])
                    </div>
                  </div>
                  <div class="inline-panel-rating-wrap d-flex">
                    <div class="inline-panel-rating-title">가격도</div>
                    <div class="inline-panel-rating-inner">
                      @include( "Front.componentstar",["stars"=>$row->b_star_price_arr])
                    </div>
                  </div>
                  <div class="inline-panel-rating-wrap d-flex">
                    <div class="inline-panel-rating-title">마무리</div>
                    <div class="inline-panel-rating-inner">
                      @include( "Front.componentstar",["stars"=>$row->b_star_finish_arr])
                    </div>
                  </div>
                  <div class="inline-panel-rating-wrap d-flex">
                    <div class="inline-panel-rating-title">사후관리</div>
                    <div class="inline-panel-rating-inner">
                      @include( "Front.componentstar",["stars"=>$row->b_star_expost_arr])
                    </div>
                  </div>
                  <div class="inline-panel-rating-wrap d-flex">
                    <div class="inline-panel-rating-title">포장도</div>
                    <div class="inline-panel-rating-inner">
                      @include( "Front.componentstar",["stars"=>$row->b_star_pave_arr])
                    </div>
                  </div>
                </div>
                <div class="inline-panel-subtitle d-flex">
                  <div class="inline-panel-subtitle-inner d-flex">
                    <div class="inline-panel-subtitle-title">고객 번호</div>
                    <div class="inline-panel-subtitle-cont">111111</div>
                  </div>
                  <div class="inline-panel-subtitle-inner d-flex">
                    <div class="inline-panel-subtitle-title">고객 이사일</div>
                    <div class="inline-panel-subtitle-cont">{{$row->b_mdate}}</div>
                  </div>
                </div>
                <div class="inline-panel-body">
                  {!! strip_tags(htmlspecialchars_decode($row->b_note, ENT_QUOTES)) !!}
                </div>
              </div>
              <!-- / panel -->
            </dl>
          </li>
          @endforeach
          <!-- /loop -->
        </ul>

    </div>

    <div class="ct">
        {{ $pagingres }}
    </div>
  </div>
</div>



@endsection

@section('script')
<script type="text/javascript">
    function showmap() {
        if (document.all.spot.style.visibility == "hidden") {
            document.all.spot.style.visibility = "visible";
            return false;
        }
        if (document.all.spot.style.visibility == "visible") {
            document.all.spot.style.visibility = "hidden";
            return false;
        }
    }
$("document").ready( function() {
  $("li.border_list2").on("click", function(e){
    $(e.target).closest(".border_list2").children("dl.inline-post").toggle()
  })
})
</script>
@endsection
