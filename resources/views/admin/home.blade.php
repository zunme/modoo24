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

<script>
  let pushertemplate = `
  <label class="custom-switch">
    <input type="radio" name="option" value="1"
        class="custom-switch-input"
        checked=""
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
      success:function(result){
      }
    });
  }
</script>


@endsection
