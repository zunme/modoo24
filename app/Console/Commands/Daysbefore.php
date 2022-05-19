<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Models\AuctionOrder;
use App\Models\AuctionOrderNface;

use App\Models\LaravelAlimtokLog;
use App\Libraries\Aligo;

class Daysbefore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daysbefore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'before 10 day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
          TODO 템플릿 변경해야함
            TEST : N =>R 로 변경필요함
        */
        parent::__construct();
        dump( "==== start ===");
        \DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        /*
        $sql ="
        SELECT *
        from
        (
        	SELECT
        		a.uid,'order' move_type, replace(a.hp,'-','') AS hp, a.`name`
        	 	,( if( s_uid1 > 0 AND s_uid1 NOT IN (736,80) , 1 , 0 ) +  if( s_uid2 > 0 AND s_uid2 NOT IN (736,80), 1 , 0 ) + if( s_uid3 > 0 AND s_uid3 NOT IN (736,80), 1 , 0 ) )  AS cnt
        	FROM auction_order a
        	WHERE a.mdate = DATE_FORMAT( DATE_ADD( NOW(), INTERVAL 10 DAY), '%Y-%m-%d')
        	AND `name` NOT LIKE '%테스트%'
        	AND `name` NOT LIKE '고객정보삭제'
        	AND (
        			(s_uid1 >0 AND s_uid1 NOT IN (736,80) )
        			or
        			(s_uid2 >0 AND s_uid2 NOT IN (736,80) )
        			or
        			(s_uid2 >0 AND s_uid2 NOT IN (736,80) )
        	)
        	UNION ALL
        	SELECT a.uid, 'order_nface' move_type, a.hp, a.`name`,  COUNT( b.s_uid ) AS cnt
        	FROM auction_order_nface a
        	JOIN auction_order_estimate b ON a.uid = b.uid AND b.s_uid NOT IN ( 736,80)
        	WHERE a.mdate = DATE_FORMAT( DATE_ADD( NOW(), INTERVAL 10 DAY), '%Y-%m-%d')
        	AND `name` NOT LIKE '%테스트%'
        	AND `name` NOT LIKE '고객정보삭제'
        	GROUP BY a.uid
        ) grped
        GROUP BY replace(hp,' ','')
        ";
        */
        /* 비대면 고객 10일전 */
        // TI_2469
        $sql = "
          select * from(
            SELECT a.uid, 'nf' order_type, 'TI_2469' as template , REPLACE( REPLACE(a.hp,' ',''), '-','') hp , a.`name`,  COUNT( b.s_uid ) AS offer_cnt, a.mdate,'R' as send_status
            FROM auction_order_nface a
            JOIN auction_order_estimate b ON a.uid = b.uid AND b.s_uid NOT IN ( 736,80)
            WHERE a.mdate = DATE_FORMAT( DATE_ADD( NOW(), INTERVAL 10 DAY), '%Y-%m-%d')
            AND `name` NOT LIKE '%테스트%'
            AND `name` NOT LIKE '고객정보삭제'
            GROUP BY a.uid
          ) grped
          GROUP BY hp
        ";
        $this->list = \DB::select($sql);
        try{
          foreach( $this->list as $row){
            $check = LaravelAlimtokLog::where(['hp'=>$row->hp,'mdate'=>$row->mdate,'template'=>$row->template ])->count();
            if( $check < 1) LaravelAlimtokLog::create((array) $row);
          }
        } catch (\Exception $e){
          dump( $e->getMessage() );
          ;
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      dump( "==== prc ===");
      $toklist = LaravelAlimtokLog::whereDate('created_at', date('Y-m-d'))->where(['template'=>'TI_2469', 'send_status'=>'R'])->get();
      foreach ( $toklist as $row){
        try{
          // 'TI_1787'->  $code = $this->codeEncDec($row->hp.'|'.$row->uid, true);
          //$code = $this->codeEncDec($row->hp.'|'.$row->uid, true);
          $code = '';
          $aligo = new Aligo;

          $req["#{고객명}"] = $row->name;
          // 'TI_1787'->  $req["#{인증번호}"] = $code;

          $data = [
            'sender'=>'1600-7728',
            'tpl_code'=>'TI_2469',
            'receiver_1'=>$row->hp,
            'subject_1'=>'모두이사'
          ];
          $res = $aligo->sendKakaoParser($data, $req);
          if ( $res == 'true') {
            $row->desc = $code;
            $row->send_status ='Y';
            $row->save();
          }else {
            $row->desc = $code;
            $row->send_status ='N';
            $row->save();
          };

        }catch(\Exception $e){
          dump( $e->getMessage() );
          $row->desc = $code;
          $row->send_status ='N';
          $row->save();
        }
      }
    }
    private function codeEncDec($str, $enc = false){
  		 try{
  			 $cipher = "AES-256-CBC";
  			 $key = "modoo2420220110.";
  			 $ivlen = openssl_cipher_iv_length($cipher);
  			 $iv = substr("103938462834621537239482374561723823459435034589237426347234934598234752896539327459234592384562345982", 0, $ivlen);
  			 if( $enc ) return bin2hex(openssl_encrypt($str, $cipher, $key, OPENSSL_RAW_DATA, $iv));
  			 else return openssl_decrypt( hex2bin($str), $cipher, $key, OPENSSL_RAW_DATA, $iv);
  		 }catch (\Exception $e){
  			 return false;
  		 }
  	 }
}
