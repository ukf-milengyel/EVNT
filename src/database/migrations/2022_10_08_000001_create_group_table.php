<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public $tableName = 'group';

    /**
     * Run the migrations.
     * @table user_level
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('permissions')->default('0');
            $table->string('color', 7)->default('#3498eb');
        });

        // create admin group
        if (DB::table($this->tableName)->count() == 0){
            DB::table($this->tableName)->insert([
                array(
                    'name' => 'admin',
                    'permissions' => 65535,
                    'color' => '#FF5733',
                )
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
};
