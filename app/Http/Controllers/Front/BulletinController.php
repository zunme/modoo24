<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\BulletinConfig;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostFile;
use App\Models\AuctionStaff;

use App\Models\PostCommentFavLog;
use App\Models\PostCommentBestLog;
use App\Models\PostCommentLog;

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

	public function contentList(Request $request, $code){
		Carbon::setLocale('ko');
		$config = BulletinConfig::active()->where(['code'=>$code])->first();
		if( !$config){
			return back()->with('noti_alert_message', '찾는 페이지가 없습니다.');
		}
		$qry = Post::where(['bulletin_id'=> $config->id])->where('is_confirmed', '!=','N');

		if( $request->search ){
			if ( $request->search_option == 'title' ) $qry = $qry->where('title', 'like', '%'.$request->search.'%');
			else if ( $request->search_option == 'cont' ) $qry =$qry->where('title', 'like', '%'.$request->search.'%')->orWhere('body', 'like', '%'.$request->search.'%');
			else if ( $request->search_option == 'writer' ) $qry =$qry->where('nickname', 'like', '%'.$request->search.'%');
		}

		if ($request->ajax()) {
			return Datatables::of($data)->make(true);
		}else {
			$data = $qry->latest()->paginate(5);
			//return view('Front/Bulletin/testlist', compact(['data','code','request', 'config']));
			return view('Front/Bulletin/list', compact(['data','code','request', 'config']));
		}

	}
	public function contentListApi(Request $request, $code){
		$config = BulletinConfig::active()->where(['code'=>$code])->first();
		if( !$config){
			return view('Front/Bulletin/empty');
		}
		$data = Post::active()->where(['bulletin_id'=> $config->id]);
		if( $request->search ){
			if ( $request->search_option == 'title' ) $data = $data->where('title', 'like', '%'.$request->search.'%');
			else if ( $request->search_option == 'cont' ) $data =$data->where('title', 'like', '%'.$request->search.'%')->orWhere('body', 'like', '%'.$request->search.'%');
			else if ( $request->search_option == 'writer' ) $data =$data->where('nickname', 'like', '%'.$request->search.'%');
		}
		return Datatables::of($data)->make(true);
	}

	public function view(Request $request, $code ,$viewid){
		$user = Auth::user();

		$config = BulletinConfig::active()->where(['code'=>$code])->first();
		if( !$config){
			return back()->with('noti_alert_message', '찾는 페이지가 없습니다.');
		}

		$post = Post::with(['comments','files'])->where(['bulletin_id'=> $config->id, 'id'=>$viewid])->first();

		if( $post->is_confirmed =='N' ) return back();
		else if( $post->is_confirmed == 'R' ){
			if( $user ){
				if( $user->id != $post->user_id) return back();
			}else return back();
		}

		$post->view_cnt = $post->view_cnt + 1;
		$post->save();

		$is_writer = ( Auth::user() && Auth::user()->id == $post->user_id) ? true:false;

		return view('Front/Bulletin/viewpost',compact(['config','post','code','is_writer']));
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
		return view('Front/Bulletin/writepost', compact(['config', 'code', 'post','totalImgCount']) );
	}
	public function updateForm(Request $request, $code, $writeid){
		$config = BulletinConfig::active()->where(['code'=>$code])->first();
		if( !$config){
			return back()->with('noti_alert_message', '찾는 페이지가 없습니다.');
		}
		$post = Post::active()->with(['comments','files'])->where(['bulletin_id'=> $config->id, 'id'=>$writeid])->first();
		$totalImgCount = $post->files->count();

		$is_writer = ( Auth::user()->id == $post->user_id) ? true:false;
		if ( !$is_writer){
			return view('Front/Bulletin/421', compact(['config', 'code', 'post','totalImgCount']) );
		}
		return view('Front/Bulletin/writepost', compact(['config', 'code', 'post','totalImgCount']) );
	}

	public function create(Request $request){
		$user = Auth::user();

		$messages = [
        'title.*' => '제목을 50자 내외로 작성해주세요.',
				'body.*' =>'내용을 작성해주세요.',
    ];
    $this->validate($request, [
      'title' => 'bail|required|string|min:2|max:50',
      'body' => 'bail|required',
			'code' => 'bail|required',
     ],$messages);
		$data = $request->except('id', 'code');

		$config = BulletinConfig::active()->where(['code'=>$request->code])->first();
		if( !$config){
			return $this->error('게시판을 찾을 수 없습니다.');
		}

		$storage = Storage::disk('public');
		if( $request->delfile ){
			foreach( $request->delfile as $fileno){
				$file = PostFile::find( $fileno);
				$this->delfile( $file->url);
				$file->delete();
			}
		}

		$data['body'] = $this->getimage($data['body']);

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

		if ( PostComment::create($data) ) {
				if( $config->use_comment_confirm != 'Y'){
					$post->increment('comment_cnt');
					$log = PostCommentLog::firstOrCreate( ['auction_staff_s_uid'=>$user->s_uid]);
					$log->increment('comment_cnt');
				}
			return $this->success();
		}
		else return $this->error('잠시후에 사용해주세요.', 422);
	}

	private function addfavcnt(Request $request, $session){
		$user = AuctionStaff::where(['s_uid'=> $session['idx'], 's_id'=>$session['user_id'] ])->first();
		if( !$user ){
			return $this->error('로그인후 사용해주세요');
		}

		$comment = PostComment::active()->where(['id'=>$request->id ])->first();

		if( $comment->auction_staff_s_uid == $user->s_uid ) return $this->error('자신이 쓴 댓글입니다.', 422);
		try{
			$log = PostCommentFavLog::create(['comment_id'=>$request->id,'auction_staff_s_uid'=> $user->s_uid]);
			$comment = PostComment::where(['id'=>$request->id])->first();
			$comment->increment('best_cnt');

			$log = PostCommentLog::firstOrCreate( ['auction_staff_s_uid'=>$comment->auction_staff_s_uid]);
			$log->increment('fav_cnt');

			return $this->success(['cnt'=> $comment->best_cnt],'공감하셨습니다');
		} catch (\Exception $e){
			return $this->error('이미 공감하신 댓글입니다.', 422, $e);
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
			}else $this->addfavcnt($request, $session);

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
	public function delete(Request $request, $code){

	}

	public function commentWrite(Request $request, $code, $writeid){

	}
}
