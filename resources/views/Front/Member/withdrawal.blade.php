@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/NEW/css/community.css" />
@endsection

@section('body_bottom','')

@section('content')
<div class="contents_wrap">


    <!--common_visual-->
    <div class="visual_mymodoo">
        <h1>모두이사 회원</h1>
        <!--<h4>모두이사 회원정보 페이지입니다.</h4>-->
    </div>    
   <!--//common_visual-->

   
    <div class="sub_menu_N">
      <ul>
          <li class="h_icon" onclick="window.open('/v2/')">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                  <path fill="none" d="M0 0h24v24H0z"></path>
                  <path d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19z" fill="rgba(255,255,255,1)"></path>
              </svg>
          </li>
          <li class=""><a href="modify">회원정보수정</a></li>
          <li class=" on "><a href="myinfo">나의정보</a></li>
          <!-- <li class=""><a href="hometown">우리동네자랑하기</a></li>-->
      </ul>
    </div>

    <input name="cmd" type="hidden" value="write_proc" />
    <form class="form-horizontal" method="POST" id="withdrawalform">
        <div class="center">

            <div id="knows_form">

                <h2 class="cop_title" style="margin-bottom: 5px;">모두이사 회원탈퇴</h2>

                <h4 class="cop_title_s" style="margin-top: 0px;">고객님의 소중한 의견을 통해 서비스 향상에 노력하겠습니다.</h4>

                <div class="withdraw_notice">
                    <div>회원 탈퇴 신청에 앞서 아래 내용을 반드시 확인해주세요.</div>
                    <div class="board_notice">회원탈퇴시 게시물 삭제를 원하시는 경우에는 먼저 해당 게시물을 삭제 하신 후, 탈퇴를 신청하시기 바랍니다. </div>
                    <div>
                        <div>
                            <h3>회원탈퇴 시 개인정보 삭제 내용</h3>
                            <ul>
                                <li>● 모두이사 회원가입시 작성한 이름,닉네임,휴대폰번호, 이메일 등의 모든 정보가 삭제됩니다.</li>
                                <li>● 모두이사 혜택·쿠폰은 소멸되며 환불되지 않습니다.</li>
                                <li>● 단 소비자보호에 관한 법률 제6조에 의거,계약 또는 청약철회 등에 관한 기록은 5년, 대금결제 및 재화등의 공급에 관한 기록은 5년, 소비자의 불만 또는 분쟁처리에 관한 기록은 3년 동안 보관됩니다.</li>
                            </ul>
                            <h3>회원탈퇴 시 게시물 관리</h3>
                            <p>회원탈퇴 후 모두이사 서비스에 입력한 게시물 및 댓글은 삭제되지 않으며, 회원정보 삭제로 인해 작성자 본인을 확인할 수 없으므로 게시물 편집 및 삭제 처리가 원천적으로 불가능 합니다. 게시물 삭제를 원하시는 경우에는 먼저 해당 게시물을 삭제 하신 후, 탈퇴를 신청하시기 바랍니다.</p>
                            <h3>회원탈퇴 후 재가입 규정</h3>
                            <p>회원 탈퇴 후 30일 동안 회원 재가입을 할 수 없습니다.</p>
                            <p>탈퇴 회원이 재가입하더라도 기존의 모두이사 혜택은 이미 소멸되었기 때문에 양도되지 않습니다.</p>
                        </div>
                       <div class="agree_check">
                           <div class="checks etrans">
                               <input type="checkbox" id="ex_chk0" name="withdrawalcheck" value="Y">
                               <label for="ex_chk0"></label>
                                 위 내용을 위 내용을 모두 확인하였습니다.<span class="essential"> 필수 </span>
                           </div>
                       </div>
                       </div>
                </div>

                <div class="tbBox" style="margin-top: 10px;">
                    <table class="rwd_table">
                        <tbody>
                            <tr>
                                <th class="form_title"><span class="red_cic"></span>닉네임</th>
                                <td data-th="닉네임" colspan="3">
                                    <div class="ip_Box">
                                        <span>{{$user->nickname}}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="form_title"><span class="red_cic"></span>이메일</th>
                                <td data-th="이메일" colspan="3">
                                    <div class="ip_Box">
                                        <span>{{$user->email}}</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th class="form_title"><span class="red_cic"></span>탈퇴사유 <span class="essential">*필수항목</span></th>
                                <td data-th="탈퇴사유 * 필수항목 " colspan="3">
                                    <input type="text" class="form-control modify-input" placeholder="" name="reason" value="" id="reasontext">

                                    <!-- 탈퇴사유를 기재하지 않았을 경우 -->
                                    <!--p class="modify_alert">탈퇴사유를 남겨 주세요.</p-->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="quit_notice">
                        <i class="fas fa-quote-left"></i>
                        회원 탈퇴 시 재가입을 할 수 없으며 지식인과 커뮤니티에 사용이
                        제한됩니다. 이벤트에도 참여 하실 수 없습니다.
                        <i class="fas fa-quote-right"></i>
                        <br>
                        <i class="fas fa-quote-left"></i>
                        회원 탈퇴 후 30일 동안 회원 재가입을 할 수 없습니다.
                        <i class="fas fa-quote-right"></i>
                    </div>
                </div>
                <ul class="btn_3set" style="margin-bottom:60px;">
                    <li><button class="btn button_blue button_gray" type="button" onclick="write_cancel()">취소<div class="ripple-container"></div></button></li>
                    <li><button class="btn button_blue" type="button" onclick="withdrawal()">회원탈퇴</button></li>
                </ul>

            </div>

        </div>
    </form>


</div>

<script id="withdrawalpop_template" type="text/template">
  <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: grid;"><button type="button" class="swal2-close" aria-label="Close this dialog" style="display: none;">×</button>
    <ul class="swal2-progress-steps" style="display: none;"></ul>
    <div class="swal2-icon" style="display: none;"></div><img class="swal2-image" style="display: none;">
    <h2 class="swal2-title" id="swal2-title" style="display: block;">정말로 회원탈퇴 하시겠습니까?</h2>
    <div class="swal2-html-container" id="swal2-html-container" style="display: block;">회원탈퇴 후 30이내에 회원 재가입을 할 수 없습니다.</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;">
    <div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select>
    <div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea class="swal2-textarea" style="display: none;"></textarea>
    <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
    <div class="swal2-actions" style="display: flex;">
        <div class="swal2-loader"></div>
        <button type="button" class="swal2-confirm btn-warning swal2-styled" data-dismiss="modal" aria-label="Close">
						취소
				</button>
        <button type="button" class="swal2-confirm new-confirm-col btn-danger swal2-styled" aria-label="" style="display: inline-block;" onClick="withdrawalprc()">확인</button><button type="button" class="swal2-deny swal2-styled" aria-label="" style="display: none;">No</button><button type="button" class="swal2-cancel swal2-styled" aria-label="" style="display: none;">아니오</button>
    </div>
    <div class="swal2-footer" style="display: none;"></div>
    <div class="swal2-timer-progress-bar-container">
        <div class="swal2-timer-progress-bar" style="display: none;"></div>
    </div>
</div>
</script>
@endsection

@section('script')
<style>
.new-confirm-col{
  background-color: #e91e63 !important;
}
</style>
<script>
// $("#defaultModal").modal("hide")
function withdrawal() {
      if( $("#ex_chk0:checked").val() !='Y') {
      iziToast.show({
          theme: 'light',
          message: '회원 탈퇴에 대한 내용을 읽으신후 확인해주세요',
          position: 'center'
      });
      return;
    }
    if( $("#reasontext").val() =='') {
      iziToast.show({
          theme: 'light',
          message: '회원 탈퇴 사유를 적어주세요',
          position: 'center'
      });
      return;
    }
    pop_tpl( 'md', 'withdrawalpop_template' , {}, '' )
}
function withdrawalprc() {
      getpost( '/community/member/withdrawal',$("#withdrawalform").serialize() , withdrawalok ,withdrawalCompleted,withdrawalError)
}
function withdrawalError(err){
  $("#defaultModal").modal("hide");
  ajaxErrorST(err)
}
function withdrawalCompleted (){
  $("#defaultModal").modal("hide");
}
function withdrawalok(res){
  swal.fire("회원탈퇴", "회원탈퇴가 완료 되었습니다<br>메인페이지로 이동합니다.", "success")
  .then((result) => {
    location.replace("/v1/index")
  });
}
</script>
@endsection
