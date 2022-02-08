<div class="pop-page-step-header">
    <div class="pop-page-step-header-inner">
        짐량확인
    </div>
</div>
<div class="pop-page-step-body">
    <div class="step-body-section">
        <div class="pop-content-wrap nfaceOrderGoods-wrap">
            <!-- 사진 확인 페이지 -->
            <div class="nfaceOrderGoodsMethodClass" id="nfaceOrderGoodsMethod-picture" style="display:none">
                사진업로드
                <div class="pop-content-wrap select-moveing-picture">
                    <div class="pop-content-image-uploader-wrap">
                        <div class="mf-file-container pop-content-image-uploader" data-upload-id="imagepreview_selectmoveing">
                            <div class="select-moveing-picture-item upload-image-item-btn">

                                <label class="upload-text-wrap">
                                    <div class="upload-text-txt"><b>사진 첨부</b>를 누르셔서 <b>여러장의 사진</b>을 첨부 해보세요 </div>
                                    <input type="file" id="imagepreview_selectmoveing" accept=".jpg,.jpeg,.png,.gif" multiple="multiple">

                                    <div class="upload-icon-wrap">
                                        <span class="upload-icon-pic"><img src="../v1/image/main_N/camera-plus.svg"></span> <span class="upload-icon-txt">사진 첨부 하기</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="upload-warning-wrap">
                            <div class="upload-warning-title-wrap">
                                <span class="upload-warning-title-icon"><i class="fas fa-exclamation-triangle"></i></span> <span class="upload-warning-title-txt">주의사항</span>
                                <div class="upload-warning-title-txt-content">
                                    <div class="upload-all-title"><b>전체적인 공간</b>의 사진을 찍어주세요 </div>
                                    <ul class="upload-all-tip">
                                        <li>1. 각 구역별로 모든 짐들이 한눈에 보일 수 있게</li>
                                        <li>2. 순서대로 찍어주세요 (빠진 구역이 있을 경우 추후에 추가 요금이 산정될 수 있습니다.)</li>
                                    </ul>

                                </div>
                            </div>
                            <div class="form-check mt20">
                                <label class="form-check-label">
                                    <input class="form-check-input mfstorageignore" name="agree_ai" type="checkbox" value="Y">
                                    업로드 된 사진은 AI 딥 러닝 및 빅데이터 구축에 활용됨을 동의합니다.
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="upload-showing-info">
                            <div class="upload-warning-title-txt">상세 이용 방법(사진 업로드)</div>
                            <div class="upload-all-title">구역별 이삿짐을 사진 촬영 &amp; 닫힌곳은 열어서 한 장에 최대한 담을 수 있게 촬영</div>
                            <ul class="upload-showing-image">
                                <li><img src="/v1/image/sub/untactN_img02_01.jpg" alt="비대면견적이미지02_01"></li>
                                <li><img src="/v1/image/sub/untactN_img02_02.jpg" alt="비대면견적이미지02_01"></li>
                                <li><img src="/v1/image/sub/untactN_img02_03.jpg" alt="비대면견적이미지02_01"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / 사진 확인 페이지 -->

            <!-- 리스트 확인 페이지 -->
            <div class="nfaceOrderGoodsMethodClass" id="nfaceOrderGoodsMethod-list" style="display:none">
                @include('Front.Poporder.Inc.nfacestep4list',['ordergoods'=>$ordergoods])
            </div>
            <!-- / 리스트 확인 페이지 -->
            <div class="pop-content-memo-wrap">
                <label class="title">메모</label>
                <textarea name="memo"></textarea>
            </div>
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

    function changeNfaceGoodsMethod(data) {
        console.log("짐확인 변경")
        $(".nfaceOrderGoods-wrap > div.nfaceOrderGoodsMethodClass").hide();
        var chk = $("input[name=moving-goods-method]:checked").val();
        $("#nfaceOrderGoodsMethod-" + chk).show();
    }

    var cachedFileArray_selectmoveing = []
    var maxFileCount_selectmoveing = 5;
    var imagepreview_target = "imagepreview_selectmoveing"

    function orderPopUploaderChange(input) {
        var files = input.files;
        if (files.length === 0) {
            return
        }

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
                var prev = selectmoveingpreviewTemplate({
                    src: event.target.result,
                    token: file.token
                })
                $(input).closest('.upload-image-item-btn').after(prev)
            }
        }
    }

    function gotoNextStepWithImg() {
        var containerType = $("input[name=moving-goods-method]:checked").val();
        if (containerType == 'list') {
            gotoNextStep()
        } else if ((containerType == 'picture' && movingimage.getCount() > 1)) {
            nextlevel({})
        } else toast('최소 2장( 방, 거실, 주방, 화장실 등)이상의 사진을 올려주세요', 'topCenter')
    }
    $(document).ready(function() {
        selectmoveingpreviewTemplate = Handlebars.compile($("#select-moveing-picture-item-template").html())
        movingimage = new mfPreviewImg('imagepreview_selectmoveing', {
            maxFileCount: 30,
            maxSize: 800,
            maxFileperOnce: 6
        })
    })

</script>
