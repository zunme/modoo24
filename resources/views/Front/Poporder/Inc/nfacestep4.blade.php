<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
      짐량확인
  </div>
</div>

<style>
:root {
  --pop-content-image-uploader-per-row : 3;
  --pop-content-image-uploader-space : 10px;
  --pop-content-image-uploader-space-bottom : 10px;
}

@media (min-width: 630px) and (min-height: 630px){
  :root {
    --pop-content-image-uploader-per-row : 4
  }
}
@media (min-width: 840px){
  :root {
    --pop-content-image-uploader-per-row : 6;
  }
}
.pop-content-image-uploader-wrap{
  display: flex;
    justify-content: center;
    flex-direction: column;
}


.pop-content-image-uploader-wrap .upload-text-wrap {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  margin-bottom: 0;
  height: 100px;
  border: 1px solid #03a9f4;
  border-radius: 5px;
}

.pop-content-image-uploader-wrap .upload-text-wrap i.fas {
  font-size: 24px;
  line-height: 24px;
}
.pop-content-image-uploader-wrap .upload-text-wrap .upload-text{
  font-size: 14px;
  line-height: 24px;
}
.upload-text-wrap input[type=file] {
    width: 0;
    height: 0;
    position: absolute;
    z-index: -1;
    opacity: 0;
}
.pop-content-image-uploader{
  position: relative;
  display: flex;
  flex-wrap: wrap;
  padding-left: var(--pop-content-image-uploader-space);
}
.select-moveing-picture-item{
  height: 100px;
  width: calc( ( 100% / var(--pop-content-image-uploader-per-row) ) - var(--pop-content-image-uploader-space) );
  margin-right: var(--pop-content-image-uploader-space);
  margin-bottom: var(--pop-content-image-uploader-space-bottom);
}
.select-moveing-picture-item.upload-image-item .select-moveing-preview{
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  border: 1px solid #999;
  border-radius: 3px;
}

.pop-content-image-uploader > .select-moveing-picture-item:only-child{
  width:100%;
}

.upload-image-item{
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}
.select-moveing-preview{
  width: 100%;
  height: 100%;
  position: relative;
}
.mf-file-container__image-clear{
  position: absolute;
  z-index: 1;
  color: white;
  content:'X';
  top: 2px;
  right: 2px;

}
</style>

<div class="pop-page-step-body">
  <div class="step-body-section">
    <div class="pop-content-wrap nfaceOrderGoods-wrap">
      <!-- 사진 확인 페이지 -->
      <div id="nfaceOrderGoodsMethod-picture" style="display:none">
        여기에 사진 올리는 내용이
        <div class="pop-content-wrap select-moveing-picture">

          <div class="pop-content-image-uploader-wrap">

            <div class="mf-file-container pop-content-image-uploader" data-upload-id="imagepreview_selectmoveing">

              <div class="select-moveing-picture-item upload-image-item-btn">
                <label class="upload-text-wrap">
                  <input type="file" id="imagepreview_selectmoveing" accept=".jpg,.jpeg,.png,.gif" multiple="multiple">
                  <i class="fas fa-cloud-upload-alt"></i>
                  <span class="upload-text">이미지추가</span>
                </label>
              </div>

            </div>
          </div>

        </div>
      </div>
      <!-- / 사진 확인 페이지 -->

      <!-- 리스트 확인 페이지 -->
      <div id="nfaceOrderGoodsMethod-list" style="display:none">
          @include('Front.Poporder.Inc.nfacestep4list',['ordergoods'=>$ordergoods])
      </div>
      <!-- / 리스트 확인 페이지 -->
    </div>

  </div>

  <div class="pop-page-step-footer">
    <span class="btn btn-secondary" onclick="gotoNextStepWithImg()">다음</span>
  </div>

</div>

@verbatim
<!-- 프리뷰 이미지 템플릿-->
<div id="select-moveing-picture-item-template" style="display:none;">
  <div class="select-moveing-picture-item upload-image-item" data-group="{{groupnum}}">
    <div class="select-moveing-preview" style="background-image:url({{src}})">
      <span class="mf-file-container__image-clear" data-token="{{token}}"><i class="fas fa-times"></i></span>
    </div>
  </div>
</div>
<!-- / 프리뷰 이미지 -->
@endverbatim

<script>
  var selectmoveingpreviewTemplate, movingimage;
  function changeNfaceGoodsMethod(data){
    console.log ("짐확인 변경")
    $(".nfaceOrderGoods-wrap > div").hide();
    var chk = $("input[name=moving-goods-method]:checked").val();
    $("#nfaceOrderGoodsMethod-" + chk).show();
  }

  var cachedFileArray_selectmoveing = []
  var maxFileCount_selectmoveing =5;
  var imagepreview_target ="imagepreview_selectmoveing"

  function orderPopUploaderChange(input){
    var files = input.files;
    if (files.length === 0) { return }

    let adjustedFilesLength = files.length
    if (maxFileCount_selectmoveing > 0) {
        if ((files.length + cachedFileArray_selectmoveing.length) > maxFileCount_selectmoveing) {
            adjustedFilesLength = maxFileCount_selectmoveing - cachedFileArray_selectmoveing.length
        }
    }

    for (let x = 0; x < adjustedFilesLength; x++) {
      const file = files[x]
      file.token = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15)
      cachedFileArray_selectmoveing.push(file)
      const reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onload = (event) => {
          var prev = selectmoveingpreviewTemplate( {src:event.target.result, token:file.token} )
          $(input).closest('.upload-image-item-btn').after(prev)
        }
    }
  }
  function gotoNextStepWithImg(){
    if( movingimage.getCount() > 3 ) {
      nextlevel({})
    }else toast('최소 2장( 방, 거실, 주방, 화장실 등)이상의 사진을 올려주세요', 'topCenter')
  }
  $(document).ready( function () {
    selectmoveingpreviewTemplate = Handlebars.compile( $("#select-moveing-picture-item-template" ).html() )
    movingimage = new mfPreviewImg( 'imagepreview_selectmoveing', {maxFileCount:30, maxSize:800, maxFileperOnce:6})
  })

</script>
