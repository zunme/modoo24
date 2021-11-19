@extends('layouts.modoo')

@section('css')
<!-- top -->
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
</style>
<!-- / top -->

<style>
.form-check {
  display: inline-block;
}
input:read-only, input:-moz-read-only{
  border:none !important;
}
input.read-only{
  border:none !important;
}
</style>

<!-- 별점 박스 -->
<style>
.rating-box{
  display: flex;
}
.ratingrow{
  display: flex;
  flex-wrap: wrap;
  max-width: 940px;
}
.item-wrap,.item-inner{display: flex;}
.item-title{width:100px;display: flex;
    align-items: center;}
.item-inner,.item-input-wrap{flex-grow: 1}
.ratingrow-item{display: flex;}
.ratingrow-item{
  padding: 0 40px 0 0;
}
.rating-item-title{
  width: 66px;
  display: flex;
  align-self: center;
}
</style>

<!-- 별점 -->
<style>
.rating-half {
  border: none;
  float: left;
}

.rating-half > input { display: none; }
.rating-half > label:before {
  margin: 5px;
  font-size: 33px;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating-half > .half-star:before {
  content: "\f089";
  position: absolute;
}

.rating-half > label {
  color: #E1E6F6;
 float: right;
}
.rating-half > label.full-star{
  text-shadow: 3px 4px 5px rgb(0 0 0 / 30%);
}
.rating-half > input:checked ~ label,
.rating-half:not(:checked) > label:hover,
.rating-half:not(:checked) > label:hover ~ label { color: #34AC9E;  }

.rating-half > input:checked + label:hover,
.rating-half > input:checked ~ label:hover,
.rating-half > label:hover ~ input:checked ~ label,
.rating-half > input:checked ~ label:hover ~ label { color: #34AC9E;  }
</style>

<!-- 파일첨부 -->
<style>
.custom-file-container {
    box-sizing: border-box;
    position: relative;
    display: block
}

.custom-file-container__custom-file {
    box-sizing: border-box;
    position: relative;
    display: inline-block;
    width: 84px;
    height: calc(2.25rem + 2px);
    margin-bottom: 0;
    margin-top: 5px
}

.custom-file-container__custom-file:hover {
    cursor: pointer
}

.custom-file-container__custom-file__custom-file-input {
    box-sizing: border-box;
    min-width: 80px;
    width: 80px;
    max-width: 100%;
    height: calc(2.25rem + 2px);
    margin: 0;
    opacity: 0
}

.custom-file-container__custom-file__custom-file-input:focus ~ span {
    outline: 1px dotted #212121;
    outline: 5px auto -webkit-focus-ring-color
}

.custom-file-container__custom-file__custom-file-control {
    box-sizing: border-box;
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 5;
    height: calc(2.25rem + 2px);
    padding: .5rem .75rem;
    overflow: hidden;
    line-height: 1.5;
    color: #333;
    user-select: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c0c0af;
    border-radius: .25rem
}

.custom-file-container__custom-file__custom-file-control__button {
    box-sizing: border-box;
    position: absolute;
    top: 0;
    right: 0;
    z-index: 6;
    display: block;
    height: calc(2.25rem + 2px);
    padding: .5rem .75rem;
    line-height: 1.25;
    color: #333;
    background-color: #EDEDE8;
    border-left: 1px solid #c0c0af;
    box-sizing: border-box
}
  .custom-file-container__image-multi-preview {
    position: relative;
    box-sizing: border-box;
    transition: all 0.2s ease;
    border-radius: 6px;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    float: left;
    margin: 20px;
    width: 130px;
    height: 90px;
    box-shadow: 0 4px 10px 0 rgb(51 51 51 / 25%);
  }
  .custom-file-container__image-multi-preview__single-image-clear {
      right: -6px;
      background: #EDEDE8;
      position: absolute;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      text-align: center;
      margin-top: -6px;
      box-shadow: 0 4px 10px 0 rgba(51,51,51,0.25);
  }
  .custom-file-container__image-multi-preview__single-image-clear__icon {
      color: #6a6a53;
      display: block;
      margin-top: -2px;
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



<form id="reviewform">
  <input type="hidden" name="b_worker_idx" value="{{$staff->s_uid}}">
  <input type="hidden" name="type" value="{{$type}}">
  <input type="hidden" name="uid" value="{{$uid}}">

  <input type="hidden" name="b_star_pro" value="0">
  <input type="hidden" name="b_star_kind" value="0">
  <input type="hidden" name="b_star_price" value="0">
  <input type="hidden" name="b_star_finish" value="0">
  <input type="hidden" name="b_star_expost" value="0">
  <input type="hidden" name="b_star_pave" value="0">

  <input type="hidden" name="review_type" id="review_type" value="">

  <div class="content-body">

    <div class="item-wrap">
      <div class="item-inner">
        <div class="item-title item-floating-label">고객명</div>
        <div class="item-input-wrap">
          <input type="text" name="b_name" value="{{$row->name}}" class="read-only" readonly>
        </div>
      </div>

      <div class="item-inner">
        <div class="item-title item-floating-label">이사일</div>
        <div class="item-input-wrap">
          <input type="text" name="b_mdate" value="{{$row->mdate}}" class="read-only" readonly>
        </div>
      </div>
    </div>

    <div class="item-wrap">
      <div class="item-inner">
        <div class="item-title item-floating-label">연락처</div>
        <div class="item-input-wrap">
          <input type="text" name="b_hp" value="{{$userdata['phone']}}" class="read-only" readonly>
        </div>
      </div>

      <div class="item-inner">
        <div class="item-title item-floating-label">이사업체명</div>
        <div class="item-input-wrap">
          <input type="text" value="{{$row->s_company1}}" class="read-only" readonly>
        </div>
      </div>
    </div>

    <div class="item-wrap">
      <div class="item-inner">
        <div class="item-title item-floating-label">서비스종류</div>
        <div class="item-input-wrap">
          <input type="text" value="{{ ( $type=="order" ? "방문견적 이사" : "비대면" ) }}" class="read-only" readonly>
        </div>
      </div>

      <div class="item-inner">
        <div>모두이사 재이용 의사</div>
        <div class="">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="b_re_use" id="b_re_use1" value="Y" checked="">
                예
                <span class="circle">
                  <span class="check"></span>
                </span>
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="b_re_use" id="b_re_use2" value="N">
                아니요
                <span class="circle">
                  <span class="check"></span>
                </span>
              </label>
            </div>
          </div>
      </div>

    </div>




      <div class="item-wrap">
        <div class="item-inner">
          <div class="item-title item-floating-label">별점</div>
          <div class="rating-box">
            <div class="ratingrow">

              <div class="ratingrow-item">
                <div class="rating-item-title">전문성</div>
                @include('Front.Review.ratinghalf',['ratingType'=>'pro'])
              </div>

              <div class="ratingrow-item">
                <div class="rating-item-title">가격도</div>
                @include('Front.Review.ratinghalf',['ratingType'=>'price'])
              </div>

              <div class="ratingrow-item">
                <div class="rating-item-title">사후관리</div>
                @include('Front.Review.ratinghalf',['ratingType'=>'expost'])
              </div>

              <div class="ratingrow-item">
                <div class="rating-item-title">친절성</div>
                @include('Front.Review.ratinghalf',['ratingType'=>'kind'])
              </div>

              <div class="ratingrow-item">
                <div class="rating-item-title">마무리</div>
                @include('Front.Review.ratinghalf',['ratingType'=>'finish'])
              </div>

              <div class="ratingrow-item">
                <div class="rating-item-title">포장도</div>
                @include('Front.Review.ratinghalf',['ratingType'=>'pave'])
              </div>
            </div>

          </div>
        </div>
      </div>


    <div>
      <div class="item-inner">
        <div class="item-title item-floating-label">내용</div>
        <div class="item-input-wrap">
          <textarea name="b_note"></textarea>
        </div>
      </div>
    </div>


    <div>
      <div class="item-inner">
        <div class="item-title item-floating-label">파일첨부</div>
        <div class="item-input-wrap">

          <div class="custom-file-container" data-upload-id="myUniqueUploadId">

              <label class="custom-file-container__custom-file">
                  <input type="file" class="custom-file-container__custom-file__custom-file-input" name="upload[]" accept="jpg,png" multiple aria-label="Choose File" />
                  <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                  <span class="custom-file-container__custom-file__custom-file-control"></span>
              </label>
              <label>
                  <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image" >전체삭제</a>
              </label>
              <div class="custom-file-container__image-preview"></div>
          </div>

        </div>
      </div>
    </div>



  </div>
</form>


<div>
  <div>
    <span class="btn btn-success" onClick="review_prc('compliment')">칭찬후기 등록</span>
    <span class="btn btn-warning" onClick="review_prc('inconvenience')">불편신고 등록</span>
  </div>
</div>

  </div>
</div>


@endsection

@section('script')
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>

<script>
var upload;
$("document").ready( function() {
  $("input.rating-radio-half").on( "click", function(e){
    let val = $(e.target).val();
    let rtype = $(e.target).closest(".rating-half").data("ratingtype");
    $("input[name="+rtype+"]").val( val )
  })

  upload = new FileUploadWithPreview("myUniqueUploadId",{
    options : {
      maxFileCount:4,
    }
  });
  upload.options.maxFileCount = 4;
  upload.options.text.selectedCount = "개 선택"
})
function review_prc(type) {
  $("#review_type").val(type);
  $.ajax({
  url : '/community/refresh',
  method:"get",
  dataType:'JSON',
  success:function(result){
    $('meta[name="csrf-token"]').attr('content', result.token);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': result.token
          }
      });
      $.ajax({
        url:"/v2/review/write/"+type,
        method:"POST",
        data:new FormData( document.getElementById('reviewform') ),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(res)
        {
          console.log (res )
        },
        error: function ( err ){
          ajaxErrorST(err)
        }
      });
  }
});
}
</script>
@endsection
