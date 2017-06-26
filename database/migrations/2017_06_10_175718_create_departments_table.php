<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description');   
            $table->timestamps();
        });

        Schema::table('users', function($table) {
            $table->integer('department_id')->after('id');

            $table->foreign('department_id')->references('id')->on('departments')
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
        Schema::table('users', function($table)
        {
            $table->dropColumn('department_id');
        });

        Schema::dropIfExists('departments');
    }
}
