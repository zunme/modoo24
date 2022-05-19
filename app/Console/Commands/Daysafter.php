<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Models\AuctionOrder;
use App\Models\AuctionOrderNface;

use App\Models\LaravelAlimtokLog;
use App\Libraries\Aligo;

class Daysafter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daysafter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'after 3 day';

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
        \DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        /*
        (
             SELECT a.uid, 'nf' order_type, 'TI_4724' as template, REPLACE( REPLACE(a.hp,' ',''), '-','') hp , a.`name`
                 ,  0 AS offer_cnt, a.mdate,'R' as send_status
           FROM auction_order_nface a
              JOIN auction_order_contract b ON a.uid = b.uid
             WHERE a.mdate = DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 3 DAY), '%Y-%m-%d')
          ) UNION (

           SELECT
          uid, 'ord' order_type, 'TI_4724' as template, REPLACE( REPLACE(hp,' ',''), '-','') hp , `name`
             ,  0 AS offer_cnt, mdate,'R' as send_status
          FROM auction_order c
           WHERE
          c.mdate = DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 3 DAY), '%Y-%m-%d')
             AND c.passwd != ''
          AND contact_name != '60일'
             AND c.share_status ='DONE'
             AND c.`name` NOT LIKE '테스트'
             AND s_uid1 NOT IN (80,736) AND s_uid2 NOT IN (80,736) AND s_uid3 NOT IN (80,736)
          )
           ;
        */
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

    }

}
