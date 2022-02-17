<template>
  <div class="page" data-name="myrequest">
  	<div class="navbar">
  		<div class="navbar-bg"></div>
  		<div class="navbar-inner sliding">
  			<div class="left">
  				<a href="#" class="link back">
  					<i class="icon icon-back"></i>
  					<span class="if-not-md">Back</span>
  				</a>
  			</div>
  			<div class="title">신청내역</div>
        <div class="right"><a href="#" class="link icon-only panel-open" data-panel="left"><i class="fas fa-truck-moving"></i></a></div>
  		</div>
  	</div>
  	<div class="toolbar toolbar-top tabbar">
  		<div class="toolbar-inner">
  			<a href="#tab-all" class="tab-link ${(inittab === "") ? $h`tab-link-active`:``}">전체</a>
  			<a href="#tab-face" class="tab-link ${(inittab === "face") ? $h`tab-link-active`:``}">방문</a>
  			<a href="#tab-nface" class="tab-link ${(inittab === "nface") ? $h`tab-link-active`:``}">비대면</a>
        <a href="#tab-clean" class="tab-link ${(inittab === "clean") ? $h`tab-link-active`:``}">청소</a>
  		</div>
  	</div>
  	<div class="tabs-swipeable-wrap">

  		<div class="tabs">


  			<div id="tab-all" class="page-content tab ${(inittab === "") ? $h`tab-active`:``}">
  				<div class="page-content-wrap">

            <div class="vit-cp-list-visual-wrap withline">
              <div class="vit-cp-list-visual">
                <div class="vit-cp-list-visual-inner">
                  <div class="vit-cp-list-visual-txt">
                    내 이사/청소 <b>신청내역을 확인</b> 해 보세요.
                  </div>
                </div>
              </div>
            </div>

            <div class="wrap display-flex justify-content-center">
              <div class="inner-wrap max-width-limit-cont">
                ${(allitem.length < 1) ? $h`
                  <div class="card">
                    <div class="card-content card-content-padding">
                      <div class="card-inner-noneitem">
                        신청내역이 없습니다.
                      </div>
                    </div>
                  </div>
                  `:$h`
                  ${allitem.map( (item)=>$h`
                    <${requestItemFace} kind="${item.kind}" kind_title="${item.kind_title}" mdate="${item.mdate}" reg_date="${item.reg_date}" d_cnt="${item.d_cnt}" c_cnt="${item.c_cnt}" staff_cnt="${item.staff_cnt}" />
                  `)}
                `}
              </div>
            </div>

          </div>
        </div>

        <div id="tab-face" class="page-content tab ${(inittab === "face") ? $h`tab-active`:``}">
          <div class="page-content-wrap">

            <div class="vit-cp-list-visual-wrap withline">
              <div class="vit-cp-list-visual">
                <div class="vit-cp-list-visual-inner">
                  <div class="vit-cp-list-visual-txt">
                    내 방문견적 <b>신청내역을 확인</b> 해 보세요.
                  </div>
                </div>
              </div>
            </div>

            <div class="wrap display-flex justify-content-center">
              <div class="inner-wrap max-width-limit-cont">
                ${(faceitem.length < 1) ? $h`
                  <div class="card">
                    <div class="card-content card-content-padding">
                      <div class="card-inner-noneitem">
                        신청내역이 없습니다.
                      </div>
                    </div>
                  </div>
                  `:$h`

                    ${faceitem.map( (item)=>$h`
                        <${requestItemFace} kind="${item.kind}" kind_title="${item.kind_title}" mdate="${item.mdate}" reg_date="${item.reg_date}" d_cnt="${item.d_cnt}" c_cnt="${item.c_cnt}" staff_cnt="${item.staff_cnt}" />
                    `)}
                `}
              </div>

            </div>

          </div>
        </div>

        <div id="tab-nface" class="page-content tab ${(inittab === "nface") ? $h`tab-active`:``}">
          <div class="page-content-wrap">

            <div class="vit-cp-list-visual-wrap withline">
              <div class="vit-cp-list-visual">
                <div class="vit-cp-list-visual-inner">
                  <div class="vit-cp-list-visual-txt">
                    내 비대면견적 <b>신청내역을 확인</b> 해 보세요.
                  </div>
                </div>
              </div>
            </div>

            <div class="wrap display-flex justify-content-center">
              <div class="inner-wrap max-width-limit-cont">
                ${(nfaceitem.length < 1) ? $h`
                  <div class="card">
                    <div class="card-content card-content-padding">
                      <div class="card-inner-noneitem">
                        신청내역이 없습니다.
                      </div>
                    </div>
                  </div>
                  `:$h`
                    ${nfaceitem.map( (item)=>$h`
                      <${requestItemFace} kind="${item.kind}" kind_title="${item.kind_title}" mdate="${item.mdate}" reg_date="${item.reg_date}" d_cnt="${item.d_cnt}" c_cnt="${item.c_cnt}" staff_cnt="${item.staff_cnt}" />
                    `)}
                `}
              </div>

            </div>

          </div>
        </div>

        <div id="tab-clean" class="page-content tab ${(inittab === "clean") ? $h`tab-active`:``}">
          <div class="page-content-wrap">

            <div class="vit-cp-list-visual-wrap withline">
              <div class="vit-cp-list-visual" style="background-color:#4caf50;color:#ffeb3b;">
                <div class="vit-cp-list-visual-inner">
                  <div class="vit-cp-list-visual-txt">
                    내 입주청소 <b>신청내역을 확인</b> 해 보세요.
                  </div>
                </div>
              </div>
            </div>

            <div class="wrap display-flex justify-content-center">
              <div class="inner-wrap max-width-limit-cont">
                ${(cleanitem.length < 1) ? $h`
                  <div class="card">
                    <div class="card-content card-content-padding">
                      <div class="card-inner-noneitem">
                        신청내역이 없습니다.
                      </div>
                    </div>
                  </div>
                  `:$h`
                    ${cleanitem.map( (item)=>$h`
                      <${requestItemFace} kind="${item.kind}" kind_title="${item.kind_title}" mdate="${item.mdate}" reg_date="${item.reg_date}" d_cnt="${item.d_cnt}" c_cnt="${item.c_cnt}" staff_cnt="${item.staff_cnt}" />
                    `)}
                `}
              </div>

            </div>

          </div>
        </div>


      </div>


    </div>
  </div>
</template>
<style>
.page[data-name="myrequest"]{
  --wrap-max-width:600px;
  --item-default-color:#4583ee;
}
.page[data-name="myrequest"] .card{
  border: 1px solid rgb(0 0 0 / 29%);
}
.request-item-대면{
  --item-default-color:#4583ee;
}
.request-item-비대면{
  --item-default-color:#00beff;
}
.request-item-청소{
  --item-default-color:#0fa146;
}
.myrequest-item-inner{
  flex-grow: 1;
}
.myrequest-item-inner .round-btn {
    padding: 7px 10px;
    display: inline-block;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 500;

    border: 1px solid var(--item-default-color);
    color: var(--item-default-color);
}
.myrequest-round-box{
  height: 96px;
  width: 96px;
  border-radius: 50%;
  color:white;
  display: flex;
  justify-content: center;
  flex-direction: column;
  font-weight: 500;
  font-size: 16px;

  background: var(--item-default-color);
}
.myrequest-round-box-inner{
  text-align: center;
  margin-top: -10px;
}
.myrequest-round-box-num{
  font-size: 30px;
}

.card  > a {
    transition-duration: .3s;
    transition-property: background-color;
    display: block;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    align-content: center;
    justify-content: space-between;
    box-sizing: border-box;
    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: 100%;
    color: inherit;
}
.card  > a.active-state {
    background-color: var(--f7-list-link-pressed-bg-color);
}
.card  > a > .card-content{
  width:100%;
}
</style>

<script>
  const requestItemFace  = (props, {$, $f7, $ref, $h }) => {
    return () => $h`
    <div class="card">
      <a href="#">
        <div class="card-content card-content-padding request-item-${props.kind}">
            <div class="myrequest-content display-flex">
              <div class="myrequest-item-inner">
                <div>
                  <span class="round-btn">${props.kind_title}</span>
                </div>
                <div>이사일 : ${props.mdate}</div>
                <div>신청일 : ${ moment(props.reg_date).format('YYYY-MM-DD') }</div>
              </div>
              <div class="myrequest-item-media">


                  ${(props.kind=="비대면") ? $h`
                    ${ props.d_cnt > 0 ? $h`
                      <img src="/NEW/image/pop/contract_ok.png" style="width:95px" />
                    `:
                    $h`
                    <div class="myrequest-round-box">
                      <div class="myrequest-round-box-inner">
                        <div class="myrequest-round-box-num">${props.c_cnt}</div>
                        <div class="myrequest-round-box-sub">견적도착</div>
                      </div>
                    </div>
                    `}
                  `:$h`
                    ${(props.kind=="청소") ? $h`
                    <div class="myrequest-round-box">
                      <div class="myrequest-round-box-inner">
                        <div class="myrequest-round-box-num">${props.staff_cnt}</div>
                        <div class="myrequest-round-box-sub">업체매칭</div>
                      </div>
                    </div>
                    `:$h`
                    <div class="myrequest-round-box">
                      <div class="myrequest-round-box-inner">
                        <div class="myrequest-round-box-num">${props.staff_cnt}</div>
                        <div class="myrequest-round-box-sub">업체매칭</div>
                      </div>
                    </div>
                    `}
                  `}



              </div>
            </div>
        </div>
      </a>
    </div>
    `
  }
  export default async (props, { $f7, $, $update, $onMounted ,$on}) => {
    var inittab = ''
    var allitem = {!! json_encode($data, true) !!}
    var faceitem = allitem.filter( it => it.kind=="방문")
    var nfaceitem = allitem.filter( it => it.kind=="비대면")
    var cleanitem = allitem.filter( it => it.kind=="청소")
    console.log(faceitem)
    return $render;
  }
</script>
