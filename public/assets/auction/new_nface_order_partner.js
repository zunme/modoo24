Handlebars.registerHelper('isObject', function(value) {
  if( typeof value =='object') return true;
  else return false;
})

var goodsTemplate =`
<div class="modal-content"  style="padding-bottom: 60px !important;">
  {{#if goods}}
    <div class="goods_info_wrap">
      {{#each goods}}
          {{#if ( isObject @this ) }}
          <div class="goods_info_option_wrap">
            <div class="goods_title">{{@key}}</div>
            <div class="goods_options">
              {{#each @this}}
              <div class="goods_option">
                  <div class="goods_option_title">{{@key}}</div>
                  <div class="goods_option_val">{{@this}}</div>
              </div>
              {{/each}}
            </div>
          </div>
          {{else}}
          <div class="goods_info_option_wrap">
              <div class="goods_title">{{@key}}</div>
              <div class="goods_option_val">{{@this}}</div>
          </div>
          {{/if}}
      {{/each}}
    </div>
  {{/if}}

  {{#if images}}
  <div class="image_info_wrap">
    {{#each images}}
      <a href="https://modoo24.net/community/storage{{this.url}}" data-lightbox="roadtrip" class="image_info_image" style="background-image: url(https://modoo24.net/community/storage{{this.url}});">
      </a>
    {{/each}}
  </div>
  {{/if}}
    <button class="basic_btn modal_close_btn" onclick="javascript:void(0);">확인</button>
</div>
`

$.ajax({
  url : '/community/partner/info/' + new_orderId,
  method:"get",
  dataType:'JSON',
  success:function(result){
    var data = result.data
    if( data.cafe_name =="모두이사_official_untact2"){
      redraw_orderinfopage(data)
    }
  }
})

function redraw_orderinfopage(data){
  var hp = data.hp.replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  //console.log ( hp )

  var resdata ={
    classify :'',
    stype : '',
    images : false,
    goods : false,
  };


  switch ( String(parseInt(data.classify))){
    case '1' :
      resdata.classify = '소형';
      break;
    case '2' :
      resdata.classify = '가정';
      break;
    case '3' :
      resdata.classify = '사무실';
      break;
    case '4' :
      resdata.classify = '용달';
      break;
    default :
      resdata.classify = '이사형태없음';
  }
  switch( String(parseInt(data.stype)) ){
    case '1' :
      resdata.stype = '일반이사';
      break;
    case '2' :
      resdata.stype = '포장이사';
      break;
    case '3' :
      resdata.stype = '고급이사';
      break;
    case '4' :
      resdata.stype = '원룸이사';
      break;
    case '5' :
      resdata.stype = '보관이사';
      break;
    case '6' :
      resdata.stype = '기업이사';
      break;
    case '7' :
      resdata.stype = '반포장이사';
      break;
    default :
      resdata.stype = "이사종류미지정"
  }


  if( typeof data.img_files == 'object' ) resdata.images = data.img_files
  if( typeof data.goods == 'object' ) resdata.goods = data.goods


  if( data.s_check_type == 'pic'){
	  $(".btn2_set_N").children('li:first-child').css("width" , "100%")
	$(".btn2_set_N").children('li:nth-child(2)').remove()
	
    } else {
	    $(".btn2_set_N").children('li:nth-child(2)').css("width" , "100%")
	$(".btn2_set_N").children('li:first-child').remove()

    }

  var goodsTemplateCompiled = Handlebars.compile( goodsTemplate );

  $("#pics_modal").html(goodsTemplateCompiled(resdata))
  $("#boxs_modal").html(goodsTemplateCompiled(resdata))
	console.log(resdata);

}
