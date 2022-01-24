<style>
.nface-order-auth-wrap .form-check .form-check-label.chek-out-label span {
    top: -7px;
}
.swal2-container {
  z-index: 106000;
}
.swal2-styled.swal2-confirm{background-color: #00beff;} 
.swal2-icon.swal2-success .swal2-success-ring { border: 0.25em solid rgba(0,190,255,.3);}
.swal2-icon.swal2-success [class^=swal2-success-line] {background-color: #00beff;}    
</style>
<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
      정보입력
  </div>
</div>
<div class="pop-page-step-body">

  <div class="step-body-section">
    <div class="pop-content-wrap nface-order-auth-wrap">
      <div class="nface-order-auth-inner">

         <div class="nface-order-auth-ip-wrap">
            <div class="nface-order-auth-ip-name">
              <input name="register_name" class="form-control-pop form-control-success" value="" placeholder="고객명을 입력해 주세요">
            </div>
            <div class="nface-order-auth-ip-phone">
              <input name="register_phone" type="number" class="form-control-pop form-control-success" value="" max="11"  placeholder="전화번호를 입력해 주세요">
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
              <span class="modalpop_link" link="/new_common/popup/accessterms.html"><b>이용약관</b></span>
               및
              <span class="modalpop_link" link="/new_common/popup/personal_data.html"><b>개인정보처리방침</b></span>
              동의 필수
            </div>
            <div class="form-check">
              <label class="form-check-label chek-out-label">
                <input class="form-check-input mfstorageignore" type="checkbox" name="agree2" value="Y">
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
                <span class="modalpop_link" link="/new_common/popup/personal_3.html"><b>제 3 자 제공동의</b></span>(필수)
            </div>
            <div class="form-check">
              <label class="form-check-label chek-out-label">
                <input class="form-check-input mfstorageignore" type="checkbox" name="agree_marketing" value="Y">
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
              <span class="modalpop_link" link="/new_common/popup/mkt_ok.html"><b>마케팅동의</b></span>(선택)
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
     inpopupClearAll()
       Swal.fire({
        icon:'success',
        title: "<div class='inpoporderSuccessTitle'>견적신청완료</div>",
        html: "<div class='inpoporderSuccessBody'><p>실시간 이사 견적을</p><p><b>알림톡(문자)</b>으로 확인하세요</p></div>",
        confirmButtonText: "확인",
      }).then((result) => {
        inpopupClearAll()
      })
   },
   error: function ( res ){
     ajaxErrorST(res )
       if( typeof res.responseJSON.data != 'undefined' && typeof res.responseJSON.data.step != 'undefined'){
         resetNowStep(res.responseJSON.data.step)
       }
     }
     ,
     complete : function() {
       inPopLoaderClose()
     }
   }
 );
}
function inpopupClearAll(){
   mfform.clearInpusts()
   $(".ordergoods-item-options-str").empty()
   $(".pop-page-step").removeClass("step-avail-open").removeClass("step-opened").removeClass("step-opened").removeClass("step-last-call")
   $("#popn_step_1").addClass("step-last-call")
   $(".top-steps-wrap > div").removeClass("top-step-ing").removeClass("top-step-done")
   $(".top-steps-wrap > div:first-child").addClass("top-step-ing")
   $("#inpopup-inline-progressbar").css('transform', 'translate3d(-100%,0,0)')
   pop_step_availMax = 1
   pop_step_open = 1
   closepopnbtn()
   localStorage.removeItem('pop-page-form-nface')
}
function testSuccess(){
  Swal.fire({
   icon:'success',
   title: "<div class='inpoporderSuccessTitle'>견적신청완료</div>",
   html: "<div class='inpoporderSuccessBody'><p>실시간 이사 견적을</p><p><b>알림톡(문자)</b>으로 확인하세요</p></div>",
   confirmButtonText: "확인",
 })
}
</script>
