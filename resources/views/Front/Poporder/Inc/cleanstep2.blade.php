<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
    청소날짜
  </div>
  <a class="pop-header-right" href="tel:16007728">
    <i class="fas fa-solid fa-phone-alt"></i> 1600-7728
  </a>
</div>
<div class="pop-page-step-body clean_body02">
  <div class="step-body-section">


    <div id="clean-step-movedate"></div>
    <input type="hidden" name="mdate" id="clean-step-mdate-inp" value="">


    <div class="form-check">
      <label class="form-check-label">
          <input class="form-check-input" name="negotiable" value='Y' type="checkbox">
          청소 날짜 협의 가능
          <span class="form-check-sign">
              <span class="check"></span>
          </span>
      </label>
    </div>
  </div>
  <div class="contact_nextBtn clean_nextBtn">
    <span class="btn btn-secondary" onclick="gotoCleanNextStep(this)">다음</span>
  </div>
</div>
<script>
$(function () {
  var startCleanMovingDate = new Date();
   var endCleanMovingDate = new Date();
   var numberOfDaysCleanStart = 1; //내일부터
   var numberOfDaysCleanEnd = 200; //200일 비대면일경우 , 대면은 90일
   startCleanMovingDate.setDate(startCleanMovingDate.getDate() + numberOfDaysCleanStart);
   endCleanMovingDate.setDate(endCleanMovingDate.getDate() + numberOfDaysCleanEnd);

    $('#clean-step-movedate').datepicker({
       inline: true,
       sideBySide: false,
       format: "yyyy-mm-dd",
       language: "ko",
       startDate: startCleanMovingDate,
       endDate:endCleanMovingDate,
       todayHighlight: true,
       container: '#clean-step-movedate-container',
       orientation: "auto top",
    }).on('changeDate', function(e) {
      var seldate = moment(e.date).format('YYYY-MM-DD');
      console.log (seldate)
      console.log ( "**"+$("#clean-step-mdate-inp").val() )
       if( seldate == $("#clean-step-mdate-inp").val() ) {
         $("#clean-step-mdate-inp").val( '' )
         $("#clean-step-movedate td.active").removeClass('active')
       }
       else {
         $("#clean-step-mdate-inp").val( seldate )
       }
         $("#clean-step-mdate-inp").trigger("change")
   });
    $('#clean-step-modedate').on('dp.change', function(event) { console.log(event.date); });
});
</script>
