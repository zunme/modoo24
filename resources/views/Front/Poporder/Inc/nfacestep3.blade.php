<style>
.select-moveing-type-body-inner.flex-row{
  --f7-cols-per-row: 2;
}
.step-radio-label{
  display: flex;
  align-items: center;
  align-self: center;
  padding: 15px;
  background-color: #ffb236;
  color: white;
  border-radius: 10px;
  min-height: 76px;
  margin-left: 5px;
  margin-right: 5px;
}
.step-radio-label-text{
  display: flex;
  flex-direction: column;
  align-self: center;
  flex-grow: 1
}
.step-radio-label-text-item{
  margin-top: 5px;
}
.step-radio-label-text-item:last-child{
  margin-bottom: 5px;
}

.step-radio-label .step-radio-label-check{
  font-size: 28px
}
.step-radio-label .step-radio-label-check i.fas{
  color:silver;
}
.step-radio:checked~.step-radio-label-check i.fas{
  color:#1e9af9;
}

.step-radio-label .circle {
  position: relative;
  display: block;
  transition-duration: .2s;
  border: 1px solid rgba(0,0,0,.3);
  height: 15px;
  width: 15px;
  border-radius: 100%;
  background-color: rgba(0,0,0,.05);
}
.step-radio-label .step-radio:checked:checked~.circle {
    border-color: white;
}
.step-radio-label .circle .check {
    display: block;
    position: absolute;
    left: -1px;
    top: -1px;
    transition-duration: .2s;
    height: 15px;
    width: 15px;
    border-radius: 100%;
    background-color: white;
    transform: scale3d(0,0,0);
}
.step-radio:checked~.circle .check {
    transform: scale3d(.65,.65,1);
}

.select-moveing-type-body-sub{
  display: none;
}
.select-moveing-type-body-sub .step-onoff-wrap{
  width: 100%;
}
.select-moving-goods{
  display:none;
}
</style>


<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
      이사종류 / 짐량확인
  </div>
</div>
<div class="pop-page-step-body">
  <div class="step-body-section">

    <div class="pop-content-wrap select-moveing-type">
      <div class="select-moveing-type-wrap">
        <div class="select-moveing-type-head">
          <span>이사종류</span>
        </div>
        <div class="select-moveing-type-body">
          <div class="select-moveing-type-body-inner flex-row flex-direction-column">

            <div class="flex-row w-100 select-moveing-type-items select-moving-type-first">
              <div class=" flex-col select-moveing-type-item">
                <label class="step-radio-label">
                  <div class="step-radio-label-text">
                    <div class="step-radio-label-text-item">소형이사</div>
                    <div class="step-radio-label-text-item label-text-item-detail">(예 : 원룸 )</div>
                  </div>
                  <input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="small" onChange="nfacestep3showing()">

                  <span class="step-radio-label-check"><i class="fas fa-house-user"></i></span>
                </label>
              </div>
              <div class=" flex-col select-moveing-type-item">
                <label class="step-radio-label">
                  <div class="step-radio-label-text">
                    <div class="step-radio-label-text-item">가정이사</div>
                    <div class="step-radio-label-text-item label-text-item-detail">(예 : 아파트 )</div>
                  </div>
                  <input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="home" onChange="nfacestep3showing()">

                  <span class="step-radio-label-check"><i class="fas fa-home"></i></span>

                </label>
              </div>
              <div class=" flex-col select-moveing-type-item">
                <label class="step-radio-label">
                  <div class="step-radio-label-text">
                    <div class="step-radio-label-text-item">사무실이사</div>
                  </div>
                  <input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="office" onChange="nfacestep3showing()">

                  <span class="step-radio-label-check"><i class="fas fa-building"></i></span>
                </label>
              </div>
            </div>

            <div class="flex-row w-100 select-moveing-type-items select-moving-type-second">
              <div class="flex-col select-moveing-type-item">
                <label class="step-radio-label">
                  <div class="step-radio-label-text">
                    <div class="step-radio-label-text-item">포장이사</div>
                  </div>
                  <input type="radio" class="step-radio select-moveing-radio" name="movingmethod" value="packaging">

                  <span class="circle">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="flex-col select-moveing-type-item">
                <label class="step-radio-label">
                  <div class="step-radio-label-text">
                    <div class="step-radio-label-text-item">반포장이사</div>

                  </div>
                  <input type="radio" class="step-radio select-moveing-radio" name="movingmethod" value="half-packaging">

                  <span class="circle">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="flex-col select-moveing-type-item">
                <label class="step-radio-label">
                  <div class="step-radio-label-text">
                    <div class="step-radio-label-text-item">일반이사</div>
                    <div class="step-radio-label-text-item label-text-item-detail">(운반만)</div>
                  </div>
                  <input type="radio" class="step-radio select-moveing-radio" name="movingmethod" value="carrying">

                  <span class="circle">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
            </div>

          </div>

        </div>


        <div class="select-moveing-type-body-sub">

          <div class="step-onoff-wrap">
              <div class="input-toggle-wrap">
                <div class="input-toggle-line">무거운 짐(가전,가구 등)을 함께 옮겨 주실수 있나요?</div>
                <div class="togglebutton texttoggle">
                  <label>
                    <input type="checkbox" name="s_help_no" checked="" data-to="s_help_no">
                    <span class="toggle">
                      <span class="toggle-avail-label" data-off="NO" data-on="YES"></span>
                    </span>
                  </label>
                </div>

              </div>
            </div>

        </div>

      </div>

    </div>
  </div>
<!-- / 이사종류 -->

  <div class="step-body-section">
    <div class="pop-content-wrap select-moveing-type">
      <div class="select-moveing-type-wrap">
        <div class="select-moveing-type-head">
          <span>이삿짐 확인</span>
        </div>
        <div class="select-moveing-type-body">

          <div class="select-moveing-type-body-inner flex-row justify-content-center">

            <div class="col-50 select-moveing-type-items select-moving-goods select-moving-goods-first">
              <div class="select-moveing-type-item">
                <label class="step-radio-label">
                  <div class="step-radio-label-text">
                    <div class="step-radio-label-text-item">리스트로</div>
                    <div class="step-radio-label-text-item">짐량확인</div>
                  </div>
                  <!-- 짐량확인은 picture or list -->
                  <input type="radio" class="step-radio select-moveing-radio" name="moving-goods-method" value="list" onChange="changeNfaceGoodsMethod()">

                  <span class="circle">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
            </div>

            <div class="col-50 select-moveing-type-items select-moving-goods select-moving-goods-second">
              <div class="select-moveing-type-item">
                <label class="step-radio-label">
                  <div class="step-radio-label-text">
                    <div class="step-radio-label-text-item">사진으로</div>
                    <div class="step-radio-label-text-item">짐량확인</div>
                  </div>
                  <!-- 짐량확인은 picture or list -->
                  <input type="radio" class="step-radio select-moveing-radio" name="moving-goods-method" value="picture" onChange="changeNfaceGoodsMethod()">

                  <span class="circle">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="pop-page-step-footer">
    <span class="btn btn-secondary" onclick="gotoNextStep()">다음</span>
  </div>

</div>
<script>
/*
  changeNfaceGoodsMethod : stpep4에 있음
*/
function nfacestep3showing(){
  var movingtype = $("input[name=movingtype]:checked").val()
  if( movingtype == 'small'){
    $(".select-moveing-type-body-sub").show();
    $(".select-moving-goods").show();
  }
  else if ( movingtype == 'office' ){
    $(".select-moveing-type-body-sub").hide();
    $(".select-moving-goods").show();
  }else if ( movingtype == 'home'){
    $(".select-moveing-type-body-sub").hide();
    $(".select-moving-goods-first").hide();
    $(".select-moving-goods-second").show();
    if( $("input:radio[name ='moving-goods-method']:checked").val() !='picture'){
      $("input:radio[name ='moving-goods-method']:input[value='picture']").prop("checked", true);
      changeNfaceGoodsMethod()
    }
  }
}

$("document").ready(function() {
  $("body").on("stepPopOpended", function() {
    nfacestep3showing();
    changeNfaceGoodsMethod();
  })
})
</script>
