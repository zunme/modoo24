
<link rel="stylesheet" type="text/css" href="/community/assets/css/aipopup.css?ver=20220228151800" />

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
        <div class="content-result-ai-head">
            <span>표준 이사 비용</span>
        </div>
        <div class="result-ai-wrap">

          <table class="result-ai-table">
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
          <p>AI 이사 견적 시스템은 이사 요금을 결정짓는 모든 요소가 아닌 <br>대략적인 사항을 기준하여 산출되는 비용입니다.</p>

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
