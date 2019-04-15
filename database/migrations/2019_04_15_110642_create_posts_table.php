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
            $table->string('title');
            $table->string('section')->nullable();
            $table->text('content');
            $table->integer('viewCount')->default(0);
            $table->string('user_id');
            $table->boolean('published')->default(0);
            $table->string('pic')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();

        });
        Schema::create('post_verifies', function (Blueprint $table) {
            $table->integer('post_id');
            $table->integer('user_id');
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
