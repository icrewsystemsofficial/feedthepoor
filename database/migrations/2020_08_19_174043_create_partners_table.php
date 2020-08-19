<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('organisation_name', 50)->nullable();
            $table->string('organisation_address', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('zip', 50)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('contact', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('comments', 50)->nullable();
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
        Schema::dropIfExists('partners');
    }
}
