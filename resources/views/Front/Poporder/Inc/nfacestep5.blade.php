<style>
.nface-order-auth-wrap .form-check .form-check-label.chek-out-label span {
    top: -7px;
}


#nfacepoploader{
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgb(0 0 0 / 80%);
  z-index: 510;
  display: none;
}
#nfacepoploader.loading{
  display: block;
}
#nfacepoploader .nfacepoploader-wrapper {
    position: absolute;
    width: 200px;
    height: 2px;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    margin: auto;
}
.nfacepoploader-loader {
  height: 100%;
  display: flex;
  transform: translateZ(0);
}
.nfacepoploader-loader div {
  flex: 1;
  background: salmon;
  -webkit-animation: nfacepoploadergo 0.8s infinite alternate ease;
          animation: nfacepoploadergo 0.8s infinite alternate ease;
  box-shadow: 0 0 20px salmon;
}
.nfacepoploader-loader div:nth-child(1) {
  -webkit-animation-delay: -0.72s;
          animation-delay: -0.72s;
}
.nfacepoploader-loader div:nth-child(2) {
  -webkit-animation-delay: -0.64s;
          animation-delay: -0.64s;
}
.nfacepoploader-loader div:nth-child(3) {
  -webkit-animation-delay: -0.56s;
          animation-delay: -0.56s;
}
.nfacepoploader-loader div:nth-child(4) {
  -webkit-animation-delay: -0.48s;
          animation-delay: -0.48s;
}
.nfacepoploader-loader div:nth-child(5) {
  -webkit-animation-delay: -0.4s;
          animation-delay: -0.4s;
}
.nfacepoploader-loader div:nth-child(6) {
  -webkit-animation-delay: -0.32s;
          animation-delay: -0.32s;
}
.nfacepoploader-loader div:nth-child(7) {
  -webkit-animation-delay: -0.24s;
          animation-delay: -0.24s;
}
.nfacepoploader-loader div:nth-child(8) {
  -webkit-animation-delay: -0.16s;
          animation-delay: -0.16s;
}
.nfacepoploader-loader div:nth-child(9) {
  -webkit-animation-delay: -0.08s;
          animation-delay: -0.08s;
}
.nfacepoploader-loader div:nth-child(10) {
  -webkit-animation-delay: 0s;
          animation-delay: 0s;
}

@-webkit-keyframes nfacepoploadergo {
  100% {
    background: transparent;
    flex: 10;
    box-shadow: 0 0 0 transparent;
  }
}

@keyframes nfacepoploadergo {
  100% {
    background: transparent;
    flex: 10;
    box-shadow: 0 0 0 transparent;
  }
}
</style>
<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
      step4
  </div>
</div>
<div class="pop-page-step-body">

  <div class="step-body-section">
    <div class="pop-content-wrap nface-order-auth-wrap">
      <div class="nface-order-auth-inner">

          <div class="">
            <div class="">
              <label>이름</label>
              <input name="register_name" value="">
            </div>
            <div class="">
              <label>전화번호</label>
              <input name="register_phone" value="">
            </div>
          </div>

          <div class="nface-order-auth-agree-wrap checkAllFnwrap">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input mfstorageignore" type="checkbox" onClick="checkAllFn(this)">
                전체동의
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label chek-out-label">
                <input class="form-check-input mfstorageignore" type="checkbox" name="agree1" value="Y">
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
              <span class="modalpop_link color_pt" link="/new_common/popup/accessterms.html">이용약관</span>
               및
              <span class="modalpop_link color_pt" link="/new_common/popup/personal_data.html">개인정보처리방침</span>
              동의 필수
            </div>
            <div class="form-check">
              <label class="form-check-label chek-out-label">
                <input class="form-check-input mfstorageignore" type="checkbox" name="agree2" value="Y">
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
              <span class="modalpop_link color_pt" link="/new_common/popup/personal_3.html">제 3 자 제공동의</span>(필수)
            </div>
            <div class="form-check">
              <label class="form-check-label chek-out-label">
                <input class="form-check-input mfstorageignore" type="checkbox" name="agree_marketing" value="Y">
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
              <span class="modalpop_link color_pt" link="/new_common/popup/mkt_ok.html">마케팅동의</span>(선택)
            </div>

          </div>

        </div>

    </div>
  </div>

  <div class="pop-page-step-footer">
    <div style="display:none" id="nface-image-uploader-area"><!-- INPUT AREA 지우지 마세요--></div>
    <span class="btn btn-secondary" onclick="nfaceOrderFormPrc()">신청</span>
  </div>

</div>


<script>
function createLoader(){
  if( $("#nfacepoploader").length < 1){
    var loaderwrap = $('<div>', {
          id: 'nfacepoploader',
        }).prependTo( "#popnmodal" );
    $(loaderwrap).html("<div class='nfacepoploader-wrapper'><div class='nfacepoploader-loader'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>")
  }
}
function checkAllFn(chk){
  var checked = $(chk).prop('checked')
  var inp = $(chk).closest('.checkAllFnwrap').find('input[type=checkbox]')
  console.log (inp)
  $(inp).each( function (i, v){
    $(v).prop('checked', checked)
  })
}

function nfaceOrderFormPrc(){
  inPopLoaderOpen()
  $("#nface-image-uploader-area").empty()
  if( $("input[name='moving-goods-method']:checked").val() =='picture'){
    movingimage.setInputByResize({inputName:'upload', target:'#nface-image-uploader-area'})
  }

  $.ajax({
   url:'/v2/order/nface/complete',
   method:"POST",
   data:new FormData( document.getElementById('pop-page-form') ),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(res)
   {

   },
   error: function ( err ){
       ajaxErrorST(err)
     }
     ,
     complete : function() {
       inPopLoaderClose()
     }
   }
 );
}
</script>
