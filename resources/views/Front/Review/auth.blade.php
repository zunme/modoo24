@extends('layouts.modoo')

@section('css')
<style>
.visual3{
  position: relative;
  background-image: url(https://images.unsplash.com/photo-1455390582262-044cdead277a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1073&q=80);
  background-size: cover;
  background-position-x: center;
  background-position-y: center;
  color:white;
}
.visual3:after {
    box-sizing: border-box;
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    content: "";
    background: rgba(0,190,255,.42);
    background: linear-gradient(
45deg,rgba(0,190,255,.42),rgba(44,140,208,.15));
    background: -webkit-linear-gradient(
135deg,rgb(0 190 255 / 42%),rgb(44 140 208 / 15%));
}
.visual3 >h1{
  position: absolute;
  z-index: 2;
  width: 100%;
  color: #dbf1fb;
}
.visual3 h4{
  color: wheat;
}
.st-sub-menu-wrap{
  width: 100%;
  margin: 0 auto;
  position: absolute;
  bottom: 0;
  z-index: 2;
  background-color: rgb(85 172 238 / 36%);
  padding: 6px 0;
  font-size: 16px;
}
.st-sub-menu-inner {
    width: 1200px;
    margin: 0 auto;
}
.st-sub-menu{
  width: 550px;
  margin-left: 330px;
  display: flex;
  padding: 0 24px 0 12px;
}
.st-sub-menu-item{margin-right: 24px;color: white;font-size: 15px;    line-height: 23px;}
.st-sub-menu-item  .fas{
  color: white;
}

.st-sub-menu-item > a.active{
  color: wheat !important;
  background-color: rgb(255 255 255 / 30%);
  padding: 6px 8px;
  border-radius: 5px;
}
@media only screen and (max-width: 630px){
  .st-sub-menu {
    padding-right:10px;
  }
  .st-sub-menu > .st-sub-menu-item:last-child{
    margin-right: 0;
  }
}
@media only screen and (max-width: 959px){
  .visual3 h1{
    padding-top: 30px;
  }
  .st-sub-menu-wrap{
    padding: 3px 0;
    width: 100%;
  }
  .st-sub-menu-inner {
    width: 100%;
  }
  .st-sub-menu {
    margin-left: 0;
    width: 100%;
    justify-content:flex-end;
  }
  .st-sub-menu-item{
    font-size: 13px;
  }
  .st-sub-menu-item > a.active {
    background-color: rgb(255 255 255);
    padding: 7px 8px;
    border-top-right-radius: 5px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    color: #666 !important;
  }
}

.myorder_Box {
    border-radius: 6px;
}
.myorder_Box .btn_form {
  height: inherit;
  bottom: -1px;
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px;
}
.myorder_Box .btn_form.btn-blue{ background-color:#00beff}
</style>
@endsection


@section('content')

<div class="visual4">
    <h1>후기&amp;평가</h1>
</div>

<div class="sub_menu_N">
        <ul class="center">
            <li class="h_icon" onclick="window.open('/v2/')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"/><path d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19z" fill="rgba(255,255,255,1)"/></svg>
            </li>
            <li onclick="location.href='/v2/review' ">이사후기</li>
            <li class="on">이사업체 평가하기</li>
        </ul>
    </div>

<div class="center">
   <div id="mypage_wrap">
	<h1>이사업체를 <b>평가</b>해 주세요</h1>
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
                            <input name="tel" id="newtel" type="text" maxlength="13" placeholder="핸드폰번호를 입력해주세요">
                            <label for="arrive_adr"></label>
                            <a href="javascript:sms();" class="btn_form">인증하기</a>
                        </div>
                    </li>
                    <li>
                        <div class="myorder_Box" id="wrap_arrive_adr">
                            <input name="chk_num" id="AuthNo" type="text" maxlength="10" placeholder="인증번호를 입력해주세요">
                            <label for="arrive_adr"></label>
                            <a href="javascript:checkAuth();" class="btn_form btn-blue">확인</a>
                            <!--label for="arrive_adr"></label>
                            <a href="javascript:sms_confirm();" class="btn_form">인증하기</a-->
                        </div>
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
  getpost( '/community/my/sendsms',{tel:$('#newtel').val() } , smssended )
}
function smssended(res) {
  $('#newtel').prop('readonly',true)
  swal.fire("인증번호발송", "입력하신 휴대폰 번호로 인증번호가 발송되었습니다.<br>SMS로 받으신 인증번호를 입력하시기 바랍니다", "success");
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
