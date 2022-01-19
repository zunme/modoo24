@extends('admin.layouts.app')

@section('css')
<style>
.btn-group.btn-line-group > .btn{
  background-color: #fdfdff;
  border-color: #e4e6fc;
}
#logtable table {
    width: 100%;
    min-width: 1100px;
}
#logtable th{text-align: center;}
#logtable td{
  text-align: right;
}
#logtable td > div.td-rate,
#logtable td > div.td-person{
  text-align: right;
}
#logtable .td-person-times:after{
  content:'이탈';
}
#logtable .td-rate:after{
  content:'%';
}
#logtable .td-person:after{
  content:'명';
}
#logtable .td-rate:after, #logtable .td-person:after, #logtable .td-person-times:after{
  display: inline-block;
  margin-left: 5px;
}
.none-data{
  padding:40px 0;
  text-align: center;
}
td.changed-td{
  background-color:#1b5974;
  color: white !important;
}
td.beforechanged-td{
  animation-name: animation;
  animation-duration: 120s;
}
td.changed-td .text-primary, td.changed-td .text-warning{
  color: white !important;
  font-weight: bold;
}

@keyframes animation {
  0%{background-color: #4e9cc1;color:white;}
  60% {color:black;}
  100.0%  {background-color:white;color:black;}
}
</style>
@endsection


@section('content')
<div class="main">
  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4>비대면 이탈률(1주일)</h4>
        <div class="card-header-action">
          <div class="selectgroup">
                        <label class="selectgroup-item">
                          <input type="radio" name="exceptip" value="exceptip=true" class="selectgroup-input"  @if(request()->get('exceptip')) checked="" @endif >
                          <span href="/community/rhksfl/nfacelog?exceptip=true" class="selectgroup-button">사무실IP제거</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="exceptip" value="" class="selectgroup-input" @if(!request()->get('exceptip')) checked="" @endif >
                          <span href="/community/rhksfl/nfacelog" class="selectgroup-button">전체IP</span>
                        </label>
                      </div>
          <!--div class="btn-group btn-line-group">
            <a href="/community/rhksfl/nfacelog?exceptip=true" class="btn @if(request()->get('exceptip')) btn-primary @endif">사무실IP제거</a>
            <a href="/community/rhksfl/nfacelog" class="btn @if(!request()->get('exceptip')) btn-primary @endif">전체IP</a>
          </div-->
        </div>
      </div>
      <div class="card-body">
        <div id="logtable" class="table-responsive">
          <table class="table table-bordered table-md">
            <thead>
              <tr>
                <th>날짜</th>
                <th>팝업오픈수</th>
                <th>실사용자수</th>
                <th>출발/도착지</th>
                <th>이사일선택</th>
                <th>이사종류</th>
                <th>짐량확인</th>
                <th>정보입력</th>
                <th>전환<br>(open대비)</th>
                <th>실전환<br>(실사용자대비)</th>
              </tr>
            </thead>
            <tbody id="logtableTbody">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection


@section('script')

  <script>

  var exceptip =''
  var compiledTemplate;
  var loadinterval;
  var today = "{{\Carbon\Carbon::now()->format('Y-m-d')}}"
  var beforedata;

  @if(request()->get('exceptip'))
    exceptip = "exceptip=true"
  @endif
  @verbatim

  let trTemplate = `
  {{#if data}}
    {{#each data}}
      <tr data-date='{{logdate}}'>
        <td data-step='date' class="">{{logdate}}</td>
        <td data-step='total' class="total">{{total}} 번</td>
        <td data-step='unique' class="uniquenum">{{uniquenum}} 명</td>
        <td data-step='1' class="step1_bounce"><div class="td-rate">{{numberFormat step1_bounce decimalLength="2" }}</div><div class="td-person-times">{{step1}}</div></td>
        <td data-step='2' class="step2_bounce"><div class="td-rate">{{numberFormat step2_bounce decimalLength="2" }}</div><div class="td-person-times">{{step2}}</div></td>
        <td data-step='3' class="step3_bounce"><div class="td-rate">{{numberFormat step3_bounce decimalLength="2" }}</div><div class="td-person-times">{{step3}}</div></td>
        <td data-step='4' class="step4_bounce"><div class="td-rate">{{numberFormat step4_bounce decimalLength="2" }}</div><div class="td-person-times">{{step4}}</div></td>
        <td data-step='5' class="step5_bounce"><div class="td-rate">{{numberFormat step5_bounce decimalLength="2" }}</div><div class="td-person-times">{{step5}}</div></td>
        <td data-step='6' class="step6_completed">
          <div class="td-rate">{{numberFormat step6_completed decimalLength="2" }}</div>
          <div class="td-person">{{total}}번 중 {{step6}}</div>
        </td>
        <td data-step='real' class="real_colpleted"><div class="td-rate"><span class="text-primary">{{numberFormat real_colpleted decimalLength="2" }}</span></div>
          <div class="td-person"><div class="td-person" style="display:inline-block;">{{uniquenum}}</div> 중 <span class="text-warning">{{step6}}<span></div></td>
      </tr>
    {{/each}}
  {{else}}
    <tr>
      <td colspan='10'>
        <div class="none-data">
          데이터가 없습니다.
        </div>
      </td>
    </tr>
  {{/if}}
  `

  $("document").ready( function() {
    $('body').addClass('sidebar-mini')
    compiledTemplate = Handlebars.compile( trTemplate );
    loadlogdata()
    loadinterval = setInterval(loadlogdata, 60000);
    $("input[name=exceptip]").on('change', function(e){
      exceptip = $(e.target).val()
      loadlogdata();
    })
  })
  var changeddata ={}
  function loadlogdata(){
    $.ajax({
      url: '/community/rhksfl/neworder/nface/log?' + exceptip,
      method:"get",
      data: {} ,
      dataType:'JSON',
      success:function(res)
      {
        var html = compiledTemplate(res);
        $("#logtableTbody").html( html)
        $(res.data).each( function (i, v){
          if( v.logdate == today){
            if( !beforedata) beforedata = v;
            else {
              for (var key in v) {
                  if( v[key] != beforedata[key]){
                     $("tr[data-date='"+today+"'] > td."+key).removeClass('changed-td').removeClass('beforechanged-td').addClass('changed-td')
                     changeddata[key] = {check:true, num : 1};
                   }
                  else {
                    if( typeof  changeddata[key] == 'object' && changeddata[key].check > 0 &&  changeddata[key].check < 4 ){
                      $("tr[data-date='"+today+"'] > td."+key).addClass('beforechanged-td')
                      changeddata[key] = {check:false, num :  changeddata[key].num + 1 };
                    }else {
                      $("tr[data-date='"+today+"'] > td."+key).removeClass('changed-td')
                      changeddata[key] = {check:false, num : 0};
                    }

                  }
                  beforedata[key] = v[key]
              }

            }
          }
        })
      },
      error: function ( err ){
        ajaxErrorST(err)
      },
      complete : function() {

      }
    });
  }
  @endverbatim
  </script>

@endsection
