@extends('admin.layouts.app')

@section('css')
<style>

</style>
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                  <!-- body -->

                  <section class="section none-min-height">
                  				<div class="section-header split_title">
                  					<span>지식인 댓글 리스트</span>
                  					<div class="section-header-breadcrumb" style="flex-basis: 10px;">
                  						<div class="breadcrumb-item active">
                  							<i class="fas fa-caret-down upanddown"></i>
                  						</div>
                  					</div>
                  				</div>
                  				<div class="section-body">
                  					<table id="comment" class="display" width="100%">
                  						<thead>
                  								<tr>
                  									<th>#</th>
                  									<th>유저</th>
                  									<th>댓글</th>
                  									<th>허용</th>
                  									<th></th>
                  								</tr>
                  						</thead>
                  						<tbody>
                  						</tbody>
                  					</table>
                  				</div>
                  			</section>

                  <!-- /body -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                  <!-- body -->

                  <section class="section none-min-height">
                  				<div class="section-header split_title">
                  					<span>지식인 글 리스트</span>
                  					<div class="section-header-breadcrumb" style="flex-basis: 10px;">
                  						<div class="breadcrumb-item active">
                  							<i class="fas fa-caret-down upanddown"></i>
                  						</div>
                  					</div>
                  				</div>
                  				<div class="section-body">
                            <table id="datatable" class="display" width="100%">
                              <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>title</th>
                                    <th>유저</th>
                                    <th>날짜</th>
                                    <th>허용여부</th>
                                    <th>메인</th>
                                    <th>댓글</th>
                                    <th>대기</th>
                                    <th>view</th>
                                    <th>etc</th>
                                  </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                  				</div>
                  			</section>

                  <!-- /body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@verbatim
<script>
Pusher.logToConsole = true;

var pusher = new Pusher('13fc7ff1bb9caecd8347', {
  cluster: 'ap3'
});
var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
  let message = data.message;
  if( message.type == 'post') toast('새로운 글이 등록되었습니다.','bottomRight')
  else if ( message.type == 'comment') toast('댓글이 등록되었습니다.','bottomRight')
  else if ( message.type == 'recomment') toast('커뮤니티 댓글이 등록되었습니다.','bottomRight')
});
</script>
<style>
	#comment_wrapper > div:nth-child(1)> div:nth-child(2){
		/*display:none;*/
	}
	.main-container{
		/*display:none;*/
	}
	.main-container.simple-tab-active{
		display:block;
	}
	.rangefilterwrap{
		display: inline-block;
		margin-right: 10px;
	}
	.changedate{
		cursor: pointer;
		color:#03a9f4;
		margin-right: 5px;
	}
.section-header.split_title{
  background-color: #f3f3f3;
}
  #comment > tbody  td {
    padding-bottom: 10px;
    padding-top: 10px;
  }
  #comment > tbody >tr{
    border-bottom: 1px solid silver;
  }
  .btn-td{
    width:130px;
    max-width: 130px !important;
  }
  .staff-td{
    min-width: 110px;
  }
  @media (max-width: 576px){
    .btn-td{
      max-width: 35px !important;
    }
    .staff-td{
      min-width: 60px;
    }
  }
  #datatable_wrapper > div.row:nth-child(1) > div:last-child{
    text-align: right;
    display: flex;
    justify-content: flex-end;
  }
  #datatable_wrapper td{
    border-bottom: 1px solid #ddd !important;
  }

  .hidden_user{
    display:none;
    font-size: 12px;
    padding-right: 10px;
  }
  @media (max-width: 900px){
    #datatable tr > td:nth-child(2), #datatable tr > th:nth-child(2){
      display:none;
    }
    #datatable tr > td:nth-child(3), #datatable tr > th:nth-child(3),
    #datatable tr > td:nth-child(6), #datatable tr > th:nth-child(6),
    #datatable tr > td:nth-child(8), #datatable tr > th:nth-child(8)
    {
      display:none;
    }
    .hidden_user{
      display:flex;
      justify-content: flex-end;
    }
  }

</style>
<script>
	let datatable, commenttable, statics_table, chocolateapi;

	let code = 'jisik';
	$.extend( $.fn.dataTable.defaults, {
			responsive: true
	} );
	function search_data(){
		datatable.search('').draw();
	}

	$(document).ready( function () {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  window.dispatchEvent(new Event('resize'));
		});
		$(".upanddown").on("click", function () {
			if( $(this).hasClass('fa-caret-up') ){
				$(this).removeClass('fa-caret-up').addClass('fa-caret-down')
				$(this).closest('.section-header').next().show();
			}else {
				$(this).removeClass('fa-caret-down').addClass('fa-caret-up')
				$(this).closest('.section-header').next().hide();
			}
		})
		let tab
		$(".simple-tab").on("click", function(e){
			tab = e.target;
			if( $(tab).hasClass("simple-tab-active") ) return;
			else {
				$(".simple-tab-active").removeClass("simple-tab-active")
				$(tab).addClass("simple-tab-active");
				$($(tab).data("target")).addClass("simple-tab-active");
			}
		})
		datatable = $('#datatable').DataTable({
				bStateSave: true,
				"processing": true,
        "serverSide": true,
        "lengthMenu": [5,10,15,20],
				language : datatable_lang_kor,
        "order": [[ 0, "desc" ]],
        "ajax": {
            'url' : "/community/rhksfl/bulletin/list/"+code,
            'data' : function (data){
							data.search['value'] = '';
							data.search_str = $("#search_str").val();
							data.search_option = $("#search_option option:selected").val();
            }
        },
        "columnDefs": [
            {"targets": [ 0 ],"visible": false,"searchable": false,"className":'details-control'},
						{"targets": [ 1 ],"visible": true,"searchable": true,sortable:true,"className":'details-control'},
						{"targets": [ 2 ],"visible": true,"searchable": true,sortable:true,"className":'details-control'},
						{"targets": [ 3 ],"visible": true,"searchable": true,sortable:true,"className":'details-control'},
						{"targets": [ 4 ],"visible": true,"searchable": false,sortable:true,"className":'details-control'},
						{"targets": [ 5,6 ],"visible": true,"searchable": false,sortable:true,"className":'details-control'},
						{"targets": [ 7,8,9 ],"visible": true,"searchable": false,sortable:false,"className":'details-control'},
				],
			"columns" : [
				{"data" : "id"},
				{"data" : "title",
          "render": function( data, type, row, meta) {
            var classstr = '';
            if ( row.view_cnt > 0 ) classstr="comment_ready_body"
            return `
            <div class="${classstr}">${data}</div>
            <div class="hidden_user">
              <span class="user-icon" onClick="viewUserInfo(${row.user_id})">
                <i class="fas fa-user-tag"></i> ${row.nickname}<span class="user_id_span">(${row.users.email})</span>
              </span>
            </div>
            `
          }
        },
				{
					//"data" : "users.email",
					"data" : "nickname",
				 	"render": function( data, type, row, meta) {
						return `<span class="user-icon" onClick="viewUserInfo(${row.user_id})"><i class="fas fa-user-tag"></i> ${data}<span class="user_id_span">(${row.users.email})</span></span>`
					}
				},
				{"data" : "created_at" ,
					"render": function( data, type, row, meta) {
						return `<i class="far fa-clock changedate" data-id="${row.id}" data-time="${data}" onClick="changedate(this)"></i>${data}`
					}
				},
				{"data" : "is_confirmed",
				 	"render": function( data, type, row, meta) {
						let optionY, optionN,optionR = ''
						if( data == 'Y' ) optionY ='selected'
						else if( data == 'N' ) optionN ='selected'
						else optionR ='selected'
						return `
						<select data-id="${row.id}" onChange="confirmStatusChange(this)">
							<option value="Y" ${optionY}>Y</option>
							<option value="N" ${optionN}>N</option>
							<option value="R" ${optionR} disabled>대기</option>
							<option value="D">삭제</option>
						</select>
						`
						if( data == 'Y') return '허용'
						else if( data == 'N') return '미허용'
						if( data == 'R') return '대기'
					}
				},
				{"data" : "main_post",
	        "render": function( data, type, row, meta) {
						let optionY=""
						let optionN=""
	          if( data == 'Y') optionY = "selected"
	          else optionN = "selected"
						return `
							<select data-id="${row.id}" onChange="mainpostchange(this)">
								<option value="Y" ${optionY}>Y</option>
								<option value="N" ${optionN}>N</option>
							</select>
						`
	        }
	      },
				{"data" : "comment_cnt"},
				{"data" : "needconfirm",
				 	"render": function( data, type, row, meta) {
						return data.length
					}
				},
				{"data" : "view_cnt"},
				{"data" : "id", "render": function( data, type, row, meta) {
						return `<span class="btn btn-sm btn-info" onClick="viewComment(${row.id})">보기</span>
										`
				}},
			],
			"drawCallback": function( settings ) {
			},
			"initComplete": function(settings, json) {
						$('#datatable_filter label input').unbind();
						//$('#datatable_filter label input').remove();
						let form = `
						<div class="form-group">
							<select class="form-control" id="search_option" name="search_option">
								<option value="title">제목</option>
								<option value="user">아이디</option>
								<option value="reg">날짜</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="search_str" id="search_str" class="form-control">
						</div>
						`
						$("#datatable_wrapper>.row:first-child > div:nth-child(2)").addClass('in_div_inline').css('text-align','right').html(form)
						var textBox = $("#search_str")

						textBox.bind('keyup input', function(e) {
								if(e.keyCode == 8 && !textBox.val() || e.keyCode == 46 && !textBox.val()) {
										// do nothing ¯\_(ツ)_/¯
								} else if(e.keyCode == 13 || !textBox.val()) {
										datatable.search(this.value).draw();
								}
						});

        },
		});

		commenttable = $('#comment').DataTable({
				bStateSave: true,
				"processing": true,
        "serverSide": true,
        "lengthMenu": [5,10,15,20],
				language : datatable_lang_kor,
        "order": [[ 0, "desc" ]],
        "ajax": {
            'url' : "/community/rhksfl/bulletin/commentConfirm/"+code,
						'data' : function (data){
							data.search['value'] = '';
							//data.search_str = $('#comment_filter label input').val();
							data.search_option = $("#comment_confirm_search option:selected").val();
            }
        },
        "columnDefs": [
            {"targets": [ 0 ],"visible": false,"searchable": false,"className":'details-control'},
						{"targets": [ 1 ],"visible": true,"searchable": false,sortable:false,"className":'details-control staff-td'},
						{"targets": [ 2 ],"visible": true,"searchable": true,sortable:false,"className":'details-control ellipsetd', },
						{"targets": [ 3 ],"visible": true,"searchable": false,sortable:false,"className":'details-control','width':'40px'},
            {"targets": [ 4 ],"visible": true,"searchable": false,sortable:false,"className":'details-control btn-td'},
				],
			"columns" : [
				{"data" : "id"},
				{"data" : "auction_staff_s_name", "render": function( data, type, row, meta) {
						return `<span class="ellipsis user-icon" onClick="viewStaffInfo( ${row.auction_staff_s_uid})" ><i class="far fa-address-card"></i> ${data}</span>`
				}},
				{"data" : "body", "render": function( data, type, row, meta) {
						return `${data}`
				}},
				{"data" : "is_confirmed", "render": function( data, type, row, meta) {
					if( data == 'Y') return '허용'
					else if( data == 'N') return '미허용'
					if( data == 'R') return '대기'
				}},

				{"data" : "id", "render": function( data, type, row, meta) {
						return `<span class="btn btn-sm btn-info" onClick="viewComment(${row.post_id})">보기</span>
									<span class="btn btn-sm btn-success" onClick="confirmComment(${row.id})">승인</span>
<span class="btn btn-sm btn-warning" onClick="denyComment(${row.id})">거부</span>
										`
				}},
			],
				"initComplete": function(settings, json) {
							$('#comment_filter label input').unbind();
							let opt = `<div class="form-group">
                      <select class="form-control" id="comment_confirm_search" onChange="searchcomment()">
        								<option value="" selected>전체</option>
        								<option value="R">대기</option>
        								<option value="Y">승인</option>
        								<option value="N">비허용</option>
        							</select>
              </div>`

							$('#comment_filter').html(opt)
							var textBox = $('#comment_filter label')
							textBox.bind('keyup input', function(e) {
									if(e.keyCode == 8 && !textBox.val() || e.keyCode == 46 && !e.target.value) {
											// do nothing ¯\_(ツ)_/¯
									} else if(e.keyCode == 13 || !e.target.value ) {
											commenttable.search( e.target.value ).draw()
									}
							});
				}
		});


		statics_table = $('#statics_table').DataTable({
				bStateSave: true,
				"processing": true,
        "serverSide": true,
        "lengthMenu": [5,10,15,20],
				language : datatable_lang_kor,
        "order": [[5, "desc" ]],
        "ajax": {
            'url' : "/community/rhksfl/staff/staticsv2",
            'data' : function (data){
							data.range = $("#rangefilter").val();
            }
        },
        "columnDefs": [
            {"targets": [ 0 ],"visible": false,"searchable": true,"className":'details-control'},
						{"targets": [ 1,2 ],"visible": true,"searchable": true,sortable:false,"className":'details-control'},
						{"targets": [ 4 ],"visible": true,"searchable": false,sortable:false,"className":'details-control', "width":'100px'},
						{"targets": [ 3,5,6 ],"visible": true,"searchable": false,sortable:true,"className":'details-control', "width":'100px'},
						{"targets": [ 7 ],"visible": true,"searchable": false,sortable:false,"className":'details-control', "width":'100px'},
				],

			"columns" : [
				{"data" : "s_uid"},
				{"data" : "s_id", "render": function( data, type, row, meta) {
					return `<span class="ellipsis user-icon" onclick="viewStaffInfo( ${row.s_uid} )"><i class="far fa-address-card"></i> ${data} </span>`
				}},
				{"data" : "s_company"},
				{"data" : "comment_cnt", "render": function( data, type, row, meta) {
					if ( !data ) return 0;
					else return data
				}},
				{"data" : "grade", "render": function( data, type, row, meta) {
					return data;

				}},
				{"data" : "totalcnt", "render": function( data, type, row, meta) {
					if ( !data ) return '0'
					else return data
				}},
				{"data" : "click_cnt", "render": function( data, type, row, meta) {
					if ( !data ) return '0'
					else return data
				}},
				{"data" : "total_point", "render": function( data, type, row, meta) {
					if ( !data ) return '0'
					else return data
				}},
			],
			"initComplete": function(settings, json) {
						$('#statics_table_filter label input').unbind();
						$("#statics_table_filter").prepend(rangefilter)

						var textBox = $('#statics_table_filter label')
						textBox.bind('keyup input', function(e) {
								if(e.keyCode == 8 && !textBox.val() || e.keyCode == 46 && !e.target.value) {
										// do nothing ¯\_(ツ)_/¯
								} else if(e.keyCode == 13 || !e.target.value ) {
										statics_table.search( e.target.value ).draw()
								}
						});
				},

		});

	});
	let rangefilter = `
	<div class="rangefilterwrap">
				<label>공감, 댓글</label>
        <select id="rangefilter" onChange="staticFilterChange()">
						<option value="24">24개월</option>
						<option value="12">18개월</option>
						<option value="12">12개월</option>
						<option value="11">11개월</option>
						<option value="10">10개월</option>
						<option value="9">9개월</option>
						<option value="8">8개월</option>
						<option value="7">7개월</option>
            <option value="6" selected="">6개월</option>
            <option value="5">5개월</option>
						<option value="4">4개월</option>
						<option value="3">3개월</option>
						<option value="2">2개월</option>
						<option value="1">1개월</option>
        </select>
    </div>
	`

	function searchcomment() {
		commenttable.draw();
	}
	function staticFilterChange() {
		statics_table.draw()
	}
	function mainpostchange(target){
		let status = $(target).val()
		let post_id = $(target).data('id')
		getpost( '/community/rhksfl/bulletin/mainpost', {id :post_id , status:status}, mainpostSuccess,mainpostComplete)
	}
	function mainpostSuccess(res){
		toast('변경완료','bottomRight','메인노출')
	}
	function mainpostComplete(res){
		datatable.ajax.reload(null, false)
	}

	function viewComment(post_id) {
		//var data =  commenttable.row($(btn).closest('tr')).data();

		$.ajax({
			url:"/community/rhksfl/bulletin/post/"+post_id,
			method:"get",
			data:{id :post_id },
			dataType:'JSON',
			success:function(res)
			{
			 //pop_tpl('lg','formmodal' , res.data )

				var compiledTemplate = Handlebars.compile( $('#postmodal').html() );
				var html = compiledTemplate(res.data);

			  $("#modal_xl_body" ).html ( html );
				$( "#xlModal" ).modal('handleUpdate')
				$( "#xlModal" ).modal('show')
        if(jQuery().Chocolat) {
          chocolateapi = $(".gallery").Chocolat({
            className: 'gallery',
            imageSelector: '.gallery-item',
          }).data('chocolat');
        }
			},
			error: function ( err ){
			 ajaxErrorST(err)
			}
		});
	}
  let redrawtest
	function denyComment( comment_id, redraw ){
    redrawtest = redraw
		swal.fire({
			title : '거부',
			text : '선택하신 댓글을 거부하시겠습니까?',
			type : "warning",
			showCancelButton : true,
			confirmButtonClass : "btn-danger",
			confirmButtonText : "예",
			cancelButtonText : "아니오",
		}).then((result) => {
			if( result.isConfirmed ){
					$.ajax({
						url : '/community/refresh',
						method:"get",
						dataType:'JSON',
						success:function(result){
							$('meta[name="csrf-token"]').attr('content', result.token);
							$.ajaxSetup({
									headers: {
											'X-CSRF-TOKEN': result.token
									}
							});
								$.ajax({
									url:"/community/rhksfl/bulletin/comment/deny/"+comment_id,
									method:"post",
									data:{id :comment_id },
									dataType:'JSON',
									success:function(res)
									{
										iziToast.success({
												message: '선택하신 댓글이 거부되었습니다.',
												position: 'bottomRight'
										});
										commenttable.ajax.reload(null, false)
										datatable.ajax.reload(null, false)
										if ( typeof redraw !='undefined') {
											var compiledTemplate = Handlebars.compile( $('#commentline').html() );
											var html = compiledTemplate(res.data);
											$(redraw).closest('.new_post_comments_item').html(html);
										}
									},
									error: function ( err ){
									 ajaxErrorST(err)
									}
								});
						}
					})
			}
		});
		return;
	}

	function confirmComment( comment_id , redraw ){
		swal.fire({
			title : '승인',
			text : '선택하신 댓글을 승인하시겠습니까?',
			type : "warning",
			showCancelButton : true,
			confirmButtonClass : "btn-danger",
			confirmButtonText : "예",
			cancelButtonText : "아니오",
		}).then((result) => {
			if( result.isConfirmed ){
					$.ajax({
						url : '/community/refresh',
						method:"get",
						dataType:'JSON',
						success:function(result){
							$('meta[name="csrf-token"]').attr('content', result.token);
							$.ajaxSetup({
									headers: {
											'X-CSRF-TOKEN': result.token
									}
							});
								$.ajax({
									url:"/community/rhksfl/bulletin/comment/confirm/"+comment_id,
									method:"post",
									data:{id :comment_id },
									dataType:'JSON',
									success:function(res)
									{
										iziToast.success({
												message: '선택하신 댓글이 승인되었습니다.',
												position: 'bottomRight'
										});
										commenttable.ajax.reload(null, false)
										datatable.ajax.reload(null, false)
										if ( typeof redraw !='undefined') {
                      var compiledTemplate = Handlebars.compile( $('#commentline').html() );
											var html = compiledTemplate(res.data);
											$(redraw).closest('.new_post_comments_item').html(html);
										}
									},
									error: function ( err ){
									 ajaxErrorST(err)
									}
								});
						}
					})
			}
		});
	}
	function changecode(sel){
		code = $("#changecode").val();
		commenttable.ajax.url( "/community/rhksfl/bulletin/commentConfirm/"+code ).load();
		datatable.ajax.url( "/community/rhksfl/bulletin/list/"+code ).load();
	}

	function changePost(id, confirm){
		let msg = "미허용"
		let confirmed = "N"
		if( confirm ){
			msg = "허용"
			confirmed = "Y"
		}
		swal.fire({
			title : msg,
			text : '선택하신 글을 '+msg+' 하시겠습니까?',
			type : "warning",
			showCancelButton : true,
			confirmButtonClass : "btn-danger",
			confirmButtonText : "예",
			cancelButtonText : "아니오",
		}).then((result) => {
			if( result.isConfirmed ){
					$.ajax({
						url : '/community/refresh',
						method:"get",
						dataType:'JSON',
						success:function(result){
							$('meta[name="csrf-token"]').attr('content', result.token);
							$.ajaxSetup({
									headers: {
											'X-CSRF-TOKEN': result.token
									}
							});
								$.ajax({
									url:"/community/rhksfl/bulletin/post/changestatus",
									method:"post",
									data:{id :id , status : confirmed },
									dataType:'JSON',
									success:function(res)
									{
										iziToast.success({
												message: '선택하신 글이 '+msg+'되었습니다.',
												position: 'bottomRight'
										});
										commenttable.ajax.reload(null, false)
										datatable.ajax.reload(null, false)

										var compiledTemplate = Handlebars.compile( $('#poststatus').html() );
										var html = compiledTemplate(res.data);
										$("#postconfirmline").html(html);

									},
									error: function ( err ){
									 ajaxErrorST(err)
									}
								});
						}
					})
			}
		});

	}
	function confirmStatusChange(target){
		let status = $(target).val()
		let post_id = $(target).data('id')
		getpost( '/community/rhksfl/bulletin/post/changestatus', {id :post_id , status:status}, changePostStatusSuccess,mainpostComplete)
	}
	function changePostStatusSuccess(res){
		toast('변경완료','bottomRight')
	}
	async function changedate(btn){
		let inputValue = $(btn).data('time')
		let id = $(btn).data('id')

		const { value: ipAddress } = await Swal.fire({
		  title: '날짜변경',
		  input: 'text',
		  inputLabel: '',
		  inputValue: inputValue,
		  showCancelButton: true,
		  inputValidator: (value) => {
		    if (!value) {
		      return 'You need to write something!'
		    }else {
					getpost( '/community/rhksfl/bulletin/post/changeDate', {id :id , date:value}, changePostStatusSuccess,mainpostComplete)
				}
		  }
		})
	}

/* TODO 새로운 글, 댓글 등록시 rekoad */
function reloadpages() {
	let info = datatable.page.info();
	if (info.page == 0 ) datatable.ajax.reload(null, true)
}
function reloadpages( dt ) {
	let info = dt.page.info();
	if (info.page == 0 ) dt.ajax.reload(null, true)
}

</script>


<!-- user -->
<script>
	function viewUserInfo(user_id){
		getData('get', '/user/info', {id:user_id}, userinfoPrc )
	}
	function userinfoPrc(res){
		let data = res.data

		var compiledTemplate = Handlebars.compile( $('#userinfo').html() );
		var html = compiledTemplate(res.data);

		$("#modal_sm_body" ).html ( html );
		$( "#smModal" ).modal('handleUpdate')
		$( "#smModal" ).modal('show')

	}
</script>

<script id="userinfo" type="text/template">
<div style="margin-bottom:20px;">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
  </button>
</div>
	<div class="card">
		<div clas="card-body">
			<div class="user_info_wrap">
				<ul class="list-unstyled list-unstyled-border">
					<li class="media">
						<span class="user_info_title">이메일</span>
						<div class="media-body">
							{{email}}
						</div>
					</li>
					<li class="media">
						<span class="user_info_title">상태</span>
						<div class="media-body">
							{{#if (checkempty deleted_at) }}
							정상
							{{/if}}
							{{#if (checknotempty deleted_at) }}
							삭제( {{deleted_at}})
							{{/if}}
						</div>
					</li>
					<li class="media">
						<span class="user_info_title">전화번호</span>
						<div class="media-body">
							{{phone}}
						</div>
					</li>
					<li class="media">
						<span class="user_info_title">이름</span>
						<div class="media-body">
							{{name}}
						</div>
					</li>
					<li class="media">
						<span class="user_info_title">닉네임</span>
						<div class="media-body">
							{{nickname}}
						</div>
					</li>
					<li class="media">
						<span class="user_info_title">가입방식</span>
						<div class="media-body">
							{{provider}}
						</div>
					</li>
					<li class="media">
						<span class="user_info_title">작성 글 수</span>
						<div class="media-body">
							{{post_count}} 개
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</script>
<!-- /user -->
<style>
	.info-line-block{
		    margin: 12px 10px 12px;
    padding: 0 5px;
    border-bottom: 1px solid rgb(168 170 171 / 59%);
	}
	.input-group-text, select.form-control:not([size]):not([multiple]), .form-control:not(.form-control-sm):not(.form-control-lg) {
    font-size: 12px;
    padding: 11px 15px;
    height: inherit;
}
	.display-flex{
		display: flex;
	}
	.w-50, .plr-50{
		padding-left: 5px;
		padding-right: 5px;
	}
	.mb-10{
		margin-bottom:10px;
	}
	.staff-th{
		flex-basis: 120px;
    margin-right: 12px;
		flex-shrink: 0;
		padding:5px;
	}
	.staff-td{
		flex-grow: 1;
		padding:5px;
	}
	.tags-line{
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff', endColorstr='#f6f6f6');
    background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#f6f6f6));
    background: -moz-linear-gradient(top, #fff, #f6f6f6);
    background: -o-linear-gradient(top, #fff, #f6f6f6);
    flex-grow: 1;
    font-size: 12px;
    padding: 11px 15px;
    position: relative;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    width: 1%;
    margin-bottom: 0;
    border-color: #fcfcfc;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    background-color: #e9ecef;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    /* border-left: none; */
    margin-left: -1px;
	}
	.tags-line.scrollable{
		max-height: 70px;
    overflow-y: scroll !important;
	}
	.tags-line .tag{
		padding: 6px 10px;
    background-color: #3abaf4;
    border-radius: 10px;
    margin-right: 10px;
    color: #f8f9fa;
		margin-top: 2px;
    margin-bottom: 2px;
    display: inline-block;
		font-size:12px;
	}
	.tags-line .tag.info{
		background-color: #47c363;
	}
	.memo-block label{
		font-weight: 600;
    color: #34395e;
    font-size: 12px;
    letter-spacing: .5px;
	}
	.memo-block > div{
		font-weight: 500;
    margin: 0 10px 6px;
    padding: 6px 10px;
    border: 1px solid #eee;
    border-radius: 5px;
    min-height: 20px;
    font-size: 12px;
		background-color: aliceblue;
	}
	.gallery.none {
    margin-bottom: 0;
    border-bottom: none;
    padding-bottom: 0;
	}
	.gallery.none.gallery-md .gallery-item {
    margin-bottom: 4px;
	}
	.justify-content-end{
		justify-content: flex-end;
	}
	.cnt-badge-item{
		padding: 5px 15px;
    font-weight: 600;
    color: #fff;
    border-radius: 30px;
    font-size: 12px;
    margin-right: 5px;
	}
  .post_body{
    margin: 10px;
  }
  .postconfirmline .buttons{
    display: flex;
    justify-content: flex-end;
    padding-right: 15px;
  }
  .new_post_comments_item{
    padding: 10px 5px;
    margin-bottom: 15px;
    border: 1px solid #aaa;
    border-radius: 5px;
  }
  .new_post_comment_staffinfo{

  }
  .new_post_comment_time{
    text-align: right;
    color: #919191;
    font-size: 12px;
  }
  .new_post_comment_body{
    padding: 5px 10px;
    margin-bottom: 10px;
    margin-top: 5px;
  }
  .new_post_comment_status{
    display: flex;
    justify-content: flex-end;
  }

  .new_post_comment_status_now{
    padding-top: 5px;
    margin-right: 15px;
  }
  .new_post_comment_status_change{
    margin-right: 30px;
  }
</style>


<!-- staff -->
<script>
	function viewStaffInfo(user_id){
		getData('get', '/staff/info', {id:user_id}, staffinfoPrc )
	}
	function staffinfoPrc(res){
		let data = res.data

		var compiledTemplate = Handlebars.compile( $('#staffinfoModal').html() );
		var html = compiledTemplate(res.data);

		$("#modal_lg_body" ).html ( html );
		$( "#lgModal" ).modal('handleUpdate')
		$( "#lgModal" ).modal('show')
		$(".gallery.none").Chocolat({
      className: 'gallery',
      imageSelector: '.gallery-item',
    });
	}
</script>
<script id="staffinfoModal" type="text/template">
<div style="margin-bottom: 20px;
    display: flex;
    justify-content: space-between;">
	<div>
		{{#if ( checknotempty commentlogs )}}
			<div class="display-flex justify-content-end">
				<div class="cnt-badge-item bg-danger">댓글</i> {{commentlogs.comment_cnt}}</div>
				<div class="cnt-badge-item bg-danger">베스트</i> {{commentlogs.best_cnt}}</div>
				<div class="cnt-badge-item bg-danger">업체공감</i> {{commentlogs.fav_cnt}}</div>
			</div>
		{{/if}}
		{{#if ( checkempty commentlogs )}}
			<div class="display-flex justify-content-end">
				<div class="cnt-badge-item bg-danger">댓글</i> 0</div>
				<div class="cnt-badge-item bg-danger">베스트</i> 0</div>
				<div class="cnt-badge-item bg-danger">업체공감</i> 0</div>
			</div>
		{{/if}}
	</div>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">×</span>
	</button>
</div>

<div class="card">
	<div clas="card-body">

		<div class="form-group">
			<div class="display-flex mb-10">
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">아이디</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{s_id}}" disabled />
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">구분</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{flat_rate_staff_name}}"
						disabled {{#if (isEqual flat_rate_staff_name '정액제') }} style="color:red
						!important;"{{/if}}>
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">닉네임</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{s_nickname}}" disabled />
					</div>
				</div>
			</div>

			<div class="display-flex mb-10">
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">업체명</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{s_company}}" disabled />
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">사업자번호</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{s_license1}}" disabled />
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">업체구분</div>
						</div>
						<input
							type="text"
							class="form-control daterange-cus"
							value="{{s_level_name}}"
							disabled
						/>
					</div>
				</div>
			</div>

			<div class="info-line-block"></div>

			<div class="display-flex mb-10">
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">대표자</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{s_ceo_name}}" disabled />
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">대표전화</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{s_ceo_hp}}" disabled />
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">분배용전화</div>
						</div>
						<input
							type="text"
							class="form-control daterange-cus"
							value="{{s_ceo_hp_plus}}"
							disabled
						/>
					</div>
				</div>
			</div>

			<div class="display-flex mb-10">
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">상담자</div>
						</div>
						<input
							type="text"
							class="form-control daterange-cus"
							value="{{s_contact_name}}"
							disabled
						/>
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">휴대폰</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{s_tel}}" disabled />
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">이메일</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{s_email}}" disabled />
					</div>
				</div>
			</div>

			<div class="info-line-block"></div>

			<div class="display-flex mb-10">
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">포인트</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{point}}" disabled />
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">서비스포인트</div>
						</div>
						<input
							type="text"
							class="form-control daterange-cus"
							value="{{service_point}}"
							disabled
						/>
					</div>
				</div>
			</div>

			<div class="display-flex mb-10">
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">자동분배</div>
						</div>
						<input type="text" class="form-control daterange-cus" value="{{auto_match}}" disabled />
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">분배</div>
						</div>
						<input
							type="text"
							class="form-control daterange-cus"
							value="{{s_share_flag}}"
							disabled
						/>
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">분배갯수</div>
						</div>
						<input
							type="text"
							class="form-control daterange-cus"
							value="{{s_share_cnt}}"
							disabled
						/>
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">일분배갯수</div>
						</div>
						<input
							type="text"
							class="form-control daterange-cus"
							value="{{s_share_day_cnt}}"
							disabled
						/>
					</div>
				</div>
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">마감갯수</div>
						</div>
						<input
							type="text"
							class="form-control daterange-cus"
							value="{{flat_staff_close_day}}"
							disabled
						/>
					</div>
				</div>
			</div>

			<div class="info-line-block"></div>

			<div class="display-flex mb-10">
				<div class="plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">이사종류</div>
						</div>
						<div class="tags-line">
							{{#each sclassify}}
							<span class="tag">{{this}}</span>
							{{/each}}
						</div>
					</div>
				</div>
				<div class="plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">장비</div>
						</div>
						<div class="tags-line">
							{{#each equipments_arr}}
							<span class="tag {{#if ( lt cnt 1 ) }}bg-secondary{{/if}}">{{name}} {{cnt}}대</span>
							{{/each}}
						</div>
					</div>
				</div>
			</div>

			<div class="display-flex mb-10">
				<div class="col plr-50">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">지역구분</div>
						</div>
						<input
							type="text"
							class="form-control daterange-cus"
							value="{{s_gubun_name}}"
							disabled
						/>
					</div>
				</div>
				<div class="col plr-50" style="flex-grow: 4;">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">가능지역</div>
						</div>
						<div class="tags-line scrollable">
							{{#each s_city_arr}} {{#if (checknotempty this) }}
							<span class="tag info">{{this}}</span>
							{{/if}} {{/each}}
						</div>
					</div>
				</div>
			</div>

			<div class="info-line-block"></div>

			<div class="display-flex mb-10">
				<div class="col plr-50 memo-block">
					<label class="d-block">메모</label>
					{{#each note_arr}} {{#if (checknotempty this) }}
					<div>
						{{this}}
					</div>
					{{/if}} {{/each}}
				</div>
			</div>

			<div class="info-line-block"></div>

			<div class="display-flex mb-10">
				<div class="col plr-50 memo-block">
					<label class="d-block">대표사진</label>
					<div>
						<div class="gallery none gallery-md">
							{{#each s_mobile_img0}}
							<div
								class="gallery-item"
								data-image="http://24auction.co.kr/data/{{file_name_real}}"
								data-title="Image 1"
								href="http://24auction.co.kr/data/{{file_name_real}}"
								title="Image 1"
								style="background-image: url('http://24auction.co.kr/data/{{file_name_real}}');"
							></div>
							{{/each}}
						</div>
					</div>
				</div>
				<div class="col plr-50 memo-block">
					<label class="d-block">사업자등록증</label>
					<div>
						<div class="gallery none gallery-md">
							{{#each s_mobile_img1}}
							<div
								class="gallery-item"
								data-image="http://24auction.co.kr/data/{{file_name_real}}"
								data-title="Image 1"
								href="http://24auction.co.kr/data/{{file_name_real}}"
								title="Image 1"
								style="background-image: url('http://24auction.co.kr/data/{{file_name_real}}');"
							></div>
							{{/each}}
						</div>
					</div>
				</div>
				<div class="col plr-50 memo-block">
					<label class="d-block">주선업허가증</label>
					<div>
						<div class="gallery none gallery-md">
							{{#each s_mobile_img2}}
							<div
								class="gallery-item"
								data-image="http://24auction.co.kr/data/{{file_name_real}}"
								data-title="Image 1"
								href="http://24auction.co.kr/data/{{file_name_real}}"
								title="Image 1"
								style="background-image: url('http://24auction.co.kr/data/{{file_name_real}}');"
							></div>
							{{/each}}
						</div>
					</div>
				</div>
			</div>

			<div class="info-line-block"></div>

			<div class="display-flex mb-10">
				<div class="col plr-50 memo-block">
					<span>업체설명</span>
					<div>
						{{nl2br s_mobile_memo}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</script>
<!-- / staff -->

<script  id="poststatus" type="text/template">
	<div class="buttons">
		{{#if (isEqual is_confirmed 'R') }}
			<span class="btn btn-sm btn-light btn-outline-info">상태 : 글 허용 대기중</span>
		{{/if}}
		{{#if (isEqual is_confirmed 'N') }}
			<span class="btn btn-sm btn-light btn-outline-info">상태 : 글 미허용</span>
		{{/if}}
		{{#if (isEqual is_confirmed 'Y') }}
			<span class="btn btn-sm btn-outline-info">상태 : 글 허용</span>
		{{/if}}

		{{#if (isEqual is_confirmed 'R') }}
			<span  class="btn btn-primary" onClick="changePost({{id}}, true)">글 허용</span>
			<span  class="btn btn-warning" onClick="changePost({{id}}, false)">글 미허용</span>
		{{/if}}
		{{#if (isEqual is_confirmed 'N') }}
			<span  class="btn btn-primary" onClick="changePost({{id}}, true)">글 허용으로 변경</span>
		{{/if}}
		{{#if (isEqual is_confirmed 'Y') }}
			<span  class="btn btn-warning" onClick="changePost({{id}}, false)">글 미허용으로 변경</span>
		{{/if}}
	</div>
</script>
<script id="commentline" type="text/template">
  <div class="new_post_comments_item">
    <div class="new_post_comment_staffinfo">
      <span class="ellipsis user-icon" onclick="viewStaffInfo( {{auction_staff_s_uid}})"><i class="far fa-address-card"></i> {{auction_staff_s_name}}</span>
    </div>
    <div class="new_post_comment_time">
      {{ created_at }}
    </div>
    <div class="new_post_comment_body">
      {{nl2br body }}
    </div>
    <div class="new_post_comment_status">
      <div class="new_post_comment_status_now">
        {{#if (isEqual is_confirmed 'Y') }}허용{{/if}}
        {{#if (isEqual is_confirmed 'N') }}미허용{{/if}}
        {{#if (isEqual is_confirmed 'R') }}대기중{{/if}}
      </div>
      <div class="new_post_comment_status_change">
        {{#if (isEqual is_confirmed 'Y') }}
          <span class="btn btn-warning btn-sm" onClick="denyComment({{id}}, this )">미허용하기</span>
        {{/if}}
        {{#if (isEqual is_confirmed 'N') }}
          <span class="btn btn-info btn-sm" onClick="confirmComment({{id}}, this )">허용하기</span>
        {{/if}}
        {{#if (isEqual is_confirmed 'R') }}
          <span class="btn btn-info btn-sm" onClick="confirmComment({{id}}, this )">허용하기</span>
          <span class="btn btn-warning btn-sm" onClick="denyComment({{id}}, this )">미허용하기</span>
        {{/if}}
      </div>
    </div>
  </div>

</script>
<script id="postmodal" type="text/template">
		<div class="post_title">
			{{ post.title }}
		</div>
		<div class="media-user text-right">
			<small class="text-muted"><span class="user-icon" onclick="viewUserInfo({{post.user_id}})">{{post.nickname}}</span> <span class="unser_info_line">{{post.created_at}}</span></small>
		</div>
		<div class="post_body">
			{{#if (isEqual config.html_use 'Y') }}
				{{{ post.body }}}
			{{/if}}

			{{#if (isNotEqual config.html_use 'Y') }}
				{{nl2br post.body }}
			{{/if}}

		</div>

<div class="gallery">
	{{#each post.files}}
  <div class="gallery-item" data-image="/community/storage{{url}}" data-title="Image 1" href="/community/storage{{url}}" title="Image 1" style="background-image: url(/community/storage{{url}});"></div>
		{{/each}}
</div>
<div class="postconfirmline" id="postconfirmline">

	<div class="buttons">
		{{#if (isEqual post.is_confirmed 'R') }}
			<span class="btn btn-sm btn-light btn-outline-info">상태 : 글 허용 대기중</span>
		{{/if}}
		{{#if (isEqual post.is_confirmed 'N') }}
			<span class="btn btn-sm btn-light btn-outline-info">상태 : 글 미허용</span>
		{{/if}}
		{{#if (isEqual post.is_confirmed 'Y') }}
			<span class="btn btn-sm btn-outline-info">상태 : 글 허용</span>
		{{/if}}

		{{#if (isEqual post.is_confirmed 'R') }}
			<span  class="btn btn-primary" onClick="changePost({{post.id}}, true)">글 허용</span>
			<span  class="btn btn-warning" onClick="changePost({{post.id}}, false)">글 미허용</span>
		{{/if}}
		{{#if (isEqual post.is_confirmed 'N') }}
			<span  class="btn btn-primary" onClick="changePost({{post.id}}, true)">글 허용으로 변경</span>
		{{/if}}
		{{#if (isEqual post.is_confirmed 'Y') }}
			<span  class="btn btn-warning" onClick="changePost({{post.id}}, false)">글 미허용으로 변경</span>
		{{/if}}
	</div>
</div>
		<h5>댓글</h5>

    <div class="new_post_comments">
      {{#each comments}}
      <div class="new_post_comments_item">
        <div class="new_post_comment_staffinfo">
          <span class="ellipsis user-icon" onclick="viewStaffInfo( {{auction_staff_s_uid}})"><i class="far fa-address-card"></i> {{auction_staff_s_name}}</span>
        </div>
        <div class="new_post_comment_time">
          {{ created_at }}
        </div>
        <div class="new_post_comment_body">
          {{nl2br body }}
        </div>
        <div class="new_post_comment_status">
          <div class="new_post_comment_status_now">
            {{#if (isEqual is_confirmed 'Y') }}허용{{/if}}
            {{#if (isEqual is_confirmed 'N') }}미허용{{/if}}
            {{#if (isEqual is_confirmed 'R') }}대기중{{/if}}
          </div>
          <div class="new_post_comment_status_change">
            {{#if (isEqual is_confirmed 'Y') }}
              <span class="btn btn-warning btn-sm" onClick="denyComment({{id}}, this )">미허용하기</span>
            {{/if}}
            {{#if (isEqual is_confirmed 'N') }}
              <span class="btn btn-info btn-sm" onClick="confirmComment({{id}}, this )">허용하기</span>
            {{/if}}
            {{#if (isEqual is_confirmed 'R') }}
              <span class="btn btn-info btn-sm" onClick="confirmComment({{id}}, this )">허용하기</span>
              <span class="btn btn-warning btn-sm" onClick="denyComment({{id}}, this )">미허용하기</span>
            {{/if}}
          </div>
        </div>
      </div>
      {{/each}}
    </div>
</script>
@endverbatim

@endsection
