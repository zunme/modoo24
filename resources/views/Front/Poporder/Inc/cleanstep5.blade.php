<style>
.clean_area_wrap{
  max-width: 400px;
  margin: 0 auto;
  padding:10px;
}
.clean_area_list{
  display: flex;
  flex-wrap: wrap;
}
.clean_area_item{
  width: 100%;
  margin-bottom: 10px;

  --goods-stepper-height : 32px;
  --goods-stepper-border-radius : 5px;
  --goods-stepper-border-color:#666;
  --goods-stepper-color: #b3eaab;
  --goods-stepper-button-text-color:#666;
  --goods-stepper-button-bg-color : white;
  --goods-stepper-value-text-color: #626262;
}
.clean_area_item.noneoptioned {
    --goods-stepper-color:#999;
    --goods-stepper-border-color:#999;
    --goods-stepper-button-text-color:#999;
    --goods-stepper-button-bg-color : #bbb;
    --goods-stepper-value-text-color:gray;
}

.clean_area_contents{
  display: flex;
}
.stepper.clean_item_stepper {
    display: inline-flex;
    align-items: stretch;
    height: var(--goods-stepper-height);
    border-radius: 30px;
    border: 1px solid var(--input-line-color);
    padding: 0 5px;
    /* flex-grow: 1; */
    background-color: var(--goods-stepper-button-bg-color);
}

.stepper.clean_item_stepper .stepper-button-minus, .stepper.clean_item_stepper .stepper-button-plus {
   /* background-color: var(--goods-stepper-button-bg-color);*/
    background-color: #00beff;
    width: 30px;
    border-radius: var(--goods-stepper-border-radius);
   /* border: var(--goods-stepper-border-width, 1px) solid var(--goods-stepper-color);*/
    /*color: var(--goods-stepper-button-text-color, var(--goods-stepper-color));*/
    color: #fff;
    line-height: calc(var(--goods-stepper-height) - var(--goods-stepper-border-width, 1px) * 2);
    height: calc(var(--goods-stepper-height) - var(--goods-stepper-border-width, 1px) * 2);
    text-align: center;
    display: flex;
    justify-content: center;
    align-content: center;
    align-items: center;
    flex-shrink: 0;
    box-sizing: border-box;
    position: relative;
    cursor: pointer;
    background: transparent;
}
.stepper.clean_item_stepper .stepper-button-plus, .stepper.clean_item_stepper .stepper-button-minus {
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}

.stepper.clean_item_stepper .stepper-button-plus:after,
.stepper.clean_item_stepper .stepper-button-minus:after,
.stepper.clean_item_stepper .stepper-button-plus:before,
.stepper.clean_item_stepper .stepper-button-minus:before {
    content: '';
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background-color: var(--goods-stepper-button-text-color, var(--goods-stepper-color));
    border-radius: 2px;
}
.stepper.clean_item_stepper .stepper-button-plus:after, .stepper.clean_item_stepper .stepper-button-minus:after {
    width: 15px;
    height: 2px;background: var(--goods-stepper-color);
}
.stepper.clean_item_stepper .stepper-button-plus:before {
    height: 15px;
    width: 2px;background: var(--goods-stepper-color);
}
.stepper.clean_item_stepper .stepper-input-wrap, .stepper.clean_item_stepper .stepper-value {
    flex-shrink: 1;
    text-align: center;
    /* flex-grow: 1; */
}
.stepper.clean_item_stepper .stepper-input-wrap input {
    /* min-width: 36px; */
    width: 100px;
    color: var(--goods-stepper-value-text-color,var(--goods-stepper-color));
    font-size: 17px;
    font-weight: 500;
    text-align: center;
    border:none;
    height: calc( var(--goods-stepper-height) - ( var(--goods-stepper-border-width, 1px) * 2 ) );
    background-color: transparent;
}

.stepper.clean_item_stepper .stepper-option-add-col{
  line-height: 24px;
  font-size: 0px;
  height: 30px;
  margin-top: 2px;
  cursor:pointer;
}
.stepper.clean_item_stepper .stepper-option-add-col i{
  color: #999;
  font-size: 24px;
  margin-bottom: 0;
  line-height: 24px;
}

.clean_no_option_wrap{
  min-width: 100px;
  display: flex;
  justify-content: end;
}
.clean_no_option_wrap input {display:none;}
.clean_no_option_wrap_text{
  display: flex;
  height: 30px;
  line-height: 30px;
  align-items: center;
}

.icon-checkbox{
  flex-shrink: 0;
  border: 1px solid #b3eaab;
  width: 15px;
  height: 15px;
  border-radius: 2px;
  box-sizing: border-box;
  display: inline-block;
  line-height: 15px;
  margin-right: 5px;
  position: relative;
}
.icon-checkbox:before{
  font-family: "Font Awesome 5 Free";
  font-size: 10px;
  content: "\f00c";
  display: inline-block;
  padding-right: 3px;
  vertical-align: middle;
  font-weight: 900;
  position: absolute;
  top: -1px;
  left: 0;
  color: #fff;
  opacity: 0;
}
.clean_no_option_wrap label input[type='checkbox']:checked+div.clean_no_option_wrap_text i.icon-checkbox{
  border-color: #005628;
  background-color: #005628;
}
.clean_no_option_wrap label input[type='checkbox']:checked+div.clean_no_option_wrap_text i.icon-checkbox:before{
  opacity: 1;
}
.clean_no_option_wrap_text > span.label-text{
color:#333;
}
</style>
<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
    청소장소
  </div>
  <a class="pop-header-right" href="tel:16007728">
    <i class="fas fa-solid fa-phone-alt"></i> 1600-7728
  </a>
</div>
<div class="pop-page-step-body clean_body05">
  <div class="step-body-section">

    <div class="clean_area_wrap">
      <h2>* 청소 장소 정보를 입력해 주세요.</h2>
      <div class="clean_area_list">

        <div class="clean_area_item">
          <h3>방 갯수</h3>
          <div class="clean_area_contents">
            <div class="stepper stepper-init clean_item_stepper">
              <div class="stepper-button-minus"></div>
              <div class="stepper-input-wrap">
                <input type="number" minlength="0" maxlength="99" step="1" value="1" name="room_num" data-min='1' readonly>
              </div>
              <div class="stepper-button-plus"></div>
            </div>
            <div class="clean_no_option_wrap">
              <label>
                <input type="checkbox" name="room_except" value='Y' onChange="cleanoptionNocheck(this)">
                <div class="clean_no_option_wrap_text">
                  <i class="icon icon-checkbox"></i>
                  <span class="label-text">청소안함</span>
                </div>
              </label>
            </div>
          </div>
        </div>

        <div class="clean_area_item">
          <h3>화장실 갯수</h3>
          <div class="clean_area_contents">
            <div class="stepper stepper-init clean_item_stepper">
							<div class="stepper-button-minus"></div>
							<div class="stepper-input-wrap">
								<input type="number" minlength="0" maxlength="99" step="1" value="1" name="toilet_num" data-min='1' readonly>
							</div>
							<div class="stepper-button-plus"></div>
	          </div>
            <div class="clean_no_option_wrap">
              <label>
                <input type="checkbox" name="toilet_except" value='Y' onChange="cleanoptionNocheck(this)">
                <div class="clean_no_option_wrap_text">
                  <i class="icon icon-checkbox"></i>
                  <span class="label-text">청소안함</span>
                </div>
              </label>
            </div>
          </div>
        </div>

        <div class="clean_area_item">
          <h3>베란다 갯수</h3>
          <div class="clean_area_contents">
            <div class="stepper stepper-init clean_item_stepper">
							<div class="stepper-button-minus"></div>
							<div class="stepper-input-wrap">
								<input type="number" minlength="0" maxlength="99" step="1" value="1" name="veranda_num" data-min='1' readonly>
							</div>
							<div class="stepper-button-plus"></div>
	          </div>
            <div class="clean_no_option_wrap">
              <label>
                <input type="checkbox" name="veranda_except" value='Y' onChange="cleanoptionNocheck(this)">
                <div class="clean_no_option_wrap_text">
                  <i class="icon icon-checkbox"></i>
                  <span class="label-text">청소안함</span>
                </div>
              </label>
            </div>
          </div>
        </div>

      </div>

      <div class="clean_address">
        <h2>* 주소를 입력해 주세요.</h2>
        <div class="form-group-pop has-icon has-success">
          <input type="text" value="" class="form-control-pop form-control-success" name="s_addr1" required="required" placeholder="주소 검색" readonly onclick="getAddress( startCleanAddress );">
        </div>
        <div class="form-group-pop has-icon has-success">
          <input type="text" value="" class="form-control-pop" name="s_addr2" required="required" placeholder="상세 주소 입력 (동/호수)">
        </div>
        <div class="clean_address_info">
          <div class="col">
            <div class="input-group new-input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <span>평수</span>
                </span>
              </div>
              <input type="number" name="s_pyeong" min="0" class="form-control-pop text-align-right" placeholder="평수">
              <div class="input-group-append">
                <span class="input-group-text">
                  <span>평</span>
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="input-group new-input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <span>층수</span>
                </span>
              </div>
              <input type="number" name="s_floor" min="0" class="form-control-pop text-align-right" placeholder="층수">
              <div class="input-group-append">
                <span class="input-group-text">
                  <span>층</span>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <div class="contact_nextBtn clean_nextBtn">
    <span class="btn btn-secondary" onclick="gotoCleanNextStep(this)">다음</span>
  </div>
</div>
<script>
function cleanoptionNocheck(btn){
  //$(btn).closest('.clean_area_contents').find("input['type=checkbox']")
  if( $(btn).prop("checked")){
    $(btn).closest('.clean_area_item').addClass("noneoptioned")
    $(btn).closest('.clean_area_item').find('.stepper-init').addClass("stepper-disabled")
    $(btn).closest('.clean_area_item').find('input').prop('readonly', true)
  }else {
    $(btn).closest('.clean_area_item').removeClass("noneoptioned")
    $(btn).closest('.clean_area_item').find('.stepper-init').removeClass("stepper-disabled")
    $(btn).closest('.clean_area_item').find('input').prop('readonly', true)
  }
}
</script>
