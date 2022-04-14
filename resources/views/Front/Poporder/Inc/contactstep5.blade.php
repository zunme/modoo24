<div class="pop-page-step-header contact_header">
  <div class="pop-page-step-header-inner">
    업체선택
  </div>
  <a class="pop-header-right" href="tel:16007728">
    <i class="fas fa-solid fa-phone-alt"></i> 1600-7728
  </a>
</div>
<div class="pop-page-step-body">
  <div class="step-body-section contact_step05">

    <div class="contact_step05_recommend">
      <label onClick="contact_companylist('recommend')">
		  	<input type="radio" class="step-radio mfstorageignore" name="contact_list_recommend" value="recommend" />
		  	<div class="contact_auto_con">
          <ul class="contact_step05_bigData">
            <li><p>모두이사에서<br> 빅데이터로 추천</p></li>
		  	    <li><p><span>모두이사에서</span>이사업체<strong class="auto">추천받기</strong></p></li>
          </ul>
        </div>
		  </label>
      <label>
        <input type="radio" class="step-radio mfstorageignore " name="contact_list_recommend" value="selection" onChange="contact_companylist('selection')" />
        <div class="contact_select_con">
          <ul class="contact_step05_select">
            <li><p>내가 업체 평가 후기보고 <br> 이사업체를 선택</p></li>
		  	    <li><p><span>이사후기보고 </span>이사업체<strong class="my">직접선택</strong></p></li>
          </ul>
        </div>
      </label>
    </div>

    <div id="contact_companylist">
      <!-- <p>업체추천리스트 나올곳 지우지마세요, 아이디만 유지해주시면 됩니다.</p> -->


    </div>

    <!--   template -->
    @verbatim
    <div id="contactCompanylistTemplate" style="display:none">
      <div class="contact_companylist_wrap">

<!-- 업체리스트, 마감업체리스트 없을때 -->
{{#if ( checkempty data.avail ) }}

      <div class="contact_close_list contact_companylist_tit">
      현재 모든 업체의 일정이 마감되었습니다.<br>
      상담을 통해 이사업체를 추천해 드리겠습니다.
      </div>

{{/if}}
<!-- / 업체리스트, 마감업체리스트 없을때 -->


<!-- 업체리스트 있을때-->
        {{#if ( gt data.avail.length 0 ) }}
        <div class="contact_companylist_inner">

          <div class="contact_companylist_tit">
            <div><strong>최대 3개</strong>의 업체를 선택하세요</div>
            <div>업체 선택이 어려우신 경우, 상담을 통해 이사업체를 추천드립니다</div>
          </div>

          <div class="contact_companylist">
            <ul>
              {{#each data.avail}}
              <li>
                <div>
                  <div>
                    <div class="form-check">
                          <label class="form-check-label">
                              <input class="form-check-input mfstorageignore" name="company[]" value="{{s_uid}}" type="checkbox" tabindex="-1" onClick="contact_companySelectionCount(event)">
                              <span class="form-check-sign">
                                  <span class="check"></span>
                              </span>
                          </label>
                      </div>
                  </div>
                  <div class="contact_company_name" onClick="staffmodalpop('/v2//pop/company/{{ base64 s_uid}}')">{{s_company}}</div>
                  <div>{{{ starvstr star pointStr="hide" }}}</div>
                  <div class="contact_grade">{{gradeTitle}}</div>
                  <div class="contact_review">후기건수({{review_cnt}})</div>
                  <div class="contact_company_detail" onClick="staffmodalpop('/v2//pop/company/{{ base64 s_uid}}')">
                    업체상세
                  </div>
                </div>
              </li>
              {{else}}
              <!-- 선택가능한 업체가 없을때 -->

              <!-- / 선택가능한 업체가 없을때 -->
              {{/each}}
            </ul>
          </div>

        </div>

        {{/if}}
<!-- / 업체리스트 -->


<!-- 마감 업체리스트 있을때-->
        {{#if ( gt2 data.closed.length 0 ) }}

        <div class="contact_companylist_inner">
          <div class="contact_non_company">
            <div>익일 선택 가능한 일정 마감업체</div>

            <!-- 선택가능한 업체가 없을때 아래 내용 나옴 -->
            {{#if ( checkempty data.avail ) }}
            <div>업체 선택이 어려우신 경우, 상담을 통해 이사업체를 추천드립니다</div>
            {{/if}}
            <!-- / 선택가능한 업체가 없을때 아래 내용 나옴 -->

          </div>

          <div class="contact_companylist">
            <ul>
              {{#each data.closed}}
              <li>
                <div>
                  <div class="contact_company_name" onClick="staffmodalpop('/v2/pop/company/{{ base64 s_uid}}')">{{s_company}}</div>
                  <div>{{{ starvstr star pointStr="hide" }}}</div>
                  <div class="contact_grade">{{gradeTitle}}</div>
                  <div class="contact_review">후기건수({{review_cnt}})</div>
                  <div class="contact_company_detail" onClick="staffmodalpop('/v2/pop/company/{{ base64 s_uid}}')">
                    업체상세
                  </div>
                </div>
              </li>
              {{else}}
              <!-- 마감 업체가 없을때 -->

              <!-- / 마감 업체가 없을때 -->
              {{/each}}
            </ul>
          </div>

        </div>

        {{/if}}
<!-- / 마감 업체리스트 -->


      </div>


      {{#if ( checkempty data.avail ) }}
      <!-- 선택가능한 업체가 없을때 -->
      <div class="contact_company_select_btn">
        <span class="btn btn-secondary contact_nextBtn" onclick="closepopnbtnWithComplete()">확인</span>
      </div>
      {{else }}
      <!-- 선택가능한 업체가 있을때 -->
      <div class="contact_company_select_btn">
        <span class="btn btn-secondary" onclick="contactPopRegComplete(this)">선택한 업체 견적 신청하기</span>
      </div>
      {{/if}}

    </div>
    @endverbatim
    <!--   / -->

  </div>

</div>


<style>
input[name='contact_list_recommend']:checked+div.contact_select_con{
  background-color: #2d62bb !important;
  border: 3px solid #2d62bb !important;
}
input[name='contact_list_recommend']:checked+div.contact_select_con,
input[name='contact_list_recommend']:checked+div.contact_select_con li p,
input[name='contact_list_recommend']:checked+div.contact_select_con li p strong{color:#fff;}
.contact_step05_recommend label:last-of-type input[name='contact_list_recommend']:checked+div.contact_select_con{background-image: url('/image/main/step07_icon2_o.png');}
#staffmodal .modal-content{
  width: 560px;
  max-width: 90vw;
}
#staffmodal iframe{
  min-height: 60vh;
}
.completeContact-step-title{
  margin-left: 8px;
}

</style>
<script>
function staffmodalpop(url){
    $.get(url, function(data) {
      let org = data
      data = data.replace(/(<\/?)html( .+?)?>/gi,'$1NOTHTML$2>',data)
      data = data.replace(/(<\/?)body( .+?)?>/gi,'$1NOTBODY$2>',data)
      data = $(data).find('notbody').html()
      if( typeof data == 'undefined') data = org
      data = '<div class="modalpop_link_close_wrap"><button type="button" class="close abs-top" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button></div>'+data

      $("#staffmodal_body").html(data);
    })
}
function partnercompanypopload(){
  console.log ( "load....")
  let head = $("#staffmodal_body iframe").contents().find("head")
  let css ='<style>.vit-cp-list-top-left{display:none !important;} #vit-cp-list-wrap .vit-cp-list-top{justify-content: center;}</style>'
  $(head).append(css)
  $("#staffmodal").modal('show');
}
Handlebars.registerHelper("starvstr", function(value, options) {
  var dl = options.hash['pointStr'] || "true";
  let ret = ''
  if ( dl !='hide') ret = `${value}`

  let star = parseFloat( value);
  for( let i =0; i < 5 ;i ++ ){
    let val = star - i;
    if( val - 1 >= 0) ret += '<i class="fas fa-star"></i>'
    else if ( val - 0.5 >= 0) ret += '<i class="fas fa-star-half-alt"></i>'
    else ret += '<i class="far fa-star"></i>'
  }
  return ret
})
Handlebars.registerHelper("base64", function(value, options) {
 return btoa(value+"")
})

var contactCompanylistTemplate
var searchingTemplate

$("document").ready( function() {
  contactCompanylistTemplate = Handlebars.compile($("#contactCompanylistTemplate").html());
  searchingTemplate = $("#contact_companylist").html();
})
function orderContactCompanyListErr(res){
  $("input[name='contact_list_recommend']:checked").prop("checked",false);
  iziToast.show({
      theme: 'dark',
      message: '잠시후에 이용해주세요',
      position: 'center'
  });
}

function closeContact(){
  $("#popcontactmodal").addClass("contact-completed")
  $("#popcontactmodal .inpopup-inline-progressbar > span").css('transform', 'translate3d(0px, 0px, 0px)')

  $("#popcontactmodal .top-steps-wrap").html('<i class="fas fa-check"></i> <div class="completeContact-step-title">견적신청완료</div>');
}
function contactPopRegComplete(btn){
  if( $("#popcontactmodal input[name='company[]']:checked").length < 1){
    Swal.fire({
      title: '최소 한개 이상의 업체를 선택해주세요',
      showDenyButton: false,
      showCancelButton: false,
      confirmButtonText: '확인',
      cancelButtonText: `취소`,
      customClass: {
        container:'swal-contact-confirm'
      }
    })
    return;
  }
  if( $("#popcontactmodal input[name='company[]']:checked").length == 1){
    Swal.fire({
      title: '모두이사비교견적 서비스로 최소 2개업체 서비스와 이사견적을 비교를 추천드립니다. 1개 업체만 선택하시겠습니까?',
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: '확인',
      cancelButtonText: `취소`,
      customClass: {
        container:'swal-contact-confirm'
      }
    }).then((result) => {
      if (result.isConfirmed) {
        contact_companylist_recommendprc();
      }
    })
    return;
  }
  else contact_companylist_recommendprc();
}
function contact_companySelectionCount(e){
  if( $("#popcontactmodal input[name='company[]']:checked").length > 3){
    $(e.target).prop("checked",false)
    toast("업체 선택은 3개까지만 가능합니다.",'center')
  }
}
function viewCompanyDetailPop(s_uid){
  console.log("company popupload :" + s_uid)
}
function contact_companylist(val){
  if ( val == 'recommend'){
    contact_companylist_recommendprc();
  }else if ( val == 'selection'){
    contact_companylist_selectprc()
  }
}
function contact_companylist_selectprc(){
  $("#contact_companylist").html(searchingTemplate)
  inContactPopLoaderOpen()
  getpost('/v2/order/contact/step5/companylist', $("#popcontact-page-form").serialize(), viewContactCompanyList, inContactPopLoaderClose, orderContactCompanyListErr )
}
function viewContactCompanyList(res){
  console.log (res)
  $("#contact_companylist").html(contactCompanylistTemplate(res))
  scrollToCompanylist();
}
function contact_companylist_recommendprc(){
  Swal.fire({
    title: '견적을 신청하시겠습니까?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: '견적신청',
    cancelButtonText: `취소`,
    customClass: {
      container:'swal-contact-confirm'
    }
  }).then((result) => {
    if (result.isConfirmed) {

      contactprc()
    }
  })
}
function closepopnbtnWithComplete() {
  $("input[name='contact_list_recommend'][value='recommend']").prop('checked',true)
  getpost('/v2/order/contact/complete', $("#popcontact-page-form").serialize(), contactSelectionSuccess, inContactPopLoaderClose, orderContactFormCheckError )
}
</script>
