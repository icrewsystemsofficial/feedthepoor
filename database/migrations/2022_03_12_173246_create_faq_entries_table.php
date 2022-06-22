<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_entries', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->integer('category_id')->unsigned();
            $table->string('entry_question', 100);
            $table->longText('entry_answer')->nullable();
            $table->string('author_name', 100);
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
        Schema::dropIfExists('faq_entries');
    }
}
