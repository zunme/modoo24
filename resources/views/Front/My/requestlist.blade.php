@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/v1/css/community.css" />
<style>
.mypage_odr_list > li > dl {
    height: 96px;
    width: 96px;
    padding-top: 16px;
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


      </div>




    </div>
  </div>
</div>
@endsection


@section('script')
<script>
$("document").ready( function() {
  $("input[name=tab_item]").on("change", function() {
    var val = $(this).val();
    changeSelTab(val)
  })
  @if ( $tab != '')
    $("#{{$tab}}_mypage").prop('checked', true)
    changeSelTab('{{$tab}}')
  @endif
  setTimeout ( seltab , 800)
})
function seltab(){
  changeSelTab( $("input[name=tab_item]:checked").val())
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
