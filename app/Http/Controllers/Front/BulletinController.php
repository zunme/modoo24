<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\BulletinConfig;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentDepth;
use App\Models\PostFile;
use App\Models\AuctionStaff;

use App\Models\PostCommentFavLog;
use App\Models\PostCommentBestLog;
use App\Models\PostCommentLog;

use App\Models\PostFavorite;
use App\Models\BulletinSido;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Traits\ApiResponser;


class BulletinController extends Controller
{
	use ApiResponser;
	public $commentPagingNum=1000000000000;

	public function contentList(Request $request, $code){
		Carbon::setLocale('ko');
		$config = BulletinConfig::active()->where(['code'=>$code])->first();
		if( !$config){
			return back()->with('noti_alert_message', '찾는 페이지가 없습니다.');
		}

		if( $request->ready == 'Y' ) $qry = Post::where(['bulletin_id'=> $config->id])->where('is_confirmed', '==','Y');
		else $qry = Post::with(['files'])->where(['bulletin_id'=> $config->id])->where('is_confirmed', '!=','N');

		if( $request->search ){
			if ( $request->search_option == 'cont' )
			{
				$qry =$qry->where(function($query) use ($request) {
					return $query->where('title', 'like', '%'.$request->search.'%')->orWhere('body', 'like', '%'.$request->search.'%');
				});
			}
			else if ( $request->search_option == 'writer' ) $qry =$qry->where('nickname', 'like', '%'.$request->search.'%');
			else $qry = $qry->where('title', 'like', '%'.$request->search.'%');
		}

		if ($request->ajax()) {
			return Datatables::of($data)->make(true);
		}else {
			$data = $qry->latest()->paginate(3);
			$pagingres = $data->appends($request->except('page'))->links('vendor.pagination.dots',['pagination_eachside'=>3]);
			//return view('Front/Bulletin/testlist', compact(['data','code','request', 'config']));
			if( $code !='jisik') return view('Front/Bulletin/community/list', compact(['data','code','request', 'config','pagingres']));
			else if( config('site.isPartnerSite')== 'N') return view('Front/Bulletin/list', compact(['data','code','request', 'config']));
			else return view('Front/Bulletin/partner/list', compact(['data','code','request', 'config']));
		}
	}


	// 대기중안나오는
	public function contentListApi(Request $request, $code){
		$config = BulletinConfig::active()->where(['code'=>$code])->first();
		if( !$config){
			return view('Front/Bulletin/empty');
		}
		$data = Post::where('is_confirmed', '!=','N')->where(['bulletin_id'=> $config->id]);
		if( $request->ready == 'Y' ) $data = Post::where(['bulletin_id'=> $config->id, 'is_confirmed'=>'Y']);
		else $data = Post::where('is_confirmed', '!=','N')->where(['bulletin_id'=> $config->id]);

		if( $request->search ){
			if ( $request->search_option == 'title' ) $data = $data->where('title', 'like', '%'.$request->search.'%');
			else if ( $request->search_option == 'cont' ) $data =$data->where('title', 'like', '%'.$request->search.'%')->orWhere('body', 'like', '%'.$request->search.'%');
			else if ( $request->search_option == 'writer' ) $data =$data->where('nickname', 'like', '%'.$request->search.'%');
		}
		return Datatables::of($data)->make(true);
	}
	public function jisikListApi(Request $request){
		$config = BulletinConfig::active()->where(['code'=>'jisik'])->first();
		$qry = Post::with(['files'])
					->where(['bulletin_id'=> $config->id])->where('is_confirmed', '!=','N')
					->orderBy('id','desc')->limit(5)->get();
		return $this->success( $qry );

	}
	public function view(Request $request, $code ,$viewid){
		$user = Auth::user();

		$config = BulletinConfig::active()->where(['code'=>$code])->first();
		if( !$config){
			return back()->with('noti_alert_message', '찾는 페이지가 없습니다.');
		}

		if($request->ajax()){
			$post = Post::with(['simplecomments','files'])->where(['bulletin_id'=> $config->id, 'id'=>$viewid])->first();
		}else{
			$post = Post::with(['comments','address','files'])->where(['bulletin_id'=> $config->id, 'id'=>$viewid])->first();
		}

		if( $post->is_confirmed =='N' ) return back();
		else if( $post->is_confirmed == 'R' ){
			if( $user ){
				if( $user->id != $post->user_id) return back();
			}else return back();
		}

		$post->view_cnt = $post->view_cnt + 1;
		$post->save();

		$is_writer = ( Auth::user() && Auth::user()->id == $post->user_id) ? true:false;
		$post_favorite = false;
		if ( $user ) {
			$post_fav = PostFavorite::where(['post_id'=>$post->id , 'user_id'=>$user->id])->count();
			if( $post_fav > 0 ) $post_favorite = true;
			else $post_favorite = false;
		}

		if($request->ajax()){
			session_start();
			$session =  $_SESSION;
			session_write_close();

			$staff = [
				"user_id" => $session['user_id'],
				"idx" => $session['idx'],
				"name" => $session['name'],
				"btype" => $session['m_btype'],
			];
			return $this->success( compact(['config','post','code','is_writer','user'=>$session]) );
		}

		if( $code !='jisik') return view('Front/Bulletin/community/view',compact(['config','post','code','is_writer','post_favorite']));
		else if( config('site.isPartnerSite')== 'N') return view('Front/Bulletin/viewpost',compact(['config','post','code','is_writer','post_favorite']));
		else return view('Front/Bulletin/viewpost',compact(['config','post','code','is_writer','post_favorite']));
	}
	public function writeForm(Request $request, $code){
		$config = BulletinConfig::active()->where(['code'=>$code])->first();
		$totalImgCount = 0;
		if( !$config){
			return back()->with('noti_alert_message', '찾는 페이지가 없습니다.');
		}else if ( $config->use_write=='N' && Auth()->user()->level < 1024 ){
			return back()->with('noti_alert_message', '글쓰기 권한이 없습니다.');
		}
		$post = new Post();

		if( $config->address_use =='Y') $address = BulletinSido::where(['depth'=>'1'])->orderBy('si_code')->get();
		else $address = [];

		if( $config->code !='jisik') return view('Front/Bulletin/community/writepost', compact(['config', 'code', 'post','totalImgCount','address']) );
		else return view('Front/Bulletin/writepost', compact(['config', 'code', 'post','totalImgCount']) );
	}
	public function updateForm(Request $request, $code, $writeid){
		$config = BulletinConfig::active()->where(['code'=>$code])->first();
		if( !$config){
			return back()->with('noti_alert_message', '찾는 페이지가 없습니다.');
		}
		$comment_cnt = PostComment::where(['post_id'=>$writeid])->count();
		if( $comment_cnt > 0) {
			return back()->with('noti_alert_message', '댓글이 있는 글은 수정이 불가능 합니다.');
		}

		$post = Post::with(['comments','files'])->where(['bulletin_id'=> $config->id, 'id'=>$writeid])->where('is_confirmed', '!=','N')->first();
		$totalImgCount = $post->files->count();

		$is_writer = ( Auth::user()->id == $post->user_id) ? true:false;
		if ( !$is_writer){
			return view('Front/Bulletin/421', compact(['config', 'code', 'post','totalImgCount']) );
		}

		if( $config->address_use =='Y') $address = BulletinSido::where(['depth'=>'1'])->orderBy('si_code')->get();
		else $address = [];

		if( $config->code !='jisik') return view('Front/Bulletin/community/writepost', compact(['config', 'code', 'post','totalImgCount','address']) );
		else return view('Front/Bulletin/writepost', compact(['config', 'code', 'post','totalImgCount']) );
	}

	public function create(Request $request){
		$user = Auth::user();

		$config = BulletinConfig::active()->where(['code'=>$request->code])->first();
		if( !$config){
			return $this->error('게시판을 찾을 수 없습니다.');
		}

		if( $config->address_use=='Y') $gu_code_required = 'required';
		else $gu_code_required = 'nullable';

		$messages = [
        'title.*' => '제목을 50자 내외로 작성해주세요.',
				'body.*' =>'내용을 작성해주세요.',
				'si_code.*'=>"지역을 선택해주세요",
				'gu_code.*'=>"지역을 선택해주세요",
    ];
    $this->validate($request, [
      'title' => 'bail|required|string|min:1|max:50',
      'body' => 'bail|required',
			'code' => 'bail|required',
			'si_code' => 'bail|'.$gu_code_required,
			'gu_code' => 'bail|'.$gu_code_required,
     ],$messages);

		$data = $request->except('id', 'code');

		$storage = Storage::disk('public');
		if( $request->delfile ){
			foreach( $request->delfile as $fileno){
				$file = PostFile::find( $fileno);
				$this->delfile( $file->url);
				$file->delete();
			}
		}

		$data['body'] = $this->getimage($data['body']);
		$data['repImg'] = $this->firstImage($data['body'] );
		/* xss with html purifier */
		$dir = "HTMLPurifier";
		$cachePath = storage_path("app/$dir");
		if (!\File::exists($cachePath)) {
				Storage::makeDirectory($dir);
		}
		$puriconfig = \HTMLPurifier_Config::createDefault();
		$puriconfig->set('Cache.SerializerPath', $cachePath);
		$purifier = new \HTMLPurifier($puriconfig);
		$data['body'] = $purifier->purify($data['body']);
		if( $request->id > 0 ){
			$post = Post::active()->with(['comments','files'])->where([ 'id'=>$request->id ])->first();
			if(!$post) return $this->error('글을 찾을 수 없습니다.', 422);

			$is_writer = ( Auth::user()->id == $post->user_id) ? true:false;
			if ( !$is_writer){
				return $this->error('수정 권한이 없습니다.', 422);
			}
			try{
				$post->update( $data );
			}catch ( \Exception $e){
				return $this->error('잠시 후에 이용해주세요.', 422);
			}
		}else {
			$data['code'] = $request->code;
			$data['bulletin_id'] = $config->id;
			$data['user_id'] = $user->id;
			$data['nickname'] = $user->nickname;
			$data['is_confirmed'] = ($config->use_confirm =='Y') ? 'R': 'Y';
			$post = Post::create($data);
		}


		$files = $request->file('upload');

		if($request->hasFile('upload'))
		{
				foreach ($files as $file) {
					$this->uploadImage( $file ,$post->id );
				}
		}
		return $this->success();
	}
	public function delPrc(Request $request){
		if( $request->id > 0 ){
			$post = Post::where([ 'id'=>$request->id ])->first();
			if(!$post) return $this->error('글을 찾을 수 없습니다.', 422);

			$is_writer = ( Auth::user()->id == $post->user_id) ? true:false;
			if ( !$is_writer){
				return $this->error('삭제 권한이 없습니다.', 422);
			}
			try{
				$post->delete();
			}catch ( \Exception $e){
				return $this->error('잠시 후에 이용해주세요.', 422);
			}
			return $this->success();
		}
	}
	private function delfile($path){
		$storage = Storage::disk('public');
		if ( $path !== null ){
			if($storage->exists($path) ){
				$storage->delete($path);
			}
			if($storage->exists('/thumb/'.$path) ){
				$storage->delete('/thumb/'.$path);
			}
		}
	}
	private function getImage($body){
        $dom = new \DOMDocument();
        @$dom->loadHtml('<?xml encoding="utf-8"?>' . $body , LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOXMLDECL);
        $dom->encoding = 'utf-8';
        $images = $dom->getElementsByTagName('img');
        $images_arr = [];
        foreach ($images as $img) {
            array_push($images_arr, $img->getAttribute('src'));
        }

        $storage = Storage::disk('public');
        $path = 'post/' . Carbon::now()->format('ymd') . '/';
				$defaultStartUrl = \Config::get('site.defaultStartUrl').'/storage/';

        try {
            if (count($images) > 0) {
                foreach ($images as $k => $img) {
                    $image_64 = $img->getAttribute('src');
                    if (strpos($image_64, ';base64')) {
                        $image_data_aux = explode(';base64', $img->getAttribute('src'));
                        $image_data = $image_data_aux[1];
                        $extension = explode('/', $image_data_aux[0])[1];
                        $imageName = Carbon::now()->format('ymdhis') . '_' . Str::random(9) . "." . $extension;
                        $storage->put($path . $imageName, base64_decode($image_data));
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $defaultStartUrl . $path . $imageName);
                    } else {
                        continue;
                    }
                }
            }

        } catch (\Exception $e) {
            return response()->json(['errors' => ['system' => ['시스템 오류입니다.'], 'e' => $e, 'data' => $request->all()]], 422);
        }

        /*$returnBody = Str::of($dom->saveHTML())->replace('<?xml encoding="utf-8"?>','');		*/
				return  str_replace('<?xml encoding="utf-8"?>', '', $dom->saveHTML());
	}
	private function firstImage($body){
        $dom = new \DOMDocument();
        @$dom->loadHtml('<?xml encoding="utf-8"?>' . $body , LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOXMLDECL);
        $dom->encoding = 'utf-8';
        $images = $dom->getElementsByTagName('img');
				if ( isset($images[0]) ) return $images[0]->getAttribute('src');
				else return null;
	}
	//depth comment
	public function commentV2(Request $request){
		$user = Auth::user();
		if( empty( $user)) return $this->error('로그인후 사용해주세요.', 422);
		$post = Post::where( ['id'=>$request->post_id])->first();
		if( empty( $post)) return $this->error('글을 찾을 수 없습니다.', 422);
		$config = BulletinConfig::active()->where(['id'=>$post->bulletin_id])->first();
		if( empty( $config)) return $this->error('글을 찾을 수 없습니다.', 422);
		if( $config->comment_use !='Y') return $this->error('댓글을 허용하지 않습니다.', 422);

		$messages = [
				'post_id.*' => '글정보를 찾을 수 없습니다.',
				'comment.*' =>'답글을 작성해주세요.',
    ];
    $this->validate($request, [
      'post_id' => 'bail|required|numeric',
			'comment' => 'bail|required|string|min:1|max:3000',
     ],$messages);

		if( !$request->parent_id ){
			$last_comment = PostCommentDepth::select( \DB::raw('ifnull(max(group_id),0) +1 as nextgroupid'))->where(['post_id'=>$post->id])->first();
			$data['user_id'] =$user->id;
			$data['post_id']=$post->id;
			$data['group_id']=$last_comment->nextgroupid;
			$data['parent_id'] =$data['depth_no'] = 0;

			$data['order_no'] = 1;
			$data['right_max'] = 1;

			$data['nickname'] =( $user->level > 1023) ? '관리자': $user->nickname;
			$data['comment'] = '<span class="toUser">'.$post->nickname.'</span>'. $request->comment;
			$data['is_confirmed'] = $config->use_comment_confirm == 'Y' ? 'R' : 'Y';
//dd( $data);
			try{
				$comment = PostCommentDepth::create( $data );
			} catch( \Exception $e){
				return $this->error('서버와의 통신이 이루어지지 않았습니다. 잠시후에 사용해주세요',422);
			}
			$data = PostCommentDepth::where(['post_id'=>$post->id])->where('is_confirmed','!=','N')->paginate($this->commentPagingNum);
			$url = "/community/posts/cmt/comment/view/".$post->id."?page=".$data->lastPage();
			return $this->success(['url'=>$url]);
		}

	}
	public function recomment(Request $request){
		$user = Auth::user();
		if( empty( $user)) return $this->error('로그인후 사용해주세요.', 422);
		$comment = PostCommentDepth::select('post_comment_depth.*')
			->where( ['id'=>$request->parent_id])
			->first();
		if( empty( $comment)) return $this->error('답글을 찾을 수 없습니다.', 422);

		$config = Post::select('posts.*','bulletin_configs.comment_use', 'use_comment_confirm')
			->where( ['posts.id'=>$comment->post_id])
			->join('bulletin_configs','posts.bulletin_id' ,'=', 'bulletin_configs.id')->first();
		if( empty( $config)) return $this->error('답글을 찾을 수 없습니다.', 422);
		if( $config->is_confirmed !='Y') return $this->error('댓글을 허용하지 않습니다.', 422);

		$messages = [
				'parent_id.*' => '답글정보를 찾을 수 없습니다.',
				'comment.*' =>'내용을 작성해주세요.',
    ];
    $this->validate($request, [
      'parent_id' => 'bail|required|numeric',
			'comment' => 'bail|required|string|min:1|max:3000',
     ],$messages);

		 $data['post_id'] = $comment->post_id;
		 $data['group_id'] = $comment->group_id;
		 $data['parent_id'] = $request->parent_id;

		$parent_comment = PostCommentDepth::where(["id"=>$data['parent_id'] ])->first();
		$order_no = $parent_comment->right_max + 1;

		 $data['user_id'] = $user->id;
		 $data['depth_no'] = $comment->depth_no+1;
		 $data['order_no'] = $order_no;
		 $data['right_max'] = $order_no;
		 $data['comment'] = '<span class="toUser">'.$parent_comment->nickname.'</span>' . $request->comment;
		 $data['nickname'] = ($user->level < 1024) ? $user->nickname : '관리자';
		 $data['is_confirmed'] = $config->use_comment_confirm == 'Y' ? 'R' : 'Y';

		 try{
					$parent_comment->increment('right_max', 1);
					$recomment = PostCommentDepth::create($data);
		 } catch(\Exception $e){
			 return $this->error('서버와의 통신이 이루어지지 않았습니다. 잠시후에 사용해주세요',422);
		 }


		 return $this->success();

	}
	public function commentV2Info(Request $request){
		$user = Auth::user();
		if( empty( $user)) return $this->error('로그인후 사용해주세요.', 422);

		$comment = PostCommentDepth::where(['id'=>$request->comment_id, 'user_id'=>$user->id])->first();

		$config = Post::select('posts.*','bulletin_configs.comment_use', 'use_comment_confirm')
			->where( ['posts.id'=>$comment->post_id])
			->join('bulletin_configs','posts.bulletin_id' ,'=', 'bulletin_configs.id')->first();
		$comment->use_comment_confirm = $config->use_comment_confirm;
		$comment->comment_use = $config->comment_use;

		return $this->success( $comment);
	}
	public function commentV2view(Request $request, $code ,$post_id){
		$comments = PostCommentDepth::where(['post_id'=>$post_id])->where('is_confirmed','!=','N')
			->orderby('group_id','ASC')
			->orderby('order_no','ASC')
			->paginate($this->commentPagingNum);
		$config = Post::select('bulletin_configs.*')->where(['posts.id'=>$post_id])
			->join('bulletin_configs', 'posts.bulletin_id','=','bulletin_configs.id')
			->first();
		$total = $comments->total();
		$currentpage = $comments->currentPage();
		return view('Front/Bulletin/community/comments', compact(['comments','total','config','currentpage']));
	}

	public function commentV2Del(Request $request){
		$user = Auth::user();
		if( empty($user)) return $this->error('로그인후 사용해주세요',422);
		$comment = PostCommentDepth::where(['id'=>$request->id])->first();

		if( $user->id != $comment->user_id) return $this->error('삭제권한이 없습니다.',422);

		$child = PostCommentDepth::where(['parent_id'=>$request->id])->count();

		/*TODO 하위 댓글이 있으면?? */
		if( $child < 1) {
			PostCommentDepth::where(['id'=>$request->id])->delete();
		}else {
			PostCommentDepth::where(['id'=>$request->id])->update(['is_confirmed'=>'D']);
		}
		return $this->success('삭제되었습니다.');
	}

	public function commentupdate(Request $request){
		$user = Auth::user();
		$comment = PostCommentDepth::where(['id'=>$request->comment_id])->first();

		if( $user->id != $comment->user_id) return $this->error('수정권한이 없습니다.',422);

		$config = Post::select('posts.*','bulletin_configs.comment_use', 'use_comment_confirm')
			->where( ['posts.id'=>$comment->post_id])
			->join('bulletin_configs','posts.bulletin_id' ,'=', 'bulletin_configs.id')->first();

		if( $config->use_comment_confirm=='Y' && $comment->is_confirmed !='R' ){
			return $this->error('수정하실 수 없습니다.',422);
		}else if(  $comment->is_confirmed !='R' &&  $comment->is_confirmed !='Y') return $this->error('수정하실 수 없습니다.',422);

		$comment->comment = $request->comment;
		$comment->save();
		return $this->success();
	}

	public function commentCreate(Request $request){
		session_start();
		$session =  $_SESSION;

		if( !isset($session['idx']) || empty($session['idx']) ){
			return $this->error('로그인후 사용해주세요.', 422);
		}
		$user = AuctionStaff::where(['s_uid'=> $session['idx'], 's_id'=>$session['user_id'] ])->first();
		$messages = [
        'code.*' => '올바른 코드가 아닙니다.',
				'post_id.*' => '글정보를 찾을 수 없습니다.',
				'body.*' =>'답변을 작성해주세요.',
    ];
    $this->validate($request, [
      'code' => 'bail|required|string|min:2|max:50',
      'post_id' => 'bail|required|numeric',
			'body' => 'bail|required|string',
     ],$messages);
		$data = $request->all();
		$data['body'] = htmlspecialchars($data['body'], ENT_QUOTES);
		$config = BulletinConfig::active()->where(['code'=>$request->code])->first();

		if( !$config){
			return $this->error('게시판을 찾을 수 없습니다.');
		}
		if( $config->comment_use != 'Y'){
			return $this->error('답변을 달 수 없습니다...');
		}

		$post = Post::active()->where(['bulletin_id'=> $config->id, 'id'=>$data['post_id'] ])->first();
		if( $config->comment_use != 'Y'){
			return $this->error('글을 찾을 수 없습니다...');
		}
		$data['is_confirmed'] = $config->use_comment_confirm == 'Y' ? 'R' : 'Y';

		/* TODO 파트너 정보 가져오기*/
		$data['auction_staff_s_uid'] = $user->s_uid;
		$data['auction_staff_s_name'] = $user->s_company.' '.$user->s_nickname;

		if ( $comment = PostComment::create($data) ) {
				if( $config->use_comment_confirm != 'Y'){
					$post->increment('comment_cnt');
					$log = PostCommentLog::firstOrCreate( ['auction_staff_s_uid'=>$user->s_uid]);
					$log->increment('comment_cnt');
				}
			return $this->success();
		}
		else return $this->error('잠시후에 사용해주세요.', 422);
	}

	function jisikCommentUpdate(Request $request){
		session_start();
		$session =  $_SESSION;

		if( !isset($session['idx']) || empty($session['idx']) ){
			return $this->error('로그인후 사용해주세요.', 422);
		}

		$messages = [
				'comment_id.*' => '댓글을 찾을 수 없습니다.',
				'body.*' =>'답변을 작성해주세요.',
    ];
    $this->validate($request, [
      'comment_id' => 'bail|required|numeric',
			'body' => 'bail|required|string',
     ],$messages);
		$data = $request->all();

		$comment = PostComment::where(['id'=>$request->comment_id])->first();

		if ( !$comment) return $this->error('댓글을 찾을 수 없습니다.',422);
		if( $session['idx'] != $comment->auction_staff_s_uid) {
			return $this->error('수정권한이 없습니다.',422);
		}

		if( $comment->is_confirmed != 'R'){
			return $this->error('더 이상 수정하실 수 없습니다.', 422);
		}

		$comment->body = htmlspecialchars($data['body'], ENT_QUOTES);
		$comment->save();

		return $this->success( $comment );
	}

	function jisikCommentDelete(Request $request){
		session_start();
		$session =  $_SESSION;

		if( !isset($session['idx']) || empty($session['idx']) ){
			return $this->error('로그인후 사용해주세요.', 422);
		}

		$comment = PostComment::where(['id'=>$request->comment_id])->first();

		if ( !$comment) return $this->error('댓글을 찾을 수 없습니다.',422);
		if( $session['idx'] != $comment->auction_staff_s_uid) {
			return $this->error('삭제권한이 없습니다.',422);
		}

		if( $comment->is_confirmed != 'R'){
			return $this->error('더 이상 삭제하실 수 없습니다.', 422);
		}
		$comment->delete();
		return $this->success( $comment );
	}

	function postFavorite($code, $post_id){
		$user = Auth::user();
		if( empty( $user)) return $this->error('로그인후 사용해주세요.', 422);
		$post = Post::where( ['id'=>$post_id])->first();
		if( empty( $post)) return $this->error('글을 찾을 수 없습니다.', 422);
		$fav = PostFavorite::where(['post_id'=>$post_id, 'user_id'=>$user->id])->first();
		if ( empty($fav)){
			PostFavorite::create(['post_id'=>$post_id, 'user_id'=>$user->id]);
			$msg='공감하셨습니다';
			$add = true;
		}else {
			PostFavorite::where(['post_id'=>$post_id, 'user_id'=>$user->id])->delete();
			$msg='공감을 취소하셨습니다';
			$add = false;
		}
		$post = Post::select('fav_cnt')->where( ['id'=>$post_id])->first();
		return $this->success(['fav_cnt'=>$post->fav_cnt, 'msg'=>$msg, 'add'=>$add]);
	}

	private function addfavcnt(Request $request, $session){
		$user = AuctionStaff::where(['s_uid'=> $session['idx'], 's_id'=>$session['user_id'] ])->first();
		if( !$user ){
			return $this->error('로그인후 사용해주세요');
		}

		$comment = PostComment::active()->where(['id'=>$request->id ])->first();

		if( $comment->auction_staff_s_uid == $user->s_uid ) return $this->error('자신이 쓴 댓글입니다.', 422, []);

		try{
			$log = PostCommentFavLog::create(['comment_id'=>$request->id,'auction_staff_s_uid'=> $user->s_uid]);
			$comment = PostComment::where(['id'=>$request->id])->first();
			$comment->increment('best_cnt');

			$log = PostCommentLog::firstOrCreate( ['auction_staff_s_uid'=>$comment->auction_staff_s_uid]);
			$log->increment('fav_cnt');

			return $this->success(['cnt'=> $comment->best_cnt],'공감하셨습니다');
		} catch (\Exception $e){
			return $this->error('이미 공감하신 댓글입니다.', 422);
		}
	}
	public function addbestcnt(Request $request){
		$user = Auth::user();
		if( !$user ){
			return $this->error('로그인 후 사용해주세요');
		}
		$comment = PostComment::active()->where(['id'=>$request->id ])->first();

		try{
			$log = PostCommentBestLog::create(['comment_id'=>$request->id,'user_id'=> $user->id]);
			$comment = PostComment::where(['id'=>$request->id])->first();
			$comment->increment('best_cnt');

			$log = PostCommentLog::firstOrCreate( ['auction_staff_s_uid'=>$comment->auction_staff_s_uid]);
			$log->increment('best_cnt');

			return $this->success(['cnt'=> $comment->best_cnt],'공감하셨습니다');
		} catch (\Exception $e){
			return $this->error('이미 공감하신 댓글입니다.', 422, $e);
		}

	}
	public function addbestcntv2(Request $request){
		$user = Auth::user();
		if( !$user ){

			session_start();
			$session =  $_SESSION;
			session_write_close();

			if( !isset($session['idx']) || empty($session['idx']) ){
				return $this->error('로그인 후 사용해주세요');
			}else return $this->addfavcnt($request, $session);

		}else {
			return $this->addbestcnt($request);
		}
	}
	private function uploadImage( UploadedFile $file = null, $post_id)
    {
        if ($file === null) return null;


        $storage = Storage::disk('public');
        $path = 'posts/'.Carbon::now()->format('ymd').'/';

        $image = Image::make($file);
        $image_name = $this->generateFileName($file);
        if (!$storage->exists($path)) {
            $storage->makeDirectory($path, 0775, true);
        }
				if (!$storage->exists('thumb/'.$path)) {
            $storage->makeDirectory($path, 0775, true);
        }
        $storage->put($path . $image_name, $image->stream()->__toString());

				$image->resize('200', null, function ($constraint) {
						$constraint->aspectRatio();
				});
				$storage->put('thumb/'.$path . $image_name, $image->stream()->__toString());

				$size=  $file->getSize();
				$origin =  $file->getClientOriginalName() ;
				$url = '/'.$path . $image_name;
				PostFile::create([
					'post_id'=>$post_id,
					'original_name'=> $origin,
					'url'=>$url,
					'attach_type'=> 'image',
					'attach_size'=>$size,
				]);
        //return $path . $image_name;
    }
    private function generateFileName(UploadedFile $file)
    {
        $ext = $file->getClientOriginalExtension();
        return Carbon::now()->format('ymdhis') . '_' . Str::random(9) . "." . $ext;
    }
	public function update(Request $request, $code){

	}

	public function commentWrite(Request $request, $code, $writeid){

	}
}
