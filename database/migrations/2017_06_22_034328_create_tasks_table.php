<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('assignee_id');
            $table->string('name');
            $table->text('summary');
            $table->enum('access_level', ['private', 'public']);
            // $table->string('access_level');
            $table->enum('priority', ['Low', 'Normal', 'High']);
            $table->dateTime('due_date');
            $table->timestamps();

            $table->unique(['name', 'summary']);

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('department_id')->references('id')->on('departments')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('categories')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('assignee_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
        });


        //Task::assignee() and User::assigned_tasks() - morphToMany()
        //  Schema::create('task_user', function (Blueprint $table) {
        //     $table->integer('task_id')->unsigned()->index();
        //     $table->integer('user_id')->unsigned()->index();

        //     $table->unique(['user_id', 'task_id']);

        //     $table->foreign('task_id')->references('id')->on('tasks')
        //         ->onUpdate('cascade')->onDelete('cascade');

        //     $table->foreign('user_id')->references('id')->on('users')
        //         ->onUpdate('cascade')->onDelete('cascade');

        //     $table->timestamps();

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('task_user');
        Schema::dropIfExists('tasks');
    }
}
