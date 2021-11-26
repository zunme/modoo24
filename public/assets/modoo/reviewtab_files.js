let filesLength = 0;
$('document').ready( function() {

  $.ajax({
    url : '/v2/api/review/files/'+ s_uid,
    method:'get',
    dataType:'JSON',
    success:function(res){
      var template = Handlebars.compile( imgTemplate );
      console.log ( res.data.files.length )
      if( res.data.files.length > 0 ){
        filesLength = ( res.data.files.length > 2 ) ? 3 : res.data.files.length;
        //$("#tab2 > ul.move_pic").empty();
        $("#tab2 > ul.move_pic").html(template(res.data))
      }
    },
    error: function ( err ){

    },
  });
})

let imgTemplate = `
{{#if files.length}}
  {{#each files}}
    <li class="mycp_pic imgD {{#if ( gte  @index 3 ) }} hidden {{/if}}">
    <!--img src="/v2/storage{{url}}"-->
      <a href="/v2/storage{{url}}" data-lightbox="photos" class="thumbnail2">
           <img data-src="holder.js/100%x180" alt="100%x180" src="/v2/storage{{url}}" data-holder-rendered="false" >
       </a>
    </li>
  {{/each}}
  {{#if ( gte  files.length 3 ) }}
  <li class="mycp_pic imgD imgM">
      <i class="fas fa-plus"></i>
      <span>더보기</span>
      <img src="http://24auction.co.kr//data/방3_20211029092826.jpg">
  </li>
  {{/if}}
{{else}}

{{/if}}
`
