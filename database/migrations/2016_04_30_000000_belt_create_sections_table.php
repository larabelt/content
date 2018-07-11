<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class BeltCreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('owner');
            $table->integer('sectionable_id')->nullable();
            $table->string('sectionable_type')->nullable();
            NestedSet::columns($table);
            $table->string('template')->default('default');
            $table->text('heading')->nullable();
            $table->text('before')->nullable();
            $table->text('after')->nullable();
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
        Schema::dropIfExists('sections');
    }
}
