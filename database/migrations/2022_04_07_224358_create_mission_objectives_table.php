<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_objectives', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('donation_id')->references('id')->on('donations')->nullable();
            $table->uuid('assigned_volunteer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('instructions')->nullable();
            $table->integer('media_items')->default(0);
            $table->integer('objective_status')->default(0);
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
        Schema::dropIfExists('mission_objectives');
    }
}
