<ul class="commentul">
  @forelse ( $comments as $comment)
    <li>
      <div class="comment_wrap">

        <div class="comment_body">
          @for ( $i =0 ; $i < $comment->depth_no; $i++)
          <div class="reply_depth reply_depth_icon">
            @if( $i == $comment->depth_no - 1)
              <i class="fas fa-reply fa-rotate-180"></i>
            @endif
          </div>
          @endfor
          <div class="comment_left">
            <div class="comment-nick">
              @if ( $comment->is_confirmed =='D')
              @else
              {{$comment->nickname}}
              @endif
            </div>
            <div class="comment-row">
              @if ( $comment->is_confirmed =='Y')
              {!! nl2br($comment->comment)!!}
              @elseif ( $comment->is_confirmed =='D')
              삭제된 댓글입니다.
              @else
                @if( Auth::user()->id == $comment->user_id )
                (대기중)<br>
                 {!! nl2br($comment->comment)!!}
                @else
                  대기중
                @endif
              @endif
            </div>
            <div class="comment-pic"></div>
          </div>
          <div class="comment_right">
            @auth
              @if( Auth::user()->id == $comment->user_id )
                @if($comment->is_confirmed =='R' || $config->use_comment_confirm !='Y')
                <span class="btn btn-white btn-sm" data-commentid='{{$comment->id}}' onClick="comment_update(this)">수정</span>
                @endif
                @if ( $comment->is_confirmed !='D')
                <span class="btn btn-white btn-sm" data-commentid='{{$comment->id}}' onClick="comment_del_prc(this)">삭제</span>
                @endif
              @endif
            @endauth
          </div>
        </div>
        <div class="comment_footer">
          @for ( $i =0 ; $i < $comment->depth_no; $i++)
            <div class="reply_depth"></div>
          @endfor
            <div class="comment_footer_inner">
              <div class="commment_footer_left">
                @if ( $comment->is_confirmed =='Y')
                <span class="btn btn-white btn-sm" data-nick="{{$comment->nickname}}" data-id="{{$comment->id}}" onclick="recomment(this)">답글</span>
                @endif
              </div>
              <div class="commment_footer_right">{{$comment->created_at}}</div>
            </div>
        </div>
      </div>
    </li>
  @empty
    <li>
      댓글이 없습니다.
    </li>
  @endforelse
</ul>
<div class="ct">
  {{$comments->links('vendor.pagination.dots-javascript',['pagination_eachside'=>3])}}
</div>
<script>
currnetCommentPage = {{$currentpage}};
$("#post_comment_cnt").text("{{$total}}")
</script>
