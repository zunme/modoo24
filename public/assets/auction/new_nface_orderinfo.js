Handlebars.registerHelper('isObject', function(value) {
  if( typeof value =='object') return true;
  else return false;
})

var ul = $("#print_area >ul.order_form_addr_area")

$("#print_area > table:first-child").attr("id", 'order_info_table')

$( ul[0] ).children('li:first-child').children('table').attr("id", 'start_info_table')
$( ul[0] ).children('li:nth-child(2)').children('table').attr("id", 'end_info_table')

$( ul[1] ).children('li:first-child').children('table').attr("id", 'package_info_table1')
$( ul[1] ).children('li:nth-child(2)').children('table').attr("id", 'package_info_table2')

var goodsTemplate =`
<div class="modal-content"  style="padding-bottom: 30px !important;">
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
  url : '/community/rhksfl/neworder/nface/info/' + new_orderId,
  method:"get",
  dataType:'JSON',
  success:function(result){
    var data = result.data
    if( data.cafe_name =="모두이사_official_untact2"){
      redraw_orderinfopage(data)
    }
  }
})
var test
function redraw_orderinfopage(data){
  var hp = data.hp.replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  console.log ( hp )

  var resdata ={
    classify :'',
    stype : '',
    keep : '',
    images : false,
    goods : false,
    use_internet : 'N',
    carry_together_view : '',
    carry_together : '',
  };

  if ( data.s_uid == 1) resdata.use_internet = 'Y'

  switch ( String(parseInt(data.classify))){
    case '1' :
      resdata.carry_together_view = '같이옮기기';
      resdata.classify = '소형';
      if( data.s_with2 == 1 ) resdata.carry_together = 'Y'
      else  resdata.carry_together = 'N'
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

  if( data.keep =='Y') resdata.keep="(보관이사 O )";
  else resdata.keep="(보관이사 X )";

  if( typeof data.img_files == 'object' ) resdata.images = data.img_files
  if( typeof data.goods == 'object' ) resdata.goods = data.goods

  $('<tr><td>'+resdata.carry_together_view+'</td><td>'+resdata.carry_together+'</td><td>인터넷상담</td><td>'+resdata.use_internet+'</td></tr>').appendTo('#order_info_table')
  $('#order_info_table >tbody> tr:nth-child(4) > td:nth-child(2)').text(hp)
  $('#order_info_table >tbody> tr:nth-child(2) > td:nth-child(4)').text('비대면 '+ resdata.classify + resdata.keep)
  $('#order_info_table >tbody> tr:nth-child(3) > td:nth-child(4)').text( resdata.stype )

  $('#start_info_table > tbody> tr:nth-child(1) > td:nth-child(2)').text('')
  $('#end_info_table > tbody> tr:nth-child(1) > td:nth-child(2)').text('')

  $('#start_info_table > tbody> tr:nth-child(2) > td:nth-child(3)').text('')
  $('#end_info_table > tbody> tr:nth-child(2) > td:nth-child(3)').text('')
  $('#start_info_table > tbody> tr:nth-child(2) > td:nth-child(4)').text('')
  $('#end_info_table > tbody> tr:nth-child(2) > td:nth-child(4)').text('')

  if( data.s_check_type == 'pic'){
    $("#package_info_table1").parent().remove()
  } else $("#package_info_table2").parent().remove()

  var goodsTemplateCompiled = Handlebars.compile( goodsTemplate );

  $("#pics_modal").html(goodsTemplateCompiled(resdata))
  $("#boxs_modal").html(goodsTemplateCompiled(resdata))
  /*
    gtag('config', 'UA-XXXXXXXX-X', {
          page_title: 'Hello world',
          page_location: 'https://blog-service.bbon.me/users/@bbonkr/posts/hello-world'
          page_path: '/users/@bbonkr/posts/hello-world'
  });
  */

}
