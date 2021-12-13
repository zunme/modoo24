@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/v1/css/community.css" />
@endsection

@section('body_bottom','')

@section('content')
<!--common_visual-->
<div class="visual3">
    <h1>신청내역</h1>
    <h4>My Page</h4>
</div><!--//common_visual-->
<!--div class="sub_menu">
    <ul class="center">
        <li class="h_icon" onclick="window.open('/v1/')"></li>
        <li class="on" >신청내역</li>
    </ul>
</div-->
<div class="center">
   <div id="mypage_wrap">
	<h1>내 이사/청소 <b>신청내역 확인</b> 해 보세요.</h1>
        <div>
            <form id="chk_form">
                <ul class="my_order_num">
                  <li>
                      <div class="myorder_Box" id="wrap_arrive_adr">
                          <input name="name" id="newname" type="text" maxlength="13" placeholder="이름을 입력해주세요">
                      </div>
                  </li>
                    <li>
                        <div class="myorder_Box" id="wrap_arrive_adr">
                            <input name="tel" id="newtel" type="number" maxlength="12" placeholder="핸드폰번호를 입력해주세요">
                            <label for="arrive_adr"></label>
                            <a href="javascript:sms();" class="btn_form">인증하기</a>
                        </div>
                    </li>
                    <li>
                        <div class="myorder_Box" id="wrap_arrive_adr">
                            <input name="chk_num" id="AuthNo" type="text" maxlength="13" placeholder="인증번호를 입력해주세요">
                            <!--label for="arrive_adr"></label>
                            <a href="javascript:sms_confirm();" class="btn_form">인증하기</a-->
                        </div>
                    </li>
                    <li>
                        <button class="button_blue" type="button" onclick="checkAuth();">확인</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function sms() {
  if( $("#newname").val().trim() =='' ){
    toast("이름을 입력해주세요")
    return;
  }
  getpost( '/community/my/sendsms',{tel:$('#newtel').val() } , smssended )
}
function smssended(res) {
  $('#newtel').prop('readonly',true)
  swal.fire("인증번호발송", "입력하신 휴대폰 번호로 인증번호가 발송되었습니다.<br>SMS로 받으신 인증번호를 입력하시기 바랍니다", "success");
}
function checkAuthold() {
  getpost( '/community/my/checkAuth',{tel:$('#newtel').val(), authno: $("#AuthNo").val() } , authsuccess )
}
function checkAuth() {
  if( $("#newname").val().trim() =='' ){
    toast("이름을 입력해주세요")
    return;
  }else if ( $("#AuthNo").val().trim() =='' ){
    toast("인증번호를 입력해주세요")
    return;
  }
  getpost( '/community/my/checkAuthWithName',{tel:$('#newtel').val(), authno: $("#AuthNo").val().trim(), name : $("#newname").val().trim()  } , authsuccess )
}
function authsuccess(res) {
  location.reload()
}

</script>
@endsection
