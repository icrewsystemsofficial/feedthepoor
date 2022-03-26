<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donor_id');            
            $table->string('donor_name');
            $table->integer('donation_amount');
            $table->text('donation_in_words');     
            $table->unsignedBigInteger('cause_id');                   
            $table->string('cause_name');
            $table->integer('donation_status');
            $table->integer('payment_method')->default(0);
            $table->text('razorpay_payment_id')->nullable();
            $table->timestamps();
            $table->foreign('donor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cause_id')->references('id')->on('causes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
