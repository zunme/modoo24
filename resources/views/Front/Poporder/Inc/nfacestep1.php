<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
    출발지/도착지
  </div>
</div>
<div class="pop-page-step-body">
  <div class="step-body-section">
    <div class="pop-content-wrap start-address">
        <div class="pop-input-title">
          <i class="fas fa-map-marked-alt"></i> 출발지
        </div>
        <div class="pop-input-wrap">
          <div class="form-group-pop has-icon has-success">
            <input type="hidden" name="s_bcode" id="s_bcode">
            <input type="hidden" name="s_sigunguCode" id="s_sigunguCode">
            <input type="hidden" name="s_jibun_addr1" id="s_jibun_addr1">
            <input type="hidden" name="s_zip1" id="s_zip1">

            <input type="text" value="" class="form-control-pop form-control-success"
                name="s_addr1" id="s_addr1" required="required" placeholder="출발지 주소 검색" readonly="" onclick="getAddress( startaddress );">
          </div>
          <div class="form-group-pop has-icon has-success">
            <input type="text" value="" class="form-control-pop"
                name="s_addr2" id="s_addr2" required="required" placeholder="상세 주소 입력 (동/호수)" >
          </div>

          <div class="row mt-3">
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
                <input type="number"  name="s_floor" min="0" class="form-control-pop text-align-right" placeholder="층수">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <span>층</span>
                  </span>
                </div>
              </div>

            </div>
          </div>

          <div class="flex-row justify-content-flex-end mt-3">
            <div class="step-onoff-wrap">
              <div class="input-toggle-wrap">
                <div class="input-toggle-line">엘리베이터 사용</div>
                <div class="togglebutton texttoggle">
                  <label>
                    <input type="checkbox" name="s_ev_no" checked="" data-to="elv1">
                    <span class="toggle">
                      <span class="toggle-avail-label" data-off="불가능" data-on="가능"></span>
                    </span>
                  </label>
                </div>

              </div>
            </div>

            <div class="step-onoff-wrap">
              <div class="input-toggle-wrap">
                <div class="input-toggle-line">주차 가능여부</div>
                <div class="togglebutton texttoggle">
                  <label>
                    <input type="checkbox" name="s_park_no" checked="" data-to="park1">
                    <span class="toggle">
                      <span class="toggle-avail-label" data-off="불가능" data-on="가능"></span>
                    </span>
                  </label>
                </div>

              </div>
            </div>

          </div>

        </div>
    </div>
    <div class="pop-content-wrap end-address">
        <div class="pop-input-title">
          <i class="fas fa-map-marked"></i> 도착지
        </div>
        <div class="pop-input-wrap">
          <div class="form-group-pop has-icon has-success">
            <input type="hidden" name="e_bcode" id="e_bcode">
            <input type="hidden" name="e_sigunguCode" id="e_sigunguCode">
            <input type="hidden" name="e_jibun_addr1" id="e_jibun_addr1">
            <input type="hidden" name="e_zip1" id="e_zip1">

            <input type="text" value="" class="form-control-pop form-control-success"
                name="e_addr1" id="e_addr1" required="required" placeholder="도착지 주소 검색" readonly="" onclick="getAddress(endaddress);"
            >
          </div>
          <div class="row mt-3">
            <div class="col">

              <div class="input-group new-input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <span>평수</span>
                  </span>
                </div>
                <input type="number" name="e_pyeong" min="0" class="form-control-pop text-align-right" placeholder="평수">
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
                <input type="number"  name="e_floor" min="0" class="form-control-pop text-align-right" placeholder="층수">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <span>층</span>
                  </span>
                </div>
              </div>

            </div>
          </div>
          <div class="flex-row justify-content-flex-end mt-3">
            <div class="step-onoff-wrap">
              <div class="input-toggle-wrap">
                <div class="input-toggle-line">엘리베이터 사용</div>
                <div class="togglebutton texttoggle">
                  <label>
                    <input type="checkbox" name="e_ev_no" value="Y" checked="" data-to="elv2">
                    <span class="toggle">
                      <span class="toggle-avail-label" data-off="불가능" data-on="가능"></span>
                    </span>
                  </label>
                </div>

              </div>
            </div>

            <div class="step-onoff-wrap">
              <div class="input-toggle-wrap">
                <div class="input-toggle-line">주차 가능여부</div>
                <div class="togglebutton texttoggle">
                  <label>
                    <input type="checkbox" name="e_park_no" value="Y" checked="" data-to="park2">
                    <span class="toggle">
                      <span class="toggle-avail-label" data-off="불가능" data-on="가능"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>

            <div class="step-onoff-wrap">
              <div class="input-toggle-wrap">
                <div class="input-toggle-line">입주청소</div>
                <div class="togglebutton texttoggle">
                  <label>
                    <input type="checkbox" name="use_clean" value="Y" data-to="clean2">
                    <span class="toggle">
                      <span class="toggle-avail-label" data-off="NO" data-on="YES"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
            <div class="step-onoff-wrap">
              <div class="input-toggle-wrap">
                <div class="input-toggle-line">보관이사</div>
                <div class="togglebutton texttoggle">
                  <label>
                    <input type="checkbox" name="use_container" value="Y" data-to="container2">
                    <span class="toggle">
                      <span class="toggle-avail-label" data-off="NO" data-on="YES"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
            <div class="step-onoff-wrap">
              <div class="input-toggle-wrap">
                <div class="input-toggle-line">인터넷이전 혜택상담</div>
                <div class="togglebutton texttoggle">
                  <label>
                    <input type="checkbox" name="internet_call" value="Y" checked="" data-to="internet2">
                    <span class="toggle" >
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

  <div class="pop-page-step-footer">
    <span class="btn btn-secondary" onclick="gotoNextStep()">다음</span>
  </div>

</div>
