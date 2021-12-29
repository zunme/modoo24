@extends('admin.layouts.app')

@section('css')
<style>
.justify-between{
  justify-content: space-between;
}
.item-title{
  margin-left: 20px;
  font-size: 16px;
  font-weight:600;
  margin-bottom: 10px;
}
.siteconfig-code:after{
  content: '▶';
  margin-left: 10px;
  margin-right: 10px;
}
.siteconfig-item .form-group{
  margin-bottom: 0 !important;
}
.col-desc{
  display: flex;
  justify-content: space-between;
}
.col-desc .form-group{
  flex-grow: 1;
}
.form-group + .btn {
      height: 42px;
}
.col-desc .btn{
    margin-left: 10px;
  padding-top: 0.5rem;
}
.siteconfig-item-head > .row > div {
  display: flex;
}
.siteconfig-item-head h6{
  padding-top: 0.8rem;
  padding-left: 22px;
}
.siteconfigs-card .card-footer{
  display: flex;
  justify-content: flex-end;
}
.siteconfigs-card .card-footer .btn{
  margin-right: 20px;
}
#top-5-scroll{
  overflow: auto;
}

#top-5-scroll::-webkit-scrollbar {
  width: 5px; /*스크롤바의 너비*/
}

#top-5-scroll::-webkit-scrollbar-thumb {
  background-color: black; /*스크롤바의 색상*/
}

#top-5-scroll::-webkit-scrollbar-track {
  background-color: yellow; /*스크롤바 트랙 색상*/
}
</style>
@endsection


@section('content')
<div class="main">
  <section class="section">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Config</h4>
            <div class="card-header-action">
              <span class="btn btn-icon btn-danger" onClick="addConfig()"><i class="fas fa-plus"></i></span>
            </div>
          </div>
          <div class="card-body">
            <div class="conflists">
              <ul class="list-unstyled list-unstyled-border">
                @foreach( $siteconfigs as $item)
                <li>
                  <div class="row item-title">
                    <div class="siteconfig-code">
                      {{$item->code}}
                    </div>
                    <div  class="siteconfig-desc">
                      {{$item->code_desc}}
                    </div>
                  </div>
                  <div class="">
                    <div class="item-wrapper">
                      @foreach ( $item->code_value as $vals)
                      <form id="form_{{$item->id}}">
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <input type="text" class="form-control" name='ind' value="{{$vals['id']}}" readonly>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <input type="text" class="form-control editable ctrlclick" name='val' data-id="{{$item->id}}" value="{{$vals['val']}}" readonly>
                            </div>
                          </div>
                          <div class="col-sm-6 col-desc">
                            <div class="form-group">
                              <input type="text" class="form-control editable" name='desc' value="{{$vals['desc']}}" readonly>
                            </div>
                            <span class="btn btn-icon btn-warning itembtn" style="display:none" onClick="saveitem(this)">
                              <i class="fas fa-check"></i>
                            </span>
                          </div>
                        </div>
                      </form>
                      @endforeach
                    </div>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

<style>

</style>
<!-- popup -->
<div id="addpopuptpl">


</div>
<!-- /popup -->

  </section>
</div>
@endsection


@section('script')

@verbatim
<script>
let configLastRow = 1;
let modaltemplate =`
<div class="row">
  <div class="col-sm-12">
    <div class="card siteconfigs-card">

      <div class="card-body">
        <form id="siteconfigsform">
          <input type="hidden" name="rownum">
          <div class="form-group">
            <label>Code</label>
            <input type="text" name="code" class="form-control">
          </div>
          <div class="form-group">
            <label>설명</label>
            <input type="text" name="code_desc" class="form-control">
          </div>
          <div class="siteconfigs-wrapper">
            <ul class="list-unstyled list-unstyled-border">
              <li class="siteconfig-item siteconfig-item-head" style="border-bottom: 1px solid #f9f9f9;
  padding-bottom: 15px;
  margin-bottom: 15px;">
                <div class="row">
                  <div class="col-sm-3">
                    <h6>index명</h6>
                  </div>
                  <div class="col-sm-3">
                    <h6>값</h6>
                  </div>
                  <div class="col-sm-6 col-desc">
                    <h6>설명</h6>
                    <span class="btn btn-icon btn-info" onClick="addRow()"><i class="fas fa-plus"></i></span>
                  </div>
                </div>
              </li>
            </ul>

            <div  class="card-body" id="top-5-scroll" tabindex="2" style="height: 315px; overflow: auto; outline: none;">
              <ul class="list-unstyled list-unstyled-border" id="siteconfigsList">
                <li class="siteconfig-item">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <input type="text" class="form-control" name="config_id_1">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <input type="text" class="form-control" name="config_val_1">
                      </div>
                    </div>
                    <div class="col-sm-6 col-desc">
                      <div class="form-group">
                        <input type="text" class="form-control" name="config_desc_1">
                      </div>

                    </div>
                  </div>
                </li>
              </ul>
            </div>

          </div>
        </form>
      </div>
      <div class="card-footer">
        <span class="btn btn-danger">취소</span>
        <span class="btn btn-primary" onClick="saveconfig()">저장</span>
      </div>

    </div>
  </div>
</div>
`
let configitemTemplate = `
<li class="siteconfig-item">
  <div class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <input type="text" class="form-control" name="config_id_{{lastrow}}">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <input type="text" class="form-control" name="config_val_{{lastrow}}">
      </div>
    </div>
    <div class="col-sm-6 col-desc">
      <div class="form-group">
        <input type="text" class="form-control" name="config_desc_{{lastrow}}">
      </div>
      <span class="btn btn-icon btn-warning" onClick="remRow(this)"><i class="fas fa-minus"></i></span>
    </div>
  </div>
</li>
`
var compliledTemplate
function addConfig(){
  $("#modal_xl_body").html( modaltemplate);
  $("#xlModal").modal('show');
}
function addRow() {
  ++configLastRow;
  var lastrow = configLastRow
  if( typeof compliledTemplate =='undefined') compliledTemplate = Handlebars.compile( configitemTemplate );
  var data = {lastrow : lastrow }
  $("#siteconfigsList").append(compliledTemplate(data) )
}
function remRow(btn){
  $(btn).closest('li').remove();
}
function saveconfig(){
  $("input[name=rownum]").val(configLastRow)
  var data = $("#siteconfigsform").serialize();
  getpost('/community/rhksfl/siteconfigs', data, reload )
}
function saveitem(btn){
  var data = $(btn).closest('form').serialize();
  getpost('/community/rhksfl/siteconfigs/item', data, resetrow )
}
$("document").ready( function() {
  $('.ctrlclick').click(function(event) {
      if (event.ctrlKey) {
        resetrow()
        var id = $(event.target).data('id')
        $("#form_"+id+" input[type=text].editable").prop('readonly', false)
        $("#form_"+id+" .btn.itembtn").show()
      }
  });
})
function resetrow() {
  $("input[type=text].editable").prop('readonly', true);
  $(".itembtn").hide();
}
function reload(res){
  location.reload();
}
</script>

@endverbatim
@endsection
