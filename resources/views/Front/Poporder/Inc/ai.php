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

                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingtype_ai" value="small" onchange="ai_pyeong_view()">
                                    <div class="step-radio-label">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">소형이사</div>
                                            <div class="step-radio-label-text-item label-text-item-detail">(예 : 원룸 )</div>
                                        </div>

                                        <span class="step-radio-label-check"><i class="fas fa-house-user"></i></span>
                                    </div>
                                </label>

                            </div>
                            <div class=" flex-col select-moveing-type-item">

                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingtype_ai" value="home" onchange="ai_pyeong_view()">
                                    <div class="step-radio-label">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">가정이사</div>
                                            <div class="step-radio-label-text-item label-text-item-detail">(예 : 아파트 )</div>
                                        </div>


                                        <span class="step-radio-label-check"><i class="fas fa-home"></i></span>
                                    </div>
                                </label>
                            </div>
                            <div class=" flex-col select-moveing-type-item">
                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingtype_ai" value="office" onchange="ai_pyeong_view()">
                                    <div class="step-radio-label">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">사무실이사</div>
                                            <div class="step-radio-label-text-item label-text-item-detail">(예 : 오피스텔,공장 )</div>
                                        </div>


                                        <span class="step-radio-label-check"><i class="fas fa-building"></i></span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="flex-row w-100 select-moveing-type-items select-moving-type-second">
                            <div class="flex-col select-moveing-type-item">

                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingmethod_ai" value="packaging">
                                    <div class="step-radio-label-step">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">포장이사</div>
                                        </div>
                                        <span class="step-radio-label-check"><i class="fas fa-check"></i></span>
                                    </div>
                                </label>
                            </div>
                            <div class="flex-col select-moveing-type-item">
                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingmethod_ai" value="half-packaging">
                                    <div class="step-radio-label-step">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">반포장이사</div>
                                        </div>
                                        <span class="step-radio-label-check"><i class="fas fa-check"></i></span>
                                    </div>
                                </label>
                            </div>
                            <div class="flex-col select-moveing-type-item">
                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingmethod_ai" value="carrying">
                                    <div class="step-radio-label-step">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">일반이사</div>
                                            <div class="step-radio-label-text-item label-text-item-detail">(운반만)</div>
                                        </div>
                                        <span class="step-radio-label-check"><i class="fas fa-check"></i></span>
                                    </div>
                                </label>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>



<div class="step-body-section">
  <div class="pop-content-wrap select-moveing-type">
    <div class="select-moveing-type-wrap">
        <div class="select-moveing-type-head">
            <span>평수</span>
        </div>
        <div class="select-moveing-pyeong-wrap">
          <div class="select-pyeong-inner" id="select-pyeong-inner">

            <div class="select-pyeong-item">
                <label class="step-radio-labelclass">

                    <div class="step-radio-label-step">
                        <div class="step-radio-label-text">
                            <div class="step-radio-label-text-item">이사종류를 먼저 선택해주세요</div>
                        </div>

                    </div>
                </label>
            </div>

          </div>
        </div>
    </div>
  </div>
</div>

<!-- 사진 -->
<div class="step-body-section">
  <div class="pop-content-wrap select-moveing-picture">
      <div class="pop-content-image-uploader-wrap">
          <div class="mf-file-container pop-content-image-uploader" data-upload-id="imagepreview_selectmoveing_ai">
              <div class="select-moveing-picture-item upload-image-item-btn">

                  <label class="upload-text-wrap">
                      <div class="upload-text-txt"><b>사진 첨부</b>를 누르셔서 <b>여러장의 사진</b>을 첨부 해보세요 </div>
                      <input type="file" id="imagepreview_selectmoveing_ai" accept=".jpg,.jpeg,.png,.gif" multiple="multiple">

                      <div class="upload-icon-wrap">
                          <span class="upload-icon-pic"><img src="../v1/image/main_N/camera-plus.svg"></span> <span class="upload-icon-txt">사진 첨부 하기</span>
                      </div>
                  </label>
              </div>
          </div>
          <div class="upload-warning-wrap">
              <div class="upload-warning-title-wrap">
                  <span class="upload-warning-title-icon"><i class="fas fa-exclamation-triangle"></i></span> <span class="upload-warning-title-txt">주의사항</span>
                  <div class="upload-warning-title-txt-content">
                      <div class="upload-all-title"><b>전체적인 공간</b>의 사진을 찍어주세요 </div>
                      <ul class="upload-all-tip">
                          <li>1. 각 구역별로 모든 짐들이 한눈에 보일 수 있게</li>
                          <li>2. 순서대로 찍어주세요 (빠진 구역이 있을 경우 추후에 추가 요금이 산정될 수 있습니다.)</li>
                      </ul>

                  </div>
              </div>
              <div class="form-check mt20">
                  <label class="form-check-label">
                      <input class="form-check-input mfstorageignore" name="agree_ai" type="checkbox" value="Y">
                      업로드 된 사진은 AI 딥 러닝 및 빅데이터 구축에 활용됨을 동의합니다.
                      <span class="form-check-sign">
                          <span class="check"></span>
                      </span>
                  </label>
              </div>
          </div>
          <div class="upload-showing-info">
              <div class="upload-warning-title-txt">상세 이용 방법(사진 업로드)</div>
              <div class="upload-all-title">구역별 이삿짐을 사진 촬영 &amp; 닫힌곳은 열어서 한 장에 최대한 담을 수 있게 촬영</div>
              <ul class="upload-showing-image">
                  <li><img src="/v1/image/sub/untactN_img02_01.jpg" alt="비대면견적이미지02_01"></li>
                  <li><img src="/v1/image/sub/untactN_img02_02.jpg" alt="비대면견적이미지02_01"></li>
                  <li><img src="/v1/image/sub/untactN_img02_03.jpg" alt="비대면견적이미지02_01"></li>
              </ul>
          </div>
      </div>
  </div>
</div>



<div id="result_ai_section">
</div>
<div id="simple_reg_ai_section">
	<div class="ai_simple_reg_wrap">
		<ul>
			<li>
				<span>이사일</span>
				<div class="move_Box">
					<input
						type="text"
						placeholder="이사일"
						class="sel-datepicker"
						name="t_dday"
						readonly=""
					/>
				</div>
			</li>
			<li>
				<span>이사종류</span>
				<div style="display: inline-block;">
					<select class="select" name="t_kinds">
						<option value="">이사종류</option>
						<option value="가정">가정이사</option>
						<option value="소형">소형이사</option>
						<option value="사무실">사무실이사</option>
					</select>
				</div>
			</li>
			<li>
				<span>고객명</span>
				<div class="move_Box">
					<input type="text" placeholder="고객명" name="t_name" />
				</div>
			</li>
			<li>
				<span>연락처</span>
				<div class="move_Box">
					<input type="number" placeholder="번호만 입력해주세요" maxlength="12" name="t_hp" />
				</div>
			</li>
		</ul>
		<ul class="box03">
			<li>
				<div class="checks">
					<div class="checks etrans">
						<input type="checkbox" id="ex_m_chk0ai" onclick="selectAll(this)" />
						<label for="ex_m_chk0ai"></label>
						<p>
							<b style="color: #000;">전체 동의</b>
						</p>
					</div>
				</div>
			</li>
			<li>
				<div class="checks">
					<div class="checks etrans">
						<input type="checkbox" id="ex_m_chk2ai" name="simplyRegPrivacy" value="Y" />
						<label for="ex_m_chk2ai"></label>
						<p class="modalpop_link" link="/new_common/popup/accessterms.html">
							이용약관
						</p>
					</div>
				</div>
			</li>
			<li>
				<div class="checks">
					<div class="checks etrans">
						<input type="checkbox" id="ex_m_chk3ai" name="simplyRegJoint" value="Y" />
						<label for="ex_m_chk3ai"></label>
						<p class="modalpop_link" link="/new_common/popup/personal_data.html">
							개인정보처리방침
						</p>
					</div>
				</div>
			</li>
			<li>
				<div class="checks">
					<div class="checks etrans">
						<input type="checkbox" id="ex_m_chk4ai" name="simplyMarketting" value="Y" />
						<label for="ex_m_chk4ai"></label>
						<p>
							<a class="modalpop_link" link="/new_common/popup/personal_3.html">제3자 제공동의</a> /
							<a class="modalpop_link" link="/new_common/popup/mkt_ok.html">마케팅 동의</a>
						</p>
					</div>
				</div>
			</li>
		</ul>
		<button type="button" class="btn_simply simple-reg-btn">
			<span class="color_yw">무료견적</span><br />간편신청
		</button>
	</div>
</div>


<div class="pop-page-step-footer">
        <span class="btn btn-secondary" onclick="getAi()">견적보기</span>
</div>
