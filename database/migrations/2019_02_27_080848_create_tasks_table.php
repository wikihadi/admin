<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('title');
            $table->text('content');
//            $table->string('status')->nullable()->default('new');
            $table->integer('orderTask')->nullable()->default('0');
            $table->integer('weight')->nullable()->default('0');
            $table->integer('viewCount')->nullable()->default('0');
            $table->integer('commentCount')->nullable()->default('0');
            $table->dateTime('startDate')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->string('material')->nullable();
            $table->string('brand')->nullable();
            $table->string('dx')->nullable();
            $table->string('dy')->nullable();
            $table->string('dz')->nullable();
            $table->string('dDesc')->nullable();
            $table->string('type')->nullable();
            $table->string('subject')->nullable();
            $table->string('pic')->nullable()->default('task.jpg');
            $table->string('forProduct')->nullable();
            $table->boolean('reTask')->default(0)->nullable();
            $table->boolean('isDone')->default(0)->nullable();
            $table->integer('pending')->default(0)->nullable();
            $table->integer('done_user_id')->nullable()->default(0);
            $table->dateTime('done_date')->nullable();
            $table->integer('reTask_id')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('reseller_id')->unsigned()->nullable();
            $table->integer('reseller_state')->nullable();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->bigInteger('cost')->nullable()->default(0);
            $table->integer('paid')->default(0);
            $table->integer('payOK')->default(0);

        });

        Schema::create('task_users', function (Blueprint $table) {
            $table->integer('task_id');
            $table->integer('user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
