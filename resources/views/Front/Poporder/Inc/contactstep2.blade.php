<div class="pop-page-step-header contact_header">
  <div class="pop-page-step-header-inner">
    이사날짜
  </div>
  <a class="pop-header-right" href="tel:{{$service_center_tel}}">
    <i class="fas fa-solid fa-phone"></i> {{$service_center_tel_display}}
  </a>
</div>
<div class="pop-page-step-body">
  <div class="contact_step02">
    <!-- <pre>
      td.son-active 처리필요합니다. (손없는날)
    </pre> -->
    <div id="conatct-step-movedate"></div>
    <input type="hidden" name="mdate" id="conatct-step-mdate-inp" value="">

  </div>
  <div class="contact_nextBtn">
    <span class="btn btn-secondary" onclick="gotoContactNextStep(this)">다음</span>
  </div>
  <div class="movedate-txt-son-wrap">
      <div class="txt-son-info"><span></span>표시는 손없는 날입니다</div>
      <div class="txt-expensive-move-day"><span class="pt_red">금요일, 월말, 손없는날</span>을 피하시면 저렴하게 이사하실수 있습니다.</div>
  </div>
</div>


<script>
$(function () {
  var startContactMovingDate = new Date();
   var endContactMovingDate = new Date();
   var numberOfDaysContactStart = 1; //내일부터
   var numberOfDaysContactEnd = 60; //200일 비대면일경우 , 대면은 60일??
   startContactMovingDate.setDate(startContactMovingDate.getDate() + numberOfDaysContactStart);
   endContactMovingDate.setDate(endContactMovingDate.getDate() + numberOfDaysContactEnd);

    $('#conatct-step-movedate').datepicker({
       inline: true,
       sideBySide: false,
       format: "yyyy-mm-dd",
       language: "ko",
       startDate: startContactMovingDate,
       endDate:endContactMovingDate,
       todayHighlight: true,
       container: '#conatct-step-movedate-container',
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
       $("#conatct-step-mdate-inp").val( moment(e.date).format('YYYY-MM-DD'))
   });
    $('#conatct-step-modedate').on('dp.change', function(event) { console.log(event.date); });
});

</script>
