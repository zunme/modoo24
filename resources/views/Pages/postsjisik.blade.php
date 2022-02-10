<template>
  <div class="page">
  	<div class="navbar">
  		<div class="navbar-bg"></div>
  		<div class="navbar-inner sliding">
  			<div class="left">
  				<a href="#" class="link back">
  					<i class="icon icon-back"></i>
  					<span class="if-not-md">Back</span>
  				</a>
  			</div>
  			<div class="title">이사지식인</div>
        <div class="right"><a href="#" class="link icon-only panel-open" data-panel="left"><i class="fas fa-truck-moving"></i></a></div>
  		</div>
  	</div>
    <div class="page-content darkmode1">
      <div class="page-content-wrap display-flex justify-content-center">

        <div class="wrap max-width-limit post-jisik-wrap">
          <div class="list media-list">
          	<ul class="elevation-3">
          		<li>
          			<div class="item-content">
          				<div class="item-inner">
          					<div class="item-title-row justify-content-end margin-right padding-right">
          						<div class="item-title-multiline text-align-right">{{$post->title}}</div>
          					</div>
          					<div class="item-subtitle margin-right padding-right text-align-right">{{$post->nickname}}</div>
                    <div class="item-text margin-right padding-right text-align-right">{{$post->created_at}}</div>
          				</div>
          			</div>
          		</li>

              <li>
          			<div class="item-content">
          				<div class="item-inner">
          					<div class="item-title-row">
          						<div class="item-title-multiline post-jisik-body">
                        @if ( $config->html_use =='Y')
                          {!! $post->body !!}
                        @else
                          {!! nl2br(e($post->body)) !!}
                        @endif
                      </div>
          					</div>
          				</div>
          			</div>
          		</li>

          	</ul>
          </div>

@if( count($post->files)>0 )
  <${inlinePhotoViewComponent} photos="${[
    @foreach ( $post->files as $idx=>$file)
      {'url':"/community/storage/{{$file->url}}"},
    @endforeach
  ]}" />
@endif
          <div class="block-title">답글</div>
          @if( $post->comments && $post->comments->count() > 0 )
          <div class="block">
              <div class="list media-list comment-list">
                <ul>
                  <!-- -->
                  @foreach ( $post->comments as $comment)
                  <li>
                  	<div class="item-content">
                  		<div class="item-media">
                  			<div class="item-media-default-img" />
                  		</div>
                  		<div class="item-inner">
                  			<div class="item-title-row">
                  				<div class="item-title">{{$comment->s_company}}</div>
                  			</div>
                  			<div class="item-text-multiline">
                          @if( $comment->is_confirmed == 'Y')
                            {!! nl2br(e($comment->body)) !!}
                          @else
                          <span ckass="confirm_waiting">이사지식인 답글은 고객과의 분쟁 방지를 위해 이사지식인 규정 확인 후 노출됩니다.</span>
                          @endif

                          <${FavoriteNum} commentid="{{$comment->id}}" favnum="{{$comment->best_cnt}}" />
                  			</div>
                  		</div>

                  	</div>
                  </li>
                  @endforeach
                  <!-- -->
                </ul>
              </div>
          </div>
          @endif

        </div>

      </div>
    </div>
  </div>
</template>
<style>

</style>
<script>

const FavoriteNum = (props, {$, $f7, $ref, $h }) => {
  var favnum = $ref(props.favnum)

  const updateFav = async ()=>{
    try {
      var data = await axios.post('/community/posts/comment/addbestcntV2' ,{
        id: props.commentid,
      })
      if( data ){
        favnum.value = parseInt(favnum.value) + 1;
      }

    } catch(e){;}

  }

  return () => $h`
  <div class="item-fav display-flex justify-content-end">
    <div class="item-fav-inner" data-id="${props.commentid}" @click=${updateFav}>
      <i class="fas fa-heart"></i>
      <span class="link-item item-fav-inner-num">${favnum.value}</span>
    </div>
  </div>
  `;
}
export default (props, { $f7, $, $update, $onMounted ,$on }) => {

  $on('pageInit', () => {

  });
  $on('pageBeforeRemove', () => {
    //photoview.destroy();
  });
  return $render;
}
</script>
