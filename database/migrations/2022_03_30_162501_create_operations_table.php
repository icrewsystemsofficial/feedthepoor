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
            $table->text('procurement_item');
            $table->integer('procurement_quantity');
            $table->text('vendor')->nullable();
            $table->enum('status', ['UNACKNOWLEDGED', 'ACKNOWLEDGED', 'PROCUREMENT ORDER INITIATED','DELAYED','READY FOR MISSION DISPATCH','ASSIGNED TO MISSION','FULFILLED'])->default('UNACKNOWLEDGED');
            $table->integer('last_updated_by')->references('id')->on('users');
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
