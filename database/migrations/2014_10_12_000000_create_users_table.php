<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone',10)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('lastStatus')->nullable()->default(0);
            $table->time('lunch')->nullable();
            $table->string('avatar')->default('user.png');
            $table->text('bank')->nullable();
            $table->bigInteger('card')->nullable();
            $table->text('shba')->nullable();
            $table->bigInteger('bankId')->nullable();
            $table->text('experience')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
