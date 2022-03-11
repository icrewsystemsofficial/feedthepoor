<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {            
            $table->id();
            $table->string('location_name');
            $table->longText('location_description')->nullable();
            $table->text('location_address');
            $table->string('location_pin_code', 6);
            $table->text('location_latitude', 12)->nullable();
            $table->text('location_longitude', 13)->nullable();
            $table->unsignedBigInteger('location_manager_id')->nullable();// foreign key
            $table->integer('location_status')->default(0);
            $table->timestamps();
            $table->foreign('location_manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
