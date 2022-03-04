<div class="pop-page-step-header">
	<div class="pop-page-step-header-inner">
		이사종류
	</div>
	<a class="pop-header-right" href="tel:{{$service_center_tel}}">
		<i class="fas fa-phone-square-alt"></i> {{$service_center_tel_display}}
	</a>
</div>
<div class="pop-page-step-body">

	<div class="step-body-section">
		<pre>
인풋 input type="radio" class="step-radio select-moveing-radio" name="movingtype" value= ...
버튼내 onclick="gotoContactNextStep(this)" 만 유지해주시면 됩니다.
#popcontactmodal
public/assets/css/contact_order_pop.css
		</pre>

		<label>
			<input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="home">
			가정이사
		</label>
		<label>
			<input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="small">
			소형 원룸이사
		</label>
		<label>
			<input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="office">
			사무실이사
		</label>

		<label>
			<input type="checkbox" name="use_container" value="Y" data-to="container2">보관이사
		</label>

	</div>
	<div class="pop-page-step-footer">
		<span class="btn btn-secondary" onclick="gotoContactNextStep(this)">다음</span>
	</div>
</div>
