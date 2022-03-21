@extends('admin.layouts.app')

@section('content')
<style>
.justify-space-between{
  justify-content: space-between;
}
.word-break{
  word-break: break-all;
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


  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-wrap">
          <div class="card-header">
            <h4>비대면 유입(어제부터)</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tbody><tr>
                  <th>Mobile</th>
                  <th>유입</th>
                  <th>유입처</th>
                  <th>완료시간</th>
                </tr>
                @foreach( $nface as $row)
                <tr>
                  <td>{{$row->isMobile}}</td>
                  <td>{{$row->referer}}</td>
                  <td>{{$row->referer_domain}}</td>
                  <td>{{$row->created_at}}</td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-wrap">
          <div class="card-header">
            <h4> 홈페이지 유입(어제부터)</h4>
          </div>
          <div class="card-body">
            <div class="">
              <table class="table table-bordered table-md">
                <tbody><tr>
                  <th>횟수</th>
                  <th>유입</th>
                  <th>유입처</th>
                </tr>
                @foreach( $logs as $row)
                <tr>
                  <td>{{$row->cnt}}</td>
                  <td class="word-break">{{$row->referer}}</td>
                  <td>{{$row->referer_domain}}</td>
                </tr>
                @endforeach
              </tbody></table>
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
