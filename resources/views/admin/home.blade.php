@extends('admin.layouts.app')

@section('content')
<style>
.justify-space-between{
  justify-content: space-between;
}

</style>
<div class="container">

  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card">
        <div class="card-wrap">
          <div class="card-header justify-space-between">
            <h4>Push알림</h4>

            <div class="form-group" style="margin-bottom: 0;">
              <div class="custom-switches-stacked" id="pusherStatus">
                PUSH 불가능
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>

</div>

@endsection

@section('script')
@verbatim
<script>
  let pushertemplate = `
  <label class="custom-switch">
    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
      data-id ="{{statusdata.id}}"
      onChange="changeFcmPushStatus(this)"
    {{#if statusdata.is_use }}
    checked=""
    {{/if}}
    >
    <span class="custom-switch-indicator"></span>
  </label>
  `
	$(document).ready( function () {
    //$('#datatable').DataTable();
    //getnoticeservice()

	});
  function tokenStatusView() {
    $.ajax({
      url : '/community/rhksfl/push/status',
      method:"get",
      dataType:'JSON',
      data:{token:fcmToken},
      success:function(result){
         var template = Handlebars.compile( pushertemplate );
         $("#pusherStatus").html (template(result.data) )
      }
    });
  }
  let chkg
  function changeFcmPushStatus(chk){
    let is_use = $(chk).prop('checked') ? 'Y' : 'N'
    let data = {id: $(chk).data('id'), is_use : is_use}
    console.log ( data );
    getpost( '/community/rhksfl/push/status', data, console.log )
  }
</script>
@endverbatim

@endsection
