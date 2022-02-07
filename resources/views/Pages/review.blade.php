<template>
<div class="popup">
  <div class="page">
    <div class="navbar">
      <div class="navbar-bg"></div>
      <div class="navbar-inner">
        <div class="title">이사후기</div>
        <div class="right"><a href="#" class="link popup-close">Close</a></div>
      </div>
    </div>
    <div class="page-content">

      <div class="wrap">

        <div class="display-flex justify-content-end inline-panel-mdate " style="margin-top:20px;">
          <div class="inline-panel-mdate-label">이사일</div>
          <div class="inline-panel-mdate-date">{{$row->b_mdate}}</div>
        </div>

        <div class="list media-list">
        	<ul>
        		<li>
        			<div class="item-content">
        				<div class="item-media">
        					<img src="/v1/image/sub/rating_{{$row->gradePic}}.png" width="40" />
        				</div>
        				<div class="item-inner">
        					<div class="item-title-row">
        						<div class="item-title">{{$row->s_company}}</div>
        					</div>
        					<div class="item-subtitle">( {{$row->gradeTitle}} )</div>
                  <div class="item-points display-flex justify-content-end">
                    <div class="inline-panel-rating-inner">
                      @include( "Front.componentstar",["stars"=>$row->avgstararr])
                    </div>
                    <div class="inline-panel-rating-point-label">
                        {{$row->avgstar}}점
                    </div>
                  </div>
        				</div>
        			</div>
        		</li>
        	</ul>
        </div>

        <div class="inline-panel-rating display-flex justify-content-center">
          <div class="inline-panel-rating-wrap display-flex">
            <div class="inline-panel-rating-title">전문성</div>
            <div class="inline-panel-rating-inner">
              @include( "Front.componentstar",["stars"=>$row->b_star_pro_arr])
            </div>
          </div>
          <div class="inline-panel-rating-wrap display-flex">
            <div class="inline-panel-rating-title">친절성</div>
            <div class="inline-panel-rating-inner">
              @include( "Front.componentstar",["stars"=>$row->b_star_kind_arr])
            </div>
          </div>
          <div class="inline-panel-rating-wrap display-flex">
            <div class="inline-panel-rating-title">가격도</div>
            <div class="inline-panel-rating-inner">
              @include( "Front.componentstar",["stars"=>$row->b_star_price_arr])
            </div>
          </div>
          <div class="inline-panel-rating-wrap display-flex">
            <div class="inline-panel-rating-title">마무리</div>
            <div class="inline-panel-rating-inner">
              @include( "Front.componentstar",["stars"=>$row->b_star_finish_arr])
            </div>
          </div>
          <div class="inline-panel-rating-wrap display-flex">
            <div class="inline-panel-rating-title">사후관리</div>
            <div class="inline-panel-rating-inner">
              @include( "Front.componentstar",["stars"=>$row->b_star_expost_arr])
            </div>
          </div>
          <div class="inline-panel-rating-wrap display-flex">
            <div class="inline-panel-rating-title">포장도</div>
            <div class="inline-panel-rating-inner">
              @include( "Front.componentstar",["stars"=>$row->b_star_pave_arr])
            </div>
          </div>
        </div>

        <div class="inline-panel-review">
          {!! $row->b_note !!}
        </div>

<ul class="thumbnail-box-80-wrap display-flex justify-content-end">
  <li>
    <a href="#1" class="thumbnail-box-80" data-index="0"
        style="background-image: url(https://modoo24.net/community/storage/post/220119/220119103730_fe0WwMPey.jpeg);"
        @click=${openPhoto} > </a>
  </li>
  <li>
    <a href="#1" class="thumbnail-box-80" data-index="1"
        style="background-image: url(https://modoo24.net/community/storage/post/220119/220119103730_fe0WwMPey.jpeg);"
        @click=${openPhoto} > </a>
  </li>
  <li>
    <a href="#1" class="thumbnail-box-80" data-index="2"
        style="background-image: url(https://modoo24.net/community/storage/post/220119/220119103730_fe0WwMPey.jpeg);"
        @click=${openPhoto} > </a>
  </li>
</ul>
        @if( $row->files)
            <ul class="thumbnail-box-80-wrap display-flex justify-content-end">
              @foreach( $row->files as $file)
              <li>
                <a href="#1" class="thumbnail-box-80"  data-index="{{@index}}" style="background-image: url(/v2/storage{{$file->url}});"></a>
              </li>
              @endforeach
            </ul>
        @endif


      </div>

    </div>
  </div>
</div>
</template>

<script>
  export default async (props, { $f7 ,$on}) => {
    var myPhotoBrowserStandalone;
    $$(".thumbnail-box-80").on("click", function(e){
        myPhotoBrowserStandalone.open(2)
    })
    const openPhoto =(e)=>{
      var index = $(e.target).data('index')
      myPhotoBrowserStandalone.open(index)
    }

    $on('popupOpen', () => {
        myPhotoBrowserStandalone = $f7.photoBrowser.create({
        /*=== Default standalone ===*/
          photos: [
            'https://cdn.framework7.io/placeholder/sports-1024x1024-1.jpg',
            'https://cdn.framework7.io/placeholder/sports-1024x1024-2.jpg',
            'https://cdn.framework7.io/placeholder/sports-1024x1024-3.jpg',
          ],
            type: 'popup'
        });
    })
    $on('popupClosed', () => {
      myPhotoBrowserStandalone.close();
      myPhotoBrowserStandalone.destroy();
    })
    return $render;
  }
</script>
