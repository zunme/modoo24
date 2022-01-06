<style>
:root {
  --calendar-cell-width : 50px;
  --calendar-cell-height : 50px;
}
#nface-step-movedate th, #nface-step-movedate td{
  width: var(--calendar-cell-width) !important;
  height: var(--calendar-cell-height) !important;
  min-width: var(--calendar-cell-width);
  min-height: var(--calendar-cell-height);
}
</style>

<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
    이사일 선택
  </div>
</div>
<div class="step-body-section">
  <div class="pop-content-wrap select-moveing-type">
     <div class="nface-step-movedate-wrap">

           <div id="nface-step-movedate"></div>
           <input type="hidden" name="mdate" id="nface-step-mdate-inp" value="">

     </div>
   </div>

   <div class="pop-page-step-footer">
     <span class="btn btn-secondary" onclick="gotoNextStep()">다음</span>
   </div>

</div>


<script type="text/javascript">
var nfacedatepicker
   $(function () {
     var startMovingDate = new Date();
      var endMovingDate = new Date();
      var numberOfDaysStart = 0;
      var numberOfDaysEnd = 60;
      startMovingDate.setDate(startMovingDate.getDate() + numberOfDaysStart);
      endMovingDate.setDate(startMovingDate.getDate() + numberOfDaysEnd);

       $('#nface-step-movedate').datepicker({
          inline: true,
          sideBySide: false,
          format: "yyyy-mm-dd",
          language: "ko",
          startDate: startMovingDate,
          endDate:endMovingDate,
          todayHighlight: true,
          container: '#nface-step-movedate-container',
          orientation: "auto top",

          beforeShowDay: function(date){
            let son =  solarToLunar( date.getFullYear() ,date.getMonth()+1, date.getDate(), true);
              //console.log ( date.getFullYear() +"-"+date.getMonth()+"-"+ date.getDate()+" : " + solarToLunar( date.getFullYear() ,date.getMonth(), date.getDate() ) )
            if( son ) {
              return {
                    tooltip: '손'+ date.getFullYear() +"-"+(date.getMonth()+1) +"-"+ date.getDate(),
                    classes: 'son-active'
              }
            }
          },
       }).on('changeDate', function(e) {
          $("#nface-step-mdate-inp").val( moment(e.date).format('YYYY-MM-DD'))
      });
       $('#nface-step-modedate').on('dp.change', function(event) { alert(event.date); });
   });
</script>
