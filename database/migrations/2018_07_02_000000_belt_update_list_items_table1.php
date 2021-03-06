<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeltUpdateListItemsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_items', function (Blueprint $table) {
            $table->string('template')->default('default')->index();
        });

        Schema::table('list_items', function (Blueprint $table) {
            $table->dropColumn('listable_id');
        });

        Schema::table('list_items', function (Blueprint $table) {
            $table->dropColumn('listable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_items', function (Blueprint $table) {
            $table->dropColumn('template');
            $table->morphs('listable');
        });
    }
}
