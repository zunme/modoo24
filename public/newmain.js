/*
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="/community/assets/js/handlebars.js"></script>
	<!-- date picker -->
	<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ko.min.js" integrity="sha512-L4qpL1ZotXZLLe8Oo0ZyHrj/SweV7CieswUODAAPN/tnqN3PA1P+4qPu5vIryNor6HQ5o22NujIcAZIfyVXwbQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- sweetalert -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- toast -->
	<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js" integrity="sha256-321PxS+POvbvWcIVoRZeRmf32q7fTFQJ21bXwTNWREY=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/community/assets/stisla/node_modules/izitoast/dist/css/iziToast.min.css">
	<!-- swiper -->
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
	<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>


	<link rel="stylesheet" href="/community/newmain.css" />
	<script src="/community/newmain.js"></script>
	*/
function selectAll(chk){
	let checked = $(chk).prop('checked');
	$("input[name='simplyRegPrivacy']").prop("checked", checked)
	$("input[name='simplyRegJoint']").prop("checked", checked)
	$("input[name='simplyRegPrivacy']").prop("checked", checked)
	$("input[name='simplyMarketting']").prop("checked", checked)
}
$("document").ready( function() {
	//달력
	var startMovingDate = new Date();
	var endMovingDate = new Date();
	var numberOfDaysStart = 0;
	var numberOfDaysEnd = 60;
	startMovingDate.setDate(startMovingDate.getDate() + numberOfDaysStart);
	endMovingDate.setDate(startMovingDate.getDate() + numberOfDaysEnd);

	$(".sel-datepicker").prop("readonly",true);
	$(".sel-datepicker").datepicker({
			format: "yyyy-mm-dd",
			language: "ko",
			startDate: startMovingDate,
			endDate:endMovingDate,
			todayHighlight: true,
			autoclose: true,
			//todayBtn: "linked",
			clearBtn: false,
			closeBtn: false,// close button visible
			forceParse: false,
			title : '..',
			beforeShowDay: function(date){
				let son =  solarToLunar( date.getFullYear() ,date.getMonth()+1, date.getDate(), true);
					//console.log ( date.getFullYear() +"-"+date.getMonth()+"-"+ date.getDate()+" : " + solarToLunar( date.getFullYear() ,date.getMonth(), date.getDate() ) )
				if( son ) {
					return {
								tooltip: '손없는날'+ date.getFullYear() +"-"+(date.getMonth()+1) +"-"+ date.getDate(),
								classes: 'son-active'
					}
				}

			},

	}).on('show', function(e) {
		$(".datepicker-title").html("<div class='div-sonclass'><span class='span-sonclass'></span><span class='span-sonclass-title'>손없는날</span></div>")
	});

	$(".btn_simply").on("click", function(e) {
		let btn = e.target
		simplyReg(btn);
	})
});
//간편이사견적
function simplyReg(btn) {
	loaderAttach("#simply_move")
	loaderAttach(".mobile > .message")
	loaderAttach("#simple_reg_ai_section")
	let data = $(btn).closest("form").serialize();
	getData('post', 'simpyreg', data, simplyRegcallback, simplyRegcallbackCompltet)
}
function simplyRegcallback(res){
	Swal.fire({
		icon: 'success',
		title: '신청완료',
		text: '이사견적을 신청하였습니다.',
		footer: '<span class="simplyregSuccessFooter">모두이사</span>'
	})
	$("#simply_move").append('<div class="simplyregSuccessWrap"><div class="simplyregSuccessinner"><span>이사견적을 신청하였습니다.</span></div></div>')
	$(".mobile > .message").append('<div class="simplyregSuccessWrap"><div class="simplyregSuccessinner"><span>이사견적을 신청하였습니다.</span></div></div>')
	//전환스크립트 적용

	//wcstrance("4","6000")
	$(document.body).append("<iframe src='/v2/simpleregdone.html' style='display:none'/>")

	kakaoPixel('4566851021171111416').pageView();
	kakaoPixel('4566851021171111416').completeRegistration('Order_into');
	if( typeof closepopnbtnai =='function') closepopnbtnai()
}
function wcstrance(f,won){
	_nasa={};
	if (window.wcs) _nasa["cnv"] = wcs.cnv(f,won);
	wcs_add = {};
	wcs_add["wa"] = "s_3a589317ff16";
	wcs.inflow('modoo24.net');
	wcs_do();
}
function simplyRegcallbackCompltet() {
	loaderAttach("#simply_move", false)
	loaderAttach(".mobile > .message", false)
	loaderAttach("#simple_reg_ai_section",false)
}
function loaderAttach(target,on) {
	if( on == false ){
		$(target).children(".loaderWrap").slideUp(500).remove()
		return;
	}
	let loader = `<div class="loaderWrap" style="background-color: rgb(241 242 243 / 38%);"><div class="loaderWrapInner">
<svg style="    width: 100px;height: 100px;margin: auto;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(241, 242, 243); display: block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<rect x="17.5" y="30" width="15" height="40" fill="#1d3f72">
  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
</rect>
<rect x="42.5" y="30" width="15" height="40" fill="#5699d2">
  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
</rect>
<rect x="67.5" y="30" width="15" height="40" fill="#d8ebf9">
  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
</rect>
</svg>
</div></div>
`
	$(target).append(loader);
}





// 이사후기
		// swiper 템플릿
let move_review_template =`
	<div class="swiper-wrapper">
		{{#each data}}
		<div class="swiper-slide move_review_item">
			<div data-id='{{b_uid}}' class="move_review_item_inner" onClick2="viewReview(this)">
				<div class="move_review_item_header">
					<h3>{{{s_company}}}</h3>
					<h4>({{company_point_title}})</h4>
				</div>
				<div class="move_review_item_star_wrap">
					<div class="move_review_item_star">
						<img src="/v1/image/main_N/big_star.png" alt="star">
					</div>
					<div class="move_review_item_point_wrap">
						<div class="move_review_item_point">
							{{avg}}
						</div>
						<!--iv class="move_review_item_point_desc">
							전체 평점
						</div-->
					</div>
				</div>
				<div class="move_review_item_txt">
					{{{b_note}}}
				</div>
				<div class="move_review_item_date">
					이사일 2020-11-20
				</div>
			</div>
		</div>
	{{/each}}
	</div>
`
		// 팝업 템플릿
let move_modal_default_template=`
<div class="modal" tabindex="-1" role="dialog" id="detailModal">
  <div class="modal-dialog" id="detailModal_content" role="document">
	</div>
</div>
`
let move_review_detail_template=`
    <div class="modal-content">
      <div class="modal-header">
        <div>
					<div>
						이사일 {{b_mdate}}
					</div>

					<button type="button" class="close abs-top" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

				</div>
      </div>
      <div class="modal-body">
        	<div>
						<span class="modal-review-company-title">[{{company_point_title}}]</span>
						<span class="modal-review-company">{{s_company}}</span>
					</div>
					<div class="modal-review-star_wrap">
						{{#each avgstararr}}
							{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
							{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
							{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
						{{/each}}
						<span class="modal-review-point-total">{{avg}}</span>
					</div>

					<div class="row modal-review-points_wrap">
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">전문성</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_pro_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">친절성</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_kind_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>
							</div>
						</div>
					</div>
					<div class="row modal-review-points_wrap">
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">가격도</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_price_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">마무리</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_finish_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>
							</div>
						</div>
					</div>
					<div class="row modal-review-points_wrap">
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">사후관리</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_expost_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">포장도</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_pave_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>
							</div>
						</div>
					</div>

				<div class="modal-review-contents-wrap">
					<div class="modal-review-contents">
						{{{b_note}}}
					</div>
				</div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
      </div>
    </div>
`;
let move_review_info;
let good_ct_after_swiper;
$("document").ready( function(){
	///community/api/movereview
	$(".crsl-items").remove()

	var eventtemplateCompiled = Handlebars.compile( event_template );
	eventtemplateCompiled( eventData);
	$(".center.event_wrap").html( eventtemplateCompiled( eventData) );
	$(".good_ct_after > .center").append('<div class="" id="move_review_slider"><div class="swiper-button-next"></div><div class="swiper-button-prev"></div></div>')
	$("body").append(move_modal_default_template)
	getData('get', 'movereview', {}, swipertemplate)
	$('#detailModal').on('hidden.bs.modal', function () {
			good_ct_after_swiper.autoplay.start()
		console.log ( "close")
	});
})
function swipertemplate(res){
	var template = Handlebars.compile( move_review_template );
	$("#move_review_slider" ).prepend( template(res) );
	move_review_info = res.data;
	$(".move_review_item_txt > p").attr('style','')
	derawswiper();
}
function derawswiper() {
	good_ct_after_swiper = new Swiper("#move_review_slider", {
			preventClicks:false,
			slidesPerView: 2,
			//slidesPerView: "auto",
			centeredSlides: false,
      spaceBetween: 14,
      freeMode: true,
			autoplay: {
          delay: 2500,
          disableOnInteraction: false,
      },
			breakpoints: {
				100: {
					slidesPerView: 2,
					spaceBetween: 20
				},
				680: {
					slidesPerView: 3,
					spaceBetween: 16
				},
				850: {
					slidesPerView: 4,
					spaceBetween: 14
				},
			},
		loop: true,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			on:{
				click: function(swiper, event){
					let id = $(event.target).closest('.move_review_item_inner').data('id');
					move_review_info.forEach( function ( row, idx) {
						if( row['b_uid'] == id ) viewReviewTemplate( row );
					})
				},
			}
	});
}
function viewReview(btn){
	let id = $(btn).data('id')
	move_review_info.forEach( function ( row, idx) {
		if( row['b_uid'] == id ) viewReviewTemplate( row );
	})
}
let temp2
function viewReviewTemplate( data){
	let test = data.b_note

	var template = Handlebars.compile( move_review_detail_template );
	$("#detailModal_content" ).html( template(data) );
	$(".modal-review-contents > p").attr('style','')
	$('#detailModal').modal('show');
	good_ct_after_swiper.autoplay.stop()
}
// end 칭찬후기

//event swiper

let event_template =`
			<div id="event_swiper" style="position:relative;">
				<div class="swiper-wrapper">
				{{#each data}}
              <div class="swiper-slide">
                    <a href="{{href}}" target="_blank">
                        <img class="d-block w-100 pc" src="{{pc_image}}" class="pc" alt="{{title}}">
                        <img class="d-block w-100 mobile" src="{{mobile_image}}" class="pc" alt="{{title}}">
                    </a>
                </div>
				{{/each}}
				</div>

					<div class="swiper-button-next"></div>
      		<div class="swiper-button-prev"></div>
				<div class="swiper-pagination"></div>
			</div>
`

$("document").ready( function(){
	$("nav.slidernav").remove()
	new Swiper("#event_swiper", {
			slidesPerView: 1,
			spaceBetween:10,
			freeMode: false,
		loop: true,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
		autoHeight: true,
	})
})

<!-- /event -->
