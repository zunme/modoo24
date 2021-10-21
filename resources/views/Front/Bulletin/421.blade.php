@extends('layouts.postnow')
@section ('title', $config->title)
@section ('backgroundimage', $config->backgroundimage)

@section('css')
<style>
	footer.footer{
		position: fixed;
    width: 100%;
    bottom: 0;
	}
</style>
@endsection

@section('content')
<section class="container">
	
</section>
@endsection

@section('script')
<script>
$("document").ready( function() {
	 var msg = '수정할 권한이 없습니다.'
	 var title ='권한이 없습니다.';

		swal.fire({
			title : title,
			text : msg,
			icon: 'error',
			showCancelButton : false,
			confirmButtonClass : "btn-danger",
			confirmButtonText : "확인",
			cancelButtonText : "아니오",
		}).then((result) => {
			return location.replace("{{ Config::get('site.defaultStartUrl') }}/posts/{{$code}}");
		});	
})


</script>
@endsection