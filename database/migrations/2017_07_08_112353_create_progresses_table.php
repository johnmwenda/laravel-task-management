<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('task_id');
            $table->enum('overall_status', ['ON-GOING', 'COMPLETED']);
            $table->string('message');
            $table->smallInteger('progress_status_percent'); //1%-100% always 0 when creating for first time
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('task_id')->references('id')->on('tasks')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progresses');
    }
}
