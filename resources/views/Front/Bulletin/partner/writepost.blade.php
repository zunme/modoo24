@extends('layouts.modoo')
@section('body_bottom','')

@section('css')
<style>
.bmd-form-group .form-control, .bmd-form-group label, .bmd-form-group input::placeholder {
    line-height: 1.2;
}
.pt-10{padding-top:10px;}
.pt-20{padding-top:20px;}
.mt-10{		margin-top:10px !important;	}
.mt-20{		margin-top:20px !important;	}
	.mt-0{		margin-top:0px !important;	}
	.mb-0{		margin-bottom:0px !important;	}
.hide , .hidden {display:none !important}
	.ellipsis {
		width: 100%;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
	.display-inline-block{
		display: inline-block;
	}
	.display-block{
		display: block !important;
	}
.page-header.page-header-small {
	min-height: 200px;
	max-height: 350px;
	height: 60vh;
}
	.display-flex{
		display: flex;
	}
	.justify-space-between{
		justify-content: space-between;
	}
	.justify-content-flex-end{
		justify-content: flex-end;
	}
  .justify-content-flex-around{
    justify-content: space-around;
  }
	.navbar .navbar-nav .nav-link:not(.btn) {
	padding: .3rem .6rem;
	}
	.forline2{
				width: 100%;
	display: flex;
	flex-direction: column;
	}
	.menu-side-line{
		line-height: 36px;
	font-size: 18px;
	color: #8888bf;
	}
	.border-top-default{
		border-top: 1px solid #eee;
	}
.btn-white {
	background-color: #fff;
	color: #666;
border: 1px solid #2ca8ff;
}
.btn-white:hover{
	background-color: #d9e9f5 !important;
	color: #5d5d5d !important;
	border-color: #d9e9f5 !important;
}


	.modal .modal-login .card-login .logo-container {
	margin-bottom: 0px;
	}
	.modal .modal-login {
			max-width: 360px;
	}
	.force-login-btn{
				line-height: 90px;
	margin: 0;
	background-color: #fa7347;
	color: white;
	}
  .visual6{background: url(/NEW/image/sub/visual6.jpg) center top no-repeat; height:254px; text-align: center;}
  .visual6 h1{ font-size: 40px; color: #000; padding-top:95px; font-weight:bold;}
  .visual6 h4{color: #747474; }
  @media only screen and (max-width: 959px) {
    .visual6{background: url(/NEW/image/sub/visual6_m.jpg) right top no-repeat; height: 230px;background-size: cover}
    .visual6 h1{font-size: 1.5em;padding-top:90px; font-family: 'GmarketSansMedium';}
  }
  .sub_menu{background: #f9f9f9; ;width: 100%;padding: 20px 0;
    overflow: hidden;}
  .sub_menu ul{width: 900px;text-align: center}
  .sub_menu ul li{width: calc((100% - 20px)/4);float: left;line-height: 30px; font-family:'GmarketSansBold';cursor: pointer;transform: rotate(-0.03deg);}
  .sub_menu ul .on{color: #2083ff!important}
  .sub_menu ul li:hover{color: #2083ff}
  .sub_menu ul .h_icon{background: url(/NEW/image/sub/icon_sm.png) center top no-repeat; width: 30px; height: 30px;margin-right: 100px }

  .btn-danger:hover , .btn-success:hover {
    /* background-color: #c12e2a; */
    background-position: inherit;
  }
  .btn-success{
    background-image: -webkit-linear-gradient(top,#00beff 0,#62a9c1 100%);
    background-image: -o-linear-gradient(top,#00beff 0,#62a9c1 100%);
    background-image: -webkit-gradient(linear,left top,left bottom,from(#00beff),to(#62a9c1));
    background-image: linear-gradient(to bottom,#00beff 0,#62a9c1 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00beff', endColorstr='#62a9c1', GradientType=0);
    filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
    background-repeat: repeat-x;
    border-color: #00beff;
  }
  .btn.btn-success {
      color: #fff;
      background-color: #00beff;
      border-color: #00beff;
      box-shadow: 0 2px 2px 0 rgb(0 190 240 / 14%), 0 3px 1px -2px rgb(0 190 255 / 20%), 0 1px 5px 0 rgb(0 190 255 / 12%);
  }
  .btn.btn-success:focus, .btn.btn-success:active, .btn.btn-success:hover {
    box-shadow: 0 14px 26px -12px rgb(108 198 229), 0 4px 23px 0px rgb(0 0 0 / 12%), 0 8px 10px -5px rgb(108 198 229);
  }
  .btn.btn-success:focus, .btn.btn-success.focus, .btn.btn-success:hover {
      color: #fff;
      background-color: #6cc6e5;
      border-color: #6cc6e5;
  }
  .sub-title {
      font-size: 14px;
      color: #666;
  }
</style>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<!-- Core build with no theme, formatting, non-essential modules -->
<link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
<script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>

<style>
	.writeform{
		    margin: 40px 10px 80px;
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
		padding-top: 8px;
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
	    width: 20px;
	    height: 20px;
}
	.imgprevbox .thumbnail {
		min-height:110px;
		max-width:134px;
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
.sel-img-desc{
    font-size: 12px;
    color: #666;
    padding-top: 10px;
}

</style>
@endsection

@section('content')

<div class="sub-header-wrap">
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
</div>

<section class="container">

  <div class="text-center mt-20">
		<h3 class="title">{{$config->title}}</h3>
    <div class="sub-title mt-10">?????????????????? ?????? ?????? ????????? ???????????? ????????????????????? ????????? ????????????.</div>
	</div>

	<div class="writeform">
		<form encType="multipart/form-data" id="writeform">

      <div class="row">
        <div class="col-md-1 col-sm-2">
          <span class="label_aread inp-text">?????????</span>
        </div>
        <div class="col-md-11 col-sm-10">
          <input type="text" class="form-control" value=" {{Auth::user()->nickname}}" disabled>
        </div>
      </div>

			<div class="row mt-10">
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

      <div class="row mt-10">
        <div class="col-md-1 col-sm-2">
        </div>
        <div class="col-md-7 col-sm-10">
          <div class="sel-img-desc">
            - ?????? ????????? ????????? ????????????.<br>
            - JPG, PNG ????????? ????????? ????????? ??? ????????????.<br>
            ??? ????????? ???????????? 3MB ?????? / 5??? ?????? ????????? ??????
          </div>
        </div>
        <div class="col-md-4 col-sm-12 text-right">
          <span class="btn btn-raised btn-outline-info" onClick="addImage()">
            Select image
          </span>
        </div>
      </div>

			<div class="row mt-10">
				<div class="col-md-1 col-sm-2">
				</div>
				<div class="col-md-11 col-sm-10">
					<div class="row" id="pvev_area">

						@foreach( $post->files as $file )
						<div class="imgprevcol">
							<div class="imgprevbox img-raised">
								<i class="remove_file_btn fas fa-times ui-1_simple-remove" data-id="{{$file->id}}" onclick="removeOrgFile(this)"></i>
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


							<i class="remove_file_btn fas fa-times ui-1_simple-remove" data-num="{{ inpCnt }}" onClick="removeFile(this)"></i>


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
								text : '???????????? ????????? ??????????????? ?????? ??????????????? ?????? ?????? ??? ?????? ?????????. ',
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
