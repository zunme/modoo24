<style>
    /*.step-radio-labelclass input[type="radio"]:checked+.step-radio-label {
        background-color: #00beff !important;
    }*/

</style>


<div class="pop-page-step-header">
    <div class="pop-page-step-header-inner">
        이사종류
    </div>
</div>
<div class="pop-page-step-body">
    <div class="step-body-section">

        <div class="pop-content-wrap select-moveing-type">
            <div class="select-moveing-type-wrap">
                <div class="select-moveing-type-head">
                    <span>이사종류</span>
                </div>


                <div class="select-moveing-type-body">
                    <div class="select-moveing-type-body-inner flex-row flex-direction-column">

                        <div class="flex-row w-100 select-moveing-type-items select-moving-type-first">
                            <div class=" flex-col select-moveing-type-item">

                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="small" onchange="nfacestep3showing()">
                                    <div class="step-radio-label">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">소형이사</div>
                                            <div class="step-radio-label-text-item label-text-item-detail">(예 : 원룸 )</div>
                                        </div>

                                        <span class="step-radio-label-check"><i class="fas fa-house-user"></i></span>
                                    </div>
                                </label>

                            </div>
                            <div class=" flex-col select-moveing-type-item">
<!--
                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="home" onChange="nfacestep3showing()">
                                    <div class="step-radio-label">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">가정이사</div>
                                            <div class="step-radio-label-text-item label-text-item-detail">(예 : 아파트 )</div>
                                        </div>


                                        <span class="step-radio-label-check"><i class="fas fa-home"></i></span>
                                    </div>
                                </label>
-->
                            </div>
                            <div class=" flex-col select-moveing-type-item">
<!--
                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingtype" value="office" onChange="nfacestep3showing()">
                                    <div class="step-radio-label">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">사무실이사</div>
                                            <div class="step-radio-label-text-item label-text-item-detail">(예 : 오피스텔,공장 )</div>
                                        </div>


                                        <span class="step-radio-label-check"><i class="fas fa-building"></i></span>
                                    </div>
                                </label>
-->
                            </div>
                        </div>

                        <div class="flex-row w-100 select-moveing-type-items select-moving-type-second">
                            <div class="flex-col select-moveing-type-item">

                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingmethod" value="packaging">
                                    <div class="step-radio-label-step">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">포장이사</div>
                                        </div>
                                        <span class="step-radio-label-check"><i class="fas fa-check"></i></span>
                                    </div>
                                </label>
                            </div>
                            <div class="flex-col select-moveing-type-item">
                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingmethod" value="half-packaging">
                                    <div class="step-radio-label-step">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">반포장이사</div>
                                        </div>
                                        <span class="step-radio-label-check"><i class="fas fa-check"></i></span>
                                    </div>
                                </label>
                            </div>
                            <div class="flex-col select-moveing-type-item">
                                <label class="step-radio-labelclass">
                                    <input type="radio" class="step-radio select-moveing-radio" name="movingmethod" value="carrying">
                                    <div class="step-radio-label-step">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">일반이사</div>
                                            <div class="step-radio-label-text-item label-text-item-detail">(운반만)</div>
                                        </div>
                                        <span class="step-radio-label-check"><i class="fas fa-check"></i></span>
                                    </div>
                                </label>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="select-moveing-type-body-sub">

                    <div class="step-onoff-wrap">
                        <div class="input-toggle-wrap">
                            <div class="input-toggle-line">무거운 짐(가전,가구 등)을 함께 옮겨 주실수 있나요?</div>
                            <div class="togglebutton texttoggle">
                                <label>
                                    <input type="checkbox" name="s_help_no" checked="" data-to="s_help_no">
                                    <span class="toggle">
                                        <span class="toggle-avail-label" data-off="NO" data-on="YES"></span>
                                    </span>
                                </label>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- / 이사종류 -->

    <div class="step-body-section">
        <div class="pop-content-wrap select-moveing-type">
            <div class="select-moveing-type-wrap">
                <div class="select-moveing-type-head">
                    <span>이삿짐 확인</span>
                </div>
                <div class="select-moveing-type-body">

                    <div class="select-moveing-type-body-inner flex-row justify-content-center">

                        <div class="col-50 select-moveing-type-items select-moving-goods select-moving-goods-first">
                            <div class="select-moveing-type-item">
                                <label class="step-radio-labelclass">
                                    <!-- 짐량확인은 picture or list -->
                                    <input type="radio" class="step-radio select-moveing-radio" name="moving-goods-method" value="list" onChange="changeNfaceGoodsMethod()">
                                    <div class="step-radio-label-step">
                                        <div class="step-radio-label-text">
                                            <div class="step-radio-label-text-item">리스트로</div>
                                            <div class="step-radio-label-text-item">짐량확인</div>
                                        </div>
                                        <span class="step-radio-label-check"><i class="fas fa-check"></i></span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="col-50 select-moveing-type-items select-moving-goods select-moving-goods-second">
                            <div class="select-moveing-type-item">
                                <label class="step-radio-labelclass">
                                    <!-- 짐량확인은 picture or list -->
                                    <input type="radio" class="step-radio select-moveing-radio" name="moving-goods-method" value="picture" onChange="changeNfaceGoodsMethod()">
                                   <div class="step-radio-label-step">
                                    <div class="step-radio-label-text">
                                        <div class="step-radio-label-text-item">사진으로</div>
                                        <div class="step-radio-label-text-item">짐량확인</div>
                                    </div>

                                    <span class="step-radio-label-check"><i class="fas fa-check"></i></span>
                                    </div>
                                    <!--<span class="circle">
                                        <span class="check"></span>
                                    </span>-->
                                </label>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="pop-page-step-footer">
        <span class="btn btn-secondary" onclick="gotoNextStep()">다음</span>
    </div>

</div>
<script>
    /*
  changeNfaceGoodsMethod : stpep4에 있음
*/
    function nfacestep3showing() {
        var movingtype = $("input[name=movingtype]:checked").val()
        if (movingtype == 'small') {
            $(".select-moveing-type-body-sub").show();
            $(".select-moving-goods").show();
        } else if (movingtype == 'office') {
            $(".select-moveing-type-body-sub").hide();
            $(".select-moving-goods").show();
        } else if (movingtype == 'home') {
            $(".select-moveing-type-body-sub").hide();
            $(".select-moving-goods-first").hide();
            $(".select-moving-goods-second").show();
            if ($("input:radio[name ='moving-goods-method']:checked").val() != 'picture') {
                $("input:radio[name ='moving-goods-method']:input[value='picture']").prop("checked", true);
                changeNfaceGoodsMethod()
            }
        }
    }

    $("document").ready(function() {
        $("body").on("stepPopOpended", function() {
            nfacestep3showing();
            changeNfaceGoodsMethod();
        })
    })

</script>
