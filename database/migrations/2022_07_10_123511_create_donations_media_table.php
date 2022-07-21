<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations_media', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('donation_id');
            $table->string('media');
            $table->unsignedBigInteger('last_modified_by')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->foreign('donation_id')->references('id')->on('donations')->onDelete('cascade');
        });

        Schema::table('donations', function($table){
            $table->integer('media_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations_media');
        Schema::table('donations', function($table) {
            $table->dropColumn('media_count');
        });
    }
}
