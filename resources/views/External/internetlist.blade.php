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
    <style>
    .pagination li{margin:0 5px ; font-size: 16px;}
    .section-body{
      display: flex;
      justify-content: center;
      padding-top: 20px;
    }
    .card{
      width:600px;
      max-width: 98vw;
    }
    </style>
  </head>
  <body class="layout-2">
  <div id="app">
    <div class="main">

        <section class="section">
          <div class="section-body">


            <div class="card">
                <div class="card-header">
                  <h4>정보제공동의리스트</h4>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped table-md">
                      <tbody>
                        <tr>

                          <th>Name</th>
                          <th>Tel</th>
                        </tr>
                        @foreach( $data as $item)
                        <tr>
                          <td>{{$item->name}}</td>
                          <td>{{$item->hp}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <nav class="d-inline-block">
{{ $data->links() }}
                  </nav>
                </div>
              </div>


          </div>
        </section>


    </div>
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
  </body>
</html>
