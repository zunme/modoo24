@extends('layouts.modoo')
@section('body_bottom','')

@section('css')
<link rel="stylesheet" type="text/css" href="/v1/css/community.css" />

<!-- Theme included stylesheets -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />

<link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css" />
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<!-- Core build with no theme, formatting, non-essential modules -->
<link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
<script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>

<style>

.header-title-wrap {
    margin: 40px 10px 40px;
}
.body-inner{
	position: relative;
}
.ql-editor {
  min-height: 200px;
}
#writeform > .row.form-row{
	margin-bottom:10px;
	padding-top:10px;
	padding-bottom:10px;
	position: relative;
}
.round-box{
	margin: 10px;
  border-radius: 10px;
  border: 1px solid #ddd;
  padding: 40px;
  color: #999; font-size: .9em;
}
.round-box-header{font-weight: bold; margin-bottom: 6px}
.round-box-body{font-size: .8em;line-height: 20px;}
.nickname-input .input-group-text{
	display: flex;
    justify-content: flex-end;
    flex-wrap: nowrap;
    overflow: hidden;
    color: #999;
    font-size: .9em;
}
</style>
@endsection

@section('content')

<section class="container">
	<div class="container-inner">
		<div class="header-title-wrap text-center">
			<h3 class="title">{{$config->title}} 글쓰기</h3>
		</div>
		<div class="body-wrap">
			<div class="body-inner">
				<form id="writeform">
					<input type="hidden" name="code" value="{{$code}}" >
					<input type="hidden" name="id" value="{{$post->id}}" >

<!-- 주소 선택 알맞은 위치에 넣어주세요 -->
@if ( $config->address_use =='Y')
					<div class="">
						<select name="si_code" onChange="getGuGun()" id="sel_sido">
							<option val=''>지역</option>
							@foreach( $address as $row)
							<option value='{{$row->si_code}}'
								@if ( $post->address && $post->address->si_code == $row->si_code)
								selected
								@endif >{{$row->sido}}</option>
							@endforeach
						</select>
						<select name="gu_code" id="sel_gu_code">
							<option val=''>군/구</option>
						</select>
					</div>
@endif
<!-- / 주소선택 -->

					<div class="row form-row after-line">
						<div class="col-md-8">
								<span class="bmd-form-group">
									<div class="input-group title-input">
                    <div class="input-group-prepend ">
                      <span class="input-group-text">
                        제목
                      </span>
                    </div>
                    <input type="text" placeholder="제목을 적어주세요" name="title" value="{{$post->title}}" class="form-control">
                	</div>
								</span>
						</div>
						<div class="col-md-4">
							<div class="nickname-input">
								<!--span class="input-group-text d-lg-flex d-md-none d-sm-flex">
									닉네임
								</span-->
								<span class="input-group-text">{{Auth::user()->nickname}}</span>
							</div>

						</div>
					</div>

					<div class="row form-row">
						<div class="col-sm-12">
							@if( $config->html_use =='Y' )
							<div class="editor_wrap">
									<div id="standalone-container">
										<div id="toolbar-container">
											<span class="ql-formats">
												<!--select class="ql-font"></select-->
												<select class="ql-size"></select>
											</span>
											<span class="ql-formats">
												<button class="ql-bold"></button>
												<button class="ql-italic"></button>
												<button class="ql-underline"></button>
												<button class="ql-strike"></button>
											</span>
											<span class="ql-formats">
												<select class="ql-color"></select>
												<select class="ql-background"></select>
											</span>
											<span class="ql-formats">
												<button class="ql-script" value="sub"></button>
												<button class="ql-script" value="super"></button>
											</span>
											<span class="ql-formats">
												<button class="ql-header" value="1"></button>
												<button class="ql-header" value="2"></button>
												<button class="ql-blockquote"></button>
												<button class="ql-code-block"></button>
											</span>
											<span class="ql-formats">
												<button class="ql-list" value="ordered"></button>
												<button class="ql-list" value="bullet"></button>
												<button class="ql-indent" value="-1"></button>
												<button class="ql-indent" value="+1"></button>
											</span>
											<span class="ql-formats">
												<button class="ql-direction" value="rtl"></button>
												<select class="ql-align"></select>
											</span>
											<span class="ql-formats">
												<button class="ql-link"></button>
												<button class="ql-image"></button>
												<button class="ql-video"></button>
												<button class="ql-formula"></button>
											</span>
											<span class="ql-formats">
												<button class="ql-clean"></button>
											</span>
										</div>
										<div id="editor_content">
												{!! $post->body !!}
										</div>
									</div>
							</div>
							@else
							<textarea name="body" class="form-control" placeholder="아래와 같은 글에 대해서는 관리책임자가 게시자 본인에게 통보 없이 삭제됨을 알려드립니다.&#13;&#10;1) (주)모두플랫폼과 무관한 서비스 또는 악의적 논쟁을 포함한 글&#13;&#10;2) 타인의 개인정보를 동의 없이 무단으로 게시한 글&#13;&#10;3) 게시판의 용도에 맞지 않는 광고성 글&#13;&#10;4) 욕설 또는 음란한 내용을 포함하고 있는 글&#13;&#10;5) 동일한 내용의 반복성 글&#13;&#10;6) 저작권을 침해할 수 있는 내용 &#13;&#10;7) 주제와 다른 내용의 글" rows="12">{!! nl2br(e($post->body)) !!}</textarea>
							@endif
						</div>
					</div>

				</form>
			</div>
			<div class="body-footer">
				<div class="row form-row">
					<div class="col-sm-12 text-center">
						<span class="btn btn-cancel" onClick="write_cancel()">취소</span>
						<span class="btn btn-reg" onClick="write_prc()" style="background:#1e9af9">등록</span>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-wrap">
			<div class="footer-inner">
				<div class="notice round-box">
					<div calss="round-box-inner">
						<div class="round-box-header">
							알림사항 Notice
						</div>
						<div class="round-box-body">
							<p>아래와 같은 글에 대해서는 관리책임자가 게시자 본인에게 통보 없이 삭제됨을 알려드립니다.</p>
							<p>1) (주)모두플랫폼과 무관한 서비스 또는 악의적 논쟁을 포함한 글</p>
							<p>2) 타인의 개인정보를 동의 없이 무단으로 게시한 글</p>
							<p>3) 게시판의 용도에 맞지 않는 광고성 글</p>
							<p>4) 욕설 또는 음란한 내용을 포함하고 있는 글</p>
							<p>5) 동일한 내용의 반복성 글</p>
							<p>6) 저작권을 침해할 수 있는 내용</p>
							<p>7) 주제와 다른 내용의 글</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="/community/assets/js/image-resize.min.js"></script>
<script src="https://unpkg.com/quill-html-edit-button@2.2.7/dist/quill.htmlEditButton.min.js"></script>

<script>
	var editor;
	totalImgCnt = {{$totalImgCount}}

	@if( $config->html_use =='Y' )
	$("document").ready( function() {
		var FontAttributor = Quill.import('attributors/class/font');
		FontAttributor.whitelist = [
		  'sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'
		];
		Quill.register(FontAttributor, true);
    Quill.register({"modules/htmlEditButton": htmlEditButton})
	editor = new Quill('#editor_content', {
			modules: {
				syntax: true,
				toolbar: '#toolbar-container',
				imageResize: {},
        htmlEditButton: { debug: true, syntax: true },
			},
			placeholder: '글을 작성해주세요',
			theme: 'snow'
		});
	});
	@endif

	function write_cancel(){

		swal.fire({
			title : '글 등록을 취소합니다.',
			html : '작성중인 글이 모두 삭제됩니다.<br>글 등록을 취소하시겠습니까?',
			icon: 'warning',
			showCancelButton : true,
			confirmButtonClass : "btn-danger",
			confirmButtonText : "예",
			cancelButtonText : "아니오",
		}).then((result) => {
			if (result.isConfirmed) return location.replace("{{ Config::get('site.defaultStartUrl') }}/posts/{{$code}}");
			else return false;
	});
	}

	function write_prc() {
		var url = '{{ Config::get('site.defaultStartUrl') }}/posts/create'
		var form = 'writeform'
		var body = editor.root.innerHTML
		if ( body == "<p><br></p>"){
			iziToast.show({
          theme: 'dark',
          message: '글을 작성해주세요',
          position: 'center'
      });
			return;
		}
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
									컨펌사용시
								*/
								//location.replace('/community/posts/{{$code}}')
								@if( $config->use_confirm =='Y' )
								swal.fire({
									title : '글이 등록 되었습니다.',
									text : '회원님이 남기신 글은 모두이사 커뮤니티 규정 확인 후 노출됩니다.',
									icon : "success",
									showCancelButton : false,
									confirmButtonClass : "btn-danger",
									confirmButtonText : "확인",
									cancelButtonText : "아니오",
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
	function getGuGun(gucode){
		let sido = $("#sel_sido option:selected").val()
		$("#sel_gu_code").empty().append('<option value="">군/구 선택</option>')

		if ( sido =='') return;

		$.ajax({
			url : '/community/api/gugun?si_code='+ sido,
			method:"get",
			dataType:'JSON',
			success:function(result){
				result.forEach( function (data, idx){
					if( gucode == data.gu_code) $("#sel_gu_code").append(`<option value="${data.gu_code}" selected>${data.gu}</option>`)
					else $("#sel_gu_code").append(`<option value="${data.gu_code}">${data.gu}</option>`)
				})
			}
		});
	}
	@if ( $post->address)
	$("document").ready( function() {
		getGuGun("{{$post->address->gu_code}}")
	})
	@endif
</script>
@endsection
