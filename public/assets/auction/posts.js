Handlebars.registerHelper('nl2br', function(text) {
  text = Handlebars.Utils.escapeExpression(text);
  text = text.replace(/(\r\n|\n|\r)/gm, '<br>');
  return new Handlebars.SafeString(text);
});
Handlebars.registerHelper('encodeMyString',function(inputData){
    return new Handlebars.SafeString(inputData);
});
Handlebars.registerHelper('isEqual', function (expectedValue, value) {
  return value === expectedValue;
});
Handlebars.registerHelper('isNotEqual', function (expectedValue, value) {
  return value !== expectedValue;
});
Handlebars.registerHelper('checkempty', function(value) {
    if ( typeof value == 'undefined') return true;
    if ( typeof value == 'object'  ) {
      if( value.length == 0 ) return true;
      else return false
    }
    if ( typeof value == 'string') value = value.trim();
    if (value === null) return true;
    else if (value === '') return true;
    else return false;
});
Handlebars.registerHelper('checknotempty', function(value) {
    if ( typeof value == 'undefined') return false;
    if ( typeof value == 'object'  ) {
      if( value.length == 0 ) return false;
      else return true
    }
    if ( typeof value == 'string') value = value.trim();
    if (value === null) return false;
    else if (value === '') return false;
    else return true;
});
Handlebars.registerHelper('gt', function(a, b) {
  return (a > b);
});
Handlebars.registerHelper('gte', function(a, b) {
  return (a >= b);
});
Handlebars.registerHelper('lt', function(a, b) {
  return (a < b);
});
Handlebars.registerHelper('lte', function(a, b) {
  return (a <= b);
});
Handlebars.registerHelper('ne', function(a, b) {
  return (a !== b);
});
var lang_kor = {
  "decimal" : "",
  "emptyTable" : "데이터가 없습니다.",
  "info" : "_START_ - _END_ (총 _TOTAL_ 개)",
  "infoEmpty" : "0 개",
  "infoFiltered" : "(전체 _MAX_ 명 중 검색결과)",
  "infoPostFix" : "",
  "thousands" : ",",
  "lengthMenu" : "_MENU_ 개씩 보기",
  "loadingRecords" : "로딩중...",
  "processing" : "WAIT...",
  "search" : "",
  "zeroRecords" : "검색된 데이터가 없습니다.",
  "paginate" : {
      "first" : "첫 페이지",
      "last" : "마지막 페이지",
      "next" : "다음",
      "previous" : "이전"
    },
  "aria" : {
      "sortAscending" : " :  오름차순 정렬",
      "sortDescending" : " :  내림차순 정렬"
    }
};
let choco_instance;
function pop_tpl( size, id , data, title ){
    if ( typeof id =='undefined') return false;
    var availsize = ['sm', 'lg', 'xl']
    if ( !availsize.includes(size) ) size='default';
    var template = Handlebars.compile( id );
    $("#modal_"+size+"_body" ).html ( template(data) );
    $( "#"+size+"Modal" ).modal('handleUpdate')
    $( "#"+size+"Modal" ).modal('show')
    if($(".datetimepicker").length) {
      $('.datetimepicker').daterangepicker({
          locale: {format: 'YYYY-MM-DD HH:mm'},
          singleDatePicker: true,
          timePicker: true,
          timePicker24Hour: true,
        });
    }

    choco_instance = new SimpleLightbox('.media-files span', {
      //overlay : false,
    });
    /*
    console.log (choco_instance )

    choco_instance = $('.media-files').Chocolat({
      fullScreen: true,
      enableZoom:true,
      zoomedPaddingX: function (canvasWidth, imgWidth) {
        return canvasWidth / 2
      },
      zoomedPaddingY: function (canvasHeight, imgHeight) {
        return canvasHeight / 2
      }
    }).data('chocolat');
    */
}
$('.modal').on('hidden.bs.modal', function (e) {

  choco_instance.destroy();

})

function ajaxErrorST(jqXHR ){
$('.loading_wrap').hide();
if(jqXHR.status != 422 && jqXHR.status != 500 ) {
  iziToast.show({
      theme: 'dark',
      message: '잠시후에 이용해주세요',
      position: 'bottomCenter'
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
          position: 'center'
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
        position: 'bottomCenter',
        timeout: 1000,
    });
  }
}
function loaderAttach(target,on) {
if( on == false ){
  $(target).children(".loaderWrap").slideUp(500).remove()
  return;
}
let loader = `<div class="loaderWrap loading hide"><div class="loaderWrapInner">
<svg class="loadersvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<rect x="17.5" y="30" width="15" height="40" fill="#1d3f72">
<animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
<animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
</rect>
<rect x="42.5" y="30" width="15" height="40" fill="#5699d2">
<animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
<animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
</rect>
<rect x="67.5" y="30" width="15" height="40" fill="#d8ebf9">
<animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
<animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
</rect>
</svg>
</div></div>
`
$(target).append(loader);
}

$("document").ready( function() {
  $("header").prepend('<a class="arrow_L" onClick="history.back()"><img src="/m/image/arrow_L.png" alt="<"></a><p class="title">이사지식인</p>')
  compiledTemplate = Handlebars.compile( posttemplate );
  $('#lgModal').on('shown.bs.modal', function (e) {
    loaderAttach( $(".media"), true)
  })
})

let view_post_id
function  getContent(btn){
  data =  datatable.row($(btn).closest('tr')).data();
  view_post_id = data.id
  getContentAjax(data.id)
}

function  getContentAjax(id){
  $.ajax({
    url : '/community/posts/jisik/view/'+ id,
    method:'get',
    dataType:'JSON',
    data : {id:id} ,
    success:function(res){
      pop_tpl( 'lg', posttemplate , res.data, '' )
      //loaderAttach( $(".media"), true)
      //var html = compiledTemplate(res.data)
    },
    error: function ( err ){
     ajaxErrorST(err)
    },
    complete:function() {
      if ( typeof callbackCompltet != 'undefined') callbackCompltet();
    }
  });
}
function addbest(btn) {
  let url = "/community/posts/comment/addbestcntV2"
  let id = $(btn).data('commentid');
  let loading = $(btn).closest('.media').children('.loaderWrap')
  let notloading
  $(loading).removeClass('hide')
  addcnt(id, url ,notloading, loading,btn )
}
let testbtn
function addcnt(id, url ,notloading, loading,btn ){
testbtn = btn

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
          data:{id : id},
          dataType:'JSON',
          success:function(res)
          {

            if( res.status =='Success'){

              iziToast.success({
                message: res.message,
                position: 'bottomRight'
              });
              $(btn).children('.best-cnt').text( res.data.cnt )
              return;

            } else {
              iziToast.error({
                message: res.message,
                position: 'bottomRight'
              });
            }
          },
          error: function ( err ){
            ajaxErrorST(err)
          },
          complete : function() {
            comment_write_prc = true;
            setTimeout(()=>restoreLoading(notloading, loading ), 100)
          }
        });

    }, // end success
    complete : function() {
      comment_write_prc = true;
      setTimeout(()=>restoreLoading(notloading, loading ), 100)
    }
  });

}
function restoreLoading(notloading, loading ){
  $(loading).addClass("hide");
  $(notloading).removeClass("hide");
}
let comment_write_prc = true;
function jisikCommentPrc(btn){
  if( !comment_write_prc) {
    iziToast.error({
      message: "서버와 통신 중입니다.",
      position: 'topRight'
    });
    return;
  }
  else {
    $(btn).removeClass("btn-primary");
    comment_write_prc = false;
  }

  let data = $("jisik_comment_form").serialize();
  let form = 'jisik_comment_form'
  var url = '/community/posts/comment/create'

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
                  data:new FormData( document.getElementById(form) ),
                  dataType:'JSON',
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(res)
                  {

                    if( res.status =='Success'){

                      iziToast.success({
                        message: "답변을 달았습니다.",
                        position: 'center'
                      });
                      getContentAjax(view_post_id)
                      datatable.ajax.reload( null, false )
                      return;

                    } else {
                      iziToast.error({
                        message: "잠시후에 이용해주세요",
                        position: 'bottomRight'
                      });
                    }
                  },
                  error: function ( err ){
                    ajaxErrorST(err)
                  },
                  complete : function() {
                    comment_write_prc = true;
                    $(btn).addClass("btn-primary");
                  }
                });

            }, // end success
            complete : function() {
              comment_write_prc = true;
              $(btn).addClass("btn-primary");
            }
          });
}


let compiledTemplate
let posttemplate = `
<div class="modal-header">
  <h5 class="modal-title">{{post.title}}</h5>
  <button type="button" class="modal-close-btn" data-dismiss="modal" aria-label="Close">
    <i class="fas fa-times-circle"></i>
  </button>
  <div class="modal-sub-title">
    <div class="bd-nickname">{{post.nickname}}</div>
    <div class="bd-date">{{post.created_at}}</div>
  </div>
</div>
<div class="modal-body">
  <div class="content-body">
      {{post.body }}
  </div>

  <div class="media-body">
    <div class="media-files" style="display:flex">
      {{#each post.files}}
          <!--div class="image-col item">
            <a href="/community/storage/{{url}}" data-lightbox="photos">
              <div class="image-col-bg" style="background: url(/community/storage/thumb{{url}}) no-repeat center center ;" >
              </div>
            </a>
          </div-->
          <span href="/community/storage/{{url}}" class="chocolat-image" >
            <div class="image-col-bg" style="background: url(/community/storage/thumb{{url}}) no-repeat center center ;" >
            </div>
          </span>
      {{/each}}
    </div>
  </div>
  <div class="write_comment">
    <form id="jisik_comment_form">
      <input type="hidden"name="post_id" value="{{post.id}}">
      <input type="hidden"name="code" value="jisik">
      <textarea name="body" rows=5></textarea>
      <div class="write_comment_btn_wrap">
        <span class="btn btn-sm btn-primary" onClick="jisikCommentPrc(this)">답글달기</span>
      </div>
    </form>
  </div>
  <div class="comment-wrap">
    <div class=""><i class="fas fa-comments"></i> 답변</div>
{{#if ( checkempty post.simplecomments ) }}
  답글이 없습니다.
{{/if}}
{{#if ( checknotempty post.simplecomments ) }}
    {{#each post.simplecomments}}
      <div class="media">
        <div class="media-staff">
          <span class="staff-company">{{s_company}}</span>
          <span class="comment-date">{{created_at}}</span>
        </div>
        <div class="media-content">
          <div class="media-content-body">
            {{#if ( isEqual is_confirmed 'R') }}
            <span class="confirm_waiting">이사지식인 답글은 고객과의 분쟁 방지를 위해 이사지식인 규정 확인 후 노출됩니다.</span>
            {{/if}}

            {{#if ( isEqual is_confirmed 'Y') }}
              {{body}}
            {{/if}}
          </div>
          <div class="media-content-date">
            {{created_at}}
          </div>
        </div>
        <div class="media-best">
          <div class="best-wrap">
            <span class="best-line-date">{{created_at}}</span>
{{#if ( isEqual is_confirmed 'Y') }}
            <div class="best-inner"
            onClick="addbest(this)"
            data-commentid = "{{id}}"
            >
              <span class="best-icon"><i class="fas fa-heart"></i></span>
              <span class="best-cnt">{{best_cnt}}</span>
            </div>
{{/if}}
          </div>
        </div>
      </div>
    {{/each}}
{{/if}}
  </div>
</div>
`
