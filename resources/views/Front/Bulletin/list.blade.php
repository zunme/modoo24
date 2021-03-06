@extends('layouts.modoo')

@section('css')
<link rel="stylesheet" type="text/css" href="/v1/css/community.css?v=20211216" />

<style>
.ct > .pagination>.page-item>.page-link, .ct > .pagination>.page-item>span {
  font-size: 14px !important;
  color: #337ab7;
}
.ct > .pagination>.page-item.active>span{
  color:white !important;
}
</style>


<style>
.mt-20{
   margin-top:60px;
   margin-bottom:30px;
}
#datatable_wrapper > .row:first-child{
  display:none;
}
#datatable_wrapper{
      font-size: 14px;
}

.details-control > .btn{

  font-size: 14px !important;
  line-height: 18px !important;

  margin: 0 !important;
}
table.dataTable>thead .sorting:before, table.dataTable>thead .sorting:after,
table.dataTable>thead .sorting_asc:before, table.dataTable>thead .sorting_asc:after,
table.dataTable>thead .sorting_desc:before, table.dataTable>thead .sorting_desc:after,
table.dataTable>thead .sorting_asc_disabled:before, table.dataTable>thead .sorting_asc_disabled:after,
table.dataTable>thead .sorting_desc_disabled:before, table.dataTable>thead .sorting_desc_disabled:after {
    bottom: 1em !important;
}

table.dataTable {
    border-bottom: 1px solid #ddd;
}
        
 
table.dataTable.nowrap th, table.dataTable.nowrap td:not(.btn-td) {
    padding-bottom: 14px !important;
    padding-top: 12px !important;
}
.btn-td{
  padding-top: 8px !important;
    padding-bottom: 5px !important;
}
td.child{
  padding-bottom: 40px !important;
  background-color: #f1f1f1;
  border-bottom: 1px solid red;
}
.display-flex .searchlist_Box{
  padding-bottom: 20px;
}
.comment_cnt_span{
  color: #4d8efc;
  display:none;
}
.comment_cnt_span.nonecomment{
  color: #AAA;
}

.ellipsis-title{
  max-width:300px;
}
.wordbreak {
      word-break: break-all;
      white-space: normal !important;
}
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {vertical-align: unset;}

@media only screen and (max-width: 959px){
  .comment_cnt_span{
    display:inline-block;
  }
  .dataTables_info{
    display:none;
  }
  .dataTables_paginate {
      margin-top: 22px !important;
      margin-bottom: 30px !important;
  }
}
.pagination>.page-item>.page-link, .pagination>.page-item>span {
    margin: 0 !important;
  }

#datatable > thead > tr > th:nth-child(2){
      min-width: 180px;
}
#datatable > tbody > tr > td:nth-child(2){
      min-width: 180px;
}

@media only screen and ( min-width : 450px) {

  #datatable > thead > tr > th:nth-child(2){
        min-width: 280px;
  }
  #datatable > tbody > tr > td:nth-child(2){
        min-width: 280px;
  }
}

@media ( min-width : 570px) {
  #datatable > thead > tr > th:nth-child(2){
        min-width: 400px;
  }
  #datatable > tbody > tr > td:nth-child(2){
        min-width: 400px;
  }
}
@media ( min-width : 960px) {
  #datatable > thead > tr > th:nth-child(2){
        min-width: 500px;
  }
  #datatable > tbody > tr > td:nth-child(2){
        min-width: 500px;
  }
}
.btn-outline-none{
  color: rgb(147 147 147) !important;
background-color: transparent;
border-color: rgb(147 147 147) !important;
}
li.details-control{
  padding-left: 10px;
  margin-left: 10px;
}
li.details-control.text-center{
  text-align:left !important;
}
#datatable_paginate{
  text-align: center !important;
}
.details-control .wait{
  font-weight: bold;
    color: #1e9af9;
}
.details-control .btn.btn-outline-info {
  color: #3e84fc;
      background-color: transparent;
      border-color: #3e84fc;
}
</style>
@endsection
@section('body_bottom','')

@section('content')
<!--common_visual-->
<div class="visual6">
    <h1>{{$config->title}}</h1>
</div><!--//common_visual-->

<!--
<div class="sub_menu">
    <ul class="center">
        <li class="h_icon gotohome"></li>
        <li class="on">{{$config->title}}</li>
    </ul>
</div>-->
<div class="center">
    <div id="board">
        <div class="good_after">
            <!--<h1 style="border: 0"><b>{{$config->title}}</b></h1>-->

            <div class="mt-20">

              <div class="display-flex justify-space-between">
                <div class="searchlist_Box">

                    
                    
                    @if ( $config->use_write=='Y' || (Auth::user() && Auth::user()->level >= 1024) )
                    <div class="jic-qustion-box">
                    <div class="mobile" style="width:100%">
                        <b>????????? ?????????????<br/> 
                            <span class="color_pt">???????????????!</span>
                        </b>
                    </div>
                    <a class="cmnty_button_blue" href="{{$code}}/write">????????????</a>
                    </div>    
                    @endif
                    
                    <select class="cmt_select" id="search_option" name="search_option">
                      <option value="title" @if($request->search_option !='cont' && $request->search_option !='writer' ) selected @endif >??????</option>
                      <option value="cont" @if($request->search_option=='cont') selected @endif >??????+??????</option>
                      <option value="writer" @if($request->search_option=='writer') selected @endif>?????????</option>
                    </select>

                    <div class="cmt_form_Box">
                        <input name="search" id="search" type="text" value="{{$request->search}}" maxlength="11" placeholder="????????? ?????? ?????? ??????">
                        <label></label>
                        <span class="btn_form" onClick="search_data()">??????</span>
                    </div>

                    

                </div>
              </div>

              <div class="table-responsive" style="border:0">
                <table class="table responsive dt-responsive display nowrap" id="datatable" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">??????</th>
                      <th class="text-center">??????</th>
                      <th class="text-center">??????</th>
                      <th class="text-center">?????????</th>
                      <th class="text-center">??????</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

        </div>
        
        <div class="mobile" style="display: flex; flex-direction: row-reverse">
            <a class="cmnty_button_blue" href="{{$code}}/write">????????????</a>
        </div>
        

<!--
        <div class="searchlist_Box">
          <form>
            <select class="cmt_select" name="search_option">
              <option value="title" @if($request->search_option !='cont' && $request->search_option !='writer' ) selected @endif >??????</option>
              <option value="cont" @if($request->search_option=='cont') selected @endif >??????+??????</option>
              <option value="writer" @if($request->search_option=='writer') selected @endif>?????????</option>
            </select>

            <div class="cmt_form_Box">
                <input name="search" type="text" value="{{$request->search}}" maxlength="11" placeholder="????????? ?????? ?????? ??????">
                <label></label>
                <span class="btn_form" onClick="submitbtn(this)">??????</span>
            </div>

            @if ( $config->use_write=='Y' || (Auth::user() && Auth::user()->level >= 1024) )
            <a type="button" class="cmnty_button_blue" href="{{$code}}/write">????????????</a>
            @endif

          </form>
        </div>

        <ul>
            <li class="border_list3">
                <dl>
                    <dt class="no">??????</dt>
                    <dd class="title" style="text-align: center">??????</dd>
                    <dt class="replystate">??????</dt>
                    <dt class="nickname">?????????</dt>
                    <dt class="date">??????</dt>
                </dl>
            </li>
@foreach ( $data as $row)
            <li class="border_list3">
                <a @if($row->is_confirmed =='R' && Auth::user() != null && Auth::user()->id ==  $row->user_id ) href="{{$code}}/view/{{$row->id}}"
                   @elseif($row->is_confirmed =='R') href="javascript:comfirmMessage()"
                   @else href="{{$code}}/view/{{$row->id}}"  @endif >
                    <dl>
                        <dt class="no">{{$row->id}}</dt>
                        <dd class="title">{{$row->title}}
                          @if( $row->is_confirmed =='R')
                          <span class="wait">(?????????)</span>
                          @endif

                          @if( $row->comment_cnt > 0)
                          <span class="replysok_m"> ???????????? ({{$row->comment_cnt}})</span>
                          @else
                          <span class="replysno_m"> ????????????</span>
                          @endif

                        </dd>
                        <dt class="replystate"> &nbsp;
                          @if( $row->comment_cnt > 0)
                          <span class="replysok"> ???????????? ({{$row->comment_cnt}})</span>
                          @else
                          <span class="replysno"> ????????????</span>
                          @endif
                        </dt>
                        <dt class="nickname">{{$row->nickname}}</dt>
                        <dt class="date">{{$row->created_at->diffForHumans()}}</dt>
                    </dl>
                </a>
            </li>
@endforeach


        </ul>
-->
    </div>

</div>










<div id="topButton" style="cursor: pointer">

    <a class="page_top" href="#cssmenu" id="topButtonImg" >
        <button type="button" id="top_btn">
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.828l-4.95 4.95-1.414-1.414L12 8l6.364 6.364-1.414 1.414z"/>
            </svg>
           <span>TOP</span>
        </button>
    </a>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
  $(".comfirmMessage").on("click", comfirmMessage )
	$(window).scroll(function() {
	    // top button controll
	    if ($(this).scrollTop() > 500) {
	        $('#topButton').fadeIn();
	    } else {
	        $('#topButton').fadeOut();
	    }
	});

	$("#topButtonImg").click(function() {
		$('html, body').animate({scrollTop:0}, '300');
	});

    @if (session('noti_alert_message'))
      swal.fire('',`{!! session('noti_alert_message') !!}`)
    @endif
});
function comfirmMessage(){
  swal.fire('?????? ?????? ?????????','??????????????? ?????? ?????? ??? ?????? ???????????? ???????????? ?????????????????? ????????? ?????? ????????? ???????????????.');
}
</script>
<style>
#topButton {position: fixed; right: 2%; bottom: 50px; display: none; z-index: 999;}
</style>

<script>
function submitbtn(btn){
  $(btn).closest('form').submit()
}
</script>

<!-- table -->
<script>
  let datatable;
  let userid
  let dtapi
  @if ( Auth::user() )
  userid = {{Auth::user()->id}};
  @endif
  $.extend( $.fn.dataTable.defaults, {
      responsive: true
  } );
  function search_data(){
    datatable.search('').draw();
    window.history.replaceState("", "", "?search_option="+$("#search_option").val()+"&search="+$("#search").val() );
  }
 $(document).ready(function() {
  datatable = $('#datatable').DataTable({
      "responsive": true,
      bStateSave: true,
      "processing": true,
      "serverSide": true,
      paging: true,
      "lengthMenu": [10],
      "pageLength": 10,
      "language" : lang_kor,
      "dom": "<'row'<'col-sm-12'l><'col-sm-12'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-12 col-md-12 text-center'p>>",
      "order": [[ 0, "desc" ]],
      "ajax": {
          'url' : "{{$code}}/listapi",
          'data' : function (data){
              data.search_option = $("#search_option").val();
            data.search = $("#search").val();
          }
      },
      "columnDefs": [
          {"targets": [ 0 ],"visible": true,"searchable": false,"className":'details-control text-center',responsivePriority: 6, 'width':'100px'},
          {"targets": [ 1 ],"visible": true,"searchable": true,sortable:false,"className":'details-control wordbreak',responsivePriority: 0},
          {"targets": [ 2 ],"visible": true,"searchable": true,sortable:false,"className":'details-control text-center btn-td',responsivePriority: 5, 'width':'110px'},
          {"targets": [ 3 ],"visible": true,"searchable": true,sortable:false,"className":'details-control text-center',responsivePriority: 2, 'width':'130px'},
          {"targets": [ 4 ],"visible": true,"searchable": false,sortable:false,"className":'details-control text-center',responsivePriority: 7, 'width':'160px'},
      ],
    "columns" : [
      {"data" : "id"},
      {"data" : "title",
           "render": function( data, type, row, meta) {

              let cmdclass = ''
              let cmdstr = ''
              let addstr = ''

              if( row.comment_cnt < 1 ) cmdclass='nonecomment'
              if( row.is_confirmed =='R') {
                addstr = '<span class="wait">(?????????)</span>'
                cmdstr = ''
              }else {
                cmdstr = `<span class="comment_cnt_span ${cmdclass}">(${row.comment_cnt})</span>`
              }
              if( row.is_confirmed =='R' && row.user_id != userid ) return `<a href="javascript:comfirmMessage()"><span class="ellipsis-title">${data} ${addstr} ${cmdstr}</span> </a>`
              else return `<a href="{{$code}}/view/${row.id}"><span class="ellipsis-title">${data} ${addstr} ${cmdstr}</span> </a>`
           }},
      {"data" : "comment_cnt",
           "render": function( data, type, row, meta) {
              if( data > 0 ) return `<button class="btn btn-outline-info btn-round btn-sm " type="button">???????????? (${data})</button>`
              else return `<button class="btn btn-outline btn-outline-none btn-round btn-sm" type="button">????????????</button>`
           }},
      {"data" : "nickname"},
      {"data" : "created_at",
           "render": function( data, type, row, meta) {
             let d = moment(data);
             var iscurrentDate = d.isSame(new Date(), "day");
             var iscurrentYear = d.isSame(new Date(), "year");
             if( iscurrentDate ) return d.format("LT")
             else if ( iscurrentYear ) return d.format("MM??? DD???")
             else return d.format("YY-MM-DD")
           }
      },
    ],
    "stateLoaded": function (settings, data) {
      console.log( data );
    },
    "initComplete": function(settings, json) {
         var api = new $.fn.dataTable.Api( settings );
         var state = api.state.loaded();
         console.log ( $("#search").val() )
         console.log ( JSON.parse( localStorage.getItem('dataTablesData') ) )
          $('#datatable_filter label input').unbind();

          var textBox = $('#search');
          $("#search").bind('keyup input', function(e) {
              if(e.keyCode == 8 && !textBox.val() || e.keyCode == 46 && !textBox.val()) {
                  // do nothing ??\_(???)_/??
              } else if(e.keyCode == 13 || !textBox.val()) {
                  search_data();
              }
          });
      },
      "drawCallback": function( settings ) {
        var api = this.api();
        dtapi = api
        var perpage = 10;
        var records_displayed = api.page.info().recordsTotal;
        var page = api.page.info().page;
        var length = api.page.info().length;
        datatable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = records_displayed - (page*length) - i ;
        })
      },
      "preDrawCallback": function( settings ) {

      },
  });
  datatable.on( 'order.dt search.dt', function () {
        datatable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            //cell.innerHTML = i+1;
        } );
    } ).draw();
} );
</script>
@endsection
