<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_history', function (Blueprint $table) {
            $table->id();
            $table->string('leave_type');
            $table->string('status');
            $table->date('requested_at');	
            // $table->date('created_at')->nullable();
            $table->integer('initial_leave_bal');	
            $table->integer('final_leave_bal');	
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
        Schema::dropIfExists('leave_history');
    }
}
