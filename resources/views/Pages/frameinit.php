<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, viewport-fit=cover">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="theme-color" content="#fff">
  <meta http-equiv="Content-Security-Policy" content="default-src * 'self' 'unsafe-inline' 'unsafe-eval' data: gap:">
  <title>모두이사</title>
  <!--     Fonts and icons     -->

<link
  rel="stylesheet"
  type="text/css"
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
/>
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
  integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
<link
  href="//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css"
  rel="stylesheet"
  type="text/css"
/>
  <link rel="stylesheet" href="/v2/assets/framek/node_modules/framework7/framework7-bundle.min.css">
  <link rel="stylesheet" href="/v2/pages/my-app.css?ver=20220127013000">
  <link rel="apple-touch-icon" href="/modoo24.ico">
  <link rel="shortcut icon" href="/modoo24.ico">

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />
  <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css" />
  <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet" />
  <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet" />

  <style>
  .page-content.darkmode1 .vit-cp-list-visual-wrap{
    background-color: #2e2e2e;
    padding-bottom: 2px;
  }
  .default-full-content-wrap{
    min-height: calc( 100% - 2px);
  }
  /* 지식인 보기 - 이미지 라인 */
  .inline-thumb-list ul{
    justify-content: flex-end;
  }
  .inline-thumb-list ul li > a{
    display:inline-block;
    width: 90px;
    height: 90px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    margin: 5px 10px 0 0;
    border-radius: 5px;
    border:1px solid #eee;
  }
  /*board 지식인*/
  .mt-10{
    margin-top: 10px !important;
  }
  .mt-20{
    margin-top: 20px !important;
  }
  .custom-search-list ul{
    display:flex;
  }
  .custom-search-list .custom-search-list-textbox{
    flex-grow: 1;
    padding-left: 0;
  }
  .custom-search-list .custom-search-list-textbox .item-input-wrap{
    overflow:hidden;
  }
  .custom-search-list .custom-search-list-textbox input{
    padding-right: 64px !important;
  }
  .custom-search-list .custom-search-list-textbox .input-clear-button{
    right: 50px !important;
  }
  .in-input-btn{
    display: inline-flex;
    position: absolute;
    top: -1px;
    right: 0px;
    height: var(--f7-input-height);
    background-color: #33b0dc;
    border: none;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: var(--f7-input-outline-border-radius);
    border-bottom-right-radius: var(--f7-input-outline-border-radius);
    box-sizing: border-box;
    color: white;
  }

  .jisik-list-btn-done{
    padding: 2px 4px;
    border: 1px solid var(--f7-theme-color);
    border-radius: 3px;
    color: var(--f7-theme-color);
  }
  .jisik-list-btn-ready{
    padding: 2px 4px;
    border: 1px solid var(--f7-list-item-after-text-color);
    border-radius: 3px;
  }
  .item-jisik-sub-title{
    font-size: 14px;
    font-weight: 500;
    color: var(--f7-list-item-text-text-color);
    display: flex;

    padding-left:10px;
    padding-right: calc(var(--f7-list-chevron-icon-area));
    margin: 6px 0;
    justify-content: flex-end;
    color: #7e7e7e;
  }
  .pagination > ul {
    display:flex;
    justify-content:center;
    margin-left: 0;
    padding-left: 0;
    margin-right: 0;
    padding-right: 0;
  }
  .pagination > ul >li{
  }
  .pagination > ul >li > a, .pagination > ul >li > span{
    color: black;
    border: 0;
    border-radius: 30px !important;
    transition: all .3s;
    padding: 0px 11px;
    margin: 0 3px;
    min-width: 30px;
    height: 30px;
    line-height: 30px;
    color: #999999;
    font-weight: 400;
    font-size: 12px;
    text-transform: uppercase;
    background: transparent;
    text-align: center;

    padding: 0 8px;
    min-width: 20px;
  }
  .pagination > ul >li > a.currnet-page{
    padding: 0px 11px !important;
    min-width: 30px  !important;
    background-color: #00beff;
    border-color: #00beff;
    color: #ffffff;
    box-shadow: 0 4px 5px 0 rgb(156 39 176 / 14%), 0 1px 10px 0 rgb(156 39 176 / 12%), 0 2px 4px -1px rgb(156 39 176 / 20%);
    font-size:16px;
  }
  .pagination > ul >li.page-link-dot > span{
    padding: 0;
    min-width: 10px;
  }


  /*지식인 view */
  .item-media-default-img{
    width: 70px;
    height: 70px;
    background: url(/v1/image/sub/know_logo.png) center no-repeat #fff;
    text-indent: 0px;
    font-size: 0;
    line-height: 0;
    background-size: cover;
    border: 1px solid #aaa;
    border-radius: 10px;
    box-sizing: border-box;
  }
  .post-jisik-wrap li {
      padding-right: calc(var(--f7-list-item-padding-horizontal) + var(--f7-safe-area-left) - var(--menu-list-offset));
  }
  .item-title-multiline{
    font-size: 16px;
    font-weight: 500;
    color: black;
    margin-bottom: 10px;
    line-height: var(--f7-list-item-text-line-height);
    position: relative;
    white-space: normal;
    word-break: break-all;
  }
  .item-text-multiline {
    font-size: var(--f7-list-item-text-font-size);
    font-weight: var(--f7-list-item-text-font-weight);
    color: black;
    line-height: var(--f7-list-item-text-line-height);
    position: relative;
    white-space: normal;
    word-break: break-all;
    margin-top:10px;
  }
  .post-jisik-body{
    font-weight: 400 !important;
    margin-top: 30px;
    margin-bottom: 30px;
    padding: 15px;
  }
  .comment-list ul .item-inner:after{
    display:none !important;
  }
  .comment-list ul li:after {
      content: '';
      position: absolute;
      background-color: var(--f7-list-item-border-color);
      display: block;
      z-index: 15;
      top: auto;
      right: auto;
      bottom: 0;
      left: 0;
      height: 1px;
      width: 100%;
      transform-origin: 50% 100%;
      transform: scaleY(calc(1 / var(--f7-device-pixel-ratio)));
  }
  .comment-list ul li:nth-child(even){
    background-color:#c9ebf3;
  }
  .comment-list ul li:nth-child(odd){
    background-color:#addde9;
  }
  .item-fav-inner{
    padding: 3px 8px;
  /* width: 30px; */
  border: 1px solid orangered;
  color: orangered;
  display: inline-flex;
  /* min-width: 34px; */
  justify-content: space-between;
  align-content: center;
  align-self: center;
  align-items: center;
  border-radius: 5px;
  background-color: white;
  margin-top: 5px;
  cursor: pointer;
  }
  .item-fav-inner > i {margin-right:10px;}
  .item-media-center{
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    align-self: center  !important;
  }
  .item-media-image {
    width: 70px;
    height: 70px;
    background: url(/v1/image/sub/know_logo.png) center no-repeat #fff;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }
  </style>
</head>

<body>
  <div id="app">

    <div class="panel panel-left panel-cover panel-resizable panel-init">
      <div class="page">
        <div class="page-content">
          <div class="right-top">
            <a href="#" class="panel-close">close</a>
          </div>
          <div class="block-title">모두이사</div>
          <!-- menu -->
          <div class="list accordion-list left-menu-list">
        <ul>
          <li class="accordion-item"><a class="item-content item-link" href="#">
              <div class="item-inner">
                <div class="item-title">MY</div>
              </div>
            </a>
            <div class="accordion-item-content">
              <div class="list links-list">
                <ul>
                  <li>
                    <a href="/v2/mob/myrequest" class="panel-close">신청내역</a>
                  </li>
                  <li>
                    <a href="/action-sheet/" class="panel-close">메뉴1-2</a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li class="accordion-item">
            <div class="item-content item-link" href="#">
              <div class="item-inner">
                <div class="item-title">메뉴 2</div>
              </div>
            </div>
            <div class="accordion-item-content">
              <div class="list links-list">
                <ul>
                  <li>
                    <a href="/accordion/" class="panel-close">메뉴2-1</a>
                  </li>
                  <li>
                    <a href="/action-sheet/" class="panel-close">메뉴2-2</a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li class="">
            <a class="item-link" href="#">
              <div class="item-content item-link item-inner">
                <div class="item-title">메뉴 3</div>
              </div>
            </a>
          </li>

        </ul>
      </div>
        <!-- / menu -->
        </div>
        <div class="toolbar toolbar-bottom">
          <div class="toolbar-inner">
            <!-- Toolbar links -->
            <a href="#" class="link panel-close"><i class="fas fa-phone-alt"></i>청소</a>
            <a href="#" class="link panel-close" onClick="openson()"><i class="far fa-calendar-alt"></i>손없는날</a>
            <a href="#" data-panel="right" class="link panel-open"><i class="fas fa-user"></i>MY</a>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-right panel-reveal panel-resizable panel-init">
      <div class="view view-init view-right" data-name="right" data-url="/panel-right-2/" data-pushState='false'  data-push-state='false' data-browser-history='false'>
        <div class="page">
          <div class="navbar">
            <div class="navbar-bg"></div>
            <div class="navbar-inner sliding">
              <div class="title">오른쪽 판넬</div>
            </div>
          </div>
          <div class="page-content">
            <div class="block">
              <p>판넬닫기 <a href="#"
                  class="panel-close">CLOSE</a>
              </p>
            </div>
            <div class="block-title">Panel Navigation</div>
            <div class="list links-list">
              <ul>
                <li><a href="/panel-right-1/">Right panel page 1</a></li>
                <li><a href="/panel-right-2/">Right panel page 2</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="view view-main view-init safe-areas" data-master-detail-breakpoint="768" data-url="/v2/mob" data-push-state='true' data-browser-history='true' data-browser-history-separator=''></div>
    <div class="popup" id="globalPopup">
      <div class="block">
        <p>son</p>
        <p><a href="#" class="link popup-close">Close me</a></p>
        <div id="calendarson-inline-container"></div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
  <script src="/community/assets/stisla/node_modules/moment/moment.js"></script>
  <script src="/community/assets/stisla/node_modules/moment/locale/ko.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <script src="/v2/assets/framek/node_modules/framework7/framework7-bundle.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>

  <script src="/v2/pages/routes.js?ver=20220127013000"></script>
  <script src="/v2/pages/store.js"></script>

  <script src="/community/assets/js/kakao.min.js"></script>
  <script src="/community/assets/js/sns.js"></script>
</body>

<script>
Handlebars.registerHelper("star", function(value, options) {
  let ret = `${value}`
  let star = parseFloat( value);
  for( let i =0; i < 5 ;i ++ ){
    let val = star - i;
    if( val - 1 >= 0) ret += '<i class="fas fa-star"></i>'
    else if ( val - 0.5 >= 0) ret += '<i class="fas fa-star-half-alt"></i>'
    else ret += '<i class="far fa-star"></i>'
  }
  return ret
})

axios.interceptors.request.use((config) => {
  app.preloader.show();
  return config;
}, (error) => {
  app.preloader.hide();
  return Promise.reject(error);
});
axios.interceptors.response.use(
  response => {
    app.preloader.hide();
    return response
  },
  error => {
    app.preloader.hide();
  	console.log( error.response )
  	const err = error.response
  	var text='';
  	if ( err.status == 422) {
      if(  err.data.message ){
        text = err.data.message
      }else{
        for(key in err.data) {
          console.log ( key )
          text = err.data[key]
          break;
        }
      }
    }
  	else text="잠시후에 사용해주세요"

  	app.toast.create({
      text: text,
      position: 'center',
      closeTimeout: 2000,
    }).open();

  	Promise.reject(error.response)
  }
);

var colorscale = [
  ['#1D3461', '#1F487E', '#376996', '#6290C8', '#829CBC',],
  ['#E63946','#F1FAEE','#A8DADC','#457B9D','#1D3557',],
  ['#21295C','#1B3B6F','#065A82','#1C7293','#9EB3C2',],
  ['#7BDFF2','#B2F7EF','#EFF7F6','#F7D6E0','#F2B5D4',],
  ['#1D3F6E','#4E9B47','#333333','#CF202A','#54A4B5 '],
  ['#FFD700','#FFF7A7','#FF9900','#F9E6E6','#CC0000'],
  ['#7AC5CD','#60BBD0','#8FD0CA','#0F4C81','#6F295B'],
]
let colorlinePick = colorscale[Math.floor(Math.random() * colorscale.length)];
let colorPick = colorlinePick[Math.floor(Math.random() * colorscale.length)];
var rootQeury = document.querySelector(':root');
rootQeury.style.setProperty('--f7-theme-background-color', colorPick);

function nl2br(str) {
    var breakTag = '<br />';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

// Dom7
var $$ = Dom7;

// Theme
var theme = 'md';
if (document.location.search.indexOf('theme=') >= 0) {
  theme = document.location.search.split('theme=')[1].split('&')[0];
}

// Init App
var app = new Framework7({
  id: 'io.framework7.testapp',
  el: '#app',
  theme: theme,
  pushState: true,
	uniqueHistory: true,
  view: {
    iosDynamicNavbar: false,
    xhrCache: false,
    cache: false,
    componentCache:false,
    uniqueHistory: true,
    stackPages: true,
/*
    stackPages: false,
    pushState: true,
    pushStateSeparator: '',
    uniqueHistory: true,
    history: true,
    browserHistory : true,
    browserHistorySeparator: '',
    */
  },
  cache: false,
  // store.js,
  store: store,
  // routes.js,
  routes: routes,
  popup: {
    closeOnEscape: true,
  },
  sheet: {
    closeOnEscape: true,
  },
  popover: {
    closeOnEscape: true,
  },
  actions: {
    closeOnEscape: true,
  },
  vi: {
    placementId: 'pltd4o7ibb9rc653x14',
  },
});

const inlinePhotoViewComponent = (props, {$, $f7, $ref, $h }) => {
  let addClass = ( typeof props.class == 'string') ? props.class : ''
  const photoview = (e) =>{
    var index = parseInt($(e.target).data("index"))
    $f7.photoBrowser.create({
      photos: props.photos,
      type: 'page',
      backLinkText: 'Back',
      theme: 'dark',
      on : {
        closed : function (browser){
          browser.destroy()
        }
      }
    }).open(index);
  }
  return () => $h`
  <div class="inline-thumb-list ${addClass}">
    <ul class="display-flex">
      ${props.photos.map( (item,index)=>$h`
      <li>
        <a href="#" class="link" data-index="${index}" @click=${photoview} style="background-image:url(${item.url});"></a>
      </li>
      `)}

    </ul>
  </div>
  `
}



var now = new Date();
var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
var beforeday = new Date().setDate(today.getDate() -1);
var lastday = new Date().setDate(today.getDate() + 120);

var sopnpop = app.popup.create({
  el: '#globalPopup',
  swipeToClose: true,
});
var soncal = app.calendar.create({
    //inputEl: '#searchtext3',
containerEl: '#calendarson-inline-container',
    locale : 'ko-KR',
    rangePickerMinDays : 1,
    rangePickerMaxDays : 3,
    minDate : beforeday,
    maxDate : lastday,

    rangesClasses: [
      //Add "day-october' class for all october dates
      {
          // string CSS class name for this range in "cssClass" property
          cssClass: 'day-son', //string CSS class
          // Date Range in "range" property
          range: function (date) {
              return date.getMonth() === 1
          }
      },
    ],
    openIn: 'customModal',
    header: true,
    footer: false,
})

var backGroundColorPicker = app.colorPicker.create({
	inputEl: '#demo-color-picker-palette',
	targetEl: '#demo-color-picker-palette-value',
	targetElSetBackgroundColor: true,
	modules: ['palette'],
	openIn: 'auto',
	openInPhone: 'sheet',
	palette: colorscale,
	value: {
	  hex: '#FFEBEE',
	},
	formatValue: function (value) {
	  return value.hex;
	},
	on: {
	    change: function (obj) {
	      var r = document.querySelector(':root');
	      r.style.setProperty('--f7-theme-background-color', obj.value.hex);
	    }
	  }
});
function changeBackgroundColor(){
  backGroundColorPicker.open()
}

function openson(){
  sopnpop.open()
}
function reloadpage(){
   app.views.main.router.navigate( app.views.main.router.currentRoute.url ,{reloadCurrent :true})
}

function loadsheet(url,title,txt){
  if(typeof url =='undefined') url = '/new_common/popup/accessterms.html'
  if(typeof txt != 'boolean') txt = false;
  if(typeof title != 'string') title = '';
  app.request({
    url: url,
    statusCode: {
      404: function (xhr) {
        alert('page not found');
      }
    }
  }).then( (res)=>{
    var data = res.data
    if( txt ){
      data = nl2br(res.data)
    }
    var dynamicSheet = app.sheet.create({
        content: `
          <div class="sheet-modal dynamic-sheet">
            <div class="toolbar">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="title">${title}</div>
                <div class="right">
                  <a class="link sheet-close">Done</a>
                </div>
              </div>
            </div>
            <div class="sheet-modal-inner">
              <div class="page-content" style="padding-bottom: 30px;padding-left: 20px;padding-right: 20px;">
              ${data}
              </div>
            </div>
          </div>
        `,
        // Events
        on: {
          open: function (sheet) {
            console.log('Sheet open');
          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
        	closed : function(sheet){
        		sheet.destroy()
        	},
        }
    });
    dynamicSheet.open();
  })
}
Kakao.init('139b5101d3bf7ebdf5daa822e2b298fc');
Kakao.isInitialized();
</script>
<style>
/* review */
.inline-panel-mdate-date{
  margin-right: 20px;
  margin-left: 10px;
}
.inline-panel-rating-point-label{
  margin-left: 20px;
  margin-right: 20px;
}
.ml-2-depth {
    margin-left: 46px;
}

.inline-panel-rating {
    flex-wrap: wrap;
    max-width: 610px;
    margin-left: 24px;
}
.inline-panel-rating-wrap {
    margin-right: 24px;
}
.inline-panel-rating-title{
  width: 70px;
}
.inline-panel-rating-inner > i.fas {
    color: #00beff;
}
.inline-panel-review{
  margin: 20px;
  padding: 20px 20px;
  border: 1px solid #eee;
}

.thumbnail-box-80-wrap{
  padding:20px;
}
.thumbnail-box-80-wrap > li > a {
  width: 80px;
  /* background: url(../image/main_N/no_image_w.png) #ddd center; */
  background-size: cover;
  height: 80px;
  border-radius: 10px;
  border: 1px solid #dedede;
  display: inline-block;
  margin-right: 10px;
}
/* end review */

</style>
</html>
