<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_id')->references('id')->on('donations');
            $table->unsignedBigInteger('location_id')->references('id')->on('locations');
            $table->text('procurement_item');
            $table->integer('procurement_quantity');
            $table->text('vendor')->nullable();
            $table->integer('status')->default(0);
            $table->integer('last_updated_by')->references('id')->on('users')->nullable();
            $table->unsignedBigInteger('mission_id')->nullable();
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
        Schema::dropIfExists('operations');
    }
}
