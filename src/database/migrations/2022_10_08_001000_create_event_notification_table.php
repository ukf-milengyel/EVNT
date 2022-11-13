<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $tableName = 'event_notification';

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
            $table->unsignedBigInteger('user_id')->nullable()->constrained('user')->cascadeOnDelete();
            $table->unsignedBigInteger('type')->default(0);
            $table->string('message')->nullable();
            $table->boolean('seen');
            $table->timestamps();

            $table->foreign('event_id')
                ->references('id')
                ->on('event');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
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
