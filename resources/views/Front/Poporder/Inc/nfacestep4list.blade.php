
<script>
var ordergoodstype = {!! json_encode($ordergoods) !!};
var inpopuptemplate;
var inpopuptemplateobj=`
<div class="pop-page-content-pop-head">
  <div class="pop-page-content-pop-head-title" id="pop-page-content-pop-head">
    @{{title}}
  </div>
  <div class="pop-page-content-pop-head-closebtn" onClick="pop_page_content_pop_close()">
    <i class="fas fa-times"></i>
  </div>
</div>
<div class="pop-page-content-pop-body">
  <div class="pop-page-content-pop-body-cont" id="pop-page-content-pop-cont">

    <form id="inpopupOptionForm">
      <div class="pop-page-options-wrap">
        <div class="pop-page-options-select">
          <span class="pop-page-options-select-item">@{{title}}</span> 옵션을 선택해주세요.
        </div>
        <div class="pop-page-options-list">
          @{{#each inp}}
          <div class="pop-page-options-list-item">
            <div class="pop-page-options-list-item-title">@{{title}}</div>
            <div class="stepper stepper-init move_pop_goodslist_item_stepper">
              <div class="stepper-button-minus" onClick="minus_stepper_manual(this)"></div>
              <div class="stepper-input-wrap">
                <input type="number" data-title="@{{optionname}}" data-id="@{{../id}}" data-name="@{{inpname}}" min="0" max="100" step="1" value="@{{val}}">
              </div>
              <div class="stepper-button-plus" onClick="plus_stepper_manual(this)"></div>
            </div>
          </div>
          @{{/each}}
        </div>

        <div class="pop-page-options-btnwrap">
          <div class="btn btn-secondary" onClick="optionReplaceDone()">확인</div>
        </div>
      </div>
    </form>

  </div>
</div>
`
/* 짐 Item 정보 구하기*/
function findItemInGoodsList(items, id){
  var item =  items.items.filter(function(e){
    if (e.id ==id) { return e }
  })
  if( item ) return item[0]
  else return null
}
function filterGoodsList2(id){
  return  ordergoodstype.filter(function(types){
    var res = findItemInGoodsList( types , id )
      console.log (res )
    if( res ) return res
  })
}
async function filterGoodsList(id) {
  var ret
  ordergoodstype.forEach(async (item) => {
    var res = findItemInGoodsList(item, id)
    if(res) {
      ret = res
      return false;
    }
  })
  return ret;
}
var tttt
$("document").ready( function() {
  inpopuptemplate = Handlebars.compile( inpopuptemplateobj );
  $(".stepper-button-minus").on( 'click', function (e){
    var inp = $(e.target).closest('.stepper-init').find('input')
    var min = ( typeof $(inp).data('min') == 'undefined') ? 0 : parseInt($(inp).data('min')) ;
    var max = ( typeof $(inp).data('max') == 'undefined') ? 1000 : parseInt($(inp).data('max')) ;
    var val = parseInt( $(inp).val() );
    val = ( val <= min ) ? min : val - 1
    $(inp).val(val)
    $(inp).trigger("change")

    if ( $(inp).val() > 0 ){
      $(inp).closest('.ordergoods-item').addClass('option-select-done')
    }else $(inp).closest('.ordergoods-item').removeClass('option-select-done')
  })
  $(".stepper-button-plus").on( 'click', function (e){
    var inp = $(e.target).closest('.stepper-init').find('input')
    var min = ( typeof $(inp).data('min') == 'undefined') ? 0 : parseInt($(inp).data('min')) ;
    var max = ( typeof $(inp).data('max') == 'undefined') ? 1000 : parseInt($(inp).data('max')) ;
    var val = parseInt( $(inp).val() );
    val = ( val >= max ) ? max : val + 1
    $(inp).val(val)
    $(inp).trigger("change")
    if ( $(inp).val() > 0 ){
      $(inp).closest('.ordergoods-item').addClass('option-select-done')
    }else $(inp).closest('.ordergoods-item').removeClass('option-select-done')
  })

  $(".stepper-option-add-col").on( 'click', function (e){
      var btn = e.target;
      var item = $(e.target).closest('.ordergoods-item')
      var data = filterGoodsList( $(item).data('id')).then(res=>{
        //alert ( res.title + " : "+ res.options.length + "개 옵션")
        var inp = []
        for( var i = 0 ; i < res.options.length ; i++){
          //console.log(`input[name='goods[${res.title}][${res.options[i]}]']`)
          var val = $(`input[name='goods[${res.title}_${res.options[i]}]']`).val()
          //console.log(val)
          inp.push({title: res.options[i], inpname : `${res.title}_${res.options[i]}`,optionname :res.options[i],  val: val})
        }
        var data = {
          id: res.id,
          title: res.title,
          options: res.options,
          inp: inp,
        }
        $("#inpopup-content").html( inpopuptemplate(data) )
        pop_page_content_pop_open()
        donetest( item, res )
      })
  });
})
function optionReplaceDone(){
  var form = document.querySelector('#inpopupOptionForm')
  var elements = form && form.elements ? form.elements : [];
  var arr={id : '0', data:[]}

  for ( var i = 0; i < elements.length; i ++) {
    var input = elements[i]
    var name = $(elements[i]).data('name')
    var val = $(elements[i]).val()
    if(arr.id == '0') arr.id = $(elements[i]).data('id')
    $(`input[name='goods[${name}]']`).val( val )
    if ( val > 0 ) {
    	arr.data.push( { title : $(elements[i]).data('title'), val : val } )
    }
  }
  $("#goods_optionsrt_" + arr.id ).empty();
  for( var i = 0 ; i < arr.data.length ; i ++){
    var data = arr.data[i]
    $("#goods_optionsrt_" + arr.id ).append(`<div class="ordergoods-item-options-str-item">${data.title}(${data.val})</div>`)
  }
  pop_page_content_pop_close()
  $("#pop-page-content-pop-cont").empty();
  $("#pop-page-form input.jspersist").trigger('change')
}
/*
  저장되어있던 값들로 옵션 보이게
  $(".added_rows").each( function( i, v) { pop_options_select_redraw(v) })
*/
function pop_options_select_redraw(div) {
	var data = []
	var inp = $(div).children("input")
	var target = "#goods_optionsrt_" + $(div).data('id')
  $(target).empty();
	for ( var i =0; i < inp.length; i++) {
		var input = inp[i];
		if( $(input).val() > 0 ) data.push( { title : $(input).data('optionname'), val : $(input).val()})
	}
	//$(target).empty();
  for( var i = 0 ; i < data.length ; i ++){
		var itemdata = data[i]
		$(target).append(`<div class="ordergoods-item-options-str-item">${itemdata.title}(${itemdata.val})</div>`)
  }
  if( data.length > 0 ) $(div).closest('.ordergoods-item').addClass('option-select-done')
  else $(div).closest('.ordergoods-item').removeClass('option-select-done')
}
function pop_stepper_select_redraw(inp){
  if ( $(inp).val() > 0 ){
    $(inp).closest('.ordergoods-item').addClass('option-select-done')
  }else $(inp).closest('.ordergoods-item').removeClass('option-select-done')
}

function clearAllGoods(){
  $('input[name^="goods"]').each(function() {
    $(this).val('0');
  });
  $(".added_rows").each( function( i, v) { pop_options_select_redraw(v) })
  $("#pop-page-form input.jspersist").trigger('change')
}

function minus_stepper_manual(btn){
  var inp = $(btn).next(".stepper-input-wrap").children("input")
  var min = parseInt($(inp).attr('min'))
  var max = parseInt($(inp).attr('max'))
  var val = parseInt($(inp).val())
  if( val <= min ) val = 0;
  else val = val - 1;
  $(inp).val( val )
  if (val > 0 ) $(btn).closest('.ordergoods-item').addClass('option-select-done')
}

function plus_stepper_manual(btn){

  var inp = $(btn).closest('.stepper').children('.stepper-input-wrap').children('input')
  var min = parseInt($(inp).attr('min'))
  var max = parseInt($(inp).attr('max'))
  var val = parseInt($(inp).val() )
  if( val >= max ) val = max;
  else val = val + 1;
  $(inp).val( val )
  if (val > 0 ) $(btn).closest('.ordergoods-item').addClass('option-select-done')
}
function donetest(target, res){
  return
  async function processArray(array) {
    var ret = '';
    array.forEach( ( item, i ) => {
      ret += item + '(' + i +')'
      if (i < array.length - 1) ret += ', '
    })
    return ret
  }

  var title = res.title
  processArray( res.options).then(res=>{
    title +=  "( " + res + " )"
    $(target).addClass('option-select-done')
    $(target).children('.ordergoods-item-inner').children('.ordergoods-item-title').text(title)
  })

}
</script>
<div class="pop-content-wrap select-moveing-list">
    <!--<div>짐량확인</div>-->

    <div class="select-moveing-list-inner">
      @foreach( $ordergoods as $goostype)
        <div class="ordergoods-items">

          <div class="ordergoods-items-type-title">
            {{$goostype->type_title}}
          </div>
          <div class="ordergoods-items-list">
            @foreach( $goostype->items as $item)
              <div class="ordergoods-item" id="goods_{{$item->id}}" data-id="{{$item->id}}" data-parent-id="{{$goostype->id}}" data-title="{{$item->title}}">
                <div class="ordergoods-item-inner">
                  <div class="ordergoods-item-title">{{$item->title}}<div class="ordergoods-item-options-str" id="goods_optionsrt_{{$item->id}}"></div></div>
                  @if( $item->options == null )
                  <div class="stepper stepper-init move_pop_goodslist_item_stepper">
  									<div class="stepper-button-minus"></div>
  									<div class="stepper-input-wrap">
  										<input type="number" min="0" max="100" step="1" value="0" name="goods[{{$item->title}}]" >
  									</div>
  									<div class="stepper-button-plus"></div>
				          </div>
                  @else
                  <div class="stepper-option-add-col">
                    <i class="far fa-plus-square"></i>
                    <i class="fas fa-check-square"></i>
                    <div class="added_rows" data-id="{{$item->id}}" style="display:none">
                      @foreach($item->options as $option)
                        <input type="number" value="0" data-optionname="{{$option}}" name="goods[{{$item->title}}_{{$option}}]" >
                      @endforeach
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
</div>
