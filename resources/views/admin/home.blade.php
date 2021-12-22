@extends('admin.layouts.app')

@section('content')
<style>
.main-content {
    padding-left: 265px;
    padding-right: 15px;
    padding-top: 80px;
}
@media (max-width: 1024px){
  .main-content {
      padding-left: 10px;
      padding-right: 10px;
      width: 100% !important;
  }
}
.container {
    max-width: 100%;
    width: 100%;
    padding-left: 5px;
    padding-right: 5px;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

									<div class="main-container container">
										<div class="table-responsive">
											<table id="datatable" class="display" width="100%">
												<thead>
														<tr>
															<th>#</th>
															<th>title</th>
															<th>컨펌</th>
															<th>comment</th>
															<th>view</th>
															<th>etc</th>
														</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
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
	$(document).ready( function () {
    $('#datatable').DataTable();
    //getnoticeservice()
	});
</script>


@endsection
