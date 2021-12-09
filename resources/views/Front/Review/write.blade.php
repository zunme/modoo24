@extends('layouts.modoo')

@section('css')
<!-- top -->
<style>
    .nav-tabs, .nav-pills {
        padding: 20px 0;}

    .nav .nav-item {
        background: #eee;
        padding: 10px;
        height: 50px;
        line-height: 30px;
    }
    .content-body{padding-top: 20px; overflow: hidden}
    .content-body .afwt_title{font-size: 1.3em;font-weight: bold;}
    .content-body .afwt_txt{padding-top: 10px; color: #666}
    .content-body .afwt_txt > .point{color: #003399}
    .item-wrap{ border-bottom: 1px solid #d8d8d8; padding: 20px 0;}
    .txtar_note{padding: 20px;border-radius: 10px;border: 1px solid #ddd;}
    .btn-success{background: #ddd}
    .btn-warning{background: #b6b6b6}
    .btn.btn-success {
    color: #fff;background-color: #1e9af9;border-color: #1e9af9;}
    .btn.btn-success:hover {color: #fff;background-color: #1e9af9;border-color: #1e9af9}
    .afwt_wrap{border-top: 1px solid #7f7f7f!important;margin-top:30px}
    .af_image_txt{font-size: .85em; color: #999;margin-top: 10px;clear: both}
    .afw_end_box{margin: 20px 0; text-align: center}
    .afw_end_box .pt_og{color: #ff6600}
    .btn_set{margin-bottom: 50px; clear: both}

    .item-input-wrap .read-only{color: #7f7f7f}
    .pn_agree li{width: auto;margin-right: 30px;}

    .btn_view {padding: 3px 7px}
    .checkmark {
    position: absolute;
    top: -3px;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #eee;
}

    .remodoo{margin-left: -40px;padding-right: 20px;}

/* Customize the label (the container) */
.containermk { margin-top:10px;position: relative;padding-left: 35px;margin-bottom: 12px;cursor: pointer;font-size: 12px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}

/* Hide the browser's default checkbox */
.containermk input {position: absolute;opacity: 0;cursor: pointer;height: 0;width: 0;}

/* Create a custom checkbox */
.checkmark1 {position: absolute;top: -3px;left: 0;height: 20px;width: 20px;background-color: #eee;}

/* On mouse-over, add a grey background color */
.containermk:hover input ~ .checkmark1 {background-color: #d6d6d6;}

/* When the checkbox is checked, add a blue background */
.containermk input:checked ~ .checkmark1 {background-color: #189bde;}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark1:after {content: "";position: absolute;display: none;}

/* Show the checkmark when checked */
.containermk input:checked ~ .checkmark1:after {display: block;}

/* Style the checkmark/indicator */
.containermk .checkmark1:after {left: 6px;top: 2px;width: 5px;height: 10px;border: solid white;border-width: 0 3px 3px 0;-webkit-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);}



    @media only screen and (max-width: 630px) {
        .st-sub-menu {
            padding-right: 10px;
        }

        .st-sub-menu>.st-sub-menu-item:last-child {
            margin-right: 0;
        }
    }

    @media only screen and (max-width: 959px) {

         .item-wrap,
        .item-inner {
        display: block!important;font-size: .9em; }
        .item-inner {
        display: flex!important;
    }
        .item-wrap {border-bottom: 0;padding: 0}
        .item-inner{padding: 10px 0; border-bottom: 1px solid #d8d8d8;}
        .remodoo {margin-left: 0;}
        .content-body .afwt_txt {font-size: .9em}

        .visual3 h1 {
            padding-top: 30px;
        }

        .st-sub-menu-wrap {
            padding: 3px 0;
            width: 100%;
        }

        .st-sub-menu-inner {
            width: 100%;
        }

        .st-sub-menu {
            margin-left: 0;
            width: 100%;
            justify-content: flex-end;
        }

        .st-sub-menu-item {
            font-size: 13px;
        }

        .st-sub-menu-item>a.active {
            background-color: rgb(255 255 255);
            padding: 7px 8px;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            color: #666 !important;
        }
    }

</style>
<!-- / top -->

<style>
    .form-check {
        display: inline-block;
    }

    input:read-only,
    input:-moz-read-only {
        border: none !important;
    }

    input.read-only {
        border: none !important; color: #666
    }

</style>

<!-- 별점 박스 -->
<style>
    .rating-box {
        display: flex;
    }

    .ratingrow {
        display: flex;
        flex-wrap: wrap;
        max-width: 940px;
    }

    .item-wrap,
    .item-inner {
        display: flex;
    }

    .item-title {
        width: 100px;
        display: flex;
        align-items: center;
    }

    .item-inner,
    .item-input-wrap {
        flex-grow: 1
    }

    .ratingrow-item {
        display: flex;
    }

    .ratingrow-item {
        padding: 0 40px 0 0;
    }

    .rating-item-title {
        width: 66px;
        display: flex;
        align-self: center;
    }

</style>

<!-- 별점 -->
<style>
    .rating-half {
        border: none;
        float: left;
    }

    .rating-half>input {
        display: none;
    }

    .rating-half>label:before {
        margin: 3px;
        font-size: 25px;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
        cursor: pointer
    }

    .rating-half>.half-star:before {
        content: "\f089";
        position: absolute;
    }

    .rating-half>label {
        color: #E1E6F6;
        float: right;
    }

   /* .rating-half>label.full-star {
        text-shadow: 3px 4px 5px rgb(0 0 0 / 30%);
    }*/

    .rating-half>input:checked~label,
    .rating-half:not(:checked)>label:hover,
    .rating-half:not(:checked)>label:hover~label {
        color: #1e9af9;
    }

    .rating-half>input:checked+label:hover,
    .rating-half>input:checked~label:hover,
    .rating-half>label:hover~input:checked~label,
    .rating-half>input:checked~label:hover~label {
        color: #1e9af9;
    }

</style>

<!-- 파일첨부 -->
<style>
    .custom-file-container {
        box-sizing: border-box;
        position: relative;
        display: block
    }

    .custom-file-container__custom-file {
        box-sizing: border-box;
        position: relative;
        display: inline-block;
        width: 84px;
        height: calc(2.25rem + 2px);
        margin-bottom: 0;
        margin-top: 5px
    }

    .custom-file-container__custom-file:hover {
        cursor: pointer
    }

    .custom-file-container__custom-file__custom-file-input {
        box-sizing: border-box;
        min-width: 80px;
        width: 80px;
        max-width: 100%;
        height: calc(2.25rem + 2px);
        margin: 0;
        opacity: 0
    }

    .custom-file-container__custom-file__custom-file-input:focus~span {
        outline: 1px dotted #212121;
        outline: 5px auto -webkit-focus-ring-color
    }

    .custom-file-container__custom-file__custom-file-control {
        box-sizing: border-box;
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        z-index: 5;
        height: calc(2.25rem + 2px);
        padding: .5rem .75rem;
        overflow: hidden;
        line-height: 1.5;
        color: #333;
        user-select: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #00bcd4;
        border-radius: .25rem
    }

    .custom-file-container__custom-file__custom-file-control__button {
        box-sizing: border-box;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 6;
        display: block;
        height: calc(2.25rem + 2px);
        padding: .5rem .75rem;
        line-height: 1.25;
        color: #00bcd4;
    background: #fff;
    border-color: #00bcd4;
        border-left: 1px solid #00bcd4;
        box-sizing: border-box
    }

    .custom-file-container__image-multi-preview {
        position: relative;
        box-sizing: border-box;
        transition: all 0.2s ease;
        border-radius: 6px;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        float: left;
        margin: 20px;
        width: 130px;
        height: 90px;
        box-shadow: 0 4px 10px 0 rgb(51 51 51 / 25%);
    }

    .custom-file-container__image-multi-preview__single-image-clear {
        right: -6px;
        background: #EDEDE8;
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        text-align: center;
        margin-top: -6px;
        box-shadow: 0 4px 10px 0 rgba(51, 51, 51, 0.25);
    }

    .custom-file-container__image-multi-preview__single-image-clear__icon {
        color: #6a6a53;
        display: block;
        margin-top: -2px;
    }
    
    .essent{color:#ec3320;}

</style>
@endsection


@section('content')
<div class="visual4">
    <h1>후기&amp;평가</h1>
</div>




<div class="content-wrap contents_wrap">
    <div class="sub_menu_N">
        <ul class="center">
            <li class="h_icon" onclick="window.open('/v2/')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19z" fill="rgba(255,255,255,1)" />
                </svg>
            </li>
            <li onclick="location.href='/v2/review' ">이사후기</li>
            <li class="on">이사업체 평가하기</li>
        </ul>
    </div>
    <div class="content-inner center">
        <nav class="nav nav-pills nav-fill">
            <a class="nav-item nav-link active" href="/v2/review/my">이사업체 평가하기</a>
            <a class="nav-item nav-link"  href="/v2/review/my/list">이사업체 평가 내역</a>
        </nav>

        <form id="reviewform">
            <input type="hidden" name="b_worker_idx" value="{{$staff->s_uid}}">
            <input type="hidden" name="type" value="{{$type}}">
            <input type="hidden" name="uid" value="{{$uid}}">

            <input type="hidden" name="b_star_pro" value="0">
            <input type="hidden" name="b_star_kind" value="0">
            <input type="hidden" name="b_star_price" value="0">
            <input type="hidden" name="b_star_finish" value="0">
            <input type="hidden" name="b_star_expost" value="0">
            <input type="hidden" name="b_star_pave" value="0">

            <input type="hidden" name="review_type" id="review_type" value="">

            <div class="content-body">
                <h2 class="afwt_title">이사업체 평가</h2>
                <div class="afwt_txt">
                    칭찬과 격려의 말씀 감사합니다.<br/>
                    작성해주신 평가 내역은 해당 업체에게 전달됩니다.<br/>
                    견적 신청 시 작성해주신 고객님의 정보와 일치하지 않을 경우, 업체 평가가 어렵습니다.<br/>
                    <span class="point">불편 신고의 진위 확인 처리 시간은 영업일 기준 3-4일이 소요됩니다. </span>
                    <p class="essent">● 필수 입력 사항 입니다.</p>
                </div>
                <div class="afwt_wrap">
                    <div class="item-wrap">
                        <div class="item-inner">
                            <div class="item-title item-floating-label">고객명</div>
                            <div class="item-input-wrap">
                                <input type="text" name="b_name" value="{{$row->name}}" class="read-only" readonly>
                            </div>
                        </div>

                        <div class="item-inner">
                            <div class="item-title item-floating-label">이사일</div>
                            <div class="item-input-wrap">
                                <input type="text" name="b_mdate" value="{{$row->mdate}}" class="read-only" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="item-wrap">
                        <div class="item-inner">
                            <div class="item-title item-floating-label">연락처</div>
                            <div class="item-input-wrap">
                                <input type="text" name="b_hp" value="{{$userdata['phone']}}" class="read-only" readonly>
                            </div>
                        </div>

                        <div class="item-inner">
                            <div class="item-title item-floating-label">이사업체명</div>
                            <div class="item-input-wrap">
                                <input type="text" value="{{$row->s_company1}}" class="read-only" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="item-wrap">
                        <div class="item-inner">
                            <div class="item-title item-floating-label">서비스종류{{$row->type}}</div>
                            <div class="item-input-wrap">
                                <input type="text" value="{{ ( $type=="order" ? "방문 견적 이사" : "비대면 견적 이사" ) }}" class="read-only wd50" readonly>
                            </div>
                        </div>



                        <div class="item-inner">
                            <div class="item-title item-floating-label remodoo" style="width:auto"><span class="red_cic"></span>모두이사 재이용 의사</div>
                            <div class="item-input-wrap">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="b_re_use" id="b_re_use1" value="Y" checked="">
                                        예
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="b_re_use" id="b_re_use2" value="N">
                                        아니요
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="item-wrap">
                        <div class="item-inner">
                            <div class="item-title item-floating-label"><span class="red_cic"></span>별점</div>
                            <div class="rating-box">
                                <div class="ratingrow">

                                    <div class="ratingrow-item">
                                        <div class="rating-item-title">전문성</div>
                                        @include('Front.Review.ratinghalf',['ratingType'=>'pro'])
                                    </div>

                                    <div class="ratingrow-item">
                                        <div class="rating-item-title">가격도</div>
                                        @include('Front.Review.ratinghalf',['ratingType'=>'price'])
                                    </div>

                                    <div class="ratingrow-item">
                                        <div class="rating-item-title">사후관리</div>
                                        @include('Front.Review.ratinghalf',['ratingType'=>'expost'])
                                    </div>

                                    <div class="ratingrow-item">
                                        <div class="rating-item-title">친절성</div>
                                        @include('Front.Review.ratinghalf',['ratingType'=>'kind'])
                                    </div>

                                    <div class="ratingrow-item">
                                        <div class="rating-item-title">마무리</div>
                                        @include('Front.Review.ratinghalf',['ratingType'=>'finish'])
                                    </div>

                                    <div class="ratingrow-item">
                                        <div class="rating-item-title">포장도</div>
                                        @include('Front.Review.ratinghalf',['ratingType'=>'pave'])
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-inner">
                            <div class="item-title item-floating-label">내용</div>
                            <div class="item-input-wrap">
                                <textarea name="b_note" class="form-control txtar_note" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-inner">
                            <div class="item-title item-floating-label">파일첨부</div>
                            <div class="item-input-wrap">

                                <div class="custom-file-container" data-upload-id="myUniqueUploadId">
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" class="custom-file-container__custom-file__custom-file-input" name="upload[]"
                                          accept="jpg,png" multiple aria-label="Choose File" maxlength="4" />
                                        <input type="hidden" name="MAX_FILE_SIZE" value="12582912" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <label>
                                        <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">전체삭제</a>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                    <p class="af_image_txt">- 파일 첨부는 필수가 아닙니다.<br/>

                                    - JPG, PNG 형식의 파일을 첨부할 수 있습니다.<br/>

                                    ※ 이미지 사이즈는 3MB 이하 / 4개 까지 업로드 가능</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="afw_end_box">
                        <p class="pt_og">※ 고객님의 업체 평가 내용, 이미지 등은 모두이사 홍보자료로 활용될 수 있습니다</p>
                        <p class="pt_og">※ 불편 신고의 진위 확인 처리 시간은 영업일 기준 3-4일이 소요되며, 해당 업체에게만 노출됩니다.</p>

                        <div class="textct mgt_30">
                            <ul class="pn_agree">
                                <li>
                                    <label class="containermk" style="font-size: 15px">
                                        <input name="agree1" type="checkbox" value="Y">
                                        <span class="checkmark1"></span>
                                       <a class="modalpop_link" link="/new_common/popup/accessterms.html">이용약관</a>
                                    </label>
                                    
                                </li>
                                <li>
                                    <label class="containermk" style="font-size: 15px">
                                        <input name="agree1" type="checkbox" value="Y">
                                        <span class="checkmark1"></span>
                                       <a class="modalpop_link" link="/new_common/popup/personal_data.html">개인정보처리방침</a>
                                    </label>
                                    
                                </li>
                                <li>
                                    <label class="containermk" style="font-size: 15px">
                                        <input name="agree2" type="checkbox" value="Y">
                                        <span class="checkmark1"></span>
                                        <a class="modalpop_link" link="/new_common/popup/personal_3.html">제3자 제공동의 /</a>
                                        <a class="modalpop_link" link="/new_common/popup/mkt_ok.html"> 마케팅 동의</a>
                                        
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </form>


        <div class="btn_set">
            <div style="text-align: center;">
                <span class="btn btn-cancle" onClick="review_prc('inconvenience')">불편신고 등록</span>
                <span class="btn btn-success" onClick="review_prc('compliment')">칭찬후기 등록</span>
            </div>
        </div>

    </div>
</div>


@endsection

@section('script')
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>

<script>
    var upload;
    $("document").ready(function() {
        $("input.rating-radio-half").on("click", function(e) {
            let val = $(e.target).val();
            let rtype = $(e.target).closest(".rating-half").data("ratingtype");
            $("input[name=" + rtype + "]").val(val)
        })

        upload = new FileUploadWithPreview("myUniqueUploadId", {
            options: {
                maxFileCount: 4,
            }
        });
        upload.options.maxFileCount = 4;
        upload.options.text.selectedCount = "개 선택"
    })

    function review_prc(type) {
        $("#review_type").val(type);

        let title = `후기 등록 완료`
        let msg = `후기가 등록되었습니다.`

        if (type = "inconvenience") {
            title = `후기 등록 완료`
            msg = `불편 신고의 진위 확인 처리 시간은 영업일 기준 3-4일이 소요됩니다`
        }

        const dt = new DataTransfer()
        let files = upload.cachedFileArray
          for (let file of files){
           dt.items.add(file)
          }
        $("input[type='file']").get(0).files = dt.files

        $.ajax({
            url: '/community/refresh',
            method: "get",
            dataType: 'JSON',
            success: function(result) {
                $('meta[name="csrf-token"]').attr('content', result.token);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': result.token
                    }
                });
                $.ajax({
                    url: "/v2/review/write/" + type,
                    method: "POST",
                    data: new FormData(document.getElementById('reviewform')),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(res) {
                        swal.fire({
                            title: title,
                            text: msg,
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "확인",
                            cancelButtonText: "아니오",
                        }).then((result) => {
                            location.replace('/v2/review/my')
                        });
                    },
                    error: function(err) {
                        ajaxErrorST(err)
                    }
                });
            }
        });
    }

</script>
@endsection
