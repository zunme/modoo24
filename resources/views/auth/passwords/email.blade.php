@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/v1/css/community.css" />

<style>
.loaderWrap {
  position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      background-color: #66666673;
      display: flex;
      justify-content: center;
      margin-top: 0 !important;
      margin-bottom: 0 !important;
      z-index: 100;
      border-radius: 10px;
}
.loaderWrap > .loaderWrapInner {
    margin: 0 !important;
    display: flex;
}
.loadersvg {
    width: 100px;
    height: 100px;
    margin: auto;
}
</style>
@endsection


@section('content')


    <!--common_visual-->
    <div class="visual_pass">
    <h1>비밀번호 재설정</h1>
    <!--<h4>이메일로 본인인증을 진행 합니다</h4>-->
</div>    <!--//common_visual-->

    <!-- content ST -->

    <div id="resetpass" class="container container-margin mb-4">
        <div class="row mt-lg-n12 mt-md-n12 mt-n12 justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-8 mx-auto">
                <div class="repass_title">
                    <h3 class="font-weight-bolder text-black">모두이사 회원 비밀번호 재설정</h3>
                    <!--<p class="mb-0 text-sm">비밀번호 재설정을 위해 본인인증 이메일로 주소가 발송합니다.</p>-->
                </div>
                <div class="card mt-8">
                    <div class="card-body py-4">
                        <form role="form">
                            <div class="input-group input-group-static mb-4">
                                <label>가입한 이메일 주소를 입력해주세요.</label>
                                <input id="email" type="email" class="form-control" name="email" value="" required>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn w-100 mb-4 resetbtn" onClick="resetpwd()">이메일로 인증받기</button>
                            </div>
                            <p>비밀번호 재설정을 위한 본인인증 이메일이 발송 되었습니다.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / content ST -->

</div>


        <div id="loader" class="loaderWrap loading hide"><div class="loaderWrapInner">
        <svg class="loadersvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <rect x="17.5" y="30" width="15" height="40" fill="#1d3f72">
          <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
          <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
        </rect>
        <rect x="42.5" y="30" width="15" height="40" fill="#5699d2">
          <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
          <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
        </rect>
        <rect x="67.5" y="30" width="15" height="40" fill="#d8ebf9">
          <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
          <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
        </rect>
        </svg>
        </div></div>

@endsection

@section('script')
<script>
function resetpwd(){
  $("#loader").removeClass("hide")
  getpost( '/community/forgot-password', {email: $("#email").val() }, successEmail, loaderhide )
}
function successEmail(){
  swal.fire("패스워드변경!", "이메일로 패스워드 변경 URL 을 보냈습니다.", "success");
}
function loaderhide(){
  $("#loader").addClass("hide")
}
</script>
@endsection
