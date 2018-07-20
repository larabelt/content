<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeltContentUpdateSubtypes extends Migration
{
    protected $tables = [
        'attachments' => 'template',
        'blocks' => 'template',
        'lists' => 'template',
        'list_items' => 'template',
        'pages' => 'template',
        'posts' => 'template',
        'sections' => 'template',
        'terms' => 'template',
        'handles' => ['config_name', 'not-found'],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table => $data) {

            $default = 'default';
            $column = $data;
            if (is_array($data)) {
                $column = $data[0];
                $default = $data[1];
            }

            Schema::table($table, function (Blueprint $table) use ($column, $default) {
                $table->renameColumn($column, 'subtype');
            });

            if (array_get(DB::getConfig(), 'driver') == 'mysql') {
                DB::statement("ALTER TABLE $table MODIFY COLUMN `subtype` VARCHAR(255) DEFAULT '$default' AFTER `id`");
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table => $data) {

            $column = $data;
            if (is_array($data)) {
                $column = $data[0];
            }

            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->renameColumn('subtype', $column);
            });
        }
    }

}
