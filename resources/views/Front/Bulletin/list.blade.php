@extends('layouts.posts')

@section('content')

    <div class="visual1">
        <h1>모두이사</h1>
        <h4>Company Modoo24</h4>
    </div>
    <div class="sub_menu">
        <ul class="center">
            <li class="h_icon" onclick="window.open('/front/main')"></li>
            <li class="on">이사지식인</li>
        </ul>
    </div>
	
    <div class="center">
        <div id="board">
            <div class="good_after">
                <h1 style="border: 0"><b>이사 지식인</b></h1>
                <div class="search_Box">
                    <select class="cmt_select">
                        <option selected="">전체</option>
                        <option>제목+내용</option>
                        <option>글쓴이</option>
                    </select>
                    <div class="cmt_form_Box">
                        <input name="chk_num" type="number" maxlength="11" placeholder="이사에 대한 모든것을 물어보세요">
                        <label></label>
                        <a class="btn_form">검색</a>
                    </div>
                    <button type="button" class="cmnty_button_blue"
                        onclick="location.href='/front/knows?cmd=write' ">글쓰기</button>

                </div>
            </div>
            <ul>
                <li class="border_list3">
                    <dl>
                        <dt class="no">번호</dt>
                        <dd class="title" style="text-align: center">제목</dd>
                        <dt class="replystate">답변</dt>
                        <dt class="nickname">닉네임</dt>
                        <dt class="date">날짜</dt>
                    </dl>
                </li>
                <li class="border_list3">
                    <a href="/front/knows?cmd=view ">
                        <dl>
                            <dt class="no">10</dt>
                            <dd class="title">이사 지식인에 문의 : 저희 이사할때 비가 오면 비닐은 씌워주나요? <span class="replysok_m"> 업체답변
                                    (1)</span></dd>
                            <dt class="replystate"><span class="replysok"> 업체답변 (1)</span></dt>
                            <dt class="nickname">차칸야웅</dt>
                            <dt class="date">2021-08-31</dt>
                        </dl>
                    </a>
                </li>

                <li class="border_list3">
                    <a href="/front/knows?cmd=view ">
                        <dl>
                            <dt class="no">9</dt>
                            <dd class="title">이사견적은 언제쯤 받는게 좋을까요? <span class="replysno_m"> 답변대기</span></dd>
                            <dt class="replystate"> <span class="replysno">답변대기</span></dt>
                            <dt class="nickname">차칸야웅</dt>
                            <dt class="date">2021-08-28</dt>
                        </dl>
                    </a>
                </li>

            </ul>
        </div>


        <div class="ct">
            <ul class="pagination modal-3">
                <li><a href="/front/custom_review?&amp;no=0" class="active">1</a></li>
                <li><a href="/front/custom_review?&amp;no=10" class="">2</a></li>
                <li><a href="/front/custom_review?&amp;no=20" class="">3</a></li>
                <li><a href="/front/custom_review?&amp;no=30" class="">4</a></li>
                <li><a href="/front/custom_review?&amp;no=40" class="">5</a></li>
                <li><a href="/front/custom_review?&amp;no=50" class="next">»</a></li>
            </ul>
        </div>

    </div>



@endsection