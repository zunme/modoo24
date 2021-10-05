<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comments', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('post_id')->comment('글아이디 posts.id')->index();
			$table->integer('auction_staff_s_uid')->comment('작성파트너아이디 auction_staff.s_uid')->index();
			$table->string('title')->nullable();
			$table->text('body');
			$table->enum('is_confirmed', ['Y', 'N','R'])->default('Y')->comment('확인여부 N: 거절, R:대기');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_comments');
    }
}
