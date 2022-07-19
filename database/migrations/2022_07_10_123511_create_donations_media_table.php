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
            $table->id();
            $table->unsignedBigInteger('donation_id')->references('id')->on('donations')->onDelete('cascade');
            $table->string('media');
            $table->unsignedBigInteger('last_modified_by')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
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
