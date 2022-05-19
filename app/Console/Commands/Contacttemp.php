<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Models\AuctionOrder;

class Contacttemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contacttemp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change temp';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $inilast = 257920;
      //\Cache::forget('contacttemplast');
      $last = \Cache::get('contacttemplast', $inilast);
      dump( $last );
      $data = AuctionOrder:: select( 'uid')
      ->where('uid','>', $last)
      ->where('reg_date','<', Carbon::now()->subminute(30))
      ->orderBy('uid','desc')
      ->limit(1)->first();
      if( $data ) {

        dump("try...");
        try{
          AuctionOrder::
            where('uid','>', $last)->where('uid','<=', $data->uid)
            ->where('contact_name','=','임시저장')
            ->update(['contact_name'=>'']);
          \Cache::put('contacttemplast', $data->uid, 60*24);
        }catch (\Exception $e){
          ;
        }
      }

    }
    private function codeEncDec($str, $enc = false){

  	}
}
