@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/NEW/css/community.css" />
@endsection

@section('body_bottom','')

@section('content')
<div class="contents_wrap">

  <div class="visual_mymodoo">
      <h1>모두이사 회원</h1>
      <h4>모두이사 회원정보 페이지입니다.</h4>
  </div>

  <div class="sub_menu">
    <ul class="center">
        <li class="h_icon gotohome"></li>
        <li class="on">회원정보수정</li>
        <li class="">나의정보</li>
    </ul>
  </div>

  <div class="center">
      <div id="knows_form">

        <h2 class="cop_title" style="margin-bottom: 5px;">모두이사 회원정보수정</h2>
        <form class="form-horizontal" id="name_modify_form">
          <h4 class="cop_title_s" style="margin-top: 0px;">이메일을 변경하실려면 운영자에게 이메일을 보내주세요</h4>
          <div class="tbBox" style="margin-top: 10px;">
              <table class="rwd_table">
                  <tbody>
                      <tr>
                          <th class="form_title"><span class="red_cic"></span>이메일 <span class="essential">*필수항목</span></th>
                          <td data-th="이메일 * 필수항목 " colspan="3">
                              <div class="ip_Box">
                                 <span>{{$user->email}}</span>
                              </div>
                          </td>
                      </tr>

                      <tr>
                          <th class="form_title"><span class="red_cic"></span>닉네임 <span class="essential">*필수항목</span></th>
                          <td data-th="닉네임 * 필수항목 " colspan="3">
                              <input type="text" class="form-control modify-input" placeholder="" name="nickname" value="{{$user->nickname}}">
                          </td>

                      </tr>
                      <tr>
                          <th class="form_title"><span class="red_cic"></span>이 름 <span class="essential">*선택항목</span></th>
                          <td data-th="이 름 * 선택항목 " colspan="3">
                              <input type="text" class="form-control modify-input" placeholder="이름을 입력해 주세요" name="name" value="{{$user->name}}">

                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
          <ul class="modibtn_set">
              <li><button class="btn button_blue" type="button" onclick="modify_prc()">필수항목 회원정보수정<div class="ripple-container"></div></button></li>
          </ul>
        </form>


        <form class="form-horizontal" method="POST" action="">
          <h4 class="cop_title_s" style="margin-top: 0px;">모두이사 문자 알림이 필요하시거나 기존 휴대폰 번호 변경시 입력해 주세요</h4>
          <div class="tbBox" style="margin-top: 10px;">
              <table class="rwd_table">
                  <tbody>

                  </tbody>
              </table>
          </div>

          <h4 class="cop_title_s" style="margin-top: 0px;">휴대폰 번호 입력시 본인인증을 해주세요 <span class="essential">*선택항목</span></h4>
          <div class="tbBox" style="margin-top: 10px;">
              <table class="rwd_table">
                  <tbody>
                      <tr class="checktr">
                          <th class="form_title"><span class="red_cic"></span>휴대폰번호</th>
                          <td data-th="휴대폰번호" colspan="3">
                              <input type="number" id="newtel" class="form-control certify_input" placeholder="" name="tel" value="" minlength="3" maxlength="4" size="12">
                              <!-- -
                              input type="number" class="form-control phone-input" placeholder="" name="hp2" value="" minlength="4" maxlength="5" size="5"> -
                              <input type="number" class="form-control phone-input" placeholder="" name="hp2" value="" minlength="4" maxlength="5" size="5"-->
                              <button type="button" class="btn btn_certify" onclick="sms();">인증번호 받기</button>
                          </td>
                      </tr>
                      <tr class="checktr">
                          <th class="form_title"><span class="red_cic"></span>인증번호 확인</th>
                          <td data-th="인증번호 확인" colspan="3">
                              <input type="number" class="form-control certify_input" placeholder="인증번호를 입력해 주세요" id="sms_confirm" name="sms_confirm" value="">
                              <button type="button" class="btn btn_certify" onclick="sms_confirm_ok();">인증번호 확인</button>
                          </td>
                      </tr>
                      <tr>
                          <th class="form_title"><span class="red_cic"></span>입력된 휴대폰번호</th>
                          <td data-th="입력된 휴대폰번호" colspan="3">
                              <input type="text" class="form-control modify-input" id="changedPhone" placeholder="" value="{{$user->phone}}">
                              <!-- 휴대폰번호 본인인증시 본인인증된 휴대폰 번호가 input 타입에 출력되고 아래의 멘트 출력 -->
                              <!--
                                <p class="register_alert">본인 인증된 휴대번호가 입력 되었습니다.</p>
                              -->
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
          <ul class="modibtn_set">
              <li>
                <button class="btn button_blue" type="button" onclick="modify_tel_prc()">선택항목 회원정보수정<div class="ripple-container"></div></button>
              </li>
          </ul>
        </form>
      </div>
  </div>
</div>
@endsection

@section('script')
<script>
function modify_prc() {
  getpost( '/community/member/modify',$("#name_modify_form").serialize() , modify_ok )
}
function modify_ok(res){
  swal.fire("회원정보변경", "회원정보를 변경하였습니다", "success");
}
function callbackModifyCompleted() {
}

function sms() {
  getpost( '/community/member/sendsms',{tel:$('#newtel').val() } , smssended )
}
function smssended(res) {
  $('#newtel').prop('readonly',true)
  swal.fire("인증번호발송", "입력하신 휴대폰 번호로 인증번호가 발송되었습니다.<br>SMS로 받으신 인증번호를 입력하시기 바랍니다", "success");
}
function sms_confirm_ok() {
  getpost( '/community/member/modify/tel',{authno:$('#sms_confirm').val() } , sms_confirm_complete )
}
function sms_confirm_complete(res) {
  $("#changedPhone").val( res.data.phone).prop('readonly',true)
  $(".checktr").remove()
  swal.fire("휴대폰번호변경", "입력하신 휴대폰 번호로 변경되었습니다.", "success");
}
</script>
@endsection
