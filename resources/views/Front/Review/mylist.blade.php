@extends('layouts.modoo')

@section('css')
<style>
.nav .nav-item {background: #eee;padding: 10px;height: 50px;line-height: 30px;}
    
    
@media only screen and (max-width: 600px) {    
.nav .nav-item {height: 40px;line-height: 20px;}
.nav-tabs, .nav-pills {
    padding: 20px 0;}
    }
</style>
@endsection

@section('content')
<div class="visual4">
    <h1>후기&amp;평가</h1>
</div>

<div class="content-wrap contents_wrap">
    <div class="sub_menu_N">
        <ul class="center">
            <li class="h_icon" onclick="window.open('/v2/')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zM6 19h12V9.157l-6-5.454-6 5.454V19z" fill="rgba(255,255,255,1)" />
                </svg>
            </li>
            <li onclick="location.href='/v1/move/review' ">이사후기</li>
            <li class="on">이사업체 평가하기</li>
        </ul>
    </div>

    <div class="content-inner">
        <div class="applylist-wrap center">
            <nav class="nav nav-pills nav-fill">
                <a class="nav-item nav-link" href="/v2/review/my" >이사업체 평가하기</a>
                <a class="nav-item nav-link active">이사업체 평가 내역</a>
            </nav>
        </div>
    </div>
    @endsection

    @section('script')
    @endsection
