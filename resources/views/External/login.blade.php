<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="0txYC9JUlNOjUxUxDWRfC3ol38SGAMzqmQbLmu61">
    <title>List</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/community/assets/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/community/assets/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="/community/assets/stisla/node_modules/izitoast/dist/css/iziToast.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/community/assets/stisla/assets/css/style.css">
    <link rel="stylesheet" href="/community/assets/stisla/assets/css/components.css">

    <link rel="stylesheet" href="/community/assets/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css">
  </head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">


            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="" class="needs-validation" novalidate="" onsubmit="login();">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="email">ID</label>
                    <input id="userid" type="TEXT" class="form-control" name="userid" tabindex="1" required="" autofocus="">
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required="">
                    <div class="invalid-feedback">
                      비밀번호를 입력해주세요
                    </div>
                  </div>
                  @if($errors->any())
                  <div class="text-danger">{{$errors->first()}}</div>
                  @endif


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>



              </div>
            </div>


          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="/community/assets/stisla/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="/community/assets/stisla/node_modules/moment/moment.js"></script>
  <script src="/community/assets/stisla/node_modules/moment/locale/ko.js"></script>

  <script src="/community/assets/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="/community/assets/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/community/assets/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>

  <script src="/community/assets/js/handlebars.js"></script>

  <!--script src="/stisla/node_modules/sweetalert/dist/sweetalert.min.js"></script-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/community/assets/stisla/node_modules/izitoast/dist/js/iziToast.min.js"></script>

  <!-- summer note -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  <!-- Template JS File -->
  <script src="/community/assets/stisla/assets/js/scripts.js"></script>
  <script src="/community/assets/stisla/assets/js/custom.js"></script>
<script>
function login(){
  gotologin();
  return false;
}
function gotologin(){
  console.log("check")
}
</script>
</body>
</html>
