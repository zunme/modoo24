var isMobileDevice = false;
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
 isMobileDevice = true;
}
function ShareKakaostory( data ){
	if( isMobileDevice ){
	  Kakao.Story.open({
	    url: data['url'],
	    text: data['title']
	  });
	 }
	 else{
		 Kakao.Story.share({
	    url: data['url'],
	    text: data['title']
	  });
	 }
}
function kakaolink(data){

  Kakao.Link.sendDefault({
    objectType: 'feed',
    content: {
      title: data['title'] ,
      description: data['description'],
      imageUrl: data['_image'],
      link: {
        mobileWebUrl:  data['url'],
        webUrl:  data['url'],
      },
    },
    /*
    social: {
      likeCount: 286,
      commentCount: 45,
      sharedCount: 845,
    },
    */
    buttons: [
      {
        title: data['button_title'],
        link: {
          mobileWebUrl: data['url'],
          webUrl: data['url'],
        },
      },
    ],
  })
}
function snsShare(sns, data )
{
    var senddata = {}
    var image, url;
    if( typeof data.image =='undefined') senddata['image'] = snsDefaultImage ;
    else senddata['_image'] = data.image;
    senddata['url'] =  ( ( typeof data.url =='undefined' ) ? '' : data.url );
    senddata['title'] = (typeof data.title != 'undefined') ? data.title : '모두이사',
    senddata['description'] = (typeof data.description != 'undefined') ? data.description : '모두이사 커뮤니티',

    senddata['_url']   = encodeURIComponent(senddata['url']);
    senddata['_title']   = encodeURIComponent(senddata['title']);
    senddata['_br']    = encodeURIComponent('\r\n');
    senddata['button_title']    ='자세히보기';

    var o;

    switch(sns)
    {
        case 'facebook':
            o = {
                method:'popup',
                height:600,
                width:800,
                url:'http://www.facebook.com/sharer/sharer.php?u=' + senddata['_url']
            };
            break;
        case 'twitter':
            o = {
                method:'popup',
                height:750,
                width:500,
                url:'http://twitter.com/intent/tweet?text=' + senddata['_title'] + '&url=' + senddata['_url']
            };
            break;
        case 'naverband':
						if( isMobileDevice ){
							o = {
								method:'web2app',
								param:'create/post?text=' + senddata['_title'] + senddata['_br'] + senddata['_url'],
								a_store:'itms-apps://itunes.apple.com/app/id542613198?mt=8',
								g_store:'market://details?id=com.nhn.android.band',
								a_proto:'bandapp://',
								g_proto:'scheme=bandapp;package=com.nhn.android.band'
							};
						}
						else{
							o = {
								method:'popup',
								height:700,
								width:750,
								url:'http://band.us/plugin/share?body=' + senddata['_title'] + senddata['_br'] + senddata['_url'] + '&route=' + senddata['_url']
							};
						}
            break;

        case 'naverblog':
        		o = {
                method:'popup',
                height:600,
                width:750,
                url:'https://share.naver.com/web/shareView.nhn?url=' + senddata['_url'] + '&title=' + senddata['_title']
            };
            break;

 				case 'telegram':
        		o = {
                method:'popup',
                height:600,
                width:750,
                url:'https://telegram.me/share/url?url=' + senddata['_url'] + '&text=' + senddata['_title']
            };
            break;
        case 'kakao' :
          kakaolink(senddata);
          return;
          break;
        case 'kakaostory' :
          ShareKakaostory(senddata);
          return;
          break;
        default:
            return false;
    }

    switch(o.method)
    {
	    case 'popup':
	    	if( o.height > 0 && o.width > 0 ){
		    	window.open(o.url,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height='+o.height+',width='+o.width);
	    	}
	    	else{
		    	 window.open(o.url);
	    	}

	      break;

	    case 'web2app':
	      if(navigator.userAgent.match(/android/i)){
	          setTimeout(function(){ location.href = 'intent://' + o.param + '#Intent;' + o.g_proto + ';end'}, 100);
	      }
	      else if(navigator.userAgent.match(/(iphone)|(ipod)|(ipad)/i)){
	          setTimeout(function(){ location.href = o.a_store; }, 200);
	          setTimeout(function(){ location.href = o.a_proto + o.param }, 100);
	      }
	      else{
	          alert('Only Mobile');
	      }
	      break;
    }
}
