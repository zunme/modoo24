@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/v1/css/community.css" />
<link rel="stylesheet" type="text/css" href="/v1/css/untact_popup.css" />

<style>
.mypage_odr_list > li > dl {
    height: 96px;
    width: 96px;
    padding-top: 16px;
}
#untact_mypage_content {
    padding: 20px 20px 0;
    clear: both;
    overflow: hidden;
}
</style>
@endsection

@section('body_bottom','')

@section('content')
<!--common_visual-->
<div class="visual3">
    <h1>신청내역</h1>
    <h4>My Page</h4>
</div>
<div class="center">
  <div id="mypage_wrap">
    <h1>내 이사/청소 <b>신청내역 확인</b> 해 보세요.</h1>
    <div class="">
      <div class="tabs2">
        <input id="all_mypage" type="radio" name="tab_item" value="all" checked="">
        <label class="tab_item_vit" for="all_mypage">전체</label>
        <input id="visit_mypage" type="radio" name="tab_item" value="visit">
        <label class="tab_item_vit" for="visit_mypage">방문견적</label>
        <input id="untact_mypage" type="radio" name="tab_item" value="untact">
        <label class="tab_item_vit" for="untact_mypage">비대면 견적</label>
        <input id="clean_mypage" type="radio" name="tab_item"value="clean">
        <label class="tab_item_vit" for="clean_mypage">입주 청소</label>


        <div class="tab_content_vit" style="display:block;">
          <ul class="mypage_odr_list" id="mypage_odr_list">
@forelse ( $data as $row )
  @if( $row->kind =='비대면')
            <li class="untact" onclick="location.href='/v1/mypage/mem_apply_ok?cmd=untact_wait&amp;hp={{$phone}}&amp;uid={{$row->uid}}'">
              <h3>{{$row->kind_title}}</h3>
              <p>신청일 : {{ \Carbon\Carbon::parse($row->reg_date)->format('Y-m-d')}}</p>
              <p>이사일 : {{ $row->mdate}}</p>
        @if( $row->d_cnt > 0 )
              <img src="/NEW/image/pop/contract_ok.png" style="width:95px;display:block;position:absolute;top:15%;right:5%">
        @else
              <dl>
                <dt>{{$row->c_cnt}}</dt>
                <dd>견적도착</dd>
              </dl>
            </li>
          @endif
  @elseif ( $row->kind =='방문')
            <li class="visit" onclick="location.href='/v1/mypage/mem_apply_ok?cmd=visit_detail&amp;hp={{$phone}}&amp;uid={{$row->uid}}' ">
              <h3>{{$row->kind_title}}</h3>
              <p>신청일 : {{ \Carbon\Carbon::parse($row->reg_date)->format('Y-m-d')}}</p>
              <p>이사일 : {{ $row->mdate}}</p>
              <dl>
                <dt>{{$row->staff_cnt}}</dt>
                <dd>업체매칭</dd>
              </dl>
            </li>
  @elseif ( $row->kind =='청소' )
            <li class="clean" onclick="location.href='/v1/mypage/mem_apply_ok?cmd=clean&amp;hp={{$phone}}&amp;uid={{$row->uid}}' ">
              <h3>{{$row->kind_title}}</h3>
              <p>신청일 : {{ \Carbon\Carbon::parse($row->reg_date)->format('Y-m-d')}}</p>
              <p>청소일 : {{ $row->mdate}}</p>
              <dl>
                <dt>{{$row->staff_cnt}}</dt>
                <dd>업체매칭</dd>
              </dl>
            </li>
  @else
    <!-- none data -->
  @endif

@empty

<li class="untact visit clean alltab emptylist" >
  <p style="margin:20px 0; font-size:0.9em;">휴대폰번호로 검색된 이사 신청내역이 없습니다.</p>
</li>
@endforelse
          </ul>
        </div>


<!-- start -->
@verbatim
<div id="untact_mypage_content">

  <div class="center3">
    <div>
      <!-- 이사 확인목록 -->
      <div class="content_Box">

        <div class="form_start">
          <div class="now_money" style="background-size: 80px;">
            <h1>
              <b>고객님</b>의 <b>평균가</b>는<br>
              <b class="corpoint">{{avg}} 원</b><br>
              입니다.
            </h1>
            <button class="my_movebtn" type="button" onclick="location.href='/main_popup/myMoveInfo.php?uid={{info.uid}}' ">내 이사정보</button>
          </div>
          <!--최대 10건이 도착합니다.-->

          <dl class="now_time">
            <dt>
              {{#if ( isEqual isover true ) }}
              <b>24시간 비대면 이사 견적 마감</b><br>견적 제안 받은 업체와 통화 상담을 진행하세요
              {{/if}}
              {{#if ( isEqual isover false ) }}
              견적 기다리는 중....<br>{{remainingCount}} 건의 <b>견적</b>이 남았습니다.
              {{/if}}
            </dt>

            <dd></dd>
          </dl>
<div id="untact_detail_list">
          <!--정렬방법-->
          <select class="mgt30 array" onChange="resort(this)">
            <option value="" >기본순</option>
            <option value="lowPrice">가격낮은순</option>
            <option value="highPrice">가격높은순</option>
            <option value="highStar">별점높은순</option>
          </select>
{{#each list}}
          <div class="my_company"> <input type="hidden" class="inputStaffUid" value="">
            <div class="mycp_pic"></div>
            <div class="cp_name_wrap">
              {{#if ( gt contracted 0 )}}
              <p class="contract_stamp"><img src="/NEW/image/pop/contract_ok.png"></p>
              {{/if}}
              <h2 id=""><b>{{s_company}}</b></h2>
              <div class="cp_name">
                <p><img src="/NEW/image/sub/rating_4.png" alt=""></p> <span>명예의 전당 {{avgstar}}점</span>
              </div>
              <div class="cp_price"><b>{{numberFormat t_pay}}</b><span>원</span></div>
              <div class="cp_arrow" onclick="javascript:location.href='/v1/mypage/mem_apply_ok?cmd=untact_detail&hp=&uid={{uid}}&s_uid={{s_uid}}' "> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                  <path fill="none" d="M0 0h24v24H0z"></path>
                  <path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"></path>
                </svg> </div> <button class="basic_btn_round mgt07" type="button" onclick="location.href='/v1/mypage/mem_apply_ok?cmd=untact_detail&hp=&uid={{uid}}&s_uid={{s_uid}}' ">상담하기</button>
            </div>
          </div>
{{/each}}
</div>
        </div>
      </div>

      <div style="text-align: left;font-size: .9em;line-height: 24px;margin: 20px auto;; font-family:'GmarketSansMedium';transform: rotate(-0.03deg);width: 95% ">
        <span>
          - <b>24시간</b> 동안 최대 <b>10건의 이사 견적 </b>을 제안 드립니다. <br>
          - <b>제안 받은 견적을 비교</b>하고 업체를 선택하세요. <br>
          - <b>계약하기 버튼 &gt; 계약서</b>를 꼭 확인하세요.<br>
          - <b>모두이사 내에서 체결된 이사 계약건에 한해 문제 발생 시 피해 최소화 중재 도움을 드립니다.</b>
        </span>
      </div>
    </div>
  </div>
</div>
@endverbatim
<!-- / end -->
      </div> <!-- /tabs2 -->




    </div>

  </div>

</div>
@endsection


@section('script')
<script>
let untact_template_compiled;
let untact_list_data;

$("document").ready( function() {
  untact_template_compiled = Handlebars.compile($("#untact_mypage_content").html());
  $("#untact_mypage_content").empty();
  untactlist(191489);
  $("input[name=tab_item]").on("change", function() {
    var val = $(this).val();
    changeSelTab(val)
  })
  @if ( $tab != '')
    $("#{{$tab}}_mypage").prop('checked', true)
    changeSelTab('{{$tab}}')
  @endif
})
function resort(sel){
 let val =   $(sel).find('option:selected').val();
 let dupData = untact_list_data
 let sortOrder

 if ( val == 'lowPrice') sortOrder = {key:'t_pay', asc : true}
 else if ( val == 'highPrice') sortOrder = {key:'t_pay', asc : false}
 else if ( val == 'highStar') sortOrder = {key:'avgstar', asc : false}

 if ( sortOrder)
 {
    let a = dupData.list.sort(function(a, b) {
     if ( a[sortOrder.key] > b[sortOrder.key] ) return (sortOrder.asc) ? 1:-1;
     else if ( a[sortOrder.key]< b[sortOrder.key] ) return (sortOrder.asc) ? -1: 1;
     else return 0
     //return a.t_pay - b.t_pay;
   });
 }
  $("#untact_mypage_content").html( untact_template_compiled( dupData ));
  return true;
}

function untactlist(id){
  $.ajax({
    type : 'get',
    url : '/v2/api/applicationHistory/nfacelist/'+id,
    contentType: 'application/json',
    dataType: 'json',
    success : function(res) {
      untact_list_data =  res.data
      untact_list_data.sortVal = '';
      $("#untact_mypage_content").html( untact_template_compiled( untact_list_data ));
    },
    error : function(xhr, status, error){

    }
});
}


function changeSelTab(val){
  $("#mypage_odr_list > li").each( function(i, e) {
    /*
    if( val =='all') $(e).removeClass('hide')
    else if( $(e).hasClass(val )) $(e).removeClass('hide')
    else $(e).addClass('hide')
    */
    if( val =='all') $(e).show('slow')
    else if( $(e).hasClass(val )) $(e).show('slow')
    else $(e).hide('slow')
  })
}
</script>
@endsection
