<style>
:root {
  --calendar-cell-width : 50px;
  --calendar-cell-height : 50px;
}

</style>

<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
    이사일 선택
  </div>
</div>
<div class="step-body-section pop-page-step-body">
  <div class="pop-content-wrap select-moveing-type">
     <div class="nface-step-movedate-wrap">

           <div id="nface-step-movedate"></div>
           <input type="hidden" name="mdate" id="nface-step-mdate-inp" value="">

     </div>
    <div class="movedate-txt-son-wrap">
        <div class="txt-son-info"><span></span>표시는 손없는 날입니다</div>    
        <div class="txt-expensive-move-day"><span class="pt_red">금요일, 월말, 손없는날</span>을 피하시면 저렴하게 이사하실수 있습니다.</div>
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
