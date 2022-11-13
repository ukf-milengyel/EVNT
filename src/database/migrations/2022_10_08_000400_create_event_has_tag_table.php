<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $tableName = 'event_has_tag';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id')->constrained('event')->cascadeOnDelete();
            $table->unsignedBigInteger('tag_id')->constrained('tag')->cascadeOnDelete();

            $table->foreign('event_id')
                ->references('id')
                ->on('event');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tag');
        });
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
