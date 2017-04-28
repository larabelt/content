<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeltUpdateHandles1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * sqlite doesn't allow dropping or modifying multiple columns
         */
        Schema::table('handles', function (Blueprint $table) {
            $table->integer('handleable_id')->nullable()->change();
        });
        Schema::table('handles', function (Blueprint $table) {
            $table->string('handleable_type', 100)->nullable()->change();
        });
        Schema::table('handles', function (Blueprint $table) {
            $table->dropColumn('delta');
        });

        /**
         * re: sqlite, adding multiple columns is okay
         */
        Schema::table('handles', function (Blueprint $table) {
            $table->boolean('is_active')->default(0)->index();
            $table->boolean('is_default')->default(0)->index();
            $table->string('config_name')->default('not-found');
            $table->string('target')->nullable();
            $table->integer('hits')->default(0)->index();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('handles', function (Blueprint $table) {

            // undo drop
            $table->float('delta')->default(1)->index();

            // undo add
            $table->dropColumn('is_active');
            $table->dropColumn('is_default');
            $table->dropColumn('config_name');
            $table->dropColumn('target');
            $table->dropColumn('hits');
        });
    }
}
