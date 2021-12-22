<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Models\AuctionOrder;
use App\Models\AuctionOrderNface;

use App\Events\OrdercheckEvent;
class Ordercheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ordercheck';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check last order';
    protected $intervaltime = 10;
    protected $cachetime = 1000;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->lastorder = \Cache::remember('check_last_order', $this->cachetime, function (){
          $order = AuctionOrder::select('uid')->orderBy('uid','desc')->first();
          return $order->uid;
        });
        $this->lastnface = \Cache::remember('check_last_nface', $this->cachetime, function (){
          $order = AuctionOrderNface::select('uid')->orderBy('uid','desc')->first();
          return $order->uid;
        });
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $loopcount = (int)( 60 / $this->intervaltime );
      for( $i = 0 ; $i < $loopcount; $i ++){
        dump ( Carbon::now()->format('Y-m-d H:i:s') );
        $this->last_order();
        $this->last_nface();
        sleep($this->intervaltime );
      }
    }
    function last_order(){
      dump( 'order:' . $this->lastorder);
      $id = AuctionOrder::select('uid')->where('uid','>', $this->lastorder)->orderBy('uid','desc')->first();
      if( $id ){
        \Cache::put('check_last_order', $id->uid, $this->cachetime);
        $this->lastorder = $id->uid;
        event(new OrdercheckEvent( 'order',$id->uid ));
        dump( 'order event :' . $this->lastorder);
      }
    }
    function last_nface(){
      dump( 'nface:' . $this->lastnface);
      $id = AuctionOrderNface::select('uid')->where('uid','>', $this->lastnface)->orderBy('uid','desc')->first();
      if( $id ){
        \Cache::put('check_last_nface', $id->uid, $this->cachetime);
        $this->lastnface = $id->uid;
        event(new OrdercheckEvent( 'nface',$id->uid ));
        dump( 'nface event :' . $this->lastnface);
      }
    }
}
