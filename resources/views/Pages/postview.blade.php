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
  			<div class="title">{{$config->title}}</div>
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
                    <div class="item-text margin-right padding-right text-align-right">
                      <a href="#" class="snsbtn twitter-btn" data-link="twitter"  @click=${snssahrefn}>
                        <i class="fab fa-twitter-square" style="color:#1da1f2"></i>
                      </a>
                      <a href="#" class="snsbtn twitter-btn" data-link="facebook"  @click=${snssahrefn}>
                        <i class="fab fa-facebook-square" style="color:#1da1f2"></i>
                      </a>
                      <a href="#" class="snsbtn twitter-btn" data-link="kakao"  @click=${snssahrefn}>
                        <img src="/community/images/kakao.logo.png" style="width:36px;" />
                      </a>
                    </div>
          				</div>
          			</div>
          		</li>

              <li>
          			<div class="item-content">
          				<div class="item-inner">
          					<div class="item-title-row flex-direction-column">
          						<div class="item-title-multiline post-jisik-body" id="post_body">

                      </div>
                      <div>
                        <${bestNum} postid="{{$post->id}}" favnum="{{$post->fav_cnt}}" />
                      </div>
          					</div>
          				</div>
          			</div>
          		</li>

          	</ul>
          </div>

          <div class="block-title">답글</div>

          <div class="block">
              <div class="list media-list comment-list" id="commnet_block">
                <ul>

                </ul>
              </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</template>
<style>
.snsbtn i.fab{
  font-size: 36px;
  position: inherit;
}
</style>

<script>
const bestNum = (props, {$, $f7, $ref, $h }) => {
  var favnum = $ref(props.favnum)

  const updateFav = async ()=>{
    try {
      var data = await axios.post('/community/posts/{{$code}}/favorite/'+props.postid ,{
        id: props.postid,
      })
      if( data ){
        favnum.value = data.data.data.fav_cnt;
      }

    } catch(e){;}

  }

  return () => $h`
  <div class="item-fav display-flex justify-content-end">
    <div class="item-fav-inner" data-id="${props.postid}" @click=${updateFav}>
      <i class="fas fa-heart"></i>
      <span class="link-item item-fav-inner-num">${favnum.value}</span>
    </div>
  </div>
  `;
}

export default (props, { $f7, $, $update, $onMounted ,$on }) => {
  var post = {!! json_encode( $post,true ) !!}
  let snsdata = {
          'title' : '{{$post->title}}',
          'image' : '{{ \URL::to( str_replace('/community/storage/','/storage/',$post->repImg) ) }}',
          'url' : '{{\URL::to( '/posts/'.$code.'/view/'.$post->id )}}',
          'description' : ``,
  }
  const snssahrefn = (e)=>{
    var target = $(e.target).closest('a').data('link')
    snsShare( target , snsdata)
  }
  $on('pageInit', () => {
    $("#post_body").html( post.body )
    axios.get('/community/posts/{{$code}}/comment/view/{{$post->id}}').then( (res)=>{
      $("#commnet_block").html(res.data)
    })
  });
  $on('pageBeforeRemove', () => {
    //photoview.destroy();
  });
  return $render;
}
</script>
