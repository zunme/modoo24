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
                    <span class="btn btn-outerline-primary" onClick="review({{$row->uid}},'{{$row->kindtype}}')">이사업체평가</span>
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

@endsection

@section('script')
<script>
function review(id, kindtype){
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
function drawCompany(data){
  console.log (data);
}
</script>
@endsection
