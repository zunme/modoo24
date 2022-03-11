<div class="pop-page-step-header contact_header">
	<div class="pop-page-step-header-inner">
		이사종류
	</div>
	<a class="pop-header-right" href="tel:{{$service_center_tel}}">
		<i class="fas fa-solid fa-phone-alt"></i> {{$service_center_tel_display}}
	</a>
</div>
<div class="pop-page-step-body contact_body">

	<p class="contact_step01_select">* 이사종류를 선택해 주세요.</p>
	<div class="contact_step01">
		<!-- <pre>
인풋 input type="radio" class="step-radio select-moveing-radio" name="movingtype" value= ...
버튼내 onclick="gotoContactNextStep(this)" 만 유지해주시면 됩니다.
#popcontactmodal
public/assets/css/contact_order_pop.css
		</pre> -->

		<label class="home_move">
			<input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="home">
			<p>
				<span>가정이사</span>
				이삿짐의 양이 1톤을 넘는 경우
			</p>
		</label>
		<label class="studio_move">
			<input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="small">
			<p>
				<span>소형 원룸이사</span>
				이삿짐의 양이 1톤이 안될 경우
			</p>
		</label>
		<label class="office_move">
			<input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="office">
			<p>
				<span>사무실이사</span>
				사무실 또는 기업이전
			</p>
		</label>


	</div>

	<div class="contact_nextBtn">
		<span class="btn btn-secondary" onclick="gotoContactNextStep(this)">다음</span>
	</div>


</div>

<!-- <script>
	$(function(){


		$('.contact_step01 label').click(function(){

			$('.contact_step01 label').removeClass('active_moving');
			$(this).addClass('active_moving');

		});

	});
</script> -->