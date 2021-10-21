@extends('layouts.postnow')
@section ('title', $config->title)
@section ('backgroundimage', $config->backgroundimage)

@section('css')
<style>

	.main > section.container > .qna_wrap{
		padding: 20px 10px 10px;
    border-radius: 10px;
    background-color: #EEE;
    /* border: 1px solid #eee; */
    box-shadow: 0 3px 8px 0 rgb(0 0 0 / 17%);
		margin-bottom: 30px;
	}
	.unser_info_line:before {
    display: inline-block;
    content: '';
    width: 2px;
    height: 2px;
    margin: 9px 6px 0 4px;
    background-color: #aaa;
    vertical-align: top;
}
	.media-user{
    margin-bottom: 20px;
    border-bottom: 1px solid #d1d1d1;
    padding-bottom: 10px;
	}
	.media-files{
		padding: 10px 15px;
    margin-top: 20px;
    border-top: 1px solid rgb(44 168 255 / 22%);
	}
	.media-files > .item {
    height: 105px;
    width: 110px;
    margin-top: 5px;
		margin-right: 10px;
	}
	.item > a {
		padding: 2px;
    display: block;
    border: 1px solid #eee;
    border-radius: 5px;
    background-color: azure !important;
	}
	.image-col-bg{
		width:100px;height:100px;background-size:contain !important;margin: auto;
	}
	.letter-icon{
		line-height: 38px !important;
    font-weight: 800;
	}
	.bottom-line{
		border-bottom: 1px solid #f9633257;
    /*margin-bottom: 30px;*/
	}
	.write_comment_wrap{
		padding:20px;
	}
	.write_comment_inner{
		padding: 20px 20px 0;
    background-color: #eee;
    border-radius: 15px;
	}

	.comment_wrap{
    margin-top: 20px;
    border-top: 1px solid #b0b0d5;
    padding-top: 30px;
	}
	.comment_inner{
		margin: 5px 5px;
	}
	.comment_row{
    padding: 5px 5px 10px 15px;
    border-bottom: 1px solid #e5d4d4;
    margin: 5px 5px 10px;
	}
	.comment_row:last-child {
		border-bottom:none;
	}
	.comment_row > div {
		padding-top: 5px;
    padding-bottom: 5px;
	}
	.comment_row.disabled{
		color : #AAA !important;
	}
	.favBestClass{
		font-size:0.6em !important;
	}
</style>
@endsection

@section('content')
<section class="container">
	<div class="text-center mt-20">
		<h3 class="title">{{$config->title}}</h3>
	</div>
	<div class="qna_wrap">
		<div class="qna_inner">
			<div class="question_wrap">
				<div class="question_inner">

					<!-- question -->
								<div class="media">
										<a class="pull-left" href="#pablo">
											<div class="avatar">
												<span class="btn btn-info btn-icon btn-round letter-icon">Q</span>
											</div>
										</a>
										<div class="media-body">
											<h5 class="media-heading">
												{{$post->title}}
											</h5>
											<div class="media-user text-right">
												<small class="text-muted"><span>{{$post->nickname}}</span> <span class="unser_info_line">{{$post->created_at}}</span></small>
											</div>
											<div class="media-body">
												@if ( $config->html_use =='Y')
													{!! $post->body !!}
												@else
													{!! nl2br(e($post->body)) !!}
												@endif

											</div>
											@if( count($post->files)>0 )
											<div class="media-files row">
												@foreach ( $post->files as $idx=>$file)
													  <div class="image-col item">
															<!--img src="/community{{$file->url}}" onclick="openModal();currentSlide({{$idx}})" class="hover-shadow"-->
															<a href="/community/storage/{{$file->url}}" data-lightbox="photos">
																<div class="image-col-bg" style="background: url(/community{{ Config::get('site.imageUrl') }}/thumb{{$file->url}}) no-repeat center center ;" >
																</div>
															</a>
														</div>
												@endforeach
											</div>

											@endif
											<div class="media-footer">
												<!--a href="#pablo" class="btn btn-primary btn-neutral pull-right" rel="tooltip" title="" data-original-title="Reply to Comment">
													<i class="now-ui-icons ui-1_send"></i> Reply
												</a-->
												<span class="btn btn-danger btn-neutral pull-right">
													<i class="now-ui-icons ui-2_favourite-28"></i> {{$post->fav_cnt}}
												</span>
											</div>
											<div class="media-footer">
												<div>
													<a class="btn btn-info pull-right" href="{{ Config::get('site.defaultStartUrl') }}/posts/{{$code}}">
														<i class="now-ui-icons education_paper"></i> 글목록가기
													</a>
													@if ( $is_writer)
													<a class="btn btn-info pull-right" href="{{ Config::get('site.defaultStartUrl') }}/posts/{{$code}}/update/{{$post->id}}">
														<i class="now-ui-icons education_paper"></i> 글수정
													</a>
														@if ( count($post->comments) == 0 )
															<span class="btn btn-info pull-right" onClick="delpost({{$post->id}})">
																<i class="now-ui-icons education_paper"></i> 글삭제
															</span>
														@endif
													@endif

												</div>
											</div>
										</div>
								</div>
					<!-- / question -->

				</div>
			</div>
			@if( $post->comments && $post->comments->count() > 0 )
			<div class="comment_wrap">
				<h6>
					댓글
				</h6>
				<div class="comment_inner">
					@foreach ( $post->comments as $comment)

					<div class="comment_row row @if( $comment->is_confirmed != 'Y') disabled @endif">
						<div class="col-md-2 col-sm-12 text-right">
							<div class="ellipsis auction_staff_name">
								{{$comment->s_name}}
							</div>
							@if( $comment->is_confirmed == 'Y')
							<span class="favBestClass btn btn-primary btn-sm" data-commentid = "{{$comment->id}}" onClick="addBestCnt(this)">
								<div class="notloading">
									<i class="now-ui-icons ui-2_like"></i>BEST <span class="favcnt">{{$comment->best_cnt}}</span>
								</div>
								<div class="loading hide">
									<i class="now-ui-icons loader_refresh spin"></i>
								</div>
							</span>
							@else
							<span class="favBestClass btn btn-default btn-sm">
								<i class="now-ui-icons ui-2_like"></i>BEST <span class="favcnt">{{$comment->best_cnt}}</span>
							</span>
							@endif
						</div>
						<div class="col">
							@if( $comment->is_confirmed == 'Y')
							{!! nl2br(e($comment->body)) !!}
							@else
							<span ckass="confirm_waiting">관리자가 답변을 확인한 후에 보입니다..</span>
							@endif
						</div>
						<div class="col-md-2 col-sm-12 text-right favClass">
							@if( $comment->is_confirmed == 'Y')
							<span class="text-center btn btn-info"  data-commentid = "{{$comment->id}}" onClick="addFavCnt(this)">
								<div class="notloading">
									<i class="now-ui-icons ui-2_favourite-28"></i>
									<br>업체공감 <span class="favcnt">{{$comment->fav_cnt}}</span>
								</div>
								<div class="loading hide">
									<i class="now-ui-icons loader_refresh spin"></i>
								</div>
							</span>
							@else
							<span class="text-center btn btn-default">
								<i class="now-ui-icons ui-2_favourite-28"></i>
								<br>업체공감 <span class="favcnt">{{$comment->fav_cnt}}</span>
							</span>
							@endif
						</div>
					</div>

					@endforeach
				</div>
			</div>
			@endif

			@if( Config::get('site.isPartnerSite') =='Y' )
			<div class="write_comment_wrap">
				<div class="write_comment_inner">
					<h6 class="text-center">답변 달기 <br><small class="text-muted">- Post your comment -</small></h6>
					<div class="media media-post">
							<div class="media-body">
								<form id="jisik_comment_form">
									<input type="hidden" name="code" value="{{$code}}">
									<input type="hidden" name="post_id" value="{{$post->id}}">
										<textarea class="form-control" name="body" placeholder="답변을 달아주세요..." rows="6"></textarea>
										<div class="media-footer">
											<span class="btn btn-primary btn-wd pull-right" onClick="jisikCommentPrc(this)">답변달기</span>
										</div>
								</form>
							</div>
					</div>
				</div>
			</div>
			@endif

		</div>
	</div>
</section>

@endsection

@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

<script>
	var comment_write_prc = true;
	var test
	function delpost(postid){
		swal.fire({
			title : '삭제',
			text : '작성하신 글을 삭제하시겠습니까?',
			icon: 'info',
			showCancelButton : true,

			confirmButtonText : "예",
			cancelButtonText : "아니오",
		}).then((result) => {
			if (result.isConfirmed) getpost( '{{ Config::get('site.defaultStartUrl') }}/posts/del', {id:postid}, callbackDel,callbackComplete);
			else return false;
		});
	}
	function callbackDel( res ){
		Swal.fire({
			position: 'top-center',
			icon: 'success',
			title: '글이 삭제되었습니다.',
			showConfirmButton: false,
			timer: 1500
		}).then((result) => {
			location.replace("{{ Config::get('site.defaultStartUrl') }}/posts/{{$code}}")
		})
	}
	function callbackComplete(){
	}
	function addBestCnt(btn){
		let url = "{{ Config::get('site.defaultStartUrl') }}/posts/comment/addbestcnt"
		let notloading = $(btn).children(".notloading")
		let loading = $(btn).children(".loading")
		if ( $(notloading).hasClass("hide") ) return;
		$(notloading).addClass("hide");
		$(loading).removeClass("hide");
		let id = $(btn).data('commentid');

		addcnt(id, url ,notloading, loading, btn )
	}

	function addFavCnt (btn){
		let url = "{{ Config::get('site.defaultStartUrl') }}/posts/comment/addfavcnt"
		let notloading = $(btn).children(".notloading")
		let loading = $(btn).children(".loading")
		if ( $(notloading).hasClass("hide") ) return;
		$(notloading).addClass("hide");
		$(loading).removeClass("hide");
		let id = $(btn).data('commentid');

		addcnt(id, url ,notloading, loading,btn )
	}
	function addcnt(id, url ,notloading, loading,btn ){

		$.ajax({
			url : '{{ Config::get('site.defaultStartUrl') }}/refresh',
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
						url: url,
						method:"POST",
						data:{id : id},
						dataType:'JSON',
						success:function(res)
						{

							if( res.status =='Success'){

								iziToast.success({
									message: res.message,
									position: 'bottomRight'
								});
								$(btn).children('.notloading').children('.favcnt').text( res.data.cnt )
								return;

							} else {
								iziToast.error({
									message: res.message,
									position: 'bottomRight'
								});
							}
						},
						error: function ( err ){
							ajaxErrorST(err)
						},
						complete : function() {
							comment_write_prc = true;
							setTimeout(()=>restoreLoading(notloading, loading ), 100)
						}
					});

			}, // end success
			complete : function() {
				comment_write_prc = true;
				setTimeout(()=>restoreLoading(notloading, loading ), 100)
			}
		});

	}
	function restoreLoading(notloading, loading ){
		$(loading).addClass("hide");
		$(notloading).removeClass("hide");
	}



	function jisikCommentPrc(btn){
		if( !comment_write_prc) {
			iziToast.error({
				message: "서버와 통신 중입니다.",
				position: 'topRight'
			});
			return;
		}
		else {
			$(btn).removeClass("btn-primary");
			comment_write_prc = false;
		}

		let data = $("jisik_comment_form").serialize();
		let form = 'jisik_comment_form'
		var url = '{{ Config::get('site.defaultStartUrl') }}/posts/comment/create'

		$.ajax({
							url : '{{ Config::get('site.defaultStartUrl') }}/refresh',
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
										url: url,
										method:"POST",
										data:new FormData( document.getElementById(form) ),
										dataType:'JSON',
										contentType: false,
										cache: false,
										processData: false,
										success:function(res)
										{

											if( res.status =='Success'){

												iziToast.success({
													message: "답변을 달았습니다.",
													position: 'bottomRight'
												});
												location.reload();
												return;

											} else {
												iziToast.error({
													message: "잠시후에 이용해주세요",
													position: 'bottomRight'
												});
											}
										},
										error: function ( err ){
											ajaxErrorST(err)
										},
										complete : function() {
											comment_write_prc = true;
											$(btn).addClass("btn-primary");
										}
									});

							}, // end success
							complete : function() {
								comment_write_prc = true;
								$(btn).addClass("btn-primary");
							}
						});
	}


</script>
@endsection
