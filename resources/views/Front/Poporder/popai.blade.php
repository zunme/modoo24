<style>
.simplyregSuccessWrap, .loaderWrap{
    z-index: 999999999999;
}
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
/*
#popnmodalAi .pop-page-step-body{
  position: relative;
}
*/
#result_ai_section .step-body-section{
  background-color: transparent;
    box-shadow: none;
    border: none;
}
#result_ai_section{
  background-color: cadetblue;
}
.content-result-ai{
    margin-bottom: 20px;
}
.content-result-ai-wrap{
  position: relative;
      border: 1px solid #777;
      border-radius: 10px;
      padding: 30px 10px;
      margin-top: 20px;
      background-color: #ddd;
}
.content-result-ai-head{
  position: absolute;
      top: 0;
      left: 50%;
      background-color: #2196f3;
      padding: 7px 16px;
      color: white;
      border-radius: 5px;
      -webkit-transform: translate(-50%, 0);
      transform: translate(-50%, -50%);
}
.result-ai-wrap{
  display: flex;
    justify-content: center;
}
.result-ai-table{
  width: 100%;
max-width: 270px;
border: 1px solid darkgrey;
    margin-top: 10px;
}

.result-ai-table tr{
  background-color: #efefef;
}
.result-ai-table tr:nth-of-type(odd) {
   background-color: rgba(0, 0, 0, 0.02);
}
.result-ai-table td:last-child{
  text-align: right;
}
.result-ai-table th{
    padding: 10px 15px;
    text-align: center;
}
.result-ai-table td {
    padding: 10px 15px;
    border-top: 1px solid #dee2e6;
}

#result_ai_section, #simple_reg_ai_section{
  position: absolute;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  background: #b9b9b9;
  z-index: 1;
  overflow-y: auto;
  display: none;
}
#simple_reg_ai_section{
  z-index: 2;
}
.ai_simple_reg_wrap{
  display: flex;
  flex-direction: column;
  margin: 20px 10px;
  background-color: #eee;
  padding: 10px 10px 20px;
  border-radius: 10px;
}
.ai_simple_reg_wrap ul{
  display: inline-flex;
  flex-wrap: wrap;
  margin: 20px auto;
  padding: 10px;
  max-width: 603px;
  justify-content: space-around;
}
.ai_simple_reg_wrap ul li{
  display:flex;
  padding-left:10px;
  margin-bottom:10px;
  min-width: 49.9%;
}
.ai_simple_reg_wrap ul li span{
  display: flex;
  align-self: center;
  width:70px;
}
.ai_simple_reg_wrap ul li .move_Box{
  min-width: 150px;
}
.ai_simple_reg_wrap ul.box03{
  max-width:420px;
}
.ai_simple_reg_wrap ul.box03 li{
  min-width: 199px;
}
.ai-warning-box{
  border: 1px solid #f96332;
  border-radius: 5px;
  margin: 10px;
  padding: 10px;
  width: 600px;
  margin: 26px auto 10px;
  max-width: 90%;
}
.ai-warning-box > p{
  margin-top:8px;
  margin-bottom: 8px;
  word-break: break-all;
}
.upload-warning-title-wrap-mf{
  margin-bottom:20px;
}
.upload-warning-title-wrap-mf .upload-warning-title-icon i.fas{
  color: #ff3636;
}
.upload-warning-title-wrap-mf .upload-warning-title-txt-content{
  padding-left: 16px;
}
.upload-warning-title-wrap-mf li{
  font-size: 14px;
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




      <div class="pop-page-content overflowhidden" id="popnmodalAiContent">
        <form id="pop-page-form-Ai">
          <input class="input jspersist" type="checkbox" checked style="display:none" />

          <div class="pop-page-step">
            <div class="pop-page-step-body">
              @include('Front.Poporder.Inc.ai')
            </div>
          </div>
          <div id="ai-image-uploader-area" style="display:none"></div>
        </form>

      </div>
    </div>
  </div>


<script>
var movingAIimage;
$("document").ready( function() {
  if( $("#aipoploader").length < 1){
    var loaderwrap = $('<div>', {
          id: 'aipoploader',
        }).prependTo( "#popnmodalAi" );
    $(loaderwrap).html("<div class='nfacepoploader-wrapper'><div class='nfacepoploader-loader'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>")
  }

  movingAIimage = new mfPreviewImg('imagepreview_selectmoveing_ai', {
      maxFileCount: 30,
      maxSize: 800,
      maxFileperOnce: 6
  })

})
let airesultTemplate = `
<div class="step-body-section">
  <div class="pop-content-wrap content-result-ai">

    <div class="content-result-ai-wrap elevation-2">
        <div class="content-result-ai-head elevation-1">
            <span>표준 이사 비용</span>
        </div>
        <div class="result-ai-wrap">

          <table class="result-ai-table elevation-1">
            <tr class="thead">
              <th>거리</th>
              <th>예상금액</th>
            </tr>
            @{{#each data}}
            <tr class="tbody">
              <td>@{{this.title}}</td>
              <td>@{{this.val}}원</td>
            </tr>
            @{{/each}}
          </table>
        </div>

        <div class="ai-warning-box">
          <p>AI 이사 견적 시스템은 이사 요금을 결정짓는 모든 요소가 아닌 대략적인 사항을 기준하여 산출되는 비용입니다.</p>

          <p>정확한 견적 산출을 원하시는 경우 아래 버튼을 눌러주세요.</p>

        </div>
    </div>

    <div class="pop-page-step-footer">
            <span class="btn btn-secondary" onclick="aiNextStep('@{{buttontype}}')">실제견적보기</span>
    </div>

  </div>
</div>
`
function openpopAi() {
  $("body").addClass("overflowhidden")
  $("#popnbackdrop").removeClass('backdrop-out').addClass('backdrop-in');
  $("#popnmodalAi").removeClass('modal-out');
}
function closepopnbtnai() {
  $("#popnmodalAi").addClass('modal-out');
  $("#popnbackdrop").addClass('backdrop-out').removeClass('backdrop-in');
  $("body").removeClass("overflowhidden")
  $("#result_ai_section").hide();
  $("#simple_reg_ai_section").hide();

  $("#popnmodalAi input[type=radio]:checked").prop('checked', false)
  $("#popnmodalAi input[type=checkbox]:checked").prop('checked', false)
  $("#popnmodalAi select option:eq(0)").prop('selected', true)
  $("#popnmodalAi input[type=text]").val('')
  $("#popnmodalAi input[type=number]").val('')

  $("#ai-image-uploader-area").empty()
  /*

  var imgdels = document.querySelectorAll('.mf-file-container[data-upload-id="imagepreview_selectmoveing_ai"]  .mf-file-container__image-clear');
  $(imgdels).each( function (i,v) {
   movingAIimage.clearfile(v)
  })
*/
  movingAIimage.clearAll()
}
function aiNextStep( btn ){
  if( btn =='small'){
    closepopnbtnai();
    setTimeout( openpopn, 200)
  }else {
    //closepopnbtnai();
    $("#simple_reg_ai_section").show()
  }
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
  if ( movingAIimage.getCount()  > 1){
    getAiNext()
  }else {
    toast('최소 2장( 방, 거실, 주방, 화장실 등)이상의 사진을 올려주세요', 'topCenter')
    return;
  }
}
function getAiNext() {
  //$("#aipoploader").addClass('loading');
  loaderAttach("#popnmodalAiContent")
  $("#ai-image-uploader-area").empty()

  movingAIimage.setInputByResize({
      inputName: 'upload',
      target: '#ai-image-uploader-area'
  })
  $.ajax({
      url: '/v2/order/ai',
      method: "POST",
      data: new FormData(document.getElementById('pop-page-form-Ai')),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function(res) {
        var tempate = Handlebars.compile( airesultTemplate );
        res['buttontype'] = $("#pop-page-form-Ai input[name=movingtype_ai]:checked").val()
        $("#result_ai_section").html( tempate(res) )
        $("#result_ai_section").show();
        console.log (res)
      },
      error: function(res) {
          inAIPopLoaderClose()
          loaderAttach("#popnmodalAiContent",false)
          ajaxErrorST(res)
      },
      complete: function() {
          inAIPopLoaderClose()
          loaderAttach("#popnmodalAiContent",false)
      }
  });

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
      {'key':'over_50', 'val':'50평형이상'},

    ],
    'office' : [
      {'key':'about_10', 'val':'10평형'},
      {'key':'about_20', 'val':'20평형'},
      {'key':'about_30', 'val':'30평형'},
      {'key':'about_40', 'val':'40평형'},
      {'key':'over_50', 'val':'50평형이상'},
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
