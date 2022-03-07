<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
    출발지/도착지
  </div>
</div>
<div class="pop-page-step-body">
  <div class="step-body-section">

    <div>출발지</div>

    <input type="hidden" name="s_bcode" />
    <input type="hidden" name="s_sigunguCode" />
    <input type="hidden" name="s_jibun_addr1" />
    <input type="hidden" name="s_zip1" />

    <input type="text" value="" class=""
        name="s_addr1" required="required" placeholder="출발지 주소 검색" readonly="" onclick="getAddress( startContractAddress );" />
    <input type="text" value="" class="" name="s_addr2" required="required" placeholder="상세 주소 입력 (동/호수)" />

    <label>
      <input type="checkbox" name="use_container" value="Y" />보관이사
    </label>






    <div>도착지</div>
    <input type="hidden" name="e_bcode" />
    <input type="hidden" name="e_sigunguCode" />
    <input type="hidden" name="e_jibun_addr1" />
    <input type="hidden" name="e_zip1" />

    <input type="text" value="" class="" name="e_addr1" required="required" placeholder="도착지 주소 검색" readonly="" onclick="getAddress(endContractAddress);" />


    <label>
      <input type="checkbox" name="use_clean" value="Y" />입주청소
    </label>

    <label>
      <input type="checkbox" name="internet_call" value="Y" />인터넷이전 혜택상담
    </label>




  </div>
  <div class="">
    <span class="btn btn-secondary" onclick="gotoContactNextStep(this)">다음</span>
  </div>
</div>
