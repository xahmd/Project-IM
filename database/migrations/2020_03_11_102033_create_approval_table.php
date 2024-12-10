<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('Pending');
            $table->string('name');
            $table->string('staffID');
            $table->string('leave_type');
            $table->time('requested_at');	
            // $table->date('created_at')->nullable();
            $table->integer('initial_leave_bal')->default(35);	
            $table->integer('final_leave_bal')->default(35);
            $table->integer('totalleave')->nullable();
            $table->date('startdate');	
            $table->date('enddate');	
            $table->text('reason')->nullable();	
            $table->date('resumdate');	
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
        Schema::dropIfExists('approvals');
    }
}
