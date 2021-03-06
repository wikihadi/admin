<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('isMaterial')->default(0)->nullable();
            $table->boolean('isDimension')->default(0)->nullable();
            $table->boolean('isType')->default(0)->nullable();
            $table->integer('parent_id')->nullable()->default(0);
        });
        Schema::create('category_task', function (Blueprint $table) {
            $table->integer('task_id');
            $table->integer('category_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
