@php
$clean_options = collect([
    (object) [ 'val' => '줄눈시공', 'title' => '줄눈시공', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
    (object) [ 'val' => '피톤치드', 'title' => '피톤치드', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
    (object) [ 'val' => '해충방역', 'title' => '해충방역', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
    (object) [ 'val' => '스티커 제거', 'title' => '스티커 제거', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
    (object) [ 'val' => '얼룩 제거', 'title' => '얼룩 제거', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
    (object) [ 'val' => '곰팡이 제거', 'title' => '곰팡이 제거', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
    (object) [ 'val' => '나노 코팅', 'title' => '나노 코팅', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
    (object) [ 'val' => '마루 코팅', 'title' => '마루 코팅', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
    (object) [ 'val' => '탄성 코트', 'title' => '탄성 코트', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
    (object) [ 'val' => '새집증후군 제거', 'title' => '새집증후군 제거', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
    (object) [ 'val' => '바이러스 소독', 'title' => '바이러스 소독', 'desc' => '평당 3천원 ~',  'icon'=>'' ],
]);
@endphp

<div class="pop-page-step-header">
  <div class="pop-page-step-header-inner">
    청소옵션
  </div>
  <a class="pop-header-right" href="tel:16007728">
    <i class="fas fa-solid fa-phone-alt"></i> 1600-7728
  </a>
</div>
<div class="pop-page-step-body clean_body04">
  <div class="step-body-section">
    <h2>* 필요한 옵션을 선택하세요.</h2>
    <div class="clean_option nooption" id="clean_check_options">
      <ul>
        @foreach( $clean_options as $item)
        <li>
          <label>
            <input type="checkbox" name="options[]" value="{{$item->val}}" onChange="changedCleanOption('{{$item->val}}')">
            <span>{{$item->title}}</span>
          </label>
        </li>
        @endforeach

        <li>
          <label>
            <input type="checkbox" name="nooption" value="nooption" onChange="changedCleanOption('')">
            <span>옵션없음</span>
          </label>
        </li>

      </ul>
    </div>
  </div>
  <div class="contact_nextBtn clean_nextBtn">
    <span class="btn btn-secondary" onclick="gotoCleanNextStep(this)">다음</span>
  </div>
</div>
<script>
function changedCleanOption(val){
  if( val != '' ){
    $("#popcleanmodal input[name='nooption']").prop('checked', false)
  }else{
    $("#popcleanmodal input[name='options[]']:checked").prop('checked', false)
  }
}
</script>
