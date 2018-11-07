<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeltUpdateHandles2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('handles', function (Blueprint $table) {
            $table->string('locale', 5)->default('en_US');
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
            $table->dropColumn('locale');
        });
    }
}
