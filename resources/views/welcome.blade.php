@extends('layouts.modoo')

@section('usesub','')

@section('content')
<!--날개배너-->
<div id="simpleorder" class="banner_right_box pc" style="z-index: 899;top: 190px;">
		<a href="void(0);" onclick="alert('준비중입니다.');return false;">
				<img src="/NEW/image/main_N/wing_banner.jpg" alt="날개배너">
		</a>
</div>
<!--//날개배너-->


<!--메인배너-->
<section id="banner_visual">
		<ul>
				<li>
						<a class="pc" href="/front/orderpop?s=2"><img src="/NEW/image/main_N/main_bn01.png"></a>
						<a class="mobile" href="/front/orderpop?s=2"><img src="/NEW/image/main_N/main_m_bn01.png"></a>
						<a class="btn_untact mobile" href="/NEW/modoo/untact_info.php" style="width:100%; margin-top:10px"><b>비대면 견적 </b>가이드</a>
				</li>
				<li>
						<a class="pc" href="/front/orderpop?s=1"><img src="/NEW/image/main_N/main_bn02.png"></a>
						<a class="mobile" href="/front/orderpop?s=1"><img src="/NEW/image/main_N/main_m_bn02.png"></a>
						<a class="btn_contact mobile" href="/NEW/modoo/contact_info.php" style="width:100%;margin-top:10px"><b>방문 견적 </b>가이드</a>
				</li>
				<li class="pc">
						<a href="http://modooclean.com/" target="_blank"><img src="/NEW/image/main_N/main_bn03.png"></a>
				</li>
		</ul>
		<div class="row" style="display:none">
				<div class="col-md-4 col-sm-6"><img src="/NEW/image/main_N/main_bn01.png"></div>
				<div class="col-md-4 col-sm-6"><img src="/NEW/image/main_N/main_bn02.png"></div>
				<div class="col-md-4 col-sm-6 pc"><a href="http://modooclean.com/" target="_blank"><img src="/NEW/image/main_N/main_bn03.png"></a></div>

		</div>
</section>
<!--pc간편견적-->
<section id="simply_move" class="center pc">
		<form>
				<div class="box01">
						<h2><span class="color_pt">간편</span> 이사견적</h2>
						<p>간단한 정보 입력과 동의로
								이사견적 신청 완료
						</p>
				</div>
				<ul class="box02">
						<li><span>이사일</span>
								<div class="move_Box">
										<input type="text" placeholder="이사일" class="sel-datepicker" name="t_dday">
								</div>

						</li>
						<li>
								<span>이사종류</span>
								<div style="display: inline-block">
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
										<input type="text" placeholder="고객명" name="t_name">
								</div>
						</li>
						<li>
								<span>연락처</span>
								<div class="move_Box">
										<input placeholder="번호만 입력" maxlength="12" name="t_hp">
								</div>
						</li>
				</ul>
				<ul class="box03">
						<li>
								<div class="checks">
										<div class="checks etrans">
												<input type="checkbox" id="ex_chk0" onclick="selectAll(this)">
												<label for="ex_chk0"></label>
												<p>
														전체 동의
												</p>
										</div>
								</div>
						</li>
						<li>
								<div class="checks">
										<div class="checks etrans">
												<input type="checkbox" id="ex_chk2" name="simplyRegPrivacy" value="Y">
												<label for="ex_chk2"></label>
												<p class="modalpop_link" link="/new_common/popup/personal_data.html">
														개인정보수집 및 이용에 동의(필수)
												 </p>
										</div>
								</div>
						</li>
						<li>
								<div class="checks">
										<div class="checks etrans">
												<input type="checkbox" id="ex_chk3" name="simplyRegJoint" value="Y">
												<label for="ex_chk3"></label>
												<p class="modalpop_link" link="/new_common/popup/personal_3.html">
														 개인정보의 제3자 제공 동의(필수)
													</p>
										</div>
								</div>
						</li>
						<li>
								<div class="checks">
										<div class="checks etrans">
												<input type="checkbox" id="ex_chk4"  name="simplyMarketting" value="Y">
												<label for="ex_chk4"></label>
												<p>
														마케팅 동의(선택)
												</p>
										</div>
								</div>
						</li>
				</ul>
				<button type="button" class="btn_simply simple-reg-btn"><span class="color_yw">간편견적</span><br />신청하기</button>
		</form>
</section>
<!--견적가이드-->
<section class="center move_kind pc">
		<div class="left_Box">
				<h2 class="color_pt">무료 비대면 견적</h2>
				<h4>이사짐 체크와 사진으로 간편하게 집에서 이사견적을 받아보세요</h4>
				<p class="txt">24시간 동안 최대 10개 업체의 꼼꼼한 이사 견적을 제안 드립니다.</p>
				<button type="button" class="btn_untact" onclick="location.href='/NEW/modoo/untact_info.php' "><b>비대면 견적 </b>가이드</button>
				<p class="img"><img src="/NEW/image/main_N/untact_info.jpg" alt="비대면 견적 가이드"></p>
		</div>
		<div class="right_Box">
				<h2 class="color_blue">무료 방문 견적</h2>
				<h3>파트너 업체의 직접 방문을 통해 정확한 이사 견적을 제안 드립니다. </h3>
				<button type="button" class="btn_contact" onclick="location.href='/NEW/modoo/contact_info.php' "><b>방문 견적 </b>가이드</button>
				<p class="img"><img src="/NEW/image/main_N/tact_info.jpg" alt="방문 견적 가이드"></p>
		</div>
</section>
<!--이벤트-->
<section class="center event_wrap">
		<div id="demo" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
						<!-- 슬라이드 쇼 -->
						<div class="carousel-item active">
								<a href="https://blog.naver.com/modoo24try/222488994124" target="_blank">
										<img class="d-block w-100 pc" src="/NEW/image/main_N/event_ss.jpg" class="pc" alt="삼성이벤트">
										<img class="d-block w-100 mobile" src="/NEW/image/main_N/event_ss_m.jpg" class="pc" alt="삼성이벤트">
								</a>
						</div>
						<div class="carousel-item">
								<a href="https://www.internetfriends.co.kr/index.php?s1=modoo24_event&action=reg&utm_source=modoo24&utm_medium=partner&utm_campaign=landing&utm_content=modoo24-2021-01-22" target="_blank">
										<img class="d-block w-100 pc" src="/NEW/image/main_N/event_it.jpg" class="pc" alt="인터넷신청">
										<img class="d-block w-100 mobile" src="/NEW/image/main_N/event_it_m.jpg" class="pc" alt="인터넷신청">
								</a>
						</div>
						<!-- / 슬라이드 쇼 끝 -->
						<!-- 왼쪽 오른쪽 화살표 버튼 -->
						<a class="carousel-control-prev" href="#demo" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span> <!-- <span>Previous</span> --> </a> <a class="carousel-control-next" href="#demo" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <!-- <span>Next</span> -->
						</a> <!-- / 화살표 버튼 끝 -->
						<!-- 인디케이터 -->
						<ul class="carousel-indicators">
								<li data-target="#demo" data-slide-to="0" class="active"></li>
								<!--0번부터시작-->
								<li data-target="#demo" data-slide-to="1"></li>
								<li data-target="#demo" data-slide-to="2"></li>
						</ul> <!-- 인디케이터 끝 -->
				</div>
		</div>
</section>
<!--지식인검색-->
<section class="center search_wrap">
		<h2><b>이사에 대해 알고 싶은것!</b> <b class="color_pt">이사지식인</b>에 문의하세요!</h2>
		<div class="left_box">
				<i><img src="/NEW/image/main_N/icon_truck.png" alt="이사지식인아이콘"></i>
				<h5>
						<span class="color_pt">이사지식인</span> 검색
				</h5>
				<div class="search_Box">
						<input type="text" placeholder="이사지식인검색">
						<label></label>
						<a class="btn_form" href="/NEW/knows/knows_list.php">검색</a>
				</div>
		</div>
		<div class="mobile know_m_info">
				<h4><b>이사 지식인<span class="plus color_pt">+</span></b></h4>
				<div>
						이사에 대한 궁금한 사항을 모두이사
						파트너업체가 답변해 드립니다.
				</div>
				<p><img src="/NEW/image/main_N/icon_qna.png" alt="qna"></p>
				<button type="button" class="btn_question">
						자세히보기
				</button>
		</div>
		<div class="faq_box pc">
				<i><img src="/NEW/image/main_N/icon_faq.png" alt="자주묻는질문"></i>
				<a href="/front/custom_faq">
						<h3>모두이사에 <span class="color_pt">자주 묻는 질문</span> Best 10</h3>
						<h4>이사 고객님들이 궁금해하는 자주 묻는 질문 10가지를 정리 하였습니다. </h4>
				</a>
		</div>

</section>
<!--커뮤니티-->
<section class="community_wrap center">
		<h2>모두이사 고객과 <span class="color_pt">함께하는 커뮤니티</span></h2>
		<ul>
				<li class="pc">
						<h4>이사 <span class="color_pt">지식인</span> <span class="plus">+</span></h4>
						<ul class="know_list">
								<li>
										<a href="/NEW/knows/knows_list.php">
												<div>Q. 반포장이사시 준비해야 할 것은 어떤게...</div>
												<div>A. 반포장이사나 포장이사시 자차로 가셔도 되시고 동승하셔도 되세요.</div>
										</a>
								</li>
								<li>
										<a href="/NEW/knows/knows_list.php">
												<div>Q. 시간이 안되서 오후나 저녁에 이사..</div>
												<div>A. 이사할 때 한군데에서만 견적을 받아보시면 안됩니다.</div>
										</a>
								</li>
								<li>
										<a href="/NEW/knows/knows_list.php">
												<div>Q. 다음달쯤에 이사준비로 이사비교견적</div>
												<div>A. 저렴한 가격에 중점을 둔 이삿짐센터의 경우, 이용시 서비스 품질저하등으로..</div>
										</a>
								</li>
						</ul>
				</li>
				<li>
						<h4 class="bgg">모두 <span class="color_blue">FUN</span> <span class="plus">+</span></h4>
						<ul class="fun_list">
								<li>
										<a href="">
												<div>
														<img src="/NEW/image/main_N/img01.jpg" alt="">
												</div>
												<p>모두이사 이사후기!
														사다리차를 이용한
														이사 동영상 공개!~</p>
										</a>
								</li>
								<li>
										<a href="">
												<div>
														<img src="/NEW/image/main_N/img02.jpg" alt="">
												</div>
												<p>집에서 수익실현!
														비대면 아르바이트 모집!
														랜딩페이지 제공
												</p>
										</a>
								</li>
						</ul>
				</li>
				<li>
						<h4 class="bgg">이사가기 <span class="color_pt">좋은 집</span> <span class="plus">+</span></h4>
						<ul class="fun_list">
								<li>
										<a>
												<div>
														<img src="/NEW/image/main_N/img03.jpg" alt="">
												</div>
												<p>신림스카이 아파트
														서울특별시 관악구 신림로
														185(신림동)지하철 2호선
														신림역, 봉천역</p>
										</a>
								</li>
								<li>
										<a>
												<div>
														<img src="/NEW/image/main_N/img04.jpg" alt="">
												</div>
												<p>
														부산 동원시티비스타
														부산광역시 연제구 연산동
														1360-13번지 부산시청역,
														연산역 환승역 인접
												</p>
										</a>
								</li>
						</ul>
				</li>
				<li>
						<h4 class="bgg"><span class="color_blue">우리동네</span>가 좋아요!<span class="plus">+</span></h4>
						<ul class="fun_list">
								<li>
										<a>
												<div>
														<img src="/NEW/image/main_N/img05.jpg" alt="">
												</div>
												<p>
														서울시 신정4동 맛집
														베이커리 카폐 블라썸
														캠패니언 우리 동네는
														주변에 맛집이 많다
												</p>
										</a>
								</li>
								<li>
										<a>
												<div>
														<img src="/NEW/image/main_N/img06.jpg" alt="">
												</div>
												<p>
														제가 사는 인천청라는
														수변공원 조성이 크고 길게
														아주 잘 만들어진 편입니다.
														그 수변은 결국에 호수공원.
												</p>
										</a>
								</li>
						</ul>
				</li>

		</ul>
</section>

<!--칭찬후기-->
<section class="good_ct_after">
		<div class="center">
				<nav class="slidernav">
						<div id="navbtns" class="clearfix">
								<a href="#" class="previous">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="64" height="64">
												<path fill="none" d="M0 0h24v24H0z" />
												<path d="M10.828 12l4.95 4.95-1.414 1.414L8 12l6.364-6.364 1.414 1.414z" fill="rgba(51,51,51,1)" />
										</svg>
								</a>
								<a href="#" class="next">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="64" height="64">
												<path fill="none" d="M0 0h24v24H0z" />
												<path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z" fill="rgba(51,51,51,1)" />
										</svg>
								</a>
						</div>
				</nav>

				<h2 class="gd_title">모두이사 고객 <span class="color_pt">이용 후기</span></h2>
				<a class="more" href="/front/custom_review">후기 더보기 + </a>


				<div class="crsl-items" data-navigation="navbtns" style="width: 100%; overflow: hidden;">
						<div class="crsl-wrap" onclick="location.href='/front/custom_review' " style="cursor: pointer; width: 1135px; margin-left: -227px;">


								<div class="crsl-item" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
										<a class="review" href="/front/custom_review" style="display: block">
												<h3>all익스프레스</h3>
												<h4>(우수업체)</h4>
												<dl>
														<dt><img src="/NEW/image/main_N/big_star.png" alt="star"></dt>
														<dd>
																<span class="num">4.0</span>
																<span class="numtxt">전체 누적 평점</span>
														</dd>
												</dl>
												<p class="review_txt">고생하셨습니다. 글을 많이 쓴다면 어떤일이 벌어질까요? 깜짝 놀랄일이 짜자자자잔</p>
												<span class="review_date">이사일 2020-11-20</span>
										</a>
								</div>
								<div class="crsl-item crsl-active" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
										<a class="review" href="/front/custom_review" style="display: block">
												<h3>피카츄이사</h3>
												<h4>(최우수업체)</h4>
												<dl>
														<dt><img src="/NEW/image/main_N/big_star.png" alt="star"></dt>
														<dd>
																<span class="num">4.0</span>
																<span class="numtxt">전체 누적 평점</span>
														</dd>
												</dl>
												<p class="review_txt">고생하셨습니다. 글을 많이 쓴다면 어떤일이 벌어질까요? 깜짝 놀랄일이 짜자자자잔</p>
												<span class="review_date">이사일 2020-11-20</span>
										</a>
								</div>

								<div class="crsl-item" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
										<a class="review" href="/front/custom_review" style="display: block">
												<h3>이사공간</h3>
												<h4>(우수업체)</h4>
												<dl>
														<dt><img src="/NEW/image/main_N/big_star.png" alt="star"></dt>
														<dd>
																<span class="num">4.5</span>
																<span class="numtxt">전체 누적 평점</span>
														</dd>
												</dl>
												<p class="review_txt">고생하셨습니다. 두줄로 제안합시다.</p>
												<span class="review_date">이사일 2020-11-20</span>
										</a>
								</div>

								<div class="crsl-item" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
										<a class="review" href="/front/custom_review" style="display: block">
												<h3>우리모두옮겨</h3>
												<h4>(우수업체)</h4>
												<dl>
														<dt><img src="/NEW/image/main_N/big_star.png" alt="star"></dt>
														<dd>
																<span class="num">4.0</span>
																<span class="numtxt">전체 누적 평점</span>
														</dd>
												</dl>
												<p class="review_txt">고생하셨습니다. 글을 많이 쓴다면 어떤일이 벌어질까요? 깜짝 놀랄일이 짜자자자잔</p>
												<span class="review_date">이사일 2020-11-20</span>
										</a>
								</div>

								<div class="crsl-item" style="position: relative; float: left; overflow: hidden; width: 222px; margin-right: 5px; height: 401px;">
										<a class="review" href="/front/custom_review" style="display: block">
												<h3>밍밍이이사업체</h3>
												<h4>(우수업체)</h4>
												<dl>
														<dt><img src="/NEW/image/main_N/big_star.png" alt="star"></dt>
														<dd>
																<span class="num">4.0</span>
																<span class="numtxt">전체 누적 평점</span>
														</dd>
												</dl>
												<p class="review_txt">고생하셨습니다. 글을 많이 쓴다면 어떤일이 벌어질까요? 깜짝 놀랄일이 짜자자자잔</p>
												<span class="review_date">이사일 2020-11-20</span>
										</a>
								</div>



						</div>
				</div>
		</div>
</section>


<!--이사생활정보-->
<section class="center living_wrap">
		<div class="living_pic_box">
				<h2><b>모두이사</b> 와 함께하는 <b class="color_pt">이사/생활정보</b></h2>
				<ul class="living_pic_list">
						<li><a href="http://modoo24.net/front/modoo_info?cmd=view&idx=32"><img src="http://24auction.co.kr/data/upload/01_20210830_20210831101302.png" alt="image"></a></li>
						<li><a href="http://modoo24.net/front/modoo_info?cmd=view&idx=31"><img src="http://24auction.co.kr/data/upload/KakaoTalk_20210823_111559795_20210823112946.png" alt="image"></a></li>
						<li><a href="http://modoo24.net/front/modoo_info?cmd=view&idx=30"><img src="http://24auction.co.kr/data/upload/01_20210813_20210817093447.png" alt="image"></a></li>
						<li class="pc"><a href="http://modoo24.net/front/modoo_info?cmd=view&idx=28"><img src="http://24auction.co.kr/data/upload/01_20210728_20210728175028.png" alt="image"></a></li>
						<li class="pc"><a href="http://modoo24.net/front/modoo_info?cmd=view&idx=26"><img src="http://24auction.co.kr/data/upload/01_20210604_20210607084847.png" alt="image"></a></li>
						<li class="pc"><a href="http://modoo24.net/front/modoo_info?cmd=view&idx=25"><img src="http://24auction.co.kr/data/upload/01_20210525_20210526165612.png" alt="image"></a></li>
				</ul>
		</div>
		<!--생활꿀팁-->
		<div class="living_tip_box">
				<h2><b>고객</b>과 함께하는 <b class="color_blue">생활꿀TIP</b></h2>
				<ul>
						<li>
								<a onclick="alert('준비중입니다.');return false;">
										<div class="left_img">
												<img src="/NEW/image/main_N/img07.jpg" alt="">
										</div>
										<div class="left_txt">
												<h4>조금만 알아두면 시간과 노력을 아껴주는..</h4>
												<p>
														이사비용 줄이는 방법 꿀팁!<br />
														새로운 보금자리에서의 시작을 여는 이사,<br />
														가져갈 짐이 많든 적든 이사는 누구에게나 신경도 많이 써야하고..
												</p>
										</div>
								</a>
						</li>
						<li>
								<a onclick="alert('준비중입니다.');return false;">
										<div class="left_img">
												<img src="/NEW/image/main_N/img08.jpg" alt="">
										</div>
										<div class="left_txt">
												<h4>원룸이사 할 경우에 알아두어야 할 것.</h4>
												<p>
														안녕하세요? 국내 최대 이사플랫폼 모두이사입니다.<br />
														오늘 알아볼 내용은 원룸이사에 관련한 것인데요.<br />
														어떻게 하면 쉽고 빠르게 또 스마트하게 원룸이사를 할 수 있는지..</p>
										</div>
								</a>
						</li>
						<li>
								<a onclick="alert('준비중입니다.');return false;">
										<div class="left_img">
												<img src="/NEW/image/main_N/img09.jpg" alt="">
										</div>
										<div class="left_txt">
												<h4>이사업체 선정방법 이것만 체크하세요~ </h4>
												<p>
														이사라는 키워드만 검색을 해보아도 정말 무수히 많은 <br />
														업체 들이 나오는데요~<br />
														그 수많은 이사업체 중 어느곳을 믿고 결정해야 할지 선택하기...</p>
										</div>
								</a>
						</li>
				</ul>
		</div>
</section>


<!--파트너문의 고객센터-->
<section class="customer_wrap">
		<div class="center">
				<div class="left_box">
						<h2><span class="color_pt">파트너</span> 입점 문의</h2>
						<p>이사업체 및 용달업체 <br />
								파트너 상시모집</p>
						<button type="button" class="btn_part" onclick="location.href='/front/custom_business?cmd=setup_form' ">자세히 보기</button>
				</div>
				<div class="right_box">
						<p><img src="/NEW/image/main_N/partner2_img.png" alt="1600-7728"></p>
						<dl>
								<dt class="pn_title">광고 및 제휴제안</dt>
								<dd class="pn_tel">모든 <span class="color_pt">업종 업태</span> </dd>
								<dd class="pn_txt">
										모두플랫폼은 다양한 분야의 사업자와 함께 합니다.
								</dd>
						</dl>
				</div>

				<div class="right_box" style="display: none">
						<p><img src="/NEW/image/main_N/customer_img.png" alt="1600-7728"></p>
						<dl>
								<dt class="title">고객센터</dt>
								<dd class="tel">1600-7728</dd>
								<dd>
										<ul>
												<li>평일 : 오전 9시 ~ 18시 30분</li>
												<li>공휴일, 주말 : 오전 9시 ~ 17시</li>
										</ul>
								</dd>
						</dl>
				</div>
		</div>
</section>
<!--앱나열 회사 소개 아이콘-->
<section class="company_wrap center">
		<ul>
				<li>
						<a href="http://modooplatform.co.kr/" target="_blank">
								<p><img src="/NEW/image/main_N/info_mf.png" alt="모두플랫폼"></p>
								<span>회사소개</span>
						</a>
				</li>
				<li>
						<a href="http://modooclean.com/" target="_blank">
								<p><img src="/NEW/image/main_N/info_mc.png" alt="청소서비스"></p>
								<span>청소서비스</span>
						</a>
				</li>
				<li>
						<a href="https://blog.naver.com/modoo24try" target="_blank">
								<p><img src="/NEW/image/main_N/info_bg.png" alt="모두블로그"></p>
								<span>모플블로그</span>
						</a>
				</li>
				<li>
						<a href="https://www.facebook.com/Modooplatform/" target="_blank">
								<p><img src="/NEW/image/main_N/info_fb.png" alt="모두페이스북"></p>
								<span>모플페이스북</span>
						</a>
				</li>
				<li>
						<a href="https://www.instagram.com/modooplatform/" target="_blank">
								<p><img src="/NEW/image/main_N/info_it" alt="모두인스타"></p>
								<span>모플인스타</span>
						</a>
				</li>
				<li>
						<a href="void(0);" onclick="alert('준비중입니다.');return false;" target="_blank">
								<p><img src="/NEW/image/main_N/info_evt.png" alt="모두이벤트"></p>
								<span>모플이벤트</span>
						</a>
				</li>
				<li>
						<a href="/front/custom_review">
								<p><img src="/NEW/image/main_N/info_good.png" alt="이용후기"></p>
								<span>이용후기</span>
						</a>
				</li>
				<li>
						<a href="https://pf.kakao.com/_kCylxb" target="_blank">
								<p><img src="/NEW/image/main_N/info_kakao.png" alt="모플카카오"></p>
								<span>모플카카오</span>
						</a>
				</li>
		</ul>
</section>


@endsection




@section('body-bottom')
<!--토글-->
<div class="mobile" style="z-index: 900;position: fixed">
		<input type="checkbox" name="toggle" id="toggle" />
		<label for="toggle"></label>

		<div class="message">
				<form>
						<ul class="box02">
								<li><span>이사일</span>
										<div class="move_Box">
												<input type="text" placeholder="이사일" class="sel-datepicker" name="t_dday">
										</div>

								</li>
								<li>
										<span>이사종류</span>
										<div style="display: inline-block">
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
												<input type="text" placeholder="고객명" name="t_name">
										</div>
								</li>
								<li>
										<span>연락처</span>
										<div class="move_Box">
												<input placeholder="번호만 입력해주세요" maxlength="12" name="t_hp">
										</div>
								</li>
						</ul>
						<ul class="box03">
								<li>
										<div class="checks">
												<div class="checks etrans">
														<input type="checkbox" id="ex_m_chk0" onclick="selectAll(this)">
														<label for="ex_m_chk0"></label>
														<p>
																전체 동의
														</p>
												</div>
										</div>
								</li>
								<li>
										<div class="checks">
												<div class="checks etrans">
														<input type="checkbox" id="ex_m_chk2" name="simplyRegPrivacy" value="Y">
														<label for="ex_m_chk2"></label>
														<p>
																<a href="javascript:openAgreePop('/new_common/popup/info_pop.html')"> 개인정보수집 및 이용에 동의(필수) </a>
														</p>
												</div>
										</div>
								</li>
								<li>
										<div class="checks">
												<div class="checks etrans">
														<input type="checkbox" id="ex_m_chk3" name="simplyRegJoint" value="Y">
														<label for="ex_m_chk3"></label>
														<p>
																<a href="javascript:openAgreePop1('/new_common/popup/use_pop_02.html')"> 개인정보의 제3자 제공 동의(필수) </a>
														</p>
												</div>
										</div>
								</li>
								<li>
										<div class="checks">
												<div class="checks etrans">
														<input type="checkbox" id="ex_m_chk4" name="simplyRegJoint" value="Y">
														<label for="ex_m_chk4"></label>
														<p>
																마케팅동의
														</p>
												</div>
										</div>
								</li>
						</ul>
						<button type="button" class="btn_simply simple-reg-btn"><span class="color_yw">간편견적</span><br />신청하기</button>

				</form>
		</div>
</div>
@endsection




@section('script')
<!--간편접수 퀵메뉴-->
<script>
    $(document).ready(function() {
        // 기존 css에서 플로팅 배너 위치(top)값을 가져와 저장한다.
        var floatPosition = parseInt($("#simpleorder").css('top'));
        // 250px 이런식으로 가져오므로 여기서 숫자만 가져온다. parseInt( 값 );

        $(window).scroll(function() {
            // 현재 스크롤 위치를 가져온다.
            var scrollTop = $(window).scrollTop();
            var newPosition = scrollTop + floatPosition + "px";

            /* 애니메이션 없이 바로 따라감
            $("#simpleorder").css('top', newPosition);
            */
            $("#simpleorder").stop().animate({
                "top": newPosition
            }, 500);
        }).scroll();
    });
    //

</script>
<!--//간편접수 퀵메뉴-->

@endsection
