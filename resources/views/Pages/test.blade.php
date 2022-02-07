<template>
  <div class="page" data-name="home2">
  	<div class="navbar">
  		<div class="navbar-bg"></div>
  		<div class="navbar-inner sliding">
  			<div class="left">
  				<a href="/v2" class="link external">
  					<img src="https://modoo24.net/v1/image/main_N/logo.png" style="width: 60px;" />
  				</a>
  			</div>
  			<div class="title">모두이사</div>
        <div class="right">
          <a href="#" class="link icon-only panel-open" data-panel="left">
            <!--i class="icon material-icons">menu</i-->
            <i class="fas fa-truck-moving"></i>
          </a>
        </div>
  		</div>
  	</div>

    <div class="toolbar toolbar-top">
      <div class="toolbar-inner">
        <!-- Toolbar links -->
        <a href="#" class="link w-100 popup-open" data-popup=".demo-popup3">방문견적</a>
        <a href="#" class="link w-100 popup-open" data-popup=".demo-popup2">간편견적</a>
        <a href="#" class="link w-100 popup-open" data-popup=".demo-popup">비대면견적</a>
      </div>
    </div>

    <div class="toolbar toolbar-bottom main-home-bottom-toolbar">
      <div class="toolbar-inner">
        <!-- Toolbar links -->
        <a href="/v2/mob/staffmatching/SFWDFAwkdisychdj" class="link">신청내역</a>
        <a href="tel:16007728" class="link external w-100"><i class="fas fa-phone-alt" style="margin-right:10px;"></i> 1600-7728</a>
        <a href="#" class="link icon-only tablet-only" @click=${bgColorPallete}>
          <i class="fas fa-palette"></i>
          <input type="text" id="demo-color-picker-palette" style="width:0;height:0;"/>
        </a>
        <a href="#" class="link popup-open" @click=${openGrid}><i class="fas fa-share-alt"></i></a>

        <a href="http://www.modooclean.com/" class="link external" target="_blank" style="padding: 0 25px;">
          <i class="fas fa-broom tablet-only " style="margin-right: 10px;color: #07c563;"></i>
          <img src="http://www.modooclean.com/view/site/image/clogo.png" style="width: 57px;margin-top: 6px;" />
        </a>

      </div>
    </div>

    <!-- 홈 -->
  	<div class="page-content bg-theme-color hide-navbar-on-scroll with-footer">
      <!-- top swiper -->
      <div class="page-content-wrap elevation-3">
        <div class="wrap">
          <div id="eventswiper"
                data-pagination='{"el": ".swiper-pagination", "clickable": true}'
                data-navigation='{"nextEl": ".swiper-button-next","prevEl":".swiper-button-prev"}'
                data-autoplay='{"delay": "1500","disableOnInteraction": "false"}'
                data-slides-per-view="auto"
                data-space-between="10"
                data-loop="true"
                data-centered-slides="true"
                data-auto-play='true'
                data-preventClicksPropagation="true"
                data-touch-move-stop-propagation="false"
                data-breakpoints='{  "640": { "slidesPerView": "1.5" },"800": { "slidesPerView": "2" }, "1000": { "slidesPerView": "2.5" } , "1200": { "slidesPerView": "3" } , "1300": { "slidesPerView": "4" }}'
                class="swiper-container swiper-init demo-swiper">
          	<div class="swiper-pagination"></div>
          	<!--div class="swiper-scrollbar"></div-->
          	<div class="swiper-wrapper">
              ${eventlsit.map( (eventitem)=>$h`
                <div class="swiper-slide" @click=${clickbanner}>
                    <img src="${eventitem.img}" data-url="/about/" />
                </div>
              `)}
          	</div>
          </div>
        </div>
      </div>
      <!-- / top swiper -->

      <!-- 메인 카테고리 -->
      <div class="page-content-wrap background-none">
        <div class="wrap display-flex justify-content-center wrap-bgimage-wave">
          <div class="nbyn-wrap max-width-limit-">
            <a href="#" class="link nbyn-item"><div style="background-image:url(/v1/image/main_N/main_m_bn02.png)"></div><i class="far fa-question-circle popup-open" data-popup=".demo-popup3"></i></a>
            <a href="#" class="link nbyn-item"><div style="background-image:url(/v1/image/main_N/main_m_bn01.png)"></div><i class="far fa-question-circle popup-open" data-popup=".demo-popup"></i></a>
            <a href="/righttest/" data-view=".view-right" data-panel="right" class="link nbyn-item panel-open"><div style="background-image:url(/v1/image/main_N/main_bn03.png)"></div></a>
            <a href="#" class="link nbyn-item">
              <div class="with-text" style="background-color: #01bcfe;">
                <div class="nbyn-inner-box">
                  <div>간편하게</div>
                  <div>이사업체</div>
                  <div>추천받기</div>
                </div>
              </div>
              <i class="far fa-question-circle popup-open" data-popup=".demo-popup3"></i>
            </a>
            <a href="#" class="link nbyn-item">
              <div class="with-text">
                <div class="nbyn-inner-box">
                  <div>코로나시대!!</div>
                  <div>비대면으로</div>
                  <div>이사하자!!!</div>
                </div>
              </div>
              <i class="far fa-question-circle popup-open" data-popup=".demo-popup"></i>
            </a>
            <a href="/v2/mob/event/free_event" class="link nbyn-item"><div style="background-image:url(/v1/image/main_N/free_event.png)"></div></a>
          </div>
        </div>
      </div>
      <!-- /메인 카테고리 -->

      <!-- 메인 지식인 -->
      <div class="page-content-wrap display-flex justify-content-center elevation-3">
        <div class="wrap main-jisik-wrap max-width-limit">
          <div class="block-title block-title-medium"><span style="color:#00beff">이사지식인<i class="far fa-question-circle popover-open" data-popover=".jisik_popover"></i></span> 에 질문하세요
          </div>

          <div class="list media-list jisik-medis-list">
          	<ul>
          		<li>
          			<div class="item-content">
          				<div class="item-media">
          					<img src="/v1/image/main_N/icon_qna.png"/>
          				</div>
          				<div class="item-inner">
          					<div class="item-title-row">
          						<div class="item-title"><b class="color_pt">이사지식인 <i class="far fa-question-circle popover-open" data-popover=".jisik_popover"></i> </b> 검색</div>
          						<a class="link item-after color_pt button ">질문하기 <i class="fas fa-chevron-right"></i></a>
          					</div>
          					<div class="item-subtitle"><b class="color_pt">현업에 계신 전문가</b>들의 진솔한 답변을 받으실 수 있습니다.</div>
                    <div class="search_Box">
                      <form action="/community/posts/jisik" id="jisikform">
                          <input type="search_option" value="title" style="display: none" />
                          <input type="text" name="search" placeholder="ex)포장이사 후회하지 않고 하는 법" id="searchtext"/>
                          <label></label>
                          <span class="btn_form" href="/community/posts/jisik">검색</span>
                      </form>
                    </div>
          				</div>
          			</div>
          		</li>
          	</ul>
          </div>

        </div>
      </div>
      <!-- / 메인 지식인 -->

      <!-- 메인 커뮤니티 -->
      <div class="page-content-wrap page-content-wrap-community background-none">

        <div class="display-flex justify-content-center elevation-3 page-content-wrap-inner">
          <div class="wrap main-community main-community-jisik">

            <div class="block-title block-title-medium">이사<span class="color_blue">지식인</span>
              <div class="float-right">
                <a href="#" class="link link-item">
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>

            <div class="list media-list main-community-inner  chevron-center">
              <ul>
                <li>
                  <a href="#" class="item-link item-content">
                    <div class="item-inner">
                      <div class="item-title-row">
                        <div class="item-title">Q. 이사 할 때 거리로 측정하는 비용이요</div>
                      </div>
                      <div class="item-text">
                        A.네.수원에서오산 용인 은같고 수원에서평택은십만원정도 고객님이 어느곳에사시는지를 먼저적고 도착지를적어주시면더정확한데 시를 넘어도 같은금액이나오는곳이있고 십만원정도 더받는곳도있고 업체마다약간의차이가있으니 견적볼때물어보세요
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#" class="item-link item-content">
                    <div class="item-inner">
                      <div class="item-title-row">
                        <div class="item-title">Q. 이사 할 때 거리로 측정하는 비용이요</div>
                      </div>
                      <div class="item-text">
                        A.네.수원에서오산 용인 은같고 수원에서평택은십만원정도 고객님이 어느곳에사시는지를 먼저적고 도착지를적어주시면더정확한데 시를 넘어도 같은금액이나오는곳이있고 십만원정도 더받는곳도있고 업체마다약간의차이가있으니 견적볼때물어보세요
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#" class="item-link item-content">
                    <div class="item-inner">
                      <div class="item-title-row">
                        <div class="item-title">Q. 이사 할 때 거리로 측정하는 비용이요</div>
                      </div>
                      <div class="item-text">
                        A.네.수원에서오산 용인 은같고 수원에서평택은십만원정도 고객님이 어느곳에사시는지를 먼저적고 도착지를적어주시면더정확한데 시를 넘어도 같은금액이나오는곳이있고 십만원정도 더받는곳도있고 업체마다약간의차이가있으니 견적볼때물어보세요
                      </div>
                    </div>
                  </a>
                </li>
                <li class="media-last-btn">
                  <a href="#" class="item-link item-content">
                    <div class="item-inner">
                      <div class="item-title-row">
                        <div class="item-title">이사 지식인 더보기</div>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>

          </div>
        </div>

        <div class="display-flex justify-content-center elevation-3 page-content-wrap-inner">
          <div class="wrap main-community main-community-tip">
            <div class="block-title block-title-medium">모두꿀<span class="color_blue">TIP</span>
              <div class="float-right">
                <a href="#" class="link link-item">
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
            <div class="list main-community-inner">
              <div class="by4-list-wrap">
                <div class="by4-list">
                  <a href="#" class="link">
                    <div style="background-image: url('https://modoo24.net/community/storage/post/220117/220117102614_cSqGPwlR2.jpeg');"></div>
                  </a>
                  <a href="#" class="link">
                    <div style="background-image: url('https://modoo24.net/community/storage/post/220112/220112020129_ixPferb5i.jpeg');"></div>
                  </a>
                  <a href="#" class="link">
                    <div style="background-image: url('https://modoo24.net/community/storage/post/220110/220110101744_GwlkHfvfm.jpeg');"></div>
                  </a>
                  <a href="#" class="link">
                    <div style="background-image: url('https://modoo24.net/community/storage/post/220107/220107063240_sFIlXHaqP.jpeg');"></div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="display-flex justify-content-center elevation-3 page-content-wrap-inner">
          <div class="wrap main-community main-community-fun">
            <div class="block-title block-title-medium">모두<span class="color_blue">FUN</span>
              <div class="float-right">
                <a href="#" class="link link-item">
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>

            <div class="list media-list main-community-inner chevron-center">
              <ul>
              	<li>
              		<a href="#" class="item-link item-content">
              			<div class="item-media">
              				<img src="https://modoo24.net/community/storage/post/220124/220124012808_xYXQjibWl.png" width="80" />
              			</div>
              			<div class="item-inner">
              				<div class="item-title-row">
              					<div class="item-text">[서울/종로] 엽전으로 떠나는 맛집 투어! 통인시장</div>
              				</div>
              				<div class="item-text text-align-right">
                        22.01.24
                      </div>
              			</div>
              		</a>
              	</li>
                <li>
              		<a href="#" class="item-link item-content">
              			<div class="item-media">
              				<img src="https://modoo24.net/community/storage/post/220124/220124012808_xYXQjibWl.png" width="80" />
              			</div>
              			<div class="item-inner">
              				<div class="item-title-row">
              					<div class="item-text">[서울/종로] 엽전으로 떠나는 맛집 투어! 통인시장</div>
              				</div>
              				<div class="item-text text-align-right">
                        22.01.24
                      </div>
              			</div>
              		</a>
              	</li>
                <li>
              		<a href="#" class="item-link item-content">
              			<div class="item-media">
              				<img src="https://modoo24.net/community/storage/post/220124/220124012808_xYXQjibWl.png" width="80" />
              			</div>
              			<div class="item-inner">
              				<div class="item-title-row">
              					<div class="item-text">[서울/종로] 엽전으로 떠나는 맛집 투어! 통인시장</div>
              				</div>
              				<div class="item-text text-align-right">
                        22.01.24
                      </div>
              			</div>
              		</a>
              	</li>

              </ul>
            </div>
          </div>
        </div>

      </div>
      <!-- /메인 커뮤니티 -->

      <!-- 리뷰 -->
      <div class="page-content-wrap page-content-wrap-review elevation-3">
        <div class="wrap">
          <div class="block-title block-title-medium">모두이사<span class="color_blue">후기</span>
            <div class="float-right">
              <a href="#" class="link link-item">
                <i class="fas fa-plus"></i>
              </a>
            </div>
          </div>
            <div id="reviewswiper"
                  data-pagination='{"el": ".swiper-pagination", "clickable": true}'
                  data-navigation='{"nextEl": ".swiper-button-next","prevEl":".swiper-button-prev"}'
                  data-autoplay='{"delay": "1500","disableOnInteraction": "false"}'
                  data-slides-per-view="auto"
                  data-space-between="10"
                  data-loop="true"
                  data-centered-slides="true"
                  data-autoplay-='true'
                  data-preventClicksPropagation="true"
                  data-touch-move-stop-propagation="false"

                  class="swiper-container swiper-init review-swiper">
            	<div class="swiper-pagination"></div>
            	<!--div class="swiper-scrollbar"></div-->
            	<div class="swiper-wrapper">
                @foreach ( $reviews as $review)

                <div class="swiper-slide">
                    <div class="main-review-item">

                      <div class="main-review-item_header">
                        <div class="main-review-item_header-title singleline-ellipsis">{{ $review->s_company }}</div>
                        <div class="main-review-item_header-subtitle">({{$review->company_point_title}})</div>
                      </div>

                      <div class="main-review-item_star_wrap">
                        <div class="main-review-item_star">
                          <img src="/v1/image/main_N/big_star.png" alt="star" />
                          <div class="move_review_item_point">
                            {{$review->avg}}
                          </div>
                        </div>
                      </div>

                      <div class="main-review-item_review">
                        <div class="item-text">
                          {!! nl2br(strip_tags($review->b_note)) !!}

                        </div>
                      </div>

                    </div>

                </div>
                @endforeach
            	</div>
            </div>
        </div>
      </div>
      <!-- /리뷰 -->

      <div class="footer_wrap">
        <div class="footer_inner">
          <div class="footer_list">
            <ul class="ft_link">
                <li>
                    <a class="link" href="/v2/mob/common/accessterms">이용약관</a>
                </li>
                <li>
                    <span class="link" @click=${() => loadsheet('/new_common/popup/personal_data.html','개인정보 처리 방침') } >개인정보처리방침</span>
                </li>
                <li>
                    <a class="link" href="#" @click=${() => loadsheet('/new_common/popup/personal_3.html','제 3자 제공 동의') } >제 3자 제공동의</a>
                </li>
                <li>
                    <a class="link" href="/v2/mob/common/accessterms">파트너제휴</a>
                </li>
                <li>
                    <a class="link" href="/v2/mob/event/free_event">사연모집</a>
                </li>

            </ul>
          </div>
          <div class="footer_list">모두플랫폼은 OnLine Total Life Care Service Open Market을 주사업으로 하며
            <span class="color_pt">이사서비스의 계약과 운송책임은 이사서비스제공 운송사업자와 계약당사자간에 있습니다.</span>
          </div>
          <div class="footer_list">Copyright © 모두플랫폼 Corporation All rights reserved.</div>
          <div class="footer_list">
            <a href="mailto:master@modoo24.net" class="link external">광고 및 제휴문의 – modoo24try@naver.com </a>
          </div>

          <div class="footer_list tab-content">
            <div>(주)모두플랫폼 대표 : 심준보</div>
            <div>주소 : 인천광역시 연수구 함박뫼로 50번길 95, 5층(연수동)</div>
            <div>TEL : 1600 - 7728</div>
            <div>FAX : 032 - 811 - 2482</div>
            <div>사업자 등록번호 : 236-81-01081</div>
            <div>통신판매업신고증 : 제 2019-인천연수구-0290 호</div>
          </div>
        </div>
      </div>
  	</div>
    <!-- /홈 -->

    <!-- 지식 팝오버 -->
    <div class="popover jisik_popover">
    	<div class="popover-angle on-bottom"></div>
    	<div class="popover-inner">
    		<div class="list">
          <div class="block-title block-title-medium text-align-center margin-top"><span style="color:#00beff">이사지식인</span>이란</div>
          <div class="block block-strong">
            <p> <b class="color_pt">현업에 계신 전문가</b>들의 진솔한 답변을 받으실 수 있습니다.</p>
            <p>어쩌구 저쩌구...</p>
            <p>어쩌구 저쩌구...</p>
          </div>
          <div>
            <p class="row margin no-margin-top">
              <button class="col button button-raised button-fill">질문하러 가기</button>
            </p>
          </div>
    		</div>
    	</div>
    </div>
    <!-- / 지식 팝오버 -->


<!-- popup -->
    <div class="popup demo-popup">
    	<div class="page">
    		<div class="navbar">
    			<div class="navbar-bg"></div>
    			<div class="navbar-inner">
    				<div class="title">비대면 이사란</div>
    				<div class="right"><a href="#" class="link popup-close">Close</a></div>
    			</div>
    		</div>
    		<div class="page-content">
    			<div class="block">
    					비대면이란....
    			</div>
    		</div>
    	</div>
    </div>
<!-- popup -->
    <div class="popup demo-popup2">
    	<div class="page">
    		<div class="navbar">
    			<div class="navbar-bg"></div>
    			<div class="navbar-inner">
    				<div class="title">간편견적</div>
    				<div class="right"><a href="#" class="link popup-close">Close</a></div>
    			</div>
    		</div>
    		<div class="page-content">
    			<div class="block">
    					간편견적.
    			</div>
    		</div>
    	</div>
    </div>

  <!-- popup -->
      <div class="popup demo-popup3">
      	<div class="page">
      		<div class="navbar">
      			<div class="navbar-bg"></div>
      			<div class="navbar-inner">
      				<div class="title">방문견적 이사란</div>
      				<div class="right"><a href="#" class="link popup-close">Close</a></div>
      			</div>
      		</div>
      		<div class="page-content">
      			<div class="block">
      					비대면이란....
      			</div>
      		</div>
      	</div>
      </div>
  </div>
</template>
<script>

  export default (props, { $f7, $, $update, $onMounted ,$on}) => {
    let actionsGrid;
    //var title ='12'
    const openGrid = () => {
      actionsGrid.open();
      //title = "newtitle"
      //$update();
      // 템플릿 에서는 ${title}
    }
    const clickbanner =(e)=>{
      app.views.main.router.navigate($(e.target).data('url'))
    }
    const bgColorPallete=()=>{
      changeBackgroundColor();
    }
    var eventlsit = [
      {img:'/v1/image/main_N/event_220106_m.jpg',url:''},
      {img:'/v1/image/main_N/event_ss_m.jpg',url:''},
      {img:'/v1/image/main_N/event_220106_m.jpg',url:''},
      {img:'/v1/image/main_N/event_ss_m.jpg',url:''},
      {img:'/v1/image/main_N/event_220106_m.jpg',url:''},
      {img:'/v1/image/main_N/event_ss_m.jpg',url:''},
    ];
    $on('pageInit', () => {
      const gridButtons = [
          [
            {
              text: '회사소개',
              icon: '<img src="/v1/image/main_N/info_mf.png" width="48" style="max-width: 100%"/>',
              onClick: function () {
                app.views.main.router.navigate('/about/')
              }
            },
            {
              text: '유투브',
              icon: '<img src="/v1/image/main_N/info_youtube.png" width="48" style="max-width: 100%">',
              onClick: function () {
                app.views.main.router.navigate('/about/')
              }
            },
            {
              text: '블로그',
              icon: '<img src="/v1/image/main_N/info_bg.png" width="48" style="max-width: 100%">',
              onClick: function () {
                app.views.main.router.navigate('/about/')
              }
            },
            {
              text: '페이스북',
              icon: '<img src="/v1/image/main_N/info_fb.png" width="48" style="max-width: 100%"/>',
              onClick: function () {
                app.views.main.router.navigate('/about/')
              }
            },
          ],
          [
            {
              text: '인스타',
              icon: '<img src="/v1/image/main_N/info_it" width="48" style="max-width: 100%"/>',
              onClick: function () {
                app.views.main.router.navigate('/about/')
              }
            },
            {
              text: '이벤트',
              icon: '<img src="/v1/image/main_N/info_evt.png" width="48" style="max-width: 100%"/>',
              onClick: function () {
                app.views.main.router.navigate('/about/')
              }
            },
            {
              text: '이사후기',
              icon: '<img src="/v1/image/main_N/info_good.png" width="48" style="max-width: 100%">',
              onClick: function () {
                app.views.main.router.navigate('/about/')
              }
            },
            {
              text: '카카오',
              icon: '<img src="/v1/image/main_N/info_kakao.png" width="48" style="max-width: 100%">',
              onClick: function () {
                app.views.main.router.navigate('/about/')
              }
            },
          ],
        ]
      actionsGrid = $f7.actions.create({ buttons: gridButtons, grid: true });
    })
    $onMounted(() => {
      console.log('component mounted')
    });
    $on('pageBeforeRemove', () => {
      actionsGrid.destroy();
    })
    return $render;
  }
</script>
