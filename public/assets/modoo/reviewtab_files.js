let filesLength = 0;
let reviewpage = 1;
let reviewTenplate
let isViewTab = false;

$('document').ready( function() {
  /*
  $(".move_consulting > .imgC >span").each( function(index, item) {
    let src = $(item).attr('src')
    let title = $(item).text();
    $(item).html( `<a href="${src}" data-lightbox="imageView1" data-title="${title}">${title}</a>` )
  })
  */
  //$("#tab2 ul.btn_set2.pdt15").html( $("#tab1 ul.btn_set2.pdt15").clone()  )
  $("#tab2 ul.btn_set2.pdt15").empty();

  $.ajax({
    url : '/v2/api/review/files/'+ s_uid,
    method:'get',
    dataType:'JSON',
    success:function(res){

      var template = Handlebars.compile( imgTemplate );
      var gradetemplate = Handlebars.compile( gradeTemplate )
      var regfilestempate = Handlebars.compile( regfilesTempate )

      if( res.data.files.length > 0 ){
        filesLength = ( res.data.files.length > 2 ) ? 3 : res.data.files.length;
        //$("#tab2 > ul.move_pic").empty();
        $("#tab2 > ul.move_pic").html(template(res.data))
      }else   $("#tab2 > ul.move_pic").empty()
      $(".move_consulting").html( regfilestempate(res.data) )
      $("#tab2 > div.move_review").html(gradetemplate(res.data))
      reviews();
      $("#tab2 ul.btn_set2.pdt15").html( $("#tab1 ul.btn_set2.pdt15").html()  )
    },
    error: function ( err ){

    },
  });
  $("ul.tabs_my li").click(function() {
    var activeTab = $(this).find("a").attr("href");

    if( activeTab =='#tab2') {
      isViewTab = true;
      setTimeout( afterreview, 500)
    }
  });
})
function reviews(){
  reviewTenplate = Handlebars.compile( review );
  $.ajax({
    url : '/v2/api/review/staff/'+ s_uid,
    method:'get',
    dataType:'JSON',
    data:{page: reviewpage},
    success:function(res){
       let data = res.data
      if( data.current_page >= data.last_page ) $(".btn.more_btn").hide();
      else reviewpage++
      $("#review_section").append( reviewTenplate(data))
      setTimeout( afterreview, 500)
    },
    error: function ( err ){

    },
  });
}
function afterreview(){
  $('.evaluate.entire > p').each( function( i,v) {
    if( !isViewTab ) return;
    if( $(v).prop('scrollHeight') <= $(v).height() ) {
      $(v).parent().next().remove()
    }
  })
}
function reviewboxopenv2(btn){
	let box = $(btn).closest('.move_content ')
	if( $(box).hasClass("review_open") )  $(box).removeClass("review_open")
	else $(box).addClass("review_open")
}
let imgTemplate = `
{{#if files.length}}
  {{#each files}}
    <li class="mycp_pic imgD  {{#if ( isEqual @index 3) }} imgM {{/if}} {{#if ( gte  @index 4 ) }} hidden {{/if}}">
    <!--img src="/v2/storage{{url}}"-->
      <a href="/v2/storage{{url}}" data-lightbox="photos" class="thumbnail2">
      {{#if ( isEqual @index 3) }}
      <i class="fas fa-plus"></i>
      <span>?????????</span>
      {{/if}}
           <img data-src="holder.js/100%x180" alt="100%x180" src="/v2/storage{{url}}" data-holder-rendered="false" >
       </a>
    </li>
  {{/each}}

{{else}}
<div></div>
{{/if}}
`
Handlebars.registerHelper("starpercent", function(lvalue, options) {
  lvalue = parseFloat(lvalue);
  return lvalue*100/5
})


let gradeTemplate = `
<div class="grade">
    <div class="patn">{{numberFormat rating.totalstar decimalSep="." decimalLength="1" thousandsSep=","}}???</div>
    <div class="inline-panel-total-rating">
      {{#each stararr.totalstar}}
        {{#if (isEqual this "1") }}
          <i class="fas fa-star"></i>
        {{else if ( isEqual this "0.5") }}
          <i class="fas fa-star-half-alt"></i>
        {{else}}
          <i class="far fa-star"></i>
        {{/if}}
      {{/each}}
    </div>
    <span>{{companyGrade.title}}</span>
</div>
<div class="graph">
    <div>
        <span class="gtitle">?????????</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_pro}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_pro}}</span>
    </div>
    <div>
        <span class="gtitle">?????????</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_kind}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_kind}}</span>
    </div>
    <div>
        <span class="gtitle">?????????</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_price}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_price}}</span>
    </div>
    <div>
        <span class="gtitle">?????????</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_finish}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_finish}}</span>
    </div>
    <div>
        <span class="gtitle">????????????</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_expost}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_expost}}</span>
    </div>
    <div>
        <span class="gtitle">?????????</span>
        <div class="progress grate">
            <div class="progress-bar bg-info" role="progressbar" style="width:{{starpercent rating.star_pave}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span class="gtxt">{{rating.star_pave}}</span>
    </div>
</div>
<div class="review" id="review_section">
</div>
<span class="btn more_btn" onClick="reviews()">?????????<div class="ripple-container"></div></span>
`

let review =`
{{#if data.length}}
  {{#each data}}
  <div class="move_content">
    <dl class="move_infor">
        <dt>
        {{#if ( isEqual b_type '??????')}}
          ????????????
        {{else }}
          {{b_type}}
        {{/if}}
        </dt>
        <dd>{{dateformat b_mdate "YYYY.MM.DD"}}</dd>
    </dl>
    <div class="inline-panel-total-rating star">
      {{#each stararr.totalrate}}
        {{#if (isEqual this "1") }}
          <i class="fas fa-star"></i>
        {{else if ( isEqual this "0.5") }}
          <i class="fas fa-star-half-alt"></i>
        {{else}}
          <i class="far fa-star"></i>
        {{/if}}
      {{/each}}
    </div>
    <!-- ????????????6 : layer ?????? X?????? -->

    <a onclick="showmap(this);" style="vertical-align: middle;cursor: pointer;" class="btn deview">??????????????? > </a>

     <!-- ????????????7 : ???????????? ?????? - ??????????????? d-flex ????????? ?????? ?????? -->
    <div class="rt_pop" style="position: absolute; left: 6%; top: 48px; visibility: hidden; background:#ffffff;
       padding:15px 20px; border: 1px solid #999999; border-radius: 15px; font-size: 0.85em; display:inline-block;">
        <h4 class="score_infor">????????????</h4>
        <a onClick="closemap(this)" class="close"><i class="fas fa-times xcolor"></i></a>
        <div class="inline-panel-rating d-flex ml-2-depth newcolor">
            <div class="inline-panel-rating-wrap d-flex">
                <div class="inline-panel-rating-title">?????????</div>
                <div class="inline-panel-rating-inner">
                {{#each stararr.b_star_pro}}
                  {{#if (isEqual this "1") }}
                    <i class="fas fa-star"></i>
                  {{else if ( isEqual this "0.5") }}
                    <i class="fas fa-star-half-alt"></i>
                  {{else}}
                    <i class="far fa-star"></i>
                  {{/if}}
                {{/each}}
                </div>
            </div>
            <div class="inline-panel-rating-wrap d-flex">
                <div class="inline-panel-rating-title">?????????</div>
                <div class="inline-panel-rating-inner">
                {{#each stararr.b_star_kind}}
                  {{#if (isEqual this "1") }}
                    <i class="fas fa-star"></i>
                  {{else if ( isEqual this "0.5") }}
                    <i class="fas fa-star-half-alt"></i>
                  {{else}}
                    <i class="far fa-star"></i>
                  {{/if}}
                {{/each}}
                </div>
            </div>
            <div class="inline-panel-rating-wrap d-flex">
                <div class="inline-panel-rating-title">?????????</div>
                <div class="inline-panel-rating-inner">
                {{#each stararr.b_star_price}}
                  {{#if (isEqual this "1") }}
                    <i class="fas fa-star"></i>
                  {{else if ( isEqual this "0.5") }}
                    <i class="fas fa-star-half-alt"></i>
                  {{else}}
                    <i class="far fa-star"></i>
                  {{/if}}
                {{/each}}
                </div>
            </div>
            <div class="inline-panel-rating-wrap d-flex">
                <div class="inline-panel-rating-title">?????????</div>
                <div class="inline-panel-rating-inner">
                {{#each stararr.b_star_finish}}
                  {{#if (isEqual this "1") }}
                    <i class="fas fa-star"></i>
                  {{else if ( isEqual this "0.5") }}
                    <i class="fas fa-star-half-alt"></i>
                  {{else}}
                    <i class="far fa-star"></i>
                  {{/if}}
                {{/each}}
                </div>
            </div>
            <div class="inline-panel-rating-wrap d-flex">
                <div class="inline-panel-rating-title">????????????</div>
                <div class="inline-panel-rating-inner">
                {{#each stararr.b_star_expost}}
                  {{#if (isEqual this "1") }}
                    <i class="fas fa-star"></i>
                  {{else if ( isEqual this "0.5") }}
                    <i class="fas fa-star-half-alt"></i>
                  {{else}}
                    <i class="far fa-star"></i>
                  {{/if}}
                {{/each}}
                </div>
            </div>
            <div class="inline-panel-rating-wrap d-flex">
                <div class="inline-panel-rating-title">?????????</div>
                <div class="inline-panel-rating-inner">
                {{#each stararr.b_star_pave}}
                  {{#if (isEqual this "1") }}
                    <i class="fas fa-star"></i>
                  {{else if ( isEqual this "0.5") }}
                    <i class="fas fa-star-half-alt"></i>
                  {{else}}
                    <i class="far fa-star"></i>
                  {{/if}}
                {{/each}}
                </div>
            </div>
        </div>
    </div>
    <!--??????????????? - ??????????????? d-flex ????????? ?????? ??? -->

    <ul>
        <!-- ???????????? ????????? 3??? ????????? ?????? -->
        <li class="evaluate entire"><p>{{nl2br b_note}}</p>
        </li>

        <!-- ????????????8 : ??????????????? ?????? ?????? ???????????? ???????????? ????????? ????????? ???????????????. -->
        <li><span class="evaluate_more" onClick="reviewboxopenv2(this)">???????????? ????????????</span></li>
        <li><span class="entire_more" onClick="reviewboxopenv2(this)">???????????? ????????????</span></li>
    </ul>
    <!-- ????????????9 : ?????? ????????? 4??? ?????? ????????? ?????? - ??????????????? 4??? ?????? -->
    <div class="review_img">
        <div class="d-flex">
          {{#each files}}
            <div class="four_img pic01" style="background-image:url(/v2/storage{{url}})"><a href="/v2/storage{{url}}" data-lightbox="image-r-{{review_id}}"
             data-title="{{../b_mdate}} [{{#if ( isEqual ../b_type '??????')}}????????????{{else }}{{b_type}}{{/if}}]" style="display:block;height:100%;"></a></div>
          {{/each}}
        </div>
    </div>
  </div>
  {{/each}}
{{else}}
<!--div class="none-review">????????? ????????? ????????????.</div-->
{{/if}}
`
let regfilesTempate=`
{{#each regfiles}}
<li class="imgC">
  <span>
    <a href="http://24auction.co.kr{{path}}/{{file_name_real}}" data-lightbox="imageView1" data-title="??????????????????">
    {{@key}}
    </a>
  </span>
</li>
{{/each}}
`
