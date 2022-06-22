<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_assignments', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('mission_id')->references('id')->on('missions')->onDelete('cascade');
            $table->uuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status')->default('0');
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
        Schema::dropIfExists('mission_assignments');
    }
}
