<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
    업체선택
  </div>
</div>
<div class="pop-page-step-body">
  <div class="step-body-section">

    <label>
			<input type="radio" class="step-radio mfstorageignore" name="contact_list_recommend" value="recommend"  onChange="contact_companylist(event)" />
			이사업체 추천받기
		</label>
    <label>
      <input type="radio" class="step-radio mfstorageignore " name="contact_list_recommend" value="selection" onChange="contact_companylist(event)" />
      이사업체 직접선택
    </label>

    <div class="contact_companylist" id="contact_companylist">
      업체추천리스트 나올곳 지우지마세요
    </div>

  </div>

</div>


<script>
function contact_companylist(event){
  var val = $(event.target).val();
  if ( val == 'recommend'){
    contact_companylist_recommendprc();
  }else if ( val == 'selection'){
    console.log ("selection")
  }
}
function contact_companylist_recommendprc(){
  Swal.fire({
    title: '방문이사 견적을 신청하시겠습니까?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: '견적신청',
    cancelButtonText: `취소`,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire('고객님 감사합니다<br> 이사신청이 완료 되었습니다.', '', 'success')
    }
  })
}
</script>
