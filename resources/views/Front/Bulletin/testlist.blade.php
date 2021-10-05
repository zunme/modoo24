@extends('layouts.postnow')
@section ('title', $config->title)
@section ('backgroundimage', $config->backgroundimage)

@section('css')
<style>

	.inner-padding > div{
		margin-right:10px;
	}
	.bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
		width: 130px !important;
	}
	.width-220{width: 220px !important;}	

	.input-white{
		border: 1px solid #2ca8ff;
		background-color: #fff !important;
    	color: #666 !important;
	}	
	.input-info{
		border: 1px solid #2ca8ff;
		background-color: #2ca8ff !important;
    	color: #fff !important;
	}
	input.input-info::-ms-input-placeholder { color: #fff; }
	input.input-info::-webkit-input-placeholder { color: #fff; }
	input.input-info::-moz-placeholder { color: #fff; }

	
	.dataTables_wrapper > div.row:first-child{display:none;}
	.dataTables_paginate > .pagination .page-item.active>.page-link, .dataTables_paginate > .pagination .page-item.active>.page-link:focus, .dataTables_paginate > .pagination .page-item.active>.page-link:hover {
    background-color: #f96332;
    border-color: #f96332;
    color: #fff;
}
		.dataTables_paginate > .pagination .page-item.disabled>.page-link {
    opacity: .5;
    background-color: hsla(0,0%,100%,.2);
    color: black !important;
}
</style>
@endsection
@section('content')
<section>
	<div class="container text-center mt-20">
		<h3 class="title">{{$config->title}}</h3>
	<div>
	<div class="display-flex justify-space-between">
		<form>
			<div class="display-flex inner-padding">

				<select class="selectpicker" data-size="7" data-style="btn btn-white btn-round btn-block width-120 mt-10" title="검색옵션" name="search_option">
					<option value="title" @if($request->search_option !='cont' && $request->search_option !='writer' ) selected @endif >제목</option>
					<option value="cont" @if($request->search_option=='cont') selected @endif >제목+내용</option>
					<option value="writer" @if($request->search_option=='writer') selected @endif>글쓴이</option>
				</select>

				<div class="form-group width-220 mt-10">
					<input type="text" value="{{$request->search}}" placeholder="검색어를 넣어주세요" class="form-control input-white" name="search">
				</div>
				<button type="submit" class="btn btn-info btn-round">검색</button>
			</div>			
		</form>
		@if ( $config->use_write=='Y' )
		<div>
					@if (Auth::guest())
						<!--button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
									<i class="now-ui-icons users_single-02"></i>
									글쓰기
						</button-->
						<a class="btn btn-primary" type="button" href="{{$code}}/write">글쓰기</a>
					@else
						<a class="btn btn-primary" type="button" href="{{$code}}/write">글쓰기</a>
					@endif
		</div>
		@elseif( Auth::user() && Auth::user()->level >= 1024)
		<div>
			<a class="btn btn-primary" type="button" href="{{$code}}/write">글쓰기</a>
		</div>
		@endif
	</div>
	<div class="table-responsive mt-10">
		<table class="table">
			<thead class="">
				<tr>
					<th class="text-center">번호</th>
					<th class="text-center">제목</th>
					<th class="text-center">답변</th>
					<th class="text-center">글쓴이</th>
					<th class="text-right">날짜</th>
				</tr>
			</thead>
			<tbody>
				
				@foreach ( $data as $row)
				<tr>
					<td>{{$row->id}}</td>
					<td class="text-left"><a href="{{$code}}/view/{{$row->id}}">{{$row->title}}</a></td>
					<td>
						@if( $row->comment_cnt > 0)
							<button class="btn btn-outline-success btn-round btn-sm " type="button">업체답변({{$row->comment_cnt}})</button>
						@else
							<button class="btn btn-outline-default btn-round btn-sm" type="button">답변대기중</button>
						@endif
					</td>
					<td class="text-center">{{$row->nickname}}</td>
					<td class="text-right">{{$row->created_at->diffForHumans()}}</td>
				</tr>
				@endforeach
				
		</tbody>
	</table>
		
		<div class="paging-center">
			{{ $data->links() }}
		</div>
	</div>	
		
		<div class="mt-20">
			
			<div class="display-flex justify-space-between">			
				<div id="datatable_search_form">
					<div class="display-flex inner-padding">

						<select id="search_option" class="selectpicker" data-size="7" data-style="btn btn-white btn-round btn-block width-120 mt-10" title="검색옵션" name="search_option">
							<option value="title" @if($request->search_option !='cont' && $request->search_option !='writer' ) selected @endif >제목</option>
							<option value="cont" @if($request->search_option=='cont') selected @endif >제목+내용</option>
							<option value="writer" @if($request->search_option=='writer') selected @endif>글쓴이</option>
						</select>


						<div class="form-group width-220 mt-10">
							<input  id="search" type="text" value="{{$request->search}}" placeholder="이사에 대한 모든것을 물어보세요" class="form-control input-white" name="search">
						</div>
						<button type="button" class="btn btn-info btn-round" onClick="search_data()">검색</button>
					</div>			
				</div>
				
				@if ( $config->use_write=='Y' )
				<div>
							@if (Auth::guest())
								<button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
											<i class="now-ui-icons users_single-02"></i>
											글쓰기
								</button>
							@else
								<a class="btn btn-primary" type="button" href="{{$code}}/write">글쓰기</a>
							@endif
				</div>
				@elseif( Auth::user() && Auth::user()->level >= 1024)
				<div>
					<a class="btn btn-primary" type="button" href="{{$code}}/write">글쓰기</a>
				</div>
				@endif
				
			</div>
			<div class="table-responsive">
				<table class="table responsive dt-responsive display nowrap" id="datatable" width="100%">
					<thead>
						<tr>
							<th class="text-center">번호</th>
							<th class="text-center">제목</th>
							<th class="text-center">답변</th>
							<th class="text-center">글쓴이</th>
							<th class="text-right">날짜</th>
						</tr>
					</thead>
				</table>
			</div>
    </div> 
		
</section>
	
@endsection
	
@section('script')	
	<script>
		let datatable;
		$.extend( $.fn.dataTable.defaults, {
				responsive: true
		} );
		function search_data(){
			datatable.search('').draw();
		}
   $(document).ready(function() {
    datatable = $('#datatable').DataTable({
				"responsive": true,
				bStateSave: true,
				"processing": true,
        "serverSide": true,
        "lengthMenu": [5],
				language : lang_kor,
        "order": [[ 0, "desc" ]],
        "ajax": {
            'url' : "{{$code}}/listapi",
            'data' : function (data){
                data.search_option = $("#search_option").val();
							data.search = $("#search").val();
            }
        },
        "columnDefs": [
            {"targets": [ 0 ],"visible": true,"searchable": false,"className":'details-control',responsivePriority: 6},
						{"targets": [ 1 ],"visible": true,"searchable": true,sortable:false,"className":'details-control',responsivePriority: 1},
						{"targets": [ 2 ],"visible": true,"searchable": true,sortable:false,"className":'details-control',responsivePriority: 2},
						{"targets": [ 3 ],"visible": true,"searchable": true,sortable:false,"className":'details-control',responsivePriority: 3},
						{"targets": [ 4 ],"visible": true,"searchable": false,sortable:false,"className":'details-control',responsivePriority: 5},
				],
			"columns" : [
				{"data" : "id"},
				{"data" : "title",
             "render": function( data, type, row, meta) {
                return `<a href="{{$code}}/view/${row.id}">${data}</a>`
             }},
				{"data" : "comment_cnt",
             "render": function( data, type, row, meta) {
                if( data > 0 ) return `<button class="btn btn-outline-success btn-round btn-sm " type="button">업체답변(${data})</button>`
								else return `<button class="btn btn-outline-default btn-round btn-sm" type="button">답변대기중</button>`
             }},
				{"data" : "nickname"},
				{"data" : "created_at"},
			],
			"initComplete": function(settings, json) {
            
            $('#datatable_filter label input').unbind();
				
						var textBox = $('#search');
            $("#search").bind('keyup input', function(e) {
                if(e.keyCode == 8 && !textBox.val() || e.keyCode == 46 && !textBox.val()) {
                    // do nothing ¯\_(ツ)_/¯
                } else if(e.keyCode == 13 || !textBox.val()) {
                    datatable.search('').draw();
                }
            });
        },
        "drawCallback": function( settings ) {
        },
        "preDrawCallback": function( settings ) {
        },
		});
	} );
	</script>
@endsection
