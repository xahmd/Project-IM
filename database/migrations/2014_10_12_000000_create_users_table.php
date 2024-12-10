<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('firstName');
            $table->string('lastName'); 
            $table->string('staffID')->unique(); 
            $table->string('managerID')->nullable(); 
            $table->string('role'); 
            $table->integer('leaveBalance')->default(35); 
            $table->string('password');
            $table->string('email')->nullable();
            $table->rememberToken();
            $table->timestamps();
            // $table->foreign('roleID')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
