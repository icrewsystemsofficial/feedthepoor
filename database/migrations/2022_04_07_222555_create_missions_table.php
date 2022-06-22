<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('location_id')->references('id')->on('locations')->nullable();
            $table->uuid('field_manager_id')->references('id')->on('users')->nullable();
            $table->longText('description')->nullable();
            $table->integer('assigned_volunteers')->default('0');
            $table->dateTime('execution_date')->nullable();
            $table->integer('mission_status')->default('0');
            $table->longText('procurement_items')->nullable();
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
        Schema::dropIfExists('missions');
    }
}
