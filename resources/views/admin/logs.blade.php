@forelse($retLogs as $item)
<div>
  <div class="item_wrap">
    <div class="item">
      <div class="item_title">시간</div>
      <div class="item_content">{{$item->created_at}}</div>
    </div>
    <div class="item">
      <div class="item_title">MSG</div>
      <div class="item_content">{{$item->msg}}</div>
    </div>
    <div class="item">
      <div class="item_title">선택업체</div>
      <div class="item_content">
        @forelse($item->companies as $company)
          <div class="company_row">
            <span class="company_row_uid">[{{$company->s_uid}}]</span>
            <span class="company_row_id">[id] {{$company->s_id}}</span>
            <span class="company_row_name">[업체명] {{$company->s_company}}</span>
          </div>
        @empty
          -
        @endforelse
      </div>
    </div>
    <div class="item">
      <div class="item_title">data</div>
      <div class="item_content">
        @php
        dump( $item->data )
        @endphp
      </div>
    </div>
  </div>
</div>
@empty
<div class="emptyrow">
내용이 없습니다.
</div>
@endforelse

<style>
.emptyrow{
  display: flex;
  padding: 20px 0;
  justify-content: center;
}
.item_wrap::after{
  content: '';
  height:1px;
  margin-bottom: 10px;
  margin-top: 10px;
  background-color: black;
  display: block;
}
.item{
  display: flex;
  margin-bottom: 4px;
  margin-top: 4px;
}


.item_title{
  min-width: 90px;
}
.item_content{
  flex-grow: 1;
}
.company_row > span:not(:first-child){
  margin-left: 15px;
}
</style>
