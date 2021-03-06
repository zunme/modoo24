@extends('layouts.postnow')
@section ('title', $config->title)
@section ('backgroundimage', $config->backgroundimage)

@section('css')

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<!-- Core build with no theme, formatting, non-essential modules -->
<link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
<script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>

<style>
	.writeform{
		    margin: 20px 10px 80px;
	}
	.editor_wrap{
		height: 30vh;
    margin-bottom: 50px;
	}
	.label_aread{
		    padding-top: 12px;
    display: inline-block;
    font-size: 14px;
    color: #666;
    font-weight: 800;
	}
	.label_aread.inp-text{
		padding-top: 4px;
	}
	textarea.form-control {
    max-width: 100%;
    height: 180px;
		max-height:30vh;
	}
	.imgprevbox {
    padding: 10px;
    margin: 4px;
    border: 1px solid rgb(221 221 221 / 21%);
    border-radius: 5px;
    color: #666;
    background-color: #eee;
		position:relative;
	}
.remove_file_btn {
		position: absolute;
		right: 2px;
		top: 2px;
		outline: 0;
		padding: 4px 4px 4px 5px;
		border: 1px solid #dd4b39;
		background-color: #dd4b39;
		border-radius: 18px;
		box-sizing: border-box;
		color: white;
		opacity: .8;
		box-shadow: 1px 5px 2px 0 rgb(0 0 0 / 20%);
		cursor: pointer;
	font-size: 10px;
}
	.imgprevbox .thumbnail {
		min-height:100px;
		max-width:124px;
		margin: auto;
		text-align: center;
		margin-bottom : 10px;
	}
	.imgprevbox .thumbnail>img {
    max-width: 124px;
    max-height: 100px;
	}
	.thumbnail-title{
	    line-height: 1.8em;
			font-size: 0.91em;
			font-weight: 500;
			width: 120px;
	}
	.thumbnail-byte{
	    line-height: 1.8em;
			font-size: 0.8em;
			font-weight: 400;
			text-align:right;
	}
	.post_write_line{
		border-top: 1px solid rgb(153 153 153 / 18%);
    margin-top: 80px
	}
</style>
@endsection

@section('content')
<section class="container">
	<div class="text-center mt-20">
		<h3 class="title">{{$config->title}}</h3>
	</div>

	<div class="writeform">
		<form encType="multipart/form-data" id="writeform">
			<div class="row">
				<div class="col-md-1 col-sm-2">
					<span class="label_aread inp-text">??????</span>
				</div>
				<div class="col-md-11 col-sm-10">
					<input type="text" class="form-control" placeholder="????????? ???????????????" name="title" value="{{$post->title}}">
					<input type="hidden" name="code" value="{{$code}}" >
					<input type="hidden" name="id" value="{{$post->id}}" >
				</div>
			</div>

			<div class="row mt-10">
				<div class="col-md-1 col-sm-2">
					<span class="label_aread">??????</span>
				</div>
				<div class="col-md-11 col-sm-10">
					@if( $config->html_use =='Y' )
					<div class="editor_wrap" style="height: 30vh;">
						<div id="editor_content">
								{!! $post->body !!}
						</div>
					</div>
					@else
					<textarea name="body" class="form-control" placeholder="????????? ?????? ?????? ???????????? ?????????????????? ????????? ???????????? ?????? ?????? ???????????? ??????????????????.&#13;&#10;1) (???)?????????????????? ????????? ????????? ?????? ????????? ????????? ????????? ???&#13;&#10;2) ????????? ??????????????? ?????? ?????? ???????????? ????????? ???&#13;&#10;3) ???????????? ????????? ?????? ?????? ????????? ???&#13;&#10;4) ?????? ?????? ????????? ????????? ???????????? ?????? ???&#13;&#10;5) ????????? ????????? ????????? ???&#13;&#10;6) ???????????? ????????? ??? ?????? ??????" rows="10">{!! nl2br(e($post->body)) !!}</textarea>
					@endif
				</div>
			</div>


			<div class="display-flex justify-content-flex-end">
				<div class="display-flex pt-10">
					<div>
						<span class="btn btn-raised btn-outline-info" onClick="addImage()">
							Select image
						</span>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-1 col-sm-2">
				</div>
				<div class="col-md-11 col-sm-10">
					<div class="row" id="pvev_area">

						@foreach( $post->files as $file )
						<div class="imgprevcol">
							<div class="imgprevbox img-raised">
								<i class="remove_file_btn now-ui-icons ui-1_simple-remove" data-id="{{$file->id}}" onclick="removeOrgFile(this)"></i>
								<div class="thumbnail">
									<img src="/community/storage/thumb{{$file->url}}">
								</div>
								<div class="thumbnail-byte">{{ bytesToHuman($file->attach_size) }}</div>
								<div class="thumbnail-title ellipsis">{{$file->original_name}}</div>
							</div>
						</div>
						@endforeach

					</div>
				</div>
			</div>

			<div class="text-center pt-10 post_write_line">
				<button class="btn btn-danger" type="button" onClick="write_cancel()">??????</button>
				<button class="btn btn-success" type="button" onClick="write_prc()">??????</button>
			</div>

		</form>
	</div><!-- writeform-->

</section>

@verbatim
<script type="text/template" id="imgup_template">
					<div class="imgprevcol hide" id="upfile{{ inpCnt }}_col">
						<div class="imgprevbox img-raised">


							<i class="remove_file_btn now-ui-icons ui-1_simple-remove" data-num="{{ inpCnt }}" onClick="removeFile(this)"></i>


							<div class="thumbnail ">
								<img src="" alt="..."  id="upfile{{ inpCnt }}_preview">
							</div>
							<div class="thumbnail-byte" id="upfile{{ inpCnt }}_byte">
								byte
							</div>
							<div class="thumbnail-title ellipsis" id="upfile{{ inpCnt }}_filename">
								name
							</div>
							<input type="file" name="upload[]" class="hide" id="upfile{{ inpCnt }}_imp" onChange="readURL(this, 'upfile{{ inpCnt }}')"/>
						</div>
					</div>
</script>
@endverbatim

@endsection

@section('script')
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="/community/assets/js/image-resize.min.js"></script>

<script>
	var editor;
	totalImgCnt = {{$totalImgCount}}

	@if( $config->html_use =='Y' )
	$("document").ready( function() {
		editor = new Quill('#editor_content', {
				modules: {
					toolbar: [
						[{ header: [1, 2, 3, 4, 5, 6,  false] }],
						['bold', 'italic', 'underline','strike'],
						['image', 'code-block'],
						['link'],
						[{ 'script': 'sub'}, { 'script': 'super' }],
						[{ 'list': 'ordered'}, { 'list': 'bullet' }],
						['clean']
					],
					imageResize: {}
				},
				placeholder: 'Compose an epic...',
				theme: 'snow'  // or 'bubble'
			});
	})
	@endif
	let test
function removeOrgFile(btn) {
	let no = $(btn).data('id')
	$("#writeform").append("<input type='hidden' name='delfile[]' value='"+no+"'>")
	$(btn).closest('.imgprevcol').remove()
	totalImgCnt--;
}
function addImage() {
	if ( totalImgCnt >= 5 ){
		 iziToast.error({
				message: '5??? ?????? ???????????? ???????????????.',
				position: 'topRight'
			});
		return
	}
	++inpCnt;
	var inpdata = { inpCnt : inpCnt }
	var template = Handlebars.compile( $("#imgup_template" ).html() );
	$("#pvev_area").append( template(inpdata));
	$("#upfile" +inpCnt+ "_imp").trigger('click')
}
function write_cancel(){
 var msg = '?????? ????????? ????????? ?????????????????????????'
 var title ='?????? ??????';

	swal.fire({
		title : title,
		text : msg,
		icon: 'info',
		showCancelButton : true,
		confirmButtonClass : "btn-danger",
		confirmButtonText : "???",
		cancelButtonText : "?????????",
	}).then((result) => {
		if (result.isConfirmed) return location.replace("{{ Config::get('site.defaultStartUrl') }}/posts/{{$code}}");
		else return false;
});
}

function write_prc() {
	var url = '{{ Config::get('site.defaultStartUrl') }}/posts/create'
	var form = 'writeform'
	$(".imgprevcol.hide").remove()

	var data= new FormData( document.getElementById(form) );
	@if( $config->html_use =='Y' )
		data.set('body', editor.root.innerHTML)
	@endif

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
					data: data ,
					dataType:'JSON',
					contentType: false,
					cache: false,
					processData: false,
					success:function(res)
					{
						console.log (res)
						if( res.status !='Success'){
							iziToast.success({
								message: res.msg,
								position: 'bottomRight'
							});
							return;
						} else {

							/*
								TODO
								???????????????
							*/
							//location.replace('/community/posts/{{$code}}')
							@if( $config->use_confirm =='Y' )
							swal.fire({
								title : '?????????????????????.',
								text : '.....??? ????????? ',
								type : "warning",
								showCancelButton : false,
								confirmButtonClass : "btn-danger",
								confirmButtonText : "??????",
								cancelButtonText : "?????????",
							}).then((result) => {
								location.replace('/community/posts/{{$code}}')
							});
							@else
								location.replace('/community/posts/{{$code}}')
							@endif

						}
					},
					error: function ( err ){
						ajaxErrorST(err)
					}
				});

		} // end success
	});
}


</script>
@endsection
		
