<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OhioCreateToutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_id')->nullable();
            $table->string('template')->default('default');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('heading')->nullable();
            $table->text('body')->nullable();
            $table->string('btn_text')->nullable();
            $table->string('btn_url')->nullable();
            $table->softDeletes();
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
        Schema::drop('touts');
    }
}
