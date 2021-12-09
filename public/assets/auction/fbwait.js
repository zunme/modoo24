Handlebars.registerHelper('numberFormat', function (value, options) {
    // Helper parameters
    var dl = options.hash['decimalLength'] || 0;
    var ts = options.hash['thousandsSep'] || ',';
    var ds = options.hash['decimalSep'] || '.';

    // Parse to float
    var value = parseFloat(value);

    // The regex
    var re = '\\d(?=(\\d{3})+' + (dl > 0 ? '\\D' : '$') + ')';

    // Formats the number with the decimals
    var num = value.toFixed(Math.max(0, ~~dl));

    // Returns the formatted number
    return (ds ? num.replace('.', ds) : num).replace(new RegExp(re, 'g'), '$&' + ts);
});
Handlebars.registerHelper("dateformat", function(lvalue,rvalue, options) {
  return moment(lvalue,"YYYY-MM-DD HH:mm:ss").format(rvalue);
})
Handlebars.registerHelper('nl2br', function(text) {
  text = Handlebars.Utils.escapeExpression(text);
  text = text.replace(/(\r\n|\n|\r)/gm, '<br>');
  return new Handlebars.SafeString(text);
});
Handlebars.registerHelper("star", function(value, options) {
  let ret = ``
  let star = parseFloat( value);
  for( let i =0; i < 5 ;i ++ ){
    let val = star - i;
    if( val - 1 >= 0) ret += '<i class="fas fa-star"></i>'
    else if ( val - 0.5 >= 0) ret += '<i class="fas fa-star-half-alt"></i>'
    else ret += '<i class="far fa-star"></i>'
  }
  return ret
})
Handlebars.registerHelper('isEqual', function (expectedValue, value) {
  return value === expectedValue;
});
Handlebars.registerHelper('isNotEqual', function (expectedValue, value) {
  return value !== expectedValue;
});
Handlebars.registerHelper('checknotempty', function(value) {
    if ( typeof value == 'undefined') return false;
    if ( typeof value == 'object'  ) {
      if ( value === null ) return false;
      if( Object.keys(value).length == 0 ) return false;
      else return true
    }
    if ( typeof value == 'string') value = value.trim();
    if (value === null) return false;
    else if (value === '') return false;
    else return true;
});
Handlebars.registerHelper("starpercent", function(lvalue, options) {
  lvalue = parseFloat(lvalue);
  return lvalue*100/5
})

function getpost( url,data , callbackSuccess, callbackCompleted, callbackError ){
  $.ajax({
            url : '/community/refresh',
            method:"get",
            dataType:'JSON',
            success:function(result){
              $('meta[name="csrf-token"]').attr('content', result.token);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': result.token
                    }
                });

                $.ajax({
                  url: url,
                  method:"POST",
                  data: data ,
                  dataType:'JSON',
                  success:function(res)
                  {
                    callbackSuccess(res)
                  },
                  error: function ( err ){
                    console.log ( err )
                    if( typeof callbackError =='undefined') ajaxErrorST(err)
                    else callbackError( err )
                  },
                  complete : function() {
                    if ( typeof callbackCompleted != 'undefined') callbackCompleted();
                  }
                });
            }, // end success

          });
}
function ajaxErrorST(jqXHR ){
$('.loading_wrap').hide();
if(jqXHR.status != 422 && jqXHR.status != 500 ) {
  iziToast.show({
      theme: 'dark',
      message: '잠시후에 이용해주세요',
      position: 'bottomRight'
  });
  return;
}

var msg ;
var exception ;
if (jqXHR.responseJSON ) {
  msg = (jqXHR.responseJSON.errors) ? jqXHR.responseJSON.errors : jqXHR.responseJSON;
  exception = jqXHR.responseJSON.exception;
}
console.log(msg) ;

  if(msg) {
    if( msg.message ){
      iziToast.show({
          theme: 'dark',
          message: msg.message,
          position: 'bottomCenter'
      });
    }else {
      for(key in msg) {
        if(msg.hasOwnProperty(key)) {
          if(key.indexOf('.') < 0 ) {
            $('input[name='+key+']').focus();
          }
          if ( $.isNumeric( key )) {
            iziToast.show({
                theme: 'dark',
                message: msg,
                position: 'center'
            });
          } else {
            iziToast.show({
                theme: 'dark',
                message:  msg[key][0],
                position: 'center'
            });
          }
          break;
        }
      }
    }
  } else {
    iziToast.show({
        theme: 'dark',
        message:  '잠시후에 이용해주세요',
        position: 'bottomCenter'
    });
  }
}

let reviewTemplate;
let reviewpage = {'uncomment':1, 'comment':1};
//let imgurl = 'http://116.122.157.150:8084'
let imgurl ='';

function uncomment(){
  $.ajax({
    url : '/community/api/review/files/my',
    method:'get',
    dataType:'JSON',
    success:function(res){

      var gradetemplate = Handlebars.compile( gradeTemplate )

      $(".pamove_review").html(gradetemplate(res.data))
      reviews('uncomment');
    },
    error: function ( err ){

    },
  });
}


let gradeTemplate = `
<div class="pagrade">
    <div class="patn">{{numberFormat rating.totalstar decimalSep="." decimalLength="1" thousandsSep=","}}점</div>
    <div class="inline-panel-total-rating">
    {{#each stararr.totalstar}}
      {{#if (isEqual this "1") }}
        <i class="fas fa-star stcolor"></i>
      {{else if ( isEqual this "0.5") }}
        <i class="fas fa-star-half-alt stcolor"></i>
      {{else}}
        <i class="far fa-star stcolor"></i>
      {{/if}}
    {{/each}}
    </div>
    <span>{{companyGrade.title}}</span>
</div>
<div class="papagraph">
    <div>
        <span class="gtitle">전문성</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_pro}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_pro}}</span>
    </div>
    <div>
        <span class="gtitle">친절성</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_kind}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_kind}}</span>
    </div>
    <div>
        <span class="gtitle">가격도</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_price}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_price}}</span>
    </div>
    <div>
        <span class="gtitle">마무리</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_finish}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_finish}}</span>
    </div>
    <div>
        <span class="gtitle">사후관리</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_expost}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_expost}}</span>
    </div>
    <div>
        <span class="gtitle">포장도</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_pave}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_pave}}</span>
    </div>
</div>
<div class="review" id="review_section_uncomment">
</div>
`
function changetab(commenttype){
  let tab = "#tab-wrapper-" + commenttype;

  //if( !$(tab).hasClass('hide') ) return;
  //$(".tab-wrapper").addClass('hide')
  //$(tab).removeClass('hide')
  reviewpage = {'uncomment':1, 'comment':1};
  $(".button.btn_more").show();
  if( commenttype =='uncomment'){
      uncomment();
  }else{
      $("#review_section_comment").empty();
      reviews('comment');
  }
  $(".tab-wrapper:not([style*=none])").fadeOut()
  $(tab).fadeIn()
}
function reviews(commenttype){

  if( commenttype =='uncomment' && !reviewTemplate ) reviewTemplate = Handlebars.compile( review );
  else if( commenttype =='comment' && !reviewTemplate ) reviewTemplate = Handlebars.compile( commentreview );

  $.ajax({
    url : '/community/api/review/staffMyReviews/'+commenttype,
    method:'get',
    dataType:'JSON',
    data:{page: reviewpage[commenttype]},
    success:function(res){
       let data = res.data
      if( data.current_page >= data.last_page ) {
        $("#review_more_"+commenttype).hide();
      }
      else reviewpage[commenttype]++
      $("#review_section_"+commenttype).append( reviewTemplate(data))
    },
    error: function ( err ){
      if(document.URL.indexOf("#")==-1){
        if( err.status == '401'){
          window.location = document.URL+"#";
          location.reload()
        }else  ajaxErrorST(err)
      }else{
        if( err.status == '401') location.href="/m"
        else ajaxErrorST(err)
      }
    },
  });
}
let commentPrcBtn
function commentprc (btn){
  commentPrcBtn = btn
  let url = '/community/api/review/staffMyReviews'
  getpost( url,$(btn).closest('form').serialize() , callbackSuccessfn, ()=>{},callbackErrorCheck )
}
function callbackSuccessfn(res){
  iziToast.show({
      theme: 'dark',
      message: '댓글을 작성하셨습니다.',
      position: 'bottomRight'
  });
  $(commentPrcBtn).closest('.pareview').hide('slow')
}
function callbackErrorCheck(res){
  if (res.status == 409){
    iziToast.show({
        theme: 'dark',
        message: '이미 댓글을 작성하셨습니다.',
        position: 'bottomRight'
    });
    $(commentPrcBtn).closest('.pareview').hide('slow')
  }else ajaxErrorST(res);
}

let review=`
{{#if data.length}}
  {{#each data}}
<div class="pareview {{#if (isEqual b_atype '불편') }}notfeel{{/if}} {{#if ( isEqual commentType 'comment')}}pareview_open{{/if}}">
        <div class="date_name">
            <p class="user">
                <i class="far fa-user"></i>
            </p>
            <ul class="user_infor">
                <li>{{b_name}} 고객님</li>
                <li>등록일 : {{ dateformat b_reg_date 'YYYY-MM-DD'}}</li>
            </ul>
            {{#if (isEqual b_atype '불편') }}
            <span class="rvmark nrv_mark">불편신고</span>
            {{else}}
            <span class="rvmark">칭찬후기</span>
            {{/if}}
            <div class="com_set">
                <div class="grade_item">
                    <div class="item_title">전문성</div>
                    <div class="item_star stcolor">
                        {{{ star b_star_pro }}}
                    </div>
                </div>
                <div class="grade_item">
                    <div class="item_title">친절성</div>
                    <div class="item_star stcolor">
                        {{{ star b_star_kind }}}
                    </div>
                </div>
                <div class="grade_item">
                    <div class="item_title">가격도</div>
                    <div class="item_star stcolor">
                        {{{ star b_star_price }}}
                    </div>
                </div>
                <div class="grade_item">
                    <div class="item_title">마무리</div>
                    <div class="item_star stcolor">
                        {{{ star b_star_finish }}}
                    </div>
                </div>
                <div class="grade_item">
                    <div class="item_title">사후관리</div>
                    <div class="item_star stcolor">
                        {{{ star b_star_expost }}}
                    </div>
                </div>
                <div class="grade_item">
                    <div class="item_title">포장도</div>
                    <div class="item_star stcolor">
                        {{{ star b_star_pave }}}
                    </div>
                </div>
            </div>

            <div class="comments">
                {{{nl2br b_note}}}
            </div>

            <div class="review_img">
                <div class="review_row">
                    {{#each files}}
                      <div class="four_img pic" style="background-image:url(${imgurl}/community/storage{{url}})"><a href="${imgurl}/community/storage{{url}}" data-lightbox="image-r-{{review_id}}"
                       data-title="{{../b_mdate}} [{{#if ( isEqual ../b_type '이사')}}방문이사{{else }}{{b_type}}{{/if}}]" style="display:block;height:100%;"></a></div>
                    {{/each}}
                </div>
            </div>
{{#if ( checknotempty r_content) }}
            <div class="com_ment">
                {{{nl2br r_content}}}
            </div>
{{else}}
<form>
            <input type="hidden" name="id" value="{{b_uid}}">
            <textarea name="r_content" class="com_reply" placeholder="1회에 한해 댓글 작성이 가능합니다.
자극적인 단어 욕설 등은 자동 숨김 처리됩니다." rows="4"></textarea>
            <span class="reply_submit" onClick="commentprc(this)">댓글등록</span>
</form>
{{/if}}
        {{#if ( isEqual commentType 'uncomment')}}
            <span class="deopen closer" onclick="reviewboxopen(this)"></span>
        {{/if}}
        </div>
    </div>
  {{/each}}
{{else}}
<div class="nonedata">
등록된 이사 후기가 없습니다
</div>
{{/if}}
`
let commentreview = `
{{#if data.length}}
  {{#each data}}

<div class="pareview pareview_open {{#if (isEqual b_atype '불편') }}notfeel{{/if}}">
    <div class="date_name">
        <p class="user">
            <i class="far fa-user"></i>
        </p>
        <ul class="user_infor">
            <li>{{b_name}} 고객님</li>
            <li>등록일 : {{ dateformat b_reg_date 'YYYY-MM-DD'}}</li>
        </ul>
        {{#if (isEqual b_atype '불편') }}
        <span class="rvmark nrv_mark">불편신고</span>
        {{else}}
        <span class="rvmark">칭찬후기</span>
        {{/if}}
        <div class="com_set">
            <div class="grade_item">
                <div class="item_title">전문성</div>
                <div class="item_star stcolor">
                    {{{ star b_star_pro }}}
                </div>
            </div>
            <div class="grade_item">
                <div class="item_title">친절성</div>
                <div class="item_star stcolor">
                    {{{ star b_star_kind }}}
                </div>
            </div>
            <div class="grade_item">
                <div class="item_title">가격도</div>
                <div class="item_star stcolor">
                    {{{ star b_star_price }}}
                </div>
            </div>
            <div class="grade_item">
                <div class="item_title">마무리</div>
                <div class="item_star stcolor">
                    {{{ star b_star_finish }}}
                </div>
            </div>
            <div class="grade_item">
                <div class="item_title">사후관리</div>
                <div class="item_star stcolor">
                    {{{ star b_star_expost }}}
                </div>
            </div>
            <div class="grade_item">
                <div class="item_title">포장도</div>
                <div class="item_star stcolor">
                    {{{ star b_star_pave }}}
                </div>
            </div>

        </div>
        <div class="comments">
            {{{nl2br b_note}}}
        </div>

        <div class="review_img">
            <div class="review_row">
                {{#each files}}
                  <div class="four_img pic" style="background-image:url(${imgurl}/v2/storage{{url}})"><a href="${imgurl}/v2/storage{{url}}" data-lightbox="image-r-{{review_id}}"
                   data-title="{{../b_mdate}} [{{#if ( isEqual ../b_type '이사')}}방문이사{{else }}{{b_type}}{{/if}}]" style="display:block;height:100%;"></a></div>
                {{/each}}
            </div>
        </div>

        <div class="com_ment">
            {{{nl2br r_content}}}
        </div>

    </div>
</div>
  {{/each}}
{{else}}
<div class="nonedata">
등록된 이사 후기가 없습니다
</div>
{{/if}}

`
