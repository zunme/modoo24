@extends('layouts.modoo')

@section('css')
<style>
    .cf:before, .cf:after {
        content: '';
        display: block;
        clear: both;
    }
    
    .visual_event {
        background: url(/v1/image/sub/visualevent.jpg) no-repeat center/cover;
        height: 254px;
        text-align: center;
    }

    .visual_event h1 {
        font-size: 40px;
        color: #000;
        padding-top: 95px;
        font-weight: bold;
    }

    .visual_event h4 {
        color: #747474;
    }



    #event {
        padding: 30px 0 30px;
        border-bottom:2px solid #dfdfdf;
        margin-bottom:50px;
    }

    #event h1 {
        font-size: 1.6em;
        padding-bottom: 10px;
        border-bottom: 2px solid #333333;
        text-align: center;
    }
    
    
    @media only screen and (max-width: 959px) {
        .visual_event {
            background: url(/v1/image/sub/visualevent_m.jpg) right top no-repeat;
            height: 100px;
            background-size: cover;
        }

        .visual_event h1 {
            font-size: 1.0em;
            padding-top: 30px;
            font-family: 'GmarketSansMedium';
        }

        .visual_event h4 {
            font-size: .8em;
        }
        
        #event h1 {
            font-size: 1.2em;
        }
        
        
    }
</style>
@endsection


@section('content')
<!--common_visual-->
<div class="visual_event">
    <h1>이벤트</h1>
    <h4>Event</h4>
</div>
<!--//common_visual-->
<div class="sub_menu">
    <ul class="center">
        <li class="h_icon gotohome"></li>
        <li class=" on "><a href="event">이벤트</a></li>
    </ul>
</div>

<!--//event_list-->
<div class="center">
    <div id="event">
        <h1><b>모두이사 이벤트</b>에 참여해 주세요</h1>
        <section id="event_view">
			<div class="view_title">
			    <ul>
			      <li></li>  
			    </ul>
			</div>
		</section>
    </div>
</div>

@endsection


@section('script')
<script>
</script>
@endsection
