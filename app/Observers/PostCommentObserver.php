<?php

namespace App\Observers;

use App\Models\PostCommentDepth;
use App\Events\CommentdepthEvent;
class PostCommentObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function creating(PostCommentDepth $comment)
    {
      if( $comment->parent_id > 0 ){
        PostCommentDepth::where([
          'post_id'=>$comment->post_id,
          'group_id'=>$comment->group_id
          ])->where('order_no',">=", $comment->order_no)
          ->increment('order_no', 1)
        ;
        PostCommentDepth::where([
          'post_id'=>$comment->post_id,
          'group_id'=>$comment->group_id
          ])->where('right_max',">", $comment->order_no-1)
          ->increment('right_max', 1)
        ;
      }
    }
    public function created(PostCommentDepth $comment){
      event(new CommentdepthEvent( $comment));
    }

}
