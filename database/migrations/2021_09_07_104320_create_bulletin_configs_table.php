<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBulletinConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulletin_configs', function (Blueprint $table) {
            $table->increments('id');
			$table->string('code')->unique();
			$table->string('title', 50);
			$table->enum('is_use', ['Y', 'N'])->default('Y')->comment('게시판_사용여부');
			$table->enum('html_use', ['Y', 'N'])->default('N')->comment('html_사용여부');
			$table->enum('comment_use', ['Y', 'N'])->default('Y')->comment('댓글_사용여부');
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
        Schema::dropIfExists('bulletin_configs');
    }
}
