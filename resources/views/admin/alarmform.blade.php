<style>
.alram_form_wrap{
  position: relative;
}
.order_title{
  display:flex;
  justify-content: space-between;
  padding: 5px 10px;
}
.alram_mem{
  margin: 10px 0;
  padding: 10px;
  border: 1px solid #ccc;
  /*height: 100px;
  overflow: auto;*/
  display:flex;flex-wrap:wrap
}
.alram_mem_p{
  flex-grow:1;width:49.9%;margin: 0 0 5px;
}
.alarm_time_wrap{
  margin: 20px 0;
  padding : 0 10px;
}
textarea[name=aa_memo]{
  margin-top:10px;
  width: 100%;
  height: 160px;
}
</style>
<div class="alram_form_wrap">
	<form id="alram_form">
		<input name="order_idx" type="hidden" value="{{$req['order_idx']}}">
    <input name="alarm_type" type="hidden" value="{{$req['alarm_type']}}">

		<p class="order_title">
			<span>+ 알람 등록</span>
      <label>
			     <input type="checkbox" value="N" onclick="selectallmember();">
           전체선택
       </label>
		</p>

		<div class="alram_mem" style="">
      <p class="alram_mem_p">
        <label>
          <input name="aa_send_mem[]" type="checkbox" value="{{$userinfo['id']}}" class="chk">
            나에게보내기
        </label>
      </p>
      @foreach ( $members as $member)
        @if( $member->am_idx != $userinfo['id'])
  			<p class="alram_mem_p">
          <label>
            <input name="aa_send_mem[]" type="checkbox" value="{{$member->am_idx}}" class="chk">
              {{$member->am_name}} ({{$member->am_id}})
          </label>
        </p>
        @endif
      @endforeach
		</div>

		<div class="alarm_time_wrap">
			+ 알람시간
      <input type="date" name="aa_alram_date1" value="{{$now->format('Y-m-d')}}" style="width:160px;" id="dp1639538957265" class="hasDatepicker">
			<select name="aa_alram_date2">
        @for($i = 0; $i < 24; $i++)
				<option value="{{ sprintf('%02d',$i)}}" @if ($i == $hh) selected @endif>{{ sprintf('%02d',$i)}}시</option>
        @endfor
			</select>
			<select name="aa_alram_date3">
        @for($i = 0; $i < 60; $i++)
        <option value="{{ sprintf('%02d',$i)}}" @if ($i == $mm) selected @endif>{{ sprintf('%02d',$i)}}분</option>
        @endfor
			</select>
		</div>

		<textarea name="aa_memo" class="share_tx_h"></textarea>
	</form>
	<div class="mg_20" style="text-align:center;">
		<button type="button" onclick="createAlarm();">등록</button>
		<button type="button" style="background:#999;" onclick="createAlarmSuccess()">창닫기</button>
	</div>
</div>
