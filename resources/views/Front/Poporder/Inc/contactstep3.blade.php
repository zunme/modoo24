<div class="pop-page-step-header contact_header">
  <div class="pop-page-step-header-inner">
    출발지/도착지
  </div>
  <a class="pop-header-right" href="tel:16007728">
    <i class="fas fa-solid fa-phone-alt"></i> 1600-7728
  </a>
</div>
<div class="pop-page-step-body">
  <div class="step-body-section contact_step03">

    <div><i class="fas fa-map-marked-alt"></i>출발지</div>

    <input type="hidden" name="s_bcode" />
    <input type="hidden" name="s_sigunguCode" />
    <input type="hidden" name="s_jibun_addr1" />
    <input type="hidden" name="s_zip1" />

    <input type="text" value="" class="contact_step03_address"
        name="s_addr1" required="required" placeholder="출발지 주소 검색" readonly="" onclick="getAddress( startContractAddress );" />
    <input type="text" value="" class="contact_step03_address" name="s_addr2" required="required" placeholder="상세 주소 입력 (동/호수)" />

  <div class="togglebutton texttoggle">
    <label>
      <input type="checkbox" name="use_container" value="Y" />보관이사
      <span class="toggle">
        <span class="toggle-avail-label" data-off="NO" data-on="YES"></span>
      </span>
    </label>
  </div>






    <div class="contact_step03_destination"><i class="fas fa-map-marked"></i>도착지</div>
    <input type="hidden" name="e_bcode" />
    <input type="hidden" name="e_sigunguCode" />
    <input type="hidden" name="e_jibun_addr1" />
    <input type="hidden" name="e_zip1" />

    <input type="text" value="" class="contact_step03_address" name="e_addr1" required="required" placeholder="도착지 주소 검색" readonly="" onclick="getAddress(endContractAddress);" />


    <div class="togglebutton texttoggle">
      <label>
        <input type="checkbox" name="use_clean" value="Y" />입주청소
        <span class="toggle">
          <span class="toggle-avail-label" data-off="NO" data-on="YES"></span>
        </span>
      </label>
    </div>

    <div class="togglebutton texttoggle">
      <label>
        <input type="checkbox" name="internet_call" value="Y" checked />인터넷이전 혜택상담
        <span class="toggle">
          <span class="toggle-avail-label" data-off="NO" data-on="YES"></span>
        </span>
      </label>
    </div>

    <div class="togglebutton texttoggle">
      <label>
        <!--<input type="checkbox" name="interior_call" value="Y" />인테리어 상담-->
        <input type="checkbox" name="aircon_yn" value="Y" />에어컨 설치 및 A/S 상담
        <span class="toggle">
          <span class="toggle-avail-label" data-off="NO" data-on="YES"></span>
        </span>
      </label>
    </div>




  </div>
  <div class="contact_nextBtn">
    <span class="btn btn-secondary" onclick="gotoContactNextStep(this)">다음</span>
  </div>
</div>
