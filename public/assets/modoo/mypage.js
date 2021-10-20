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
  if ( typeof value == 'string') value = value.trim();
  if (value === null) return true;
  else if (value === '') return true;
  else return false;
});
Handlebars.registerHelper('checknotempty', function(value) {
  if ( typeof value == 'undefined') return false;
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

let companyimg = `

<div class="imgprevcol {{#if (checkempty src) }} hide {{/if}} " id="upfile_col">
  <div class="imgprevbox-comp display-flex img-raised">
    <i class="remove_file_btn now-ui-icons ui-1_simple-remove" data-num="1" onclick="removeCompFile(this)"></i>
    <div class="thumbnail-comp ">
      <img src="{{#if (checknotempty src) }}/data/{{src}}{{/if}}" alt="..." id="upfile_preview">
    </div>
    <div class="thumbnail-comp-desc">
      {{#if (checkempty src) }}
      <div class="thumbnail-byte" id="upfile_byte">196.93 KB</div>
      <input type="file" name="upload_img0[]" class="hide" id="upfile_imp" onChange="readURL(this, 'upfile')" accept="image/*" />
      {{/if}}
      <div class="thumbnail-title ellipsis" id="upfile_filename">{{#if (checknotempty src) }}/data/{{src}}{{/if}}</div>
    </div>
  </div>
</div>
  `

$("document").ready(function() {
  if( companyimage !='' ){
    totalCompImgCnt = 1
    var template = Handlebars.compile( companyimg );
    let data={'src':companyimage}
    $("#companyimgprevarea").append( template(data) );
  }
})
  var totalImgCnt = 0;
  var inpCnt = 0;

  var totalCompImgCnt = 0;

  function addCompImage() {
    if( $("#upfile_imp").length == 1 && $("#upfile_imp").val() == '' ){
      $("#upfile_col").remove();
      totalCompImgCnt = 0;
    }
  	if ( totalCompImgCnt >= 1 ){
      alert("기존 파일을 지우신 후 업로드해주세요")
  		return
  	}
    ++totalCompImgCnt;
    var template = Handlebars.compile( companyimg );
    let data={}
    $("#companyimgprevarea").append( template(data) );
  	$("#upfile_imp").trigger('click')
  }
  function readURL(input, id) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var filename = $(input).val();
      filename = filename.substring(filename.lastIndexOf('\\')+1);
      reader.onload = function(e) {
        if(e.total >  1024*1024*10 ) {
          $('#'+id+'_col').remove();
          alert('10MB이상의 파일은 올리실수없습니다.')
          return;
          //硫붽� 1048576
        }
        var bytes = formatBytes( e.total);

        $('#'+id+'_preview').attr('src', e.target.result);

        $('#'+id+'_preview').hide();
        $('#'+id+'_preview').parent().removeClass('hide');

        $('#'+id+'_preview').fadeIn(500);
        $('#'+id+'_preview').show();
        $('#'+id+'_byte').text(bytes)
        $('#'+id+'_filename').text(filename)
        $('#'+id+'_col').removeClass('hide');
        totalImgCnt++;
      }
      reader.readAsDataURL(input.files[0]);
    }
    //$(".alert").removeClass("loading").hide();
  }
  function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
  function removeFile(btn){
    var row = $(btn).closest('.imgprevcol');
    $(row).fadeOut(500, function (){
      $(row).remove();
      totalImgCnt--;
    });
  }
  function removeCompFile(btn){
    var row = $(btn).closest('.imgprevcol');
    $(row).fadeOut(500, function (){
      $(row).remove();
      totalCompImgCnt--;
    });
  }

let workimg = `
<div class="imgprevcol {{#if (checkempty src) }} hide {{/if}} " id="upfile_col">
    <div class="imgprevbox img-raised">


      <i class="remove_file_btn now-ui-icons ui-1_simple-remove" data-num="1" onClick="removeCompFile(this)"></i>


      <div class="thumbnail ">
        <img src="{{#if (checknotempty src) }} /data/{{src}} {{/if}}" alt="..."  id="upfile_preview">
      </div>
      {{#if (checkempty src) }}
      <div class="thumbnail-byte" id="upfile_byte">
        byte
      </div>
      <div class="thumbnail-title ellipsis" id="upfile_filename">
        name
      </div>
      <input type="file" name="upload_img0[]" class="hide" id="upfile_imp" onChange="readURL(this, 'upfile')" accept="image/*" />
      {{/if}}
    </div>
  </div>
`
