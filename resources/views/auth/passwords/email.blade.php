@extends('layouts.modoo')

@section('css')
<style>
.card .card-header:not([class*="header-"]) {
    box-shadow: 0px 7px 4px -12px rgb(0 0 0 / 37%), 0 4px 25px 0px rgb(0 0 0 / 12%), 0 8px 10px -5px rgb(0 0 0 / 20%);
}
.mb-4 {
    margin-bottom: 1.5rem!important;
}
.py-4 {
    padding-top: 1.5rem!important;
    padding-bottom: 1.5rem!important;
}
.border-radius-lg {
    border-radius: .5rem;
}

.bg-gradient-warning {
    background-image: linear-gradient(
195deg,#ffa726,#fb8c00);
}
.shadow-warning {
    box-shadow: none !important;
}

.bg-gradient-warningblue {
    background-image: linear-gradient(
195deg,#0994ef,#00beff);
}

.card-header:first-child {
    border-radius: .75rem .75rem;
}
.card-body {
    flex: 1 1 auto;
    padding: 1rem;
}
.card .card-body {
    font-family: Roboto,Helvetica,Arial,sans-serif;
    padding: 1.5rem;
}
.input-group.input-group-static .form-control {
    width: 100%;
}
.input-group, .input-group .input-group-text {
    transition: .2s ease;
    border: none;
}
.input-group {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
    flex-direction: column;
}
.input-group {
    border-radius: 0;
}
.container-margin{
  margin-top: 60px;
  margin-bottom: 60px;
}
.resetbtn{
      font-size: 18px;
}

</style>
@endsection


@section('content')


<div class="container container-margin mb-4">
    <div class="row mt-lg-n12 mt-md-n12 mt-n12 justify-content-center">
      <div class="col-xl-6 col-lg-8 col-md-8 mx-auto">
        <div class="card mt-8">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-warningblue shadow-warning border-radius-lg py-3 pe-1 text-center py-4">
              <h3 class="font-weight-bolder text-white">비밀번호 변경</h3>
              <p class="mb-0 text-sm text-white">변경할 이메일을 적어주세요, 이메일로 주소가 발송됩니다</p>
            </div>
          </div>
          <div class="card-body py-4">
            <form role="form">
              <div class="input-group input-group-static mb-4">
                <label>Email</label>
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
              </div>
              <div class="text-center">
                <button type="button" class="btn bg-gradient-warning w-100 mt-4 mb-0 resetbtn" onClick="resetpwd()">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
function resetpwd(){
  getpost( '/community/forgot-password', {email: $("#email").val() }, successEmail )
}
function successEmail(){
  swal.fire("패스워드변경!", "이메일로 패스워드 변경 URL 을 보냈습니다.", "success");
}
</script>
@endsection
