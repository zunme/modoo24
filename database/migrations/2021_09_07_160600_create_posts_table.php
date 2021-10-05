<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('bulletin_id')->default('0')->comment('게시판아이디 bulletin.id')->index();
			$table->integer('user_id')->default('0')->comment('작성자 users.id')->index();
			$table->string('nickname', 50)->comment('작성자 이름');
			$table->enum('noti', ['Y', 'N'])->default('N')->comment('공지여부');
			$table->enum('is_confirmed', ['Y', 'N','R'])->default('Y')->comment('확인여부 N: 거절, R:대기');
			$table->string('title');
			$table->string('repImg')->nullable();
			$table->text('body');
			$table->integer('comment_cnt')->default(0)->comment('댓글갯수');
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
        Schema::dropIfExists('posts');
    }
}
