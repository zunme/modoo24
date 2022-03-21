@php
$clean_options = collect([
    (object) [
        'val' => '1',
        'title' => '피톤치드',
        'desc' => '평당 3천원 ~',
        'icon'=>''
    ],
    (object) [
        'val' => '2',
        'title' => '마루코팅',
        'desc' => '평당 3천원 ~',
        'icon'=>''
    ],
    (object) [
        'val' => '3',
        'title' => '새집증후군제거',
        'desc' => '평당 3천원 ~',
        'icon'=>''
    ],
    (object) [
        'val' => '4',
        'title' => '바이러스소독',
        'desc' => '평당 2천원 ~',
        'icon'=>''
    ],
]);
@endphp

<div class="pop-page-step-header">
	<div class="pop-page-step-header-inner">
		청소종류
	</div>
</div>
<div class="pop-page-step-body">
<pre>
  청소종류 name='type'
  청소옵션 name='options'
    옵션없음 name='nooption'
    css community/assets/css/clean_order_pop.css
</pre>
	내용
	<span class="btn btn-secondary" onclick="gotoCleanNextStep(this)">다음</span>

</div>

<script>
function changedCleanOption(val){
  if( val > 0 ){
    $("#popcleanmodal input[name='nooption']").prop('checked', false)
  }else{
    $("#popcleanmodal input[name='options']:checked").prop('checked', false)
  }
}
</script>
