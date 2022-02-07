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
                <div class="item-title">메뉴 1</div>
              </div>
            </a>
            <div class="accordion-item-content">
              <div class="list links-list">
                <ul>
                  <li>
                    <a href="/accordion/" class="panel-close">메뉴1-1</a>
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

  <script src="/v2/assets/framek/node_modules/framework7/framework7-bundle.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>

  <script src="/v2/pages/routes.js?ver=20220127013000"></script>
  <script src="/v2/pages/store.js"></script>
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
