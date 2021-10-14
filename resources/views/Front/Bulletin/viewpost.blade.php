@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/NEW/css/community.css" />
<style>
span.like, a.like{
	position: relative;
	overflow: hidden;
}
span.like > div {
	    margin: 0 !important;
}
.notloading > img {
	width: 47px;
}
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
}
.loaderWrap > .loaderWrapInner{
	    margin: 0 !important;
}
.loadersvg{
	width: 99%;height: 99%;margin: auto;
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
</style>
@endsection

@section('body_bottom','')



@section('content')
<!--common_visual-->
<div class="visual6">
    <h1>{{$config->title}}</h1>
    <h4>{{$config->sub_title}}</h4>
</div><!--//common_visual-->


<div class="sub_menu">
    <ul class="center">
        <li class="h_icon gotohome"></li>
        <li class="on">{{$config->title}}</li>
    </ul>
</div>

<form id="form_submit">
    <input name="cmd" type="hidden" value="write_proc" />

    <div class="center">
        <div id="knows_form">
            <h2 class="cop_title" style="margin-bottom: 5px;">이사지식인</h2>
            <h4 class="cop_title_s" style="margin-top: 0px;">이사지식인에 답변은 모두이사 파트너 업체에서 답변 드립니다.
            </h4>
            <div class="tbBox" style="margin-top: 10px;">
                <table class="rwd_table">
                    <tbody>
                        <tr class="title">
                            <th><span class="red_cic"></span>제목</th>
                            <td data-th="제목" colspan="3">
                                {{$post->title}}
																@if( $post->is_confirmed =='R')
			                          <span>(등록 대기중)</span>
			                          @endif

                            </td>
                        </tr>
                        <tr>
                            <th class="knowtitle" ><span class="red_cic"></span>글쓴이 </th>
                            <td class="knowtxt" data-th="닉네임" >
                                {{$post->nickname}}
                            </td>
                            <th class="knowtitle"><span class="red_cic"></span>작성일</th>
                            <td data-th="작성일" class="knowtxt" >
                                {{$post->created_at}}
                            </td>
                        </tr>
                        <tr>
                            <th><span class="red_cic"></span>내용</th>
                            <td data-th="내용" colspan="3">
															@if ( $config->html_use =='Y')
																{!! $post->body !!}
															@else
																{!! nl2br(e($post->body)) !!}
															@endif
                            </td>
                        </tr>
												@if( $post->is_confirmed =='R')
                        <tr class="waiting">
                            <th><span class="red_cic"></span>등록 대기중</th>
                            <td data-th="등록대기중" colspan="3">
                               회원님의 글은 답변을 위해 이사지식인 규정 확인 후 노출 됩니다.
                            </td>
                        </tr>
												 @endif
@if( count($post->files)>0 )
                        <tr>
                            <th>이미지보기</th>
                            <td data-th="이미지등록" colspan="3" id="add_area" class="font085">
	@foreach ( $post->files as $idx=>$file)
                                <div class="col-xs-5 col-md-3">
                                   <a href="/community/storage/{{$file->url}}" data-lightbox="photos" class="thumbnail">
                                       <img data-src="holder.js/100%x180" alt="100%x180" src="/community{{ Config::get('site.imageUrl') }}/thumb{{$file->url}}" data-holder-rendered="true" >
                                   </a>
                                   <p>
                                       {{$file->original_name}}
                                   </p>
                               </div>
	@endforeach
                            </td>
                        </tr>
@endif
@if( $post->comments && $post->comments->count() > 0 )
	@foreach ( $post->comments as $comment)
											<tr>
													<td data-th="댓글" colspan="4" class="know_replybg">
															<div class="know_reply">
																	<div class="partner">
																			<h2>{{$comment->s_company}}</h2>
																			<!-- 이사 업체 사진이 없을 경우 클랙스 park_img에서 출력되는 배경이미지 노출 -->
																			<div class="part_img">
																				<!-- 이사 업체 사진이 있을 경우 figure img 안에서 이미지 배치 -->
																				<figure>
																					@php
																						$imgarr = json_decode( $comment->s_mobile_img0);
																					@endphp

																					@if( !$imgarr)
																						<!--img src="http://24auction.co.kr/image/sub/basic.png" alt="Partner company"-->
																					@elseif( isset($imgarr[0]->file_name_real) && $imgarr[0]->file_name_real != '')
																						<img src="http://24auction.co.kr/data/{{$imgarr[0]->file_name_real}}" alt="Partner company">
																					@else
																						<!--img src="http://24auction.co.kr/image/sub/basic.png" alt="Partner company"-->
																					@endif
																				</figure>
																			</div>
																	</div>
																	<div class="text">

																			<p>
																				@if( $comment->is_confirmed == 'Y')
																					{!! nl2br(e($comment->body)) !!}
																				@else
																				<span ckass="confirm_waiting">이사지식인 답글은 고객과의 분쟁 방지를 위해 이사지식인 규정 확인 후 노출됩니다.</span>
																				@endif
																			</p>
																	</div>
																	@if( $comment->is_confirmed == 'Y')
																		<a class="like" data-commentid = "{{$comment->id}}" onClick="addFavCnt(this)">
                                       <img src="/NEW/image/sub/know_icon_heart.png">
                                        <span class="favcnt">공감 {{$comment->best_cnt}}</span>
                                    </a>
																	@endif
															</div>
													</td>
											</tr>
	@endforeach
@endif
                    </tbody>
                </table>
                <div>
                    <div style="display: inline-block"><a type="button"  class="button_blue" href="{{ Config::get('site.defaultStartUrl') }}/posts/{{$code}}" >목록</a></div>
                    <ul class="btn_3set">
											@if ( $is_writer)
                        <li><a type="button"  class="button_blue button_gray" href="{{ Config::get('site.defaultStartUrl') }}/posts/{{$code}}/update/{{$post->id}}">수정</a></li>
													@if ( count($post->comments) == 0 )
                        		<li><button type="button"  class="button_blue button_gray" onClick="delpost({{$post->id}})" >삭제</button></li>
													@endif
											@endif
                        <li><button type="button"  class="button_blue"  onclick="location.href='{{ Config::get('site.defaultStartUrl') }}/posts/{{$code}}/write' " >질문하기</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection




@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

<script>
	var comment_write_prc = true;
	var test
	$("document").ready( function() {
		loaderAttach("a.like")
	})
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
/*
	function addBestCnt(tbtn){
		let url = "{{ Config::get('site.defaultStartUrl') }}/posts/comment/addbestcnt"
		let notloading = $(btn).children(".notloading")
		let loading = $(btn).children(".loading")
		if ( $(notloading).hasClass("hide") ) return;
		$(notloading).addClass("hide");
		$(loading).removeClass("hide");
		let id = $(btn).data('commentid');
		return;
		addcnt(id, url ,notloading, loading, btn )
	}
*/
	function addFavCnt (btn){
		//let url = "{{ Config::get('site.defaultStartUrl') }}/posts/comment/addfavcnt"
		let url = "{{ Config::get('site.defaultStartUrl') }}/posts/comment/addbestcntV2"
		let notloading = $(btn).children(".notloading")
		let loading = $(btn).children(".loading")
		if ( !$(loading).hasClass("hide") ) return;
		$(loading).removeClass("hide");
		let id = $(btn).data('commentid');
		addcnt(id, url ,notloading, loading,btn )
	}
	function loaderAttach(target,on) {
	if( on == false ){
		$(target).children(".loaderWrap").slideUp(500).remove()
		return;
	}
	let loader = `<div class="loaderWrap loading hide"><div class="loaderWrapInner">
<svg class="loadersvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
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
`
	$(target).append(loader);
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
								$(btn).children('.favcnt').text( "공감 " + res.data.cnt )
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
