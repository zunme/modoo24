<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
    정보입력
  </div>
  <a class="pop-header-right" href="tel:16007728">
    <i class="fas fa-solid fa-phone-alt"></i> 1600-7728
  </a>
</div>
<div class="pop-page-step-body clean_body06">
  <div class="step-body-section">
    <div class="nface-order-auth-inner">

  <div class="nface-order-auth-ip-wrap clean_infoWrap">
    <h2>고객 정보</h2>
      <div class="nface-order-auth-ip-name">
          <input name="register_name" class="form-control-pop form-control-success" value="" tabindex="-1" placeholder="고객명을 입력해 주세요">
      </div>
      <div class="nface-order-auth-ip-phone">
          <input name="register_phone" type="number" class="form-control-pop form-control-success" value="" max="11" tabindex="-1" placeholder="전화번호를 입력해 주세요">
      </div>
  </div>
  <div class="pop-content-memo-wrap">
      <label class="title">메모</label>
      <textarea name="memo"></textarea>
  </div>
  <div class="nface-order-auth-agree-wrap checkAllFnwrap">
      <div class="form-check">
        <label class="form-check-label">
          <input class="form-check-input mfstorageignore" name="except_reset_cehck" type="checkbox" tabindex="-1" onclick="checkAllFnContact(this)">
          &nbsp;전체동의
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label chek-out-label">
          <input class="form-check-input mfstorageignore_" type="checkbox" tabindex="-1" name="agree1" value="Y">
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
        </label>
        <span class="modalpop_link2" link="/new_common/popup/accessterms.html" onclick="newmodalpop('/new_common/popup/accessterms.html')"><b>이용약관</b></span> 및
        <span class="modalpop_link2" link="/new_common/popup/personal_data.html" onclick="newmodalpop('/new_common/popup/personal_data.html')"><b>개인정보처리방침동의</b></span>
        (필수)
      </div>
      <div class="form-check">
        <label class="form-check-label chek-out-label">
          <input class="form-check-input mfstorageignore_" type="checkbox" tabindex="-1" name="agree2" value="Y">
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
        </label>
        <span class="modalpop_link1" link="/new_common/popup/personal_3.html" onclick="newmodalpop('/new_common/popup/personal_3.html')"><b>제 3 자 제공동의</b></span>(필수)
      </div>
      <div class="form-check">
        <label class="form-check-label chek-out-label">
          <input class="form-check-input mfstorageignore_" type="checkbox" tabindex="-1" name="agree_marketing" value="Y">
          <span class="form-check-sign"><span class="check"></span></span>
        </label>
        <span class="modalpop_link2" link="/new_common/popup/mkt_ok.html" onclick="newmodalpop('/new_common/popup/mkt_ok.html')"><b>마케팅동의</b></span>(선택)
      </div>
  </div>
  </div>
  <div class="clean_photo">
    <h2>사진업로드</h2>
    <div class="mf-file-container pop-content-image-uploader" data-upload-id="imagepreview_clean">
    <div class="select-moveing-picture-item upload-image-item-btn">
        <label class="upload-text-wrap">
            <div class="upload-text-txt"><b>사진 첨부</b>를 누르셔서 <b>여러장의 사진</b>을 첨부 해보세요 </div>
            <input type="file" class="mfstorageignore" id="imagepreview_clean" accept=".jpg,.jpeg,.png,.gif" multiple="multiple">
            <div class="upload-icon-wrap">
                <span class="upload-icon-pic"><img src="./images/clean_cam.png"></span> <span class="upload-icon-txt">사진 첨부 하기</span>
            </div>
        </label>
      </div>
    </div>
    <div id="clean-image-uploader-area" style="display:none"></div>
  </div>
  <div class="contact_nextBtn clean_nextBtn">
    <span class="btn btn-secondary" onclick="cleanprc(this)">청소 견적 받기</span>
  </div>
</div>
