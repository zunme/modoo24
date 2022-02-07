<style>
#popnmodalAi{
  --navbar-stepper-height: 0px;
  --input-line-color: #a1a1a1;
  --inout-bg-color: #f5f5f5;
  --input-bg-color: rgb(255 255 255 / 40%);
  --input-font-size: 16px;
  --input-title-color: #4e4e4e;
  --page-step-header-height: 36px;
  --page-step-header-realheight: 40px;
  --f7-grid-gap: 0px;
  --f7-grid-row-gap: 0px;
  --f7-popup-border-radius: 0px;
  --f7-popup-tablet-border-radius: 10px;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;

  background-color: transparent;
  border: 2px solid #161616 !important;
}
#popnmodalAi .pop-page-step ,
#popnmodalAi .pop-page-step-body{
    background-color: #1C7293;
}
#popnmodalAi .pop-page-step-body {
    height: calc( 100% - 44px );
    overflow-y: auto;
    overflow-x: hidden;
}
.select-pyeong-inner{
  display: flex;
  flex-wrap: wrap;
}
.select-pyeong-item .step-radio-label-step{
  min-width: 118px;
}
.select-pyeong-item .step-radio-label-check{
  margin-left: 10px;
}
</style>

  <div class="popup modal-in modal-out" id="popnmodalAi">
    <div class="page">
      <div class="pop-navbar elevation-1">
        <div class="pop-navbar-bg"></div>

        <div class="pop-navbar-inner">
          <div class="pop-left">
            <span class="link pop-back" onClick="closepopnbtnai()"><i class="fas fa-chevron-left"></i></span>
          </div>
          <div class="pop-title">AI 견적신청</div>
          <div class="pop-right">
            <span class="link pop-close" onClick="closepopnbtnai()">
              <i class="fas fa-times"></i>
            </span>
          </div>
        </div>
      </div>



      <div class="pop-page-content overflowhidden">
        <form id="pop-page-form-Ai">
          <input class="input jspersist" type="checkbox" checked style="display:none">

          <div class="pop-page-step">
            <div class="pop-page-step-body">
              @include('Front.Poporder.Inc.ai')
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>


<script>
$("document").ready( function() {
  if( $("#aipoploader").length < 1){
    var loaderwrap = $('<div>', {
          id: 'aipoploader',
        }).prependTo( "#popnmodalAi" );
    $(loaderwrap).html("<div class='nfacepoploader-wrapper'><div class='nfacepoploader-loader'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>")
  }

  var movingAIimage = new mfPreviewImg('imagepreview_selectmoveing_ai', {
            maxFileCount: 30,
            maxSize: 800,
            maxFileperOnce: 6
        })
})
function openpopAi() {
  $("body").addClass("overflowhidden")
  $("#popnbackdrop").removeClass('backdrop-out').addClass('backdrop-in');
  $("#popnmodalAi").removeClass('modal-out');
}
function closepopnbtnai() {
  $("#popnmodalAi").addClass('modal-out');
  $("#popnbackdrop").addClass('backdrop-out').removeClass('backdrop-in');
  $("body").removeClass("overflowhidden")
}
function ai_pyeong_view(){
  var mtype = $("input[name='movingtype_ai']:checked").val()
  var data = {pyeongs:[]}
  data.pyeongs = pop_ai_info.pyeong[mtype];
  let ptemplate = Handlebars.compile( pyeong_item );
  $("#select-pyeong-inner").html(ptemplate(data))
  //select-pyeong-inner
}
function getAi() {
  $("#aipoploader").addClass('loading');
  setTimeout(inAIPopLoaderClose, 5000);
}
function inAIPopLoaderClose() {
  $("#aipoploader").removeClass('loading');
}
var pop_ai_info = {
  'pyeong': {
    'small' : [
      {'key':'under_10', 'val':'10평미만'},
      {'key':'about_10', 'val':'10평형'},
      {'key':'about_20', 'val':'20평형'},
    ],
    'home' : [
      {'key':'about_10', 'val':'10평형'},
      {'key':'about_20', 'val':'20평형'},
      {'key':'about_30', 'val':'30평형'},
      {'key':'about_40', 'val':'40평형'},
      {'key':'about_50', 'val':'50평형'},
      {'key':'over_60', 'val':'60평이상'},
    ],
    'office' : [
      {'key':'about_10', 'val':'10평형'},
      {'key':'about_20', 'val':'20평형'},
      {'key':'about_30', 'val':'30평형'},
      {'key':'about_40', 'val':'40평형'},
      {'key':'about_50', 'val':'50평형'},
      {'key':'over_60', 'val':'60평이상'},
    ]
  }
}
let pyeong_item =`
@{{#each pyeongs}}
<div class="select-pyeong-item">
    <label class="step-radio-labelclass">
        <input type="radio" class="step-radio select-pyeong-radio" name="pyeong_ai" value="@{{key}}">
        <div class="step-radio-label-step">
            <div class="step-radio-label-text">
                <div class="step-radio-label-text-item">@{{val}}</div>
            </div>
            <span class="step-radio-label-check"><i class="fas fa-check"></i></span>
        </div>
    </label>
</div>
@{{/each}}
`
</script>



<!--
<script type="module">
			import devtools from 'https://unpkg.com/devtools-detect';
      console.log ( devtools.isOpen ? 'yes' : 'no' )
      console.log (devtools.orientation ? devtools.orientation : '' )

	window.addEventListener('devtoolschange', event => {
    console.log ( event.detail.isOpen ? 'yes' : 'no' )
    console.log (event.detail.orientation ? event.detail.orientation : '' )
	});
</script>
-->
