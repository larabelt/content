<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeltCreateHandlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url', 255)->index();
            $table->integer('handleable_id');
            $table->string('handleable_type', 100);
            $table->float('delta')->default(1)->index();
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
        Schema::dropIfExists('handles');
    }
}
