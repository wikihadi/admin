<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fins', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->integer('user_id');
            $table->integer('state')->nullable()->default('0');
            $table->string('subject','255')->nullable();
            $table->string('section','255')->nullable();
            $table->integer('brand_id')->nullable();
            $table->text('content')->nullable();
            $table->integer('acc_id')->nullable();
            $table->string('acc_content', 255)->nullable();
            $table->dateTime('pay_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fins');
    }
}
