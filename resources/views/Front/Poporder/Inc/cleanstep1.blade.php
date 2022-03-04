@php
$clean_options = collect([
    (object) [
        'val' => '1',
        'title' => '피톤치드',
        'desc' => '평당 3천원 ~',
        'icon'=>''
    ],
    (object) [
        'val' => '2',
        'title' => '마루코팅',
        'desc' => '평당 3천원 ~',
        'icon'=>''
    ],
    (object) [
        'val' => '3',
        'title' => '새집증후군제거',
        'desc' => '평당 3천원 ~',
        'icon'=>''
    ],
    (object) [
        'val' => '4',
        'title' => '바이러스소독',
        'desc' => '평당 2천원 ~',
        'icon'=>''
    ],
]);
@endphp
<style>
	.select-moveing-type-body .step-radio-labelclass input[type='checkbox']:checked	+ .step-radio-label-step,
	.pop-content-wrap .step-radio-labelclass input[type='checkbox']:checked + .step-radio-label-step {
		background: #39b54a;
		border-color: #39b54a;
		color: white;
	}
  #popcleanmodal .select-clean-option-list{
    display: inline-flex;
    flex-wrap: wrap;
  }
  #popcleanmodal .select-clean-option-item{
    flex: 0 0 100%;
  }

  #popcleanmodal .select-clean-option-item .step-radio-label-step{
    min-width: 150px;
  }
  .pop-clean-wrap{
    padding: 24px 10px;
    background: aliceblue;
    margin-bottom: 20px;
    border-radius: 10px;
    border: 1px solid #eee;
  }
  .pop-clean-wrap-head{
    font-size: 18px;
    margin-bottom: 15px;
    margin-left: 16px;
  }
  @media (min-width: 380px){
    #popcleanmodal .select-clean-option-item{
      flex: 0 0 50%;
    }
  }
  @media (min-width: 540px){
    #popcleanmodal .select-clean-option-item{
      flex: 0 0 33.3%;
    }
  }
  @media (min-width: 770px){
    #popcleanmodal .select-clean-option-item{
      flex: 0 0 25%;
    }
  }
</style>
<div class="pop-page-step-header">
	<div class="pop-page-step-header-inner">
		청소종류
	</div>
</div>
<div class="pop-page-step-body">
	<div class="step-body-section">
		<div class="pop-content-wrap select-moveing-type">
			<div class="pop-clean-wrap select-clean-type-wrap">
				<div class="pop-clean-wrap-head">
					<span>청소 종류</span>
				</div>

				<div class="select-clean-type-body">
					<div class="select-clean-type-body-inner flex-row flex-direction-column">
						<div class="flex-row w-100 select-clean-type-items select-clean-type-first">
							<div class="flex-col select-clean-type-item">
								<label class="step-radio-labelclass">
									<input type="radio" class="step-radio select-clean-radio" name="type" value="1" />
									<div class="step-radio-label">
										<div class="step-radio-label-text">
											<div class="step-radio-label-text-item">입주청소</div>
											<div class="step-radio-label-text-item label-text-item-detail">
												desc
											</div>
										</div>

										<span class="step-radio-label-check"><i class="fas fa-house-user"></i></span>
									</div>
								</label>
							</div>
							<div class="flex-col select-clean-type-item">
								<label class="step-radio-labelclass">
									<input type="radio" class="step-radio select-clean-radio" name="type" value="2" />
									<div class="step-radio-label">
										<div class="step-radio-label-text">
											<div class="step-radio-label-text-item">거주청소</div>
											<div class="step-radio-label-text-item label-text-item-detail">
												desc
											</div>
										</div>

										<span class="step-radio-label-check"><i class="fas fa-house-user"></i></span>
									</div>
								</label>
							</div>
							<div class="flex-col select-clean-type-item">
								<label class="step-radio-labelclass">
									<input type="radio" class="step-radio select-clean-radio" name="type" value="3" />
									<div class="step-radio-label">
										<div class="step-radio-label-text">
											<div class="step-radio-label-text-item">사무실청소</div>
											<div class="step-radio-label-text-item label-text-item-detail">
												desc
											</div>
										</div>

										<span class="step-radio-label-check"><i class="fas fa-house-user"></i></span>
									</div>
								</label>
							</div>
						</div>


					</div>
				</div>
			</div>
			<div class="pop-clean-wrap select-clean-options-wrap">
				<div class="pop-clean-wrap-head">
					<span>청소 옵션</span>
				</div>
        <div class="select-clean-option-body">
          <div class="select-clean-option-inner">
            <div class="select-clean-option-list">

              @foreach( $clean_options as $option)
              <div class="select-clean-option-item">
                <label class="step-radio-labelclass" onClick="changedCleanOption({{$option->val}})">
                  <input
                    type="checkbox"
                    class="step-radio select-moveing-radio"
                    name="options"
                    value="{{$option->val}}"
                  />
                  <div class="step-radio-label-step">
                    <div class="step-radio-label-text">
                      <div class="step-radio-label-text-item">{{$option->title}}</div>
                      <div class="step-radio-label-text-item label-text-item-detail">
                        {{$option->desc}}
                      </div>
                    </div>
                    <span class="step-radio-label-check"><i class="fas fa-check"></i></span>
                  </div>
                </label>
              </div>
              @endforeach

              <div class="select-clean-option-item">
                <label class="step-radio-labelclass" onClick="changedCleanOption(0)">
                  <input
                    type="radio"
                    class="step-radio select-moveing-radio"
                    name="nooption"
                  />
                  <div class="step-radio-label-step">
                    <div class="step-radio-label-text">
                      <div class="step-radio-label-text-item">옵션없음</div>
                      <div class="step-radio-label-text-item label-text-item-detail">
                        desc
                      </div>
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

	<div class="pop-page-step-footer">
		<span class="btn btn-secondary" onclick="gotoCleanNextStep()">다음</span>
	</div>
</div>

<script>
function changedCleanOption(val){
  if( val > 0 ){
    $("#popcleanmodal input[name='nooption']").prop('checked', false)
  }else{
    $("#popcleanmodal input[name='options']:checked").prop('checked', false)
  }
}
</script>
