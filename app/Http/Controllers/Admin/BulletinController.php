<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BulletinConfig;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentDepth;
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

		if( $request->search_str != '' ){
			if( $request->search_option == 'title') $data = $data->where('title','like','%'.$request->search_str.'%');
			else if( $request->search_option == 'reg') $data = $data->where('created_at','like','%'.$request->search_str.'%' );
			else if( $request->search_option == 'user') {
				$data = $data->join('users', 'posts.user_id','=', 'users.id')->select('posts.*')
				->where('users.email','like','%'.$request->search_str.'%');
			}
		}

		return Datatables::of($data)->make(true);
	}
	function communtiyList( Request $request, $code = 'jisik' ) {
		$config = BulletinConfig::where(['code'=>$code])->first();
		$data = Post::with(['users','needconfirmdepth'])->where(['posts.bulletin_id'=>$config->id]);

		if( $request->search_str != '' ){
			if( $request->search_option == 'title') $data = $data->where('title','like','%'.$request->search_str.'%');
			else if( $request->search_option == 'reg') $data = $data->where('created_at','like','%'.$request->search_str.'%' );
			else if( $request->search_option == 'user') {
				$data = $data->join('users', 'posts.user_id','=', 'users.id')->select('posts.*')
				->where('users.email','like','%'.$request->search_str.'%');
			}
		}

		return Datatables::of($data)->make(true);
	}
	function commentConfirmList( Request $request, $code = 'jisik' ) {
		$config = BulletinConfig::where(['code'=>$code])->first();
		$data = Post::select('post_comments.*')
			->join('post_comments', 'posts.id','=','post_comments.post_id')
			->where(['posts.bulletin_id'=>$config->id, 'post_comments.is_confirmed'=>'R']);

		return Datatables::of($data)->make(true);
	}
	function commentConfirmdepthList( Request $request, $code = 'fun' ) {
		$config = BulletinConfig::where(['code'=>$code])->first();
		$data = PostCommentDepth:: select('post_comment_depth.*')
			->join( 'posts','post_comment_depth.post_id', '=', 'posts.id')
			->where(['post_comment_depth.is_confirmed'=>'R', 'bulletin_id'=>$config->id])
			->orderBy('id','asc');
		return Datatables::of($data)
		->addColumn('orign', function ($row){
			if( $row->parent_id > 0 ){
				//return $row->parent_id;
				$data = PostCommentDepth::withTrashed()->where(['id'=>$row->parent_id])->first();
				if( !isset( $data->id)) return '';
				return $data->comment;
			}else {
				$data = Post::withTrashed()->where(['id'=>$row->post_id])->first();
				return $data->title;
			}
		})
		->make(true);
	}
	function post(  Request $request, $post_id ){
		$post = Post::with(['files'])->where(['id'=>$post_id])->first();
		$comments = PostComment::where(['post_id'=>$post_id])->get();
		$config = BulletinConfig::where(['id'=>$post->bulletin_id])->first();
		$data = compact(['config','post','comments']);
		return $this->success( $data );
	}
	function postwithdepth(  Request $request, $post_id ){
		$post = Post::with(['files'])->where(['id'=>$post_id])->first();

		$config = BulletinConfig::where(['id'=>$post->bulletin_id])->first();
		$data = compact(['config','post']);
		return $this->success( $data );
	}
	function commentdepthlist(  Request $request){
		$data = PostCommentDepth::withTrashed()->where(['post_id'=>$request->post_id])
			->orderby('group_id','ASC')
			->orderby('order_no','ASC');
		return Datatables::of($data)->make(true);
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
	function allowCommentdepth(  Request $request ){
		try{
			$comment = PostCommentDepth::find($request->id);
			if( $comment->is_confirmed =='Y'){
				return $this->error('이미 허용된 댓글입니다.',422);
			}
			$comment->is_confirmed = 'Y';
			$comment->save();
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
	function denyCommentdepth(  Request $request ){
		try{
			$comment = PostCommentDepth::find($request->id);
			if( $comment->is_confirmed =='N'){
				return $this->error('이미 미허용된 댓글입니다.',500);
			}
			$comment->is_confirmed = 'N';
			$comment->save();
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
