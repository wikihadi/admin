<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->text('content')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('to_user')->nullable();
            $table->integer('task_id')->nullable();
            $table->integer('media_id')->nullable();
            $table->integer('post_id')->nullable();
            $table->integer('re_id')->nullable();
            $table->integer('fin_id')->nullable();
            $table->integer('reply_id')->nullable();
            $table->integer('duration')->nullable();
            $table->string('unit')->nullable();
            $table->boolean('forcedBox')->nullable()->default(0);
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
        Schema::dropIfExists('statuses');
    }
}
