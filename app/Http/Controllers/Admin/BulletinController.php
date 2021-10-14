<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BulletinConfig;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostFile;
use App\Models\PostCommentLog;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;


class BulletinController extends Controller
{
	use ApiResponser;
	function bulletinList( Request $request, $code = 'jisik' ) {
		$config = BulletinConfig::where(['code'=>$code])->first();
		$data = Post::with(['users','needconfirm'])->where(['posts.bulletin_id'=>$config->id]);

		return Datatables::of($data)->make(true);
	}
	function commentConfirmList( Request $request, $code = 'jisik' ) {
		$config = BulletinConfig::where(['code'=>$code])->first();
		$data = Post::select('post_comments.*')
			->join('post_comments', 'posts.id','=','post_comments.post_id')
			->where(['posts.bulletin_id'=>$config->id, 'post_comments.is_confirmed'=>'R']);

		return Datatables::of($data)->make(true);
	}
	function post(  Request $request, $post_id ){
		$post = Post::with(['files'])->where(['id'=>$post_id])->first();
		$comments = PostComment::where(['post_id'=>$post_id])->get();
		$config = BulletinConfig::where(['id'=>$post->bulletin_id])->first();
		$data = compact(['config','post','comments']);
		return $this->success( $data );
	}
	function allowComment(  Request $request, $comment_id ){
		try{
			$comment = PostComment::find($comment_id);
			if( $comment->is_confirmed =='Y'){
				return $this->error('이미 허용된 댓글입니다.',422);
			}
			$comment->is_confirmed = 'Y';
			$comment->save();
			$post = Post::find( $comment->post_id);
			$post->increment('comment_cnt');
			$log = PostCommentLog::firstOrCreate( ['auction_staff_s_uid'=>$comment->auction_staff_s_uid]);
			$log->increment('comment_cnt');

			return $this->success( $comment );
		} catch ( \Exception $e){
			return $this->error('상태변경에 실패하였습니다.',500);
		}
	}
	function denyComment(  Request $request, $comment_id ){
		try{
			$comment = PostComment::find($comment_id);
			if( $comment->is_confirmed =='N'){
				return $this->error('이미 미허용된 댓글입니다.',500);
			}
			$comment->is_confirmed = 'N';
			$comment->save();

			$post = Post::find( $comment->post_id);
			$post->decrement('comment_cnt');
			$log = PostCommentLog::firstOrCreate( ['auction_staff_s_uid'=>$comment->auction_staff_s_uid]);
			$log->decrement('comment_cnt');

			return $this->success( $comment );
		} catch ( \Exception $e){
			return $this->error('상태변경에 실패하였습니다.',500);
		}
	}
	function allowPost(  Request $request ){
		$post = Post::find($request->id);
		return $this->success( $post );
	}
	function changePostStatus(  Request $request  ){
		$messages = [
        'id.*' => '글 정보가 필요합니다.',
				'status.*' =>'허용여부가 필요합니다.',
    ];
    $this->validate($request, [
      'id' => 'bail|required|numeric',
      'status' => 'bail|required|in:Y,N',
     ],$messages);

		try{
			$post = Post::find($request->id);
			$post->is_confirmed = $request->status;
			$post->save();
			return $this->success( $post );
		} catch ( \Exception $e){
			return $this->error('상태변경에 실패하였습니다.',422);
		}
	}
	/* 허용된 글만 통계자료로 사용 */
	function resetlog() {
		$sql = "INSERT post_comment_logs
			(
			SELECT auction_staff_s_uid
				, COUNT(1) AS comment_cnt
				, SUM(fav_cnt) AS fav_cnt
				, SUM(best_cnt) AS best_cnt
				,NOW(),NOW()
			from `post_comments` a
			WHERE a.is_confirmed = 'Y'
			GROUP BY a.auction_staff_s_uid
			) ON DUPLICATE KEY UPDATE
				comment_cnt = VALUEs(comment_cnt),
				fav_cnt = VALUEs(fav_cnt),
				best_cnt = VALUEs(best_cnt),
				updated_at = NOW();	";

		try{
			\DB::insert($sql);
			return $this->success( );
		} catch ( \Exception $e){
			return $this->error('실패하였습니다.',500);
		}
	}
}
